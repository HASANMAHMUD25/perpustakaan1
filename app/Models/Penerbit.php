<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Penerbit extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $table = 'penerbit';

    protected $fillable = [
        'nama', 'slug',
    ];

    protected $auditInclude = [
        'nama', 'slug',
    ];

    public function buku()
    {
        return $this->hasMany(Buku::class);
    }

    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = ucfirst($value);
    }

    public function scopeSearch($query, $keyword)
    {
        return $query->where('nama', 'like', '%' . $keyword . '%')
                     ->orWhere('slug', 'like', '%' . $keyword . '%');
    }
}
