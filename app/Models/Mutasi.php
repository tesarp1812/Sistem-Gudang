<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    // Jika nama tabel tidak mengikuti konvensi Laravel
    protected $table = 'm_mutasi';

    // Jika Anda menggunakan UUID sebagai primary key
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    // Menentukan atribut yang dapat diisi secara massal
    protected $fillable = [
        'id',
        'm_barang_id',
        'm_users_id',
        'jenis_mutasi',
        'jumlah',
    ];


}
