<template>
    <div class="container mt-4">
      <h2 class="mb-3">Movie List</h2>
      <div class="row">
        <!-- Loop through movies and display them in cards -->
        <div class="col-md-4 mb-3" v-for="movie in movies" :key="movie.id">
          <div class="card h-100">
            <img :src="movie.poster" class="card-img-top" alt="Movie Poster">
            <div class="card-body">
              <h5 class="card-title">{{ movie.title }}</h5>
              <p class="card-text">{{ movie.description }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  
  // Reactive property to hold the list of movies
  let movies = ref([]);
  
  // Function to fetch movies from the API
  const fetchMovies = () => {
    fetch("/api/v1/movies", {
      method: 'GET',
      headers: {
        'Accept': 'application/json',
      }
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(data => {
      movies.value = data.movies; // Assume the response has a "movies" key with the data
    })
    .catch(error => {
      console.error('Failed to fetch movies:', error);
    });
  };
  
  // Fetch movies when component is mounted
  onMounted(fetchMovies);
  </script>
  
  <style scoped>
  /* Scoped styles will apply to elements in this component only */
  .card-img-top {
    height: 200px; /* Fixed height for images */
    object-fit: cover; /* To cover the height and maintain aspect ratio */
  }
  </style>
  