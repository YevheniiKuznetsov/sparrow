<?php get_header(); ?>

<div id="page-title">

      <div class="row">

         <div class="ten columns centered text-center">
            <h1>Our Amazing Works<span>.</span></h1>

            <p>Aenean condimentum, lacus sit amet luctus lobortis, dolores et quas molestias excepturi
            enim tellus ultrices elit, amet consequat enim elit noneas sit amet luctu. </p>
         </div>

      </div>

   </div> <!-- Page Title End-->

   <!-- Content
   ================================================== -->
   <div class="content-outer">

      <div id="page-content" class="row portfolio">

         <section class="entry cf">

            <div id="secondary"  class="four columns entry-details">

                  <h1><?php the_title(); ?></h1>

                  <div class="entry-description">

                     <?php the_field('project_description'); ?>

                  </div>

                  <ul class="portfolio-meta-list">
						   <li><span>Date: </span><?php the_field('project_date'); ?></li>
						   <li><span>Client </span><?php the_field('client'); ?></li>
						   <li><span>Skills: </span><?php the_field('skills'); ?></li>
						   <li><span>Skills: </span><?php the_terms( get_the_ID(), 'skills', '', '/', '' ); ?></li>
				      </ul>

                  <a class="button" href="http://behance.net">View project</a>

            </div> <!-- secondary End-->

            <div id="primary" class="eight columns">

               <div class="entry-media">

                  <?php the_post_thumbnail( 'mytheme-mini' ) ?>

                  <img src="<?php the_field('project_photo'); ?>" alt="image">

               </div>

               <div class="entry-excerpt">

                <?php the_post(); ?>
                <?php the_content(); ?>

					</div>

            </div> <!-- primary end-->

         </section> <!-- end section -->

         <ul class="post-nav cf">
			   <li class="prev"><a href="#" rel="prev"><strong>Previous Entry</strong> Duis Sed Odio Sit Amet Nibh Vulputate</a></li>
				<li class="next"><?php next_post_link('%link', 'Следующая статья из категории', true); ?></li>
            <?php echo get_next_post_link( '%link', '%title →','', 'post' ); ?>
            <?php 
            
            if( get_adjacent_post(false, '', true) ) { 
	previous_post_link('%link', '← Previous Post');
}
else { 
	$first = new WP_Query('posts_per_page=1&order=DESC');
	$first->the_post();

	echo '<a href="' . get_permalink() . '">← Предыдущий пост</a>';

	wp_reset_postdata();
}; 

if( get_adjacent_post(false, '', false) ) { 
	next_post_link('%link', 'Next Post →');
}
else { 
	$last = new WP_Query('posts_per_page=1&order=ASC');
	$last->the_post();

	echo '<a href="' . get_permalink() . '">Следующий пост →</a>';

	wp_reset_postdata();
}; 


            ?>
			</ul>

      </div>

   </div> <!-- content End-->

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

   </section> <!-- Tweet Section End-->

<?php get_footer(); ?>