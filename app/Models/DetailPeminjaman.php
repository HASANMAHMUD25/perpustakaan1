<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class DetailPeminjaman extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $table = 'detail_peminjaman';
    protected $fillable = ['peminjaman_id', 'buku_id'];
    protected $auditInclude = ['peminjaman_id', 'buku_id'];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    public function buku()
    {
        return $this->belongsTo(buku::class);
    }
    public function scopeSearch($query, $searchTerm)
    {
        return $query->where(function($query) use ($searchTerm) {
            $query->where('peminjaman_id', 'like', "%{$searchTerm}%")
                  ->orWhere('buku_id', 'like', "%{$searchTerm}%");
        });
    }
}
