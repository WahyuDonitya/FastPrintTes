<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BarangModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true;
    protected $table = 'barang';
    public $incrementing = true;
    public $primaryKey = 'id_produk';

    protected $fillable = [
        'nama_produk',
        'harga',
        'kategori',
        'status',
    ];
}
