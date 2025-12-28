<?php
declare(strict_types=1);

namespace HomayeTabesh\Core;

/**
 * Main Plugin Class
 * 
 * Singleton pattern implementation for the main plugin functionality.
 * This class orchestrates all plugin components in a modular way.
 * 
 * @package HomayeTabesh\Core
 */
final class Plugin
{
    /**
     * Plugin instance
     * 
     * @var Plugin|null
     */
    private static ?Plugin $instance = null;

    /**
     * Menu Manager instance
     * 
     * @var MenuManager|null
     */
    private ?MenuManager $menuManager = null;

    /**
     * Admin interface handler
     * 
     * @var AdminInterface|null
     */
    private ?AdminInterface $adminInterface = null;

    /**
     * Private constructor to prevent direct instantiation
     */
    private function __construct()
    {
        $this->initializeComponents();
        $this->registerHooks();
    }

    /**
     * Get plugin instance (Singleton)
     * 
     * @return Plugin
     */
    public static function getInstance(): Plugin
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Initialize plugin components
     * 
     * @return void
     */
    private function initializeComponents(): void
    {
        // Initialize menu manager
        $this->menuManager = new MenuManager();

        // Initialize admin interface
        $this->adminInterface = new AdminInterface();
    }

    /**
     * Register WordPress hooks
     * 
     * @return void
     */
    private function registerHooks(): void
    {
        // Admin menu hooks
        add_action('admin_menu', [$this->menuManager, 'registerMenus']);

        // Admin scripts and styles
        add_action('admin_enqueue_scripts', [$this->adminInterface, 'enqueueAssets']);

        // Load text domain for translations
        add_action('init', [$this, 'loadTextDomain']);
    }

    /**
     * Load plugin text domain for translations
     * 
     * @return void
     */
    public function loadTextDomain(): void
    {
        load_plugin_textdomain(
            'homaye-tabesh',
            false,
            dirname(HOMAYE_TABESH_BASENAME) . '/languages'
        );
    }

    /**
     * Prevent cloning of the instance
     * 
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * Prevent unserializing of the instance
     * 
     * @return void
     */
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton");
    }
}
