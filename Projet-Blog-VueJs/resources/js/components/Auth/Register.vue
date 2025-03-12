<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header text-center">
            <h4>Register</h4>
          </div>
          <div class="card-body">
            <!-- Formulaire d'inscription -->
            <form @submit.prevent="register">
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input 
                  type="text" 
                  class="form-control" 
                  id="name" 
                  v-model="form.name" 
                  :class="{'is-invalid': errors.name}" 
                />
                <div v-if="errors.name" class="invalid-feedback">
                  {{ errors.name[0] }}
                </div>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input 
                  type="email" 
                  class="form-control" 
                  id="email" 
                  v-model="form.email" 
                  :class="{'is-invalid': errors.email}" 
                />
                <div v-if="errors.email" class="invalid-feedback">
                  {{ errors.email[0] }}
                </div>
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input 
                  type="password" 
                  class="form-control" 
                  id="password" 
                  v-model="form.password" 
                  :class="{'is-invalid': errors.password}" 
                />
                <div v-if="errors.password" class="invalid-feedback">
                  {{ errors.password[0] }}
                </div>
              </div>

              <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input 
                  type="password" 
                  class="form-control" 
                  id="password_confirmation" 
                  v-model="form.password_confirmation" 
                  :class="{'is-invalid': errors.password_confirmation}" 
                />
                <div v-if="errors.password_confirmation" class="invalid-feedback">
                  {{ errors.password_confirmation[0] }}
                </div>
              </div>

              <button type="submit" class="btn btn-primary w-100">
                Register
              </button>
              <p class="mt-3 text-center">
                I have an account?
                <router-link to="/login">LogIn</router-link>
              </p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios';

export default {
  data() {
    return {
      form: {
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      },
      errors: {},
      isAuthenticated: false, // ✅ Hna zidnaha
      userName: '' // ✅ Hna zidnaha
    };
  },
  methods: {
    async register() {
      try {
        // Clear previous errors
        this.errors = {};

        // Make the POST request to register the user
        const response = await axios.post('http://127.0.0.1:8000/api/register', this.form);
        
        // ✅ Khzn user f localStorage w bdl isAuthenticated
        if (response.status === 201) {
          const user = response.data.user; // Jib user
          localStorage.setItem('user', JSON.stringify(user)); // Khzn f localStorage

          // ✅ Update variables bach tban username f navbar bla refresh
          this.isAuthenticated = true;
          this.userName = user.name;

          console.log('User registered successfully:', user);
          this.$router.push('/'); // Redirect b3d signup
        }
      } catch (error) {
        if (error.response && error.response.data.errors) {
          this.errors = error.response.data.errors;
        } else {
          console.error('An error occurred during registration:', error);
        }
      }
    }
  }
};
</script>



<style scoped>
.card {
  margin-top: 50px;
}
</style>
