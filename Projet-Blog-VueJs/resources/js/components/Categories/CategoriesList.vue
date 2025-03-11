<template>
  <div class="container mt-5">
    <h1>Categories</h1>
    <br>
    <router-link to='/create-category' class="btn btn-primary">Create Category</router-link> <br> <br>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Name</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="category in categories" :key="category.id">
          <td>{{ category.name }}</td>
          <td>
            <router-link :to="'/edit-category/' + category.id" class="btn btn-warning btn-sm">Edit</router-link>
            <button @click="deleteCategory(category.id)" class="btn btn-danger btn-sm">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
const categories = ref([]);

const fetchCategories = async () => {
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/categories');
    categories.value = response.data;
    console.log(response.data);
  } catch (error) {
    console.error('Error fetching categories:', error);
  }
};

onMounted(fetchCategories);

const deleteCategory = async (id) => {
  try {
    await axios.delete(`http://127.0.0.1:8000/api/categories/${id}`);
    fetchCategories(); 
  } catch (error) {
    console.error('Error deleting category:', error);
  }
};
</script>
