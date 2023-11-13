<?php

use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

class Impresion
{
    public static function ticket(string $letra, int $numero, int $cantidad)
    {
        $nombreImpresora = env("NOMBRE_IMPRESORA");
        $connector = new WindowsPrintConnector($nombreImpresora);
        $printer = new Printer($connector);
        $printer->feed(1);
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->setTextSize(7, 7);
        $printer->setEmphasis(true);
        $printer->text("$letra$numero" . "\n");
        $printer->feed(1);
        $printer->setTextSize(2, 2);
        $printer->setEmphasis(false);
        $printer->text("En espera: $cantidad" . "\n");
        $printer->setFont(Printer::FONT_B);
        $printer->feed(1);
        $printer->setTextSize(1, 1);
        $printer->text("Sitio: www.corpico.com.ar");
        $printer->text("                            "); // 28 Espacios en BLANCO
        $printer->text(date("d/m/Y") . "\n");
        $printer->text("App: corpicoapp.web.app");
        $printer->text("                                   "); // 35 Espacios en BLANCO
        $printer->text(date("h:i"));
        $printer->feed(3);
        $printer->cut();
        $printer->close();

        return;
    }
}
