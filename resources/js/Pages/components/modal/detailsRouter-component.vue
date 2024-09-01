<template>
  <div
    v-if="isOpen"
    class="fixed z-10 inset-0 overflow-y-auto flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-gray-200 rounded-lg shadow-xl max-w-md w-full p-6">
      <h2 class="text-2xl font-bold mb-4 text-center">Detalhes da Rota</h2>
      <div v-if="route">
        <div class="space-y-4">
          <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 shadow-sm">
            <div class="flex justify-between items-center">
              <span class="text-gray-600 font-medium">UF:</span>
              <span class="text-gray-800 font-semibold">{{ route.uf.UF }}</span>
            </div>
          </div>
          <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 shadow-sm">
            <div class="flex justify-between items-center">
              <span class="text-gray-600 font-medium">BR:</span>
              <span class="text-gray-800 font-semibold">{{ route.rodovia.rodovia }}</span>
            </div>
          </div>
          <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 shadow-sm">
            <div class="flex justify-between items-center">
              <span class="text-gray-600 font-medium">KM Inicial:</span>
              <span class="text-gray-800 font-semibold">{{ route.kmInicial }}</span>
            </div>
          </div>
          <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 shadow-sm">
            <div class="flex justify-between items-center">
              <span class="text-gray-600 font-medium">KM Final:</span>
              <span class="text-gray-800 font-semibold">{{ route.kmFinal }}</span>
            </div>
          </div>
        </div>
      </div>
      <div class="flex justify-end mt-6 space-x-2">
        <button
          @click="openEditModal"
          class="bg-yellow-500 text-white py-2 px-4 rounded-md hover:bg-yellow-600 shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500"
        >
          Editar
        </button>
        <button
          @click="closeModal"
          class="bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-600 shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
          Fechar
        </button>
      </div>
    </div>
    <edit-router-component
      v-if="isEditModalOpen"
      :isOpen="isEditModalOpen"
      :route="selectedRoute"
      @close="closeEditModal"
      @update-route="updateRoute"
    />
  </div>
</template>

<script setup>
import { ref } from 'vue';
import EditRouterComponent from '../modal/editRouter-component.vue';

// Define as props recebidas pelo componente
const props = defineProps({
  isOpen: Boolean,
  route: Object,
});

// Define os eventos emitidos pelo componente
const emit = defineEmits(['close', 'update-route']);

// Define as referências reativas para controle de modais
const isEditModalOpen = ref(false);
const selectedRoute = ref(null);

// Função para fechar o modal de detalhes
function closeModal() {
  emit('close');
}

// Função para abrir o modal de edição
function openEditModal() {
  selectedRoute.value = props.route;
  isEditModalOpen.value = true;
}

// Função para fechar o modal de edição
function closeEditModal() {
  isEditModalOpen.value = false;
}

// Função para atualizar a rota após edição
function updateRoute(updatedRoute) {
  selectedRoute.value = updatedRoute;
  emit('update-route', updatedRoute);
  closeEditModal(); // Fecha o modal de edição após atualizar
}
</script>
