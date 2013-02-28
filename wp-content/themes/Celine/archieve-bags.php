<?php

/*

Template Name: Archive Bags

*/

?>

<?php

/**

 * The main template file.

 *

 * This is the most generic template file in a WordPress theme

 * and one of the two required files for a theme (the other being style.css).

 * It is used to display a page when nothing more specific matches a query.

 * E.g., it puts together the home page when no home.php file exists.

 * Learn more: http://codex.wordpress.org/Template_Hierarchy

 *

 * @package WordPress

 * @subpackage Twenty_Eleven

 */



get_header(); ?>



<!--CONTENT-->

<div id="contentWrapper1">
	<div class="wrap">

    	<?php if(function_exists(simple_breadcrumb)) {simple_breadcrumb();} ?>
        <div id="listProduct">
        	<div class="prodWrapper">
                     <?php query_posts( array( 'cat' => 5, 'order'=> 'ASC', 'paged' => get_query_var('paged') ) ); ?>
					  <?php if ( $wp_query->have_posts() ) : ?>
                        <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                          	<a href="#" rel="<?php echo get_the_id(); ?>" class="changeImage tooltip">
                                  <?php the_post_thumbnail('thumbnail','title='.trim(strip_tags( $attachment->post_title ))); ?>
                                     <span>
                                        <?php the_title();?>
                                     </span>
                             </a>  
                             <?php endwhile;?>
                             <?php endif; ?>                              
					<div class="clr"></div>
            </div>     
                      <?php query_posts( array( 'cat' => 5, 'order'=> 'ASC', 'paged' => get_query_var('paged') ) ); ?>
					  <?php if ( $wp_query->have_posts() ) : ?>
                        <?php $i=0; while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                                <div id="item<?php echo get_the_id(); ?>"  class="items" <?php echo ( ($i!=0)?'style="display:none;"':'' );?>>
										 <?php the_post_thumbnail('large'); ?>
                                    <div class="desc">
                                         <h2> <?php the_title(); ?></h2>
                                         <?php the_excerpt(); ?>
                                    </div>
                                </div>
                         <?php $i++; endwhile;?>
                         <?php endif; ?>
                       <?php twentyeleven_content_nav( 'nav-below' ); ?> 	           
        </div>
        <div class="clr"></div>
    </div>
</div>
<!--END-->	

<?php get_footer(); ?>