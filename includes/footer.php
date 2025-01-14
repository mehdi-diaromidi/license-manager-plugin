<?php
// Add footer content to WordPress footer
function add_footer_content()
{
    $bg_color = get_option('footer_bg_color', '#f9f9f9');
    $font_family = get_option('footer_font_family', 'Arial, sans-serif');
    $font_size = get_option('footer_font_size', '14'); // Number only, 'px' added dynamically
    $font_color = get_option('footer_font_color', '#333');
    $site_text = get_option('footer_site_text', get_bloginfo('name'));
    $dev_text = get_option('footer_dev_text', 'توسعه دهنده سایت');
    $dev_link = get_option('footer_dev_link', 'https://wordpress.org/');
    $dev_link_color = get_option('footer_dev_link_color', '#006a4e');
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
                تمامی حقوق سایت متعلق به <?php echo esc_html($site_text); ?> می‌باشد
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
?>