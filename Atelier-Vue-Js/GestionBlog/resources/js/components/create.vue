<template>
  <div class="container mt-5">
    <h2>Créer un Nouvel Article</h2>
    <form @submit.prevent="createBlog">
      <div class="mb-3">
        <label for="title" class="form-label">Titre</label>
        <input type="text" class="form-control" id="title" v-model="newBlog.title" required />
      </div>
      <div class="mb-3">
        <label for="content" class="form-label">Contenu</label>
        <textarea class="form-control" id="content" v-model="newBlog.content" required></textarea>
      </div>
      <div class="mb-3">
        <label for="image" class="form-label">Image URL</label>
        <input type="text" class="form-control" id="image" v-model="newBlog.image" />
      </div>
      <div class="mb-3">
        <label for="user_name" class="form-label">Nom de l'Auteur</label>
        <input type="text" class="form-control" id="user_name" v-model="newBlog.user_name" required />
      </div>
      <button type="submit" class="btn btn-primary">Créer l'Article</button>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

const router = useRouter();

const newBlog = ref({
  title: '',
  content: '',
  image: '',
  user_name: ''  // Changed from user_id to user_name
});

const createBlog = async () => {
  try {
    // Retrieve the CSRF token from the meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const response = await axios.post('http://127.0.0.1:8000/blogs', newBlog.value, {
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
      }
    });

    console.log(response.data);

    // Redirect to the list page after creating the blog
    router.push('/');  // Make sure the route name is correct
  } catch (error) {
    console.error('Erreur lors de la création de l\'article:', error);
  }
};
</script>
