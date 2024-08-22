<?php

namespace App\Models;

use OwenIt\Auditing\Models\Audit as BaseAudit;
use Carbon\Carbon;

class Audit extends BaseAudit
{
    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where('event', 'like', $term)
            ->orWhere('auditable_type', 'like', $term)
            ->orWhere('auditable_id', 'like', $term)
            ->orWhere('user_id', 'like', $term);
    }

     // Accessor untuk created_at
     public function getCreatedAtAttribute($value)
     {
         return Carbon::parse($value)->setTimezone('Asia/Jakarta')->format('d-m-Y H:i:s');
     }
}
