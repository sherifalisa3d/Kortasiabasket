<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package eltl5esbookskw
 */

get_header();
?>

<main id="primary" class="site-main mainHome container">

		<section class="error-404 not-found">
		<div class="page-content productsListContainer container">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'eltl5esbookskw' ); ?></h1>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
