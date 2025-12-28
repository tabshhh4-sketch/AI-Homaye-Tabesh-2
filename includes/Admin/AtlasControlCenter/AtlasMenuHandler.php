<?php
declare(strict_types=1);

namespace HomayeTabesh\Admin\AtlasControlCenter;

/**
 * Atlas Control Center Menu Handler
 * 
 * Handles the main Atlas Control Center menu and its submenus.
 * 
 * @package HomayeTabesh\Admin\AtlasControlCenter
 */
class AtlasMenuHandler
{
    /**
     * Menu slug
     */
    private const MENU_SLUG = 'atlas-control-center';

    /**
     * Register Atlas Control Center menu
     * 
     * @return void
     */
    public function register(): void
    {
        // Add main menu page
        add_menu_page(
            __('مرکز کنترل اطلس', 'homaye-tabesh'),
            __('مرکز کنترل اطلس', 'homaye-tabesh'),
            'manage_options',
            self::MENU_SLUG,
            [$this, 'renderMainPage'],
            $this->getMenuIcon(),
            20
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
                'slug' => self::MENU_SLUG . '-macro-view',
                'title' => __('نمای کلان', 'homaye-tabesh'),
                'callback' => [$this, 'renderMacroView'],
            ],
            [
                'slug' => self::MENU_SLUG . '-live-intervention',
                'title' => __('مداخله زنده', 'homaye-tabesh'),
                'callback' => [$this, 'renderLiveIntervention'],
            ],
            [
                'slug' => self::MENU_SLUG . '-behavior-analysis',
                'title' => __('تحلیل رفتار', 'homaye-tabesh'),
                'callback' => [$this, 'renderBehaviorAnalysis'],
            ],
            [
                'slug' => self::MENU_SLUG . '-recommendations',
                'title' => __('پیشنهادات', 'homaye-tabesh'),
                'callback' => [$this, 'renderRecommendations'],
            ],
            [
                'slug' => self::MENU_SLUG . '-decision-simulator',
                'title' => __('شبیهساز تصمیم', 'homaye-tabesh'),
                'callback' => [$this, 'renderDecisionSimulator'],
            ],
            [
                'slug' => self::MENU_SLUG . '-core-settings',
                'title' => __('تنظیمات هسته', 'homaye-tabesh'),
                'callback' => [$this, 'renderCoreSettings'],
            ],
            [
                'slug' => self::MENU_SLUG . '-advanced-config',
                'title' => __('پیکربندی پیشرفته', 'homaye-tabesh'),
                'callback' => [$this, 'renderAdvancedConfig'],
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
            $submenu[self::MENU_SLUG][0][0] = __('نمای کلان', 'homaye-tabesh');
        }
    }

    /**
     * Get menu icon (dashicon or custom SVG)
     * 
     * @return string
     */
    private function getMenuIcon(): string
    {
        return 'dashicons-admin-multisite';
    }

    /**
     * Render main page (redirects to macro view)
     * 
     * @return void
     */
    public function renderMainPage(): void
    {
        $this->renderMacroView();
    }

    /**
     * Render Macro View page
     * 
     * @return void
     */
    public function renderMacroView(): void
    {
        $this->renderPage('macro-view', __('نمای کلان', 'homaye-tabesh'));
    }

    /**
     * Render Live Intervention page
     * 
     * @return void
     */
    public function renderLiveIntervention(): void
    {
        $this->renderPage('live-intervention', __('مداخله زنده', 'homaye-tabesh'));
    }

    /**
     * Render Behavior Analysis page
     * 
     * @return void
     */
    public function renderBehaviorAnalysis(): void
    {
        $this->renderPage('behavior-analysis', __('تحلیل رفتار', 'homaye-tabesh'));
    }

    /**
     * Render Recommendations page
     * 
     * @return void
     */
    public function renderRecommendations(): void
    {
        $this->renderPage('recommendations', __('پیشنهادات', 'homaye-tabesh'));
    }

    /**
     * Render Decision Simulator page
     * 
     * @return void
     */
    public function renderDecisionSimulator(): void
    {
        $this->renderPage('decision-simulator', __('شبیهساز تصمیم', 'homaye-tabesh'));
    }

    /**
     * Render Core Settings page
     * 
     * @return void
     */
    public function renderCoreSettings(): void
    {
        $this->renderPage('core-settings', __('تنظیمات هسته', 'homaye-tabesh'));
    }

    /**
     * Render Advanced Configuration page
     * 
     * @return void
     */
    public function renderAdvancedConfig(): void
    {
        $this->renderPage('advanced-config', __('پیکربندی پیشرفته', 'homaye-tabesh'));
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
            <div id="homaye-tabesh-root" data-page="atlas-<?php echo esc_attr($pageId); ?>">
                <div class="homaye-tabesh-loading">
                    <p><?php esc_html_e('در حال بارگذاری...', 'homaye-tabesh'); ?></p>
                </div>
            </div>
        </div>
        <?php
    }
}
