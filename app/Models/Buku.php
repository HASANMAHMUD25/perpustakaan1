<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Buku extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $table = 'buku';

    protected $fillable = [
        'judul', 'slug', 'sampul', 'penulis', 'penerbit_id', 'kategori_id', 'rak_id', 'stok',
    ];

    protected $auditInclude = [
        'judul', 'slug', 'sampul', 'penulis', 'penerbit_id', 'kategori_id', 'rak_id', 'stok',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class);
    }

    public function rak()
    {
        return $this->belongsTo(Rak::class);
    }

    public function buku()
    {
        return $this->belongsTo(DetailPeminjaman::class);
    }

    

    public function setJudulAttribute($value)
    {
        $this->attributes['judul'] = ucfirst($value);
    }

    public function setPenulisAttribute($value)
    {
        $this->attributes['penulis'] = ucfirst($value);
    }

    // Tambahkan scopeSearch untuk pencarian
    public function scopeSearch($query, $keyword)
    {
        return $query->where(function ($query) use ($keyword) {
            $query->where('judul', 'like', '%' . $keyword . '%')
                  ->orWhere('penulis', 'like', '%' . $keyword . '%')
                  ->orWhereHas('kategori', function ($query) use ($keyword) {
                      $query->where('nama', 'like', '%' . $keyword . '%');
                  });
        });
    }

    
}
