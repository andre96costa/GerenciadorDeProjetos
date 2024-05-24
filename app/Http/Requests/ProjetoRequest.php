<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjetoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $dados = $this->all();
        if (isset($dados['orcamento']))
        {
            $dados['orcamento'] = str_replace(['.',','], ['', '.'], $dados['orcamento']);
        }
        $this->replace($dados);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "nome" => ['required', 'min:2', 'max:100', 'string'],
            "orcamento" => ['required' ,'decimal:2'],
            "data_inicio" => ['required', 'date_format:d/m/Y'],
            "data_final" => ['required', 'date_format:d/m/Y'],
            "client_id" => ['required', 'exists:clients,id'],
        ];
    }
}
