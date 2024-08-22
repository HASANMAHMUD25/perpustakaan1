<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Kategori extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'kategori';
    protected $fillable = ['nama', 'slug'];
    protected $auditInclude = ['nama', 'slug'];

    public function rak()
    {
        return $this->hasMany(Rak::class);
    }

    public function buku()
    {
        return $this->hasMany(Buku::class);
    }

    

    // Mutator untuk mengubah huruf pertama nama menjadi huruf besar
    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = ucfirst($value);
    }

    // Scope untuk pencarian berdasarkan nama kategori
    public function scopeSearch($query, $keyword)
    {
        return $query->where(function ($query) use ($keyword) {
            $query->where('nama', 'like', '%' . $keyword . '%');
        });
    }
}
