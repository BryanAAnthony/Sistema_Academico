<?php
include "../include/conexion.php";
include "../include/busquedas.php";
$dni = $_POST['dni'];
$apellidos_nombres = $_POST['apellidos_nombres'];
$fecha_nac = $_POST['fecha_nac'];
$direccion = $_POST['direccion'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$id_genero = $_POST['id_genero'];
$nivel_educacion = $_POST['nivel_educacion'];
$cond_laboral = $_POST['cond_laboral'];
$id_cargo = $_POST['id_cargo'];

$b_docente = buscarEstudianteByDni($conexion, $dni);
$c_r_b_docente = mysqli_num_rows($b_docente);
if ($c_r_b_docente == 0) {//validamos que no haya registros en la base de datos
	$insertar = "INSERT INTO docente (dni, apellidos_nombres,fecha_nac, direccion, correo, telefono, id_genero, nivel_educacion, cond_laboral, id_cargo) VALUES ('$dni', '$apellidos_nombres', '$fecha_nac', '$direccion', '$correo', $telefono, '$id_genero', '$nivel_educacion', '$cond_laboral', '$id_cargo')";
	$ejecutar_insetar = mysqli_query($conexion, $insertar);
	// registrar usuario
	$b_id_docente = buscarEstudianteByDni($conexion, $dni);
	$res_b_docente = mysqli_fetch_array($b_id_docente);
	$id_estudiante = $res_b_docente['id'];
	$pass = "@".$dni."#2022";
	$password_fuerte = password_hash($pass, PASSWORD_DEFAULT);

	$insertar_usu = "INSERT INTO usuarios_estudiante (id_estudiante, usuario, password) VALUES ('$id_estudiante', '$dni', '$password_fuerte')";
	$ejec_insert_usu = mysqli_query($conexion, $insertar_usu);
	if ($ejec_insert_usu) {
		echo "<script>
                alert('Registro Exitoso');
                window.location= '../estudiante.php'
    			</script>";
	}else{
		echo "<script>
			alert('Error al registrar usuario');
			window.history.back();
			</script>
			";
	}
}else{
	echo "<script>
			alert('El estudiante ya existe, error al guardar');
			window.history.back();
			</script>
			";
}


?>