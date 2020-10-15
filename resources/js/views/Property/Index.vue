<template>
  <div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md">
          <div class="card">
            <div class="card-header">
              <span>Imóveis</span>
              <router-link
                :to="{ name: 'properties.create' }"
                class="btn btn-sm btn-primary float-right"
              >
                Cadastrar Imóvel
              </router-link>
            </div>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th
                      @click="toggleSortTable('email')"
                      scope="col"
                      class="sortable"
                    >
                      <span>Email</span>
                      <i v-if="sortTableType === 'asc'">&uparrow;</i>
                      <i v-else>&downarrow;</i>
                    </th>
                    <th scope="col">Endereço</th>
                    <th scope="col">Status</th>
                    <th scope="col">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-if="properties.length === 0">
                    <td colspan="4">
                      <div class="alert alert-info">
                        Nenhum imóvel cadastrado
                      </div>
                    </td>
                  </tr>
                  <tr v-for="property in propertiesSorted" :key="property.id">
                    <td>{{ property.email }}</td>
                    <td>{{ property.address }}</td>
                    <td>{{ property.status }}</td>
                    <td>
                      <a
                        @click.prevent="handleDelete(property.id)"
                        href="#"
                        class="btn btn-link text-danger"
                      >
                        Excluir
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Swal from "sweetalert2";
import PropertyService from "@/services/PropertyService";
import SortableTable from "@/mixins/sortableTable";

export default {
  name: "Index",

  mixins: [SortableTable],

  data: () => ({
    properties: [],
  }),

  created() {
    this.fetchProperties();
    this.sortTableCol = "email";
  },

  methods: {
    async fetchProperties() {
      const {
        data: { data },
      } = await PropertyService.fetch();

      this.properties = data;
    },

    handleDelete(id) {
      Swal.fire({
        title: "Tem certeza ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Sim",
      }).then((result) => {
        if (result.value) {
          PropertyService.destroy(id)
            .then(() => {
              this.fetchProperties();
              Swal.fire("Excluído!", "O imóvel foi excluído.", "success");
            })
            .catch(() => {
              Swal.fire(
                "Erro",
                "Ocorreu um erro, tente novamente mais tarde.",
                "error"
              );
            });
        }
      });
    },
  },

  computed: {
    propertiesSorted() {
      return this.properties.sort(this.sortable());
    },
  },
};
</script>

<style scoped type='text/css'>
.sortable {
  cursor: pointer;
}
</style>
