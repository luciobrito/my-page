<template>
  <div v-if="error.status == 404"><UserNotFound></UserNotFound></div>
  <div v-else-if="error.status == 500"><error_500></error_500></div>
  <div v-else-if="loading"><LoadingSpinner></LoadingSpinner></div>
  <!--Código da página-->
  <div v-else>
    <h1>{{ user.name }}</h1>
    <i>@{{ user.username }}</i>
    <p>Entrou em: {{ user.joined_in }}</p>
    <div v-for="post in user.posts" :key="post.id">
      <h4>{{ post.title }}</h4>
      <p>Postado em: {{ post.updated_at }}</p>
      <p>{{ post.body }}</p>
    </div>
  </div>
</template>

<script>
import { useRoute } from "vue-router";
import axios from "axios";
import DateConvert from "../dateConverter";
import LoadingSpinner from "../components/modules/LoadingSpinner.vue";
import UserNotFound from "./error/UserNotFound.vue";
import Error_500 from "./error/Error_500.vue";
export default {
  components: {
    LoadingSpinner,
    UserNotFound,
    Error_500,
  },
  data() {
    return {
      user: {
        joined_in: "",
        posts: [],
      },
      error: {
        status: 0,
      },
      loading: false,
    };
  },
  methods: {
    getUserData() {
      this.loading = true;
      const route = useRoute();
      var username = route.params.username;
      //Atrasa a função de request 
      setTimeout(() => {
        axios(`/user/${username}`)
          .then((response) => {
            console.log(response.data);
            this.user = response.data;
            /*Converte a data de ISO para comum */
            this.user.joined_in = DateConvert(response.data.joined_in, false);
            /*Para cada post, data do post = data convertida */
            this.user.posts.map((post) => {
              post.updated_at = DateConvert(post.updated_at, true);
            });
          })
          .catch((error) => {
            console.log(error.response.status);
            this.error.status = error.response.status;
          })
          .finally(() => (this.loading = false));
      }, 500);
    },
  },
  beforeMount() {
    this.getUserData();
  },
};
</script>
