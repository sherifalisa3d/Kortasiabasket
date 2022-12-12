<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package eltl5esbookskw
 */
$title = get_option( '_site_title_hero' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="shopNowContainer">
		<?php 

		if( empty($title) ){
			the_title( '<h4 class="entry-title">', '</h4>' ); 
		}
		else{
			echo '<div class="entry-title">' . $title . '</div>';
		}
		
		?>
	</div>

	<?php eltl5esbookskw_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'eltl5esbookskw' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
