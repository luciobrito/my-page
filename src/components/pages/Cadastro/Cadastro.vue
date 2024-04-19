<template>
    <div class="form-cadastro">
  <v-card title="Cadastre-se" class="form-cadastro-card">
    <form action="">
      <v-text-field label="Nome" placeholder="Usuario da Silva"></v-text-field>
      <v-text-field label="Email" placeholder="usuario@exemplo.com" type="email"></v-text-field>
      <v-text-field label="Username" placeholder="username123"></v-text-field>
      <v-text-field label="Senha" type="password"></v-text-field>
      <v-text-field label="Confirmar Senha" type="password"></v-text-field>
      <v-checkbox
        color="primary"
        label="Concorda com os termos de uso?"
      ></v-checkbox>
      <v-btn color="primary" type="submit">Confirmar</v-btn>
    </form>
  </v-card></div>
</template>
<style src="./Cadastro.scss" lang="scss">
</style>
<script>
import axios from "axios";
export default {
    data(){
        return {
            form:{
                nome,
                username,
                email,
                password,
                password_confirm,
            },
            loading: false,
            error:{
                exists: false,
                message: null
            }
        }
    },
    methods:{
        submitCadastro(){
            this.loading = true;
            axios.post("/cadastro", {
                
            })
        }
    }
}
</script>
