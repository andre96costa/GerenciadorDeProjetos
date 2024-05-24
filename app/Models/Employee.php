<?php

namespace App\Models;

use App\Helpers\Data;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
    use HasFactory;

    //protected $fillable = ['nome', 'cpf', 'data_contratacao', 'data_demissao'];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected function dataContratacao(): Attribute
    {
        return Attribute::make(
            get: fn(string $valor) => Data::convertDeISO8061ParaBr($valor),
            set: fn(string $valor) => Data::convertDeBrParaISO8061($valor)
        );
    }

    /**
     * Mapeia o relacionamento com o endereço
     * Um funcionário tem um endereço
     *
     * @return HasOne
     */
    public function address()
    {
        return $this->hasOne(Address::class);
    }

    /**
     * Um funcionário pertence a muitos projetos
     *
     * @return BelongsToMany
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'employee_project', 'employee_id', 'project_id');
    }

    static public function criar(array $funcionario, array $endereco): bool
    {
        try {
            DB::beginTransaction();
            $funcionario = Employee::create($funcionario);
            $funcionario->address()->create($endereco);
            DB::commit();
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return false;
        }
        return true;
    }

    public function scopeAtivo(Builder $query): void
    {
        $query->whereNull('data_demissao');
    }

    public function atualizar(array $funcionario, array $endereco): bool
    {
        try {
            DB::beginTransaction();
            $this->update($funcionario);
            $this->address()->update($endereco);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
        return true;
    }

    public function apagar(): bool
    {
        try {
            DB::beginTransaction();
            $this->address()->delete();
            $this->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
        return true;
    }
}
