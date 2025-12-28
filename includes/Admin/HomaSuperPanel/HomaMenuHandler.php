<?php
declare(strict_types=1);

namespace HomayeTabesh\Admin\HomaSuperPanel;

/**
 * Homa Super Panel Menu Handler
 * 
 * Handles the main Homa Super Panel menu and its submenus.
 * 
 * @package HomayeTabesh\Admin\HomaSuperPanel
 */
class HomaMenuHandler
{
    /**
     * Menu slug
     */
    private const MENU_SLUG = 'homa-super-panel';

    /**
     * Register Homa Super Panel menu
     * 
     * @return void
     */
    public function register(): void
    {
        // Add main menu page
        add_menu_page(
            __('سوپرپنل هما', 'homaye-tabesh'),
            __('سوپرپنل هما', 'homaye-tabesh'),
            'manage_options',
            self::MENU_SLUG,
            [$this, 'renderMainPage'],
            $this->getMenuIcon(),
            21
        );

        // Add submenus
        $this->registerSubmenus();
    }

    /**
     * Register all submenus
     * 
     * @return void
     */
    private function registerSubmenus(): void
    {
        $submenus = [
            [
                'slug' => self::MENU_SLUG . '-executive-dashboard',
                'title' => __('داشبورد اجرایی', 'homaye-tabesh'),
                'callback' => [$this, 'renderExecutiveDashboard'],
            ],
            [
                'slug' => self::MENU_SLUG . '-user-management',
                'title' => __('مدیریت کاربران', 'homaye-tabesh'),
                'callback' => [$this, 'renderUserManagement'],
            ],
            [
                'slug' => self::MENU_SLUG . '-health-diagnostics',
                'title' => __('سلامت و عیبیابی', 'homaye-tabesh'),
                'callback' => [$this, 'renderHealthDiagnostics'],
            ],
            [
                'slug' => self::MENU_SLUG . '-brain-development',
                'title' => __('توسعه مغز', 'homaye-tabesh'),
                'callback' => [$this, 'renderBrainDevelopment'],
            ],
            [
                'slug' => self::MENU_SLUG . '-security',
                'title' => __('امنیت', 'homaye-tabesh'),
                'callback' => [$this, 'renderSecurity'],
            ],
            [
                'slug' => self::MENU_SLUG . '-master-observer',
                'title' => __('ناظر کل', 'homaye-tabesh'),
                'callback' => [$this, 'renderMasterObserver'],
            ],
            [
                'slug' => self::MENU_SLUG . '-persona',
                'title' => __('پرسونا', 'homaye-tabesh'),
                'callback' => [$this, 'renderPersona'],
            ],
        ];

        foreach ($submenus as $submenu) {
            add_submenu_page(
                self::MENU_SLUG,
                $submenu['title'],
                $submenu['title'],
                'manage_options',
                $submenu['slug'],
                $submenu['callback']
            );
        }

        // Rename first submenu to match the main menu
        global $submenu;
        if (isset($submenu[self::MENU_SLUG][0])) {
            $submenu[self::MENU_SLUG][0][0] = __('داشبورد اجرایی', 'homaye-tabesh');
        }
    }

    /**
     * Get menu icon (dashicon or custom SVG)
     * 
     * @return string
     */
    private function getMenuIcon(): string
    {
        return 'dashicons-superhero';
    }

    /**
     * Render main page (redirects to executive dashboard)
     * 
     * @return void
     */
    public function renderMainPage(): void
    {
        $this->renderExecutiveDashboard();
    }

    /**
     * Render Executive Dashboard page
     * 
     * @return void
     */
    public function renderExecutiveDashboard(): void
    {
        $this->renderPage('executive-dashboard', __('داشبورد اجرایی', 'homaye-tabesh'));
    }

    /**
     * Render User Management page
     * 
     * @return void
     */
    public function renderUserManagement(): void
    {
        $this->renderPage('user-management', __('مدیریت کاربران', 'homaye-tabesh'));
    }

    /**
     * Render Health & Diagnostics page
     * 
     * @return void
     */
    public function renderHealthDiagnostics(): void
    {
        $this->renderPage('health-diagnostics', __('سلامت و عیبیابی', 'homaye-tabesh'));
    }

    /**
     * Render Brain Development page
     * 
     * @return void
     */
    public function renderBrainDevelopment(): void
    {
        $this->renderPage('brain-development', __('توسعه مغز', 'homaye-tabesh'));
    }

    /**
     * Render Security page
     * 
     * @return void
     */
    public function renderSecurity(): void
    {
        $this->renderPage('security', __('امنیت', 'homaye-tabesh'));
    }

    /**
     * Render Master Observer page
     * 
     * @return void
     */
    public function renderMasterObserver(): void
    {
        $this->renderPage('master-observer', __('ناظر کل', 'homaye-tabesh'));
    }

    /**
     * Render Persona page
     * 
     * @return void
     */
    public function renderPersona(): void
    {
        $this->renderPage('persona', __('پرسونا', 'homaye-tabesh'));
    }

    /**
     * Generic page renderer
     * 
     * @param string $pageId Page identifier
     * @param string $pageTitle Page title
     * @return void
     */
    private function renderPage(string $pageId, string $pageTitle): void
    {
        ?>
        <div class="wrap homaye-tabesh-admin">
            <h1><?php echo esc_html($pageTitle); ?></h1>
            <div id="homaye-tabesh-root" data-page="homa-<?php echo esc_attr($pageId); ?>">
                <div class="homaye-tabesh-loading">
                    <p><?php esc_html_e('در حال بارگذاری...', 'homaye-tabesh'); ?></p>
                </div>
            </div>
        </div>
        <?php
    }
}
