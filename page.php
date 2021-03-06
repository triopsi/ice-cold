<?php
/**
 * Author: triopsi
 * Author URI: http://wiki.profoxi.de
 * License: GPL3
 * License URI: https://www.gnu.org/licenses/gpl-3.0
 *
 * Ice-Cold is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Ice-Cold is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with wpicecold. If not, see https://www.gnu.org/licenses/gpl-3.0.
 *
 * The template for displaying all pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ice-Cold
 *
 * @since 1.0.0
 *
 * @version 1.0.0
 */

get_header();

?>
<!-- Begin Page -->
<main id="main" class="site-main-page page-main-template" role="main">
	<div class="container">
		<div id="primary" class="content-area row">
			<div class="col-md-12">
				<?php wpicecold_get_breadcrumb(); ?>
			</div>
			<div class="col-md-<?php echo esc_attr( ( 'one-column' === get_theme_mod( 'page_layout_blog_site', 'two-column' ) ) ? '12' : '8' ); ?>">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/page/content', 'page' );
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			endwhile; // End of the loop.
			?>
			</div><!-- /.col -->
			<?php ( 'one-column' === get_theme_mod( 'page_layout_blog_site', 'two-column' ) ) ? '' : get_sidebar(); ?>
		</div><!-- #primary -->
	</div><!-- /.container -->
</main><!-- /#main -->
<!-- End woocommerce -->
<?php
get_footer();
