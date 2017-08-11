<?php session_start();

if (isset($_SESSION['user'])) {
	require 'views/index_view.php';
} else {
	header('Location: login.php');
}

?>