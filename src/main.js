import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import Home from './components/Home.vue'
import Login from './components/Login.vue'

const routes = [
    {path: '/', component:Home},
    {path: '/login', component:Login}
]

createApp(App).mount('#app')
