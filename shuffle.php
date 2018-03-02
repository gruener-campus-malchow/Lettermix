<?php
session_start();
$shuffledAlphabet = $normalAlphabet;
shuffle($shuffledAlphabet);
$_SESSION['shuffledAlphabet'] = $shuffledAlphabet;
?>