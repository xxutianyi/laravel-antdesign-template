<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'id',
        'name',
        'email',
        'mobile',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = [
        'roles',
    ];

    public static function findWecom(string $id)
    {
        return User::where('wecom_id', $id)->first();
    }

    public function getAllPermissionNames(): array
    {
        $names = [];
        $permissions = $this->getAllPermissions();
        foreach ($permissions as $permission) {
            array_push($names, $permission->name);
        }
        sort($names);
        return $names;
    }

}
