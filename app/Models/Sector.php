<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;
    protected $table = 'sectores';

    protected $fillable = [
        'letra',
        'nombre',
        'descripcion',
    ];

    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket', 'sector');
    }
}
