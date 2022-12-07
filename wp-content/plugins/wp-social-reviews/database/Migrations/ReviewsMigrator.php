<?php

namespace WPSocialReviews\Database\Migrations;

class ReviewsMigrator
{
    static $tableName = 'wpsr_reviews';

    public static function migrate()
    {
        global $wpdb;
        $charsetCollate = $wpdb->get_charset_collate();
        $table = $wpdb->prefix . static::$tableName;

        if ($wpdb->get_var("SHOW TABLES LIKE '$table'") != $table) {
            $sql = "CREATE TABLE $table (
                `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,		
				`platform_name` varchar(255),
				`source_id` varchar(255),
				`review_id` varchar(255),
				`category` varchar(255),
				`review_title` varchar(255),
				`reviewer_name` varchar(255),
				`reviewer_url` varchar(255),
				`reviewer_img` TEXT NULL,
				`reviewer_text` LONGTEXT NULL,
				`review_time` timestamp NULL,
				`rating` int(11),
				`review_approved` int(11) DEFAULT 1,
				`recommendation_type` varchar(255),
				`fields` LONGTEXT NULL,
                `created_at` TIMESTAMP NULL,
                `updated_at` TIMESTAMP NULL
            ) $charsetCollate;";
            dbDelta($sql);
        } else {
            static::alterTable($table);
        }
    }

    public static function alterTable($table)
    {
        global $wpdb;
        $existing_columns = $wpdb->get_col("DESC {$table}", 0);
        if(!in_array('category', $existing_columns)) {
            $query = 'ALTER TABLE '.$table.' ADD `category` varchar(255) NULL AFTER `source_id`';
            $wpdb->query($query);
        }

        if(!in_array('review_approved', $existing_columns)) {
            $query = 'ALTER TABLE '.$table.' ADD `review_approved` int(11) DEFAULT 1 AFTER `recommendation_type`';
            $wpdb->query($query);
        }

        if(!in_array('review_id', $existing_columns)) {
            $query = 'ALTER TABLE '.$table.' ADD `review_id` varchar(255) NULL AFTER `source_id`';
            $wpdb->query($query);
        }

        if(!in_array('fields', $existing_columns)) {
            $query = 'ALTER TABLE '.$table.' ADD `fields` LONGTEXT NULL AFTER `recommendation_type`';
            $wpdb->query($query);
        }

        $sql =  "ALTER TABLE $table
        MODIFY COLUMN reviewer_img TEXT NULL";
        $wpdb->query($sql);
    }
}
