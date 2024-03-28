import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import { router } from './router'
import axios from 'axios'
axios.interceptors.response.use(response => {
    return response.headers['content-type'] === 'application/json' ? response : Promise.reject(response);
  }, error => Promise.reject(error));
axios.defaults.baseURL = 'http://localhost:5173/api'
createApp(App)
.use(router)
.mount('#app')
