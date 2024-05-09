<template>
  <v-btn
    class="new-post-btn"
    icon="mdi-plus"
    size="large"
    color="primary"
    @click="dialog = true"
  ></v-btn>
  <v-dialog v-model="dialog" width="auto">
    <v-card
      max-width="400"
      prepend-icon="mdi-pencil"
      text="Um novo post para o seu perfil!"
      title="Criar um novo post"
      :loading="loading"
    >
      <v-card-text>
        <v-form>
          <v-text-field
            label="Titulo*"
            required
            v-model="post.title"
          ></v-text-field>
          <v-textarea
            label="Corpo*"
            variant="outlined"
            v-model="post.body"
          ></v-textarea
        ></v-form>
      </v-card-text>
      <template v-slot:actions>
        <v-btn
          class="ms-auto"
          @click="createPost()"
          color="primary"
          :loading="loading"
          >Criar</v-btn
        >
      </template>
    </v-card>
  </v-dialog>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      dialog: false,
      loading: false,
      post: {
        title: "",
        body: "",
      },
    };
  },
  methods: {
    createPost() {
      this.loading = true;
      axios
        .post("/post", {
          title: this.post.title,
          body: this.post.body,
        })
        .then((response) => {
          this.dialog = false;
          location.reload();
        })
        .catch((error) => {})
        .finally(() => {
          this.loading = false;
        });
    },
  },
};
</script>
<style lang="scss">
.new-post-btn {
  position: fixed !important;
  bottom: 0px;
  right: 0px;
  z-index: 99;
  font-size: 18px;
  margin: 20px;
  cursor: pointer;
}
</style>
