<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Mindscms\Entrust\Traits\EntrustUserWithPermissionsTrait;
use Nicolaslopezj\Searchable\SearchableTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, EntrustUserWithPermissionsTrait, SearchableTrait, HasApiTokens, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */


    protected $searchable = [
        'columns' => [
            'users.name' => 10,
            'users.username' => 10,
            'users.email' => 10,
            'users.mobile' => 10,
        ],
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function media()
    {
        return $this->hasOne(UserMedia::class);
    }

    public  function status() {
        return $this->status == 1 ? __('Backend/supervisors.active') : __('Backend/supervisors.inactive');
    }
    public  function userImage() {
        return $this->user_image != '' ? asset('assets/users/'. $this->user_image ) : asset('assets/users/default.jpg');
    }
}
