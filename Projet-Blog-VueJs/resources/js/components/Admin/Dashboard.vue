<template>
    <div class="wrapper">
      <!-- Sidebar (Left) -->
      <aside class="main-sidebar sidebar-light-primary elevation-4">
        <br>
        <div class="sidebar">
          <ul class="nav nav-pills nav-sidebar flex-column">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <router-link to="/dashboard" class="routerLink">Dashboard</router-link>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-file-alt"></i>
                <router-link to="/articles" class="routerLink">List Articles</router-link>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tags"></i>
                <router-link to="/tags" class="routerLink">ListTags </router-link>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th-large"></i>
                <router-link to="/categories" class="routerLink">List Categories</router-link>
              </a>
            </li>
          </ul>
        </div>
      </aside>
  
      <!-- Content Wrapper -->
      <div class="content-wrapper">
        <!-- Navbar (Top) -->
        <nav class="main-header navbar navbar-expand navbar-light bg-light" id="navbar">
          <router-link to="/" class="btn btn-primary">Home</router-link>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <button class="btn btn-outline-primary">Login</button>
            </li>
            <li class="nav-item">
              <button class="btn btn-outline-success">Register</button>
            </li>
          </ul>
        </nav>
        <br>
  
        <!-- Main Content -->
        <section class="content">
          <div class="container-fluid">
            <!-- Main Stats -->
            <div class="row">
              <div class="col-md-4">
                <div class="card card-light-yellow">
                    <h3>Articles</h3>
                  <div class="card-body">
                    <p>Number of Articles: {{ articlesCount }}</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card card-light-green">
                    <h3>Comments</h3>
                  <div class="card-body">
                    <p>Number of Comments: {{ commentsCount }}</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card card-light-blue">
                    <h3>Categories</h3>
                  <div class="card-body">
                    <p>Number of Categories: {{ categoriesCount }}</p>
                  </div>
                </div>
              </div>
            </div>
  
            <!-- Chart Section -->
            <div class="row mt-4">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h3>Statistics Chart</h3>
                  </div>
                  <div class="card-body">
                    <div class="chart-placeholder">
                      <canvas id="statisticsChart"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue'
import { Chart, registerables } from 'chart.js'  // Import all required modules

// 🟢 Register Chart.js modules
Chart.register(...registerables)

const articlesCount = ref(50)
const commentsCount = ref(120)
const categoriesCount = ref(15)

onMounted(() => {
  const ctx = document.getElementById('statisticsChart').getContext('2d')
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Articles', 'Comments', 'Categories'],
      datasets: [{
        label: 'Statistics',
        data: [articlesCount.value, commentsCount.value, categoriesCount.value],
        backgroundColor: ['#FFEB3B', '#4CAF50', '#2196F3'],
        borderColor: ['#FFEB3B', '#4CAF50', '#2196F3'],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: { // 🟢 Ensure Y-axis scale is correctly defined
          beginAtZero: true
        }
      }
    }
  })
})

  </script>
  
  <style scoped>
  /* Sidebar Style */
  .main-sidebar {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    width: 250px;
    background-color: #f4f6f9; /* Light color */
    color: #343a40;
    z-index: 999;
  }
  
  .navbar {
    background-color: #f8f9fa !important;
  }
  
  .navbar-nav {
    display: flex;
    justify-content: space-around; /* Distribute buttons evenly */
  }
  
  .nav-link {
    color: #b9babc !important;
  }
  
  .nav-link:hover {
    background-color: #a4acb4;
  }
  
  /* Content Wrapper */
  .content-wrapper {
    margin-left: 250px;
    padding: 20px;
  }
  
  .card {
    margin-bottom: 20px;
  }
  
  .card-header {
    background-color: #f8f9fa;
    font-size: 18px;
    font-weight: bold;
  }
  
  .card-body {
    padding: 20px;
  }
  
  .card-light-yellow {
    background-color: #fff9c4; /* Light yellow */
    border: 1px solid #ffeb3b;
  }
  
  .card-light-green {
    background-color: #d0f8ce; /* Light green */
    border: 1px solid #4caf50;
  }
  
  .card-light-blue {
    background-color: #bbdefb; /* Light blue */
    border: 1px solid #2196f3;
  }
  
  /* Chart Placeholder */
  .chart-placeholder {
    position: relative;
    width: 100%;
    height: 300px;
    background-color: #f0f0f0;
    border: 1px solid #ddd;
    text-align: center;
    line-height: 300px;
    color: #888;
  }
  #navbar{
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .routerLink{
    text-decoration: none;
    color: #343a40;
  }
  
  </style>
  