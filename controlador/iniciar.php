<?php 
session_start();

include 'Ahorcado.class.php';

$ahorcado = new Ahorcado();
$_SESSION['ahorcado'] = $ahorcado;
$_SESSION['ahorcado']->iniciar();