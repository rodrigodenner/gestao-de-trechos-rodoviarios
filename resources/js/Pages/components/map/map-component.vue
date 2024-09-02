<template>
  <div v-if="geoJson" class="bg-white p-4 rounded-lg shadow-md">
    <div class="h-96" id="map-container"></div>
  </div>
</template>

<script>
import { ref, onMounted, watch } from 'vue';

export default {
  name: 'MapComponent',
  props: {
    geoJson: {
      type: String,
      required: true,
    },
  },
  setup(props) {
    const map = ref(null);

    const initializeMap = () => {
      const parsedGeoJson = JSON.parse(props.geoJson);

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

    onMounted(initializeMap);

    watch(() => props.geoJson, initializeMap);

    return {
      map,
    };
  }
};
</script>
