<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * a3 Portfolios Metaboxes Class
 *
 *
 */
class A3_Portfolio_Data_Metabox
{
	public function __construct() {
		if ( is_admin() ) {
			add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
			add_action( 'save_post', array( $this, 'save' ) );
		}
	}

	public function add_meta_box( $post_type ) {
    	$post_types = array('a3-portfolio');     //limit meta box to certain post types
        if ( in_array( $post_type, $post_types )) {
			add_meta_box(
				'a3_portfolio_data_meta_box'
				,__( 'Portfolio Item Meta', 'a3_portfolios' )
				,array( $this, 'output' )
				,$post_type
				,'normal'
				,'high'
			);
		}
	}

	public function include_js() {
		global $a3_portfolio_admin_interface;

		$suffix	= defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		add_action( 'admin_footer', array( $a3_portfolio_admin_interface, 'admin_script_load' ) );
		add_action( 'admin_footer', array( $a3_portfolio_admin_interface, 'admin_css_load' ) );
		wp_enqueue_style( 'a3_portfolio-metabox-admin-style', A3_PORTFOLIO_CSS_URL . '/a3.portfolio.metabox.admin.css' );
		wp_enqueue_script( 'a3-portfolio-metabox-admin-script', A3_PORTFOLIO_JS_URL . '/a3.portfolio.metabox.admin' . $suffix . '.js' );
		wp_enqueue_media();

		if ( is_rtl() ) {
			wp_enqueue_style( 'a3_portfolio-metabox-admin-style-rtl', A3_PORTFOLIO_CSS_URL . '/a3.portfolio.metabox.admin.rtl.css' );
		}

		do_action( 'a3_portfolio_metabox_include_scripts' );
	}

