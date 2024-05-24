<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjetoRequest;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjetoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projetos = Project::with('client')->paginate(15);
        return view('projetos.index', compact('projetos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Client::all();
        $funcionarios = Employee::ativo()->get();
        return view('projetos.create', compact('clientes', 'funcionarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjetoRequest $request)
    {
        $criado = Project::criarComFuncionario($request->except('funcionarios'), $request->funcionarios);

        if (!$criado) {
            return redirect()->back()->withInput()->withErrors('Erro ao criar o projeto');
        }

        return redirect()->route('projetos.index')->with('sucesso', 'Projeto criado com sucesso!');
    }

    public function show(Project $projeto)
    {
        return view('projetos.show', compact('projeto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $projeto)
    {
        $clientes = Client::all();
        $funcionarios = Employee::ativo()->get();
        return view('projetos.edit', compact('projeto', 'clientes', 'funcionarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjetoRequest $request, Project $projeto)
    {
        $atualizado = $projeto->atualizar($request->except('funcionarios'), $request->funcionarios);
        if (!$atualizado) {
            return redirect()->back()->withInput()->withErrors('Erro ao atualizar o projeto');
        }
        return redirect()->route('projetos.index')->with('sucesso', 'Projeto Atualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $projeto)
    {
        $projeto->employees()->detach();
        $projeto->delete();
        return redirect()->route('projetos.index')->with('sucesso', 'Projeto Deletado!');
    }
}
