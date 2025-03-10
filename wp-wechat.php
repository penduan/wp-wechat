<?php
/**
 * Plugin Name:       Wp Wechat
 * Description:       为wordpress适配微信小程序环境,旨在复用wordpress的block块编辑器可以更好的与小程序交互
 * Version:           0.1.0
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wp-wechat
 *
 * @package CreateBlock
 */

defined( 'ABSPATH' ) || exit;

/**
 * 注册activation hook
 * 可以用来初始化一些东西
 * 例如: 添加一些默认的设置
 */
function wp_wechat_activation_hook() {
}
register_activation_hook( __FILE__, 'wp_wechat_activation_hook' );

/**
 * 注册deactivation hook
 * 可以用来一些缓存清理等操作
 * @return void
 */
function wp_wechat_deactivation_hook() {

}

register_deactivation_hook( __FILE__, 'wp_wechat_deactivation_hook' );


/**
 * 注册uninstall hook
 * 可以用来清理一些数据
 */
function wp_wechat_uninstall_hook() {
}

register_uninstall_hook( __FILE__, 'wp_wechat_uninstall_hook' );

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function register_block_wp_wechat_blocks() {

	if ( file_exists( __DIR__ . '/build/blocks' ) ) {
		$block_json_files = glob( __DIR__ . '/build/blocks/*/block.json' );
		foreach ( $block_json_files as $filename ) {
			$block_folder = dirname( $filename );
			register_block_type( $block_folder );
		}
	}

	// 注册lit框架 - 方便后面的组件开发
	wp_register_script(
		'lit',
		'https://cdn.jsdelivr.net/gh/lit/dist@3/all/lit-all.min.js',
		array(),
		'3.0.0',
		true
	);

	// 注册微信jssdk
	wp_register_script(
		'jweixin',
		'https://res.wx.qq.com/open/js/jweixin-1.3.2.js',
		array(),
		'1.3.2',
		false
	);

}

add_action( 'init', 'register_block_wp_wechat_blocks' );

/**
 * 注册微信小程序页面脚本
 *
 * 脚本: https://res.wx.qq.com/open/js/jweixin-1.3.2.js
 */
function inject_wechat_miniprogram_script() {
	// 如果不是wechat环境则不注入脚本
	if ( ! isset( $_SERVER['HTTP_USER_AGENT'] ) || strpos( $_SERVER['HTTP_USER_AGENT'], 'MicroMessenger' ) === false ) {
		return;
	}

	// 注入微信jssdk
	wp_enqueue_script( 'jweixin' );
}

add_action( 'init', 'inject_wechat_miniprogram_script' );


