<?php
// Add footer content to WordPress footer
function add_footer_content()
{
    $options = get_option('license_manager_options');
    $bg_color = $options['footer_bg_color'];
    $font_family = $options['footer_font_family'];
    $font_size = $options['footer_font_size'];
    $font_color = $options['footer_font_color'];
    $site_text = $options['footer_site_text'];
    $dev_text = $options['footer_dev_text'];
    $dev_link = $options['footer_dev_link'];
    $dev_link_color = $options['footer_dev_link_color'];
?>
    <div style="
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        padding: 10px !important;
        background-color: <?php echo esc_attr($bg_color); ?> !important;
        font-family: <?php echo esc_attr($font_family); ?> !important;
        font-size: <?php echo esc_attr($font_size); ?>px !important;
        color: <?php echo esc_attr($font_color); ?> !important;
        border-top: 2px solid #ddd !important;
        visibility: visible !important;
        z-index: 2147483647 !important;
    ">
        <div style="text-align: left !important; visibility: visible !important; z-index: 2147483647 !important;">
            <p style="margin: 0 !important; visibility: visible !important; z-index: 2147483647 !important;">
                تمامی حقوق سایت متعلق به <?php echo esc_html($site_text); ?> می‌باشد.
            </p>
        </div>
        <div style="text-align: right !important; visibility: visible !important; z-index: 2147483647 !important;">
            <p style="margin: 0 !important; visibility: visible !important; z-index: 2147483647 !important;">
                <?php echo esc_html($dev_text); ?>
                <a href="<?php echo esc_url($dev_link); ?>"
                    style="
                       color: <?php echo esc_attr($dev_link_color); ?> !important; 
                       text-decoration: none !important;
                       font-weight: bold !important;
                       visibility: visible !important;
                       z-index: 2147483647 !important;
                   ">
                    <?php echo esc_html($dev_text); ?>
                </a>
            </p>
        </div>
    </div>
<?php
}
add_action('wp_footer', 'add_footer_content');

// ذخیره محتوای فوتر در دیتابیس
function license_manager_save_footer_content()
{
    if (isset($_POST['lock_footer']) && $_POST['lock_footer'] === '1') {
        $options = get_option('license_manager_options');
        $footer_content = generate_footer_html(); // ایجاد محتوای فوتر
        update_option('license_manager_footer_content', $footer_content); // ذخیره در دیتابیس
    }
}

// ایجاد HTML محتوای فوتر
function generate_footer_html()
{
    $options = get_option('license_manager_options');
    $bg_color = $options['footer_bg_color'];
    $font_family = $options['footer_font_family'];
    $font_size = $options['footer_font_size'];
    $font_color = $options['footer_font_color'];
    $site_text = $options['footer_site_text'];
    $dev_text = $options['footer_dev_text'];
    $dev_link = $options['footer_dev_link'];
    $dev_link_color = $options['footer_dev_link_color'];

    ob_start();
?>
    <div style="display: flex !important; justify-content: space-between !important; align-items: center !important; padding: 10px !important; background-color: <?php echo esc_attr($bg_color); ?> !important; font-family: <?php echo esc_attr($font_family); ?> !important; font-size: <?php echo esc_attr($font_size); ?>px !important; color: <?php echo esc_attr($font_color); ?> !important; border-top: 2px solid #ddd !important;">
        <div style="text-align: left !important;">
            <p style="margin: 0 !important;">
                تمامی حقوق سایت متعلق به <?php echo esc_html($site_text); ?> می‌باشد.
            </p>
        </div>
        <div style="text-align: right !important;">
            <p style="margin: 0 !important;">
                <?php echo esc_html($dev_text); ?>
                <a href="<?php echo esc_url($dev_link); ?>" style="color: <?php echo esc_attr($dev_link_color); ?> !important; text-decoration: none !important; font-weight: bold !important;">
                    <?php echo esc_html($dev_text); ?>
                </a>
            </p>
        </div>
    </div>
<?php
    return ob_get_clean();
}
add_action('admin_post_lock_footer', 'license_manager_save_footer_content');
