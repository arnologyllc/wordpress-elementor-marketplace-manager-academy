<?php

namespace WPSocialReviews\App\Models\Traits;

trait SearchableScope
{
	/**
     * Local scope to filter subscribers by search/query string
     *
     * @param \WPSocialReviews\Framework\Database\Query\Builder $query
     * @param string $search
     *
     * @return \WPSocialReviews\Framework\Database\Query\Builder
     */
    public function scopeSearchBy($query, $search)
    {
        if ($search) {
            $fields = $this->searchable;
            $query->where(function ($query) use ($fields, $search) {
                $query->where(array_shift($fields), 'LIKE', "%$search%");
                foreach ($fields as $field) {
                    $query->orWhere($field, 'LIKE', "$search%");
                }
            });
        }

        return $query;
    }
}
