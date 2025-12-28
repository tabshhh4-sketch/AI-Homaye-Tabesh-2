<?php
declare(strict_types=1);

namespace HomayeTabesh\Admin\ChatbotSettings;

/**
 * Chatbot Settings Handler
 * 
 * Handles the chatbot configuration and customization settings in the admin area.
 * 
 * @package HomayeTabesh\Admin\ChatbotSettings
 */
class SettingsHandler
{
    /**
     * Settings option name
     */
    private const OPTION_NAME = 'homaye_tabesh_chatbot_settings';

    /**
     * Register settings menu and page
     * 
     * @return void
     */
    public function register(): void
    {
        add_submenu_page(
            'atlas-control-center',
            __('تنظیمات چتبات', 'homaye-tabesh'),
            __('تنظیمات چتبات', 'homaye-tabesh'),
            'manage_options',
            'homa-chatbot-settings',
            [$this, 'renderSettingsPage']
        );

        // Register settings
        add_action('admin_init', [$this, 'registerSettings']);
    }

    /**
     * Register plugin settings
     * 
     * @return void
     */
    public function registerSettings(): void
    {
        register_setting(self::OPTION_NAME, self::OPTION_NAME, [
            'type' => 'array',
            'sanitize_callback' => [$this, 'sanitizeSettings'],
            'default' => $this->getDefaultSettings(),
        ]);
    }

    /**
     * Get default settings
     * 
     * @return array
     */
    private function getDefaultSettings(): array
    {
        return [
            'enabled' => true,
            'icon_position' => 'bottom-left',
            'icon_color' => '#4F46E5',
            'sidebar_width' => 400,
            'show_on_pages' => 'all',
            'excluded_pages' => [],
            'welcome_message' => 'به همای تابش خوش آمدید',
            'placeholder_text' => 'پیام خود را بنویسید...',
        ];
    }

    /**
     * Sanitize settings
     * 
     * @param array $settings Settings to sanitize
     * @return array
     */
    public function sanitizeSettings(array $settings): array
    {
        $sanitized = [];

        $sanitized['enabled'] = isset($settings['enabled']);
        $sanitized['icon_position'] = sanitize_text_field($settings['icon_position'] ?? 'bottom-left');
        $sanitized['icon_color'] = sanitize_hex_color($settings['icon_color'] ?? '#4F46E5');
        $sanitized['sidebar_width'] = absint($settings['sidebar_width'] ?? 400);
        $sanitized['show_on_pages'] = sanitize_text_field($settings['show_on_pages'] ?? 'all');
        $sanitized['excluded_pages'] = array_map('absint', $settings['excluded_pages'] ?? []);
        $sanitized['welcome_message'] = sanitize_text_field($settings['welcome_message'] ?? '');
        $sanitized['placeholder_text'] = sanitize_text_field($settings['placeholder_text'] ?? '');

        return $sanitized;
    }

