<template>
    <div class="container mt-5">
      <h1>Edit Category</h1>
      <form @submit.prevent="updateCategory">
        <div class="mb-3">
          <label class="form-label">Category Name</label>
          <input v-model="category.name" type="text" class="form-control" required />
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
  const category = ref({ name: '' });
  
  // Fetch category data
  const fetchCategory = async () => {
    try {
      const response = await axios.get(`http://127.0.0.1:8000/api/categories/${route.params.id}`);
      category.value = response.data;
    } catch (error) {
      console.error('Error fetching category:', error);
    }
  };
  
  // Update category
  const updateCategory = async () => {
    try {
      await axios.put(`http://127.0.0.1:8000/api/categories/${route.params.id}`, {
        name: category.value.name,
      });
      router.push('/categories');
    } catch (error) {
      console.error('Error updating category:', error);
    }
  };
  
  // Fetch data when component is mounted
  onMounted(fetchCategory);
  </script>
  