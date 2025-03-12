<template>
  <div>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#">BLOG</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><router-link to="/" class="nav-link">Home</router-link></li>
            <li class="nav-item"><router-link to="/articles" class="nav-link">Articles</router-link></li>
            <li class="nav-item"><router-link to="/categories" class="nav-link">Categories</router-link></li>
            
            <select v-model="selectedLanguage" @change="switchLanguage">
              <option value="ar">العربية</option>
              <option value="en">English</option>
            </select>
            
            <li class="nav-item" v-if="isAuthenticated">
              <span style="color: white;">{{ userName }}</span>
              
            </li>
            <li class="nav-item" v-if="isAuthenticated">
              <button @click="logout" class="btn btn-outline-light">Logout</button>
            </li>
            <li class="nav-item" v-else-if="!isAuthenticated">
              <router-link to="/login" class="nav-link">Login</router-link>
            </li>
            <li class="nav-item" v-else-if="!isAuthenticated">
              <router-link to="/register" class="nav-link">Register</router-link>
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

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
      <div class="container">
        <p>&copy; 2025 Blog. All Rights Reserved.</p>
        <p>Developed by Dina Dehbi</p>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const isAuthenticated = ref(false);
const userName = ref('');

// ✅ Load user from localStorage on page load
onMounted(() => {
  const user = JSON.parse(localStorage.getItem('user'));
  if (user) {
    isAuthenticated.value = true;
    userName.value = user.name;
  }
});

// ✅ Logout Function
const logout = () => {
  localStorage.removeItem('user');
  isAuthenticated.value = false;
  userName.value = '';
  router.push('/login');
};
// Language switch function
const selectedLanguage = ref(localStorage.getItem("language") || "en"); // Get language from localStorage or default to English

const switchLanguage = () => {
  locale.value = selectedLanguage.value;
  localStorage.setItem("language", selectedLanguage.value); // Store selected language in localStorage
};
</script>




















<style>

.hero {
  background: #f8f9fa;
  padding: 50px 0;
}
footer {
  position: relative;
  bottom: 0;
  width: 100%;
  background: #343a40;
}
*{
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}
</style>
