<!-- Home.vue -->
<template>
  <div>

    <create-router-component :ufs="ufs" :rodovias="rodovias" />

    <route-table-component :routes="routes" />

    <div class="bg-white p-4 rounded-lg shadow-md">
      <div class="h-96">
        <img src="https://placehold.co/1200x800" alt="Mapa" class="w-full h-full object-cover rounded-md">
      </div>
    </div>
  </div>

</template>

<script>


import CreateRouterComponent from "./components/createRouter/createRouter-component.vue";
import RouteTableComponent from "./components/routeTable/routeTable-component.vue";
import MasterTemplate from "./Layout/MasterTemplate.vue";
import MapComponent from "./components/map/map-component.vue";

export default {
  name: 'Home',
  layout: MasterTemplate,
  components: {
    MapComponent,
    RouteTableComponent,
    CreateRouterComponent

  },
  props: {
    routes: {
      type: Array,
      required: true,
    },
    ufs: {
      type: Array,
      required: true,
    },
    rodovias: {
      type: Array,
      required: true,
    },
  },
};
</script>
