<?php
/**
 * The template for displaying portfolio feature data in the expander.
 *
 * Override this template by copying it to yourtheme/portfolio/expander/feature-data.php
 *
 * @author 		A3 Rev
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;
$comma = '';
?>

<?php if ( $portfolio_features ) : ?>

<ul class="item-info">

	<li>

	<?php foreach ( $portfolio_features as $p_feature ) : ?>

		<?php $portfolio_feature_data = get_post_meta( $portfolio_id, '_a3_portfolio_meta_feature_'.$p_feature->id, true ); ?>

		<?php if ( ! empty( $portfolio_feature_data ) && isset( $portfolio_feature_data['meta_value'] ) && trim( $portfolio_feature_data['meta_value'] ) != '' ) : ?>

		<?php
			$open_type = '';
			if ( isset( $portfolio_feature_data['open_type'] ) ) {
				$open_type = $portfolio_feature_data['open_type'];
			}
		?>
		<?php echo $comma; ?>
		<span>
			<span class="meta-title"><?php echo $p_feature->feature_name; ?>:</span>

			<?php if ( isset( $portfolio_feature_data['tag_link'] ) && $portfolio_feature_data['tag_link'] > 0 && term_exists( (int) $portfolio_feature_data['tag_link'], 'portfolio_tag' ) !== 0 ) { ?>

			<a class="meta-value" href="<?php echo get_term_link( (int) $portfolio_feature_data['tag_link'], 'portfolio_tag' ); ?>" target="<?php echo $open_type; ?>" ><?php echo trim( $portfolio_feature_data['meta_value'] ); ?></a>

			<?php } elseif ( isset( $portfolio_feature_data['meta_link'] ) && trim( $portfolio_feature_data['meta_link'] ) != '' ) { ?>

			<a class="meta-value" href="<?php echo trim( esc_url( $portfolio_feature_data['meta_link'] ) ); ?>" target="<?php echo $open_type; ?>" ><?php echo trim( $portfolio_feature_data['meta_value'] ); ?></a>

			<?php } else { ?>

			<span class="meta-value"><?php echo trim( $portfolio_feature_data['meta_value'] ); ?></span>

			<?php } ?>
		</span>
		<?php $comma = ', '; ?>

		<?php endif; ?>

	<?php endforeach; ?>

	</li>

</ul>

<?php endif; ?>