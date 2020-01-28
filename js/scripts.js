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
function validaArticulo() {
    var res = true;
    var titulo = document.getElementsByName("titulo")[0];
    var descripcion = document.getElementsByName("descripcion")[0];
    var texto = document.getElementsByName("texto")[0];
    var expresionRegularTitulo = /^[a-z A-Z0-9]{0,15}$/;
    if (titulo.value === "" || !expresionRegularTitulo.test(titulo.value)) {
        res = false;
        titulo.style.borderColor = "red";
        if (titulo.nextSibling.nodeName !== "SPAN") {
            var span = document.createElement("span");
            var txt = document.createTextNode("The field must be filled");
            span.style.color = "red";
            span.appendChild(txt);
            titulo.parentNode.insertBefore(span, titulo.nextSibling);
        }

    } else {
        titulo.style.borderColor = "lightgrey";
        if (titulo.nextSibling.nodeName === "SPAN") {
            titulo.nextElementSibling.remove();
        }
    }
    if (descripcion.value === "") {
        res = false;
        descripcion.style.borderColor = "red";
        if (descripcion.nextSibling.nodeName !== "SPAN") {
            var span = document.createElement("span");
            var txt = document.createTextNode("The field must be filled");
            span.style.color = "red";
            span.appendChild(txt);
            descripcion.parentNode.insertBefore(span, descripcion.nextSibling);
        }

    } else {
        descripcion.style.borderColor = "lightgrey";
        if (descripcion.nextSibling.nodeName === "SPAN") {
            descripcion.nextElementSibling.remove();
        }
    }
    if (texto.value === "") {
        res = false;
        texto.style.borderColor = "red";
        if (texto.nextSibling.nodeName !== "SPAN") {
            var span = document.createElement("span");
            var txt = document.createTextNode("The field must be filled");
            span.style.color = "red";
            span.appendChild(txt);
            texto.parentNode.insertBefore(span, texto.nextSibling);
        }

    } else {
        texto.style.borderColor = "lightgrey";
        if (texto.nextSibling.nodeName === "SPAN") {
            texto.nextElementSibling.remove();
        }
    }
    return res;
}
function validaAnuncio() {
    var res = true;
    var descripcion = document.getElementsByName("descripcion")[0];
    var duracion = document.getElementsByName("duracion")[0];

    if (descripcion.value === "") {
        res = false;
        descripcion.style.borderColor = "red";
        if (descripcion.nextSibling.nodeName !== "SPAN") {
            var span = document.createElement("span");
            var txt = document.createTextNode("The field must be filled");
            span.style.color = "red";
            span.appendChild(txt);
            descripcion.parentNode.insertBefore(span, descripcion.nextSibling);
        }

    } else {
        descripcion.style.borderColor = "lightgrey";
        if (descripcion.nextSibling.nodeName === "SPAN") {
            descripcion.nextElementSibling.remove();
        }
    }
    if (duracion.value === "") {
        res = false;
        duracion.style.borderColor = "red";
        if (duracion.nextSibling.nodeName !== "SPAN") {
            var span = document.createElement("span");
            var txt = document.createTextNode("The field must be filled");
            span.style.color = "red";
            span.appendChild(txt);
            duracion.parentNode.insertBefore(span, duracion.nextSibling);
        }

    } else {
        duracion.style.borderColor = "lightgrey";
        if (duracion.nextSibling.nodeName === "SPAN") {
            duracion.nextElementSibling.remove();
        }
    }
    return res;
}

function validaAnunciante() {
    var res = true;
    var nombre = document.getElementsByName("nombre")[0];
    var tarifa = document.getElementsByName("tarifa")[0];

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
        nombre.style.borderColor = "lightgrey";
        if (nombre.nextSibling.nodeName === "SPAN") {
            nombre.nextElementSibling.remove();
        }
    }
    if (tarifa.value === "") {
        res = false;
        tarifa.style.borderColor = "red";
        if (tarifa.nextSibling.nodeName !== "SPAN") {
            var span = document.createElement("span");
            var txt = document.createTextNode("The field must be filled");
            span.style.color = "red";
            span.appendChild(txt);
            tarifa.parentNode.insertBefore(span, tarifa.nextSibling);
        }

    } else {
        tarifa.style.borderColor = "lightgrey";
        if (tarifa.nextSibling.nodeName === "SPAN") {
            tarifa.nextElementSibling.remove();
        }
    }
    return res;
}

function validaClavesIguales() {
    var claveNueva = document.getElementsByName("clavenueva")[0];
    var claveNuevaRepetida = document.getElementsByName("clavenuevarepetida")[0];

    if (claveNueva.value !== claveNuevaRepetida.value) {
        claveNueva.style.borderColor = "red";
        claveNueva.style.borderWidth = "thick";
        claveNuevaRepetida.style.borderColor = "red";
        claveNuevaRepetida.style.borderWidth = "thick";
    } else {
        claveNueva.style.borderColor = "green";
        claveNuevaRepetida.style.borderColor = "green";
        claveNueva.style.borderWidth = "medium";
        claveNuevaRepetida.style.borderWidth = "medium";

    }
}
function validaModificaCuenta() {
    var res = true;
    var clave = document.getElementsByName("claveantigua")[0];

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
        clave.style.borderColor = "lightgrey";
        if (clave.nextSibling.nodeName === "SPAN") {
            clave.nextElementSibling.remove();
        }
    }
    return res;
}
$(document).ready(function () {
    $('.imagenes')
            .wrap('<span style="display:inline-block"></span>')
            .css('display', 'block')
            .parent()
            .zoom({on: 'click'});
});