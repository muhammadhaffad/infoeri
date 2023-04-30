<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $table = "events";
    public static $Type = "events";

    const CREATED_AT = 'dateCreated';
    const UPDATED_AT = 'dateUpdated';
    const DELETED_AT = 'dateDeleted';

    public function categories() {
        return $this->belongsToMany(Category::class, 'category_events');
    }

    public function categories_event($param) {
        return $this->whereHas('categories', function ($q) use ($param) { 
            $q->whereIn('categories.id', $param);
        });
    }

    public function posters() {
        return $this->hasMany(Poster::class, 'event_id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
