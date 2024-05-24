<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DemitirFuncionario extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Employee $funcionario)
    {   
      
        if ($funcionario->data_demissao != NULL) {
           return redirect()->back()->withErrors('ja rodou');
        }
        $funcionario->update([
            'data_demissao' => Carbon::now()
        ]);
        return redirect()->route('funcionarios.index')->with('sucesso', 'Funcionario demitido!');
    }
}
