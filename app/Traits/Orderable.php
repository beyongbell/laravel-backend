<?php

namespace App\Traits;

trait Orderable {

    public function scopeDESC($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeASC($query)
    {
        return $query->orderBy('created_at', 'asc');
    }

}