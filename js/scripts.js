//registro
function validaRegistro() {
    var res = true;
    var nombre = document.getElementsByName("nombre")[0];
    var usuario = document.getElementsByName("usuario")[0];
    var clave = document.getElementsByName("clave")[0];
    var email = document.getElementsByName("email")[0];


    if (nombre.value === "") {
        res = false;
        nombre.style.borderColor = "red";
        if (nombre.nextSibling.nodeName !== "SPAN") {
            var span = document.createElement("span");
            var txt = document.createTextNode("The field must be filled");
            span.style.color = "red";
            span.appendChild(txt);
            nombre.parentNode.insertBefore(span, nombre.nextSibling);
        }

    } else {
        nombre.style.borderColor = "black";
        if (nombre.nextSibling.nodeName === "SPAN") {
            nombre.nextElementSibling.remove();
        }
    }
    if (usuario.value === "") {
        res = false;
        usuario.style.borderColor = "red";
        if (usuario.nextSibling.nodeName !== "SPAN") {
            var span = document.createElement("span");
            var txt = document.createTextNode("The field must be filled");
            span.style.color = "red";
            span.appendChild(txt);
            usuario.parentNode.insertBefore(span, usuario.nextSibling);
        }
    } else {
        usuario.style.borderColor = "black";
        if (usuario.nextSibling.nodeName === "SPAN") {
            usuario.nextElementSibling.remove();
        }
    }
    var expresionRegularClave = /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/;
    if (clave.value === "" || !expresionRegularClave.test(clave.value)) {
        res = false;
        clave.style.borderColor = "red";
        if (clave.nextSibling.nodeName !== "SPAN") {
            var span = document.createElement("span");
            var txt = document.createTextNode("Wrong format of password, it must have at least one capital letter and one number and be 8-16 long, example: exampleExample1");
            span.style.color = "red";
            span.appendChild(txt);
            clave.parentNode.insertBefore(span, clave.nextSibling);
        }
    } else {
        clave.style.borderColor = "black";
        if (clave.nextSibling.nodeName === "SPAN") {
            clave.nextElementSibling.remove();
        }
    }
    var expresionRegularEmail = /^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*[@]([a-zA-Z0-9])+[.]([a-zA-Z0-9\._-])+$/;
    if (email.value === "" || !expresionRegularEmail.test(email.value)) {
        email.style.borderColor = "red";
        res = false;
        if (email.nextSibling.nodeName !== "SPAN") {
            var span = document.createElement("span");
            var txt = document.createTextNode("Wrong forma of email, it must be: email@email.com");
            span.style.color = "red";
            span.appendChild(txt);
            email.parentNode.insertBefore(span, email.nextSibling);
        }
    } else {
        email.style.borderColor = "black";
        if (email.nextSibling.nodeName === "SPAN") {
            email.nextElementSibling.remove();
        }
    }
    return res;
}
function validaInicioSesion() {
    var res = true;
    var usuario = document.getElementsByName("usuario")[0];
    var clave = document.getElementsByName("clave")[0];
    if (usuario.value === "") {
        res = false;
        usuario.style.borderColor = "red";
        if (usuario.nextSibling.nodeName !== "SPAN") {
            var span = document.createElement("span");
            var txt = document.createTextNode("The field must be filled");
            span.style.color = "red";
            span.appendChild(txt);
            usuario.parentNode.insertBefore(span, usuario.nextSibling);
        }

    } else {
        usuario.style.borderColor = "black";
        if (usuario.nextSibling.nodeName === "SPAN") {
            usuario.nextElementSibling.remove();
        }
    }
    if (clave.value === "") {
        res = false;
        clave.style.borderColor = "red";
        if (clave.nextSibling.nodeName !== "SPAN") {
            var span = document.createElement("span");
            var txt = document.createTextNode("The field must be filled");
            span.style.color = "red";
            span.appendChild(txt);
            clave.parentNode.insertBefore(span, clave.nextSibling);
        }

    } else {
        clave.style.borderColor = "black";
        if (clave.nextSibling.nodeName === "SPAN") {
            clave.nextElementSibling.remove();
        }
    }
    return res;
}