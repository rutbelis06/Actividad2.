<?php
require_once "app/models/UsuarioModel.php";

class AuthController {
    private $model;

    public function __construct() {
        $this->model = new UsuarioModel();
    }

public function showLogin() {
    $errors = [];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $this->cleanData($_POST["email"] ?? "");
        $password = $_POST["password"] ?? "";

        // Buscamos al usuario por correo
        $usuario = $this->model->obtenerPorEmail($email);

        if ($usuario && password_verify($password, $usuario['password'])) {
            session_start();
            $_current_user_name = $usuario['nombre']; // Guardamos el nombre
            
            header("Location: " . URL_BASE . "index.php?action=dashboard&user=" . urlencode($_current_user_name));
            exit();
        } else {
            $errors[] = "Correo o contraseña incorrectos.";
        }
    }
    require_once "app/views/login.php";
}

    public function showRegister() {
        $errors = [];
        $name = $lastname = $cedula = $direction = $phone = $email = $password = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name      = $this->cleanData($_POST["name"] ?? "");
            $lastname  = $this->cleanData($_POST["lastname"] ?? "");
            $cedula    = $this->cleanData($_POST["cedula"] ?? "");
            $direction = $this->cleanData($_POST["direction"] ?? "");
            $phone     = $this->cleanData($_POST["phone"] ?? "");
            $email     = $this->cleanData($_POST["email"] ?? "");
            $password  = $_POST["password"] ?? ""; 

            // VALIDACIONES

            if (!preg_match('/^[\p{L}\s]+$/u', $name)) $errors[] = "El nombre solo permite letras.";
            if (!preg_match('/^[\p{L}\s]+$/u', $lastname)) $errors[] = "El apellido solo permite letras.";

            if (!preg_match('/^[VE]\d{5,9}$/', $cedula)) {
                $errors[] = "Cédula inválida. Debe iniciar con V o E en mayúscula seguida de 5 a 9 dígitos.";
            }

            $dirLen = strlen($direction);
            if ($dirLen < 4 || $dirLen > 270) {
                $errors[] = "La dirección debe tener entre 4 y 270 caracteres.";
            }
            if (preg_match('/[^a-zA-Z0-9\s,;°#\-\/]/u', $direction)) {
                $errors[] = "La dirección contiene símbolos no permitidos. Solo se permite: , ; ° # - /";
            }
            if (preg_match('/\.[a-z]{2,}/i', $direction)) {
                $errors[] = "La dirección no puede contener formatos de dominio (ej. .com).";
            }

            if (!preg_match('/^\+\d{1,3}\d{9}$/', $phone)) {
                $errors[] = "Teléfono inválido. Use formato internacional: + (código país) seguido de 9 dígitos.";
            }

            if (!preg_match('/^[a-zA-Z0-9._%+-]+@(gmail|hotmail|outlook|yahoo)\.com$/i', $email)) {
                $errors[] = "Correo inválido. Solo se aceptan dominios @gmail.com, @hotmail.com, @outlook.com o @yahoo.com y sin acentos.";
            }


            if (strlen($password) < 8) {
                $errors[] = "La contraseña debe tener al menos 8 caracteres.";
            }
            if (preg_match_all('/[a-zA-Z]/', $password) < 3) {
                $errors[] = "La contraseña debe incluir al menos tres letras.";
            }
            if (preg_match_all('/[0-9]/', $password) < 2) {
                $errors[] = "La contraseña debe incluir al menos dos números.";
            }
            if (!preg_match('/[^a-zA-Z0-9\s]/', $password)) {
                $errors[] = "La contraseña debe incluir al menos un símbolo.";
            }
            // Restricción de Inicio/Fin
            if (preg_match('/^[^a-zA-Z0-9\s]/', $password)) {
                $errors[] = "La contraseña no puede iniciar con un símbolo.";
            }
            if (preg_match('/[a-zA-Z]$/', $password)) {
                $errors[] = "La contraseña no puede terminar con una letra.";
            }

            if (empty($errors)) {
                $datos = [
                    'name' => $name,
                    'lastname' => $lastname,
                    'cedula' => $cedula,
                    'direction' => $direction,
                    'phone' => $phone,
                    'email' => $email,
                    'password' => $password
                ];

                $registro = $this->model->registrar($datos);

                if ($registro === true) {
                    header("Location: " . URL_BASE . "index.php?action=login&success=1");
                    exit();
                } else {
                    $errors[] = "Error al procesar el registro. Es posible que el correo o documento ya existan.";
                }
            }
        }

        require_once "app/views/register.php";
    }

    private function cleanData($data) {
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }
}