<form method="post" action="<?=$_SERVER["PHP_SELF"]?>">
        <input type="text" name="nombres" placeholder="Ingrese nombres"><br>
        <input type="text" name="apellidos" placeholder="Ingrese apellidos"><br>
        <input type="number" name="codigo" placeholder="Ingrese Codigo/DNI"><br>
        <input type="password" name="password" placeholder="Ingrese Contraseña"><br>
        <select name="tipo" class="form-control mb-2">
            <option value="estudiante">Estudiante</option>
            <option value="profesor">Profesor</option>
            <option value="administrador">Administrador</option>
        </select><br>
        <input type="submit" class="btn btn-primary" name="submit" value="Guardar">

</form>
<?php
if(!empty($_POST)) {
    $nombres = $_POST["nombres"];
    $apellidos = $_POST["apellidos"];
    $codigo = (int)$_POST["codigo"];
    $password = $_POST["password"];
    $tipo = $_POST["tipo"];

    $ch = curl_init();
    $dataPost = array(
        "nombres"=>$nombres,
        "apellidos"=>$apellidos,
        "codigo"=>$codigo,
        "password"=>$password,
        "tipo"=>$tipo,
    );
    curl_setopt($ch, CURLOPT_URL, "http:/localhost:8080/mvc/index.php?api/estudiantes");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataPost);
    $response = curl_exec($ch);
    curl_close($ch);

    $respuesta = json_decode($response, true);
    if($respuesta["codigo"]=="200"){
        echo "Guardado en servidor ajeno";
    }
}