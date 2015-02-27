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

$portfolio_id = get_the_ID();

$item_class = a3_portfolio_get_item_class( $portfolio_id );

if ( $item_class == '' ) {
	$item_class = 'uncategorized';
}

$portfolio_gallery = a3_portfolio_get_gallery( $portfolio_id );
?>
<div class="a3-portfolio-item-load a3-portfolio-item <?php echo $item_class; ?>" data-index="<?php echo $post->post_name; ?>">

	<?php do_action( 'a3_portfolio_before_loop_item', $portfolio_id ); ?>

	<div class="a3-portfolio-item-container">

		<a class="a3-portfolio-item-block" href="#">

			<?php do_action( 'a3_portfolio_before_loop_item_card', $portfolio_id ); ?>

			<?php a3_portfolio_card_get_first_thumb_image( $portfolio_id, $portfolio_gallery ); ?>
			<?php a3_portfolio_card_get_item_title( $portfolio_id ); ?>

			<?php do_action( 'a3_portfolio_after_loop_item_card', $portfolio_id ); ?>

		</a>

	</div>

	<?php do_action( 'a3_portfolio_after_loop_item', $portfolio_id ); ?>

	<?php do_action( 'a3_portfolio_before_item_expander', $portfolio_id ); ?>

	<div class="a3-portfolio-item-expander-content" style="position: absolute;visibility: hidden;">

		<div class="a3-portfolio-item-image-container" data-portfolioId="<?php echo $portfolio_id; ?>">

			<?php do_action( 'a3_portfolio_before_item_expander_large_image_container', $portfolio_id ); ?>

			<?php a3_portfolio_get_large_image_container( $portfolio_id, $portfolio_gallery ); ?>

			<?php do_action( 'a3_portfolio_after_item_expander_large_image_container', $portfolio_id ); ?>

		</div>

		<div class="a3-portfolio-item-content-container">

			<?php do_action( 'a3_portfolio_before_item_expander_title', $portfolio_id ); ?>

			<h2>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>

			<?php do_action( 'a3_portfolio_after_item_expander_title', $portfolio_id ); ?>

			<?php
				/**
				 * a3_portfolio_before_item_expander_content hook
				 *
				 * @hooked a3_portfolio_get_entry_metas - 5
				 * @hooked a3_portfolio_get_social_icons - 10
				 * @hooked a3_portfolio_get_item_feature_data - 20
				 */
				do_action( 'a3_portfolio_before_item_expander_content', $portfolio_id );
			?>

			<?php
				/**
				 * Gallery Thumbnails
				 *
				 */
			?>
			<?php do_action( 'a3_portfolio_before_item_expander_gallery_thumbs_container', $portfolio_id ); ?>

			<?php a3_portfolio_get_gallery_thumbs( $portfolio_id, $portfolio_gallery ); ?>

			<?php do_action( 'a3_portfolio_after_item_expander_gallery_thumbs_container', $portfolio_id ); ?>

			<div class="a3-portfolio-item-content-text">
				<?php echo wpautop( get_the_content() ); ?>
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

		<div class="clear"></div>

	</div>

	<?php do_action( 'a3_portfolio_after_item_expander', $portfolio_id ); ?>

</div>