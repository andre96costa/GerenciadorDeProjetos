<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Lista os clientes do banco de dados
     * 
     * @return View|Factory 
     */
    public function index()
    {
        $clientes = Client::paginate(15);
        $clientes->load('projects');

        return view('clientes.index', [
            'clientes' => $clientes
        ]);
    }

    /**
     * Mostra o formulário de cadastro de clientes
     * 
     * @return View|Factory 
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Grava o cliente no banco de dados
     */
    public function store(ClientRequest $request)
    {

        Client::create($request->all());

        // $novoCliente = new Client;
        // $novoCliente->nome = $request->input('nome');
        // $novoCliente->endereco = $request->input('endereco');
        // $novoCliente->descricao = $request->input('descricao');
        // $novoCliente->save();

        return redirect('/clientes')->with(['sucesso' => 'Cliente cadastrado com sucesso!']);
    }

    public function edit(Client $cliente)
    {
        return view("clientes.edit",compact("cliente"));
    }

    public function update(ClientRequest $request, Client $cliente)
    {
        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('sucesso', "Cliente $cliente->id editado com sucesso!");
    }

    public function destroy(int $id)
    {
        $cliente = Client::findOrFail($id);
        $cliente->delete();
        return redirect()->route('clientes.index')->with('sucesso', "Cliente $cliente->id excluído com sucesso!");
    }
}
