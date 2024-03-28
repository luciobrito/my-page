import { createWebHistory, createRouter } from "vue-router";
import NotFound from "./components/NotFound.vue";
import Home from "./components/Home.vue";
import Login from "./components/Login.vue";
import UserProfile from "./components/UserProfile.vue";
export const routes = [
  { path: "/", component: Home, name: "home" },
  { path: "/login", component: Login, name: "login" },
  { path: "/user/:username", component: UserProfile, name: "user-profile" },
  { path: "/:pathMatch(.*)*", component: NotFound, name: "not-found" },
];
export const router = createRouter({
  history: createWebHistory(),
  routes,
});
