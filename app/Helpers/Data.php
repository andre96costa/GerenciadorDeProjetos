<?php

namespace App\Helpers;

use Carbon\Carbon;

class Data
{
    static public function convertDeISO8061ParaBr(string $dataEntrada): string
    {
        return  Carbon::make($dataEntrada)->format('d/m/Y');
    }

    static public function convertDeBrParaISO8061 (string $dataEntrada): string
    {
        return  Carbon::createFromFormat('d/m/Y',$dataEntrada)->format('Y-m-d');
    }
}
