<template>
  <div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">Cadastrar Imóvel</div>
            <div class="card-body">
              <form @submit.prevent="submit" @keydown="form.onKeydown($event)">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="owner_email">Email do proprietário:</label>
                      <input
                        type="email"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('owner_email'),
                        }"
                        id="owner_email"
                        required
                        v-model="form.owner_email"
                      />
                      <has-error :form="form" field="owner_email"></has-error>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="title">Titúlo:</label>
                      <input
                        type="text"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('title') }"
                        id="title"
                        required
                        v-model="form.title"
                      />
                      <has-error :form="form" field="title"></has-error>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="description">Descrição:</label>
                      <input
                        type="text"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('description'),
                        }"
                        id="description"
                        required
                        v-model="form.description"
                      />
                      <has-error :form="form" field="description"></has-error>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="street">Rua:</label>
                      <input
                        type="text"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('address.street'),
                        }"
                        id="street"
                        required
                        v-model="form.address.street"
                      />
                      <has-error
                        :form="form"
                        field="address.street"
                      ></has-error>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="number">Número:</label>
                      <input
                        type="text"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('address.number'),
                        }"
                        id="number"
                        v-model="form.address.number"
                      />
                      <has-error
                        :form="form"
                        field="address.number"
                      ></has-error>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="additional">Complemento:</label>
                      <input
                        type="text"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('address.additional'),
                        }"
                        id="additional"
                        v-model="form.address.additional"
                      />
                      <has-error
                        :form="form"
                        field="address.additional"
                      ></has-error>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="district">Bairro:</label>
                      <input
                        type="text"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('address.district'),
                        }"
                        id="district"
                        required
                        v-model="form.address.district"
                      />
                      <has-error
                        :form="form"
                        field="address.district"
                      ></has-error>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="city">Cidade:</label>
                      <input
                        type="text"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('address.city'),
                        }"
                        id="city"
                        required
                        v-model="form.address.city"
                      />
                      <has-error :form="form" field="address.city"></has-error>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="state">Estado:</label>
                      <input
                        type="text"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('address.state'),
                        }"
                        id="state"
                        required
                        v-model="form.address.state"
                      />
                      <has-error :form="form" field="address.state"></has-error>
                    </div>
                  </div>
                  <div class="col-md-12 d-flex justify-content-between my-2">
                    <h4>Caracteristicas</h4>
                    <a
                      href
                      data-toggle="modal"
                      data-target="#add-feature"
                      class="btn btn-link text-primary float-right"
                    >
                      Adicionar Caracteristicas
                    </a>
                  </div>
                  <div
                    v-for="(feature, index) in form.features"
                    :key="index"
                    class="col-md-12"
                  >
                    <div class="d-flex my-2">
                      <input
                        type="text"
                        class="form-control mr-2"
                        disabled
                        :value="featureTypeName(feature.type)"
                      />
                      <input
                        type="text"
                        class="form-control ml-2"
                        disabled
                        :value="feature.value"
                      />
                      <button
                        @click="removeFeature(index)"
                        type="button"
                        class="btn btn-sm btn-danger ml-2"
                      >
                        Remover
                      </button>
                    </div>
                  </div>
                  <div class="col-md-12" v-if="form.features.length === 0">
                    <div class="alert alert-info">
                      Nenhuma característica adicionada.
                    </div>
                  </div>
                  <div class="col-md-12 my-4">
                    <button class="btn btn-block btn-success">
                      Cadastrar Imóvel
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <router-link
            :to="{ name: 'properties.create' }"
            class="btn btn-primary btn-lg btn-block"
            >Cadastrar Imóvel</router-link
          >
          <a
            href
            data-toggle="modal"
            data-target="#createFeatureType"
            class="btn btn-light btn-lg btn-block"
          >
            Cadastrar Características
          </a>
        </div>
      </div>
    </div>
    <add-property-feature @add="addFeature" :feature-types="featureTypes" />
    <create-property-feature-type @created="fetchFeatureTypes" />
  </div>
</template>

<script>
import { Form, HasError } from "vform";
import Swal from "sweetalert2";

import PropertyService from "@/services/PropertyService";
import PropertyFeatureTypeService from "@/services/PropertyFeatureTypeService";

import AddPropertyFeature from "@/components/PropertyFeature/Add";
import CreatePropertyFeatureType from "@/components/PropertyFeatureType/Create";

export default {
  name: "Create",

  data: () => ({
    featureTypes: [],
    form: new Form({
      owner_email: "bruno@email.com",
      title: "Linda casa",
      description: "Contém 2 suítes e sacada.",
      address: {
        street: "Rua A",
        number: "100",
        additional: "",
        district: "Vila Nova",
        city: "São Paulo",
        state: "SP",
      },
      features: [],
    }),
  }),

  created() {
    this.fetchFeatureTypes();
  },

  methods: {
    submit() {
      PropertyService.store(this.form).then(() => {
        Swal.fire("Cadastrado", "O imóvel foi cadastrado.", "success");

        this.form.reset();
        this.$router.push({ name: "properties" });
      });
    },
    addFeature(feature) {
      this.form.features.push(feature);
    },
    removeFeature(key) {
      this.form.features.splice(key, 1);
    },
    async fetchFeatureTypes() {
      const {
        data: { data },
      } = await PropertyFeatureTypeService.fetch();

      this.featureTypes = data;
    },
    featureTypeName(id) {
      const type = this.featureTypes.find((type) => type.id === id);

      return type.name;
    },
  },

  components: {
    HasError,
    AddPropertyFeature,
    CreatePropertyFeatureType,
  },
};
</script>
