import './bootstrap';
import 'primevue/resources/themes/saga-blue/theme.css';
import 'primevue/resources/primevue.min.css';
import 'primeicons/primeicons.css';

import { createApp } from 'vue'

import App from './App.vue'
import router from './router'
import mixins from './mixins'

import PrimeVue from 'primevue/config'

const app = createApp(App)

app.use(router)
app.use(PrimeVue)

app.mixin(mixins)

app.mount("#app")

window.vm = app
