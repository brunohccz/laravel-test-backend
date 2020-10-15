<template>
  <div class="modal fade" ref="customerCreate" id="customerCreate">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Cadastrar Cliente</h4>
          <button type="button" class="close" data-dismiss="modal">
            &times;
          </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form
            @submit.prevent="submit"
            @keydown="form.onKeydown($event)"
            id="customerCreateForm"
          >
            <div class="form-group">
              <label for="name" class="col-form-label">Nome:</label>
              <input
                v-model="form.name"
                id="name"
                name="name"
                type="text"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('name') }"
                required
              />
              <has-error :form="form" field="name"></has-error>
            </div>
            <div class="form-group">
              <label for="email" class="col-form-label">Email:</label>
              <input
                v-model="form.email"
                id="email"
                name="email"
                type="email"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('email') }"
                required
              />
              <has-error :form="form" field="email"></has-error>
            </div>
            <div class="form-group">
              <label for="email" class="col-form-label">Tipo de pessoa:</label>
              <select
                v-model="form.type"
                id="type"
                name="type"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('type') }"
                required
              >
                <option :value="0">Física</option>
                <option :value="1">Jurídica</option>
              </select>
              <has-error :form="form" field="type"></has-error>
            </div>
            <div class="form-group">
              <label for="document" class="col-form-label">
                {{ form.type === 0 ? "CPF" : "CNPJ" }}:
              </label>
              <input
                v-model="form.document"
                id="document"
                name="document"
                type="text"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('document') }"
                v-mask="
                  form.type === 0 ? '###.###.###-##' : '##.###.###/####-##'
                "
                required
              />
              <has-error :form="form" field="document"></has-error>
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
            form="customerCreateForm"
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
import { mask } from "vue-the-mask";

import CustomerService from "@/services/CustomerService";

export default {
  name: "CustomerCreate",

  directives: { mask },

  data: () => ({
    form: new Form({
      name: "",
      email: "",
      type: 0,
      document: "",
    }),
  }),

  methods: {
    submit() {
      CustomerService.store(this.form).then(() => {
        Swal.fire("Sucesso", "Cliente cadastrado.", "success");

        this.$emit("created");
        this.form.reset();
        this.close();
      });
    },

    close() {
      $(this.$refs.customerCreate).modal("hide");
    },
  },

  components: {
    HasError,
  },
};
</script>
