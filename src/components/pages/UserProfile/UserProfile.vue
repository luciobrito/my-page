<template>
  <div v-if="loading"><LoadingSpinner></LoadingSpinner></div>
  <div v-if="error.status == 404"><UserNotFound></UserNotFound></div>
  <div v-else-if="error.status == 500"><error_500></error_500></div>
  <!--Código da página-->
  <div v-else>
    <div style="margin: 1rem">
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
      
      <h1 style="text-align: left;">{{ user.name }}</h1>
      <i>@{{ user.username }}</i>
      <p>Entrou em: {{ user.joined_in }}</p>
    </div>
    <div v-for="post in user.posts" :key="post.id" style="margin: 1rem">
      <v-card
        :title="post.title"
        :subtitle="post.updated_at"
        :text="post.body"
      ></v-card>
    </div>
  </div>
</template>

<script src="src/components/pages/UserProfile/UserProfileScript.js"></script>
