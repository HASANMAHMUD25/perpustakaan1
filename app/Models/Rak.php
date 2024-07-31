<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Rak extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'rak';

    protected $fillable = [
        'rak', 'baris', 'slug', 'kategori_id',
    ];

    protected $auditInclude = [
        'rak', 'baris', 'slug', 'kategori_id',
    ];

    public function bukus()
    {
        return $this->hasMany(Buku::class);
    }

    // Definisi relasi dengan Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function getLokasiAttribute()
    {
        return "Rak : {$this->rak}, Baris : {$this->baris}";
    }

    // Scope untuk pencarian
    public function scopeSearch($query, $keyword)
    {
        return $query->where(function ($query) use ($keyword) {
            $query->where('rak', 'like', '%' . $keyword . '%')
                  ->orWhere('baris', 'like', '%' . $keyword . '%')
                  ->orWhere('slug', 'like', '%' . $keyword . '%')
                  ->orWhereHas('kategori', function ($query) use ($keyword) {
                      $query->where('nama', 'like', '%' . $keyword . '%');
                  });
        });
    }
}