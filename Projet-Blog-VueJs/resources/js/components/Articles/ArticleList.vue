<template>
    <div class="container mt-5">
      <h1>Articles</h1>
      <br>
      <router-link to='/create-article' class="btn btn-primary">Create Article</router-link>
      <br><br>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Tags</th>
            <th>Content</th>
            <th>Image</th> <!-- Add this column to display image -->
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="article in articles" :key="article.id">
            <td>{{ article.title }}</td>
            <td>{{ article.category ? article.category.name : 'No Category' }}</td>
            <td>
              <span v-if="article.tags.length > 0">
                <span v-for="(tag, index) in article.tags" :key="index">
                  {{ tag.name }}<span v-if="index < article.tags.length - 1">, </span>
                </span>
              </span>
              <span v-else>No Tags</span>
            </td>
            <td>{{ article.content }}</td>
            <td>
              <!-- Display image if available -->
              <img v-if="article.image" :src="'/storage/' + article.image" alt="Article Image" style="width: 100px; height: 100px; object-fit: cover;">
            </td>
            <td>
              <router-link :to="'/edit-article/' + article.id" class="btn btn-warning btn-sm">Edit</router-link>
              <button @click="deleteArticle(article.id)" class="btn btn-danger btn-sm">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  
  const articles = ref([]);
  
  const fetchArticles = async () => {
    try {
      const response = await axios.get('http://127.0.0.1:8000/api/articles');
      articles.value = response.data;
    } catch (error) {
      console.error('Error fetching articles:', error);
    }
  };
  
  onMounted(fetchArticles);
  
  const deleteArticle = async (id) => {
    try {
      await axios.delete(`http://127.0.0.1:8000/api/articles/${id}`);
      fetchArticles();  // Refresh the list after deleting
    } catch (error) {
      console.error('Error deleting article:', error);
    }
  };
  </script>
  