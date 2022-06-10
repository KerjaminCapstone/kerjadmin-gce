<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'id_role';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_role', 'id_role', 'id_user');
    }
}