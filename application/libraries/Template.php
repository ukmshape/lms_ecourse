<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Template Layout library
 *
 * @package     CodeIgniter
 * @author      Bo-Yi Wu <appleboy.tw@gmail.com>
 * @link        https://github.com/appleboy/CodeIgniter-Template
 */
class Template
{
    /**
     * ci
     *
     * @param instance object
     */
    private $_ci;
    /**
     * data
     *
     * @param array
     */
    private $_data = array();
    /**
     * layout
     *
     * @param string
     */
    private $_layout;
    /**
     * Scripts
     *
     * @param array
     */
    private $_scripts_header = array();
    private $_scripts_footer = array();
    /**
     * Styles
     *
     * @param array
     */
    private $_styles = array();
    /**
     * Site title
     *
     * @param string
     */
    private $_base_title;
    /**
     * Site title segmen
     *
     * @param array
     */
    private $_title_segments = array();
    
    /**
     * Site title separator
     *
     * @param string
     */
    private $_title_separator;
    /**
     * Site meta tag
     *
     * @param array
     */
    
    private $_meta_tags = array();

    /**
     * constructor
     *
     * @param string $config
     */
    
    private $_saml;

    public function __construct($config = array())
    {
        $this->_ci = get_instance();
        $this->_ci->load->helper('html');
        //log_message('debug', 'Tempalte Class Initialized');
        empty($config) OR $this->initialize($config);
        // $this->_base_title = $base_title;
    }

    /**
     * initialize
     *
     * @param array $config
     */
    public function initialize($config)
    {
        $this->_layout = $config['template_layout'];
        foreach ($config as $key => $val) {
            if ($key == 'template_layout' AND $val != '') {
                $this->_layout = $val;
                continue;
            }
            if ($key == 'template_css' AND $val != '') {
                //add css
                foreach ($config['template_css'] as $href => $media) {


                    if (((strtolower(substr($href, 0, 4)) === 'http') OR (substr($href, 0, 2) === '//')))
                        $href = $href;
                    else
                        $href = base_url($href);

                    $this->add_css($href, $media);
                }
                continue;
            }
            if ($key == 'template_js' AND $val != '') {
                //add js
                foreach ($config['template_js'] as $src => $value) {    
                    if (!(strtolower(substr($src, 0, 4)) === 'http' OR substr($src, 0, 2) === '//'))
                        $src = base_url($src);
     
                    $this->add_js($src, $value);
                }
                continue;
            }
            if ($key == 'template_vars' AND $val != '') {
                //add var
                foreach ($config['template_vars'] as $key => $val) {
                    $this->set($key, $val);
                }
                continue;
            }
            


            if ($key === 'base_title' AND $val === '') {               
                if (!$base_title = $this->_ci->config->item('base_title')){
                    $this->_ci->load->config('application',true);
                    $base_title = $this->_ci->config->item('base_title','application');
                }
                $this->{'_'.$key} = $base_title;
                continue;
            }
            $this->{'_'.$key} = $val;
        }

        if ((isset($this->base_title) && empty($this->base_title)) OR (!isset($this->base_title)) ){
            $application_file = APPPATH.'config/application.php';
            
            if (file_exists($application_file))
            {
                $this->_ci->load->config('application',true);
                $base_title = $this->_ci->config->item('base_title','application');

                $app_title = $this->_ci->config->item('application','application');
                $lang = str_replace('_', '-', $this->_ci->config->item('language'));
                if (!empty($base_title))
                    $this->_base_title = $app_title['name'][$lang];
            }
        }
    }

    /**
     * Overloading __set() is run when writing data to inaccessible properties.
     */
    public function __set($name, $value)
    {
        $this->_data[$name] = $value;
    }

    /**
     * Overloading __get() is utilized for reading data from inaccessible properties.
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->_data)) {
            return $this->_data[$name];
        }
        return null;
    }

    /**
     * Overloading __isset() is triggered by calling isset() or empty() on inaccessible properties.
     */
    public function __isset($name)
    {
        return isset($this->_data[$name]);
    }

    /**
     * Overloading __unset() is invoked when unset() is used on inaccessible properties.
     */
    public function __unset($name)
    {
        unset($this->_data[$name]);
    }

    /**
     * Add a meta tag
     *
     * @param string $name
     * @param string $content
     */
    public function add_meta_tag($name, $value, $key = "name")
    {
        if ($name == 'canonical') {
            $this->_meta_tags[] = '<link rel="canonical" href="' . $value . '" />';
        } else {
            $this->_meta_tags[] = '<meta ' . $key . '="' . $name . '" content="' . $value . '" />';
        }
        return $this;
    }

    /**
     * Add a title segment
     *
     * @param string $segmentf
     */
    public function add_title_segment($segment)
    {
        $this->_title_segments[] = $segment;
        return $this;
    }

