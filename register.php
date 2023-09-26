<?php
include 'conexion.php';

$data = (object) $_POST;

if(isset($data->usuario) && isset($data->password) && isset($data->numero_celular) && isset($data->nit_o_cc) && isset($data->correo)){
    // Usamos $data->password porque es lo que estás enviando desde Android
    $passwordHash = password_hash($data->password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO usuarios (usuario, contrasena, numero_celular, nit_o_cc, correo) VALUES (?, ?, ?, ?, ?)");
    if($stmt->execute([$data->usuario, $passwordHash, $data->numero_celular, $data->nit_o_cc, $data->correo])){
        echo json_encode(["message" => "Usuario registrado con éxito."]);
    } else {
        echo json_encode(["message" => "Error al registrar usuario."]);
    }
} else {
    echo json_encode(["message" => "Datos incompletos."]);
}
?>
