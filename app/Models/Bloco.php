<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bloco extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    public function area()
    {
        return $this->hasMany(Area::class, 'bloco_id');
    }
}
