<template>
  <div class="modal fade" ref="contractCreate" id="contractCreate">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Cadastrar Contrato</h4>
          <button type="button" class="close" data-dismiss="modal">
            &times;
          </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form
            @submit.prevent="submit"
            @keydown="form.onKeydown($event)"
            id="contractCreateForm"
          >
            <div class="form-group">
              <label for="property" class="col-form-label">Imóvel:</label>
              <select
                v-model="form.property"
                id="property"
                name="property"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('property') }"
                required
              >
                <option value="" disabled>Selecione</option>
                <option
                  v-for="property in properties"
                  :key="property.id"
                  :value="property.id"
                >
                  {{ property.address }}
                </option>
              </select>
              <has-error :form="form" field="property"></has-error>
            </div>
            <div class="form-group">
              <label for="customer" class="col-form-label">Cliente:</label>
              <select
                v-model="form.customer"
                id="customer"
                name="customer"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('type') }"
                required
              >
                <option value="" disabled>Selecione</option>
                <option
                  v-for="customer in customers"
                  :key="customer.id"
                  :value="customer.id"
                >
                  {{ customer.name }}
                </option>
              </select>
              <has-error :form="form" field="customer"></has-error>
            </div>
          </form>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-dismiss="modal">
            Cancelar
          </button>
          <button
            type="submit"
            class="btn btn-success"
            form="contractCreateForm"
          >
            Cadastrar
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Swal from "sweetalert2";
import { Form, HasError } from "vform";

import CustomerService from "@/services/CustomerService";
import PropertyService from "@/services/PropertyService";
import ContractService from "@/services/ContractService";

export default {
  name: "ContractCreate",

  data: () => ({
    properties: [],
    customers: [],
    form: new Form({
      property: "",
      customer: "",
    }),
  }),

  created() {
    this.fetchProperties();
    this.fetchCustomers();
  },

  methods: {
    submit() {
      ContractService.store(this.form)
        .then(() => {
          Swal.fire("Sucesso", "Contrato cadastrado.", "success");

          this.$emit("created");
          this.form.reset();
          this.close();
        })
        .catch((e) => {
          Swal.fire(
            "Erro",
            e.response.data.message ||
              "Ocorreu um erro, tente novamente mais tarde.",
            "error"
          );
        });
    },
    async fetchProperties() {
      const {
        data: { data },
      } = await PropertyService.fetch();

      this.properties = data;
    },
    async fetchCustomers() {
      const {
        data: { data },
      } = await CustomerService.fetch();

      this.customers = data;
    },
    close() {
      $(this.$refs.contractCreate).modal("hide");
    },
  },

  components: {
    HasError,
  },
};
</script>
