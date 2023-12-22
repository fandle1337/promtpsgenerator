<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ModelTemplate extends Model
{
    protected $table = 'templates';
    protected $guarded = [];
    public $timestamps = false;

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            ModelCategories::class,
            'template_categories',
            'template_id',
            'code'
        );
    }
}