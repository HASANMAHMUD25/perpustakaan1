<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use OwenIt\Auditing\Contracts\Auditable;

class Peminjaman extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'peminjaman';
    protected $fillable = [
        'kode_pinjam', 
        'peminjam_id', 
        'petugas_pinjam', 
        'petugas_kembali', 
        'status', 
        'denda', 
        'tanggal_pinjam', 
        'tanggal_kembali', 
        'tanggal_pengembalian'
    ];

    protected $auditInclude = [
        'kode_pinjam', 
        'peminjam_id', 
        'petugas_pinjam', 
        'petugas_kembali', 
        'status', 
        'denda', 
        'tanggal_pinjam', 
        'tanggal_kembali', 
        'tanggal_pengembalian'
    ];

    // Relation
    public function detail_peminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessors
    protected function denda(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? "Rp. {$value}" : '-',
        );
    }

    protected function tanggalPinjam(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? Carbon::create($value)->format('d-M-Y') : '-',
        );
    }
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('kode_pinjam', 'like', '%' . $search . '%');
        }
        
        return $query;
    }

    protected function tanggalKembali(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? Carbon::create($value)->format('d-M-Y') : '-',
        );
    }

    protected function tanggalPengembalian(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? Carbon::create($value)->format('d-M-Y') : '-',
        );
    }
}
