<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Menu
{
	protected $ci;
    protected $_brand;
    protected $_fluid = true;
    protected $_nav = 'navbar-default';
    protected $_id;
    protected $_container_class="";
	protected $SAMLauth;
    /**
     * Coustom menu item
     *
     * @param string
     */
    private $_coustom_menu_item = array();
	
	public function __construct($param=array())
	{
        $this->ci =& get_instance();
        $db_profile = $this->ci->config->item('app.dbmenu');
        $this->db_menu = $this->ci->load->database($db_profile,true);
        if(isset($param['brand']))
        	$this->_brand = $param['brand'];
        if(isset($param['fluid']))
        	$this->_fluid = $param['fluid'];
        if(isset($param['navbar_class']))
        	$this->_nav = $param['navbar_class'];
        if(isset($param['id']))
        	$this->_id = $param['id'];
        if(isset($param['container_class']))
        	$this->_container_class = $param['container_class'];
	}
	
	private function getData(){
		$kodmenu = $this->ci->config->item('app.kodMenu');
		if (!isset($this->ci->SAMLauth) ){
			$filename = '/var/www/html/smk/simplesaml/lib/_autoload.php';		
			require_once($filename);
			$this->SAMLauth = new SimpleSAML_Auth_Simple('smuSSO-sp');
		}
		else{
			$this->SAMLauth = $this->ci->SAMLauth;
		}
 		if ($this->SAMLauth->isAuthenticated()){			
	        // if (sizeof($kelasUrusetia) === 0)
	        //     return false;
	        $attr = $this->SAMLauth->getAttributes();
	        $role = $attr['ew11role'];
			$kelas = "";
	        if (sizeof($role))
	        	$kelas = " AND ( menu002.kelas IN ('".implode('\',\'',$role)."') ) ";
			$sql = sprintf("SELECT DISTINCT menu001.idmenu,   
			 		menu001.menu,   
			 		menu001.tajuk,   
			 		menu001.jnsfail,   
			 		menu001.namafail,   
			 		menu001.induk,   
			 		menu001.susunan, 
			 		menu001.aras,
			 		CASE trim(menu001.namafail) 
			 			WHEN NULL THEN 'button' 
			 			WHEN '' THEN 'button' 
			 			ELSE 'submit' END AS jnsbtn
			 	FROM pdata: xmenu002mmenuakses menu002,   
			 		pdata: xmenu001mmenu menu001 
			 	WHERE ( menu002.idmenu = menu001.idmenu ) AND  
			 		( menu001.stspapar = 1 ) 
			 		%s
			 		AND ( menu001.idsistem = %d )
			 	ORDER BY menu001.aras, menu001.susunan",$kelas, $kodmenu);
					// ( menu002.kelas IN  ('KTUKM','NC','TAKAD','TBIR2','TBIR3','UPLNA','UPLNC','UPLNP','USPPH','USPPT_xx','USPPU_xx'))
 		}
 		else{
 			$sql = sprintf("SELECT DISTINCT menu001.idmenu,   
			 		menu001.menu,   
			 		menu001.tajuk,   
			 		menu001.jnsfail,   
			 		menu001.namafail,   
			 		menu001.induk,   
			 		menu001.susunan, 
			 		menu001.aras,
			 		CASE trim(menu001.namafail) 
			 			WHEN NULL THEN 'button' 
			 			WHEN '' THEN 'button' 
			 			ELSE 'submit' END AS jnsbtn
			 	FROM pdata : xmenu002mmenuakses menu002,   
			 		pdata : xmenu001mmenu menu001 
			 	WHERE ( menu002.idmenu = menu001.idmenu ) AND  
			 		( menu001.stspapar = 1 ) AND 
			 		( menu001.idsistem = %d ) AND
			 		( 0 = 1 )
			 	ORDER BY menu001.aras, menu001.susunan", $kodmenu);
 		}
		$result = $this->db_menu->query($sql)
								->result_array();
		return $result;
	}
	
	public function getMenu($tree = array()){
		if (empty($tree)){
			$q_menuData = $this->getData();
			$tree = array();
			$nodeList = array();
			foreach ($q_menuData as $row) {			
				$nodeList[$row['idmenu']] = array_merge($row, array('children' => array()));
			}
			foreach ($nodeList as $nodeId => &$node) {
			    if (!$node['induk'] || !array_key_exists($node['induk'], $nodeList)) {
			        $tree[] = &$node;
			    } else {
			        $nodeList[$node['induk']]['children'][] = &$node;
			    }
			}
			unset($node);
			unset($nodeList);
		}

		$menu = $this->menuHTML($tree);
		return $menu;
	}

	function menuHTML($array, $level = 1){
		$str_menu="";
		$str_menu_t="";
	    foreach($array as $key => $value){

			if(!empty($value['children'])){
	            //We need to loop through it.
	            //echo '=========='.$value['menu'].'==================<br>';
	            $str_menu_t = $this->menuHTML($value['children'], $level + 1);
	            //var_dump( $str_menu_t);
	        	$str_menu .= $this->add_li(
	        			$this->add_ul($str_menu_t, $value['menu'], true)
	        		,true);
	        } else{
	        //     //It is not an array, so print it out.
	        	$str_menu .= $this->add_li($value['menu'],false,(strlen($value['namafail']))?$value['namafail']:'#');
	            //echo '++++++++++++++<br>';
	        }
	    }
	    if ($level === 1)
	    	return $this->add_menu_navbar($str_menu);
	    else
	    	return $str_menu;
	}
	function add_li($a, $dropdown = false, $href = '#'){
		if ($dropdown){
			//var_dump($a);
			return '<li'.(($dropdown)?' class="dropdown"':'').'>'.$a.'</li>';
		}
		else
			return '<li'.(($dropdown)?' class="dropdown"':'').'><a href="'.$href.'">'.$a.'</a></li>';
	}
	function add_ul($a, $title, $dropdown = false){
		//var_dump($a);
		$ul = '';
		if ($dropdown)
			$ul .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$title.' <span class="caret"></span></a>';
		else
			$ul .= '<a href="#" >'.$title.'</a>';
		$ul .= '<ul'.(($dropdown)?' class="dropdown-menu"':'').'>';
		$ul .=$a.'</ul>';
		return $ul;
	}
	 /**
     * add coustom menu item
     * add add menu item in nav bar
     *
     * @param string  $item
     */
    public function add_menu_item($item)
    {
        $this->_coustom_menu_item[] = $item;
    }
	function add_menu_navbar($a){
		// Brand and toggle get grouped for better mobile display
		$brand = '
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>'
				.(($this->_brand)?'<a class="navbar-brand" href="#">'.$this->_brand.'</a>':'').
			'</div>';
		$coust = '';
		//dbug($this->_coustom_menu_item);
		if(!empty($this->_coustom_menu_item)){
	        foreach ($this->_coustom_menu_item as $item) {	          
				$coust .= $item;
	        }
	    }
	    $login = "";
	    if (!$this->SAMLauth->isAuthenticated()){
	    	$url = "";
	    	$this->SAMLauth->getLoginURL($url);
			$url = current_url();
			$r = parse_url($url);
			$endofurl = substr($r['path'], strrpos($r['path'], '/'));
			if ($endofurl === '/loggedout'){
				$loginurl= htmlspecialchars($this->SAMLauth->getLoginURL(site_url()));
			}else{
				$loginurl= htmlspecialchars($this->SAMLauth->getLoginURL());
			}
			$login = '<li><p class="navbar-btn"><a href="'.$loginurl.'" class="btn btn-primary">Log Masuk</a></p></li>';
	    }
	    else{
			$logoutUrl= htmlspecialchars(base_url('logout'));
			$login = '<li><p class="navbar-btn"><a href="'.$logoutUrl.'" class="btn btn-danger">Log Keluar</a></p></li>';
	    }
 		$login_menu = 
                '<ul class="nav navbar-nav navbar-right">'                  
                .$login     
                .'</ul>';
		$container='
			<div class="container'.(($this->_fluid)?"-fluid":"").(($this->_container_class !== "")?' '.$this->_container_class:'').'">
				<div class="collapse navbar-collapse" '.(($this->_id)?' id="'.$this->_id.'"':'').'>
					<ul class="nav navbar-nav">'
			.$a
					.'</ul>'
			.$login_menu
			.$coust
				.'</div>'
			.'</div>';
		$nav = '
			<nav class="navbar'.(($this->_nav)?' '.$this->_nav:'').'" role="navigation">'
			.$brand
			.$container
			.'</nav>';
		//$menu = sprintf($format, $a);
		return $nav;
	}
}
/* End of file Menu.php */
/* Location: ./application/libraries/Menu.php */
