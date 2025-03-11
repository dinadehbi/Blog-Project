<template>
  <div class="container mt-5">
    <h1>Liste des Articles de Blog</h1> <br>
    <router-link to="/create" class="btn btn-primary">Créer un Article</router-link><br><br>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Titre</th>
          <th>Contenu</th>
          <th>Image</th>
          <th>Auteur</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="blog in blogs" :key="blog.id">
          <td>{{ blog.title }}</td>
          <td>{{ blog.content.substring(0, 100) }}...</td> <!-- Limite le contenu -->
          <td>
            <img v-if="blog.image" :src="blog.image" alt="Image de l'article" width="100" />
            <span v-else>Aucune image</span>
          </td>
          <td>{{ blog.user?.name || 'Inconnu' }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const blogs = ref([]);

const fetchBlogs = async () => {
  try {
    const response = await axios.get('http://127.0.0.1:8000/blogs');
    console.log(response.data); // Vérifie les données ici
    blogs.value = response.data;
  } catch (error) {
    console.error('Erreur lors du chargement des articles:', error);
  }
};

// Charger les blogs au montage du composant
onMounted(fetchBlogs);
</script>
