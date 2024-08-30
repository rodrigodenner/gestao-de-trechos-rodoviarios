<template>
  <div class="bg-white p-4 rounded-lg shadow-md mb-4">
    <div class="max-h-48 overflow-y-auto">
      <table class="min-w-full table-auto">
        <thead class="bg-gray-200">
        <tr>
          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">UF</th>
          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">BR</th>
          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Km Inicial</th>
          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Km Final</th>
          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lote</th>
          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Situação</th>
          <th class="px-4 py-2"></th>
        </tr>
        </thead>
        <tbody class="bg-white">
        <tr v-for="(route, index) in routes" :key="index">
          <td class="px-4 py-2 text-sm text-gray-700">{{ route.uf }}</td>
          <td class="px-4 py-2 text-sm text-gray-700">{{ route.br }}</td>
          <td class="px-4 py-2 text-sm text-gray-700">{{ route.kmInicial }}</td>
          <td class="px-4 py-2 text-sm text-gray-700">{{ route.kmFinal }}</td>
          <td class="px-4 py-2 text-sm text-gray-700">{{ route.lote }}</td>
          <td class="px-4 py-2 text-sm text-gray-700">{{ route.situacao }}</td>
          <td class="px-4 py-2 flex items-center justify-end space-x-2">
            <button class="bg-blue-500 text-white py-1 px-3 rounded-md hover:bg-blue-600 flex justify-center items-center">
              <i class="fa-solid fa-map-location-dot"></i>
            </button>
            <button @click="openDetailsModal(route)" class="bg-yellow-500 text-white py-1 px-3 rounded-md hover:bg-yellow-600 flex justify-center items-center">
              <i class="fas fa-info-circle"></i>
            </button>
            <button class="bg-red-500 text-white py-1 px-3 rounded-md hover:bg-red-600 flex justify-center items-center">
              <i class="fas fa-trash"></i>
            </button>
          </td>
        </tr>
        </tbody>
      </table>
    </div>

    <!-- Modal de Detalhes -->
    <details-router-component
      v-if="isDetailsModalOpen"
      :isOpen="isDetailsModalOpen"
      :route="selectedRoute"
      @close="closeDetailsModal"
    />
  </div>
</template>

<script setup>
import { ref } from 'vue';
import DetailsRouterComponent from "../modal/detailsRouter-component.vue";


const routes = ref([
  {

    uf: 'AP',
    br: '156',
    kmInicial: 0,
    kmFinal: 50,
    lote: 'Lote 01',
    situacao: 'Planejamento'
  },
  {
    uf: 'SP',
    br: '101',
    kmInicial: 10,
    kmFinal: 60,
    lote: 'Lote 02',
    situacao: 'Execução'
  },
  {
    uf: 'RJ',
    br: '116',
    kmInicial: 15,
    kmFinal: 45,
    lote: 'Lote 03',
    situacao: 'Concluído'
  },
  {
    uf: 'MG',
    br: '040',
    kmInicial: 20,
    kmFinal: 70,
    lote: 'Lote 04',
    situacao: 'Manutenção'
  },
  {
    uf: 'BA',
    br: '324',
    kmInicial: 25,
    kmFinal: 80,
    lote: 'Lote 05',
    situacao: 'Planejamento'
  }
]);


const isDetailsModalOpen = ref(false);
const selectedRoute = ref(null);

function openDetailsModal(route) {
  selectedRoute.value = route;
  isDetailsModalOpen.value = true;
}

function closeDetailsModal() {
  isDetailsModalOpen.value = false;
  selectedRoute.value = null;
}
</script>
