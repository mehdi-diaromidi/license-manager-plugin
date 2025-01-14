<?php
/*
Plugin Name: My Custom Footer Plugin
Description: A plugin to customize footer content with full styling options.
Version: 1.0
Author: Your Name
*/

// Include necessary files
include_once plugin_dir_path(__FILE__) . 'includes/footer.php';
include_once plugin_dir_path(__FILE__) . 'includes/settings.php';
include_once plugin_dir_path(__FILE__) . 'includes/font-manager.php';

// Hook to enqueue admin styles and scripts
add_action('admin_enqueue_scripts', function () {
    wp_enqueue_style('my-plugin-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css');
    wp_enqueue_script('my-plugin-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
});
?>
