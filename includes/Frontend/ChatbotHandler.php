<?php
declare(strict_types=1);

namespace HomayeTabesh\Frontend;

/**
 * Frontend Chatbot Handler
 * 
 * Manages the frontend chatbot sidebar on the public-facing website.
 * Implements the dual-workspace environment with viewport squeeze logic.
 * 
 * @package HomayeTabesh\Frontend
 */
class ChatbotHandler
{
    /**
     * Initialize the chatbot handler
     * 
     * @return void
     */
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueueAssets']);
    }

    /**
     * Enqueue frontend chatbot assets
     * 
     * @return void
     */
    public function enqueueAssets(): void
    {
        // Get chatbot settings
        $settings = get_option('homaye_tabesh_chatbot_settings', [
            'enabled' => true,
        ]);

        // Don't enqueue if disabled
        if (!($settings['enabled'] ?? true)) {
            return;
        }

        // Check if built chatbot app exists
        $chatbotJsPath = HOMAYE_TABESH_PATH . 'assets/dist/chatbot-app.js';
        $chatbotCssPath = HOMAYE_TABESH_PATH . 'assets/dist/chatbot-app.css';

        if (file_exists($chatbotJsPath)) {
            // Enqueue React dependencies
            wp_enqueue_script(
                'react',
                'https://unpkg.com/react@18/umd/react.production.min.js',
                [],
                '18.2.0',
                true
            );

            wp_enqueue_script(
                'react-dom',
                'https://unpkg.com/react-dom@18/umd/react-dom.production.min.js',
                ['react'],
                '18.2.0',
                true
            );

            // Enqueue chatbot app
            wp_enqueue_script(
                'homa-chatbot',
                HOMAYE_TABESH_URL . 'assets/dist/chatbot-app.js',
                ['react', 'react-dom'],
                HOMAYE_TABESH_VERSION,
                true
            );

            // Localize script with configuration
            wp_localize_script('homa-chatbot', 'homaChatbotConfig', [
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('homa-chatbot-nonce'),
                'apiEndpoint' => rest_url('homaye-tabesh/v1/chat'),
                'siteUrl' => get_site_url(),
                'siteName' => get_bloginfo('name'),
                'settings' => $settings,
            ]);
        }

        if (file_exists($chatbotCssPath)) {
            wp_enqueue_style(
                'homa-chatbot',
                HOMAYE_TABESH_URL . 'assets/dist/chatbot-app.css',
                [],
                HOMAYE_TABESH_VERSION
            );
        }

        // Add inline styles for custom settings
        $this->addCustomStyles($settings);
    }

    /**
     * Add custom inline styles based on settings
     * 
     * @param array $settings Chatbot settings
     * @return void
     */
    private function addCustomStyles(array $settings): void
    {
        $iconColor = $settings['icon_color'] ?? '#4F46E5';
        $sidebarWidth = $settings['sidebar_width'] ?? 400;
        $iconPosition = $settings['icon_position'] ?? 'bottom-left';

        $customCss = "
        :root {
            --homa-sidebar-width: {$sidebarWidth}px;
            --homa-primary-color: {$iconColor};
        }
        ";

        // Adjust icon position
        if ($iconPosition === 'bottom-right') {
            $customCss .= "
            .homa-floating-icon {
                left: auto;
                right: 24px;
            }
            ";
        }

        wp_add_inline_style('homa-chatbot', $customCss);
    }
}
