<?php
function cleanInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$errors = [];
$name = $cellphone = $email = $carModel = $licensePlate = $date = $time = $service = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["customerName"])) {
        $errors[] = "El campo nombre es requeriedo";
    } else {
        $name = cleanInput($_POST["customerName"]);
        if (strlen($name) < 3 || strlen($name) > 50) {
            $errors[] = "El campo nombre debe tener entre 3 y 50 carácteres.";
        }
    }

    if (empty($_POST["cellphone"])) {
        $errors[] = "El campo celular es requerido.";
    } else {
        $cellphone = cleanInput($_POST["cellphone"]);
        if (!preg_match("/^[0-9]{10}$/", $cellphone)) {
            $errors[] = "El campo celular debe tener 10 dígitos.";
        }
    }

    if (empty($_POST["email"])) {
        $errors[] = "El campo correo es requerido.";
    } else {
        $email = cleanInput($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "El campo correo tiene un formato inválido.";
        }
    }

    if (empty($_POST["carModel"])) {
        $errors[] = "El campo modelo del vehículo es requerido.";
    } else {
        $carModel = cleanInput($_POST["carModel"]);
    }

    if (empty($_POST["licensePlate"])) {
        $errors[] = "La placa del vehículo es requerida.";
    } else {
        $licensePlate = strtoupper(cleanInput($_POST["licensePlate"]));
        if (!preg_match("/^[A-Z0-9]{6}$/", $licensePlate)) {
            $errors[] = "La placa del vehículo debe tener 6 carácteres.";
        }
    }

    if (empty($_POST["date"])) {
        $errors[] = "El campo fecha es requerido.";
    } else {
        $date = cleanInput($_POST["date"]);
        if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $date)) {
            $errors[] = "La fecha tiene un formato inválido..";
        }
    }

    if (empty($_POST["time"])) {
        $errors[] = "El campo hora es requerido.";
    } else {
        $time = cleanInput($_POST["time"]);
        if (!preg_match("/^(0[8-9]|1[0-7]):00$/", $time)) {
            $errors[] = "La hora debe estar entre las  08:00 y 17:00.";
        }
    }

    if (empty($_POST["service"])) {
        $errors[] = "El campo servicio es requerido.";
    } else {
        $service = cleanInput($_POST["service"]);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cita confirmada | Taller de autos Multimarca</title>
    <link rel="stylesheet" href="../client/style.css">
</head>
<body>
    <div class="container">
        <?php if (!empty($errors)): ?>
            <h1 class="error-title">Ocurrieron algunos errores mientras agendábamos tu cita, por favor revisa:</h1>
            <?php foreach ($errors as $error): ?>
                <p class="error-message"><?= $error ?></p>
            <?php endforeach; ?>
            <a href="../client">Volver al agendamiento</a>
        <?php else: ?>
            <h1 class="success-title">Cita agendada éxitosamente!</h1>
            <p><strong>Nombre:</strong> <?= $name ?></p>
            <p><strong>Celular:</strong> <?= $cellphone ?></p>
            <p><strong>Email:</strong> <?= $email ?></p>
            <p><strong>Modelo del auto:</strong> <?= $carModel ?></p>
            <p><strong>Placa:</strong> <?= $licensePlate ?></p>
            <p><strong>Fecha de la cita:</strong> <?= $date ?></p>
            <p><strong>Hora de la cita:</strong> <?= $time ?></p>
            <p><strong>Servicio:</strong> <?= $service ?></p>
            <a href="../client">Agenda otra cita</a>
        <?php endif; ?>
    </div>
</body>
</html>
