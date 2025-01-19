<script setup>
import { Link, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import MiModal from "@/Components/MiModal.vue";


const props = defineProps({
    pagina: Object
});

const empleados = ref(props.pagina.data);
const links = ref(props.pagina.links);
const busqueda = ref('');

// Actualizar lista
watch(() => props.pagina, (newPage) => {
    empleados.value = newPage.data;
    links.value = newPage.links;
}, { immediate: true });

const eliminar = (id, index) => {
    empleados.value.splice(index, 1);
    router.delete(`/empleados/${id}`);
}
</script>

<template>
    <div class="bg-gray-200 min-h-screen p-6">

        <div class="bg-white p-4 rounded-lg shadow-md">

            <!-- Busqueda -->
            <div class="flex justify-between mb-4">
                <div class="flex">
                    <input v-model="busqueda" type="text" placeholder="Buscar..."
                        class="px-4 py-2 border border-gray-300 rounded-l-md" />
                    <Link :href="`/empleados?search=${busqueda}`"
                        class="px-4 py-2 bg-blue-500 text-white rounded-r-md hover:bg-blue-600">Buscar</Link>
                </div>
                <Link href="/" as="button" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Crear
                </Link>
            </div>

            <!-- Tabla de empleados -->
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border border-gray-300">Nombre</th>
                        <th class="px-4 py-2 border border-gray-300">Primer Apellido</th>
                        <th class="px-4 py-2 border border-gray-300">Segundo Apellido</th>
                        <th class="px-4 py-2 border border-gray-300">Email</th>
                        <th class="px-4 py-2 border border-gray-300">Cargo</th>
                        <th class="px-4 py-2 border border-gray-300">Salario</th>
                        <th class="px-4 py-2 border border-gray-300">Fecha Contratación</th>
                        <th class="px-4 py-2 border border-gray-300">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(empleado, index) in empleados" :key="empleado.idempleado">
                        <td class="px-4 py-2 border border-gray-300">{{ empleado.nombre }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ empleado.primer_apellido }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ empleado.segundo_apellido }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ empleado.email }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ empleado.cargo.nombre_cargo }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ empleado.nivel.salario }}</td>
                        <td class="px-4 py-2 border border-gray-300">{{ empleado.fecha_contratacion }}</td>
                        <td class="px-4 py-2 border border-gray-300 space-x-2">
                            <Link :href="`/empleados/${empleado.idempleado}`"
                                class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">Editar</Link>
                            <MiModal nombre="Eliminar" titulo="Advertencia" cuerpo="Desea eliminar este usuario?"
                                :accion="() => eliminar(empleado.idempleado, index)" />
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Paginación -->
            <div class="mt-4">
                <ul class="flex space-x-2 justify-center">
                    <li v-for="link in links" :key="link.url">
                        <Link :href="link.url" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400"
                            v-html="link.label">
                        </Link>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</template>
