<?php

namespace WPSocialReviews\App\Models;

use WPSocialReviews\App\Models\Traits\SearchableScope;

class Notification extends Model
{
    use SearchableScope;

    protected $table = 'posts';

    protected static $type = 'wpsr_reviews_notify';

    /**
     * $searchable Columns in table to search
     * 
     * @var array
     */
    protected $searchable = [
        'ID',
        'post_title',
        'post_content'
    ];

    public static function boot()
    {
        static::creating(function ($model) {
            $model->post_type = static::$type;
            $model->post_status = 'publish';
        });

        static::addGlobalScope(function ($builder) {
            $builder->where('post_type', static::$type);
        });
    }
}
