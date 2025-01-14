<?php
function trigger_license_error()
{
    $options = get_option('license_manager_options');

    $dev_text = isset($options['footer_dev_text']) ? esc_html($options['footer_dev_text']) : 'تیم پشتیبانی';
    $dev_link = isset($options['footer_dev_link']) ? esc_url($options['footer_dev_link']) : '#';

    exit('<h6>لایسنس وبسایت شما معتبر نمی‌باشد، لطفا با <a href="' . $dev_link . '" target="_blank">' . $dev_text . '</a> تماس بگیرید!</h6>');
}
