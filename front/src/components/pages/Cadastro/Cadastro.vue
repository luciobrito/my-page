<template>
  <div class="form-cadastro">
    <v-card
      title="Cadastre-se"
      class="form-cadastro-card"
      :loading="this.loading"
    > 
      <v-form
        action=""
        v-on:submit.prevent="submitCadastro"
        v-model="isFormValid"
      >
        <v-text-field
          label="Nome"
          placeholder="Usuario da Silva"
          v-model="form.name"
          :error-messages="error.name"
        ></v-text-field>
        <v-text-field
          label="Email"
          placeholder="usuario@exemplo.com"
          type="email"
          v-model="form.email"
          :error-messages="error.email"
        ></v-text-field>
        <v-text-field
          label="Username"
          placeholder="username123"
          v-model="form.username"
          :error-messages="error.username"
        ></v-text-field>
        <v-text-field
          label="Senha"
          type="password"
          v-model="form.password"
          :error-messages="error.password"
        ></v-text-field>
       <!-- <v-text-field
          label="Confirmar Senha"
          type="password"
          v-model="form.password_confirm"
          :rules="[rules.password_match, rules.required]"
        ></v-text-field>-->
        <v-checkbox
          color="primary"
          label="Concorda com os termos de uso?"
        ></v-checkbox>
        <v-btn
          color="primary"
          type="submit"
          :loading="this.loading"
          >Confirmar</v-btn
        >
      </v-form>
    </v-card>
  </div>
</template>
<style src="./Cadastro.scss" lang="scss"></style>
<script>
import axios from "axios";
export default {
  data() {
    return {
      form: {
        name: "",
        username: "",
        email: "",
        password: "",
        //password_confirm: "",
        submit_disabled: false,
      },
      loading: false,
      error: {
        exists: false,
        message: null,
        name: "",
        password: "",
        email: "",
        password: ""
      },
      isFormValid: false,
      
      rules: {
        required: (value) => !!value || "Campo obrigatório!",
        password_match: (value) =>
          value === this.form.password || "Senhas não batem!",
        username: (value) => {
          //Padrão permitido para o username:
          const pattern = /^[a-zA-Z0-9._]+$/;
          return pattern.test(value) || "Somente letras, números, _ e .";
        },
      },
    };
  },
  methods: {
    submitCadastro() {
      this.loading = true;
      axios
        .post("/register", {
          name: this.form.name,
          email: this.form.email,
          username: this.form.username,
          password: this.form.password,
        })
        .then((response) => {
          localStorage.setItem("token", response.data.access_token.original.access_token);
          console.log(response.data.access_token.original.access_token);
          window.location.replace('/');
        })
        .catch((error) => {
          this.error.exists = true;
          const message = error.response.data.data;
          this.error.name = message.name;
          this.error.email = message.email;
          this.error.password = message.password;
          this.error.username = message.username;
          console.log(error.response.data.data);
        })
        .finally(() => {
          this.loading = false;
        });
    },
  },
  beforeMount() {
    var username = this.form.username;
    username.replace(/ /, "_");
  },
};
</script>
