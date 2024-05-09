<template>
  <div v-if="loading"><LoadingSpinner></LoadingSpinner></div>
  <div v-if="error.status == 404"><UserNotFound></UserNotFound></div>
  <div v-else-if="error.status == 500"><error_500></error_500></div>
  <!--Código da página-->
  <div v-else>
    <!--Cabeçalho do perfil-->
    <div id="outer-profile-container">
      <div id="inner-profile-container">
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
    </div></div>
    <p v-if="user.posts.length === 0">Nenhum post por enquanto...</p>
<div id="posts-container">
    <div v-for="post in user.posts" :key="post.id" style=" margin: 1rem;"  id="inner-posts-container">
      <v-card
        :title="post.title"
        :subtitle="post.updated_at"
        :text="post.body"
      ></v-card>
    </div></div>
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
#bottom{
  text-align: center;
}
@media screen and (max-width: 600px) {
  h1,
  .profile-picture,
  .username{
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
@media screen and (min-width: 600px){
$desktop-gap: 80%;
#posts-container{
  display: flex;
  align-items: center;
  flex-direction: column;
}
#inner-posts-container{
  width: $desktop-gap
}
h1,
.profile-picture,
.username{
  text-align: left;
}
#inner-profile-container{
  width: $desktop-gap;
}
#outer-profile-container{
  display:flex; justify-content:center;
}

}
</style>
<script src="src/components/pages/UserProfile/UserProfileScript.js"></script>
