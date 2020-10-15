<template>
  <div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md">
          <div class="card">
            <div class="card-header">
              <span>Contratos</span>
              <a
                href
                class="btn btn-sm btn-primary float-right"
                data-toggle="modal"
                data-target="#contractCreate"
              >
                Cadastrar contrato
              </a>
            </div>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Imóvel</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-if="contracts.length === 0">
                    <td colspan="4">
                      <div class="alert alert-info">
                        Nenhum contrato cadastrado
                      </div>
                    </td>
                  </tr>
                  <tr v-for="contract in contracts" :key="contract.id">
                    <td>{{ contract.property.address }}</td>
                    <td>
                      {{ contract.customer.name }} |
                      {{ contract.customer.email }}
                    </td>
                    <td>
                      <a
                        @click.prevent="handleDelete(contract.id)"
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
    <contract-create @created="fetchContracts" />
  </div>
</template>

<script>
import Swal from "sweetalert2";

import ContractService from "@/services/ContractService";

import ContractCreate from "@/components/Contract/Create";

export default {
  name: "Index",

  data: () => ({
    contracts: [],
  }),

  created() {
    this.fetchContracts();
  },

  methods: {
    async fetchContracts() {
      const {
        data: { data },
      } = await ContractService.fetch();

      this.contracts = data;
    },

    handleDelete(id) {
      Swal.fire({
        title: "Tem certeza ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Sim",
      }).then((result) => {
        if (result.value) {
          ContractService.destroy(id)
            .then(() => {
              this.fetchContracts();
              Swal.fire("Excluído!", "O contrato foi excluído.", "success");
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

  components: {
    ContractCreate,
  },
};
</script>
