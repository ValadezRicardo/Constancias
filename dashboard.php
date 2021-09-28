<?php
include_once 'database.php';
session_start();
if (!(isset($_SESSION['email']))) {
    header("location:admin.php");
} else {
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    include_once 'database.php';
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | Constancias</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.min.css" />
    <link rel="stylesheet" href="css/welcome.css">
    <link rel="stylesheet" href="css/font.css">
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
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
        <link rel="stylesheet" href="css/jquery.dataTables.min.css"/>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/Spanish.json"></script>
    <script>
    $.extend( true, $.fn.dataTable.defaults, {
    "language":{
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        }
        } );   
    </script>
</head>

<body>
<div clas="panel" style="
    width: 95%;
    margin-left: 2.5%;
    margin-top: 22px;
">

<header>
    <div class="titulo">
    <a href="https://fester-distribuidores.com/constancias/" target="_self"><img src="image/fester.png" alt="Fester México" width="200"></a>
    </div>
</header>
    <!-- <div class="col-md-12" style="margin-top:10px;"><img style="width: 100%; height: 60px; " src="./image/header.jpg"><div> -->
    <nav class="navbar navbar-default title1" style="margin-bottom:0;border-color: #004380;background: #004380;">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Navegación</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="Javascript:void(0)"><b>  </b></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li><a style="color: white;" href="dashboard.php?q=1">WEBINARS</a></li>
                    <!-- <li <?php if (@$_GET['q'] == 0) echo 'class="active"'; ?>><a href="dashboard.php?q=0">Inicio<span class="sr-only">(current)</span></a></li> -->
                    <!-- <li <?php if (@$_GET['q'] == 1) echo 'class="active"'; ?>><a href="dashboard.php?q=1">LOG</a></li> -->
                    <!-- <li <?php if (@$_GET['q'] == 2) echo 'class="active"'; ?>><a href="dashboard.php?q=2">Resultados</a></li> -->
                    <!-- <li class="dropdown <?php if (@$_GET['q'] == 4 || @$_GET['q'] == 5) echo 'active"'; ?>"> -->
                    <!-- <li><a href="dashboard.php?q=4">Agregar Trivia</a></li> -->
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li  <?php echo ''; ?>> <a style="color: white;" href="logout1.php?q=dashboard.php">Salir&nbsp;<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12 panel" style="margin-top:0;">
                <?php 
                if (@$_GET['q'] == 1) {
                    $q = mysqli_query($con, "SELECT * FROM webinar") or die('Error223');
                    echo  '<div class="txtResultado col-md-12">
                    <label style="color: #004380; font-size: 30px; ">
                    WEBINARS </label>
                    </div>
                    <div class="btnDescargar col-md-12"><input type="button" class="btn btn-primary" name="descargar" id="descargar" value="Agregar Webinar" onclick="openModal()"></div>
                    <div class="col-md-12"><hr style="border-top: 2px solid gray;"/></div>
                    <div class="btnDescargar col-md-12">
                    <label style="font-size:13px">Listado de Webinars</label>
                    <input type="button" style="float:right;" class="btn btn-default" name="descargar" id="descargar" value="Descargar CSV" onclick="exportTableToCSV(' . "'Webinars.csv'" . ')"></div>
                   <div class="title col-md-12" style="margin-top:10px;"><div class="table-responsive">
                    <table class="table table-striped title1" >
                    <thead><tr style="color:black; font-size:13px;">
                    <td><center><b>Nombre</b></center></td>
                    <td><center><b>Fecha</b></center></td>
                    <td><center><b>Ponente</b></center></td>
                    <td><center><b>Acciones</b></center></td>
                    </tr></thead>';
                    $c = 0;
                    echo '<tbody>';
                    while ($row = mysqli_fetch_array($q)) {
                        $newDate = date("d-m-Y", strtotime($row["fecha"] ));
                        echo '<tr>
                        <td style="font-size:13px"><center><b>' . $row["nombre"] . '</b></center></td>
                        <td style="font-size:13px"><center>' . $newDate  . '</center></td>
                        <td style="font-size:13px"><center>' . $row["ponente"]  . '</center></td>
                        <td class="accion"><center><b>
                        <span
                        onclick="DeleteandRedirect(' . "'" . '/constancias/update.php?q=deltva&id=' . $row["id"] . "'" . ')"
                         class="pull-right btn sub1" style="margin:0px;background:red;color:white; margin-left: 6px;"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></span>
                        <span onclick="window.location=' . "'" . '/constancias/dashboard.php?q=2&title='. $row["nombre"] .'&id=' . $row["id"] .  "'" . '"   class="pull-right btn btn-primary sub1" style="margin:0px;color:white;margin-left: 6px;"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></center>
                        <span  onclick="openModal(' . $row["id"] .','."'" . $row["nombre"] ."'".','."'" . $row["fecha"] ."'".','."'". $row["ponente"] ."'".','."'". $row["duracion"] ."'".')" 
                         class="pull-right btn btn-primary sub1" style="margin:0px;color:white; margin-left: 6px;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></span>
                         </td></tr>';
                            
                    }
                    echo '</tbody>';
                    echo '</table></div></div>';
                }
                ?>
                <?php
                if (@$_GET['q'] == 2) {
                    $id=$_GET['id'];
                    $title=$_GET['title'];
                    $result = mysqli_query($con, "SELECT * FROM participantes WHERE webinar_id=$id") or die('Error');
                    echo  '
                    <div class="col-md-12">
                    <label style="color: #004380; font-size: 30px;">'.$title.'</label>
                    </div>
                    <div class="btnDescargar col-md-12">
                    <label>Listado de Constancias</label>
                    <input type="button" style="float:right;" class="btn btn-default" name="descargar" id="descargar" value="Descargar CSV" onclick="exportTableToCSV(' . "'Participantes.csv'" . ')"></div>
                    <div class="col-md-12" style="margin-top:10px"><div class="table-responsive"><table class="table table-striped title1"><thead style="font-size:13px">
                    <tr>
                    <th><center><b>Nombre</b></center></th>
                    <th><center><b>Correo</b></center></th>
                   </tr></thead><tbody style="font-size:13px">';
                    $c = 1;
                    while ($row = mysqli_fetch_array($result)) {

                        echo '<tr><td><center>' . $row['nombre'] . '</center></td>
                        <td><center>' . $row['email'] . '</center></td>
                        </tr>';
                    }
                    $c = 0;
                    echo '</tbody></table></div></div>';
                }
                ?>
                <?php
                if (@$_GET['q'] == 4 && !(@$_GET['step'])) {
                    echo '
                    <div class="col-md-12">
                    <label style="color: blue; font-size: 30px;">'.$title.'</label>
                    </div>
                    <div class="row"><span class="title1" style="margin-left:40%;font-size:30px;color:#fff;"><b>Agregar Trivias</b></span><br /><br />
                        <div class="col-md-3"></div><div class="col-md-6">   
                        <form class="form-horizontal title1" name="form" action="update.php?q=addquiz"  method="POST" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="name"></label>  
                                    <div class="col-md-12">
                                        <input id="name" name="name" placeholder="Titulo del Webinar" class="form-control input-md" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="imagen"></label>  
                                    <div class="col-md-12">                                       
                                        <input type="file"  name="imagen" id="imagen" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="fecha"></label>  
                                    <div class="col-md-12">                                       
                                        <input id="fecha" name="fecha" class="form-control input-md" type="date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="wrong"></label>  
                                    <div class="col-md-12">
                                        <input id="time" name="time" placeholder="Tiempo máximo" class="form-control input-md" min="0" type="number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="right"></label>  
                                    <div class="col-md-12">
                                        <input id="right" name="right" placeholder="Puntaje de respuesta correcta" class="form-control input-md" min="0" type="number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="wrong"></label>  
                                    <div class="col-md-12">
                                        <input id="wrong" name="wrong" placeholder="Puntaje por respuesta incorrecta" class="form-control input-md" min="0" type="number">
                                    </div>
                                </div>   
                                
       
                                <div class="form-group">
                                <label class="col-md-12 control-label" for="total"></label>  
                                <div class="col-md-12">
                                    <input id="ponente" name="ponente" placeholder="Ponente" class="form-control input-md" type="text">
                                </div>
                             </div>

                                
                                <div class="form-group">
                                    <label class="col-md-12 control-label" for=""></label>
                                    <div class="col-md-12"> 
                                        <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Crear" class="btn btn-primary"/>
                                    </div>
                                </div>

                            </fieldset>
                        </form></div>';
                }
                ?>

                <?php
                if (@$_GET['q'] == 4 && (@$_GET['step']) == 2) {

                    echo ' 
                        <span class="title1" style="margin-left:32%;font-size:30px; color: white;"><b>Selecciona el tipo de pregunta</b></span><br /><br />
                        <div class="col-md-3"></div><div class="col-md-6">
                        <form class="form-horizontal title1" name="form" action="update.php?q=addqns&ch=4 "  method="POST"  enctype="multipart/form-data">
                         <input style="margin-left:32%; color: white;" type="radio" id="multiple" name="preguntatipo_id" value="1">
                        <label for="multiple" style="color: white;">Opción multiple</label><br>
                        <input style="margin-left:32%; color: white;" type="radio" id="sino" name="preguntatipo_id" value="3">
                        <label for="sino" style="color: white;">Si/No</label><br>
                        <input style="margin-left:32%;" type="radio" id="abierta" name="preguntatipo_id" value="2">
                        <label for="abierta" style="color: white;">Pregunta abierta</label><br /><br />
                        <input class="hide" name="id" value="' . $_GET['id'] . '"/>
                        <input class="hide" name="dest" value="' . $_GET['id'] . '"/>
                        <input class="hide" name="oqn2" value=""/>
                        <input class="hide" name="preguntatipo_id2" value=""/>
                        <fieldset>
                        ';
                }
                echo '<script>
                $(' . "'" . 'input[type="radio"][name="preguntatipo_id"]' . "'" . ').change(function() {
                    appendPregunta($(this).val());
                });
                </script>';
                ?>
                <?php
                    if (@$_GET['q'] == 'addwebinar') {
                        $id = $_POST['id'];
                        $nombre = $_POST['nombre'];
                        $fecha = $_POST['fecha'];
                        $ponente = $_POST['ponente'];
                        $_SESSION["id"]=$_POST['id'];
                        $duracion = $_POST['duracion'];
                        
                        IF($_FILES["imagen"]["size"]>0){
                            $image = $_FILES['imagen']['tmp_name'];
                            $imgContenido = addslashes(file_get_contents($image));
                         
                        }
                        if($id==null || $id=""){
                            $q3=mysqli_query($con,"INSERT INTO webinar(nombre,imagen,fecha,ponente,duracion) 
                            VALUES(
                              '$nombre',
                              '$imgContenido',
                              '$fecha',
                              '$ponente',
                              '$duracion'
                            )");
                            $q3=mysqli_query($con,"SELECT IFNULL(MAX(id),1) as id FROM webinar");
                            $idq=0;
    
                            while($row=mysqli_fetch_array($q3))
                            {
                             $idq=$row["id"];
                             $_SESSION["id"]=$idq;
                            }
                        }
                        else{
                            $imgContenido="";
                            IF($_FILES["imagen"]["size"]>0){
                                $image = $_FILES['imagen']['tmp_name'];
                                $imgContenido = addslashes(file_get_contents($image));
                             
                            } 
                            $id=$_SESSION["id"];
                            $q=mysqli_query($con,"UPDATE webinar SET nombre='$nombre' ,fecha='$fecha',imagen='$imgContenido',ponente='$ponente' ,duracion='$duracion' WHERE id= '$id'")or die('Error666');
                        }

                        IF($_FILES["csv"]["size"]>0){
                            $file = $_FILES['csv']['tmp_name'];
                            $csv = array_map('str_getcsv', file($file));
                            print_r($csv);
                            array_walk($csv, function(&$a) use ($csv) {
                            $a = array_combine($csv[0], $a);
                            });

                            array_shift($csv);
                            $max = count($csv);
                            $id= $_SESSION["id"];
                            $q=mysqli_query($con,"DELETE FROM `participantes` WHERE webinar_id='$id'" )or die('Error184');
                            for($i=0;$i<$max;$i++){

                                if(ISSET($csv[$i]["Nombre"])){
                                    $nombre=utf8_encode ($csv[$i]["Nombre"]);
                                }
                                else{
                                    $nombre='';
                                }

                                echo $nombre;
                                if(ISSET($csv[$i]["Correo"])){
                                    $email=$csv[$i]["Correo"];
                                }
                                else{
                                    $email='';
                                }
                                

                                if(ISSET($csv[$i]["Fecha"])){
                                    $fecha=$csv[$i]["Fecha"];
                                    $date = DateTime::createFromFormat('d/m/Y', $fecha);
                                    $formatfecha= $date->format('Y-m-d');
    
                                }
                                else{
                                    $formatfecha='';
                                }
                                
                                $webinar_id=$id;
                               
                                if($email!=""){
                                    $q3=mysqli_query($con,"INSERT INTO participantes(nombre,email,fecha,webinar_id) 
                                    VALUES(
                                      '$nombre',
                                      '$email',
                                      '$formatfecha',
                                      '$webinar_id'
                                    )");
                                }
                              
                            }

                        }
                        echo '<script>(function(){window.location="/constancias/dashboard.php?q=1";})()</script>';
            
                    }
                      
                ?>
                <?php
                if (@$_GET['q'] == 5) {
                    $result = mysqli_query($con, "SELECT *  FROM webinar ORDER BY  id DESC") or die('Error');
                    echo  '<div class="txtTrivias"><label style="color: white; font-size: 30px; position: absolute; left:0; margin-top:-7px;">Trivias</label></div><div class="btnDescargar"><input type="button" style="position: absolute; right:0; margin-top:-7px;" class="btn btn-primary" name="descargar" id="descargar" value="Descargar CSV" onclick="exportTableToCSV(' . "'Trivias.csv'" . ')"></div><div class="panel">
                    <div class="table-responsive"><table class="table table-striped title1">
                        <thead><tr><td><center><b>#</b></center></td><td><center><b>Trivia</b></center></td><td><center><b>Total de preguntas</b></center></td><td><center><b>Puntaje</b></center></td><td><center><b># de veces contestada</b></center></td><td class="accion"><center><b>Acciones</b></center></td></tr></thead>';
                    $c = 1;
                    echo '<tbody>';
                    while ($row = mysqli_fetch_array($result)) {
                        $qtotalpreguntas = mysqli_query($con, "SELECT count(*) count  FROM pregunta WHERE encuesta_id=" . $row["id"]) or die('Error');
                        $qPuntuaje = mysqli_query($con, "SELECT IFNULL(SUM(puntuaje),0) puntuaje  FROM encuetaresuelta WHERE encuesta_id=" . $row["id"]) or die('Error');
                        $qNVeces = mysqli_query($con, "SELECT  count(*) count  FROM encuetaresuelta WHERE encuesta_id=" . $row["id"])  or die('Error');

                        while ($row2 = mysqli_fetch_array($qtotalpreguntas)) {
                            $totalpreguntas = $row2["count"];
                        }
                        while ($row2 = mysqli_fetch_array($qPuntuaje)) {
                            $Puntuaje = $row2["puntuaje"];
                        }
                        while ($row2 = mysqli_fetch_array($qNVeces)) {
                            $NVeces = $row2["count"];
                        }

                        echo '<tr><td><center>' . $row["id"] . '</center></td><td><center>' . $row["titulo"] . '</center></td>
                            <td><center>' . $totalpreguntas . '</center></td>
                            <td><center>' . $Puntuaje . '</center></td>
                            <td><center>' . $NVeces . '</center></td>
                            <td class="accion"><center><b>
                            <span onclick="DeleteandRedirect(' . "'" . '/trivias/update.php?q=deltva&id=' . $row["id"] . "'" . ')" class="pull-right btn sub1" style="margin:0px;background:red;color:white; margin-left: 6px;"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Eliminar</b></span></span>
                            <span onclick="window.location=' . "'" . '/trivias/dashboard.php?q=2&id=' . $row["id"] . '' .  '&title=' . $row["titulo"] . "'" . '"   class="pull-right btn btn-primary sub1" style="margin:0px;color:white"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Resultado</b></span></span></b></center></td></tr>';
                            
                    }
                    echo '</tbody>';
                    $c = 0;
                    echo '</table></div></div>';
                }
                ?>
            </div>
        </div>
    </div>
    
    
    
    <div class="modal fade" id="CreateEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <label style="color: #004380; font-size: 30px; ">
                    WEBINARS </label>
                    <br/>
                    <label>Alta y Cambio en Webinar</label>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="dashboard.php?q=addwebinar"  method="POST" enctype="multipart/form-data">  

      <input class="hide" type="text" name="id" class="form-control"/>
      <span>Nombre del Webinar:</span>
      <input type="text" name="nombre" class="form-control"/>
      <br/>

      <span>Fecha del Webinar:</span>
      <input type="date" name="fecha" class="form-control"/>
      <br/>

      <span>Duración:</span>
      <input type="number" step="any" name="duracion" class="form-control" min="1"/>
      <br/>
      
      <span>Nombre del Ponente:</span>
      <input type="text" name="ponente" class="form-control"/>
      <br/>

      <span>Flyer del Webinar:</span>
      <input type="file" name="imagen" class="form-control"/>
      <br/>

      <span>Base de datos CSV:</span>
      <input type="file" name="csv" class="form-control"/>
      <input  class="hide" id="btnsubmit" type="submit">
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="$('#btnsubmit').click()" style="background:blue;">Guardar</button>
        <button type="button" class="btn btn-danger" style="background:red;" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>






    <script src="js/Utils.js"></script>
    <script >
        $('table').DataTable();
        $("input[type='file'][name='imagen']").change(function(){
            var tamaño=this.files[0].size;
            if(tamaño>3000000){
                alert("El tamaño de la imagen supera los 3 MB");
                $("input[type='file']").val("");
            }
        })
       function openModal(id,nombre,fecha,ponente,duracion){
        if(id){
            $('[name="id"]').val(id);
            $('[name="nombre"]').val(nombre);
            $('[name="fecha"]').val(fecha);
            $('[name="ponente"]').val(ponente);
            $('[name="duracion"]').val(duracion);
        }

        $('#CreateEditModal').modal();
        
       }
    </script>
    </div>
    <footer>
		<a href="https://www.henkel.mx/privacy-statement?pageID=560414" target="_blank">AVISO DE PRIVACIDAD</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="https://www.henkel.mx/" target="_blank">HENKEL</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="https://www.fester.com.mx/es.html" target="_blank">FESTER</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Desarrollo web <a href="https://doos.com.mx/" target="_blank">DOOS CG&D</a>
    </footer>
</body>

</html>