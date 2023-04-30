<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryEvent extends Model
{
    public $timestamps = false;
    
    protected $table = "category_events";
    public static $Type = "category_events";
}
