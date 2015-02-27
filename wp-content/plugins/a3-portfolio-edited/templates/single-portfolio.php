<?php
/**
 * The template for displaying all single portfolio.
 *
 * Override this template by copying it to yourtheme/portfolio/single-portfolio.php
 *
 * @author 		A3 Rev
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;

if ( is_singular( 'a3-portfolio' ) ) {
	$portfolio_id = get_the_ID();
}
?>

<?php if ( have_posts() ) : ?>

	<div class="single-a3-portfolio single-a3-portfolio-<?php echo $portfolio_id; ?>">

	    <?php
			/**
			 * a3_portfolio_before_single_content hook
			 *
			 * @hooked a3_portfolio_custom_single_style - 5
			 */
			do_action( 'a3_portfolio_before_single_content', $portfolio_id );
		?>

	    <div class="a3-portfolio-single-wrap">

		    <?php

				while ( have_posts() ) : the_post();

					a3_portfolio_get_template( 'content-single-portfolio.php', array( 'portfolio_id' => $portfolio_id ) );

				endwhile;

			?>

		</div>

		<?php
			/**
			 * a3_portfolio_after_single_content hook
			 *
			 * @hooked a3_portfolio_single_scripts - 5
			 */
			do_action( 'a3_portfolio_after_single_content', $portfolio_id );
		?>

	</div>

<?php endif; ?>