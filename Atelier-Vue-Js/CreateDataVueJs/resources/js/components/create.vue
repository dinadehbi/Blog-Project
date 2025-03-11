<template>
  <div class="container mt-5">
    <h2>Create New Product</h2>
    <form @submit.prevent="createProduct">
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" v-model="newProduct.name" required>
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input type="text" class="form-control" id="description" v-model="newProduct.description" required>
      </div>
      <div class="mb-3">
        <label for="image" class="form-label">Image URL</label>
        <input type="text" class="form-control" id="image" v-model="newProduct.image" required>
      </div>
      <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <input type="text" class="form-control" id="category" v-model="newProduct.categorie" required>
      </div>
      <div class="mb-3">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="number" class="form-control" id="quantity" v-model="newProduct.quantity" required>
      </div>
      <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" class="form-control" id="price" v-model="newProduct.price" required>
      </div>
      <button type="submit" class="btn btn-primary">Create Product</button>
    </form>
  </div>
</template>

<script setup>
  import { ref } from 'vue';
  import axios from 'axios';
  import { useRouter } from 'vue-router';

  const router = useRouter();

  // Create a single object to hold all product data
  const newProduct = ref({
    name: '',
    description: '',
    image: '',
    categorie: '',
    quantity: '',
    price: ''
  });

  // Function to create a new product
  const createProduct = async () => {
    try {
      // Retrieve the CSRF token from the meta tag
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      // Send the product data to the server
      const response = await axios.post('http://127.0.0.1:8000/products', newProduct.value, {
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken,  // Include CSRF token
        }
      });

      console.log(response.data);  // Check the response from the server

      // Redirect to the index page after creating the product
      router.push('/');  // Make sure the route name matches
    } catch (error) {
      console.error('Error creating product:', error);
    }
  };
</script>
