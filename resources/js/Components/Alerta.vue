<script setup>
import { ref } from "vue";

const props = defineProps({
    mensaje: String
});


const showAlert = ref(true);

const closeAlert = () => {
    showAlert.value = false;
};
</script>

<template>
    <div v-if="showAlert" class="fixed top-4 right-4 p-4 bg-blue-500 text-white rounded-md shadow-lg z-50">
        <span>{{ mensaje }}</span>
        <button @click="closeAlert" class="ml-4 text-white hover:text-gray-300">X</button>
    </div>
</template>

