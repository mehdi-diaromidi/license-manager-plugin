<?php
// Add settings page for the plugin
function my_plugin_settings_page()
{
    add_menu_page(
        'Footer Settings',
        'Footer Settings',
        'manage_options',
        'my-footer-settings',
        'my_plugin_render_settings_page',
        'dashicons-admin-generic'
    );
}
add_action('admin_menu', 'my_plugin_settings_page');

function my_plugin_render_settings_page()
{
    // Check if the user is an administrator
    if (!current_user_can('administrator')) {
        echo '<div class="alert alert-danger">شما اجازه دسترسی به این تنظیمات را ندارید.</div>';
        return;
    }

    if (isset($_POST['save_footer_settings'])) {
        update_option('footer_bg_color', sanitize_hex_color($_POST['footer_bg_color']));
        update_option('footer_font_family', sanitize_text_field($_POST['footer_font_family']));
        update_option('footer_font_size', intval($_POST['footer_font_size']));
        update_option('footer_font_color', sanitize_hex_color($_POST['footer_font_color']));
        update_option('footer_site_text', sanitize_text_field($_POST['footer_site_text']));
        update_option('footer_dev_text', sanitize_text_field($_POST['footer_dev_text']));
        update_option('footer_dev_link', esc_url_raw($_POST['footer_dev_link']));
        update_option('footer_dev_link_color', sanitize_hex_color($_POST['footer_dev_link_color']));
        echo '<div class="alert alert-success">تنظیمات با موفقیت ذخیره شد</div>';
    }

    // Get stored values or use defaults
    $bg_color = get_option('footer_bg_color', '#f9f9f9');
    $font_family = get_option('footer_font_family', 'Arial, sans-serif');
    $font_size = get_option('footer_font_size', '14');
    $font_color = get_option('footer_font_color', '#333');
    $site_text = get_option('footer_site_text', get_bloginfo('name'));
    $dev_text = get_option('footer_dev_text', 'توسعه دهنده سایت');
    $dev_link = get_option('footer_dev_link', 'https://wordpress.org/');
    $dev_link_color = get_option('footer_dev_link_color', '#006a4e');
?>
    <div class="wrap">
        <h1 class="wp-heading-inline">تنظیمات فوتر</h1>
        <form method="post" class="mt-4">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="footer_bg_color" class="form-label">رنگ پس‌زمینه:</label>
                    <input type="color" id="footer_bg_color" name="footer_bg_color" value="<?php echo esc_attr($bg_color); ?>" class="form-control form-control-lg">
                    <small class="form-text text-muted">رنگ پس‌زمینه فوتر را انتخاب کنید.</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="footer_font_family" class="form-label">فونت:</label>
                    <select id="footer_font_family" name="footer_font_family" class="form-select form-select-lg">
                        <option value="Arial, sans-serif" <?php selected($font_family, 'Arial, sans-serif'); ?>>Arial</option>
                        <option value="Tahoma, sans-serif" <?php selected($font_family, 'Tahoma, sans-serif'); ?>>Tahoma</option>
                        <option value="Verdana, sans-serif" <?php selected($font_family, 'Verdana, sans-serif'); ?>>Verdana</option>
                    </select>
                    <small class="form-text text-muted">فونت مورد نظر برای فوتر را انتخاب کنید.</small>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="footer_font_size" class="form-label">اندازه فونت:</label>
                    <input type="number" id="footer_font_size" name="footer_font_size" value="<?php echo esc_attr($font_size); ?>" class="form-control form-control-lg">
                    <small class="form-text text-muted">اندازه فونت فوتر را وارد کنید.</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="footer_font_color" class="form-label">رنگ فونت:</label>
                    <input type="color" id="footer_font_color" name="footer_font_color" value="<?php echo esc_attr($font_color); ?>" class="form-control form-control-lg">
                    <small class="form-text text-muted">رنگ متن فوتر را انتخاب کنید.</small>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="footer_site_text" class="form-label">متن سایت:</label>
                    <input type="text" id="footer_site_text" name="footer_site_text" value="<?php echo esc_attr($site_text); ?>" class="form-control form-control-lg">
                    <small class="form-text text-muted">نام سایت شما را وارد کنید.</small>
                </div>

                <div class="col-md-12 mb-3">
                    <label for="footer_dev_text" class="form-label">متن توسعه‌دهنده:</label>
                    <input type="text" id="footer_dev_text" name="footer_dev_text" value="<?php echo esc_attr($dev_text); ?>" class="form-control form-control-lg">
                    <small class="form-text text-muted">متن توسعه‌دهنده را وارد کنید.</small>
                </div>

                <div class="col-md-12 mb-3">
                    <label for="footer_dev_link" class="form-label">لینک توسعه‌دهنده:</label>
                    <input type="url" id="footer_dev_link" name="footer_dev_link" value="<?php echo esc_attr($dev_link); ?>" class="form-control form-control-lg">
                    <small class="form-text text-muted">لینک وب‌سایت توسعه‌دهنده را وارد کنید.</small>
                </div>

                <div class="col-md-12 mb-3">
                    <label for="footer_dev_link_color" class="form-label">رنگ لینک توسعه‌دهنده:</label>
                    <input type="color" id="footer_dev_link_color" name="footer_dev_link_color" value="<?php echo esc_attr($dev_link_color); ?>" class="form-control form-control-lg">
                    <small class="form-text text-muted">رنگ لینک توسعه‌دهنده را انتخاب کنید.</small>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" name="save_footer_settings" class="btn btn-primary btn-lg">ذخیره تنظیمات</button>
            </div>
        </form>
    </div>
<?php
}
?>