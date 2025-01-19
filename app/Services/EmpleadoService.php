<?php

namespace App\Services;

use App\DTOs\OperationResultDTO;
use App\Models\Empleado;
use Illuminate\Support\Facades\Log;

class EmpleadoService
{
    public function crearEmpleado(array $datos)
    {
        try {
            $empleado = Empleado::create($datos);
            if (!isset($empleado->idempleado)) return new OperationResultDTO(false, 'No se pudo crear el usuario');
            return new OperationResultDTO(true, 'Empleado creado exitosamente', $empleado);
        } catch (\Throwable $th) {
            Log::alert($th);
            return new OperationResultDTO(false, 'Error al intentar crear el usuario');
        }
    }

    public function modificarEmpleado(int $id, array $datos)
    {
        try {
            $empleado = Empleado::find($id);
            if (!$empleado) return new OperationResultDTO(false, 'Empleado no encontrado');
            $estatus = $empleado->update($datos);
            $mensaje = ($estatus) ? 'Empleado modificado correctamente' : 'No se pudo modificar el empleado';
            return new OperationResultDTO($estatus, $mensaje, $empleado);
        } catch (\Throwable $th) {
            Log::alert($th);
            return new OperationResultDTO(false, 'Error al intentar modificar el empleado');
        }
    }

    public function listarEmpleados($search = '', $page = 1): OperationResultDTO
    {
        try {
            $empleados = Empleado::with('cargo', 'nivel')
                ->when($search, function ($query, $search) {
                    return $query
                        ->where('nombre', 'like', "%{$search}%")
                        ->orWhereHas('cargo', function($query) use ($search) {
                            $query->where('nombre_cargo', 'like', "%{$search}%");
                        });
                })
                ->paginate(10);

            return new OperationResultDTO(true, 'Lista de empleados', $empleados);
        } catch (\Throwable $th) {
            return new OperationResultDTO(false, 'Error al obtener lista de empleados');
        }
    }

    public function obtenerEmpleado(int $id)
    {
        try {
            $empleado = Empleado::find($id);
            $estatus = (isset($empleado->idempleado));
            $mensaje = ($estatus) ? 'Se encontro el empleado' : 'No existe el empleado';
            return new OperationResultDTO($estatus, $mensaje, $empleado);
        } catch (\Throwable $th) {
            return new OperationResultDTO(false, 'Error al intentar obtener el empleado');
        }
    }

    public function eliminarEmpleado(int $id)
    {
        try {
            $empleado = Empleado::find($id);
            if (!isset($empleado)) return new OperationResultDTO(false, 'No se encontro el usuario');
            $estatus = $empleado->delete();
            $mensaje = ($estatus) ? 'Empleado eliminado correctamente' : 'No se pudo eliminar el usuario';
            return new OperationResultDTO($estatus, $mensaje);
        } catch (\Throwable $th) {
            return new OperationResultDTO(false, 'Error al intentar eliminar el usuario');
        }
    }

    public function almacenarImagen($archivo): OperationResultDTO {

        return new OperationResultDTO(false);
    }

    public function eliminarImagen():OperationResultDTO {
        return new OperationResultDTO(false);
    }
}
