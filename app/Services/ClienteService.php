<?php

namespace App\Services;

use App\Models\Cliente;
use App\Models\GeaCorpicoDNI;

class ClienteService
{
    public function buscarOCrearCliente($dni)
    {
        $cliente = Cliente::where('dni', $dni)->first();
        if (!$cliente) {
            $clienteGeaCorpico = $this->buscarClienteEnGeaCorpico($dni);
            if ($clienteGeaCorpico) {
                $cliente = $this->crearClienteDesdeGeaCorpico($clienteGeaCorpico);
            } else {
                $cliente = Cliente::find(1); // Cliente "INVITADO"
                if (!$cliente) {
                    throw new \Exception('Cliente INVITADO no configurado.');
                }
            }
        }
        return $cliente;
    }

    private function buscarClienteEnGeaCorpico($dni)
    {
        return GeaCorpicoDNI::where('CLD_NUMERO_DOCUMENTO', $dni)
            ->with(['GeaCorpicoCleinte' => function ($query) {
                $query->select('CLI_ID', 'CLI_TITULAR', 'CLI_TELEFONO_CELULAR', 'CLI_E_MAIL');
            }])
            ->select('CLD_NUMERO_DOCUMENTO', 'CLD_CLIENTE')
            ->first();
    }

    private function crearClienteDesdeGeaCorpico($clienteGeaCorpico)
    {
        return Cliente::create([
            "dni" => $clienteGeaCorpico->CLD_NUMERO_DOCUMENTO,
            "titular" => $clienteGeaCorpico->GeaCorpicoCleinte->CLI_TITULAR,
            "celular" => $clienteGeaCorpico->GeaCorpicoCleinte->CLI_TELEFONO_CELULAR,
            "email" => $clienteGeaCorpico->GeaCorpicoCleinte->CLI_E_MAIL,
        ]);
    }
}
