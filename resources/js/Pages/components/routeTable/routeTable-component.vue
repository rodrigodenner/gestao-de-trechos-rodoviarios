<template>
  <div>
    <div v-if="routes.length > 0" class="bg-white p-4 rounded-lg shadow-md mb-4">
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
              <button @click="showMap(route.geo)" class="bg-blue-500 text-white py-1 px-3 rounded-md hover:bg-blue-600 flex justify-center items-center">
                <i class="fa-solid fa-map-location-dot"></i>
              </button>
              <button @click="openDetailsModal(route)" class="bg-yellow-500 text-white py-1 px-3 rounded-md hover:bg-yellow-600 flex justify-center items-center">
                <i class="fas fa-info-circle"></i>
              </button>
              <form @submit.prevent="() => deleteUser(route.id)">
                <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded-md hover:bg-red-600 flex justify-center items-center">
                  <i class="fas fa-trash"></i>
                </button>
              </form>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Mensagem quando não há rotas -->
    <div v-else class="bg-white p-4 rounded-lg shadow-md mb-4 text-center text-gray-500">
      Nenhuma Rota cadastrada
    </div>

    <!-- Componente de Detalhes -->
    <details-router-component
      :isOpen="isDetailsModalOpen"
      :route="selectedRoute"
      @close="closeDetailsModal"
    />

    <!-- Mapa -->
    <div class="bg-white p-4 rounded-lg shadow-md" v-if="showMapContainer">
      <div class="h-96" id="map-container"></div>
    </div>
  </div>
</template>

<script>
import { ref, watch } from 'vue';
import DetailsRouterComponent from "../modal/detailsRouter-component.vue";
import { router } from "@inertiajs/vue3";

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
  setup(props) {
    const isDetailsModalOpen = ref(false);
    const selectedRoute = ref(null);
    const map = ref(null);
    const showMapContainer = ref(true);

    const routes = ref(props.routes);

    watch(() => props.routes, (newRoutes) => {
      routes.value = newRoutes;
    });

    const clearMap = () => {
      if (map.value) {
        map.value.remove();
        map.value = null;
      }
    };

    const openDetailsModal = (route) => {
      clearMap();
      showMapContainer.value = false;
      selectedRoute.value = route;
      isDetailsModalOpen.value = true;
    };

    const closeDetailsModal = () => {
      isDetailsModalOpen.value = false;
      selectedRoute.value = null;
      showMapContainer.value = true;
    };

    const deleteUser = (id) => {
        router.delete(route('route.destroy', { id }))
    };

    const showMap = (geoJson) => {
      const parsedGeoJson = JSON.parse(geoJson);

      if (map.value) {
        map.value.remove();
      }

      map.value = L.map('map-container').setView(
        [parsedGeoJson.geometry.coordinates[0][0][1], parsedGeoJson.geometry.coordinates[0][0][0]],
        13
      );

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data © <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map.value);

      L.geoJSON(parsedGeoJson).addTo(map.value);
    };

    return {
      isDetailsModalOpen,
      selectedRoute,
      routes,
      openDetailsModal,
      closeDetailsModal,
      showMap,
      deleteUser,
      showMapContainer
    };
  }
};
</script>
