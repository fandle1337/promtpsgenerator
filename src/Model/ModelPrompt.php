<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ModelPrompt extends Model
{
    protected $table = 'portal_prompts';
    protected $guarded = [];
    public $timestamps = false;
}