	/**
	 * Output the metabox
	 */
	public function output( $post ) {
		global $a3_portfolio_item_posts_settings;
		$thepostid = $post->ID;
		$this->include_js();

		$wide = trim( get_post_meta( $thepostid, '_a3_portfolio_meta_gallery_wide', true ) );
		if ( '' == $wide ){
			$wide = $a3_portfolio_item_posts_settings['portfolio_inner_container_single_main_image_width'];
		}
		if ( '' == $wide ) $wide = 70;

		$thumb_pos = trim( get_post_meta( $thepostid, '_a3_portfolio_meta_thumb_position', true ) );
		if ( '' == $thumb_pos ){
			$thumb_pos = $a3_portfolio_item_posts_settings['portfolio_inner_container_single_thumb_position'];
		}

		$button_visit = trim( get_post_meta( $thepostid, '_a3_portfolio_launch_site_url', true ) );

		$button_text = trim( esc_attr(  get_post_meta( $thepostid, '_a3_portfolio_launch_button_text', true ) ) );

		$button_text = apply_filters( 'a3_portfolio_backend_launch_button_text', $button_text, $thepostid );

		if ( '' == $button_text ) {
			$button_text = a3_portfolio_ei_ict_t__( 'Launch Site Button Text', __( 'LAUNCH SITE', 'a3_portfolios' ) );
		}
		$launch_open_type = trim( esc_attr(  get_post_meta( $thepostid, '_a3_portfolio_launch_open_type', true ) ) );

		?>
		<div class="a3rev_panel_container a3-metabox-panel-wrap">

			<div class="a3-metabox-tabs-back"></div>

			<ul class="a3-metabox-data-tabs" style="display:none;">
				<?php
					$portfolio_data_tabs = apply_filters( 'a3_portfolio_metabox_data_tabs', array(
						'portfolio_gallery' => array(
							'label'  => __( 'Portfolio Gallery', 'a3_portfolios' ),
							'target' => 'portfolio_gallery_panel',
							'class'  => array(),
						),
						'single_layout' => array(
							'label'  => __( 'Layout', 'a3_portfolios' ),
							'target' => 'portfolio_single_layout_panel',
							'class'  => array(),
						),
						'featue_data' => array(
							'label'  => __( 'Feature Data', 'a3_portfolios' ),
							'target' => 'portfolio_featue_data_panel',
							'class'  => array(),
						),
						'portfolio_button' => array(
							'label'  => __( 'Button', 'a3_portfolios' ),
							'target' => 'portfolio_button_panel',
							'class'  => array(),
						),
					), $post );

					foreach ( $portfolio_data_tabs as $key => $tab ) {
						?><li class="<?php echo $key; ?>_options <?php echo $key; ?>_tab <?php echo implode( ' ' , $tab['class'] ); ?>">
							<a class="a3-portfolio-metabox-icon" href="#<?php echo $tab['target']; ?>"><?php echo esc_html( $tab['label'] ); ?></a>
						</li><?php
					}

					do_action( 'a3_portfolio_metabox_write_panel_tabs', $post );
				?>
			</ul>
			<div id="portfolio_gallery_panel" class="a3-metabox-panel a3-metabox-options-panel">
				<div id="portfolio_images_container">
					<ul class="portfolio_images">
						<?php
							$portfolio_gallery = a3_portfolio_get_gallery( $thepostid );

							if ( $portfolio_gallery ) {
								$portfolio_gallery = array_diff( $portfolio_gallery, array( get_post_thumbnail_id() ) );
								foreach ( $portfolio_gallery as $attachment_id ) {
						?>
						<li class="image" data-attachment_id="<?php echo $attachment_id ; ?> ">
							<?php echo wp_get_attachment_image( $attachment_id, 'thumbnail' ); ?>
							<ul class="actions">
								<li><a href="#" class="delete tips" data-tip="<?php echo __( 'Delete image', 'a3_portfolios' ); ?>"><?php echo __( 'Delete image', 'a3_portfolios' ); ?></a></li>
							</ul>
						</li>
						<?php
								}
							}
						?>
					</ul>

					<input type="hidden" id="portfolio_image_gallery" name="portfolio_image_gallery" value="<?php if ( $portfolio_gallery ) echo esc_attr( implode( ',', $portfolio_gallery ) ); ?>" />

				</div>
				<?php do_action( 'a3_portfolio_metabox_portfolio_gallery_panel', $post ); ?>
				<p class="add_portfolio_images hide-if-no-js">
					<a href="#" data-choose="<?php _e( 'Add Images to Portfolio Gallery', 'a3_portfolios' ); ?>" data-update="<?php _e( 'Add to gallery', 'a3_portfolios' ); ?>" data-delete="<?php _e( 'Delete image', 'a3_portfolios' ); ?>" data-text="<?php _e( 'Delete', 'a3_portfolios' ); ?>"><?php _e( 'Add portfolio gallery images', 'a3_portfolios' ); ?></a>
				</p>
			</div>
			<div id="portfolio_single_layout_panel" class="a3-metabox-panel a3-metabox-options-panel">
				<div class="options_group">
					<table class="form-table">
						<tr>
							<td>
								<label for="_a3_portfolio_meta_gallery_wide"><?php echo __( 'Main Image Width', 'a3_portfolios' ); ?></label>
							</td>
							<td class="forminp forminp-slider">
	                        <div class="a3rev-ui-slide-container">
	                            <div class="a3rev-ui-slide-container-start"><div class="a3rev-ui-slide-container-end">
	                                <div class="a3rev-ui-slide" id="_a3_portfolio_meta_gallery_wide_id_div" min="30" max="80" inc="1"></div>
	                            </div></div>
	                            <div class="a3rev-ui-slide-result-container">
	                                <input
	                                    readonly="readonly"
	                                    name="_a3_portfolio_meta_gallery_wide"
	                                    id="_a3_portfolio_meta_gallery_wide_id"
	                                    type="text"
	                                    value="<?php echo esc_attr( $wide ); ?>"
	                                    class="a3rev-ui-slider"
	                                    /> %
								</div>
	                        </div>
	                        </td>
						</tr>
						<tr valign="top">
							<td>
								<label for="_a3_portfolio_meta_thumb_position"><?php echo __( 'Gallery Thumbnail Position', 'a3_portfolios' ); ?></label>
							</td>
							<td class="forminp forminp-select">
								<select
									name="_a3_portfolio_meta_thumb_position"
									id="_a3_portfolio_meta_thumb_position"
									style="width: 100px;"
									class="a3rev-ui-select chzn-select"
									>
									<option value="right" selected="selected"><?php echo __( 'Right', 'a3_portfolios' ); ?></option>
									<option value="below" <?php
											selected( $thumb_pos, 'below' );
									?>><?php echo __( 'Below', 'a3_portfolios' ); ?></option>
							   </select>
							</td>
						</tr>
						<?php do_action( 'a3_portfolio_metabox_single_layout_options', $post ); ?>
					</table>
					<?php do_action( 'a3_portfolio_metabox_single_layout_panel', $post ); ?>
				</div>
			</div>

			<div id="portfolio_featue_data_panel" class="a3-metabox-panel a3-metabox-wrapper">
				<?php
					global $a3_portfolio_feature_data;
					$all_features = $a3_portfolio_feature_data->get_all_features();
					if ( $all_features && is_array( $all_features ) && count( $all_features ) > 0 ) {
				?>
				<p class="toolbar">
					<a href="#" class="a3-metabox-icon close_all"><?php _e( 'Close all', 'a3_portfolios' ); ?></a><a href="#" class="a3-metabox-icon expand_all"><?php _e( 'Expand all', 'a3_portfolios' ); ?></a>
				</p>
				<div class="a3-metabox-items">
				<?php
					$all_tags = get_terms( array('portfolio_tag'), array( 'hide_empty' => false ));
					foreach ( $all_features as $p_feature ) {

						$portfolio_feature_data = get_post_meta( $thepostid, '_a3_portfolio_meta_feature_'.$p_feature->id, true );

						?>
						<div class="a3-metabox-item closed">
							<h3>
								<div class="a3-metabox-icon handlediv" title="<?php _e( 'Click to toggle', 'a3_portfolios' ); ?>"></div>
								<table class="form-table">
									<tr>
										<td>
											<?php echo $p_feature->feature_name; ?>
										</td>
										<td class="forminp forminp-text">
											<input
												name="portfolio_meta_value_<?php echo $p_feature->id; ?>"
												id="portfolio_meta_value_<?php echo $p_feature->id; ?>"
												type="text"
												value="<?php if ( isset( $portfolio_feature_data['meta_value'] ) ) echo esc_attr( $portfolio_feature_data['meta_value'] ); ?>"
												class="a3rev-ui-text"
												/>
										</td>
									</tr>
								</table>
							</h3>
							<table class="a3-metabox-item-content form-table">
								<tr>
									<td>
										<label for="portfolio_meta_tag_link_<?php echo $p_feature->id; ?>"><?php echo __( 'Link to Tag', 'a3_portfolios' ); ?></label>
									</td>
									<td class="forminp forminp-select">
										<select
											name="portfolio_meta_tag_link_<?php echo $p_feature->id; ?>"
											id="portfolio_meta_tag_link_<?php echo $p_feature->id; ?>"
											style="width: 300px;"
											class="a3-portfolio-meta-tag-link a3rev-ui-select chzn-select"
											>
											<option value="0" selected="selected"><?php echo __( 'Select Option', 'a3_portfolios' ); ?></option>
											<?php
												if ( $all_tags && count( $all_tags ) > 0 ) {
													foreach( $all_tags as $portfolio_tag ) {
											?>
											<option value="<?php echo $portfolio_tag->term_id ; ?>" <?php
													if ( isset( $portfolio_feature_data['tag_link'] ) ) selected( $portfolio_feature_data['tag_link'], $portfolio_tag->term_id );
											?>><?php echo $portfolio_tag->name ; ?></option>
											<?php
													}
												}
											?>
									   </select>
									</td>
								</tr>
								<tr valign="top">
									<td>
										<div class="portfolio_meta_link_url_row" style="<?php if ( isset( $portfolio_feature_data['tag_link'] ) && '0' != $portfolio_feature_data['tag_link'] ) { echo 'display:none;'; } ?>"><label for="portfolio_meta_link_url_<?php echo $p_feature->id; ?>"><?php echo __( 'Link URL', 'a3_portfolios' ); ?></label></div>
									</td>
									<td class="forminp forminp-text">
										<div class="portfolio_meta_link_url_row" style="<?php if ( isset( $portfolio_feature_data['tag_link'] ) && '0' != $portfolio_feature_data['tag_link'] ) { echo 'display:none;'; } ?>">
										<input
											name="portfolio_meta_link_url_<?php echo $p_feature->id; ?>"
											id="portfolio_meta_link_url_<?php echo $p_feature->id; ?>"
											type="text"
											value="<?php if ( isset( $portfolio_feature_data['meta_link'] ) ) echo esc_url( $portfolio_feature_data['meta_link'] ); ?>"
											class="a3rev-ui-text"
											placeholder="http://"
											/>
										</div>
									</td>
								</tr>
								<tr valign="top">
									<td>
										<label for="portfolio_meta_open_type_<?php echo $p_feature->id; ?>"><?php echo __( 'Open Type', 'a3_portfolios' ); ?></label>
									</td>
									<td class="forminp forminp-onoff_checkbox">
										<label>
											<input
												name="portfolio_meta_open_type_<?php echo $p_feature->id; ?>"
				                                id="portfolio_meta_open_type_<?php echo $p_feature->id; ?>"
				                                checked_label="<?php echo __( 'ON', 'a3_portfolios' ); ?>"
				                                unchecked_label="<?php echo __( 'OFF', 'a3_portfolios' ); ?>"
				                                type="checkbox"
												value="_blank"
												<?php if ( isset( $portfolio_feature_data['open_type'] ) ) checked( $portfolio_feature_data['open_type'], '_blank' ); ?>
												/> <span class="description" style="margin-left:5px;"><?php echo __( 'Open in new tab', 'a3_portfolios' ); ?></span>
			                        	</label>
			                        </td>
								</tr>
								<?php do_action( 'a3_portfolio_metabox_portfolio_featue_data_item', $post, $p_feature->id ); ?>
							</table>
						</div>
						<?php
					}
				?>
				</div>
				<?php
				} else {
				?>
				<div class="a3-metabox-items"><p class=""><?php echo __( 'Please add Meta for', 'a3_portfolios' ); ?> <a href="<?php echo admin_url('edit.php?post_type=a3-portfolio&page=portfolio-feature-data'); ?>" target="_blank"><?php echo __( 'Feature Data', 'a3_portfolios' ); ?></a></p></div>
				<?php
				}
				?>
				<?php do_action( 'a3_portfolio_metabox_portfolio_featue_data_panel' ); ?>
			</div>

			<div id="portfolio_button_panel" class="a3-metabox-panel a3-metabox-options-panel">
				<div class="options_group">
					<table class="form-table">
						<tr>
							<td>
								<label for="_a3_portfolio_launch_site_url"><?php echo __( 'Link URL', 'a3_portfolios' ); ?></label>
							</td>
							<td class="forminp forminp-text">
		                        <input
									name="_a3_portfolio_launch_site_url"
									id="_a3_portfolio_launch_site_url"
									type="text"
									value="<?php echo esc_attr( $button_visit ); ?>"
									class="a3rev-ui-text"
	                                placeholder="http://"
									/>
	                        </td>
						</tr>
						<tr valign="top">
							<td>
								<label for="_a3_portfolio_launch_button_text"><?php echo __( 'Link Text', 'a3_portfolios' ); ?></label>
							</td>
							<td class="forminp forminp-text">
		                        <input
									name="_a3_portfolio_launch_button_text"
									id="_a3_portfolio_launch_button_text"
									type="text"
									value="<?php echo esc_attr( $button_text ); ?>"
									class="a3rev-ui-text"
									/>
	                        </td>
						</tr>
						<tr valign="top">
							<td>
								<label for="_a3_portfolio_launch_open_type"><?php echo __( 'Open Type', 'a3_portfolios' ); ?></label>
							</td>
							<td class="forminp forminp-onoff_checkbox">
								<label>
									<input
										name="_a3_portfolio_launch_open_type"
		                                id="_a3_portfolio_launch_open_type"
		                                checked_label="<?php echo __( 'ON', 'a3_portfolios' ); ?>"
		                                unchecked_label="<?php echo __( 'OFF', 'a3_portfolios' ); ?>"
		                                type="checkbox"
										value="_blank"
										<?php checked( $launch_open_type, '_blank' ); ?>
										/> <span class="description" style="margin-left:5px;"><?php echo __( 'Open in new window', 'a3_portfolios' ); ?></span>
								</label>
	                        </td>
						</tr>
						<?php do_action( 'a3_portfolio_metabox_portfolio_button_options' ); ?>
					</table>
					<?php do_action( 'a3_portfolio_metabox_portfolio_button_panel' ); ?>
				</div>
			</div>

			<?php do_action( 'a3_portfolio_metabox_panels', $post ); ?>
			<?php
			// Add an nonce field so we can check for it later.
			wp_nonce_field( 'a3_portfolio_metabox_action', 'a3_portfolio_metabox_nonce_field' );
			?>
			<div class="clear"></div>

		</div>
		<?php
	}

