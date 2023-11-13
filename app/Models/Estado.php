<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;
    protected $table = 'estados';

    protected $fillable = [
        'letra',
        'descripcion',
    ];

    public function historiales()
    {
        return $this->hasMany('App\Models\Historial', 'estado');
    }
}
