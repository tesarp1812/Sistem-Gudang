<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    // Jika nama tabel tidak mengikuti konvensi Laravel
    protected $table = 'm_barang';

    // Jika Anda menggunakan UUID sebagai primary key
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    // Menentukan atribut yang dapat diisi secara massal
    protected $fillable = [
        'id',
        'nama_barang',
        'kode',
        'kategori',
        'lokasi',
        'deskripsi',
        'stok',
        'harga',
    ];


}
