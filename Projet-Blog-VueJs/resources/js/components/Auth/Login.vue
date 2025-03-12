<template>
    <div class="container d-flex justify-content-center align-items-center vh-100">
      <div class="card p-4 shadow-lg" style="width: 400px">
        <h3 class="text-center mb-4">Login</h3>
        <form @submit.prevent="login">
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input v-model="form.email" type="email" class="form-control" id="email" required />
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input v-model="form.password" type="password" class="form-control" id="password" required />
          </div>
          <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <p class="mt-3 text-center">
          Don't have an account?
          <router-link to="/signup">Sign Up</router-link>
        </p>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        form: {
          email: "",
          password: "",
        },
      };
    },
    methods: {
      login() {
        console.log("Logging in with", this.form);
        this.$router.push('/'); 
      },
    },
  };
  </script>
  
  <style scoped>
  .card {
    border-radius: 10px;
  }
  </style>
  