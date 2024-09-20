<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = ['nome', 'bloco_id'];

    public function bloco()
    {
        return $this->belongsTo(Bloco::class, 'bloco_id');
    }
}