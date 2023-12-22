<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ModelCategories extends Model
{
    protected $table = 'categories';
    protected $guarded = [];
    public $timestamps = false;

    public function templates(): BelongsToMany
    {
        return $this->belongsToMany(
            ModelTemplate::class,
            'template_categories',
            'code',
            'template_id'
        );
    }
    public function prompts(): BelongsToMany
    {
        return $this->belongsToMany(
            ModelPrompt::class,
            'prompt_categories',
            'code',
            'prompt_id'
        );
    }
}