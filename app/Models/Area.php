<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bloco;

class Area extends Model
{
    protected $table = 'area';
    protected $fillable = ['nome', 'bloco_id'];

    public function bloco()
    {
        return $this->belongsTo(Bloco::class, 'bloco_id');
    }
}