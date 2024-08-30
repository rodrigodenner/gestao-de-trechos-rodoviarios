<template>
  <!-- Formulário de Filtro -->
  <create-router-component />

  <!-- Tabela de Resultados -->
  <route-table-component />

  <!-- Mapa -->
  <map-component />

<!--  &lt;!&ndash; Modal de Detalhes &ndash;&gt;-->
<!--  <details-router-component :isOpen="isDetailsModalOpen" :route="selectedRoute" @close="closeDetailsModal" @edit="openEditModal" />-->

  <!-- Modal de Edição -->
<!--  <edit-router-component :isOpen="isEditModalOpen" @close="closeEditModal" />-->
</template>

<script>
import { ref } from 'vue';
import MasterTemplate from "./Layout/MasterTemplate.vue";
import MapComponent from "./components/map/map-component.vue";
import RouteTableComponent from "./components/routeTable/routeTable-component.vue";
import CreateRouterComponent from "./components/createRouter/createRouter-component.vue";
// import DetailsRouterComponent from "./components/modal/detailsRouter-component.vue";
// import EditRouterComponent from "./components/modal/editRouter-component.vue";

export default {
  components: {
    MasterTemplate,
    MapComponent,
    RouteTableComponent,
    CreateRouterComponent,
    // DetailsRouterComponent,
    // EditRouterComponent
  },
  layout: MasterTemplate,
  name: 'Home',

  setup() {
    // const isDetailsModalOpen = ref(false);
    // const isEditModalOpen = ref(false);
    // const selectedRoute = ref(null);
    //
    // function closeDetailsModal() {
    //   isDetailsModalOpen.value = false;
    //   selectedRoute.value = null;
    // }
    //
    // function openEditModal(route) {
    //   selectedRoute.value = route;
    //   isEditModalOpen.value = true;
    // }
    //
    // function closeEditModal() {
    //   isEditModalOpen.value = false;
    // }
    //
    // return {
    //   isDetailsModalOpen,
    //   isEditModalOpen,
    //   selectedRoute,
    //   closeDetailsModal,
    //   openEditModal,
    //   closeEditModal
    // };
  }
}
</script>
