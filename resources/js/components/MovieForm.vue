<template>
    <div class="container">
      <h1>Add Movie</h1>
      <form id="movieForm" @submit.prevent="submitForm" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" id="title" class="form-control" v-model="movie.title" required>
        </div>
  
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea id="description" class="form-control" v-model="movie.description" rows="3" required></textarea>
        </div>
  
        <div class="mb-3">
          <label for="poster" class="form-label">Poster</label>
          <input class="form-control" type="file" id="poster" @change="handleFileUpload" required>
        </div>
  
        <!-- Display validation errors for each field if they exist -->
        <div v-if="errors.title" class="alert alert-danger">{{ errors.title[0] }}</div>
        <div v-if="errors.description" class="alert alert-danger">{{ errors.description[0] }}</div>
        <div v-if="errors.poster" class="alert alert-danger">{{ errors.poster[0] }}</div>
        
        <!-- Display success message -->
        <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
  
        <!-- Display error message -->
        <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>
  
        <button type="submit" class="btn btn-primary">Save</button>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  
  const movie = ref({
    title: '',
    description: '',
    poster: null,
  });
  const errors = ref({});
  const successMessage = ref('');
  const errorMessage = ref('');
  
  function handleFileUpload(event) {
    movie.value.poster = event.target.files[0];
  }
  
  function submitForm() {
    let movieForm = document.getElementById('movieForm');
    let formData = new FormData(movieForm);
  
    fetch("/api/v1/movies", {
      method: 'POST',
      body: formData,
      headers: {
        'Accept': 'application/json',
      }
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Server responded with an error!');
      }
      return response.json();
    })
    .then(data => {
      if (data.errors) {
        errors.value = data.errors;
        successMessage.value = '';
        errorMessage.value = 'There was an error with your submission.';
      } else {
        successMessage.value = 'Movie added successfully!';
        errorMessage.value = '';
        movie.value = { title: '', description: '', poster: null }; // Reset the form
        errors.value = {}; // Clear previous errors
      }
    })
    .catch(error => {
      errorMessage.value = error.message || 'An unexpected error occurred.';
      successMessage.value = '';
    });
  }
  </script>
  
  <style scoped>
  /* Scoped CSS will apply to elements in this component only */
  </style>
  