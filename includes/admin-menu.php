<?php
// Add menu item for plugin settings
function license_manager_add_admin_menu()
{
    // Main menu page
    add_menu_page(
        'تنظیمات پلاگین',
        'مدیریت لایسنس',
        'manage_options',
        'license-manager-settings',
        'license_manager_settings_page',
        'dashicons-admin-settings',
        20
    );

    // Add sub menu for lock settings
    add_submenu_page(
        'license-manager-settings', // Parent slug
        'تنظیمات قفل لایسنس', // Page title
        'مدیریت قفل لایسنس', // Menu title
        'manage_options', // Required capability
        'license-manager-lock-settings', // Submenu slug
        'license_manager_lock_settings_page', // Function to display the page
    );
}
add_action('admin_menu', 'license_manager_add_admin_menu');

// Display settings page content
function license_manager_settings_page()
{
?>
    <div class="wrap">
        <h1>تنظیمات پلاگین مدیریت لایسنس</h1>
        <form method="post" action="options.php" enctype="multipart/form-data">
            <?php
            settings_fields('license_manager_settings'); // Settings group
            do_settings_sections('license-manager-settings'); // Page slug
            submit_button('ذخیره تنظیمات', 'primary', 'save_settings');
            ?>
        </form>
    </div>
<?php
}