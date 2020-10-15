<template>
  <div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md">
          <div class="card">
            <div class="card-header">
              <span>Clientes</span>
              <a
                href
                class="btn btn-sm btn-primary float-right"
                data-toggle="modal"
                data-target="#customerCreate"
              >
                Cadastrar Cliente
              </a>
            </div>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-if="customers.length === 0">
                    <td colspan="4">
                      <div class="alert alert-info">
                        Nenhum cliente cadastrado
                      </div>
                    </td>
                  </tr>
                  <tr v-for="customer in customers" :key="customer.id">
                    <td>{{ customer.name }}</td>
                    <td>{{ customer.email }}</td>
                    <td>
                      {{
                        customer.type === 0
                          ? "Pessoa Física"
                          : "Pessoa Jurídica"
                      }}
                    </td>
                    <td>
                      <a
                        @click.prevent="handleDelete(customer.id)"
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
    <customer-create @created="fetchCustomers" />
  </div>
</template>

<script>
import Swal from "sweetalert2";

import CustomerService from "@/services/CustomerService";

import CustomerCreate from "@/components/Customer/Create";

export default {
  name: "Index",

  data: () => ({
    customers: [],
  }),

  created() {
    this.fetchCustomers();
  },

  methods: {
    async fetchCustomers() {
      const {
        data: { data },
      } = await CustomerService.fetch();

      this.customers = data;
    },

    handleDelete(id) {
      Swal.fire({
        title: "Tem certeza ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Sim",
      }).then((result) => {
        if (result.value) {
          CustomerService.destroy(id)
            .then(() => {
              this.fetchCustomers();
              Swal.fire("Excluído!", "O cliente foi excluído.", "success");
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
    CustomerCreate,
  },
};
</script>
