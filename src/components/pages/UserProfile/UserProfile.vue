<template>
  <div v-if="loading"><LoadingSpinner></LoadingSpinner></div>
  <div v-if="error.status == 404"><UserNotFound></UserNotFound></div>
  <div v-else-if="error.status == 500"><error_500></error_500></div>
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

<script src="src/components/pages/UserProfile/UserProfileScript.js"></script>
