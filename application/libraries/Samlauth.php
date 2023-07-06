<?php
/**
 * CodeIgnighter simplesaml library
 *
 * v 1.0
 *
 * @author ermizal
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Samlauth {
    /**
     * ci
     *
     * @param instance object
     */
    private $_ci;
    /**
     * Auth Source from simplesaml
     *
     * @param simplesaml object
     */
    private $_SAML;
    /**
     * fail autoload
     *
     * @param string
     */
    private $_autoload;
    /**
     * Auth Source from simplesaml
     *
     * @param string
     */
    private $_authSrc;
    public function __construct()
    {
        $this->_ci =& get_instance();

        //load config jika belum.        
        if (!$this->_ci->config->item('samlauth'))
            $this->_ci->load->config('samlauth', true);

        $samlauth_config = $this->_ci->config->item('samlauth');

        $sso_fautoload = $samlauth_config['sso.autoload'];
        $sso_authSrc = $samlauth_config['sso.authsrc'];
        require_once($sso_fautoload);
        $this->_SAML = new SimpleSAML_Auth_Simple($sso_authSrc);
        if ( empty($samlauth_config['sso.kodsistem'])){
            //ambil dari $config['kodsistem']
            if (!$this->_ci->config->item('application')){
                //load config application
                $this->_ci->load->config('application',true);
            }
            //dapatkan kodsistem
            $kodsistem = $this->_ci->config->item('kodsistem','application');

            //update config
            $samlauth_config['sso.kodsistem'] = $kodsistem;
            $this->_ci->config->set_item('samlauth', $samlauth_config );
           
        }
    }
    
    function getLoginURL($url=NULL) {
        return $this->_SAML->getLoginURL($url);
    }

    function requireAuth($options=NULL) {
        return $this->_SAML->requireAuth($options);
    }

    function isAuthenticated() {
        return $this->_SAML->isAuthenticated();
    }

    function getAttributes() {
        return $this->_SAML->getAttributes();
    }

    function logout($url=NULL){
        return $this->_SAML->logout($url);
    }

    private function getKelasUrusetia(){
        // var_dump( $this->_ci);
        $db = $this->_ci->config->item('sso.dbpdata');
        $kodsistem = $this->_ci->config->item('sso.kodsistem');
        $conn = $this->_ci->load->database($db,true);
        $conn->select('ew19kdkelas');
        $conn->where('ew19kdmodul', $kodsistem); 
        $conn->where('ew19ptdbir', 1); 
        $query = $conn->get('ew19kelasmodul');
        $kelasUrusetia = array();
        foreach ($query->result() as $row)
        {
            $kelasUrusetia[] = $row->ew19kdkelas;
        }
        return $kelasUrusetia;
    }

    public function isUrusetia(){
        if (!$this->isAuthenticated()) 
            return false;
        $kelasUrusetia = $this->getKelasUrusetia();
        if (sizeof($kelasUrusetia) === 0)
            return false;
        $attr = $this->getAttributes();
        $role = $attr['ew11role'];
        return (bool) sizeof(array_intersect($role, $kelasUrusetia));
    }

    public function getUrusetiaKelas(){
         if (!$this->isAuthenticated()) 
            return NULL;
        $kelasUrusetia = $this->getKelasUrusetia();
        $attr = $this->getAttributes();
        $role = $attr['ew11role'];
        return array_values(array_intersect($role, $kelasUrusetia));
    }

    public function isTeknikal(){        
        $attr = $this->getAttributes();
        if (!isset($attr['kelasteknikal']))
            return false;
        $kelasteknikal = $attr['kelasteknikal'];
        $kodsistem = $this->_ci->config->item('sso.kodsistem');
        return in_array($kodsistem, $kelasteknikal);
    }

}