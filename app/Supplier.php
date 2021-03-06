<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
  protected $table = 'supplier'; //jika nama tabel bukan nama_model+s
  // protected $primaryKey = 'nip';    //jika primary key bukan id
  public $incrementing = false;     //jika primary key bukan increment int
  protected $keyType = 'string';    //jika primary key bukan int
  public $timestamps = false;       //jika tabel tidak menggunakan timestamp (created_at dan updated_at)
  // protected $fillable = ['nama'];//untuk whitelist
  protected $guarded = [];          //untuk blacklist
}
