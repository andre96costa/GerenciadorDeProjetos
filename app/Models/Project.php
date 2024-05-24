<?php

namespace App\Models;

use App\Helpers\Data;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'orcamento', 'data_inicio', 'data_final', 'client_id'];

    protected function dataInicio(): Attribute
    {
        return Attribute::make(
            get: fn(string $valor) =>  Data::convertDeISO8061ParaBr($valor),
            set: fn(string $valor) =>  Data::convertDeBrParaISO8061($valor)
        );
    }

    protected function dataFinal(): Attribute
    {
        return Attribute::make(
            get: fn(string $valor) =>  Data::convertDeISO8061ParaBr($valor),
            set: fn(string $valor) =>  Data::convertDeBrParaISO8061($valor)
        );
    }

    protected function orcamento(): Attribute
    {
        return Attribute::make(
            get: fn(string $valor) =>  number_format($valor,2,',','.'),
        );
    }

    static public function criarComFuncionario(array $projetos, ?array $funcionarios): bool
    {
        try {
            DB::beginTransaction();
            $projeto = Project::create($projetos);
            $projeto->employees()->sync($funcionarios);
            DB::commit();
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return false;
        }
        return true;
    }

    public function atualizar(array $projetos, ?array $funcionarios): bool
    {
        try {
            DB::beginTransaction();
            $this->update($projetos);
            $this->employees()->sync($funcionarios);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
        return true;
    }

    /**
     * Um projeto pertence a um cliente
     *
     * @return BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    /**
     * Um projeto pertence a muitos funcionários
     *
     * @return BelongsToMany
     */
    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_project', 'project_id', 'employee_id');
    }
}
