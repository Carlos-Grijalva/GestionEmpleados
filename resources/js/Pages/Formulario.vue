<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import Alerta from "@/Components/Alerta.vue";
import MiModal from "@/Components/MiModal.vue";

const props = defineProps({
    empleado: Object,
    cargos: Array,
    niveles: Array,
    errors: Object
})

const empleado = ref({
    idempleado: props.empleado?.idempleado || '',
    nombre: props.empleado?.nombre || '',
    primer_apellido: props.empleado?.primer_apellido || '',
    segundo_apellido: props.empleado?.segundo_apellido || '',
    email: props.empleado?.email || '',
    idcargo: props.empleado?.idcargo || '',
    idnivel: props.empleado?.idnivel || '',
    fecha_contratacion: props.empleado?.fecha_contratacion || '',
});

const cargos = ref(props.cargos || []);
const niveles = ref(props.niveles || []);

const enviarFormulario = () => {
    const formData = new FormData();

    formData.append('nombre', empleado.value.nombre);
    formData.append('primer_apellido', empleado.value.primer_apellido);
    formData.append('segundo_apellido', empleado.value.segundo_apellido);
    formData.append('email', empleado.value.email);
    formData.append('idcargo', empleado.value.idcargo);
    formData.append('idnivel', empleado.value.idnivel);
    formData.append('fecha_contratacion', empleado.value.fecha_contratacion);

    if (empleado.value.idempleado) {
        router.put(`/empleados/${empleado.value.idempleado}`, empleado.value);
    } else {
        router.post('/empleados', formData);
    }
}
</script>

<template>
    <Alerta :mensaje="$page.props.result.message ?? ''"
        class="fixed top-4 right-4 p-4 bg-blue-500 text-white rounded-md shadow-lg z-50" />

    <div class="p-6 max-w-2xl mx-auto bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold mb-4">{{ empleado.idempleado ? 'Editar' : 'Nuevo' }} Empleado</h1>

        <form @submit.prevent="" class="space-y-4">
            <!-- nombre -->
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input v-model="empleado.nombre" type="text" id="nombre" required
                    class="mt-1 p-2 border border-gray-300 rounded-md w-full" />
                <span class="text-sm text-red-500">{{ errors.nombre ?? '' }}</span>
            </div>

            <!-- apellido 1 -->
            <div>
                <label for="primer_apellido" class="block text-sm font-medium text-gray-700">Primer Apellido</label>
                <input v-model="empleado.primer_apellido" type="text" id="primer_apellido" required
                    class="mt-1 p-2 border border-gray-300 rounded-md w-full" />
                <span class="text-sm text-red-500">{{ errors.primer_apellido ?? '' }}</span>
            </div>

            <!-- apellido 2 -->
            <div>
                <label for="segundo_apellido" class="block text-sm font-medium text-gray-700">Segundo Apellido</label>
                <input v-model="empleado.segundo_apellido" type="text" id="segundo_apellido"
                    class="mt-1 p-2 border border-gray-300 rounded-md w-full" />
                <span class="text-sm text-red-500">{{ errors.segundo_apellido ?? '' }}</span>
            </div>

            <!-- email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input v-model="empleado.email" type="email" id="email" required
                    class="mt-1 p-2 border border-gray-300 rounded-md w-full" />
                <span class="text-sm text-red-500">{{ errors.email ?? '' }}</span>
            </div>

            <!-- idcargo -->
            <div>
                <label for="idcargo" class="block text-sm font-medium text-gray-700">Cargo</label>
                <select v-model="empleado.idcargo" name="" id="idcargo" required
                    class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                    <option v-for="cargo in cargos" :key="cargo.idcargo" :value="cargo.idcargo">
                        {{ cargo.nombre_cargo }}
                    </option>
                </select>
                <span class="text-sm text-red-500">{{ errors.idcargo ?? '' }}</span>
            </div>

            <!-- idnivel -->
            <div>
                <label for="idnivel" class="block text-sm font-medium text-gray-700">Nivel</label>
                <select v-model="empleado.idnivel" id="idnivel" required
                    class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                    <option v-for="nivel in niveles" :key="nivel.idnivel" :value="nivel.idnivel">
                        {{ nivel.salario }}
                    </option>
                </select>
                <span class="text-sm text-red-500">{{ errors.idnivel ?? '' }}</span>
            </div>

            <!-- fecha -->
            <div>
                <label for="fecha_contratacion" class="block text-sm font-medium text-gray-700">Fecha de
                    Contratación</label>
                <input type="date" v-model="empleado.fecha_contratacion" id="fecha_contratacion" required
                    class="mt-1 p-2 border border-gray-300 rounded-md w-full" />
                <span class="text-sm text-red-500">{{ errors.fecha_contratacion ?? '' }}</span>
            </div>

            <!-- Imagen -->
            <!-- <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Imagen</label>
                <input v-model="empleado.email" type="email" id="email" required
                    class="mt-1 p-2 border border-gray-300 rounded-md w-full" />
                <span class="text-sm text-red-500">{{ errors.email ?? '' }}</span>
            </div> -->

            <MiModal nombre="Guardar" cuerpo="Desea guardar este registro?" titulo="Advertencia"
                :accion="enviarFormulario" />
        </form>
    </div>
</template>
