<template>
    <div class="container mt-5">
      <h1>Edit Tag</h1>
      <form @submit.prevent="updateTag">
        <div class="mb-3">
          <label class="form-label">Tag Name</label>
          <input v-model="tag.name" type="text" class="form-control" required />
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <router-link to="/" class="btn btn-secondary ms-2">Cancel</router-link>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import { useRoute, useRouter } from 'vue-router';
  
  const route = useRoute();
  const router = useRouter();
  const tag = ref({ name: '' });
  
  const fetchTag = async () => {
    try {
      const response = await axios.get(`http://127.0.0.1:8000/api/tags/${route.params.id}`);
      tag.value = response.data;
    } catch (error) {
      console.error('Error fetching Tag:', error);
    }
  };
  
  const updateTag = async () => {
    try {
      await axios.put(`http://127.0.0.1:8000/api/tags/${route.params.id}`, {
        name: tag.value.name,
      });
      router.push('/tags');
    } catch (error) {
      console.error('Error updating tag:', error);
    }
  };
  
  // Fetch data when component is mounted
  onMounted(fetchTag);
  </script>
  