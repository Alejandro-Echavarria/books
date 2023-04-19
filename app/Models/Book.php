<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ApiTrait;

class Book extends Model
{
    use HasFactory, ApiTrait;

    protected $fillable = [
        'name',
        'price',
        'date_published',
    ];

    protected $casts = [
        'date_published' => 'date',
    ];

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
}
