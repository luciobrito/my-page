<template>
  <div style="margin-bottom: 5rem; z-index: 10">
    <v-card style="position: unset">
      <v-layout>
        <v-app-bar prominent>
          <v-toolbar-title
            ><Router-link to="/" style="font-weight: bold; font-size: 30px">MyPage</Router-link></v-toolbar-title
          >

          <v-spacer></v-spacer>
          

          <v-menu v-if="error.status != 401" transition="scale-transition">
            <template v-slot:activator="{ props }">
              <v-btn icon="" v-bind="props" variant="text"
                ><v-avatar
                  :image="`http://localhost:5173/storage/users_images/${user.image}`"
                  size="40"
                ></v-avatar
              ></v-btn>
            </template>
            <v-list>
              <v-list-item>
                <v-list-item-title>
                  <v-btn><v-icon icon="mdi-account" start></v-icon><a v-bind:href="`/user/${user.username}`">Meu Perfil</a></v-btn>
                </v-list-item-title>
                <v-list-item-title
                  ><v-btn>
                    <v-icon icon="mdi-cog" start></v-icon><a href="/settings"> Configurações</a></v-btn
                  ></v-list-item-title
                >
                <v-list-item-title><v-btn><v-icon icon="mdi-exit-to-app" start></v-icon>Sair</v-btn></v-list-item-title>
              </v-list-item>
            </v-list>
          </v-menu>
          <v-btn v-else><a href="/login"> Login</a></v-btn>
        </v-app-bar>
      </v-layout>
    </v-card>
  </div>
  <RouterView />
</template>
<script>
import axios from 'axios';
import { RouterLink } from 'vue-router';

export default {
  data(){
    return{
      user:{
        username: "",
        image: ""
      },
      error:{
        status: ""
      }
    }
  },
  methods:{
    getUserData(){
      axios('/self')
      .then((response)=> {
        this.user.username = response.data.username;
        this.user.image = response.data.image;

      }).catch((error) => {
        console.log(error.response.status)
        this.error.status = error.response.status
        if(error.response.status == 401) {localStorage.removeItem('token')}
      })
    }
  },
  beforeMount(){
    this.getUserData();
    
  }
}
</script>
<style scoped>a{text-decoration: none; color: inherit;}</style>
