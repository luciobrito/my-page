<template>
  <div class="LoginBackground">
    <v-card :loading="this.loading" title="Login">
      <form v-on:submit.prevent="submitLogin">
        <div class="loginForm">
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
          >
            Login
          </v-btn>
          <p style="text-align: center; margin: 0.4rem">
            Ainda não tem uma conta? <a href="">Clique aqui</a>
          </p>
        </div>
      </form>
      <div  class="alert"><v-alert
        v-if="this.error.exist"
        closable
        type="error"
        :text="this.error.message"

      ></v-alert
    > </div>
</v-card>     
  </div>
</template>
<style lang="scss">
$form-width: 22rem;
@mixin flexbox-center{
    display: flex;
  justify-content: center;
  align-items: center;
  align-content: center;
  flex-direction: column;
}

.LoginBackground {
    @include flexbox-center();
  width: 100%;
  height: 100%;
  
}
.loginForm {
  display: flex;
  justify-content: center;
  flex-direction: column;
}
form {
  padding: 10px;
  width: $form-width;
  button{
    width: 100%;
  }
}
.alert{
    width: $form-width
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
          window.location.replace("/");
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
