<?php

/**
 * Plugin Name: The Property
 * Plugin URI:  http://#
 * Description: Плагин создает недвижимость
 * Version:     1.0.0
 * Author:      Denis Gurov
 * Author URI:  https://#
 */

require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/wee-widget-building.php';
require_once __DIR__ . '/includes/wee-ajax-handler.php';

add_action( 'init', 'wee_register_post_type' );
add_action( 'widgets_init', 'wee_widget_building' );
add_action( 'wp_ajax_customfilter', 'posts_filters' );
add_action( 'wp_ajax_nopriv_customfilter', 'posts_filters' );

function wee_widget_building() {
	register_widget( 'Wee_Widget_Building' );
}

function wee_enqueue_scripts() {
	wp_register_script( 'wee_main', plugins_url( 'js/main.js', __FILE__ ), array( 'jquery' ) );
	wp_enqueue_script( 'wee_main' );
	wp_enqueue_style( 'wee_style', plugins_url( 'css/style.css', __FILE__ ) );
}