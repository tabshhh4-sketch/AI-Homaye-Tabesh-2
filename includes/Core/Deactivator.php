<?php
declare(strict_types=1);

namespace HomayeTabesh\Core;

/**
 * Plugin Deactivator
 * 
 * Handles plugin deactivation tasks.
 * 
 * @package HomayeTabesh\Core
 */
class Deactivator
{
    /**
     * Deactivate plugin
     * 
     * @return void
     */
    public static function deactivate(): void
    {
        // Flush rewrite rules
        flush_rewrite_rules();

        // Clean up temporary data if needed
        // Note: We don't delete options here to preserve settings
    }
}
