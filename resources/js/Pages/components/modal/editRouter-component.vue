<template>
  <div v-if="isOpen" class="fixed z-10 inset-0 overflow-y-auto flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-gray-200 rounded-lg shadow-xl max-w-md w-full p-6">
      <h2 class="text-2xl font-semibold text-gray-800 mb-6">Editar Trecho</h2>
      <form @submit.prevent="saveChanges" class="space-y-4">
        <!-- UF -->
        <div>
          <label for="edit-uf" class="block text-sm font-medium text-gray-700">UF</label>
          <select
            v-model="editRoute.uf_id"
            class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3"
          >
            <option v-for="uf in ufs" :value="uf.id" :key="uf.id">{{ uf.UF }}</option>
          </select>
        </div>
        <!-- Rodovia -->
        <div>
          <label for="edit-rodovia" class="block text-sm font-medium text-gray-700">Rodovia</label>
          <select
            v-model="editRoute.rodovia_id"
            class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3"
          >
            <option v-for="rodovia in rodovias" :value="rodovia.id" :key="rodovia.id">{{ rodovia.rodovia }}</option>
          </select>
        </div>
        <!-- KM Inicial -->
        <div>
          <label for="edit-km-inicial" class="block text-sm font-medium text-gray-700">KM Inicial</label>
          <input
            type="text"
            id="edit-km-inicial"
            v-model="editRoute.kmInicial"
            class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3"
          />
        </div>
        <!-- KM Final -->
        <div>
          <label for="edit-km-final" class="block text-sm font-medium text-gray-700">KM Final</label>
          <input
            type="text"
            id="edit-km-final"
            v-model="editRoute.kmFinal"
            class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3"
          />
        </div>
        <!-- Tipo -->
        <div>
          <label for="edit-tipo" class="block text-sm font-medium text-gray-700">Tipo</label>
          <select
            v-model="editRoute.tipo"
            class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3"
          >
            <option v-for="type in tipos" :value="type.value" :key="type.value">{{ type.label }}</option>
          </select>
        </div>
        <!-- Botões -->
        <div class="flex justify-end mt-6">
          <button type="button" class="bg-indigo-500 text-white py-2 px-4 rounded-md mr-2" @click="closeModal">
            Cancelar
          </button>
          <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-md">Salvar</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { defineProps, defineEmits, ref, watch } from 'vue';

const props = defineProps({
  isOpen: Boolean,
  route: Object,
  ufs: Array,
  rodovias: Array,
  tipos: Array,
});

const emit = defineEmits(['close', 'save']);

const editRoute = ref({...props.route});

watch(
  () => props.route,
  (newRoute) => {
    editRoute.value = {...newRoute};
  },
  {immediate: true}
);

function closeModal() {
  emit('close');
}

function saveChanges() {
  emit('save', editRoute.value);
}
</script>
