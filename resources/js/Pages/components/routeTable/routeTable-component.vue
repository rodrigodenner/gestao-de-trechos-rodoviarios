<!-- RouteTableComponent.vue -->
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
          <th class="px-4 py-2"></th>
        </tr>
        </thead>
        <tbody class="bg-white">
        <tr v-for="route in routes" :key="route.id">
          <td class="px-4 py-2 text-sm text-gray-700">{{ route.uf.UF }}</td>
          <td class="px-4 py-2 text-sm text-gray-700">{{ route.rodovia.rodovia }}</td>
          <td class="px-4 py-2 text-sm text-gray-700">{{ route.kmInicial }}</td>
          <td class="px-4 py-2 text-sm text-gray-700">{{ route.kmFinal }}</td>
          <td class="px-4 py-2 flex items-center justify-end space-x-2">
            <button class="bg-blue-500 text-white py-1 px-3 rounded-md hover:bg-blue-600 flex justify-center items-center">
              <i class="fa-solid fa-map-location-dot"></i>
            </button>
            <button
              @click="openDetailsModal(route)"
              class="bg-yellow-500 text-white py-1 px-3 rounded-md hover:bg-yellow-600 flex justify-center items-center"
            >
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

    <!-- Componente de Detalhes -->
    <details-router-component
      :isOpen="isDetailsModalOpen"
      :route="selectedRoute"
      @close="closeDetailsModal"
    />
  </div>
</template>

<script>


import DetailsRouterComponent from "../modal/detailsRouter-component.vue";

export default {
  name: 'RouteTableComponent',
  components: {
    DetailsRouterComponent

  },
  props: {
    routes: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      isDetailsModalOpen: false,
      selectedRoute: null,
    };
  },
  methods: {
    openDetailsModal(route) {
      this.selectedRoute = route;
      this.isDetailsModalOpen = true;
    },
    closeDetailsModal() {
      this.isDetailsModalOpen = false;
      this.selectedRoute = null;
    },
  },
};
</script>
