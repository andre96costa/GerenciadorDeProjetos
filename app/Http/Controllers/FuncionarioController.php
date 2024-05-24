<?php

namespace App\Http\Controllers;

use App\Http\Requests\FuncionarioRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $funcionarios = Employee::with('address')->paginate(15);
        return view("funcionarios.index", compact("funcionarios"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('funcionarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FuncionarioRequest $request)
    {
        $criado = Employee::criar($request->only(['nome', 'cpf', 'data_contratacao']), $request->only(['logradouro', 'numero','bairro','cidade','cep','estado','complemento']));
        if (!$criado) {
            return redirect()->back()->withErrors('Erro ao criar novo funcionario.');
        }
        return redirect()->route('funcionarios.index')->with('sucesso', 'Funcionario cadastrado!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $funcionario)
    {
        return view('funcionarios.edit', compact('funcionario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FuncionarioRequest $request, Employee $funcionario)
    {
        $atualizado = $funcionario->atualizar($request->only(['nome', 'cpf', 'data_contratacao']), $request->only(['logradouro', 'numero','bairro','cidade','cep','estado','complemento']));
        if (!$atualizado) {
            return redirect()->back()->withErrors('Erro ao atualizar funcionario');
        }
        return redirect()->route('funcionarios.index')->with('sucesso', 'Funcionário atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $funcionario)
    {
        $apagado = $funcionario->apagar();
        if (!$apagado) {
            return redirect()->back()->withErrors('Não foi possível apagar os dados do funcionario.');
        }
        return redirect()->route('funcionarios.index')->with('sucesso', 'Funcionario apagado com sucesso!');

    }
}
