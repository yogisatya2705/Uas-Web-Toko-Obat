<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
  protected $table = 'role_user'; //jika nama tabel bukan nama_model+s
  // protected $primaryKey = 'nip';    //jika primary key bukan id
  // public $incrementing = false;     //jika primary key bukan increment int
  // protected $keyType = 'string';    //jika primary key bukan int
  public $timestamps = true;       //jika tabel tidak menggunakan timestamp (created_at dan updated_at)
  // protected $fillable = ['nama'];//untuk whitelist
  protected $guarded = [];          //untuk blacklist
}
