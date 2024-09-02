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
            <button @click="showMap(route.geo)"  class="bg-blue-500 text-white py-1 px-3 rounded-md hover:bg-blue-600 flex justify-center items-center">
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

  <div class="bg-white p-4 rounded-lg shadow-md">
    <div class="h-96" id="map-container"></div>
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
      map: null, // Variável para armazenar a instância do mapa
    };
  },
  created() {
    // Log dos dados de routes ao criar o componente
    console.log('Dados recebidos pela prop routes:', this.routes);
  },
  mounted() {
    // Inicializa o mapa com uma localização padrão ao montar o componente
    this.initializeMap([ -15.794229, -47.882166 ], 10);
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
    initializeMap(centerCoordinates, zoomLevel) {
      // Remove o mapa existente, se houver
      if (this.map) {
        this.map.remove();
      }

      // Inicializa o mapa no contêiner com as coordenadas padrão
      this.map = L.map('map-container').setView(centerCoordinates, zoomLevel);

      // Adiciona uma camada de tiles ao mapa (OpenStreetMap)
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data © <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(this.map);
    },
    showMap(geoJson) {
      // Transforma a string em um objeto JavaScript
      const parsedGeoJson = JSON.parse(geoJson);

      // Inicializa o mapa com as coordenadas do GeoJSON
      const firstCoordinates = parsedGeoJson.geometry.coordinates[0][0];
      this.initializeMap([firstCoordinates[1], firstCoordinates[0]], 13);

      // Adiciona o GeoJSON ao mapa
      L.geoJSON(parsedGeoJson).addTo(this.map);
    }
  },
};
</script>




