<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Phpinfo extends CI_Controller {

    public function __construct() {
    }

    public function index() {
        phpinfo();
    }
}