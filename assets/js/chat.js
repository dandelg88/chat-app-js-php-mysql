const chatContent = document.querySelector(".chat-box"),
    form = document.querySelector(".typing-area"),
    msgInput = form.querySelector(".input-field"),
    sendBtn = form.querySelector("button");

const scrollToBottom = () => {
    chatContent.scrollTop = chatContent.scrollHeight;
}

chatContent.onmouseenter = (() =>{
    chatContent.classList.add("active");
});

chatContent.onmouseleave = (() =>{
    chatContent.classList.remove("active");
});

form.onsubmit = ((ev) => {
    ev.preventDefault();
});

sendBtn.onclick = ((ev) => {
    ev.preventDefault();
    let xhr = new XMLHttpRequest(); //crear el objeto XML

    xhr.open("POST", "app/insert-chat.php", true); // hacer la petición a la ruta del archivo en el backend

    xhr.onload = (() => {
        // verificar que se ha realizado la petición exitosamente
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                msgInput.value = '';
                scrollToBottom();
            }
        }
    });

    let formData = new FormData(form); // crear el objeto FormData que se enviará al backend

    xhr.send(formData); // enviar los datos del formulario al backed para hacer las operaciones requeridas
});

setInterval(() => {
    let xhr = new XMLHttpRequest(); //crear el objeto XML

    xhr.open("POST", "app/get-chat.php", true); // hacer la petición a la ruta del archivo en el backend

    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            // verificar que se ha realizado la petición exitosamente
            if (xhr.status === 200) {
                chatContent.innerHTML = xhr.response;

                if (!chatContent.classList.contains("active")) {
                    scrollToBottom();
                }
            }
        }
    };

    let formData = new FormData(form); // crear el objeto FormData que se enviará al backend

    xhr.send(formData); // enviar los datos del formulario al backed para hacer las operaciones requeridas
}, 300);
