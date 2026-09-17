<?php
use App\Controllers\AuthController;

$app->get('/auth/register', [AuthController::class, 'showRegister']);
$app->post('/auth/register', [AuthController::class, 'register']);

$app->get('/auth/login', [AuthController::class, 'showLogin']);
$app->post('/auth/login', [AuthController::class, 'login']);

$app->post('/auth/logout', [AuthController::class, 'logout']);
