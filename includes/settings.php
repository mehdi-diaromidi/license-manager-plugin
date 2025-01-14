<?php
// Register all settings at once in an array
function license_manager_register_settings()
{
    // Register a single setting for all options
    register_setting(
        'license_manager_settings', // Group name
        'license_manager_options',  // Option name
        'license_manager_options_validate' // Validation callback (optional)
    );

    // Add a settings section
    add_settings_section(
        'license_manager_footer_section',  // Section ID
        'تنظیمات فوتر',                   // Title
        null,                              // Callback function
        'license-manager-settings'         // Page slug
    );

    // Add fields to the section
    add_settings_field(
        'footer_bg_color',
        'رنگ پس‌زمینه:',
        'license_manager_footer_bg_color_callback',
        'license-manager-settings',
        'license_manager_footer_section'
    );

    add_settings_field(
        'footer_font_family',
        'فونت:',
        'license_manager_footer_font_family_callback',
        'license-manager-settings',
        'license_manager_footer_section'
    );

    add_settings_field(
        'footer_font_size',
        'اندازه فونت:',
        'license_manager_footer_font_size_callback',
        'license-manager-settings',
        'license_manager_footer_section'
    );

    add_settings_field(
        'footer_font_color',
        'رنگ فونت:',
        'license_manager_footer_font_color_callback',
        'license-manager-settings',
        'license_manager_footer_section'
    );

    add_settings_field(
        'footer_site_text',
        'متن سایت:',
        'license_manager_footer_site_text_callback',
        'license-manager-settings',
        'license_manager_footer_section'
    );

    add_settings_field(
        'footer_dev_text',
        'متن توسعه‌دهنده:',
        'license_manager_footer_dev_text_callback',
        'license-manager-settings',
        'license_manager_footer_section'
    );

    add_settings_field(
        'footer_dev_link',
        'لینک توسعه‌دهنده:',
        'license_manager_footer_dev_link_callback',
        'license-manager-settings',
        'license_manager_footer_section'
    );

    add_settings_field(
        'footer_dev_link_color',
        'رنگ لینک توسعه‌دهنده:',
        'license_manager_footer_dev_link_color_callback',
        'license-manager-settings',
        'license_manager_footer_section'
    );
    // Add new settings for locking the footer
    add_settings_field(
        'footer_lock_enabled',
        'قفل محتوای فوتر:',
        'license_manager_footer_lock_enabled_callback',
        'license-manager-settings',
        'license_manager_footer_section'
    );

    add_settings_field(
        'footer_password',
        'پسورد فوتر:',
        'license_manager_footer_password_callback',
        'license-manager-settings',
        'license_manager_footer_section'
    );
}
add_action('admin_init', 'license_manager_register_settings');

// Validation callback for settings (optional)
function license_manager_options_validate($input)
{
    // You can add validation logic here if needed
    return $input;
}

// Callback functions for each field
function license_manager_footer_bg_color_callback()
{
    $options = get_option('license_manager_options');
    $value = isset($options['footer_bg_color']) ? esc_attr($options['footer_bg_color']) : '#ffffff';
    echo '<input type="color" id="footer_bg_color" name="license_manager_options[footer_bg_color]" value="' . $value . '" />';
}

function license_manager_footer_font_family_callback()
{
    $options = get_option('license_manager_options');
    $value = isset($options['footer_font_family']) ? esc_attr($options['footer_font_family']) : 'Arial, sans-serif';
    echo '<select id="footer_font_family" name="license_manager_options[footer_font_family]">
            <option value="Arial, sans-serif" ' . selected($value, 'Arial, sans-serif', false) . '>Arial</option>
            <option value="Tahoma, sans-serif" ' . selected($value, 'Tahoma, sans-serif', false) . '>Tahoma</option>
            <option value="Verdana, sans-serif" ' . selected($value, 'Verdana, sans-serif', false) . '>Verdana</option>
          </select>';
}

function license_manager_footer_font_size_callback()
{
    $options = get_option('license_manager_options');
    $value = isset($options['footer_font_size']) ? esc_attr($options['footer_font_size']) : '14';
    echo '<input type="number" id="footer_font_size" name="license_manager_options[footer_font_size]" value="' . $value . '" min="10" max="50" />';
}

function license_manager_footer_font_color_callback()
{
    $options = get_option('license_manager_options');
    $value = isset($options['footer_font_color']) ? esc_attr($options['footer_font_color']) : '#000000';
    echo '<input type="color" id="footer_font_color" name="license_manager_options[footer_font_color]" value="' . $value . '" />';
}

function license_manager_footer_site_text_callback()
{
    $options = get_option('license_manager_options');
    $value = isset($options['footer_site_text']) ? esc_attr($options['footer_site_text']) : get_bloginfo('name');
    echo '<input type="text" id="footer_site_text" name="license_manager_options[footer_site_text]" value="' . $value . '" />';
}

function license_manager_footer_dev_text_callback()
{
    $options = get_option('license_manager_options');
    $value = isset($options['footer_dev_text']) ? esc_attr($options['footer_dev_text']) : '';
    echo '<input type="text" id="footer_dev_text" name="license_manager_options[footer_dev_text]" value="' . $value . '" />';
}

function license_manager_footer_dev_link_callback()
{
    $options = get_option('license_manager_options');
    $value = isset($options['footer_dev_link']) ? esc_attr($options['footer_dev_link']) : '';
    echo '<input type="url" id="footer_dev_link" name="license_manager_options[footer_dev_link]" value="' . $value . '" />';
}

function license_manager_footer_dev_link_color_callback()
{
    $options = get_option('license_manager_options');
    $value = isset($options['footer_dev_link_color']) ? esc_attr($options['footer_dev_link_color']) : '#000000';
    echo '<input type="color" id="footer_dev_link_color" name="license_manager_options[footer_dev_link_color]" value="' . $value . '" />';
}

// Callback function for the "قفل محتوای فوتر" option
function license_manager_footer_lock_enabled_callback()
{
    $options = get_option('license_manager_options');
    $value = isset($options['footer_lock_enabled']) ? (bool) $options['footer_lock_enabled'] : false;
    echo '<input type="checkbox" id="footer_lock_enabled" name="license_manager_options[footer_lock_enabled]" ' . checked($value, true, false) . ' />';
}

// Callback function for the "پسورد فوتر" option
function license_manager_footer_password_callback()
{
    $options = get_option('license_manager_options');
    $value = isset($options['footer_password']) ? esc_attr($options['footer_password']) : '';
    echo '<input type="password" id="footer_password" name="license_manager_options[footer_password]" value="' . $value . '" />';
}




function license_manager_save_footer_password()
{
    if (isset($_POST['password'])) {
        $password = sanitize_text_field($_POST['password']);
        update_option('footer_password', $password);
        update_option('footer_lock_enabled', true); // Lock the footer
        wp_send_json_success();
    } else {
        wp_send_json_error();
    }
}

add_action('wp_ajax_save_footer_password', 'license_manager_save_footer_password');
