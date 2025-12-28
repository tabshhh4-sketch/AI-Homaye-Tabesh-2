<?php
declare(strict_types=1);

namespace HomayeTabesh\Core;

/**
 * Plugin Activator
 * 
 * Handles plugin activation tasks.
 * 
 * @package HomayeTabesh\Core
 */
class Activator
{
    /**
     * Activate plugin
     * 
     * @return void
     */
    public static function activate(): void
    {
        // Check WordPress version
        if (version_compare(get_bloginfo('version'), '6.0', '<')) {
            deactivate_plugins(HOMAYE_TABESH_BASENAME);
            wp_die(
                esc_html__('این افزونه به وردپرس نسخه 6.0 یا بالاتر نیاز دارد.', 'homaye-tabesh'),
                esc_html__('خطای فعال‌سازی افزونه', 'homaye-tabesh'),
                ['back_link' => true]
            );
        }

        // Check PHP version
        if (version_compare(PHP_VERSION, '8.2.0', '<')) {
            deactivate_plugins(HOMAYE_TABESH_BASENAME);
            wp_die(
                esc_html__('این افزونه به PHP نسخه 8.2 یا بالاتر نیاز دارد.', 'homaye-tabesh'),
                esc_html__('خطای فعال‌سازی افزونه', 'homaye-tabesh'),
                ['back_link' => true]
            );
        }

        // Set default options
        self::setDefaultOptions();

        // Flush rewrite rules
        flush_rewrite_rules();
    }

    /**
     * Set default plugin options
     * 
     * @return void
     */
    private static function setDefaultOptions(): void
    {
        $defaultOptions = [
            'version' => HOMAYE_TABESH_VERSION,
            'activated_at' => current_time('mysql'),
        ];

        add_option('homaye_tabesh_options', $defaultOptions);
    }
}
