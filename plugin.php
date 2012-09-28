<?php
/*
Plugin Name: WP Front Admin
Plugin URI:  http://www.sorcode.com
Description: Description
Version:     1.0 
Author:      Santiago Pérex
Author URI:  http://rivenvir.us
License:     GPL2


/*  

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

define('WP_FRONT_ADMIN', '1.0');

define('WP_FRONT_ADMIN_URL', plugin_dir_url(__FILE__));
define('WP_FRONT_ADMIN_PLUGIN_PATH', plugin_dir_path(__FILE__));


/**
* Front End Admin Class
*/
class WPFrontAdmin{
	
	function WPFrontAdmin(){				
		//$this->page_templates();
		$this->shortcodes();
		add_action('template_redirect', array($this,'detect_shorcodes')); 
	}

	
	function detect_shorcodes() { 
	   global $wp_query; 
	   if ( is_singular() ) { 
	      $post = $wp_query->get_queried_object(); 
	      if ( false !== strpos($post->post_content, '[wp-front-admin-login') ) { 
				add_filter( 'page_template', array($this,'page_template_login') );         
	      } 
	   } 
	} 	
	
	function shortcodes(){
		add_shortcode('wp-front-admin-login', array($this,'shorcode_login'));
	}

	function shorcode_login(){
		echo "FRONT ADMIN";
	}

	function page_template_login( $page_template )
	{
	    //if ( is_page( 'wp-front-admin-login' ) ) {
	        $page_template = WP_FRONT_ADMIN_PLUGIN_PATH. '/views/login.php';
	    //}
	    return $page_template;
	}	
}

$ObjWPFrontAdmin = new WPFrontAdmin();