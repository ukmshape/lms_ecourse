<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');


$config['menu.kodMenu'] = null; //null untuk baca dari application['kodMenu']
$config['menu.dbmenu'] = 'ecourse';
$config['menu.menu_layout'] = 'templates/layout_menu';

//custom variable start dengan "menu._"
$config['menu._brand'] = 'CI TEMPLATE';
$config['menu._constant'] = array('var1' => 'Rumah', 'var2' => 'Utama');
