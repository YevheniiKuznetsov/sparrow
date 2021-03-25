<?php

add_action( 'wp_enqueue_scripts', 'style_theme' );
add_action( 'wp_footer', 'scripts_theme' );
add_action( 'after_setup_theme', 'theme_register_nav_menu' );
add_action( 'widgets_init', 'theme_register_widgets' );

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
  register_nav_menus( [
		'top' => 'Меню в шапке',
		'footer' => 'Меню в подвале'
	] );
}

function theme_register_widgets() {
  register_sidebar( array(
		'name' => "Правая боковая панель сайта",
		'id' => 'right-sidebar',
		'description' => 'Эти виджеты будут показаны в правой колонке сайта',
    'before_widget' => '<div class="homepage-widget-block">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="widgettitle">',
		'after_title' => '</h5>',
	) );
}
