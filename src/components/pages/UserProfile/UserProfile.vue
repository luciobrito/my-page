<template>
  <div v-if="loading"><LoadingSpinner></LoadingSpinner></div>
  <div v-if="error.status == 404"><UserNotFound></UserNotFound></div>
  <div v-else-if="error.status == 500"><error_500></error_500></div>
  <!--Código da página-->
  <div v-else>
    <div style="margin: 1rem;">
    <v-avatar image="https://images.ctfassets.net/h6goo9gw1hh6/2sNZtFAWOdP1lmQ33VwRN3/24e953b920a9cd0ff2e1d587742a2472/1-intro-photo-final.jpg?w=1200&h=992&fl=progressive&q=70&fm=jpg" size="160"></v-avatar>
    <h1>{{ user.name }}</h1>
    <i>@{{ user.username }}</i>
    <p>Entrou em: {{ user.joined_in }}</p></div>
    <div v-for="post in user.posts" :key="post.id" style="margin: 1rem;"> 
      <v-card :title= post.title :subtitle=post.updated_at :text=post.body></v-card>
    </div>
  </div>
</template>

<script src="src/components/pages/UserProfile/UserProfileScript.js"></script>
