<?php

add_action( 'wp_enqueue_scripts', 'style_theme' );
add_action( 'wp_footer', 'scripts_theme' );
add_action( 'after_setup_theme', 'theme_register_nav_menu' );

function style_theme() {
  wp_enqueue_style('main-style', get_stylesheet_uri());
  wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/default.css');
}

function scripts_theme() {
  wp_deregister_script( 'jquery-core' );
  wp_register_script( 'jquery-core', '//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
  wp_enqueue_script( 'jquery' );
  wp_enqueue_script( 'doubletaptogo', get_template_directory_uri() . '/assets/js/doubletaptogo.js' );
  wp_enqueue_script( 'init', get_template_directory_uri() . '/assets/js/init.js' );
  wp_enqueue_script( 'slider', get_template_directory_uri() . '/assets/js/jquery.flexslider.js' );
}

function theme_register_nav_menu() {
	register_nav_menu( 'top', 'Меню в шапке' );
}
