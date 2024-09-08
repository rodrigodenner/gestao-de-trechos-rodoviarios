<template>
  <div>
    <flash-alert v-if="$page.props.flash.success" :message="$page.props.flash.success" type="success"/>
    <create-router-component :ufs="ufs" :rodovias="rodovias" :errors="errors"/>
    <route-table-component :routes="routes"/>
  </div>
</template>

<script>
import CreateRouterComponent from "./components/createRouter/createRouter-component.vue";
import RouteTableComponent from "./components/routeTable/routeTable-component.vue";
import MasterTemplate from "./Layout/MasterTemplate.vue";
import MapComponent from "./components/map/map-component.vue";
import FlashAlert from "./components/flashMessage/flash-alert.vue";

export default {
  name: 'Home',
  layout: MasterTemplate,
  components: {
    FlashAlert,
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
      default: () => ({})
    }
  },
};
</script>
