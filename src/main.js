import { createApp } from 'vue'
import './style.scss'
import App from './App.vue'
import { router } from './router'
import axios from 'axios'
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

axios.interceptors.response.use(response => {
    return response.headers['content-type'] === 'application/json' ? response : Promise.reject(response);
  }, error => Promise.reject(error));
axios.defaults.baseURL = 'http://localhost:4173/api';


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
  theme:{
    defaultTheme: 'myTheme',
    themes:{
      myTheme
    }
  }
})

createApp(App)
.use(router).use(vuetify)
.mount('#app')
