<template>
  <div class="form-login">
    <v-card :loading="this.loading" title="Login" class="form-login-card">
      <form v-on:submit.prevent="submitLogin">
        <div style="margin: 10px">
          <v-text-field
            label="Email"
            type="email"
            v-model="login.email"
          ></v-text-field>
          <v-text-field
            label="Senha"
            type="password"
            v-model="login.password"
          ></v-text-field>
          <v-btn
            :loading="this.loading"
            class="btn-form"
            color="primary"
            type="submit"
            style="width: 100%;"
          >
            Login
          </v-btn>
          <p style="text-align: center; margin: 0.4rem">
            Ainda não tem uma conta? <a href="/cadastro">Clique aqui</a>
          </p>
        </div>
      </form>
      <div  class="alert"><v-alert
        v-if="this.error.exist"
        type="error"
        :text="this.error.message"

      ></v-alert
    > </div>
</v-card>     
  </div>
</template>
<style lang="scss">
.form-login{
  display: flex;
  justify-content: center;
  align-items: center;
  align-content: center;
  flex-direction: column;
  padding: 10px;
}
form{
  width: 100%;
}
.form-login-card{
  width: 100%;
}
@media screen and (min-width: 900px) {
  .form-login-card{
      width:30%
  }
}
</style>
<script>
import axios from "axios";
export default {
  data() {
    return {
      login: {
        email: null,
        password: null,
      },
      loading: false,
      error: {
        exist: false,
        message: null,
      },
    };
  },
  methods: {
    submitLogin() {
      this.loading = true;
      axios
        .post("/login", {
          email: this.login.email,
          password: this.login.password,
        })
        .then((response) => {
          localStorage.setItem('token', response.data.access_token);
          window.location.replace(`/user/${response.data.username}`);
        })
        .catch((error) => {
          this.error.exist = true;
          this.error.message = error.response.data.error_message;
        })
        .finally(() => (this.loading = false));
    },
  },
};
</script>
