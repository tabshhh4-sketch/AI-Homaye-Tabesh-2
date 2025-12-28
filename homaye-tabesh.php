<?php
declare(strict_types=1);

/**
 * Plugin Name: همای تابش
 * Plugin URI: https://github.com/tabshhh4-sketch/AI-Homaye-Tabesh-2
 * Description: افزونه‌ای میانلایه، ماژولار و هدایتگر کاربران، قدرتگرفته از هوش مصنوعی
 * Version: 1.0.0
 * Requires at least: 6.0
 * Requires PHP: 8.2
 * Author: Homaye Tabesh Team
 * Author URI: https://github.com/tabshhh4-sketch/AI-Homaye-Tabesh-2
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: homaye-tabesh
 * Domain Path: /languages
 *
 * @package HomayeTabesh
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Plugin constants
define('HOMAYE_TABESH_VERSION', '1.0.0');
define('HOMAYE_TABESH_FILE', __FILE__);
define('HOMAYE_TABESH_PATH', plugin_dir_path(__FILE__));
define('HOMAYE_TABESH_URL', plugin_dir_url(__FILE__));
define('HOMAYE_TABESH_BASENAME', plugin_basename(__FILE__));

// Require Composer autoloader
if (file_exists(HOMAYE_TABESH_PATH . 'vendor/autoload.php')) {
    require_once HOMAYE_TABESH_PATH . 'vendor/autoload.php';
}

// Initialize the plugin
add_action('plugins_loaded', function () {
    if (class_exists('HomayeTabesh\\Core\\Plugin')) {
        HomayeTabesh\Core\Plugin::getInstance();
    }
});

// Activation hook
register_activation_hook(__FILE__, function () {
    if (class_exists('HomayeTabesh\\Core\\Activator')) {
        HomayeTabesh\Core\Activator::activate();
    }
});

// Deactivation hook
register_deactivation_hook(__FILE__, function () {
    if (class_exists('HomayeTabesh\\Core\\Deactivator')) {
        HomayeTabesh\Core\Deactivator::deactivate();
    }
});
