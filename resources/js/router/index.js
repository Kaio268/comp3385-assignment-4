import { createRouter, createWebHistory } from 'vue-router';
import AboutView from "../Pages/AboutView.vue";
import HomeView from "../Pages/HomeView.vue";
import AddMovieView from "../Pages/AddMovieView.vue"; // Handles movie addition form
import MoviesView from "../Pages/MoviesView.vue"; // Displays list of movies
import LoginView from "../Pages/LoginView.vue"; // Handles user login

// Define route configuration array
const routes = [
    {
        path: '/',
        name: 'Home',
        component: HomeView
    },
    {
        path: '/about',
        name: 'About',
        component: AboutView
    },
    {
        path: '/movies/create', // Route for adding a new movie
        name: 'CreateMovie',
        component: AddMovieView
    },
    {
        path: '/movies', // Route for listing movies
        name: 'Movies',
        component: MoviesView
    },
    {
        path: '/login', // Route for user login
        name: 'Login',
        component: LoginView
    }
    // Additional routes can be placed here
];

// Create router instance with history mode and route definitions
const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
});

// Export router instance for use throughout the application
export default router;