    /**
     * Render settings page
     * 
     * @return void
     */
    public function renderSettingsPage(): void
    {
        // Check user capabilities
        if (!current_user_can('manage_options')) {
            return;
        }

        // Get current settings
        $settings = get_option(self::OPTION_NAME, $this->getDefaultSettings());

        // Handle form submission
        if (isset($_POST['submit']) && check_admin_referer('homa_chatbot_settings')) {
            $settings = $this->sanitizeSettings($_POST[self::OPTION_NAME] ?? []);
            update_option(self::OPTION_NAME, $settings);
            echo '<div class="notice notice-success"><p>' . esc_html__('تنظیمات با موفقیت ذخیره شد.', 'homaye-tabesh') . '</p></div>';
        }

        ?>
        <div class="wrap homaye-tabesh-admin">
            <h1><?php esc_html_e('تنظیمات چتبات هما', 'homaye-tabesh'); ?></h1>
            
            <form method="post" action="">
                <?php wp_nonce_field('homa_chatbot_settings'); ?>
                
                <div class="homaye-tabesh-card">
                    <h2><?php esc_html_e('تنظیمات عمومی', 'homaye-tabesh'); ?></h2>
                    
                    <table class="form-table">
                        <tr>
                            <th scope="row">
                                <label for="chatbot_enabled">
                                    <?php esc_html_e('فعال‌سازی چتبات', 'homaye-tabesh'); ?>
                                </label>
                            </th>
                            <td>
                                <input 
                                    type="checkbox" 
                                    id="chatbot_enabled" 
                                    name="<?php echo esc_attr(self::OPTION_NAME); ?>[enabled]"
                                    value="1"
                                    <?php checked($settings['enabled']); ?>
                                />
                                <p class="description">
                                    <?php esc_html_e('فعال یا غیرفعال کردن نمایش چتبات در سایت', 'homaye-tabesh'); ?>
                                </p>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row">
                                <label for="icon_position">
                                    <?php esc_html_e('موقعیت آیکن شناور', 'homaye-tabesh'); ?>
                                </label>
                            </th>
                            <td>
                                <select id="icon_position" name="<?php echo esc_attr(self::OPTION_NAME); ?>[icon_position]">
                                    <option value="bottom-left" <?php selected($settings['icon_position'], 'bottom-left'); ?>>
                                        <?php esc_html_e('پایین چپ', 'homaye-tabesh'); ?>
                                    </option>
                                    <option value="bottom-right" <?php selected($settings['icon_position'], 'bottom-right'); ?>>
                                        <?php esc_html_e('پایین راست', 'homaye-tabesh'); ?>
                                    </option>
                                </select>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row">
                                <label for="icon_color">
                                    <?php esc_html_e('رنگ آیکن', 'homaye-tabesh'); ?>
                                </label>
                            </th>
                            <td>
                                <input 
                                    type="text" 
                                    id="icon_color" 
                                    name="<?php echo esc_attr(self::OPTION_NAME); ?>[icon_color]"
                                    value="<?php echo esc_attr($settings['icon_color']); ?>"
                                    class="color-picker"
                                />
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row">
                                <label for="sidebar_width">
                                    <?php esc_html_e('عرض سایدبار (پیکسل)', 'homaye-tabesh'); ?>
                                </label>
                            </th>
                            <td>
                                <input 
                                    type="number" 
                                    id="sidebar_width" 
                                    name="<?php echo esc_attr(self::OPTION_NAME); ?>[sidebar_width]"
                                    value="<?php echo esc_attr($settings['sidebar_width']); ?>"
                                    min="300"
                                    max="600"
                                    step="10"
                                />
                                <p class="description">
                                    <?php esc_html_e('عرض سایدبار چتبات (بین 300 تا 600 پیکسل)', 'homaye-tabesh'); ?>
                                </p>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row">
                                <label for="welcome_message">
                                    <?php esc_html_e('پیام خوش‌آمدگویی', 'homaye-tabesh'); ?>
                                </label>
                            </th>
                            <td>
                                <input 
                                    type="text" 
                                    id="welcome_message" 
                                    name="<?php echo esc_attr(self::OPTION_NAME); ?>[welcome_message]"
                                    value="<?php echo esc_attr($settings['welcome_message']); ?>"
                                    class="regular-text"
                                />
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row">
                                <label for="placeholder_text">
                                    <?php esc_html_e('متن Placeholder', 'homaye-tabesh'); ?>
                                </label>
                            </th>
                            <td>
                                <input 
                                    type="text" 
                                    id="placeholder_text" 
                                    name="<?php echo esc_attr(self::OPTION_NAME); ?>[placeholder_text]"
                                    value="<?php echo esc_attr($settings['placeholder_text']); ?>"
                                    class="regular-text"
                                />
                            </td>
                        </tr>
                    </table>
                </div>
                
                <p class="submit">
                    <input 
                        type="submit" 
                        name="submit" 
                        id="submit" 
                        class="button button-primary" 
                        value="<?php esc_attr_e('ذخیره تنظیمات', 'homaye-tabesh'); ?>"
                    />
                </p>
            </form>
        </div>
        
        <script>
            // Initialize color picker if wp-color-picker is available
            jQuery(document).ready(function($) {
                if ($.fn.wpColorPicker) {
                    $('.color-picker').wpColorPicker();
                }
            });
        </script>
        <?php
    }
}
