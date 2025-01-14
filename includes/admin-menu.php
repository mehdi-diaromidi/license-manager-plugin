<?php
// Add menu item for plugin settings
function license_manager_add_admin_menu()
{
    add_menu_page(
        'تنظیمات پلاگین',                  // Page title
        'مدیریت لایسنس',                   // Menu title
        'manage_options',                  // Capability
        'license-manager-settings',        // Menu slug
        'license_manager_settings_page',   // Callback function
        'dashicons-admin-settings',        // Icon
        20                                 // Position
    );
}
add_action('admin_menu', 'license_manager_add_admin_menu');

function license_manager_settings_page()
{
?>
    <div class="wrap">
        <h1>تنظیمات پلاگین مدیریت لایسنس</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('license_manager_settings');
            do_settings_sections('license-manager-settings');
            ?>
            <hr>
            <button type="button" id="lock_footer_button" class="button button-primary">قفل محتوای فوتر</button>
            <?php submit_button('ذخیره تنظیمات'); ?>
        </form>
    </div>
    <script>
        document.getElementById('lock_footer_button').addEventListener('click', function() {
            var password = prompt('لطفا پسورد خود را وارد کنید');
            if (password && password.length > 0) {
                var confirmPassword = prompt('لطفا پسورد را دوباره وارد کنید');
                if (password === confirmPassword) {
                    // Save the password and set footer lock as true
                    jQuery.post(ajaxurl, {
                        action: 'save_footer_password',
                        password: password
                    }, function(response) {
                        alert('پسورد ذخیره شد!');
                    });
                } else {
                    alert('پسورد ها یکسان نیستند!');
                }
            }
        });
    </script>
<?php
}
