<template>
    <div>
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
          <a class="navbar-brand" href="#">Blog</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>


          <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><router-link to="/" class="nav-link">Home</router-link></li>
            <li class="nav-item"><router-link to="/articles" class="nav-link">Articles</router-link></li>
            <li class="nav-item"><router-link to="/categories" class="nav-link">Categories</router-link></li>
            <li class="nav-item"><router-link to="/about" class="nav-link">About</router-link></li>
            <li class="nav-item"><router-link to="/contact" class="nav-link">Contact</router-link></li>

            <!-- Dropdown Button for Login/Register/Logout -->
            <li class="nav-item dropdown">
              <button class="btn btn-primary dropdown-toggle" type="button" id="authDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                Auth Options
              </button>
              <ul class="dropdown-menu" aria-labelledby="authDropdown">
                <li v-if="!isAuthenticated"><router-link to="/login" class="dropdown-item">Login</router-link></li>
                <li v-if="!isAuthenticated"><router-link to="/register" class="dropdown-item">Register</router-link></li>
                <li v-if="isAuthenticated"><router-link to="/logout" class="dropdown-item">Logout</router-link></li>
              </ul>
            </li>
          </ul>
        </div>



        </div>
      </nav>
  
      <!-- Hero Section -->
      <header class="hero bg-light text-center py-5">
        <div class="container">
          <h1>Welcome to Our Blog</h1>
          <p>Discover insightful articles and stay updated with the latest trends.</p>
        </div>
      </header>
  
      <!-- Articles Section -->
      <section class="articles py-5">
        <div class="container">
          <h2 class="text-center">Latest Articles</h2>
          <div class="row">
            <div v-for="article in articles" :key="article.id" class="col-md-4">
              <div class="card">
                <img :src="'/storage/' + article.image" class="card-img-top" alt="Article image" />
                <div class="card-body">
                  <h5 class="card-title">{{ article.title }}</h5>
                  <p class="card-text">{{ article.excerpt }}</p>
                  <router-link :to="'/articles/' + article.id" class="btn btn-primary">Read More</router-link>
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
  import axios from 'axios';
  
  const articles = ref([]);
  
  onMounted(async () => {
    try {
      const response = await axios.get('/api/articles'); // API for articles
      articles.value = response.data;
    } catch (error) {
      console.error('Error fetching articles:', error);
    }
  });
  </script>
  
  <style scoped>
  /* Add additional styles here if needed */
  </style>
  