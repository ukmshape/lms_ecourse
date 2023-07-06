<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * default layout
 * Location: application/views/
 */
$config['template_layout'] = 'templates/layout';
/**
 * default css
 */
$config['template_css'] = array(
   // '/assets/css/index.css' => 'screen'
   //'/assets/css/sticky-footer-navbar.css' => '',
   '/assets/css/assets.css' => '',
   '/assets/css/typography.css' => '',
   '/assets/css/shortcodes/shortcodes.css' => '',
   '/assets/css/style.css' => '',
   '/assets/css/color/color-1.css' => '',
   '/assets/vendors/revolution/css/layers.css' => '',
   '/assets/vendors/revolution/css/settings.css' => '',
   '/assets/vendors/revolution/css/navigation.css' => '',


   //'/assets/vendors/switcher/switcher.css' => '',

   //'/assets/vendors/calendar/fullcalendar.css' => '',
   //'/assets/css/dashboard.css' => '',

   '/assets/DataTables/datatables.min.css'  => '',
   //'/assets/vendors/jcrop/css/jquery.Jcrop.min.css'  => '',

  // '/' => '',

);
/*
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.5/<?php echo $theme ?>/bootstrap.min.css">
*/
/**
 * default javascript
 * load javascript on header: FALSE
 * load javascript on footer: TRUE
 */
$config['template_js'] = array(
    //'/assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js' => FALSE,
    //'//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js' => TRUE,
  // '//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js' => TRUE,

    //'https://code.jquery.com/jquery-3.5.1.min.js' =>TRUE,

    '/assets/js/jquery.min.js' => TRUE,
    '/assets/vendors/bootstrap/js/popper.min.js' => TRUE,
    '/assets/vendors/bootstrap/js/bootstrap.min.js' => TRUE,
    '/assets/vendors/bootstrap-select/bootstrap-select.min.js' => TRUE,
    '/assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js' => TRUE,
    '/assets/vendors/magnific-popup/magnific-popup.js' => TRUE,
    '/assets/vendors/counter/waypoints-min.js' => TRUE,
    '/assets/vendors/counter/counterup.min.js' => TRUE,
    '/assets/vendors/imagesloaded/imagesloaded.js' => TRUE,
    '/assets/vendors/masonry/masonry.js' => TRUE,
    '/assets/vendors/masonry/filter.js' => TRUE,
    '/assets/vendors/owl-carousel/owl.carousel.js' => TRUE,
    '/assets/js/functions.js' => TRUE,
    '/assets/js/contact.js' => TRUE,
    '/assets/vendors/scroll/scrollbar.min.js' => TRUE,
    '/assets/vendors/chart/chart.min.js' => TRUE,
    //'/assets/js/admin.js' => TRUE,
    //'/assets/vendors/calendar/moment.min.js' => TRUE,
    //'/assets/vendors/calendar/fullcalendar.js' => TRUE,
    //'/assets/vendors/switcher/switcher.js' => FALSE,

    '/assets/DataTables/datatables.min.js' => TRUE,

    // '' => TRUE,

);
/**
 * default variable
 */
$config['template_vars'] = array(
    'site_description' => 'MICRO-CREDENTIAL | SIJIL PROFESIONAL | KURSUS JANGKA PENDEK',
    'site_keywords' => 'eCourse'
);
/**
 * default site title
 */
$config['base_title'] = 'eCourse';
/**
 * default title separator
 */
$config['title_separator'] = 'eCourse';
