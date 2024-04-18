<template>
    <div class="container">
      <h1>Login</h1>
      <form @submit.prevent="login">
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" id="email" v-model="credentials.email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" id="password" v-model="credentials.password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { useRouter } from 'vue-router'; // Import the useRouter function
  
  const credentials = ref({
    email: '',
    password: ''
  });
  
  const errorMessage = ref('');
  const router = useRouter(); // Initialize the router
  
  function login() {
    fetch('/api/v1/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify(credentials.value)
    })
    .then(response => {
      if (!response.ok) throw new Error('Login failed');
      return response.json();
    })
    .then(data => {
      if (data.access_token) {
        // Store the token in localStorage or cookies
        localStorage.setItem('jwt_token', data.access_token);
        // Use router.push() to redirect to the home page
        router.push('/');
      } else {
        // Handle any additional error messages if you have a specific format
        errorMessage.value = 'Failed to login, please check your credentials.';
      }
    })
    .catch(error => {
      errorMessage.value = error.message;
    });
  }
  </script>
  
  <style scoped>
  /* Your styles here */
  </style>
  