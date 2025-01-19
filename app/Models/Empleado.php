<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'idempleado';
    protected $table = 'empleados';
    protected $fillable = [
        'nombre',
        'primer_apellido',
        'segundo_apellido',
        'email',
        'idcargo',
        'idnivel',
        'fecha_contratacion',
        'url_imagen_relativa'
    ];

    public function cargo() {
        return $this->belongsTo(Cargo::class, 'idcargo', 'idcargo');
    }

    public function nivel() {
        return $this->belongsTo(Nivel::class, 'idnivel', 'idnivel');
    }
}
