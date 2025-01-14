<?php
// افزودن ساب‌منو به منوی مدیریت وردپرس
function add_lock_setting_submenu()
{
    add_menu_page(
        'تنظیمات قفل', // عنوان صفحه
        'تنظیمات قفل', // عنوان منو
        'manage_options', // سطح دسترسی
        'lock-setting', // اسلاگ صفحه
        'lock_setting_page_content', // تابعی که محتوای صفحه را نشان می‌دهد
        'dashicons-lock', // آیکون منو
        6 // اولویت در منو
    );
}
add_action('admin_menu', 'add_lock_setting_submenu');

// تابع برای نمایش محتوای صفحه تنظیمات قفل
function lock_setting_page_content()
{
    echo '<div class="wrap">';
    echo '<h1>تنظیمات قفل فوتر</h1>';
    echo '<p>در اینجا می‌توانید تنظیمات مربوط به قفل محتویات فوتر را تغییر دهید.</p>';
    echo '</div>';
}
