<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title>
<?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;
	wp_title( '|', true, 'right' );
	// Add the blog name.
	bloginfo( 'name' );
	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
            echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?>
</title>
<meta name='description' content='Quality Shoes, Bags, Garments and Accessories for the Stylish and Sensible Woman' />
<meta name='keywords' content='Celine, Philippines, women, woman, lady, ladies, footwear, shoes, heels, sandals, slippers, wedges, flats, ballerinas, bags, garments, apparel, clothes, dresses, accessories, quality, stylish, fashion, retail, sensible, chic' />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/style.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/reset.css" />
<link REL="SHORTCUT ICON" HREF="<?=get_template_directory_uri(); ?>/images/favicon.ico">
<script type="text/javascript" src="<?= get_template_directory_uri(); ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?= get_template_directory_uri(); ?>/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="<?= get_template_directory_uri(); ?>/js/jquery.tooltip.js"></script>
<script>!window.jQuery && document.write(unescape('%3Cscript src="<?= get_template_directory_uri(); ?>/js/jquery-1.7.1.min.js"%3E%3C/script%3E'))</script>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<!--[if lte IE 8]>
	<script src="js/ie.js"></script><![endif]-->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-33581365-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	*/
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	*/
	wp_head();
?>

<style>
body{
	background-image:url('images/image1.jpg');
	background-image:url('images/image2.jpg');
	background-image:url('images/image3.jpg');
	background-image:url('images/image4.jpg');
	background-image:url('images/image5.jpg');
	background-image:url('images/image6.jpg');
	background-image:url('images/image7.jpg');
	background-image:none;
	}
</style>
</head>
<body <?php body_class(); ?>>
<!--HEADER-->
<div id="headerWrapper">
	<header id="head">
    	<a id="logo" title="Celine" href="<?php bloginfo('url')?>/">
        	<img src="<?php bloginfo('template_url');?>/images/logo.png" />
        </a>
        <nav id="navigation">
        	<ul id="mainmenu">
                <li><a title="CLN Collections" href="#">CLN Collections</a>
                    <ul class="submenu">
                        <li><a title="Shoes" href="<?php bloginfo('url')?>/cln-collections/shoes">CLN Shoes</a></li>
                        <li><a title="Handbags" href="<?php bloginfo('url')?>/cln-collections/bags">CLN Bags</a></li>
                        <li><a title="Apparel" href="<?php bloginfo('url')?>/cln-collections/apparel">CLN Apparel</a></li>
                        <li><a title="Jewelries" href="<?php bloginfo('url')?>/cln-collections/jewelries">CLN Jewelries</a></li>
                         <li><a title="Style Guide" href="<?php bloginfo('url')?>/cln-collections/style-guide">Style Guide</a></li>
                        <li><a title="CLN Archives" href="#">Archives</a>
                        	<ul class="siblings">
                            	<li><a href="<?php bloginfo('url')?>/archives/shoes">Shoes</a></li>
                                <li><a href="<?php bloginfo('url')?>/archives/bags">HandBags</a></li>
                                <li><a href="<?php bloginfo('url')?>/archives/apparel">Apparel</a></li>
                                <li><a href="<?php bloginfo('url')?>/archives/jewelries">Jewelries</a></li>
                            </ul>
                        
                        </li>
                    </ul>
                </li>
                <li><a title="About Us" href="<?php bloginfo('url')?>/about-us">About Us</a> </li>
                <li><a title="What's New" href="<?php bloginfo('url')?>/whats-new">What's New</a>   
           <!--     <ul class="submenu">
                	 <li><a title="Promoting" href="#">Promoting</a></li>
                     <li><a title="New Stores" href="#">New Stores</a></li>
                     <li><a title="Other Announcements" href="#">Other Announcements</a></li>
                    </ul> -->
                </li>
                <li><a title="Events" href="<?php bloginfo('url')?>/events">Events</a>   
                <li><a title="Customer Service" href="<?php bloginfo('url')?>/customer-service">Customer Service </a>
					<ul class="submenu">
						<li><a title="Loyalty Program" href="<?php bloginfo('url')?>/customer-service/loyalty-program">Loyalty Program</a></li>
						<li><a title="Return & Exchange" href="<?php bloginfo('url')?>/customer-service/return-and-exchange">Return & Exchange</a></li>
						<li><a title="Mailing List" href="<?php bloginfo('url')?>/customer-service/mailing-list">Mailing List</a></li>
						<li><a title="Gift Cards" href="<?php bloginfo('url')?>/customer-service/gift-cards">Gift Cards </a></li>
					</ul>
			    </li>
                <li><a title="Store Locations" href="<?php bloginfo('url')?>/store-locations">Store Locations</a></li>
                <li><a title="Contact Us" href="<?php bloginfo('url')?>/contact-us">Contact Us</a></li>
                <li><a title="Careers" href="<?php bloginfo('url')?>/careers">Careers</a></li>
            </ul>
        </nav>
        <div class="clr"></div>
    </header>
</div>

<!--END-->