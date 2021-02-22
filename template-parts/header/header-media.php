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
 * @package Ice-Cold
 *
 * @since 1.0.0
 *
 * @version 1.0.0
 */

?>
<!-- custom-header -->
<div class="custom-header">
		<div class="grid-mask"></div>
		<div class="header-background-overlay"></div>
		<div class="custom-header-media" style="filter: blur(<?php echo esc_html( get_theme_mod( 'page_header_blur', '0' ) ); ?>px);">
		<?php
		// Page and have a thunbnail image.
		if ( is_page() && ! is_front_page() && get_the_post_thumbnail_url() ) {
			the_post_thumbnail( 'full' );
		} else {
			the_custom_header_markup();
		}
		?>
		</div>
		<?php if ( is_front_page() ) : ?>
			<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>
		<?php endif; ?>
		<?php if ( ( is_page() && ! is_front_page() ) || ( is_single() && ! is_front_page() ) ) : ?>
			<div class="element-overlay container">
				<div class="row">
					<div class="col-md-12">
						<div class="site-branding-text">	
							<h1><?php esc_html( the_title() ); ?></h1>
						</div><!-- /.site-branding-text -->
					</div>
				</div><!-- /.row -->
			</div><!-- /.element-overlay container -->
		<?php elseif ( is_home() && is_front_page() ) : ?>
			<div class="element-overlay container">
				<div class="row">
					<div class="col-md-12">
						<div class="site-branding-text">	
							<h1><?php esc_html( bloginfo( 'name' ) ); ?></h1>
							<p class="site-description text-white"><?php echo esc_html( get_bloginfo( 'description', 'display' ) ); ?></p>
						</div><!-- /.site-branding-text -->
					</div>
				</div><!-- /.row -->
			</div><!-- /.element-overlay container -->
			<?php elseif ( is_home() && ! is_front_page() ) : ?>
			<div class="element-overlay container">
				<div class="row">
					<div class="col-md-12">
						<div class="site-branding-text">	
							<h1><?php single_post_title(); ?></h1>
						</div><!-- /.site-branding-text -->
					</div>
				</div><!-- /.row -->
			</div><!-- /.element-overlay container -->
			<?php elseif ( is_archive() ) : ?>
			<div class="element-overlay container">
				<div class="row">
					<div class="col-md-12">
						<div class="site-branding-text">	
							<h1><?php the_archive_title(); ?></h1>
						</div><!-- /.site-branding-text -->
					</div>
				</div><!-- /.row -->
			</div><!-- /.element-overlay container -->
		<?php endif; ?>
</div>
<!-- /.custom-header -->
