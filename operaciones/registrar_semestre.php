<?php
include "../include/conexion.php";
include "../include/busquedas.php";
$id = $_POST['id'];
$descripcion = $_POST['descripcion'];


$b_semestre = buscarSemestreByDni($conexion, $dni);
$c_r_b_semestre = mysqli_num_rows($b_semestre);
if ($c_r_b_semestre == 0) {//validamos que no haya registros en la base de datos
	$insertar = "INSERT INTO semestre (id, descripcion) VALUES ('$id','descripcion')";
	$ejecutar_insetar = mysqli_query($conexion, $insertar);
	// registrar usuario
	$b_id_semestre = buscarSemestreByDni($conexion, $dni);
	$res_b_semestre = mysqli_fetch_array($b_id_semestre);
	$id_estudiante = $res_b_semestre['id'];
	$pass = "@".$dni."#2022";
	$password_fuerte = password_hash($pass, PASSWORD_DEFAULT);

	$insertar_usu = "INSERT INTO usuarios_semestre(id_semestre, usuario, password) VALUES ('$id_semestre')";
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