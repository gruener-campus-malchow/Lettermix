<?php
session_start();
if($_SESSION['difficulty'] != 'Leicht' && $_SESSION['difficulty'] != 'Schwer'){
	$_SESSION['difficulty'] = 'Leicht';
}elseif(isset($_GET['difficulty'])){
	$_SESSION['difficulty'] = $_GET['difficulty'];
}
// The normal alphabet is located in normalAlphabet.php
include('normalAlphabet.php');
// The sentences are located at sentences.php
include('sentences.php');
// The comparing of shuffled alphabet and sentences as well as the shuffled alphabet is located at compare.php
include('compare.php');
header('Location: test.php');
?>