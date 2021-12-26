const searchBar = document.querySelector(".users .search input"),
searchBtn = document.querySelector(".users .search button");

searchBtn.onclick = () => {
    searchBar.classList.toggle('active');
    searchBtn.classList.toggle('active');
    searchBar.focus();
    // searchBar.value = '';
}
