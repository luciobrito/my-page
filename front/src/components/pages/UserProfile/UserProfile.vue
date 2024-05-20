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
        <div class="username">
          <i>@{{ user.username }}</i>
          <p>Entrou em: {{ user.joined_in }}</p>
        </div>
      </div>
    </div>
    <p v-if="user.posts.length === 0">Nenhum post por enquanto...</p>
    <div id="posts-container">
      <div
        v-for="post in user.posts"
        :key="post.id"
        style="margin: 1rem"
        id="inner-posts-container"
      >
        <v-card class="mx-auto">
          <v-card-title style="display: flex"
            ><h4>{{ post.title }}</h4>
            <v-spacer></v-spacer>
            <v-menu v-if="user.is_current_user">
              <template v-slot:activator="{ props }">
                <v-btn
                  style=""
                  icon="mdi-dots-vertical"
                  v-bind="props"
                  variant="text"
                ></v-btn>
              </template>

              <v-list>
                <v-list-item>
                  <v-list-item-title><v-btn>Deletar Post</v-btn></v-list-item-title>
                </v-list-item>
              </v-list>
            </v-menu></v-card-title
          >
          <v-card-subtitle>{{ post.updated_at }}</v-card-subtitle>
          <v-card-text>{{ post.body }}</v-card-text>
        </v-card>
      </div>
    </div>
    <p id="bottom">Fim</p>
  </div>
  <!--
  <v-btn
    
    class="new-post-btn"
    icon="mdi-plus"
    size="large"
    color="primary"
  ></v-btn>-->
  <CreatePostModal v-if="user.is_current_user" />
</template>
<style lang="scss" src="./UserProfile.scss"></style>
<script src="./UserProfileScript.js"></script>
