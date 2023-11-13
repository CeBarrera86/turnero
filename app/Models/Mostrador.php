<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mostrador extends Model
{
    use HasFactory;
    protected $table = 'mostradores';

    protected $fillable = [
        'numero',
        'ip',
        'alfa',
        'tipo',
        'sector',
    ];

    public function puestos()
    {
        return $this->hasOne('App\Models\Puesto', 'mostrador');
    }

    public function sectores()
    {
        return $this->belongsTo('App\Models\Sector', 'sector');
    }
}
