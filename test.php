<?php
session_start();
?>
<!doctype html>
<html>
	<head>
		
		<title>Code-Knacken</title>
		
		<style>
			.letter {
				float: left;
				margin-right: 5px;
			}
			.letter, .letter div {
				width: 50px;
			}
			.letterDone {
				font-size: 43.5px;
				padding: 0 10px;
				width: 30px!important;
			}
			.letter div input {
				width: 30px!important;
				margin: 0;
				padding: 0;
				border: 1px solid #000;
				height: 50px;
				font-size: 35px;
				padding: 0 10px;
			}
			.button {
				float: left;
				width: 200px;
				height: 50px;
				border: 1px solid #000;
				text-align: center;
				font-size: 25px;
				text-decoration: none;
				background-color: black;
				color: white;
				padding: 10px;
				padding-top: 35px;
				margin-top: 50px;
			}
			.button, .letterContainer {
				clear: both;
			}
			.container, .buttonContainer {
				width: 80%;
				margin-left: auto;
				margin-right: auto;
			}
			.buttonContainer {
				width: 202px;
			}
			.letterContainer {
				display: table;
				margin-left: auto;
				margin-right: auto;
			}
			.errorContainer {
				position: fixed;
				top: 10px;
				right: 10px;
				background-color: red;
			}
			.letterPuzzle {
				margin-top: 75px;
			}
			.clearboth {
				clear: both;
			}
			.dash {
				font-size: 40px;
			}
		</style>
	</head>
	<body>
		<div class="message">
			<?php if($_SESSION['difficulty'] == 'Leicht'){ ?>
				<p><a href="index.php?difficulty=Schwer">Schwierigkeitsstuffe: <?php echo $_SESSION['difficulty']; ?></a></p>
			<?php }else{ ?>
				<p><a href="index.php?difficulty=Leicht">Schwierigkeitsstuffe: <?php echo $_SESSION['difficulty']; ?></a></p>
			<?php } ?>
		</div>
		<div class="container letterPuzzle">
			<div class="letterContainer">
				<?php
				$i = 0;
				$lastletter = '';
				$clearboth = false;
				for($k = 0;count($_SESSION['newSentenceArray']) > $k;$k++){
					if($i >= 10){
						if($lastletter == 'a' && $_SESSION['newSentenceArray'][$k] != ' '){
							echo "<div class='letter dash'>";
								echo "<div class='input'>";
									echo "&dash;";
								echo "</div>";
							echo "</div>";
						}else{}
						$clearboth = true;
						echo "<div class='clearboth'></div>";
						$i = 0;
					}
					if($_SESSION['newSentenceArray'][$k] == ' '){
						if($clearboth){
							echo "<div class='letter' style='display:none;'>";
						}else{
							echo "<div class='letter'>";
							$i++;
						}
							echo "<div class='input'>";
								echo "&nbsp;";
							echo "</div>";
							echo "<div class='letterDone'>";
								echo "&nbsp;";
							echo "</div>";
						echo "</div>";
						$lastletter = '';
						$clearboth = false;
					}else{
						echo "<div class='letter'>";
							echo "<div class='input'>";
								echo "<input type='text' theletter='" . $_SESSION['newSentenceArray'][$k] . "' thenumber='" . $k . "' maxlength='1' required>";
							echo "</div>";
							echo "<div class='letterDone'>";
								echo $_SESSION['newSentenceArray'][$k];
							echo "</div>";
						echo "</div>";
						$lastletter = 'a';
						$clearboth = false;
						$i++;
					}
				}
				?>
			</div>
			<div class="errorContainer">
				Insgesamt <span class="errorCounter">0</span> Fehler gemacht.
			</div>
		</div>
		<div class="buttonContainer">
			<div class="newGameSame"><a href="test.php"><div class="tryAgain button">Nochmal versuchen</div></a></div>
			<div><a href="index.php"><div class="tryAgain button">Neu generieren</div></a></div>
		</div>
		<script src="jquery.js"></script>
		<?php
		$counted=array_count_values($_SESSION['newSentenceArray']);
		$empty=$counted[' '];
		$total=count($_SESSION['newSentenceArray'])-$empty;
		?>
		<script>
			right = 0;
			error = 0;
			length = <?php echo $total; ?>;
			$('.letter').on('keyup',function(e){
				var code = e.keyCode || e.which;
				if(code == '9'){
					value = $(this).children('.input').children('input').val().toLowerCase();
					number = $(this).children('.input').children('input').attr('thenumber');
					letter = $(this).children('.input').children('input').attr('theletter');
					if($(this).is(':last-child')){
						if($('.letterContainer .letter:first-child').css('background-color') != 'green'){
							$('.letterContainer .letter:first-child').children('.input').children('input').focus();
						}
					}
				}else{
					value = $(this).children('.input').children('input').val().toLowerCase();;
					number = $(this).children('.input').children('input').attr('thenumber');
					letter = $(this).children('.input').children('input').attr('theletter');
					$.ajax({
						type:'post',
						url:'check.php',
						data: {'value':value,'number':number,'letter':letter},
						async:false,
						context: this,
						success:function(data){
							if(data == 1){
								$('.input input').each(function(e) {
									if($(this).attr('theletter') == letter && $(this).css('background-color') != 'green'){
											$(this).val(value);
											$(this).attr('disabled',true);
											$(this).css('background-color','green');
											right = right + 1;
									}
								});
								$(this).children('.input').children('input').attr('disabled',true);
								$(this).children('.input').children('input').css('background-color','green');
								if($(this).next('.letter').children('.input').html() != '&nbsp;' && !$(this).next('div').hasClass('clearboth') && !$(this).next('.letter').hasClass('dash') && !$(this).is(':last-child')){
									$(this).next('.letter').children('.input').children('input').focus();
								}else if($(this).is(':last-child')){
									if($('.letterContainer .letter:first-child').css('background-color') != 'green'){
										$('.letterContainer .letter:first-child').children('.input').children('input').focus();
									}
								}else if($(this).next('.letter').hasClass('dash')){
									$(this).next('.letter').next('.clearboth').next('.letter').children('.input').children('input').focus();
								}else if($(this).next('div').hasClass('clearboth')){
									if($(this).next('div').next('div').children('.input').html() == '&nbsp;'){
										$(this).next('div').next('div').next('div').children('.input').children('input').focus();
									}else{
										$(this).next('div').next('.letter').children('.input').children('input').focus();
									}
								}else{
									$(this).next('.letter').next('.letter').children('.input').children('input').focus();
								}
							}else{
								$(this).children('.input').children('input').val('');
								$(this).children('.input').children('input').attr('disabled',false);
								$(this).children('.input').children('input').css('background-color','red');
								error = error + 1;
								$('.errorCounter').html(error);
							}
						}
					});
					if(error > 15){
						$('.letterPuzzle').html('Leider hast du verloren. Bitte klicke auf folgende Kn&ouml;pfe, um weiterzuspielen.');
					}
					if(right == length){
						$('.letterContainer').html('Gratuliere! Du hast den Satz richtig erraten! Ich h&auml;tte nie gedacht, dass jemand das jemals schaffen wurde, du hast es aber geschafft!');
						$('.newGameSame').html('');
					}
				}
			});
		</script>
	</body>
</html>