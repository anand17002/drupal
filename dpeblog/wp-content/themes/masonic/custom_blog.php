<?php
/**
 *Template Name: Custom Blog Name
 * Theme Page Section for our theme.
 *
 * @package ThemeGrill
 * @subpackage Masonic
 * @since 1.0
 */
?>

<?php get_header(); ?>

<div class="site-content">
   <div id="container" class="wrapper clear">
      <div class="primary">

       <?php 
         $args = array( 'post_type' => 'Topics', 'posts_per_page' => 10 );
         $the_query = new WP_Query( $args ); 
         ?>
         <?php if ( $the_query->have_posts() ) : ?>
         <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
         <h2><?php the_title(); ?></h2>
         <div class="entry-content">
         <?php the_content(); ?> 
         </div>
         <?php wp_reset_postdata(); ?>
         <?php elseL: ?>
         <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
         <?php endif; ?>
      </div>
      <?php get_sidebar(); ?>
   </div><!-- #container -->
</div><!-- .site-content -->

<?php get_footer(); ?>