<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeaCorpicoCliente extends Model
{
    protected $connection = 'GeaCorpico';
    protected $table = 'GeaCorpico.dbo.CLIENTE';
    protected $primaryKey = 'CLI_ID';
    public $timestamps = false;
}
