<template>
  <div class="fixed z-10 inset-0 overflow-y-auto flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-gray-200 rounded-lg shadow-xl max-w-md w-full p-6">
      <h2 class="text-2xl font-semibold text-gray-800 mb-6">Editar Trecho</h2>
      <form @submit.prevent="submitForm" class="space-y-4">
        <div>
          <label for="edit-uf" class="block text-sm font-medium text-gray-700">UF</label>
          <select
            v-model="form.uf_id"
            @change="filterRodovias"
            class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3"
          >
            <option v-for="uf in ufs" :value="uf.id" :key="uf.id">{{ uf.UF }}</option>
          </select>
          <div v-if="errors.uf_id" class="text-red-500 text-sm mt-1">{{ errors.uf_id }}</div>
        </div>

        <div>
          <label for="edit-rodovia" class="block text-sm font-medium text-gray-700">Rodovia</label>
          <select
            v-model="form.rodovia_id"
            class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3"
          >
            <option v-for="rodovia in filteredRodovias" :value="rodovia.id" :key="rodovia.id">{{ rodovia.rodovia }}</option>
          </select>
          <div v-if="errors.rodovia_id" class="text-red-500 text-sm mt-1">{{ errors.rodovia_id }}</div>
        </div>

        <div>
          <label for="edit-km-inicial" class="block text-sm font-medium text-gray-700">KM Inicial</label>
          <input
            type="number"
            id="edit-km-inicial"
            v-model="form.kmInicial"
            class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3"
          />
          <div v-if="errors.kmInicial" class="text-red-500 text-sm mt-1">{{ errors.kmInicial }}</div>
        </div>

        <div>
          <label for="edit-km-final" class="block text-sm font-medium text-gray-700">KM Final</label>
          <input
            type="number"
            id="edit-km-final"
            v-model="form.kmFinal"
            class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3"
          />
          <div v-if="errors.kmFinal" class="text-red-500 text-sm mt-1">{{ errors.kmFinal }}</div>
        </div>

        <div>
          <label for="edit-tipo" class="block text-sm font-medium text-gray-700">Tipo</label>
          <select
            v-model="form.tipo"
            class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3"
            required
          >
            <option value="" disabled>Selecione um tipo</option>
            <option value="B">B</option>
          </select>
          <div v-if="errors.tipo" class="text-red-500 text-sm mt-1">{{ errors.tipo }}</div>
        </div>

        <div class="flex justify-end mt-6">
          <button type="button" class="bg-indigo-500 text-white py-2 px-4 rounded-md mr-2" @click="closeModal">
            Cancelar
          </button>
          <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-md">Salvar</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue';
import { router, useForm } from '@inertiajs/vue3';

export default {
  props: {
    ufs: {
      type: Array,
      required: true,
    },
    rodovias: {
      type: Array,
      required: true,
    },
    route: {
      type: Object,
      required: true,
    },
    errors: {
      type: Object,
      default: () => ({}),
    },
  },
  setup(props) {
    const form = useForm({
      uf_id: props.route.uf_id || '',
      rodovia_id: props.route.rodovia_id || '',
      kmInicial: props.route.kmInicial || '',
      kmFinal: props.route.kmFinal || '',
      tipo: 'B',
      data_referencia: props.route.data_referencia || '',
    });

    const filteredRodovias = ref([]);

    const filterRodovias = () => {
      filteredRodovias.value = props.rodovias.filter(rodovia => rodovia.uf_id === form.uf_id);
    };

    if (form.uf_id) {
      filterRodovias();
    }

    const submitForm = () => {
      form.put(route('route.update', {id: props.route.id}), {
        onError: (errors) => {
          Object.assign(props.errors, errors);
        },
        onSuccess: () => {
          closeModal();
        },
      });
    };

    const closeModal = () => {
      router.visit(route('route.index'));
    };

    return {
      form,
      filteredRodovias,
      filterRodovias,
      submitForm,
      closeModal,
      errors: props.errors,
    };
  }
};
</script>
