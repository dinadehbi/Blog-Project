<template>
  <div>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#">{{ $t('blog') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><router-link to="/" class="nav-link">{{ $t('home') }}</router-link></li>
            <li class="nav-item"><router-link to="/articles" class="nav-link">{{ $t('articles') }}</router-link></li>
            <li class="nav-item"><router-link to="/categories" class="nav-link">{{ $t('categories') }}</router-link></li>

            <!-- Language Selector inside Navbar -->
            <li class="nav-item">
              <button @click="switchLanguage('en')" class="btn btn-outline-light">{{ $t('english') }}</button>
            </li>
            <li class="nav-item">
              <button @click="switchLanguage('ar')" class="btn btn-outline-light">{{ $t('arabic') }}</button>
              
            </li>

            <!-- User info and logout -->
            <li class="nav-item" v-if="isAuthenticated">
              <span class="nav-link text-white">{{ userName }}</span>
            </li>
            <li class="nav-item" v-if="isAuthenticated">
              <button @click="logout" class="btn btn-outline-light">{{ $t('logout') }}</button>
            </li>
            <li class="nav-item" v-else>
              <router-link to="/login" class="nav-link">{{ $t('login') }}</router-link>
            </li>
            <li class="nav-item" v-else>
              <router-link to="/register" class="nav-link">{{ $t('register') }}</router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero bg-light text-center py-5">
      <div class="container">
        <h1>{{ $t('welcome') }}</h1>
        <p>{{ $t('discover') }}</p>
      </div>
    </header>

    <!-- Articles Section -->
    <section class="articles py-5">
      <div class="container">
        <h2 class="text-center">{{ $t('latestArticles') }}</h2>
        <div class="row">
          <div v-for="article in articles" :key="article.id" class="col-md-4">
            <div class="card">
              <img :src="'/storage/' + article.image" class="card-img-top" alt="Article image" />
              <div class="card-body">
                <h5 class="card-title">{{ article.title }}</h5>
                <p class="card-text">{{ article.excerpt }}</p>
                <router-link :to="'/articles/' + article.id" class="btn btn-primary">{{ $t('readMore') }}</router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useI18n } from 'vue-i18n';
import axios from 'axios';
import { useRouter } from 'vue-router'; // Import Vue Router to handle redirection

const { t, locale } = useI18n();
const router = useRouter(); // Initialize router

const articles = ref([]);
const isAuthenticated = ref(false); // To check if the user is logged in
const userName = ref(''); // Store the user's name

// Fetch articles when component is mounted
onMounted(async () => {
  try {
    const response = await axios.get('/api/articles');
    articles.value = response.data;
  } catch (error) {
    console.error('Error fetching articles:', error);
  }

  // Check if the user is authenticated (this can be set by checking localStorage or an API)
  const user = JSON.parse(localStorage.getItem('user'));
  if (user) {
    isAuthenticated.value = true;
    userName.value = user.name; // Display the logged-in user's name
  }
});

// Switch language function
const switchLanguage = (language) => {
  locale.value = language;
};

// Logout function
const logout = () => {
  // Remove the user from localStorage and update the state
  localStorage.removeItem('user');
  isAuthenticated.value = false;
  userName.value = '';
  router.push('/login'); // Redirect to the login page after logout
};
</script>
