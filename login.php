<?php
include 'conexion.php';
header("Access-Control-Allow-Origin: *");


$data = (object) $_POST;

if(isset($data->correo) && isset($data->contrasena)){
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE correo = ?");

    $stmt->execute([$data->correo]);
    $user = $stmt->fetch();

    if($user && password_verify($data->contrasena, $user['contrasena'])){
        echo json_encode(["message" => "Inicio de sesión exitoso.", "user" => $user]);
    } else {
        echo json_encode(["message" => "Usuario o contraseña incorrectos."]);
    }
} else {
    echo json_encode(["message" => "Datos incompletos."]);
}
?>
