<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package eltl5esbookskw
 */

get_header();
?>

	<main id="primary" class="site-main mainHome container">
		<?php get_template_part( 'template-parts/main-hero'); ?>

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) {
				?>
				<div class="shopNowContainer">
					<h4 style="font-family: Araboto-bold;"><?php single_post_title(); ?></h4>
				</div>
				<?php
			}elseif( is_shop() ){
				?>
				<div class="shopNowContainer">
					<h4 style="font-family: Araboto-bold;"><?php the_archive_title(); ?></h4>
				</div>
				<?php
			}else{
				?>
				<div class="shopNowContainer">
					<h4 style="font-family: Araboto-bold;"><?php the_archive_title(); ?></h4>
				</div>
				<?php
			}

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
