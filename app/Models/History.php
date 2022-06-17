<?php

namespace App\Models;

use \App\Models\Grade;
use \App\Models\Book;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn ($query, $search)
        => $query->where(fn ($query) => $query->where('name', 'like', "%$search%")));
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