	/**
	 * Save the meta when the post is saved.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function save( $post_id ) {

		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times.
		 */

		// Check if our nonce is set.
		if ( ! isset( $_POST['a3_portfolio_metabox_nonce_field'] ) || ! check_admin_referer( 'a3_portfolio_metabox_action', 'a3_portfolio_metabox_nonce_field' ) )
			return $post_id;

		// If this is an autosave, our form has not been submitted,
		// so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;

		if ( ! current_user_can( 'edit_post', $post_id ) )
			return $post_id;

		global $a3_portfolio_feature_data;

		$all_features = $a3_portfolio_feature_data->get_all_features();
		if ( $all_features && is_array( $all_features ) && count( $all_features ) > 0 ) {
			foreach ( $all_features as $p_feature ) {
				$open_type = '';
				if ( isset( $_POST['portfolio_meta_open_type_'.$p_feature->id] ) ) {
					$open_type = $_POST['portfolio_meta_open_type_'.$p_feature->id];
				}
				$meta_feature_data = apply_filters( 'a3_portfolio_meta_feature_data', array(
					'meta_value' => sanitize_text_field( $_POST['portfolio_meta_value_'.$p_feature->id] ),
					'tag_link'   => $_POST['portfolio_meta_tag_link_'.$p_feature->id],
					'meta_link'  => $_POST['portfolio_meta_link_url_'.$p_feature->id],
					'open_type'  => $open_type,
				), $post_id, $p_feature->id, $p_feature );

				// Update the meta field.
				update_post_meta( $post_id, '_a3_portfolio_meta_feature_'.$p_feature->id, $meta_feature_data );
			}
		}

		update_post_meta( $post_id, '_a3_portfolio_meta_gallery_wide', $_POST['_a3_portfolio_meta_gallery_wide'] );
		update_post_meta( $post_id, '_a3_portfolio_meta_thumb_position', $_POST['_a3_portfolio_meta_thumb_position'] );
		update_post_meta( $post_id, '_a3_portfolio_launch_site_url', $_POST['_a3_portfolio_launch_site_url'] );
		update_post_meta( $post_id, '_a3_portfolio_launch_button_text', $_POST['_a3_portfolio_launch_button_text'] );

		$launch_open_type = '';
		if ( isset( $_POST['_a3_portfolio_launch_open_type'] ) ) {
			$launch_open_type = $_POST['_a3_portfolio_launch_open_type'];
		}
		update_post_meta( $post_id, '_a3_portfolio_launch_open_type', $launch_open_type );

		$attachment_ids = array_filter( explode( ',', $_POST['portfolio_image_gallery'] ) );
		update_post_meta( $post_id, '_a3_portfolio_image_gallery', implode( ',', $attachment_ids ) );

		do_action( 'a3_portfolio_metabox_save', $post_id );
	}

}
$a3_portfolio_data_metabox = new A3_Portfolio_Data_Metabox();
?>