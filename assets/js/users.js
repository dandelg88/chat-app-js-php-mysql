const searchBar = document.querySelector(".users .search input"),
    searchBtn = document.querySelector(".users .search button"),
    usersList = document.querySelector(".users .users-list");

let isSearch = false;

searchBtn.onclick = (e) => {
    e.preventDefault();
    searchBar.classList.toggle("active");
    searchBtn.classList.toggle("active");
    searchBar.focus();
    searchBar.value = "";
    isSearch = !isSearch;
};

searchBar.onkeyup = (e) => {
    e.preventDefault();
    let search = searchBar.value;

    if (search.length < 2) {
        isSearch = false;
        return;
    } else {
        isSearch = true;
    }

    let xhr = new XMLHttpRequest(); //crear el objeto XML

    xhr.open("POST", "app/search.php", true); // hacer la petición a la ruta del archivo en el backend

    xhr.onload = () => {
        // verificar que se ha realizado la petición exitosamente
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                usersList.innerHTML = xhr.response;
            }
        }
    };

    let formData = new FormData(); // crear el objeto FormData que se enviará al backend
    formData.append("search", search);

    xhr.send(formData); // enviar los datos del formulario al backed para hacer las operaciones requeridas
};

setInterval(() => {
    let xhr = new XMLHttpRequest(); //crear el objeto XML

    xhr.open("GET", "app/users.php", true); // hacer la petición a la ruta del archivo en el backend

    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            // verificar que se ha realizado la petición exitosamente
            if (xhr.status === 200) {
                let data = xhr.response;

                if (!isSearch) {
                    usersList.innerHTML = data;
                }
            }
        }
    };

    xhr.send();
}, 1500);
