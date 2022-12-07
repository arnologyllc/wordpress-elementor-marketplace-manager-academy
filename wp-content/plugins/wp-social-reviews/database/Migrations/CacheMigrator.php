<?php

namespace WPSocialReviews\Database\Migrations;

class CacheMigrator
{
    static $tableName = 'wpsr_caches';

    public static function migrate()
    {
        global $wpdb;

		$charsetCollate = $wpdb->get_charset_collate();

		$table = $wpdb->prefix . static::$tableName;

        if ($wpdb->get_var("SHOW TABLES LIKE '$table'") != $table) {
            $sql = "CREATE TABLE $table (
                `id` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,		
				`platform` varchar(255) null,
				`name` varchar(255),
				`value` LONGTEXT null,
				`expiration` TIMESTAMP NULL,
				`failed_count` int(11) default 0,
                `created_at` TIMESTAMP NULL,
                `updated_at` TIMESTAMP NULL
            ) $charsetCollate;";

            dbDelta($sql);
        }
    }
}
