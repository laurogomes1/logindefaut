<?php
session_start();
require_once '../../layout/common.php';
require_once '../../data.php';

// Verifica se o usuário está logado
checkAuth();

$user = $_SESSION['user'];

// Verifica se é administrador
if ($user['role'] !== 'admin') {
    header('Location: ../dashboard/');
    exit;
}

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Aqui você pode adicionar lógica para salvar configurações
    $success = true;
}

$pageContent = '<div class="bg-white shadow rounded-lg p-6">
    <h1 class="text-2xl font-semibold text-gray-900 mb-6">Configurações do Sistema</h1>';
    
if ($success) {
    $pageContent .= '<div class="mb-4 p-3 bg-green-100 text-green-800 rounded">Configurações atualizadas com sucesso!</div>';
}
if ($error) {
    $pageContent .= '<div class="mb-4 p-3 bg-red-100 text-red-800 rounded">' . htmlspecialchars($error) . '</div>';
}

$pageContent .= '<div class="space-y-6">
    <div class="bg-blue-50 rounded-lg p-4">
        <h2 class="text-lg font-semibold text-blue-900 mb-2">Informações do Sistema</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div>
                <span class="font-medium text-blue-800">Versão do PHP:</span>
                <span class="text-blue-600">' . phpversion() . '</span>
            </div>
            <div>
                <span class="font-medium text-blue-800">Servidor:</span>
                <span class="text-blue-600">' . $_SERVER['SERVER_SOFTWARE'] . '</span>
            </div>
            <div>
                <span class="font-medium text-blue-800">Data/Hora:</span>
                <span class="text-blue-600">' . date('d/m/Y H:i:s') . '</span>
            </div>
            <div>
                <span class="font-medium text-blue-800">Usuário Logado:</span>
                <span class="text-blue-600">' . htmlspecialchars($user['name']) . '</span>
            </div>
        </div>
    </div>
    
    <div class="bg-yellow-50 rounded-lg p-4">
        <h2 class="text-lg font-semibold text-yellow-900 mb-2">Módulos Disponíveis</h2>
        <ul class="space-y-2 text-sm">
            <li class="flex items-center">
                <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                <span class="text-yellow-800">Dashboard</span>
            </li>
            <li class="flex items-center">
                <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                <span class="text-yellow-800">Usuários</span>
            </li>
            <li class="flex items-center">
                <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                <span class="text-yellow-800">Configurações</span>
            </li>
        </ul>
    </div>
    
    <div class="bg-green-50 rounded-lg p-4">
        <h2 class="text-lg font-semibold text-green-900 mb-2">Status do Sistema</h2>
        <div class="space-y-2 text-sm">
            <div class="flex items-center">
                <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                <span class="text-green-800">Sistema operacional</span>
            </div>
            <div class="flex items-center">
                <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                <span class="text-green-800">Autenticação funcionando</span>
            </div>
            <div class="flex items-center">
                <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                <span class="text-green-800">Banco de dados conectado</span>
            </div>
        </div>
    </div>
</div>';

$pageContent .= '</div>';

echo renderHeader('Configurações');
echo renderPageStructure($user, $pageContent);
echo renderFooter();
?> 