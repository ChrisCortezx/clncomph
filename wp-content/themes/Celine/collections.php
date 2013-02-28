<?php
/*
Template Name: Collections
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
    	<div id="mainProduct">
        	<div id="holder">
           	<img src="<?= get_template_directory_uri(); ?>/images/bigBag.png"/>
                <h2>Celine lauggage bag</h2>
            </div>
        </div>
        <div id="listProduct">
        	<div class="prodWrapper">
                     <?php query_posts( array( 'cat' => 13,'order' => 'ASC', 'paged' => get_query_var('paged') ) ); ?>
					  <?php if ( $wp_query->have_posts() ) : ?>
                        <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                          	<a rel="facebox" href="#inline<?php echo get_the_id(); ?>">
                                 <div class="item">
                                  <?php the_post_thumbnail('thumbnail'); ?>
                                     <div class="tooltip_description" style="display:none" >
                                        <h3><?php the_title();?></h3>
                                        <p><?php the_excerpt();?></p>
                                     </div>
                                 </div>
                             </a>
                            <div id="inline<?php echo get_the_id(); ?>" style="width:400px; height:100px; overflow:auto; display: none;">
                                <h1><?php the_title();?></h1>
                                <?php the_content();?>
                         	 </div>
                        <?php endwhile;?>
                        <?php endif; ?>
					<div class="clr"></div>
            </div>
             <?php twentyeleven_content_nav( 'nav-below' ); ?>
        </div>
            </div>
            
        </div>
    </div>
</div>

<!--END-->	
<?php get_footer(); ?>