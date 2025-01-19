<script setup>
import { ref } from 'vue';

const props = defineProps({
    titulo: String,
    cuerpo: String,
    accion: Function,
    nombre: String
})

// Controlamos si el modal se muestra o no
const estaAbierto = ref(false);

// Función para abrir el modal
const abrir = () => {
    estaAbierto.value = true;
};

// Función para cerrar el modal
const cerrar = () => {
    estaAbierto.value = false;
};

const confirmar = async () => {
    await props.accion();
    cerrar();
}
</script>

<template>
    <button @click="abrir" type="button" class=" p-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
        {{ nombre }}
    </button>

    <div v-if="estaAbierto" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-semibold mb-4">{{ titulo }}</h2>
            <p>{{ cuerpo }}</p>

            <div class="mt-4 flex justify-end space-x-2">
                <button @click="cerrar" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                    Cerrar
                </button>
                <button @click="confirmar" type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                    Confirmar
                </button>
            </div>
        </div>
    </div>
</template>
