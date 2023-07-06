<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu
{
	protected $_ci;
    protected $_brand;
    // protected $_fluid = true;
    // protected $_nav = 'navbar-default';
    // protected $_id;
    // protected $_container_class="";
    protected $_db_menu;
    protected $_kodmenu;
    protected $_kelasteknikal;
    protected $_menu_config;
	// protected $SAMLauth;
    /**
     * Coustom menu item
     *
     * @param string
     */
    // private $_coustom_menu_item = array();
    private $_eligible_menus = array();
    // private $_verify_menu_lvl = 1;
	public function __construct($param=array())
	{
        $this->_ci =& get_instance();
    	$this->_ci->config->load('menu', TRUE);
    	
    	$_menu_config = $this->_ci->config->item('menu');
    	if (empty($_menu_config['menu.kodMenu'])){
    		//ambil dari $config['kodsistem']
            if (!$this->_ci->config->item('application')){
                //load config application
                $this->_ci->load->config('application',TRUE);
            }
            
            //dapatkan kodmenu
            $kodMenu = $this->_ci->config->item('kodMenu');
            
            // //update config
            // $menu_config['menu.kodMenu'] = $kodMenu;
            // $this->_ci->config->set_item('menu', $menu_config );
    	}else{
    		//ambil dari $config['kodsistem']
    		$kodMenu = $_menu_config['menu.kodMenu'];
    	}


    	// if (empty($menu_config['menu.brand'])){
    	// 	//dapatkan kodmenu
     //        $kodsistem = $this->_ci->config->item('kodsistem','application');
     //        //update config
     //        $menu_config['menu.brand'] = $kodsistem;
     //        $this->_ci->config->set_item('menu', $menu_config );
    	// }
		$db_profile = $_menu_config['menu.dbmenu'];
		$this->_kodmenu = $kodMenu;		
		// $this->_kodmenu = $menu_config['menu.kodMenu'];		
        $this->_kelasteknikal = $this->_ci->config->item('kelasteknikal');
        $this->_db_menu = $this->_ci->load->database($db_profile,TRUE);
        $this->_menu_config = $_menu_config;
        //$this->_ci->load->library('Samlauth');
       	// if (!empty($param)){
        // 	$this->setInit($param);
        // }  
        if ($this->_ci->session->userdata('is_logged_in'))
        	$this->getdata();
          
	}
	
	// public function setInit($param=array()){        
        // $db_profile = $this->ci->config->item('app.dbmenu');
        // $this->_db_menu = $this->ci->load->database($db_profile,true);
        
        // if(isset($param['brand']))
        // 	$this->_brand = $param['brand'];
        // if(isset($param['fluid']))
        // 	$this->_fluid = $param['fluid'];
        // if(isset($param['navbar_class']))
        // 	$this->_nav = $param['navbar_class'];
        // if(isset($param['id']))
        // 	$this->_id = $param['id'];
        // if(isset($param['container_class']))
        // 	$this->_container_class = $param['container_class'];
	// }

	private function getData(){
		if (empty($this->_kodmenu) OR is_null($this->_kodmenu))
			return array();

		$kodmenu = $this->_kodmenu;

 		if ($this->_ci->samlauth->isAuthenticated()){			
	        //guna session
	        //$attr = $this->_ci->samlauth->getAttributes();
	        $session = $this->_ci->session->all_userdata();
	        $role = array();
	        if (array_key_exists('ew11role', $session))
	        	$role = array_merge($role, $session['ew11role']);
	        
	        if (array_key_exists('kelasteknikal', $session))
	        	$role = array_merge($role, $session['kelasteknikal']);
	        // if (array_key_exists('flag_teknikal', $session)){
	        	//if (!empty($this->_kelasteknikal))
	        	// if (!empty($this->_kelasteknikal))
	        	if (!empty($session['flag_teknikal']))
	        		$role[] =  $this->_kelasteknikal;
	        	
	        // }
	        
	        //$role = array_merge($attr['ew11role'],$attr['kelasteknikal']);
			$kelas = "";
	        if (sizeof($role))
	        	$kelas = " AND ( menu002.kelas IN ('".implode('\',\'',$role)."') ) ";
	        else
	        	$kelas = " AND ( 0 = 1) ";
			$sql = sprintf("SELECT DISTINCT menu001.idmenu,   
			 		menu001.menu,   
			 		menu001.tajuk,   
			 		menu001.jnsfail,   
			 		menu001.namafail,   
			 		menu001.induk,   
			 		menu001.susunan, 
			 		menu001.aras,
			 		menu001.target,
			 		NVL(menu001.target,'') AS target,
			 		NVL(menu001.faicon,'') AS faicon,
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
			 		NVL(menu001.target,'') AS target,
			 		NVL(menu001.faicon,'') AS faicon,
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
		$result = $this->_db_menu->query($sql)
								->result_array();
		if ($this->_ci->samlauth->isAuthenticated())
			$this->_eligible_menus = $result;
		return $result;
	}
	public function get_eligible_menu($value='')
	{
		if ($this->_ci->session->userdata('uid') != $this->_ci->session->userdata('id') )
				$this->getData();
		return $this->_eligible_menus;
	}
	public function menu_tree()
	{
		if ($this->_ci->session->userdata('uid') != $this->_ci->session->userdata('id') )
				$this->getData();
		$q_menuData = $this->_eligible_menus;
		
		$tree = array();
		$nodeList = array();
		foreach ($q_menuData as $row) {			
			$nodeList[$row['idmenu']] = array_merge($row, array('children' => array()));
		}
		foreach ($nodeList as $nodeId => &$node) {
		    if (!$node['induk'] ) {
		        $tree[] = &$node;
		    } else {
		    	if (array_key_exists($node['induk'], $nodeList))
		        	$nodeList[$node['induk']]['children'][] = &$node;
		    }
		}
		unset($node);
		unset($nodeList);
		return $tree;
	}

	public function getMenu($tree = array()){
		if (empty($tree)){
			$tree = $this->menu_tree();
		}
		$menu = $this->menuHTML($tree);
		return $menu;
	}

	function menuHTML($array){
		// $menu_config = $this->_ci->config->item('menu');

		$menu_layout = $this->_menu_config['menu.menu_layout'];
		$_param = array('menutree'=>$array);

		foreach ($this->_menu_config as $key => $value) {
			if (substr($key, 0, 6) === 'menu._')
				$_param[substr($key, 5)] = $value;
		}

        $menu_str = $this->_ci->load->view($menu_layout, $_param, true);

        return $menu_str;
	}


	//security
	public function set_verify_menu_lvl($level = NULL)
	{
		if (!is_null($level))
			$this->_verify_menu_lvl = $level;
	}
	public function is_eligible($segment = NULL, $verify_lvl = NULL)
	{
		if (!is_null($verify_lvl))
			$this->set_verify_menu_lvl($verify_lvl);
		if(is_null($segment)){			
			$menu['controller'] = strtolower($this->_ci->uri->segment(1));
			$menu['method'] = strtolower($this->_ci->uri->segment(2));
		}
		else{
			$menuitem_namafail = explode("/", strtolower(trim($segment, ' \/')));
			$menu['controller'] = (isset($menuitem_namafail[0]))?$menuitem_namafail[0]:'';
			$menu['method'] = (isset($menuitem_namafail[1]))?$menuitem_namafail[1]:'';
		}
		if ($this->_ci->session->userdata('uid') != $this->_ci->session->userdata('id') )
			$this->getData();
		$menuData = $this->_eligible_menus;
		$verify_sts = false;
		foreach ($menuData as $menuitem) {
			$menuitem_namafail = explode("/", strtolower(trim($menuitem['namafail'], ' /')));
			if ($this->_verify_menu_lvl === 1){
				if ( (isset($menuitem_namafail[0]) ) && ($menuitem_namafail[0] === $menu['controller'] )){
					$verify_sts = true;
					break;
				}
			}
			elseif($this->_verify_menu_lvl === 2){
				if ( (isset($menuitem_namafail[0]) ) && 
						(isset($menuitem_namafail[1]) ) && 
						($menuitem_namafail[0].'/'.$menuitem_namafail[1] === $menu['controller'].'/'.$menu['method'] )){
					$verify_sts = true;
					break;
				}
			}
		}
		return $verify_sts;
	}
}
/* End of file Menu.php */
/* Location: ./application/libraries/Menu.php */
