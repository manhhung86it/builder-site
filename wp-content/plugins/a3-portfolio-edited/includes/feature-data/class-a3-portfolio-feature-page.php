<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'A3_Portfolio_Feature_Page' ) ) :

class A3_Portfolio_Feature_Page
{
	public function __construct() {
		if ( is_admin() ) {
			// Add Portfolio Meta submenu page
			add_action( 'admin_menu', array( $this, 'admin_menu'), 1 );
		}
	}

	public function admin_menu() {
		$parent_page = 'a3-portfolio';
	    if ( current_user_can( 'manage_options' ) )
	    	add_submenu_page( 'edit.php?post_type='.$parent_page, __( 'Feature Data', 'a3_portfolios' ), __( 'Feature Data', 'a3_portfolios' ), 'manage_options', 'portfolio-feature-data', array( $this, 'output' ) );
	}

	public function output() {
		$msg = $this->form_actions();

		// Show admin interface
		if ( ! empty( $_GET['edit'] ) ) {
			$this->edit_portfolio_feature( $msg );
		} else {
			$this->add_portfolio_feature( $msg );
			wp_enqueue_script('jquery-ui-sortable');
			$portfolio_feature_order = wp_create_nonce("portfolio-feature-order");
			?>
			<script type="text/javascript">
			(function($){
				$(function(){
					var fixHelper = function(e, ui) {
						ui.children().each(function() {
							$(this).width($(this).width());
						});
						return ui;
					};
					$(".sorttable tbody").sortable({ helper: fixHelper, placeholder: "ui-state-highlight", opacity: 0.8, cursor: 'move', update: function(event, ui) {
						var order = $(this).sortable("serialize") + '&action=portfolio_update_feature_order&security=<?php echo $portfolio_feature_order; ?>';

                        $.post("<?php echo admin_url('admin-ajax.php'); ?>", order, function(theResponse){
						});
						var i = 0;
						$(this).find("tr").each(function(index){
							i++;
							$(this).removeClass('alternate');
							if( i == 2 ){
								$(this).addClass('alternate');
								i == 0;
							}
						 });
					}});
				});
            })(jQuery);
			</script>
            <?php
		}
	}

	public function form_actions() {
		global $a3_portfolio_feature_data;

		do_action( 'a3_portfolio_feature_action_before' );

		// Action to perform: add, edit, delete or none
		$action = '';
		if ( ! empty( $_POST['add_new_portfolio_feature'] ) ) {
			$action = 'add';
		} elseif ( ! empty( $_POST['save_protfolio_feature'] ) && ! empty( $_GET['edit'] ) ) {
			$action = 'edit';
		} elseif ( ! empty( $_GET['delete'] ) ) {
			$action = 'delete';
		}

		$action_completed = false;
		$msg = '';

		// Add or edit an feature data
		if ( 'add' === $action || 'edit' === $action ) {

			// Security check
			if ( 'add' === $action ) {
				check_admin_referer( 'portfolio-add-new_feature' );
			}
			if ( 'edit' === $action ) {
				$feature_id = absint( $_GET['edit'] );
				check_admin_referer( 'portfolio-save-feature_' . $feature_id );
			}

			// Grab the submitted data
			$feature_name   = ( isset( $_POST['feature_name'] ) )   ? (string) stripslashes( $_POST['feature_name'] ) : '';
			$feature_slug    = ( isset( $_POST['feature_name'] ) )    ? sanitize_title( stripslashes( (string) $_POST['feature_name'] ) ) : '';
			$feature_data = array(
					'feature_name' => $feature_name,
					'feature_slug' => $feature_slug
				);

			// Forbidden attribute names
			// http://codex.wordpress.org/Function_Reference/register_taxonomy#Reserved_Terms
			$reserved_terms = array(
				'attachment', 'attachment_id', 'author', 'author_name', 'calendar', 'cat', 'category', 'category__and',
				'category__in', 'category__not_in', 'category_name', 'comments_per_page', 'comments_popup', 'cpage', 'day',
				'debug', 'error', 'exact', 'feed', 'hour', 'link_category', 'm', 'minute', 'monthnum', 'more', 'name',
				'nav_menu', 'nopaging', 'offset', 'order', 'orderby', 'p', 'page', 'page_id', 'paged', 'pagename', 'pb', 'perm',
				'post', 'post__in', 'post__not_in', 'post_format', 'post_mime_type', 'post_status', 'post_tag', 'post_type',
				'posts', 'posts_per_archive_page', 'posts_per_page', 'preview', 'robots', 's', 'search', 'second', 'sentence',
				'showposts', 'static', 'subpost', 'subpost_id', 'tag', 'tag__and', 'tag__in', 'tag__not_in', 'tag_id',
				'tag_slug__and', 'tag_slug__in', 'taxonomy', 'tb', 'term', 'type', 'w', 'withcomments', 'withoutcomments', 'year',
			);

			// Error checking
			if ( ! $feature_name ) {
				$error = __( 'Please, provide an feature name.', 'a3_portfolios' );
			} elseif ( in_array( $feature_name, $reserved_terms ) ) {
				$error = sprintf( __( 'Slug "%s" is not allowed because it is a reserved term. Change it, please.', 'a3_portfolios' ), sanitize_title( $feature_name ) );
			} else {
				if ( 'add' === $action ) {
					$old_feature_name = $a3_portfolio_feature_data->check_add_feature( $feature_name );
					if ( $old_feature_name ) {
						$error = sprintf( __( 'Feature "%s" is already in use. Change it, please.', 'a3_portfolios' ), ( $feature_name ) );
					}
				}
				if ( 'edit' === $action ) {
					$old_feature_name = $a3_portfolio_feature_data->check_edit_feature( $feature_id, $feature_name );
					if ( $old_feature_name == $feature_name ) {
						$error = sprintf( __( 'Feature "%s" is already in use. Change it, please.', 'a3_portfolios' ), ( $feature_name ) );
					}
				}
			}

			// Show the error message if any
			if ( ! empty( $error ) ) {
				$msg = '<div class="error below-h2" id="message"><p>' . $error . '</p></div>';
			} else {

				// Add new attribute
				if ( 'add' === $action ) {
					$a3_portfolio_feature_data->add_feature( $feature_data );
					$msg = '<div class="updated below-h2" id="message"><p>'.__( 'Feature Data is Added.', 'a3_portfolios' ).'</p></div>';
				}

				// Edit existing attribute
				if ( 'edit' === $action ) {
					$feature_data['feature_id'] = $feature_id;
					$a3_portfolio_feature_data->update_feature( $feature_data );
					$msg = '<div class="updated below-h2" id="message"><p>'.__( 'Feature Data is Updated.', 'a3_portfolios' ).'</p></div>';
				}
			}
		}

		// Delete an attribute
		if ( 'delete' === $action ) {
			// Security check
			$feature_id = absint( $_GET['delete'] );
			check_admin_referer( 'portfolio-delete-feature_' . $feature_id );

			$a3_portfolio_feature_data->delete_feature( $feature_id );
		}

		do_action( 'a3_portfolio_feature_action_after' );

		return apply_filters( 'a3_portfolio_feature_action_message', $msg );
	}

