<?php

namespace WPSocialReviews\App\Models;

use WPSocialReviews\App\Models\Traits\SearchableScope;

class Widget extends Model
{
    use SearchableScope;

    protected static $type = 'wpsr_social_chats';
    protected $table = 'posts';

    public static function boot()
    {
        static::creating(function ($model) {
            $model->post_type   = static::$type;
            $model->post_status = 'publish';
        });

        static::addGlobalScope(function ($builder) {
            $builder->where('post_type', static::$type);
        });
    }

    /**
     * $searchable Columns in table to search
     * @var array
     */
    protected $searchable = [
        'ID',
        'post_title',
        'post_content'
    ];

    public function getWidgetTemplate($search)
    {
        $template = static::searchBy($search)
            ->latest('ID')
            ->paginate();

        return $template;
    }
}