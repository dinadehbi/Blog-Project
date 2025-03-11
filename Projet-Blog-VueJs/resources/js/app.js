import 'bootstrap/dist/css/bootstrap.min.css';
import { createApp } from 'vue';
import App from './components/App.vue';
import router from './router/router.js';
import { createI18n } from 'vue-i18n';
import en from './locales/en.js';
import ar from './locales/ar.js';

// Create an instance of Vue I18n
const i18n = createI18n({
  legacy: false,
  locale: 'en',  // Default language
  messages: {
    en,
    ar,
  },
});

createApp(App)
  .use(router)
  .use(i18n)  // Add Vue I18n to the app
  .mount('#app');
