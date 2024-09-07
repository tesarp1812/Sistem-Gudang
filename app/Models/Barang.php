<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    // The table associated with the model.
    protected $table = 'barang';

    // The attributes that are mass assignable.
    protected $fillable = ['nama_barang', 'kode', 'password'];

    // The attributes that should be hidden for arrays.
    // protected $hidden = ['password', 'remember_token'];
}
