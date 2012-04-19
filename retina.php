<?php
/*
Plugin Name: Retina for WP
Plugin URI: http://www.erikknutsson.se/retina-for-wp
Description: A Simple plugin that loads diffrent images from a simple shortcode. Depending on if the screen is retina or not. The Shortcode is [retina normal="img-path" retina="img-path" width="" height="" /]
Version: 0.1.2
Author: Erik Knutsson
Author URI: http://www.erikknutsson.se
*/



function retina_detection(){
	
	print '<script>
				if(window.devicePixelRatio==2)
					var retina = 1;
				else
					var retina = 0;
				
		        var the_cookie = "retinaScreen="+retina+";"+the_cookie;
		        document.cookie = the_cookie;  
		    </script>';
}


function check_cookie(){

	
	if($_COOKIE['retinaScreen'])
		return true;
	else
		return false;
}


function shortcode_handler( $atts, $content = null ){
	extract(shortcode_atts(array(
		'retina'=>'none',
		'normal'=>'none',
		'width' => 200,
		'height' => 200), $atts ));
	
	if(check_cookie())
		return '<img width="'.esc_attr($width).'" height="'.esc_attr($height).'" src="'.esc_attr($retina).'" />';
	else
		return '<img width="'.esc_attr($width).'" height="'.esc_attr($height).'" src="'.esc_attr($normal).'" />';
	
}


add_action('wp_head','retina_detection');
add_action('init','check_cookie');
add_shortcode( 'retina', 'shortcode_handler');




