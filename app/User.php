<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'email', 'password', 'point', 'jk', 'tgllahir', 'alamat', 'nohp'
  ];

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
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function roles()
  {
    return $this
      ->belongsToMany('App\Role')
      ->withTimestamps();
  }

  public function authorizeRoles($roles)
  {
    if ($this->hasAnyRole($roles)) {
      return true;
    }
    abort(401, 'This action is unauthorized.');
  }
  public function hasAnyRole($roles)
  {
    if (is_array($roles)) {
      foreach ($roles as $role) {
        if ($this->hasRole($role)) {
          return true;
        }
      }
    } else {
      if ($this->hasRole($roles)) {
        return true;
      }
    }
    return false;
  }
  public function hasRole($role)
  {
    if ($this->roles()->where('name', $role)->first()) {
      return true;
    }
    return false;
  }

  public function rolesMember()
  {
    return $this
      ->belongsToMany('App\Role')
      ->where('name', 'ROLE_MEMBER');
  }

  public function pembelian()
  {
    return $this->hasMany('App\Pembelian');
  }
}
