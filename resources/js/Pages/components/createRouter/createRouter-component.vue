<template>
  <div class="bg-white p-4 rounded-lg shadow-md mb-4">
    <form class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
      <div>
        <label for="uf" class="block text-sm font-medium text-gray-700">UF</label>
        <select id="uf" name="uf" class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3 text-base leading-5">
          <!-- Opções -->
        </select>
      </div>
      <div>
        <label for="rodovia" class="block text-sm font-medium text-gray-700">Rodovia</label>
        <select id="rodovia" name="rodovia" class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3 text-base leading-5">
          <!-- Opções -->
        </select>
      </div>
      <div>
        <label for="km-inicial" class="block text-sm font-medium text-gray-700">KM Inicial</label>
        <input type="text" id="km-inicial" name="km-inicial" class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3 text-base leading-5">
      </div>
      <div>
        <label for="km-final" class="block text-sm font-medium text-gray-700">KM Final</label>
        <input type="text" id="km-final" name="km-final" class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3 text-base leading-5">
      </div>
      <div>
        <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo</label>
        <select id="tipo" name="tipo" class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3 text-base leading-5">
          <!-- Opções -->
        </select>
      </div>
      <div class="flex items-end">
        <button  class="w-full bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 flex justify-center items-center">
          <i class="fas fa-plus"></i>
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const isCreateModalOpen = ref(false);

function openAddModal() {
  isCreateModalOpen.value = true;
}

function closeCreateModal() {
  isCreateModalOpen.value = false;
}
</script>
