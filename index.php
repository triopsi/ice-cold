<?php
/**
 * Author: triopsi
 * Author URI: https://wiki.profoxi.de/ueber-mich/
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
 * The main template file
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
<!-- Begin Index -->
<main role="main" class="site-main-page">
	<div class="container">
		<div id="primary" class="content-area row">
			<main id="main" class="site-main col-md-<?php echo ( 'one-column' === get_theme_mod( 'page_layout_blog_site', 'two-column' ) ) ? '12' : '8'; ?>" role="main">
				<?php
				// check posts exists.
				if ( have_posts() ) {
					// Load posts loop.
					while ( have_posts() ) :
						// set post.
						the_post();
						// load template for post type.
						get_template_part( 'template-parts/post/content', get_post_format() );
					endwhile;
					// Previous/next page navigation.
					the_posts_pagination(
						array(
							'prev_text'          => '<i class="fas fa-arrow-left"></i> ' . esc_html__( 'Previous page', 'ice-cold' ),
							'next_text'          => esc_html__( 'Next page', 'ice-cold' ) . ' <i class="fas fa-arrow-right"></i> ',
							'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'ice-cold' ) . ' </span>',
						)
					);
				} else {
					get_template_part( 'template-parts/post/content', 'none' );
				};
				?>
			</main><!-- /#main -->
			<?php ( 'one-column' === get_theme_mod( 'page_layout_blog_site', 'two-column' ) ) ? '' : get_sidebar(); ?>
		</div><!-- /#primary -->
	</div><!-- /.container -->
</main><!-- /main -->
<!-- Index End -->
<?php
get_footer();
