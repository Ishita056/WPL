const apiBaseUrl = "https://api.themoviedb.org/3";
const apiKey = "998faf81fb2448c17c7d691b9f63c8bd";
const imageBaseUrl = "https://image.tmdb.org/t/p/w300";

const moviesGrid = document.getElementById("movies-grid");
const searchInput = document.getElementById("search-input");
const searchForm = document.getElementById("search-form");
const categoryTitle = document.getElementById("category-title");

async function fetchMoviesNowPlaying(){
    // <h1>What's New?</h1>;
    const response = await fetch(`${apiBaseUrl}/discover/movie?api_key=${apiKey}`);
    const jsonResponse = await response.json();
    const movies = jsonResponse.results;
    displayMovies(movies);
}

function displayMovies(movies){
    moviesGrid.innerHTML = movies.map(movie => `
        <div class="movie-card">
            <img src="${imageBaseUrl}${movie.poster_path}"/>
            <p>⭐${movie.vote_average}</p>
            <h2>${movie.title}</h2>
        </div>
    `).join("");
}

async function searchMovies(query){
    const response = await fetch(`${apiBaseUrl}/search/movie?api_key=${apiKey}&query="${query}"`);
    const jsonResponse = await response.json();
    const movies = jsonResponse.results;
    displayMovies(movies);
}

function handleSearchFormSubmit(event){
    event.preventDefault();
    categoryTitle.innerHTML = "Search Results"
    const searchQuery = searchInput.value;
    searchMovies(searchQuery);
}

fetchMoviesNowPlaying()
searchForm.addEventListener("submit", handleSearchFormSubmit);
// searchMovies("batman");




// might be useful::::::::    https://www.w3schools.com/jsref/met_element_remove.asp