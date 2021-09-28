<?php

include("database.php");

session_start();

$mysqli = new mysqli('localhost','festerdi_constanciasusr','Constancias1234$','festerdi_constancias');


if (isset($_POST['submit'])) {



	$email = $_POST['email'];

	$email = stripslashes($email);

	$email = addslashes($email);



	$encuesta_id = $_POST['encuesta_id'];

	$encuesta_id = stripslashes($encuesta_id);

	$encuesta_id = addslashes($encuesta_id);



	$tituloencuesta = '';

	$_SESSION['email'] = $email;

	$_SESSION['encuesta_id'] = $encuesta_id;



	// }	

}



// Conexión la base de datos



?>



<!DOCTYPE html>

<html>





<head>

	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title>Registro | Constancias</title>

	<link rel="stylesheet" href="scripts/bootstrap/bootstrap.min.css">

	<link rel="stylesheet" href="scripts/ionicons/css/ionicons.min.css">

	<link rel="stylesheet" href="css/form.css">	

	<link rel="icon" type="image/png" href="favicon.png">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

	<style type="text/css">

		body {

			width: 100%;

			background: url(image/back.jpg);

			background-position: center center;

			background-repeat: no-repeat;

			background-attachment: fixed;

			background-size: cover;

		}

	</style>

		<script src="js/jquery.js"></script>



	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>


	<script>

    function demoFromHTML(nombre,curso,fecha,duracion) {



	var doc = new jsPDF('landscape')


	

	doc.addImage(imgData, 'JPEG', 0, 0, 300, 210)

		

	// doc.setFontSize(22)

	// doc.text(20, 60, 'Nombre:')

	// doc.text(20, 85, 'Curso:')

	// doc.text(20, 110, 'Correo:')



	// doc.setFontSize(18)

	// doc.text(20, 70, nombre)

	// doc.text(20, 95, curso)

	// doc.text(20, 120, email)



	// doc.addImage($('img').attr("src"), 'JPEG', 150, 40, 120, 100)



	doc.setFontSize(22)

	doc.text(nombre,150, 142, 'center')

	doc.setFontSize(20)
	doc.text(curso,150, 162,'center')

	doc.setFontSize(14)

	doc.text(82, 172, fecha)

	duracion=duracion+" horas";

	doc.text(189, 172, duracion)

	// console.log(doc.output('bloburl'));

	// window.open(doc.output('bloburl'), '_blank');

	$('#frame').attr("src",doc.output('bloburl'));

	// doc.save(curso+nombre+'.pdf');

	// window.location="/constancias/register.php";

    }

</script>

		

</head>



