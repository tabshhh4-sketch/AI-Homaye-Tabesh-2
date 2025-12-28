<?php
declare(strict_types=1);

namespace HomayeTabesh\Core;

/**
 * Admin Interface Handler
 * 
 * Manages admin interface assets (scripts and styles).
 * 
 * @package HomayeTabesh\Core
 */
class AdminInterface
{
    /**
     * Enqueue admin assets
     * 
     * @param string $hook Current admin page hook
     * @return void
     */
    public function enqueueAssets(string $hook): void
    {
        // Only load on our plugin pages
        if (!$this->isPluginPage($hook)) {
            return;
        }

        // Enqueue React and admin scripts
        $this->enqueueScripts();

        // Enqueue admin styles
        $this->enqueueStyles();
    }

    /**
     * Check if current page is a plugin page
     * 
     * @param string $hook Current admin page hook
     * @return bool
     */
    private function isPluginPage(string $hook): bool
    {
        $pluginPages = [
            'toplevel_page_atlas-control-center',
            'toplevel_page_homa-super-panel',
        ];

        // Check if hook starts with any of our plugin pages
        foreach ($pluginPages as $page) {
            if (strpos($hook, $page) === 0 || strpos($hook, 'atlas-control-center') !== false || strpos($hook, 'homa-super-panel') !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * Enqueue admin scripts
     * 
     * @return void
     */
    private function enqueueScripts(): void
    {
        // Enqueue React dependencies
        wp_enqueue_script('wp-element');
        wp_enqueue_script('wp-components');
        wp_enqueue_script('wp-i18n');

        // Check if built React app exists
        $reactAppPath = HOMAYE_TABESH_PATH . 'assets/dist/admin-app.js';
        if (file_exists($reactAppPath)) {
            wp_enqueue_script(
                'homaye-tabesh-admin',
                HOMAYE_TABESH_URL . 'assets/dist/admin-app.js',
                ['wp-element', 'wp-components', 'wp-i18n'],
                HOMAYE_TABESH_VERSION,
                true
            );

            // Localize script with plugin data
            wp_localize_script('homaye-tabesh-admin', 'homayeTabeshData', [
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('homaye-tabesh-nonce'),
                'version' => HOMAYE_TABESH_VERSION,
                'pluginUrl' => HOMAYE_TABESH_URL,
            ]);
        }
    }

    /**
     * Enqueue admin styles
     * 
     * @return void
     */
    private function enqueueStyles(): void
    {
        // Check if built CSS exists
        $cssPath = HOMAYE_TABESH_PATH . 'assets/dist/admin-app.css';
        if (file_exists($cssPath)) {
            wp_enqueue_style(
                'homaye-tabesh-admin',
                HOMAYE_TABESH_URL . 'assets/dist/admin-app.css',
                [],
                HOMAYE_TABESH_VERSION
            );
        }

        // Enqueue default admin styles (fallback)
        wp_enqueue_style(
            'homaye-tabesh-admin-default',
            HOMAYE_TABESH_URL . 'assets/css/admin.css',
            [],
            HOMAYE_TABESH_VERSION
        );
    }
}
