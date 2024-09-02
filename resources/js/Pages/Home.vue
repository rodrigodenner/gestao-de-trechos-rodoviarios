<template>
  <div>
    <create-router-component :ufs="ufs" :rodovias="rodovias" :errors="errors" />
    <route-table-component :routes="routes" />
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
    errors: {
      type: Object,
      default: () => ({}) // Inicializa erros como um objeto vazio se não houver
    }
  },
};
</script>
