<template>
  <div class="container mt-5">
    <h1>Tags</h1>
    <br>
    <router-link to='/create-tag' class="btn btn-primary">Create tag</router-link> <br> <br>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Name</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="tag in tags" :key="tag.id">
          <td>{{ tag.name }}</td>
          <td>
            <router-link :to="'/edit-tag/' + tag.id" class="btn btn-warning btn-sm">Edit</router-link>
            <button @click="deleteTag(tag.id)" class="btn btn-danger btn-sm">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const tags = ref([]);

const fetchTags = async () => {
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/tags');
    tags.value = response.data;
    console.log(response.data);
  } catch (error) {
    console.error('Error fetching tags:', error);
  }
};

onMounted(fetchTags);

const deleteTag = async (id) => {
  try {
    await axios.delete(`http://127.0.0.1:8000/api/tags/${id}`);
    fetchTags(); 
  } catch (error) {
    console.error('Error deleting Tags:', error);
  }
};
</script>
