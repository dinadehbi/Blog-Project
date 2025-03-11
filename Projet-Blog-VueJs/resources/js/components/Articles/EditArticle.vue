<template>
    <div class="container mt-5">
      <h2>Edit Article</h2>
      <form @submit.prevent="editArticle">
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" v-model="title" class="form-control" required />
        </div>
        <div class="mb-3">
          <label for="content" class="form-label">Content</label>
          <textarea v-model="content" class="form-control" rows="5" required></textarea>
        </div>
        <div class="mb-3">
          <label for="category_id" class="form-label">Category</label>
          <select v-model="category_id" class="form-control" required>
            <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="tag_id" class="form-label">Tag</label>
          <select v-model="tag_id" class="form-control" required>
            <option v-for="tag in tags" :key="tag.id" :value="tag.id">{{ tag.name }}</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="image" class="form-label">Image</label>
          <input type="file" class="form-control" @change="onFileChange" />
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        title: '',
        content: '',
        category_id: null,
        tag_id: null, // New data property for the tag
        image: null,
        categories: [],
        tags: [], // New data property to hold tags
        articleId: this.$route.params.id, // Get the article ID from the route params
      };
    },
    mounted() {
      this.fetchCategories();
      this.fetchTags(); // Fetch the tags
      this.fetchArticle();
    },
    methods: {
      fetchCategories() {
        axios.get('/api/categories').then(response => {
          this.categories = response.data;
        });
      },
      fetchTags() {
        axios.get('/api/tags').then(response => {
          this.tags = response.data; // Fetch the available tags
        });
      },
      fetchArticle() {
        axios.get(`/api/articles/${this.articleId}`).then(response => {
          const article = response.data;
          this.title = article.title;
          this.content = article.content;
          this.category_id = article.category_id;
          this.tag_id = article.tags.length > 0 ? article.tags[0].id : null; // Set the first tag as default
        }).catch(error => {
          console.error('Error fetching article:', error);
        });
      },
      onFileChange(event) {
        this.image = event.target.files[0];
      },
      editArticle() {
        let formData = new FormData();
        formData.append('title', this.title);
        formData.append('content', this.content);
        formData.append('category_id', this.category_id);
        formData.append('tag_id', this.tag_id); // Add the tag_id to the form data
  
        if (this.image) {
          formData.append('image', this.image);
        }
  
        // Log form data for debugging
        console.log([...formData]);
  
        axios.put(`/api/articles/${this.articleId}`, formData)
          .then(response => {
            alert('Article updated!');
            this.$router.push('/articles'); // Redirect to articles list after saving
          })
          .catch(error => {
            if (error.response && error.response.data.errors) {
              // Print out all the validation errors to the console
              console.error('Validation Errors:', error.response.data.errors);
              alert('Validation errors occurred. Check the form.');
            } else {
              console.error('Error updating article:', error);
              alert('An unexpected error occurred.');
            }
          });
      }
    }
  };
  </script>
  