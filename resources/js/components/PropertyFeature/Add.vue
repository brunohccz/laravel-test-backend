<template>
  <div class="modal fade" ref="addFeature" id="add-feature">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Adicionar característica</h4>
          <button type="button" class="close" data-dismiss="modal">
            &times;
          </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form
            @submit.prevent="submit"
            @keydown="form.onKeydown($event)"
            id="addFeature"
          >
            <div class="form-group">
              <label for="type" class="col-form-label">Característica:</label>
              <select
                v-model="form.type"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('type') }"
                id="type"
                name="type"
              >
                <option value="" selected disabled>Selecione</option>
                <option
                  v-for="type in featureTypes"
                  :key="type.id"
                  :value="type.id"
                >
                  {{ type.name }}
                </option>
              </select>
              <has-error :form="form" field="type"></has-error>
            </div>
            <div class="form-group">
              <label for="value" class="col-form-label">Valor:</label>
              <input
                v-model="form.value"
                id="value"
                name="value"
                type="text"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('value') }"
                placeholder="10Mtrs de frente, 5Mtrs de fundo..."
              />
              <has-error :form="form" field="value"></has-error>
            </div>
          </form>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-dismiss="modal">
            Cancelar
          </button>
          <button type="submit" class="btn btn-success" form="addFeature">
            Adicionar
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Form, HasError } from "vform";

export default {
  name: "AddPropertyFeature",

  props: ["featureTypes"],

  data: () => ({
    form: new Form({
      type: "",
      value: "",
    }),
  }),

  methods: {
    submit() {
      if (this.form.type === "") {
        return this.form.errors.set("type", "Selecione a característica");
      }

      if (this.form.value === "") {
        return this.form.errors.set(
          "value",
          "Digite um valor para a característica"
        );
      }

      this.$emit("add", { type: this.form.type, value: this.form.value });
      this.form.reset();
      this.close();
    },

    close() {
      $(this.$refs.addFeature).modal("hide");
    },
  },

  components: {
    HasError,
  },
};
</script>
