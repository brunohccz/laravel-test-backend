<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Entrar</div>

          <div class="card-body">
            <form @submit.prevent="submit" @keydown="form.onKeydown($event)">
              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right"
                  >E-Mail</label
                >

                <div class="col-md-6">
                  <input
                    id="email"
                    type="email"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('email') }"
                    name="email"
                    v-model="form.email"
                    required
                    autocomplete="email"
                    autofocus
                  />
                  <has-error :form="form" field="email"></has-error>
                </div>
              </div>

              <div class="form-group row">
                <label
                  for="password"
                  class="col-md-4 col-form-label text-md-right"
                  >Senha</label
                >

                <div class="col-md-6">
                  <input
                    id="password"
                    type="password"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('password') }"
                    name="password"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                  />
                  <has-error :form="form" field="password"></has-error>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      name="remember"
                      id="remember"
                    />

                    <label class="form-check-label" for="remember">
                      Lembrar
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">Entrar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";
import { Form, HasError } from "vform";

export default {
  name: "Login",

  data() {
    return {
      form: new Form({
        email: "",
        password: "",
      }),
    };
  },

  methods: {
    ...mapActions({
      login: "auth/login",
    }),

    async submit() {
      await this.login(this.form);
      await this.$router.replace({ name: "home" });
    },
  },

  components: {
    "has-error": HasError,
  },
};
</script>
