<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wptest
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <div id="page" class="site">

    <header>

      <div class="row">

         <div class="twelve columns">

            <div class="logo">
               <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img alt="" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logo.png"></a>
            </div>

            <nav id="nav-wrap" class="main-navigation">
              <?php 
                 wp_nav_menu( [
	                 'theme_location'  => 'top',
	                 'container'       => 'ul', 
	                 'menu_class'      => 'nav', 
	                 'menu_id'         => 'nav',
                 ] );
              ?>   
            </nav><!-- #site-navigation -->

         </div>

      </div>

   </header> <!-- Header End -->
    