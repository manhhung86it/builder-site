<?php
add_action('admin_init', 'theme_options_init');
add_action('admin_menu', 'theme_options_add_page');

/**
 * Init plugin options to white list our options
 */
function theme_options_init() {
    register_setting('wp_options', 'wp_theme_options', 'theme_options_validate');
}

/**
 * Load up the menu page
 */
function theme_options_add_page() {
    add_theme_page(__('Theme Options', 'wp'), __('Theme Options', 'wp'), 'edit_theme_options', 'theme_options', 'theme_options_do_page');
}

/**
 * Create the options page
 */
function theme_options_do_page() {
    global $select_options, $radio_options;

    if (!isset($_REQUEST['settings-updated']))
        $_REQUEST['settings-updated'] = false;
    ?>
    <div class="wrap">
    <?php screen_icon();
    echo "<h2>" . __(' Theme Options', 'wp') . "</h2>"; ?>

        <?php if (false !== $_REQUEST['settings-updated']) : ?>
            <div class="updated fade"><p><strong><?php _e('Options saved', 'wp'); ?></strong></p></div>
        <?php endif; ?>

        <form method="post" action="options.php">
            <?php settings_fields('wp_options'); ?>
            <?php $options = get_option('wp_theme_options'); ?>

            <table class="form-table">
                <tr valign="top"><th scope="row"><?php _e('Email Link', 'wp'); ?></th>
                    <td>
                        <input id="wp_theme_options[email]" class="regular-text" type="text" name="wp_theme_options[email]" value="<?php esc_attr_e($options['email']); ?>" />
                        <label class="description" for="wp_theme_options[email]"><?php _e('Your email', 'wp'); ?></label>
                    </td>
                </tr>
                <tr valign="top"><th scope="row"><?php _e('Phone', 'wp'); ?></th>
                    <td>
                        <input id="wp_theme_options[phone]" class="regular-text" type="text" name="wp_theme_options[phone]" value="<?php esc_attr_e($options['phone']); ?>" />   
                        <label class="description" for="wp_theme_options[phone]"><?php _e('Phone', 'wp'); ?></label>
                    </td>
                </tr>
                
                <tr valign="top"><th scope="row"><?php _e('Fax', 'wp'); ?></th>
                    <td>
                        <input id="wp_theme_options[fax]" class="regular-text" type="text" name="wp_theme_options[fax]" value="<?php esc_attr_e($options['fax']); ?>" />   
                        <label class="description" for="wp_theme_options[fax]"><?php _e('Fax', 'wp'); ?></label>
                    </td>
                </tr>
                <tr valign="top"><th scope="row"><?php _e('Address', 'wp'); ?></th>
                    <td>
                        <input id="wp_theme_options[address]" class="regular-text" type="text" name="wp_theme_options[address]" value="<?php esc_attr_e($options['address']); ?>" />   
                        <label class="description" for="wp_theme_options[address]"><?php _e('Address', 'wp'); ?></label>
                    </td>
                </tr>
                
                <tr valign="top"><th scope="row"><?php _e('Facebook Link', 'wp'); ?></th>
                    <td>
                        <input id="wp_theme_options[fb_url]" class="regular-text" type="text" name="wp_theme_options[fb_url]" value="<?php esc_attr_e($options['fb_url']); ?>" />
                        <label class="description" for="wp_theme_options[fb_url]"><?php _e('The link of your facebook', 'wp'); ?></label>
                    </td>
                </tr>
                <tr valign="top"><th scope="row"><?php _e('Twitter Link', 'wp'); ?></th>
                    <td>
                        <input id="wp_theme_options[twitter_url]" class="regular-text" type="text" name="wp_theme_options[twitter_url]" value="<?php esc_attr_e($options['twitter_url']); ?>" />   
                        <label class="description" for="wp_theme_options[twitter_url]"><?php _e('The link of your twitter', 'wp'); ?></label>
                    </td>
                </tr>
                <tr valign="top"><th scope="row"><?php _e('Google + Link', 'wp'); ?></th>
                    <td>
                        <input id="wp_theme_options[google_url]" class="regular-text" type="text" name="wp_theme_options[google_url]" value="<?php esc_attr_e($options['google_url']); ?>" />
                        <label class="description" for="wp_theme_options[google_url]"><?php _e('The link of your Google +', 'wp'); ?></label>
                    </td>
                </tr>
                <tr valign="top"><th scope="row"><?php _e('Link In', 'wp'); ?></th>
                    <td>
                        <input id="wp_theme_options[LinkIn_url]" class="regular-text" type="text" name="wp_theme_options[LinkIn_url]" value="<?php esc_attr_e($options['LinkIn_url']); ?>" />
                        <label class="description" for="wp_theme_options[LinkIn_url]"><?php _e('The link of your Link In', 'wp'); ?></label>
                    </td>
                </tr>

            </table>

            <p class="submit">
                <input type="submit" class="button-primary" value="<?php _e('Save Options', 'wp'); ?>" />
            </p>
        </form>
    </div>
    <?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate($input) {
    $input['email'] = wp_filter_nohtml_kses($input['email']);
    $input['phone'] = wp_filter_nohtml_kses($input['phone']);
    $input['fax'] = wp_filter_nohtml_kses($input['fax']);
    $input['address'] = wp_filter_nohtml_kses($input['address']);
    $input['fb_url'] = wp_filter_nohtml_kses($input['fb_url']);
    $input['twitter_url'] = wp_filter_nohtml_kses($input['twitter_url']);
    $input['google_url'] = wp_filter_nohtml_kses($input['google_url']);
    $input['LinkIn_url'] = wp_filter_nohtml_kses($input['LinkIn_url']);
    return $input;
}
