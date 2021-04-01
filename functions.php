<?php

add_action( 'wp_enqueue_scripts', 'style_theme' );
add_action( 'wp_footer', 'scripts_theme' );
add_action( 'after_setup_theme', 'theme_register_nav_menu' );
add_action( 'widgets_init', 'theme_register_widgets' ); 
add_action( 'the_content', 'change_content' ); 
add_action( 'some_action', 'my_action' ); 
add_shortcode( 'some_short', 'my_short' ); 
add_action('init', 'my_custom_init');
add_action('init', 'my_custom_init_lala');
add_action( 'init', 'my_unregister_post_type', 999 );


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
  add_theme_support( 'title-tag' );
  add_theme_support( 'post-thumbnails', array( 'post', 'book', 'lalago' ) ); 
  add_theme_support( 'post-formats', array( 'aside', 'gallery', 'video' ) );
  add_image_size( 'mytheme-mini', 1300, 500, true );
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

function change_content($content) {
  $content.= '<br> Спасибо что умеете читать!';
  return $content;
}

function my_action() {
  echo 'my action text';
}

function my_short() {
  return 'Short text';
}

function my_custom_init(){
	register_post_type('book', array(
		'labels'             => array(
			'name'               => 'Портфолио', // Основное название типа записи
			'singular_name'      => 'Портфолио', // отдельное название записи типа Book
			'add_new'            => 'Добавить работу',
			'add_new_item'       => 'Добавление работы',
			'edit_item'          => 'Редактирование работы',
			'new_item'           => 'Новая работа',
			'view_item'          => 'Смотреть работу',
			'search_items'       => 'Искать работу в портфолио',
			'not_found'          => 'Не найдено',
			'not_found_in_trash' => 'Не найдено',
			'parent_item_colon'  => '',
			'menu_name'          => 'Портфолио'
		  ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title','editor','author','thumbnail','excerpt','comments')
	) );
}


function my_custom_init_lala(){
	register_post_type('lala', array(
		'labels'             => array(
			'name'               => 'Laala', // Основное название типа записи
			'singular_name'      => 'Laaala', // отдельное название записи типа Book
			'add_new'            => 'Добавить новую',
			'add_new_item'       => 'Добавить новую книгу',
			'edit_item'          => 'Редактировать книгу',
			'new_item'           => 'Новая книга',
			'view_item'          => 'Посмотреть книгу',
			'search_items'       => 'Найти книгу',
			'not_found'          => 'Книг не найдено',
			'not_found_in_trash' => 'В корзине книг не найдено',
			'parent_item_colon'  => '',
			'menu_name'          => 'Laala'

		  ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title','editor','author','thumbnail','excerpt','comments')
	) );
}

function my_unregister_post_type(){
	unregister_post_type('lala');
}



remove_filter ('the_content', 'wpautop', 10);
remove_filter ('comment_text', 'wpautop', 10);
// Remove auto formatting
remove_filter('the_content', 'wptexturize', 10);
remove_filter('comment_text', 'wptexturize', 10);
remove_filter('the_title', 'wptexturize', 10);

add_filter('the_content','replace_content', 999999999);

function replace_content($content) {
  $content = htmlentities($content, null, 'utf-8');
  $content = str_replace("&nbsp;", " ", $content);
  $content = html_entity_decode($content);
  return $content;
    }

add_filter( 'excerpt_length', function(){
	return 20;
} );
add_filter('navigation_markup_template', 'my_navigation_markup_template');
function my_navigation_markup_template() {
  return '
  <nav class="navigation %1$s" role="navigation">
    <div class="nav-links">%3$s</div>
  </nav>';
}
