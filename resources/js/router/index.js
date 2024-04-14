import { createRouter, createWebHistory } from 'vue-router';
import AboutView from "../Pages/AboutView.vue";
import HomeView from "../Pages/HomeView.vue";
import AddMovieView from "../Pages/AddMovieView.vue"; // Import the AddMovieView component
import MoviesView from "../Pages/MoviesView.vue"; // Import the MoviesView component

const routes = [
    {
        path: '/',
        name: 'Home', // It's good practice to name your routes
        component: HomeView
    },
    {
        path: '/about',
        name: 'About',
        component: AboutView
    },
    {
        path: '/movies/create', // This route is for the movie creation page
        name: 'CreateMovie',
        component: AddMovieView
    },
    {
        path: '/movies', // This route is for viewing the list of movies
        name: 'Movies',
        component: MoviesView
    }
    // ... more routes can be added here
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
});

export default router;
