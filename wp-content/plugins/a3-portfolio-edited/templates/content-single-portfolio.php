<?php
/**
 * The template for displaying portfolio content within loops.
 *
 * Override this template by copying it to yourtheme/portfolio/content-portfolio.php
 *
 * @author 		A3 Rev
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;
global $a3_portfolio_item_posts_settings;

$portfolio_data = get_post( $portfolio_id );
$thumb_position = get_post_meta( $portfolio_id, '_a3_portfolio_meta_thumb_position', true );
if ( empty( $thumb_position ) || $thumb_position == '' ) {
	$thumb_position = $a3_portfolio_item_posts_settings['portfolio_inner_container_single_thumb_position'];
}

$portfolio_gallery = a3_portfolio_get_gallery( $portfolio_id );
?>


<div class="a3-portfolio-item-content-container">

	<?php do_action( 'a3_portfolio_before_item_expander_title', $portfolio_id ); ?>

	<?php if ( ! is_singular( 'a3-portfolio' ) ) : ?>
	<h2>
		<a href="<?php echo get_permalink( $portfolio_id ); ?>"><?php echo get_the_title( $portfolio_id ); ?></a>
	</h2>
	<?php endif; ?>

	<?php do_action( 'a3_portfolio_after_item_expander_title', $portfolio_id ); ?>

	<?php
		/**
		 * a3_portfolio_before_item_expander_content hook
		 *
		 * @hooked a3_portfolio_get_entry_metas - 5
		 * @hooked a3_portfolio_get_social_icons - 10
		 * @hooked a3_portfolio_get_item_feature_data - 20
		 */

		if ( is_singular( 'a3-portfolio' ) ) :

			/** Remove the hooked for single portfolio page
			 *
			 * remove a3_portfolio_get_entry_metas
			 * remove a3_portfolio_get_social_icons
			 */

			remove_action( 'a3_portfolio_before_item_expander_content', 'a3_portfolio_get_entry_metas', 5 );
			remove_action( 'a3_portfolio_before_item_expander_content', 'a3_portfolio_get_social_icons', 10 );

		endif;

		do_action( 'a3_portfolio_before_item_expander_content', $portfolio_id );
	?>

	<?php
		/**
		 * Gallery Thumbnails show inside the content right
		 *
		 */
	?>
	<?php if ( 'below' != $thumb_position ) : ?>
		<?php do_action( 'a3_portfolio_before_item_expander_gallery_thumbs_container', $portfolio_id ); ?>

		<?php a3_portfolio_get_gallery_thumbs( $portfolio_id, $portfolio_gallery ); ?>

		<?php do_action( 'a3_portfolio_after_item_expander_gallery_thumbs_container', $portfolio_id ); ?>
	<?php endif; ?>

	<div class="a3-portfolio-item-content-text">
		<?php echo apply_filters( 'the_content', $portfolio_data->post_content ); ?>
	</div>

	<?php
		/**
		 * a3_portfolio_after_item_expander_content hook
		 *
		 * @hooked a3_portfolio_get_categories_meta - 5
		 * @hooked a3_portfolio_get_tags_meta - 10
		 * @hooked a3_portfolio_get_launch_button - 20
		 */
		do_action( 'a3_portfolio_after_item_expander_content', $portfolio_id );
	?>

</div>