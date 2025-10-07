<?php 
session_start();
if(!isset($_SESSION['user'])) {
    header("Location: ../login.html");
    exit();
}

require_once '../includes/require.php';
require_once '../includes/db.php';

$profile = $db->getUser($_SESSION['user']);

$favCoins = $db->getFavCoins($_SESSION['user']);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crypto Trading App</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap">
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="manifest" href="config/manifiest.json">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>    
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <style>
        .screen {
            background: #f5f5f5;
            position: relative;
        }
        .balance-bg {
            background: linear-gradient(135deg, #4a4a4a 0%, #2a2a2a 100%);
        }
    </style>
        <script src="https://cdn.tailwindcss.com"></script>
</head>
