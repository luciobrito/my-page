<script setup>
</script>

<template>
  <div style="margin-bottom: 5rem; z-index: 10;">
 <v-card style="position: unset;">
    <v-layout>
      <v-app-bar

        prominent
      >
        <v-toolbar-title><Router-link to="/">My Page</Router-link></v-toolbar-title>

        <v-spacer></v-spacer>

        <v-btn icon="" variant="text"><v-avatar image="https://images.ctfassets.net/h6goo9gw1hh6/2sNZtFAWOdP1lmQ33VwRN3/24e953b920a9cd0ff2e1d587742a2472/1-intro-photo-final.jpg?w=1200&h=992&fl=progressive&q=70&fm=jpg" size="40"></v-avatar></v-btn>

        <v-btn icon="mdi-filter" variant="text"></v-btn>
      </v-app-bar>
    </v-layout>
  </v-card></div>
<RouterView/>
</template>

<style scoped>
</style>
<script>

</script>
