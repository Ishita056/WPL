const apiBaseUrl = "https://api.themoviedb.org/3";
const apiKey = "998faf81fb2448c17c7d691b9f63c8bd";
const imageBaseUrl = "https://image.tmdb.org/t/p/w300";

const moviesGrid = document.getElementById("movies-grid");
const searchInput = document.getElementById("search-input");
const searchForm = document.getElementById("search-form");
const categoryTitle = document.getElementById("category-title");
const filterForm = document.getElementById("filter-form");
const filterInput = document.getElementById("genre1");

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

async function filterMovies(genre){
    const response = await fetch(`${apiBaseUrl}/${genre}/movie/list?api_key=${apiKey}`); //ttps://api.themoviedb.org/3/genre/movie/list?api_key=998faf81fb2448c17c7d691b9f63c8bd
    const jsonResponse = await response.json();
    const movies = jsonResponse.results;
    console.log(movies)
    displayMovies(movies);
}

// function handleFilterFormSubmit(event){
//     event.preventDefault();
//     categoryTitle.innerHTML = "Search Results"
//     const searchQuery = searchInput.value;
//     searchMovies(searchQuery);
// }

// function getCheckboxValue() {
//     let checkboxes = document.querySelectorAll('input[name="genre"] : checked');
//     // let output = [];
//     checkboxes.forEach((checkboxes) => {
//         console.log(checkboxes.value);
//         filterMovies(checkboxes.value);
//         // output.push(checkboxes.value);
//     });
//     // document.write("you have selected", output);
// });

// function getCheckboxValue() {
//     var lang1= document.getElementById("s1");
//     var lang2= document.getElementById("s2");
//     var lang3= document.getElementById("s3");
//     var result= " ";
//     if (lang1.checke
//         d == true){
//       var lg1= document.getElementById("s1").value;
//       result= lg1 + " ";
//     }
//     else if (lang2.checked == true){
//       var lg2= document.getElementById("s2").value;
//       result= result + lg2 + " ";
//     }
//     else if (lang3.checked == true){
//     document.write(result);
//       var lg3= document.getElementById("s3").value;
//       result= result + lg3 ;
//     }
//      else {
//     return document.getElementById("result").innerHTML= "Select any one";
//     }
//     return document.getElementById("result").innerHTML= "You have selected " + result + " language";
//   }

fetchMoviesNowPlaying()
searchForm.addEventListener("submit", handleSearchFormSubmit);
// searchMovies("batman");









// document.getElementById("filter").addEventListener("reset", reset());
// might be useful::::::::    https://www.w3schools.com/jsref/met_element_remove.asp