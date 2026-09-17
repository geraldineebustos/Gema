<?php

namespace App\Controllers;

use App\Database;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthController
{
  
    public function showRegister(Request $request, Response $response): Response
    {
        ob_start();
        $error = $_SESSION['error'] ?? null;
        unset($_SESSION['error']);
        require __DIR__ . '/../../views/auth/register.php';
        $html = ob_get_clean();

        $response->getBody()->write($html);
        return $response;
    }

    /
    public function register(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        $name     = trim($data['name'] ?? '');
        $email    = trim($data['email'] ?? '');
        $password = $data['password'] ?? '';

        if ($name === '' || $email === '' || $password === '') {
            $_SESSION['error'] = 'Todos los campos son obligatorios.';
            return $response->withHeader('Location', '/auth/register')->withStatus(302);
        }

        $pdo = Database::get();

  
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $_SESSION['error'] = 'Ese email ya está registrado.';
            return $response->withHeader('Location', '/auth/register')->withStatus(302);
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
        $stmt->execute([$name, $email, $hashedPassword]);

     
        return $response->withHeader('Location', '/auth/login')->withStatus(302);
    }


    public function showLogin(Request $request, Response $response): Response
    {
        ob_start();
        $error = $_SESSION['error'] ?? null;
        unset($_SESSION['error']);
        require __DIR__ . '/../../views/auth/login.php';
        $html = ob_get_clean();

        $response->getBody()->write($html);
        return $response;
    }

    public function login(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        $email    = trim($data['email'] ?? '');
        $password = $data['password'] ?? '';

        $pdo = Database::get();
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$user || !password_verify($password, $user['password'])) {
            $_SESSION['error'] = 'Email o contraseña incorrectos.';
            return $response->withHeader('Location', '/auth/login')->withStatus(302);
        }

      
        session_regenerate_id(true);
        $_SESSION['user_id']   = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        return $response->withHeader('Location', '/')->withStatus(302);
    }

    public function logout(Request $request, Response $response): Response
    {
        $_SESSION = [];
        session_destroy();

        return $response->withHeader('Location', '/auth/login')->withStatus(302);
    }
}
