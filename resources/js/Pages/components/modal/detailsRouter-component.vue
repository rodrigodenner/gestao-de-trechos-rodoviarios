<template>
  <div v-if="isOpen" class="fixed z-10 inset-0 overflow-y-auto flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-gray-200 rounded-lg shadow-xl max-w-md w-full p-6">
      <h2 class="text-2xl font-bold mb-4 text-center">Detalhes da Rota</h2>
      <div v-if="route">
        <div class="space-y-4">
          <!-- Detalhes da Rota -->
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

      <!-- Botões -->
      <div class="flex justify-end mt-6 space-x-2">
          <button
            class="bg-yellow-500 text-white py-2 px-4 rounded-md hover:bg-yellow-600 shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
              <Link :href="$route('route.edit', { id: route.id })">
                Editar
              </Link>
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
import {Link} from "@inertiajs/vue3";

const props = defineProps({
  isOpen: Boolean,
  route: Object,
});

const emit = defineEmits(['close']);

function closeModal() {
  emit('close');
}
</script>
