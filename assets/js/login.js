const form = document.querySelector(".login form"),
    passwordInput = form.querySelector(".field input[type='password']"),
    continueBtn = form.querySelector(".button input"),
    errorText = form.querySelector(".error-text");

form.onsubmit = (e) => {
    e.preventDefault();
};

const hideErrors = () => {
    errorText.style.display = "none";
    errorText.textContent = "";
};

continueBtn.onclick = (e) => {
    e.preventDefault();
    // Iniciar una petición AJAX al backend
    let xhr = new XMLHttpRequest(); //crear el objeto XML

    xhr.open("POST", "app/login.php", true); // hacer la petición a la ruta del archivo en el backend

    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            // verificar que se ha realizado la petición exitosamente
            if (xhr.status === 200) {
                let data = xhr.response;

                if (data == "success") {
                    form.reset(); // reset al formulario de login
                    setTimeout(() => {
                        hideErrors();
                        location.href = "users.php";
                    }, 500);
                } else {
                    // mostrar posibles errores al usuario
                    errorText.textContent = data;
                    errorText.style.display = "block";
                    passwordInput.value = "";
                    setTimeout(() => {
                        hideErrors();
                    }, 5000);
                }
            }
        }
    };

    let formData = new FormData(form); // crear el objeto FormData con los datos del formulario de registro

    xhr.send(formData); // enviar los datos del formulario al backed para hacer las operaciones requeridas
};
