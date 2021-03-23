<?php
/**
 * wptest functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wptest
 */
//add_action( 'wp_enqueue_scripts', 'style_theme');
add_action( 'init', 'register_faq_post_type' );

//function style_theme() {
//  wp_enqueue_style( 'default', get_template_directory_uri() . '/assets/css/default.css' );
//
//}

function register_faq_post_type() {

	// Раздел вопроса - faqcat
	register_taxonomy( 'faqcat', [ 'faq' ], [
		'label'                 => 'Раздел вопроса', // определяется параметром $labels->name
		'labels'                => array(
			'name'              => 'Разделы вопросов',
			'singular_name'     => 'Раздел вопроса',
			'search_items'      => 'Искать Раздел вопроса',
			'all_items'         => 'Все Разделы вопросов',
			'parent_item'       => 'Родит. раздел вопроса',
			'parent_item_colon' => 'Родит. раздел вопроса:',
			'edit_item'         => 'Ред. Раздел вопроса',
			'update_item'       => 'Обновить Раздел вопроса',
			'add_new_item'      => 'Добавить Раздел вопроса',
			'new_item_name'     => 'Новый Раздел вопроса',
			'menu_name'         => 'Раздел вопроса',
		),
		'description'           => 'Рубрики для раздела вопросов', // описание таксономии
		'public'                => true,
		'show_in_nav_menus'     => false, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_tagcloud'         => false, // равен аргументу show_ui
		'hierarchical'          => true,
		'rewrite'               => array('slug'=>'faq', 'hierarchical'=>false, 'with_front'=>false, 'feed'=>false ),
		'show_admin_column'     => true, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
	] );

	// тип записи - вопросы - faq
	register_post_type( 'faq', [
		'label'               => 'Вопросы',
		'labels'              => array(
			'name'          => 'Вопросы',
			'singular_name' => 'Вопрос',
			'menu_name'     => 'Архив вопросов',
			'all_items'     => 'Все вопросы',
			'add_new'       => 'Добавить вопрос',
			'add_new_item'  => 'Добавить новый вопрос',
			'edit'          => 'Редактировать',
			'edit_item'     => 'Редактировать вопрос',
			'new_item'      => 'Новый вопрос',
		),
		'description'         => '',
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_rest'        => false,
		'rest_base'           => '',
		'show_in_menu'        => true,
		'exclude_from_search' => false,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'rewrite'             => array( 'slug'=>'faq/%faqcat%', 'with_front'=>false, 'pages'=>false, 'feeds'=>false, 'feed'=>false ),
		'has_archive'         => 'faq',
		'query_var'           => true,
		'supports'            => array( 'title', 'editor' ),
		'taxonomies'          => array( 'faqcat' ),
	] );

}

## Отфильтруем ЧПУ произвольного типа
// фильтр: apply_filters( 'post_type_link', $post_link, $post, $leavename, $sample );
add_filter( 'post_type_link', 'faq_permalink', 1, 2 );
function faq_permalink( $permalink, $post ){

	// выходим если это не наш тип записи: без холдера %faqcat%
	if( strpos( $permalink, '%faqcat%' ) === false )
		return $permalink;

	// Получаем элементы таксы
	$terms = get_the_terms( $post, 'faqcat' );
	// если есть элемент заменим холдер
	if( ! is_wp_error( $terms ) && !empty( $terms ) && is_object( $terms[0] ) )
		$term_slug = array_pop( $terms )->slug;
	// элемента нет, а должен быть...
	else
		$term_slug = 'no-faqcat';

	return str_replace( '%faqcat%', $term_slug, $permalink );
}

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'wptest_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wptest_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on wptest, use a find and replace
		 * to change 'wptest' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'wptest', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'wptest' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'wptest_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'wptest_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wptest_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wptest_content_width', 640 );
}
add_action( 'after_setup_theme', 'wptest_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wptest_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'wptest' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'wptest' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'wptest_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wptest_scripts() {
	wp_enqueue_style( 'wptest-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_enqueue_style( 'default', get_template_directory_uri() . '/assets/css/default.css' );
	wp_style_add_data( 'wptest-style', 'rtl', 'replace' );

    wp_enqueue_script( 'jquery' );
	
}
add_action( 'wp_enqueue_scripts', 'wptest_scripts' );

add_action( 'wp_enqueue_scripts', 'my_scripts_method' );
 м
function my_scripts_method(){
	wp_enqueue_script( 'jquery' );
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');
remove_filter('comment_text', 'wpautop');
