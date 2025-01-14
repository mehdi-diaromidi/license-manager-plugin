<?php
/*
Plugin Name: My Custom Footer Plugin
Description: A plugin to customize footer content with full styling options.
Version: 1.0
Author: Your Name
*/

// Include necessary files
include_once plugin_dir_path(__FILE__) . 'includes/footer.php';
include_once plugin_dir_path(__FILE__) . 'includes/admin-menu.php';
include_once plugin_dir_path(__FILE__) . 'includes/font-manager.php';
include_once plugin_dir_path(__FILE__) . 'includes/settings.php';
include_once plugin_dir_path(__FILE__) . 'includes/trigger-error.php';
// مقایسه محتوای فوتر با محتوای ذخیره شده در دیتابیس
function compare_footer_content()
{
    // بررسی اینکه فوتر قفل شده باشد
    $options = get_option('license_manager_options');
    if (isset($options['footer_lock_enabled']) && $options['footer_lock_enabled']) {
        // دریافت محتوای HTML فعلی فوتر
        $current_footer_content = generate_footer_content($options);

        // دریافت محتوای ذخیره شده در دیتابیس
        $locked_footer_content = get_option('footer_locked_content');

        // مقایسه محتوا و فراخوانی تابع trigger_license_error() در صورت تغییر
        if ($current_footer_content !== $locked_footer_content) {
            trigger_license_error(); // فراخوانی تابع در صورت تغییر محتوا
        }
    }
}

// بررسی تغییرات محتوا هنگام بارگذاری هر صفحه
add_action('wp_loaded', 'compare_footer_content');

$footer_locked = get_option('footer_lock_enabled', false);
if ($footer_locked) {
    // Show error if footer is locked
    // trigger_license_error();
    return;
}

// افزودن منوی آپلود فونت در منوی مدیریت
function custom_font_upload_menu()
{
    add_menu_page(
        'آپلود فونت سفارشی',
        'فونت سفارشی',
        'manage_options',
        'custom-font-upload',
        'custom_font_settings_page',
        'dashicons-editor-textcolor',
        20
    );
}
add_action('admin_menu', 'custom_font_upload_menu');


// ذخیره محتوای HTML فوتر هنگام قفل کردن فوتر
function license_manager_lock_footer_content()
{
    // بررسی اینکه فوتر قفل شده باشد
    $options = get_option('license_manager_options');
    if (isset($options['footer_lock_enabled']) && $options['footer_lock_enabled']) {
        // ذخیره محتوای HTML فوتر در دیتابیس
        $footer_content = generate_footer_content($options);
        update_option('footer_locked_content', $footer_content); // ذخیره محتوای فوتر
    }
}
add_action('wp_footer', 'license_manager_lock_footer_content');

// تابعی که محتوای HTML فوتر را تولید می‌کند
function generate_footer_content($options)
{
    ob_start(); // شروع ذخیره محتوای HTML در بافر
?>
    <div style="
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        padding: 10px !important;
        background-color: <?php echo esc_attr($options['footer_bg_color']); ?> !important;
        font-family: <?php echo esc_attr($options['footer_font_family']); ?> !important;
        font-size: <?php echo esc_attr($options['footer_font_size']); ?>px !important;
        color: <?php echo esc_attr($options['footer_font_color']); ?> !important;
        border-top: 2px solid #ddd !important;
        visibility: visible !important;
        z-index: 2147483647 !important;
    ">
        <div style="text-align: left !important; visibility: visible !important; z-index: 2147483647 !important;">
            <p style="margin: 0 !important; visibility: visible !important; z-index: 2147483647 !important;">
                تمامی حقوق سایت متعلق به <?php echo esc_html($options['footer_site_text']); ?> می‌باشد.
            </p>
        </div>
        <div style="text-align: right !important; visibility: visible !important; z-index: 2147483647 !important;">
            <p style="margin: 0 !important; visibility: visible !important; z-index: 2147483647 !important;">
                <?php echo esc_html($options['footer_dev_text']); ?>
                <a href="<?php echo esc_url($options['footer_dev_link']); ?>"
                    style="
                       color: <?php echo esc_attr($options['footer_dev_link_color']); ?> !important; 
                       text-decoration: none !important;
                       font-weight: bold !important;
                       visibility: visible !important;
                       z-index: 2147483647 !important;
                   ">
                    <?php echo esc_html($options['footer_dev_text']); ?>
                </a>
            </p>
        </div>
    </div>
<?php
    return ob_get_clean(); // خروج محتوای HTML
}
