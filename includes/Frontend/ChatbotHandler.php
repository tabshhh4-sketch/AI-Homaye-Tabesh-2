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
    }
}
