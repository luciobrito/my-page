<script setup>
</script>

<template>
  <div style="margin-bottom: 5rem;">
 <v-card>
    <v-layout>
      <v-app-bar

        prominent
      >
        <v-toolbar-title>My-page</v-toolbar-title>

        <v-spacer></v-spacer>

        <v-btn icon="mdi-magnify" variant="text"></v-btn>

        <v-btn icon="mdi-filter" variant="text"></v-btn>

        <v-btn icon="mdi-dots-vertical" variant="text"></v-btn>
      </v-app-bar>
    </v-layout>
  </v-card></div>
<RouterView/>
</template>

<style scoped>
</style>
