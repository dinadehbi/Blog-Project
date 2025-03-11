<template>
    <div class="container mt-5">
      <h2>Create New Tag</h2>
      <form @submit.prevent="createTag">
        <div class="mb-3">
          <label for="name" class="form-label">Tag Name</label>
          <input type="text" class="form-control" id="name" v-model="newTag.name" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Tag</button>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import axios from 'axios';
  import { useRouter } from 'vue-router';
  
  const router = useRouter();
  const newTag = ref({ name: '' });
  
  const createTag = async () => {
    try {
      const response = await axios.post('http://127.0.0.1:8000/api/tags', newTag.value);
      console.log(response.data);
      router.push('/tags');
    } catch (error) {
      console.error('Error creating tag:', error);
    }
  };
  </script>
  