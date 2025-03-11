<template>
  <div class="container mt-5">
    <h2>Create New Category</h2>
    <form @submit.prevent="createCategory">
      <div class="mb-3">
        <label for="name" class="form-label">Category Name</label>
        <input type="text" class="form-control" id="name" v-model="newCategory.name" required>
      </div>
      <button type="submit" class="btn btn-primary">Create Category</button>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

const router = useRouter();
const newCategory = ref({ name: '' });

const createCategory = async () => {
  try {
    const response = await axios.post('http://127.0.0.1:8000/api/categories', newCategory.value);
    console.log(response.data);
    router.push('/categories');
  } catch (error) {
    console.error('Error creating category:', error);
  }
};
</script>
