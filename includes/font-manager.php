<?php
// Font Manager for Custom Footer Plugin

// Function to load font styles
function load_custom_fonts()
{
    // Define an array of custom fonts that are supported
    $font_families = array(
        'Arial, sans-serif',
        'Tahoma, sans-serif',
        'Verdana, sans-serif',
        'Georgia, serif',
        'Times New Roman, serif',
        'Courier New, monospace'
    );

    // Get the selected font from the plugin's settings
    $font_family = get_option('footer_font_family', 'Arial, sans-serif');

    // Check if the selected font is in the allowed list
    if (in_array($font_family, $font_families)) {
        // Enqueue the selected font
        wp_enqueue_style('custom-font', 'https://fonts.googleapis.com/css2?family=' . urlencode($font_family) . '&display=swap');
    }
}
add_action('wp_enqueue_scripts', 'load_custom_fonts');

// Function to apply custom font to footer
function apply_footer_font()
{
    // Get the selected font from the plugin's settings
    $font_family = get_option('footer_font_family', 'Arial, sans-serif');

    echo "<style>
            #footer {
                font-family: '{$font_family}', sans-serif !important;
            }
          </style>";
}
add_action('wp_footer', 'apply_footer_font');
