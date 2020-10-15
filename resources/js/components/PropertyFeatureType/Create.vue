<template>
  <div class="modal fade" ref="createFeatureType" id="createFeatureType">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Cadastrar característica</h4>
          <button type="button" class="close" data-dismiss="modal">
            &times;
          </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form
            @submit.prevent="submit"
            @keydown="form.onKeydown($event)"
            id="createFeatureTypeForm"
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
                placeholder="Nome da característica, ex.: idade do imóvel..."
              />
              <has-error :form="form" field="name"></has-error>
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
            form="createFeatureTypeForm"
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

import PropertyFeatureTypeService from "@/services/PropertyFeatureTypeService";

export default {
  name: "CreatePropertyFeatureType",

  data: () => ({
    form: new Form({
      name: "",
    }),
  }),

  methods: {
    submit() {
      PropertyFeatureTypeService.store(this.form).then(() => {
        Swal.fire("Sucesso", "Característica cadastrada.", "success");

        this.$emit("created", { name: this.form.name });
        this.form.reset();
        this.close();
      });
    },

    close() {
      $(this.$refs.createFeatureType).modal("hide");
    },
  },

  components: {
    HasError,
  },
};
</script>
