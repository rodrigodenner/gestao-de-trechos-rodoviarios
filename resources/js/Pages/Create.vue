<!-- CreateRouterComponent.vue -->
<template>
  <div class="bg-white p-4 rounded-lg shadow-md mb-4">
    <form class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4" @submit.prevent="submitForm">
      <div>
        <label for="uf" class="block text-sm font-medium text-gray-700">Escolha o UF:</label>
        <select
          class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3 text-base leading-5"
          v-model="form.uf_id"
          id="uf"
          @change="filterRodovias"
        >
          <option value="">UF</option>
          <option v-for="uf in ufs" :key="uf.id" :value="uf.id">{{ uf.UF }}</option>
        </select>
      </div>
      <div>
        <label for="rodovia" class="block text-sm font-medium text-gray-700">Escolha a Rodovia:</label>
        <select
          class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3 text-base leading-5"
          v-model="form.rodovia_id"
          id="rodovia"
        >
          <option value="">Rodovia</option>
          <option v-for="rodovia in filteredRodovias" :key="rodovia.id" :value="rodovia.id">
            {{ rodovia.rodovia }}
          </option>
        </select>
      </div>
      <div>
        <label for="km-inicial" class="block text-sm font-medium text-gray-700">KM Inicial</label>
        <input
          class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3 text-base leading-5"
          type="number"
          v-model="form.kmInicial"
          id="kmInicial"
        />
      </div>
      <div>
        <label for="km-final" class="block text-sm font-medium text-gray-700">KM Final</label>
        <input
          class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3 text-base leading-5"
          type="number"
          v-model="form.kmFinal"
          id="kmFinal"
        />
      </div>
      <div>
        <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo</label>
        <select
          class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3 text-base leading-5"
          v-model="form.tipo"
          id="tipo"
        >
          <option value="">Tipo</option>
          <option value="B">B</option>
        </select>
      </div>
      <div>
        <label for="data_referencia">Data de Referência:</label>
        <input
          class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3 text-base leading-5"
          type="date"
          v-model="form.data_referencia"
          id="data_referencia"
        />
      </div>
      <div class="flex items-end">
        <button
          type="submit"
          class="w-full bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 flex justify-center items-center"
        >
          <i class="fas fa-plus"></i>
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

export default {
  name: 'CreateRouterComponent',

  props: {
    ufs: {
      type: Array,
      required: true,
    },
    rodovias: {
      type: Array,
      required: true,
    },
  },

  setup(props) {
    const form = useForm({
      uf_id: '',
      rodovia_id: '',
      kmInicial: '',
      kmFinal: '',
      tipo: '',
      data_referencia: '',
    });

    const filteredRodovias = ref([]);

    const filterRodovias = () => {
      filteredRodovias.value = props.rodovias.filter((rodovia) => rodovia.uf_id === form.uf_id);
    };

    const submitForm = () => {
      form.post(route('route.store'), {
        onSuccess: () => {
          form.reset();
          filteredRodovias.value = [];
        },
      });
    };

    return {
      form,
      filteredRodovias,
      filterRodovias,
      submitForm,
    };
  },
};
</script>
