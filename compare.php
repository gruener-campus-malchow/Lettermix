<?php
session_start();
// The shuffled alphabet is located at shuffle.php
include('shuffle.php');
$newSentenceArray = array();
foreach($convertedSentenceArray as $letter){
	if($letter == ' '){
		array_push($newSentenceArray, ' ');
	}else{
		$theId = array_search($letter, array_column($shuffledAlphabet, 1));
		array_push($newSentenceArray, $normalAlphabet[$theId][1]);
	}
}
$_SESSION['newSentenceArray'] = $newSentenceArray;
?>