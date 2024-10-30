<?php

/**
 * Plugin Name: Horizontal News Ticker Addon - Elementor
 * Plugin URI: https://wordpress.org/plugins/horizontal-news-ticker-addon-elementor
 * Description: Horizontal News Ticker Addon is a flexible and easy to use news ticker plugin for WordPress. This plugin will help you to make horizontal news ticker in your website. You can show ticker by post category or by post tags or by creating custom texts with custom links. You can write custom text in WP default post editor.
 * Author: Shakil Ahamed
 * Version: 0.1
 * Author URI: https://shakilahamed.com
 * Text Domain: horizontal-news-ticker-addon-domain
 *
 * Elementor tested up to: 3.7.2
 *
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

//include plugin modules
include_once(ABSPATH . 'wp-admin/includes/plugin.php');

//checking if elementor active
if (is_plugin_active('elementor/elementor.php')) {


    //register widget action
    add_action('elementor/widgets/register', 'register_horizontal_news_ticker_widget');

    add_action('elementor/frontend/after_enqueue_styles', 'register_horizontal_news_ticker_frontend_stylesheet');

    add_action('elementor/frontend/before_register_scripts', 'register_horizontal_news_ticker_frontend_scripts');
} else {

    //notice if elementor isn't installed properly

    add_action('admin_notices', function () {

        $inactive_plugins = '';
        if (!is_plugin_active('elementor/elementor.php')) {
            $inactive_plugins .= "Elementor";
        }

        echo '<div class="error notice is-dismissible"><p>' . esc_attr($inactive_plugins) . ' Isn\'t installed or activated yet, Please install ' . esc_attr($inactive_plugins) . ' plugin and activate it to use this awesome addon (MK Elementor Addon)</p></div>'; // phpcs:ignore WordPress.Security.
    });
}


//register widget Horizontal News Ticker Widget
function register_horizontal_news_ticker_widget($widgets_manager)
{

    require_once(__DIR__ . '/widgets/horizontal-news-ticker-widget.php');

    $widgets_manager->register(new \Elementor_horizontal_news_ticker());
}


//register widget Horizontal News Ticker Style

function register_horizontal_news_ticker_frontend_stylesheet()
{

    wp_register_style('news-ticker-frontend-style-1', plugins_url('assets/css/horizontal-news-ticker.css', __FILE__), array(), time());
    wp_register_style('news-ticker-frontend-style-2', plugins_url('assets/css/horizontal-news-ticker-jquery.simpleTicker.css', __FILE__), array(), time());

    wp_enqueue_style('news-ticker-frontend-style-1');
    wp_enqueue_style('news-ticker-frontend-style-2');
}


function register_horizontal_news_ticker_frontend_scripts()
{

    wp_register_script('horizontal-news-ticker-frontend-script-1', plugins_url('assets/js/horizontal-news-ticker-jquery.simpleTicker.js', __FILE__), array('jquery'), time());

    wp_enqueue_script('horizontal-news-ticker-frontend-script-1');
}
