<?php

namespace CodeShopping\Http\Filters\Open;

use Mnabialek\LaravelEloquentFilter\Filters\SimpleQueryFilter;

class ProductFilter extends SimpleQueryFilter
{

    protected $simpleFilters = ['search', 'categories'];

    protected $simpleSorts = ['price', 'created_at'];

    protected function applySearch($value)
    {
        if(empty($value)){
            return;
        }
        $this->query->where('name', 'like', "%$value%")->orWhere('description', 'like', "%$value%");
    }

    protected function applyCategories($value)
    {
        if (!is_array($value) || count($value) === 0) {
            return;
        }

        $this->query->whereHas('categories', function ($query) use ($value) {
            $query->whereIn('category_id', $value)->where('active', true);
        });
    }
}