	/**
	 * Edit Feature Data admin panel
	 *
	 * Shows the interface for changing an attributes type between select and text
	 */
	public function edit_portfolio_feature( $msg = '' ) {
		global $a3_portfolio_feature_data;

		do_action( 'a3_portfolio_feature_page_edit_before' );

		$feature_id = absint( $_GET['edit'] );
		$the_feature = $a3_portfolio_feature_data->get_feature( $feature_id );

		?>
		<div class="wrap a3-portfolio-feature">
			<div class="icon32 icon32-a3-portfolio-feature" id="icon-a3-portfolio-feature"><br/></div>
		    <h2><?php _e( 'Edit Feature Data Fields', 'a3_portfolios' ) ?></h2>
            <?php if ( $msg != '' ) echo $msg; ?>
			<form action="admin.php?page=portfolio-feature-data&amp;edit=<?php echo absint( $feature_id ); ?>" method="post">
				<?php do_action( 'a3_portfolio_feature_form_edit_before' ); ?>
				<table class="form-table">
					<tbody>
						<tr class="form-field form-required">
							<th scope="row" valign="top">
								<label for="feature_name"><?php _e( 'Name', 'a3_portfolios' ); ?></label>
							</th>
							<td>
								<input name="feature_name" id="feature_name" type="text" value="<?php echo esc_attr( $the_feature->feature_name ); ?>" />
								<p class="description"><?php _e( 'The name is how it appears on your site.', 'a3_portfolios' ); ?></p>
							</td>
						</tr>
						<?php do_action( 'a3_portfolio_feature_field_edit' ); ?>
					</tbody>
				</table>

				<?php do_action( 'a3_portfolio_feature_form_edit_after' ); ?>
                <input name="id" id="id" type="hidden" value="<?php echo esc_attr( $the_feature->id ); ?>" />
				<p class="submit"><input type="submit" name="save_protfolio_feature" id="submit" class="button-primary" value="<?php _e( 'Update', 'a3_portfolios' ); ?>"></p>
				<?php wp_nonce_field( 'portfolio-save-feature_' . $feature_id ); ?>
			</form>
		</div>
		<?php

		do_action( 'a3_portfolio_feature_page_edit_after' );
	}

