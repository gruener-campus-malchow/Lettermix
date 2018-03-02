<?php
session_start();
if($_SESSION['newSentenceArray'][$_POST['number']] == $_POST['letter']){
	include('normalAlphabet.php');
	$theId = array_search($_POST['letter'], array_column($normalAlphabet, 1));
	$theLetter = $_SESSION['shuffledAlphabet'][$theId][1];
	if($theLetter == $_POST['value']){
		echo 1;
	}else{
		echo 0;
	}
}else{
	echo 0;
}