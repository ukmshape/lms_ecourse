<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class MY_Loader extends CI_Loader {
 
    /**
     * Database Loader
     *
     * @access    public
     * @param    string    the DB credentials
     * @param    bool    whether to return the DB object
     * @param    bool    whether to enable active record (this allows us to override the config setting)
     * @return    object
     */
    public function database($params = '', $return = FALSE, $query_builder = NULL)
    {
        // Grab the super object
        $CI =& get_instance();
        // Do we even need to load the database class?
        if ($return === FALSE && $query_builder === NULL && isset($CI->db) && is_object($CI->db) && ! empty($CI->db->conn_id))
        {
            return FALSE;
        }
        require_once(BASEPATH.'database/DB.php');
        // START custom >>>>>>>>>>>>>>>>>>>>>>>>>>
        // Check for a subdriver
        // Load the DB class
        $db =& DB($params, $query_builder);
        if ( ! empty($db->subdriver))
        {
            // Load extended DB driver
            $custom_db_driver = config_item('subclass_prefix').'DB_'.$db->dbdriver.'_'.$db->subdriver.'_driver';
            $custom_db_driver_file = APPPATH.'libraries/MY_DB_'.$db->dbdriver.'_'.$db->subdriver.'_driver.php';
            if (file_exists($custom_db_driver_file))
            {
                require_once($custom_db_driver_file);     
                $db = new $custom_db_driver(get_object_vars($db));
                if ($return === TRUE)
                    return $db;
            }
        }
        // END custom >>>>>>>>>>>>>>>>>>>>>>>>>>
        if ($return === TRUE)
        {
            return $db;
        }
        // Initialize the db variable. Needed to prevent
        // reference errors with some configurations
        $CI->db = '';
        // Load the DB class
        $CI->db = $db;
        return $this;
    }


    //ermizal
    public function get_loaded_lib()
    {
        $ignore_lib = array('benchmark','hooks','config','log','utf8','uri','router','output','security','input','lang','loader');
        $loaded_lib = array();
        foreach ($this->_ci_classes as $key => $value) {
            if (!in_array($key, $ignore_lib))
                $loaded_lib[] = $key;
        }
        return $loaded_lib;
    }

    //ermizal
    public function isloaded_lib($lib)
    {
        return (array_key_exists ($lib, $this->_ci_classes));
    }

    public function get_loaded_helper()
    {
        $ignore_helper = array();
        $loaded_helper = array();
        foreach ($this->_ci_helpers as $key => $value) {
            if (!in_array($key, $ignore_helper))
                $loaded_helper[] = $key;
        }
        return $loaded_helper;
    }
 
}