<template>
  <div v-if="isOpen" class="fixed z-10 inset-0 overflow-y-auto flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-gray-200 rounded-lg shadow-xl max-w-md w-full p-6">
      <h2 class="text-2xl font-semibold text-gray-800 mb-6">Editar Trecho</h2>
      <form @submit.prevent="saveChanges" class="space-y-4">
        <div>
          <label for="edit-uf" class="block text-sm font-medium text-gray-700">UF</label>
          <select class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3">
            <option v-for="uf in editRoute" :value="uf" :key="uf">{{ uf.uf }}</option>
          </select>
        </div>
        <div>
          <label for="edit-uf" class="block text-sm font-medium text-gray-700">Rodovia</label>
          <select class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3">
            <option v-for="rt in editRoute" :value="uf" :key="uf">{{ rt.br }}</option>
          </select>
        </div>
        <div>
          <label for="edit-uf" class="block text-sm font-medium text-gray-700">KM Inicial</label>
          <input type="text" id="edit-uf" v-model="editRoute.kmInicial" class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3">
        </div>
        <div>
          <label for="edit-uf" class="block text-sm font-medium text-gray-700">KM Final</label>
          <input type="text" id="edit-uf" v-model="editRoute.kmFinal" class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3">
        </div>
        <div>
          <label for="edit-uf" class="block text-sm font-medium text-gray-700">Tipo</label>
          <select class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3">
            <option v-for="type in editRoute" :value="uf" :key="type.tipo">{{ uf }}</option>
          </select>
        </div>
        <div class="flex justify-end mt-6">
          <button type="button" class="bg-indigo-500 text-white py-2 px-4 rounded-md mr-2" @click="closeModal">Cancelar</button>
          <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-md">Salvar</button>
        </div>

      </form>
    </div>
  </div>
</template>

<script setup>
import { defineProps, defineEmits, ref } from 'vue';

const props = defineProps({
  isOpen: Boolean,
  route: Object
});

const emit = defineEmits(['close', 'save']);

const editRoute = ref({ ...props.route });

function closeModal() {
  emit('close');
}

function saveChanges() {
  emit('save', editRoute.value);
  closeModal();

}
</script>
