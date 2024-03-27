<template>

<form v-on:submit.prevent="submitLogin">
    <label for="email">Email</label>
    <input type="email" name="" id="">
    <label for="password">Senha</label>
    <input type="password" name="" id="">
    <input type="submit" value="Login">
</form>
</template>
<script>
import axios from "axios";
export default{
    data(){
        return{
            login:{
                email:null,
                password: null
            },
            loading: false,
        };
    },
    methods: {
        submitLogin(){
            this.loading = true;
            axios
            .post('/login', {
                email: this.login.email,
                password: this.login.password
            })
            .then((response) => console.log(response));
        }
    }
}
</script>