<body>

	<header>

		<div class="titulo">

			<a href="https://www.fester.com.mx/es.html" target="_self"><img src="image/fester.png" alt="Fester México" width="200"></a>

		</div>

	</header>

	<section class="login first grey" style="padding-top: 25px;">

		<div class="container">

			<div class="box-wrapper">

				<div class="box box-border">

					<div class="box-body">

						<?php

						if (@$_GET['step'] != 1 && @$_GET['step'] != 2) {

							echo '<center>

							<h4 style="font-family: Nunito,sans-serif;">Descargar Constancias </h4>

						</center><br>

						<form method="post" action="register.php?step=1" enctype="multipart/form-data">

							<div class="form-group">

							';



							$_SESSION["imagenes"] =[];

							$query = $mysqli->query("SELECT * FROM webinar ");

							

							$datos=[];

							while ($valores = mysqli_fetch_array($query)) {

								$data["id"]=$valores["id"];

								$data["imagen"]=$valores["imagen"];

								$data["nombre"]=$valores["nombre"];

								array_push($datos,$data);

							}



							echo '<div style="text-align:center">';

							foreach($datos as $valor){

								$hclass="";

								if($valor["imagen"]==""){

									$hclass="hide";

								}

								echo '<img  class="'.$hclass.'" style="display:none;max-width: 250px; max-height: 200px; " data-id="'.$valor["id"].'" src="data:image/png;base64,'.base64_encode($valor["imagen"]) .'"/>';



							}

							echo '</div><label style="font-family:Nunito,sans-serif; color: black; font-size: 14px;">Nombre del Webminar:</label>								

							';

							echo '<select style="font-family:Nunito,sans-serif" name="encuesta_id" id="encuesta_id" class="form-control" required>';

							foreach ($datos as $valores) {

								echo '<option value="' . $valores["id"] . '" >' . $valores["nombre"] . '</option>';

							}



					

							echo '	</select>

							</div>

						

							<div class="form-group">

								<label style="font-family:Nunito,sans-serif; color: black; font-size: 14px;">Correo Electronico:</label>

								<input type="email" name="email" class="form-control" required />

							</div>

							<div class="form-group text-right">

								<button class="btn btn-primary btn-block" name="submit">Registrar</button>

							</div>

						</form>';

						



						}



						if (@$_GET['step'] == 1) {

							echo '<style>

							.box-wrapper{

								width:100%!important;

							}

							.btn-return{

								display:block!important;

							}

							</style>';

							$email=$_SESSION["email"];



							$querycount  = $mysqli->query("SELECT count(*) count FROM participantes WHERE email='$email'");

							while ($valores = mysqli_fetch_array($querycount)) {

								if ($valores["count"] < 1) {

									echo '<script>(function(){alert("Este correo no puede descargar una constancia para este webinar");window.location="/constancias/register.php"})()</script>';

								}

							}

							$encuesta_id=$_SESSION['encuesta_id'];

							$email=$_SESSION["email"];
							// echo $encuesta_id.'alert 1'.$email;
							$query = $mysqli->query("SELECT p.nombre,p.email,p.fecha,w.imagen,w.nombre as titulo,w.duracion FROM participantes as p LEFT JOIN webinar w ON p.webinar_id=w.id WHERE webinar_id=$encuesta_id AND email='$email'");
							// echo 'alert 2';
							// echo "SELECT p.nombre,p.email,p.fecha,w.imagen,w.nombre as titulo,w.duracion FROM participantes as p LEFT JOIN webinar w ON p.webinar_id=w.id WHERE webinar_id=$encuesta_id AND email='$email'";
							// echo "Falló la creación de la tabla: (" . $mysqli->errno . ") " . $mysqli->error;
							while ($valores = mysqli_fetch_array($query)) {
								// echo 'alert 3';
								$newDate = date("d-m-Y", strtotime($valores["fecha"] ));
								// echo 'alert 4';
								

								echo '<p><strong>En unos segundos se generará tu constancia.</strong><button onclick="window.location='."'".'/constancias/register.php'."'".'" style="display:none;float:right;margin-bottom:5px; color:#fff; background-color:#337ab7; border-color:#337ab7; font-family:Nunito,sans-serif; border-radius:5px;" class="btn btn btn-primary btn-return">REGRESAR</button></p><iframe class="constancia-type" id="frame" title="PDF Preview"

								style="width:100%;height:490px;"

								></iframe><img class="hide" src="data:image/png;base64,'.base64_encode($valores["imagen"]) .'">';
								// echo 'alert 5';
								echo "<script>

								demoFromHTML('".$valores["nombre"]."','".$valores["titulo"]."','".$newDate."','".$valores["duracion"]."');

								</script>";
								// echo 'alert 6';

							}
							// echo 'alert 7';
						

						}
						// echo 'alert 8';

						?>

					</div>

				</div>

			</div>

		</div>

	</section>

	<footer>

		<a href="https://www.henkel.mx/privacy-statement?pageID=560414" target="_blank">AVISO DE PRIVACIDAD</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="https://www.henkel.mx/" target="_blank">HENKEL</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="https://www.fester.com.mx/es.html" target="_blank">FESTER</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Desarrollo web <a href="https://doos.com.mx/" target="_blank">DOOS CG&D</a>

	</footer>

	<script src="scripts/bootstrap/bootstrap.min.js"></script>
	

	<script>

	

		var display = 0;

		(function() {



			$(".display").hide();

			$(".display" + display).show();

			$(".btn-anterior").hide();

			if ($('[name^="ans"]').length > 1) {

				$(".btn-submit").hide();

			} else {

				$(".btn-siguiente").hide();

			}

			$('img[data-id="'+$('#encuesta_id').val()+'"]').show();



			$('#encuesta_id').change(function(){

				$('img[data-id]').hide();

				$('img[data-id="'+$('#encuesta_id').val()+'"]').show();

			});



		})();



		function siguientePregunta() {

			if ($("[name=ans" + display + "]").val() == "") {

				$("[type=submit]").click();

				return;

			}



			if (display + 1 < $(".display").length) {

				if (display + 1 == $(".display").length - 1) {

					$(".btn-siguiente").hide();

					$(".btn-submit").show();

				}

				$(".btn-anterior").show();

				display++;



				$(".display").hide();

				$(".display" + display).show();

				console.log(display);

			}



		}



		function preguntaanterior() {

			if (display - 1 > -1) {

				if (display == 1) {

					$(".btn-anterior").hide();

				}

				display--;

				$(".btn-submit").hide();

				$(".btn-siguiente").show();

				$(".display").hide();

				$(".display" + display).show();

				console.log(display);

			}



		}

	</script>



</body>



</html>