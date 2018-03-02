<?php
session_start();
if($_SESSION['difficulty'] == 'Leicht'){
	$sentences = array('Die Division ist eine der vier Grundrechenarten der Arithmetik', 'Die Addition ist eine der vier Grundrechenarten der Arithmetik', 'Die Subtraktion ist eine der vier Grundrechenarten der Arithmetik', 'Die Multiplikation ist eine der vier Grundrechenarten der Arithmetik', 'Mathe macht Spass', 'Mathe ist mehr als Rechnen', 'Beim Konstruieren darf man nur Zirkel Lineal und Bleistift verwenden', 'Kennst du das Gluecksgefuehl wenn du eine schwere Aufgabe geschafft hast', 'Manche Gleichungen haben keine Loesung', 'Zwei Geraden in der Ebene schneiden sich oder sind parallel zueinander', 'Kennst du den Kaenguruwettbewerb');
}else{
	$sentences = array('Die Stochastik ist ein Teilgebiet der Mathematik und fasst als Oberbegriff die Gebiete Wahrscheinlichkeitstheorie und Statistik zusammen', 'Die Trigonometrie ist ein Teilgebiet der Geometrie und somit der Mathematik', 'Der Satz des Pythagoras ist einer der fundamentalen Saetze der euklidischen Geometrie', 'Die binomischen Formeln sind in der elementaren Algebra verbreitete Formeln zum Umformen von Produkten aus Binomen',  'In der Mathematik versteht man unter Wurzelziehen oder Radizieren die Gegenoperation zum Potenzieren', 'Eine Primzahl ist eine natuerliche Zahl die groesser als 1 und ausschliesslich durch sich selbst und durch 1 teilbar ist', 'Mit dem geometrischen Begriff Symmetrie bezeichnet man die Eigenschaft dass ein geometrisches Objekt durch Bewegungen auf sich selbst abgebildet werden kann', 'Eine Variable ist ein Name fuer eine Leerstelle in einem logischen oder mathematischen Ausdruck');
}
$theSentenceId = array_rand($sentences, 1);
$theSentence = $sentences[$theSentenceId];
$theSentenceArray = str_split($theSentence);
$convertedSentenceArray = array_map('strtolower',$theSentenceArray);
$_SESSION['convertedSentenceArray'] = $convertedSentenceArray;
?>