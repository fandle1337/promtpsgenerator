<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ModelTemplate extends Model
{
    protected $table = 'templates';
    protected $guarded = [];
    public $timestamps = false;
}