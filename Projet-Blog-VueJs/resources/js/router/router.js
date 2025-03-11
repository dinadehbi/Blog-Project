import { createRouter, createWebHistory } from 'vue-router';
import CreateCategorie from '../components/Categories/CreateCategory.vue';
import Categories from '../components/Categories/CategoriesList.vue';
import EditCategory from '../components/Categories/EditCategory.vue';
import Tags from '../components/Tags/TagsList.vue';
import CreateTag from '../components/Tags/CreateTag.vue';
import EditTag from '../components/Tags/EditTag.vue';
import Articles from '../components/Articles/ArticleList.vue';
import CreateArticle from '../components/Articles/CreateArticle.vue';
import EditArticle from '../components/Articles/EditArticle.vue';
import Dashboard from '../components/Admin/Dashboard.vue';
import Home from '../components/Public/home.vue';


const routes = 
[
  {
    path: '/categories',
    component: Categories,  
  },
  {
    path: '/create-category',
    component: CreateCategorie,  
  },
  { path: '/edit-category/:id',
    component: EditCategory 
  },
  { path: '/tags',
    component: Tags 
  },
  { path: '/create-tag',
    component: CreateTag 
  },
  { path: '/edit-tag/:id',
    component: EditTag 
  },
  { path: '/articles',
    component: Articles 
  },
  { path: '/create-article',
    component: CreateArticle 
  },
  { path: '/edit-article/:id',
    component: EditArticle 
  },
  { 
    path: '/dashboard',
     component: Dashboard
  },
  {
    path: '/',
    component: Home
  }

];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
