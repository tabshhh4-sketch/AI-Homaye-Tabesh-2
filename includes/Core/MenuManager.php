<?php
declare(strict_types=1);

namespace HomayeTabesh\Core;

use HomayeTabesh\Admin\AtlasControlCenter\AtlasMenuHandler;
use HomayeTabesh\Admin\HomaSuperPanel\HomaMenuHandler;

/**
 * Menu Manager
 * 
 * Manages WordPress admin menus for the plugin.
 * Handles both Atlas Control Center and Homa Super Panel menus.
 * 
 * @package HomayeTabesh\Core
 */
class MenuManager
{
    /**
     * Atlas Control Center menu handler
     * 
     * @var AtlasMenuHandler
     */
    private AtlasMenuHandler $atlasHandler;

    /**
     * Homa Super Panel menu handler
     * 
     * @var HomaMenuHandler
     */
    private HomaMenuHandler $homaHandler;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->atlasHandler = new AtlasMenuHandler();
        $this->homaHandler = new HomaMenuHandler();
    }

    /**
     * Register all admin menus
     * 
     * @return void
     */
    public function registerMenus(): void
    {
        // Register Atlas Control Center menu
        $this->atlasHandler->register();

        // Register Homa Super Panel menu
        $this->homaHandler->register();
    }
}
