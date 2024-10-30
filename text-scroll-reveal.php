<?php
/*
Plugin Name: Text Scroll Reveal
Plugin URI:  https://github.com/stevennoad/text-scroll-reveal
Description: A custom Elementor widget that applies a fade-in effect to text elements based on the user's scroll position. Each character is animated independently, creating a smooth, engaging text reveal effect as the user scrolls down the page.
Version:     1.0.0
Author:      Steve Noad
License:     MIT
Text Domain: text-scroll-reveal
*/

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

function register_text_scroll_reveal_widget( $widgets_manager ) {
  require_once( __DIR__ . '/widgets/text-scroll-reveal-widget.php' );
  $widgets_manager->register( new \Text_Scroll_Reveal_Widget() );
}
add_action( 'elementor/widgets/register', 'register_text_scroll_reveal_widget' );

add_action( 'elementor/frontend/after_enqueue_scripts', function() {
  wp_register_script( 'text-scroll-reveal-script', plugins_url( 'text-scroll-reveal.js', __FILE__ ), [ 'jquery' ], false, true );
});

// Wordpress auto updater
require 'includes/plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
  'https://github.com/stevennoad/text-scroll-reveal/',
  __FILE__,
  'restrict-wordpress-rest-api'
);
$myUpdateChecker->getVcsApi()->enableReleaseAssets();
