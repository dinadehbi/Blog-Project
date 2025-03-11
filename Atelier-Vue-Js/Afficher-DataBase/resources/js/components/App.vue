<template>
  <div class="container mt-5">
    <h1>Listing Products</h1>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Name</th>
          <th>Description</th>
          <th>Image</th>
          <th>Category</th>
          <th>Quantity</th>
          <th>Price</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="product in products" :key="product.id">
          <td>{{ product.name }}</td>
          <td>{{ product.description }}</td>
          <td><img :src="product.image" alt="product image" width="100" /></td>
          <td>{{ product.categorie }}</td>
          <td>{{ product.quantity }}</td>
          <td>{{ product.price }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>


<script setup>

import { ref, onMounted } from 'vue';
const products = ref([]);
import axios from 'axios';

const fetchProducts = async () => {
  try {
    const response = await axios.get('http://127.0.0.1:8000/products');
    console.log(response.data); // Vérifie les données ici
    products.value = response.data;
  } catch (error) {
    console.error('Error fetching products:', error);
  }
};

onMounted(fetchProducts);
</script>