<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Início</div>
          <div class="card-body">
            Olá {{ user.name }},<br />
            Assuma o controle de seus contratos de forma inteligente e
            automatizada.
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Auth from "@/mixins/auth";

export default {
  name: "Home",

  mixins: [Auth],
};
</script>
