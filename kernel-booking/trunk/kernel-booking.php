<?php

/**
 *
 * @wordpress-plugin
 * Plugin Name:       Kernel Booking
 * Plugin URI:        https://www.kernelbooking.co.uk
 * Description:       Easily embed Kernel Booking into your Wordpress site.
 * Version:           1.0.0
 * Author:            Kernel Data Ltd
 * Author URI:        https://www.kernel.co.uk
 * License:           GPL-3.0+
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       kernel-booking
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

// Current version
define('KERNEL_BOOKING_VERSION', '1.0.0');

add_shortcode('kernel-booking', function ($atts) {
	$a = shortcode_atts([
		'client' => '',
		'page' => '',
		'detailid' => null,
		'category' => null
	], $atts);

	$client = $a['client'];
	$page = $a['page'];
	$detailid = $a['detailid'];
	$category = $a['category'];

	if (is_null($detailid)) {
		$detailid = 'null';
	}
	if (is_null($category)) {
		$category = 'null';
	}

	wp_enqueue_script('kernel-booking', 'https://account.kernelbooking.co.uk/embed.js');

	$script = <<<SCRIPT
kernel.init({
	client: '$client',
	el: '#kernel-booking',
	page: '$page',
	detailid: $detailid,
	category: $category
})
SCRIPT;
	wp_add_inline_script('kernel-booking', $script);

	return '<div id="kernel-booking" style="width: 100%; max-width: 100%"></div>';
});
