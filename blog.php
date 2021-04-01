<?php
/*
Template Name: Blog
*/
?>

<?php get_header(); ?>
<!-- Page Title
   ================================================== -->
   <div id="page-title">

      <div class="row">

         <div class="ten columns centered text-center">
            <h1>Our Blog<span>.</span></h1>

            <p>Aenean condimentum, lacus sit amet luctus lobortis, dolores et quas molestias excepturi
            enim tellus ultrices elit, amet consequat enim elit noneas sit amet luctu. </p>
         </div>

      </div>

   </div> <!-- Page Title End-->

   <!-- Content
   ================================================== -->
   <div class="content-outer">

      <div id="page-content" class="row">

      <p>blog</p>

         <div id="primary" class="eight columns">

         <?php
            // параметры по умолчанию
            $posts = get_posts( array(
	            'numberposts' => 3,
	            'category'    => 0,
	            'post_type'   => 'post',
	            'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
            ) );

            foreach( $posts as $post ){
	            setup_postdata($post);
            ?>

            <article class="post">

               <div class="entry-header cf">

                  <h1><a href="<?php the_permalink() ?>" title=""><?php the_title(); ?></a></h1>

                  <p class="post-meta">

                     <time clas
                     s="date" datetime="2014-01-14T11:24"><?php the_time('F jS, Y') ?></time>
                     /
                     <span class="categories">
                        <?php the_tags( '', ' / ' ); ?>
                     </span>

                  </p>

               </div>

               <div class="post-thumb">
                  <a href="<?php the_permalink() ?>" title=""><?php the_post_thumbnail( 'mytheme-mini' ) ?></a>
               </div>

               <div class="post-content"><?php the_excerpt(); ?></div>

            </article>

            <?php the_posts_pagination(); ?>

            <?php
            }

            wp_reset_postdata(); // сброс
         ?>
         <?php the_posts_pagination(); ?>

         </div> <!-- Primary End-->

         <div id="secondary" class="four columns end">

            <?php dynamic_sidebar('right-sidebar'); ?>

         </div> <!-- Secondary End-->

      </div>

   </div> <!-- Content End-->

   <!-- Tweets Section
   ================================================== -->
   <section id="tweets">

      <div class="row">

         <div class="tweeter-icon align-center">
            <i class="fa fa-twitter"></i>
         </div>

         <ul id="twitter" class="align-center">
            <li>
               <span>
               This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet.
               Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum
               <a href="#">http://t.co/CGIrdxIlI3</a>
               </span>
               <b><a href="#">2 Days Ago</a></b>
            </li>
            <!--
            <li>
               <span>
               This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet.
               Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum
               <a href="#">http://t.co/CGIrdxIlI3</a>
               </span>
               <b><a href="#">3 Days Ago</a></b>
            </li>
            -->
         </ul>

         <p class="align-center"><a href="#" class="button">Follow us</a></p>

      </div>

   </section> <!-- Tweets Section End-->

   <?php get_footer(); ?> 