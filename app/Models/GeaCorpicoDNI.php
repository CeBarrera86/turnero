<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeaCorpicoDNI extends Model
{
    protected $connection = 'GeaCorpico';
    protected $table = 'GeaCorpico.dbo.CLIENTE_DOCUMENTO';
    public $timestamps = false;

    public function GeaCorpicoCleinte()
    {
        return $this->belongsTo(GeaCorpicoCliente::class, 'CLD_CLIENTE', 'CLI_ID');
    }
}
