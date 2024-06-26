import '../public/css/bootstrap.css'
import '../public/css/style.css'
import '../public/js/popper.js'
import '../public/js/bootstrap.js'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

const app = createApp(App)

app.use(router)

app.mount('#app')
