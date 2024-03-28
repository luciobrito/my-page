<template>
  <div v-if="error.status == 404">Esse usuário não existe :(</div>
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
export default {
  data() {
    return {
      user: {
        joined_in: "",
        posts: [],
      },
      error: {
        status: 0,
      },
    };
  },
  methods: {
    getUserData() {
      const route = useRoute();
      var username = route.params.username;
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
        });
    },
  },
  beforeMount() {
    this.getUserData();
  },
};
</script>
