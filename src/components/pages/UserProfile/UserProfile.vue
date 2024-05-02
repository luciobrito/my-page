<template>
  <div v-if="loading"><LoadingSpinner></LoadingSpinner></div>
  <div v-if="error.status == 404"><UserNotFound></UserNotFound></div>
  <div v-else-if="error.status == 500"><error_500></error_500></div>
  <!--Código da página-->
  <div v-else>
    <!--Cabeçalho do perfil-->
    <div style="margin: 1rem">
      <div class="profile-picture">
        <!--Se a foto de perfil estiver vazia-->
        <v-avatar
          v-if="!!user.profile_picture"
          :image="`/storage/users_images/${user.profile_picture}`"
          size="160"
          rounded="0"
          class="rounded"
        ></v-avatar>
        <v-avatar
          v-else
          :image="`/storage/users_images/blank.jpg`"
          size="160"
          rounded="0"
          class="rounded"
        ></v-avatar>
      </div>
      <h1>{{ user.name }}</h1>
      <p class="username">
        <i>@{{ user.username }}</i>
      </p>
      <p>Entrou em: {{ user.joined_in }}</p>
    </div>
    <p v-if="user.posts.length === 0">Nenhum post por enquanto...</p>

    <div v-for="post in user.posts" :key="post.id" style="margin: 1rem">
      <v-card
        :title="post.title"
        :subtitle="post.updated_at"
        :text="post.body"
      ></v-card>
    </div>
    <p id="bottom">Fim</p>
  </div>
  <v-btn
  v-if="user.is_current_user"
    class="new-post-btn"
    icon="mdi-plus"
    size="large"
    color="primary"
  ></v-btn>
</template>
<style lang="scss">
h1 {
  text-align: left;
}
@media screen and (max-width: 600px) {
  h1,
  .profile-picture,
  .username,
  #bottom {
    text-align: center;
  }
}
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
<script src="src/components/pages/UserProfile/UserProfileScript.js"></script>
