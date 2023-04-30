<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract
{
    use SoftDeletes;
    use Authenticatable;
    
    protected $guarded = [];

    protected $hidden = array('password', 'token');
    
    protected $table = "users";
    public static $Type = "users";

    const CREATED_AT = 'dateCreated';
    const UPDATED_AT = 'dateUpdated';
    const DELETED_AT = 'dateDeleted';

    public function events() {
        return $this->hasMany(Event::class);
    }
}
