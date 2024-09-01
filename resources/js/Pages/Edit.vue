<template>
  <div class="fixed z-10 inset-0 overflow-y-auto flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-gray-200 rounded-lg shadow-xl max-w-md w-full p-6">
      <h2 class="text-2xl font-semibold text-gray-800 mb-6">Editar Trecho</h2>
      <form @submit.prevent="submitForm" class="space-y-4">

        <!-- UF -->
        <div>
          <label for="edit-uf" class="block text-sm font-medium text-gray-700">UF</label>
          <select
            v-model="form.uf_id"
            @change="filterRodovias"
            class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3"
          >
            <option v-for="uf in ufs" :value="uf.id" :key="uf.id">{{ uf.UF }}</option>
          </select>
        </div>

        <!-- Rodovia -->
        <div>
          <label for="edit-rodovia" class="block text-sm font-medium text-gray-700">Rodovia</label>
          <select
            v-model="form.rodovia_id"
            class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3"
          >
            <option v-for="rodovia in filteredRodovias" :value="rodovia.id" :key="rodovia.id">{{ rodovia.rodovia }}</option>
          </select>
        </div>

        <!-- KM Inicial -->
        <div>
          <label for="edit-km-inicial" class="block text-sm font-medium text-gray-700">KM Inicial</label>
          <input
            type="text"
            id="edit-km-inicial"
            v-model="form.kmInicial"
            class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3"
          />
        </div>

        <!-- KM Final -->
        <div>
          <label for="edit-km-final" class="block text-sm font-medium text-gray-700">KM Final</label>
          <input
            type="text"
            id="edit-km-final"
            v-model="form.kmFinal"
            class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3"
          />
        </div>

        <!-- Tipo -->
        <div>
          <label for="edit-tipo" class="block text-sm font-medium text-gray-700">Tipo</label>
          <select
            v-model="form.tipo"
            class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3">
            <option value="B">B</option>
          </select>
        </div>

        <!-- Botões -->
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
import { useForm } from '@inertiajs/vue3';

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
  },
  setup(props) {
    // Preenche o formulário com os dados da rota recebida
    const form = useForm({
      uf_id: props.route.uf_id || '',
      rodovia_id: props.route.rodovia_id || '',
      kmInicial: props.route.kmInicial || '',
      kmFinal: props.route.kmFinal || '',
      tipo: 'B', // Valor fixo para o tipo
      data_referencia: props.route.data_referencia || '',
    });

    const filteredRodovias = ref([]);

    // Filtra rodovias baseadas na UF selecionada
    const filterRodovias = () => {
      filteredRodovias.value = props.rodovias.filter(rodovia => rodovia.uf_id === form.uf_id);
    };

    // Filtrando rodovias na carga inicial se houver uma UF selecionada
    if (form.uf_id) {
      filterRodovias();
    }

    // Submissão do formulário
    const submitForm = () => {
      form.put(route('route.update', { id: props.route.id }), {
        onSuccess: () => {
          // Fechar modal ou redirecionar após salvar
          closeModal();
        },
      });
    };

    const closeModal = () => {
      // Logica para fechar o modal
    };

    return {
      form,
      filteredRodovias,
      filterRodovias,
      submitForm,
      closeModal,
    };
  }
};
</script>
