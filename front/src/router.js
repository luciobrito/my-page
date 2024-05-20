import { createWebHistory, createRouter } from "vue-router";
import Home from "./components/Home.vue";
import Login from "./components/pages/Login/Login.vue";
import UserProfile from "./components/pages/UserProfile/UserProfile.vue";
import Error_404 from "./components/error/Error_404.vue";
import Cadastro from "./components/pages/Cadastro/Cadastro.vue";
import UserSettings from "./components/pages/UserSettings/UserSettings.vue";
import { AnonymousOnlyRoute, AuthOnlyRoute } from "./auth";
export const routes = [
  { path: "/", component: Home, name: "home" },
  {
    path: "/login",
    component: Login,
    name: "login",
    beforeEnter: AnonymousOnlyRoute,
  },
  {
    path: "/cadastro",
    component: Cadastro,
    name: "cadastro",
    beforeEnter: AnonymousOnlyRoute,
  },
  { path: "/user/:username", component: UserProfile, name: "user-profile" },
  { path: "/:pathMatch(.*)*", component: Error_404, name: "not-found" },
  {
    path: "/settings",
    component: UserSettings,
    name: "user-settings",
    beforeEnter: AuthOnlyRoute,
  },
];
export const router = createRouter({
  history: createWebHistory(),
  routes,
});
