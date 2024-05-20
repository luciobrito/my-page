import { createApp } from 'vue'
import './style.scss'
import App from './App.vue'
import { router } from './router'
import axios from 'axios'
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import { aliases, mdi } from 'vuetify/iconsets/mdi'


axios.interceptors.response.use(response => {
    return response.headers['content-type'] === 'application/json' ? response : Promise.reject(response);
  }, error => Promise.reject(error));
axios.defaults.baseURL = import.meta.env.VITE_APIURL;
axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');

const myTheme = {
  dark: true,
  colors:{
    primary: '#336BFF',
    success: '#4CAF50',
  }
}

const vuetify = createVuetify({
  components,
  directives,
  defaults: {
    //Deixa todos os campos de texto com o estilo "outlined"
    VTextField: {variant: 'outlined'}
  },
  theme:{
    defaultTheme: 'myTheme',
    themes:{
      myTheme
    }
  },
  icons: {
    defaultSet: 'mdi',
    aliases,
    sets: {
      mdi,
    },
  },
})

createApp(App)
.use(router).use(vuetify)
.mount('#app')