	/**
	 * Add Feature Data admin panel
	 *
	 * Shows the interface for adding new attributes
	 */
	public function add_portfolio_feature( $msg = '' ) {
		global $a3_portfolio_feature_data;

		do_action( 'a3_portfolio_feature_page_add_before' );
		?>
		<div class="wrap a3-portfolio-feature">
			<div class="icon32 icon32-a3-portfolio-feature" id="icon-a3-portfolio-feature"><br/></div>
		    <h2><?php _e( 'Feature Data Fields', 'a3_portfolios' ) ?></h2>
            <?php if ( $msg != '' ) echo $msg; ?>
		    <br class="clear" />
		    <div id="col-container">
		    	<div id="col-right">
		    		<div class="col-wrap">
			    		<table class="widefat a3-portfolio-feature-table wp-list-table sorttable" style="width:100%">
					        <thead>
					            <tr>
					                <th scope="col"><?php _e( 'Feature Data Field Name', 'a3_portfolios' ) ?></th>
					                <?php do_action( 'a3_portfolio_feature_field_column' ); ?>
					            </tr>
					        </thead>
					        <tbody>
					        	<?php
									$class = '';
									$portfolio_features = $a3_portfolio_feature_data->get_all_features();
					        		if ( $portfolio_features ) :
										$i = 0;
										$order = 0;
					        			foreach ($portfolio_features as $the_feature) :
											$i++;
											$order++;
											if ( $i == 2) {
												$class = 'alternate'; $i = 0;
											} else {
												$class = '';
											}
					        				?><tr id="recoders_<?php echo $the_feature->id;?>" class="<?php echo $class; ?>">

					        					<td><a href="<?php echo esc_url( add_query_arg( 'edit', $the_feature->id, 'admin.php?page=portfolio-feature-data' ) ); ?>"><?php echo esc_html( $the_feature->feature_name ); ?></a>

					        					<div class="row-actions"><span class="edit"><a href="<?php echo esc_url( add_query_arg('edit', $the_feature->id, 'admin.php?page=portfolio-feature-data') ); ?>"><?php _e( 'Edit', 'a3_portfolios' ); ?></a> | </span><span class="delete"><a class="delete" href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'delete', $the_feature->id, 'admin.php?page=portfolio-feature-data'), 'portfolio-delete-feature_' . $the_feature->id ) ); ?>"><?php _e( 'Delete', 'a3_portfolios' ); ?></a></span></div>
					        					</td>
					        					<?php do_action( 'a3_portfolio_feature_field_value', $the_feature->id, $the_feature ); ?>
					        				</tr><?php
					        			endforeach;
					        		else :
					        			?><tr><td><?php _e( 'No Feature currently exist.', 'a3_portfolios' ) ?></td></tr><?php
					        		endif;
					        	?>
					        </tbody>
					    </table>
		    		</div>
		    	</div>
		    	<div id="col-left">
		    		<div class="col-wrap">
		    			<?php echo wpautop( __( "Create and manage a3 Portfolio Feature Data fields here. Feature Data fields show on the Item post and Portfolio item expander as the Field name created here and the Field data you enter on the create / edit Portfolio item page. Example create a Feature Data field called 'Client'. It will then show as a Field on Item edit page in the Portfolio Item Meta > Feature Data section. There you add a client name, with fields to link it to a Portfolio Tag or to any internal or external url. Use drag and drop in Feature Data Fields list on the right of this page to sort Features order.", 'a3_portfolios' ) );?>
		    			<div class="form-wrap">
		    				<h3><?php _e( 'Add New Feature Data', 'a3_portfolios' ) ?></h3>
		    				<form action="admin.php?page=portfolio-feature-data" method="post">
		    					<?php do_action( 'a3_portfolio_feature_form_add_before' ); ?>
								<div class="form-field">
									<label for="feature_name"><?php _e( 'Name', 'a3_portfolios' ); ?></label>
									<input name="feature_name" id="feature_name" type="text" value="" />
									<p class="description"><?php _e( 'The name is how it appears on your site.', 'a3_portfolios' ); ?></p>
								</div>
								<?php do_action( 'a3_portfolio_feature_field_add' ); ?>
								<p class="submit"><input type="submit" name="add_new_portfolio_feature" id="submit" class="button button-primary" value="<?php _e( 'Add New Feature Data Field', 'a3_portfolios' ); ?>"></p>
								<?php wp_nonce_field( 'portfolio-add-new_feature' ); ?>
								<?php do_action( 'a3_portfolio_feature_form_add_after' ); ?>
		    				</form>
		    			</div>
		    		</div>
		    	</div>
		    </div>

		    <script type="text/javascript">
			/* <![CDATA[ */

				jQuery('a.delete').click(function(){
		    		var answer = confirm ("<?php _e( 'Are you sure you want to delete this feature?', 'a3_portfolios' ); ?>");
					if (answer) return true;
					return false;
		    	});

			/* ]]> */
			</script>
		</div>
		<?php

		do_action( 'a3_portfolio_feature_page_add_after' );
	}
}

endif;

return new A3_Portfolio_Feature_Page();
