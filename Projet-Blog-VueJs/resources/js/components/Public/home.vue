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
            <li class="nav-item"><router-link to="/about" class="nav-link">{{ $t('about') }}</router-link></li>
            <li class="nav-item"><router-link to="/contact" class="nav-link">{{ $t('contact') }}</router-link></li>

            <!-- Language Selector inside Navbar -->
            <li class="nav-item">
              <button @click="switchLanguage('en')" class="btn btn-outline-light">{{ $t('english') }}</button>
            </li>
            <li class="nav-item">
              <button @click="switchLanguage('ar')" class="btn btn-outline-light">{{ $t('arabic') }}</button>
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
import { useI18n } from 'vue-i18n';  // Import the useI18n hook
import axios from 'axios';

const { t, locale } = useI18n();  // Destructure to get t and locale

const articles = ref([]);
const isAuthenticated = ref(false); // You can modify this based on your authentication logic

// Fetch articles when component is mounted
onMounted(async () => {
  try {
    const response = await axios.get('/api/articles');
    articles.value = response.data;
  } catch (error) {
    console.error('Error fetching articles:', error);
  }
});

// Switch language function
const switchLanguage = (language) => {
  locale.value = language; // Directly change the locale using the `locale` from useI18n
};
</script>

<style scoped>
/* Remove the previous fixed positioning of language selector */
  /* Keep it as it was before but inside navbar */

</style>
