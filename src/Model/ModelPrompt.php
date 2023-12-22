<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ModelPrompt extends Model
{
    protected $table = 'portal_prompts';
    protected $guarded = [];
    public $timestamps = false;

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            ModelCategories::class,
            'prompt_categories',
            'prompt_id',
            'code',
        );
    }
}