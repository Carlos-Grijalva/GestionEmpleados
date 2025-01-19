<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Empleado;
use App\Models\Nivel;
use App\Services\EmpleadoService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class EmpleadoController extends Controller
{
    private EmpleadoService $empleadoService;

    public function __construct(EmpleadoService $empleadoService) {
        $this->empleadoService = $empleadoService;
    }

    public function index() {
        return Inertia::render('Formulario', [
            'empleado' => session('empleado') ?? new Empleado(),
            'cargos' => Cargo::all(),
            'niveles' => Nivel::all()
        ]);
    }

    public function crear(Request $request) {
        $valido = $request->validate([
            'nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'email' => 'required|email|unique:empleados,email',
            'idcargo' => 'required|exists:cargos,idcargo',
            'idnivel' => 'required|exists:niveles,idnivel',
            'fecha_contratacion' => 'required|date',
        ]);

        $resultado = $this->empleadoService->crearEmpleado($valido);
        session()->flash('resultado', $resultado->toArray());
        return to_route('listar');
    }

    public function modificar(Request $request, $id) {
        $empleado = Empleado::query()->find($id);
        $valido = $request->validate([
            'nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('empleados', 'email')->ignore($empleado->idempleado, 'idempleado')
            ],
            'idcargo' => 'required|exists:cargos,idcargo',
            'idnivel' => 'required|exists:niveles,idnivel',
            'fecha_contratacion' => 'required|date',
        ]);

        $resultado = $this->empleadoService->modificarEmpleado($id, $valido);
        session()->flash('resultado', $resultado->toArray());
        return to_route('form');
    }

    public function eliminar($id) {
        $resultado = $this->empleadoService->eliminarEmpleado($id);
        session()->flash('resultado', $resultado->toArray());
        return to_route('listar');
    }

    public function listar(Request $request) {
        $search = $request->search;
        $resultado = $this->empleadoService->listarEmpleados($search);

        return Inertia::render('ListaEmpleados', [
            'pagina' => $resultado->data
        ]);
    }

    public function obtener($id) {
        $resultado = $this->empleadoService->obtenerEmpleado($id);
        session()->flash('resultado', $resultado->toArray());
        session()->flash('empleado', $resultado->data);
        return to_route('form');
    }
}
