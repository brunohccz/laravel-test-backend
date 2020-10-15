<template>
  <div>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">
        <router-link :to="{ name: 'home' }" class="navbar-brand"
          >Accordous</router-link
        >
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul v-if="authenticated" class="navbar-nav mr-auto">
            <li class="nav-item">
              <router-link :to="{ name: 'properties' }" class="nav-link"
                >Imóveis</router-link
              >
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'customers' }" class="nav-link"
                >Clientes</router-link
              >
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'contracts' }" class="nav-link"
                >Contratos</router-link
              >
            </li>
          </ul>
          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <template v-if="!authenticated">
              <li class="nav-item">
                <router-link :to="{ name: 'login' }" class="nav-link"
                  >Entrar</router-link
                >
              </li>
            </template>
            <template v-else>
              <ul class="navbar-nav flex-row ml-md-auto d-md-flex">
                <li class="nav-item dropdown">
                  <a
                    id="navbarDropdown"
                    class="nav-link dropdown-toggle"
                    href="#"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    {{ user.name }}
                    <span class="caret"></span>
                  </a>
                  <div
                    class="dropdown-menu dropdown-menu-right"
                    aria-labelledby="navbarDropdown"
                  >
                    <a @click.prevent="logout" class="dropdown-item" href="#">
                      Sair
                    </a>
                  </div>
                </li>
              </ul>
            </template>
          </ul>
        </div>
      </div>
    </nav>
    <main class="py-4">
      <router-view></router-view>
    </main>
  </div>
</template>

<script>
import { mapActions } from "vuex";
import auth from "@/mixins/auth";

export default {
  mixins: [auth],
  methods: {
    ...mapActions({
      logoutAction: "auth/logout",
    }),

    async logout() {
      await this.logoutAction();

      await this.$router.push({ name: "login" });
    },
  },
};
</script>
