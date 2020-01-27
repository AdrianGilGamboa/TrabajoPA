<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Three in a row</title>
	<style type="text/css" media="screen">
		body{
			text-align: center;
		}
		td{
			width: 100px;
			height: 100px;
			border: 1px black solid;
		}	
	</style>
        <script src="../js/3rayas.js" type="text/javascript"></script>
</head>
<body>
    <?php
    if(isset($_POST['jugar3raya'])){
        if($_POST['tipo'] === "silver"){
            $nombreUsuario = $_POST['nombre'];
        }else{
            header('Location: cuenta.php');
        }
    }else{
        header('Location: cuenta.php');
    }
    ?>
	<h1>Hi <?php echo $nombreUsuario;?> this is Three in a row!</h1>
	Turn of player: <span id="jugadorActivo">1</span>
	<br><br>
	<table align="center">
		<tr>
			<td id="c0" onclick="seleccionarCelda(0)"></td>
			<td id="c1" onclick="seleccionarCelda(1)"></td>
			<td id="c2" onclick="seleccionarCelda(2)"></td>
		</tr>
		<tr>
			<td id="c3" onclick="seleccionarCelda(3)"></td>
			<td id="c4" onclick="seleccionarCelda(4)"></td>
			<td id="c5" onclick="seleccionarCelda(5)"></td>
		</tr>
		<tr>
			<td id="c6" onclick="seleccionarCelda(6)"></td>
			<td id="c7" onclick="seleccionarCelda(7)"></td>
			<td id="c8" onclick="seleccionarCelda(8)"></td>
		</tr>
	</table>
	<br>
	<button onclick="javascript:location.reload()">Reload</button>

	<h2>Results:</h2>
	Draws: <span id="empates">0</span> <br>
	Wins Player 1: <span id="ganadosJ1">0</span> <br>
	Wins PLayer 2: <span id="ganadosJ2">0</span> <br>
</body>
</html>