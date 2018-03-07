<?php
	include "common.php";
	
	$action = $_GET["action"] ?? "";
	switch( $action ) {
		
		case "newGame":
			newGame();
			break;
		
		case "replace":
			$words = getWordList();
			$data->table[$_GET["row"]][$_GET["col"]]->word = $words[rand( 0, count( $words ) )];
			saveData( $data );
			break;
		
		case "replaceDelete":
			$words = getWordList();
			$words = array_diff( $words, [ $data->table[$_GET["row"]][$_GET["col"]]->word ] );
			file_put_contents( "words.txt", implode( "\n", $words ) );
			
			$data->table[$_GET["row"]][$_GET["col"]]->word = $words[rand( 0, count( $words ) )];
			saveData( $data );
			break;
		
		case "uncover":
			$data->table[$_GET["row"]][$_GET["col"]]->discovered = true;
			saveData( $data );
			break;
		
	}
	if( $action != "" )
		header( "Location: ?" );
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Krycí jména | ovládací panel</title>
		<link rel="stylesheet" href="main.css">
	</head>
	<body>
		<table id="content">
			<tbody>
				<tr>
					<td>
						<table class="gameTable controlTable">
							<tbody>
								<?php
									for( $row = 0; $row < ROWS; $row++ ) {
										echo "<tr>";
										for( $col = 0; $col < COLS; $col++ ) {
											$record = $data->table[$row][$col];
											?>
											<td class="card <?= $record->discovered ? "discovered" : "" ?> <?= $typeClasses[$record->type] ?>" data-row="<?= $row ?>" data-col="<?= $col ?>">
												<?= $record->word ?>
											</td>
											<?php
										}
										echo "</tr>";
									}
								?>
							</tbody>
						</table>
					</td>
					<td id="menu">
						<div class="begins <?= $typeClasses[$data->startingPlayer] ?>">Začíná <?= $data->startingPlayer == CARD_RED ? "červený" : "modrý" ?></div>
						<br>
						<a href="?action=newGame">Nová hra</a>
						<br>
						<div class="action" data-action="replace">Nahradit kartu</div>
						<div class="action" data-action="replaceDelete">Nahradit kartu (smazat ze seznamu)</div>
						<br><br>
						<div class="action uncover" data-action="uncover">Odkrýt kartu</div>
					</td>
				</tr>
			</tbody>
		</table>
		<script src="jquery.min.js"></script>
		<script src="main.js"></script>
	</body>
</html>