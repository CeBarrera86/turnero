<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'clientes';

    public $timestamps = false;

    protected $fillable = [
        'dni',
        'titular',
        'celular',
        'email',
    ];

    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket', 'cliente');
    }
}