    /**
     * Set the base title
     *
     * @param string $base_title
     */
    public function set_base_title($base_title)
    {
        $this->_base_title = $base_title;
        return $this;
    }

    /**
     * Set the title separator
     *
     * @param string $title_separator
     */
    public function set_title_separator($title_separator)
    {
        $this->_title_separator = $title_separator;
        return $this;
    }
    /**
     * set layout
     *
     * @param string $layout
     */
    public function set_layout($layout)
    {
        $this->_layout = $layout;
        return $this;
    }

    /**
     * Allows you to set a custom variable to be accessed in your template file.
     *
     * @param string $name
     * @param mixed  $data
     */
    public function set($name, $data)
    {
        $this->_data[$name] = $data;
        return $this;
    }

    /**
     * add css
     *
     * @param  string $path
     * @param  string $media
     * @return void
     */
    public function add_css($href = NULL, $media = 'screen')
    {
        $href = ltrim($href, "/");
        $link = array(
            'href' => $href,
            'rel' => 'stylesheet',
            'type' => 'text/css'
        );
        if (!empty($media)) {
            $link['media'] = $media;
        }
        $this->_styles[] = link_tag($link);
    }

    /**
     * add js
     * add script on header or footer (before </body>)
     *
     * @param string  $src
     * @param boolean $is_footer
     */
    public function add_js($src, $is_footer = FALSE)
    {
        if (!$is_footer) {
            $this->_scripts_header[] = $this->script_tag($src);
        } else {
            $this->_scripts_footer[] = $this->script_tag($src);
        }
    }
   
    /**
     * script_tag
     *
     * Generates an javascript heading tag. First param is the data.
     *
     * @access private
     * @param  string
     * @return string
     */
    private function script_tag($src = NULL)
    {
        if (isset($src) and !empty($src)) {
            return '<script src="' . $src . '" type="text/javascript"></script>';
        }
        return "";
    }

    /**
     * render
     *
     * @param  string  $view
     * @param  array   $data
     * @param  boolean $return
     * @return string
     */
    public function render($view='index', $data = array(), $return = FALSE)
    {
        // check $data is array()
        if (!is_array($data)) {
            $data = array();
        }
        // merge template variable
        $data = array_merge($data, $this->_data);
        $this->set('meta_tag', implode("\r\n", $this->_meta_tags) . "\r\n");
        $this->set('styles', implode("\r\n", $this->_styles) . "\r\n");
        $this->set('scripts_header', implode("\r\n", $this->_scripts_header) . "\r\n");
        $this->set('scripts_footer', implode("\r\n", $this->_scripts_footer) . "\r\n");
        $this->set('lang', str_replace('_', '-', $this->_ci->config->item('language')));
        $this->set('meta_charset', strtolower($this->_ci->config->item('charset')));
        $this->set('content', $this->_ci->load->view($view, $data, TRUE));

        // handle site title
        $this->_data['site_title'] = '';
        if (count($this->_title_segments) > 0) {
            $this->_data['site_title'] .= implode($this->_title_separator, array_reverse($this->_title_segments)) . $this->_title_separator;
        }
        $this->_data['site_title'] .= $this->_base_title;
        $this->_data['base_title'] = $this->_base_title;

        //check if menu is loaded
        if ($this->_ci->load->is_loaded('menu')){            
            $this->_data['menu_apps'] = $this->_ci->menu->getMenu();

        }

        if ($return === TRUE) {
            $out = $this->_ci->load->view($this->_layout, $this->_data, $return);
            return $out;
        }
        $this->_ci->load->view($this->_layout, $this->_data);
    }

    
    // private function get_menu(){
        // $application = $this->_ci->config->item('application');
        // $brand = $application['name'];
        // $this->_ci->load->library('menu',array("brand"=>$brand,"navbar_class"=>"navbar-inverse navbar-fixed-top"));
        // if ($this->_ci->config->item('app.theme_enabled')){
        //     $theme = "default";
        //     if (!empty($_COOKIE['theme-saraan']))
        //       $theme = $_COOKIE['theme-saraan'];
        //     $themes = '';
        //     foreach ($this->_ci->config->item('app.themes') as $key => $value) {
        //         $themes .= '<li '.(($theme===$key)?'class="active"':"").'><a href="#" data-theme="'.$key.'" class="theme-link">'.$value['label'].'</a></li>';
        //     }
        //     $coustom_menu = 
        //         '<ul class="nav navbar-nav navbar-right">
        //             <li class="dropdown">
        //                 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Themes <b class="caret"></b></a>
        //                 <ul class="dropdown-menu">
        //                     '.$themes.'
        //                 </ul>
        //             </li>
        //         </ul>';
        //     $this->_ci->menu->add_menu_item($coustom_menu);
        // }
     
    //     $menu = $this->_ci->menu->getMenu();
    //     return $menu;
    // }
}
