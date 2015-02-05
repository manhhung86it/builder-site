<link rel="stylesheet" href="<?php echo plugins_url( 'wp-smart-flexslider/');?>/admin/jquery-ui.min.css" />
<link rel="stylesheet" href="<?php echo plugins_url( 'wp-smart-flexslider/');?>admin/jquery-ui.css" />
<link rel="stylesheet" href="<?php echo plugins_url( 'wp-smart-flexslider/');?>admin/admin.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
jQuery(function() {
	var icons = {
		header: "ui-icon-circle-arrow-e",
		activeHeader: "ui-icon-circle-arrow-s"
	};
	jQuery( "#accordion" ).accordion({
		heightStyle: "content",
		icons: icons
	});
	jQuery('.ui-state-highlight').click(function(){
		jQuery(this).hide('slow');
	});
});
</script>
<?php
	if ( ! isset( $_REQUEST['settings-updated'] ) )
	$_REQUEST['settings-updated'] = false;
?>
	<div class="wrap my-theme-options">
		<h2>Flex Slider Settings</h2>
        <hr class="my-hr" />
        
		<form method="post" action="options.php">
			<?php settings_fields( 'flexslider_opt' ); ?>
			<?php $options = get_option( 'flexslider_options' ); ?>
            
            <div id="accordion">
            	<h3>Home Page Setup</h3>
                <div class="tab tab-1">
                
                	<label>Display nav controls</label>
                    <select id="flexslider_options[nav_controls]" class="ui-corner-all regular-text" name="flexslider_options[nav_controls]">
                        <option <?php if( $options['nav_controls'] == 'Yes'){?> selected="selected"<?php }?> value="Yes">Yes</option>
                        <option <?php if( $options['nav_controls'] == 'No'){?> selected="selected"<?php }?> value="No">No</option>
                    </select>
                    
                    <label>Display direction controls</label>
                    <select id="flexslider_options[direction_controls]" class="ui-corner-all regular-text" name="flexslider_options[direction_controls]">
                        <option <?php if( $options['direction_controls'] == 'Yes'){?> selected="selected"<?php }?> value="Yes">Yes</option>
                        <option <?php if( $options['direction_controls'] == 'No'){?> selected="selected"<?php }?> value="No">No</option>
                    </select>
                    <label>Number of slides displaying</label>
                    <input placeholder="0" class="ui-corner-all regular-text" type="text" name="flexslider_options[number_slides]" value="<?php esc_attr_e( $options['number_slides'] ); ?>" />
                    
				</div>
            	<h3>Short Codes</h3>
                <div class="tab tab-3">
                	<label>Shortcode</label>
                    <input class="ui-corner-all regular-text" readonly type="text"  value="[display_flexslider]" onclick="this.focus" />
                </div>
            </div>
			<p class="submit">
				<input type="submit" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" value="<?php _e( 'Save Options', 'FlexSlider' ); ?>" />
			</p>
		</form>
	</div>