import { createRouter, createWebHistory } from 'vue-router';
import Index from '../components/index.vue'; 
import Create from '../components/create.vue';

const routes = [
  {
    path: '/',
    component: Index,  
  },
  {
    path: '/create',
    component: Create,  
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
