<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class GeaSeguridad extends Model
{
    use HasApiTokens;

    protected $connection = 'GeaSeguridad';
    protected $table = 'GeaSeguridad_Corpico.dbo.USUARIOS';
    protected $primaryKey = 'USU_CODIGO';
    public $timestamps = false;

    public function getAuthPassword()
    {
        return $this->USU_PASSWORD;
    }
}
