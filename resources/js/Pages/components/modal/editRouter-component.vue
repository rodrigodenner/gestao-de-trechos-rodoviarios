<template>
  <div
    v-if="isOpen"
    class="fixed z-10 inset-0 overflow-y-auto flex items-center justify-center bg-black bg-opacity-50"
  >
    <div class="bg-gray-200 rounded-lg shadow-xl max-w-md w-full p-6">
      <h2 class="text-2xl font-bold mb-4 text-center">Editar Rota</h2>
      <div v-if="route">
        <div class="space-y-4">
          <!-- Campo de UF -->
          <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 shadow-sm">
            <label class="text-gray-600 font-medium" for="uf">UF:</label>
            <input
              v-model="form.uf"
              type="text"
              id="uf"
              class="w-full mt-1 p-2 border border-gray-300 rounded-md"
            />
          </div>

          <!-- Campo de BR -->
          <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 shadow-sm">
            <label class="text-gray-600 font-medium" for="br">BR:</label>
            <input
              v-model="form.br"
              type="text"
              id="br"
              class="w-full mt-1 p-2 border border-gray-300 rounded-md"
            />
          </div>

          <!-- Campos de KM Inicial e KM Final -->
          <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 shadow-sm">
            <label class="text-gray-600 font-medium" for="kmInicial">KM Inicial:</label>
            <input
              v-model="form.kmInicial"
              type="number"
              id="kmInicial"
              class="w-full mt-1 p-2 border border-gray-300 rounded-md"
            />
          </div>

          <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 shadow-sm">
            <label class="text-gray-600 font-medium" for="kmFinal">KM Final:</label>
            <input
              v-model="form.kmFinal"
              type="number"
              id="kmFinal"
              class="w-full mt-1 p-2 border border-gray-300 rounded-md"
            />
          </div>

          <!-- Adicione mais campos conforme necessário para os detalhes da rota -->
        </div>
      </div>

      <!-- Botões para salvar alterações ou fechar o modal -->
      <div class="flex justify-end mt-6 space-x-2">
        <button
          @click="saveChanges"
          class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
        >
          Salvar
        </button>
        <button
          @click="closeModal"
          class="bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-600 shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
          Fechar
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue';

// Definindo as props recebidas
const props = defineProps({
  isOpen: Boolean,
  route: Object,
});

// Emite eventos para o componente pai
const emit = defineEmits(['close', 'update-route']);

// Define um objeto de formulário reativo para preencher os campos de edição
const form = ref({
  uf: '',
  br: '',
  kmInicial: 0,
  kmFinal: 0,
});

// Atualiza o formulário sempre que a rota muda
watch(
  () => props.route,
  (newRoute) => {
    if (newRoute) {
      form.value.uf = newRoute.uf.UF;
      form.value.br = newRoute.rodovia.rodovia;
      form.value.kmInicial = newRoute.kmInicial;
      form.value.kmFinal = newRoute.kmFinal;
    }
  },
  { immediate: true }
);

// Função para fechar o modal
function closeModal() {
  emit('close');
}

// Função para salvar as alterações e atualizar a rota
function saveChanges() {
  const updatedRoute = {
    ...props.route,
    uf: {UF: form.value.uf},
    rodovia: {rodovia: form.value.br},
    kmInicial: form.value.kmInicial,
    kmFinal: form.value.kmFinal,
  };
  emit('update-route', updatedRoute);
  closeModal();
}
</script>
