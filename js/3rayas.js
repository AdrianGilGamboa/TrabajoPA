var turnoJugador = 1;
var tablero = [0, 0, 0,
    0, 0, 0,
    0, 0, 0];
var contEmpates = 0;
var contGanJ1 =0;
var contGanJ2 =0;

function marcarCelda(idCelda) {

    var celda = document.getElementById("c" + idCelda);
    if (tablero[idCelda] === 0) {
        celda.style.backgroundColor = "white";
    } else if (tablero[idCelda] === 1) {
        celda.style.backgroundColor = "red";
    } else if (tablero[idCelda] === 2) {
        celda.style.backgroundColor = "blue";
    }
}
function jugarDeNuevo() {
    var confirmacion = confirm("¿Desea jugar de nuevo?");
    if (confirmacion) {
        for (var i = 0; i < tablero.length; i++) {
            tablero[i] = 0;
            marcarCelda(i);
        }
    }
}
function comprobarGanador() {
    var result;
    if (tablero[0] === tablero[1] && tablero[1] === tablero[2]) {
        result = tablero[0];
    } else if (tablero[3] === tablero[4] && tablero[4] === tablero[5]) {
        result = tablero[3];
    } else if (tablero[6] === tablero[7] && tablero[7] === tablero[8]) {
        result = tablero[6];
    } else if (tablero[0] === tablero[3] && tablero[3] === tablero[6]) {
        result = tablero[0];
    } else if (tablero[1] === tablero[4] && tablero[4] === tablero[7]) {
        result = tablero[1];
    } else if (tablero[2] === tablero[5] && tablero[5] === tablero[8]) {
        result = tablero[2];
    } else if (tablero[0] === tablero[4] && tablero[4] === tablero[8]) {
        result = tablero[0];
    } else if (tablero[2] === tablero[4] && tablero[4] === tablero[6]) {
        result = tablero[2];
    } else {
        var lleno = true;
        for (var i = 0; i < tablero.length && lleno; i++) {
            if (tablero[i] === 0) {
                lleno = false;
            }
        }
        if (lleno) {
            result = 3;
        } else {
            result = 0;
        }
    }
    return result;
}

function actualizarPuntuacion(ganador) {
    if (ganador === 1) {
        var contador = document.getElementById("ganadosJ1");
        contGanJ1++;
        while (contador.childNodes.length !== 0) {
            contador.removeChild(contador.childNodes[0]);
        }
        var txt = document.createTextNode(contGanJ1);
        contador.appendChild(txt);
        alert("Ha ganado el jugador 1");
    } else if (ganador === 2) {
        var contador = document.getElementById("ganadosJ2");
        contGanJ2++;
        while (contador.childNodes.length !== 0) {
            contador.removeChild(contador.childNodes[0]);
        }
        var txt = document.createTextNode(contGanJ2);
        contador.appendChild(txt);
        alert("Ha ganado el jugador 1");
    } else if (ganador === 3) {
        var contador = document.getElementById("empates");
        contEmpates++;
        while (contador.childNodes.length !== 0) {
            contador.removeChild(contador.childNodes[0]);
        }
        var txt = document.createTextNode(contEmpates);
        contador.appendChild(txt);
        alert("Empate");
    }
}
function seleccionarCelda(idCelda) {
    if (tablero[idCelda] !== 0) {
        alert("Casilla ocupada");
    } else {
        tablero[idCelda] = turnoJugador;
        marcarCelda(idCelda);
        if (turnoJugador === 1) {
            turnoJugador = 2;
            var turno = document.getElementById("jugadorActivo");
            while (turno.childNodes.length !== 0) {
                turno.removeChild(turno.childNodes[0]);
            }
            var txt = document.createTextNode("2");
            turno.appendChild(txt);
        } else {
            turnoJugador = 1;
            var turno = document.getElementById("jugadorActivo");
            while (turno.childNodes.length !== 0) {
                turno.removeChild(turno.childNodes[0]);
            }
            var txt = document.createTextNode("1");
            turno.appendChild(txt);
        }
    }
    var ganador = comprobarGanador();
    if(ganador === 1 || ganador === 2 || ganador === 3){
        actualizarPuntuacion(ganador);
        jugarDeNuevo();
    }
}