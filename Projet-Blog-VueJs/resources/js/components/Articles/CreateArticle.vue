<template>
    <div class="container mt-5">
      <h2>Create New Article</h2>
      <form @submit.prevent="createArticle">
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" id="title" v-model="newArticle.title" required />
        </div>
        <div class="mb-3">
          <label for="content" class="form-label">Content</label>
          <textarea class="form-control" id="content" v-model="newArticle.content" required></textarea>
        </div>
        <div class="mb-3">
          <label for="category_id" class="form-label">Category</label>
          <select class="form-control" v-model="newArticle.category_id" required>
            <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
          </select>
        </div>
        <!-- Selection d'un seul tag -->
        <div class="mb-3">
          <label for="tag_id" class="form-label">Tag</label>
          <select class="form-control" v-model="newArticle.tag_id" required>
            <option v-for="tag in tags" :key="tag.id" :value="tag.id">{{ tag.name }}</option>
          </select>
        </div>
        <div class="mb-3">
          <label>Selected Tag</label>
          <ul class="list-group">
            <li v-if="newArticle.tag_id" class="list-group-item d-flex justify-content-between align-items-center">
              {{ getTagNameById(newArticle.tag_id) }}
            </li>
          </ul>
        </div>
        <div class="mb-3">
          <label for="image" class="form-label">Image</label>
          <input type="file" class="form-control" @change="onFileChange" />
        </div>
  
        <!-- Preview Image -->
        <div v-if="newArticle.image">
          <label>Image Preview:</label>
          <img :src="imagePreview" alt="Image Preview" style="width: 100px; height: 100px; object-fit: cover;"/>
        </div>
  
        <button type="submit" class="btn btn-primary">Create Article</button>
      </form>
    </div>
  </template>
  
  <script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

const router = useRouter();

// Article data
const newArticle = ref({
  title: '',
  content: '',
  category_id: null,
  tag_id: null,  // Correction ici : single tag
  image: null,
});

// Categories data
const categories = ref([]);

// Tags data
const tags = ref([]);

// Image preview
const imagePreview = ref('');

// Fetch categories
const fetchCategories = async () => {
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/categories');
    categories.value = response.data;
  } catch (error) {
    console.error('Error fetching categories:', error);
  }
};

// Fetch tags
const fetchTags = async () => {
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/tags');
    tags.value = response.data;
  } catch (error) {
    console.error('Error fetching tags:', error);
  }
};

// On file change for image upload
const onFileChange = (event) => {
  const file = event.target.files[0];
  newArticle.value.image = file;

  // Preview image
  const reader = new FileReader();
  reader.onload = (e) => {
    imagePreview.value = e.target.result;  // Set image preview
  };
  reader.readAsDataURL(file);
};

// Get the tag name by id
const getTagNameById = (tagId) => {
  const tag = tags.value.find(t => t.id === tagId);
  return tag ? tag.name : '';
};

// Function to create article
const createArticle = async () => {
  try {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    let formData = new FormData();
    formData.append('title', newArticle.value.title);
    formData.append('content', newArticle.value.content);
    formData.append('category_id', newArticle.value.category_id);
    formData.append('tag_id', newArticle.value.tag_id);  // Correction ici
    if (newArticle.value.image) {
      formData.append('image', newArticle.value.image);
    }

    const response = await axios.post('http://127.0.0.1:8000/api/articles', formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
        'X-CSRF-TOKEN': csrfToken,  // CSRF token
      },
    });

    console.log(response.data); // Check the response from the server
    router.push('/articles');  // Update this route as needed
  } catch (error) {
    console.error('Error creating article:', error);
  }
};

onMounted(() => {
  fetchCategories();
  fetchTags();
});
</script>
