<?php
	const ROWS = 5;
	const COLS = 5;
	
	const STARTING_PLAYER_CARD_COUNT = 9;
	
	const CARD_CIVILIAN = 0;
	const CARD_RED = 1;
	const CARD_BLUE = 2;
	const CARD_SPY = 3;
	
	$typeClasses = [
			CARD_CIVILIAN => "civilian",
			CARD_BLUE => "blue",
			CARD_RED => "red",
			CARD_SPY => "spy"
	];
	
	function getWordList() {
		return explode( "\n", file_get_contents( "words.txt" ) );
	}
	
	function saveData( $data ) {
		file_put_contents( "data.txt", json_encode( $data ) );
	}
	
	function newGame() {
		$result = [];
		$table = [];
		
		$words = getWordList();
		$wordsCnt = count( $words );
		
		$emptyFields = [];
		
		for( $row = 0; $row < ROWS; $row++ ) {
			$rowData = [];
			for( $col = 0; $col < COLS; $col++ ) {
				$word = $words[rand( 0, $wordsCnt )];
				
				$rowData[] = [
						"word" => $word,
						"type" => CARD_CIVILIAN,
						"discovered" => false
				];
				
				$emptyFields[] = &$rowData[$col];
			}
			
			$table[] = $rowData;
		}
		
		$startingPlayer = rand( 0, 1 ) ? CARD_RED : CARD_BLUE;
		$secondPlayer = $startingPlayer == CARD_RED ? CARD_BLUE : CARD_RED;
		
		$spyPos = rand( 0, count( $emptyFields ) );
		$emptyFields[$spyPos]["type"] = CARD_SPY;
		array_splice( $emptyFields, $spyPos, 1 );
		
		for( $i = 0; $i < STARTING_PLAYER_CARD_COUNT; $i++ ) {
			$pos = rand( 0, count( $emptyFields ) );
			$emptyFields[$pos]["type"] = $startingPlayer;
			array_splice( $emptyFields, $pos, 1 );
		}
		
		for( $i = 0; $i < STARTING_PLAYER_CARD_COUNT - 1; $i++ ) {
			$pos = rand( 0, count( $emptyFields ) );
			$emptyFields[$pos]["type"] = $secondPlayer;
			array_splice( $emptyFields, $pos, 1 );
		}
		
		$result["startingPlayer"] = $startingPlayer;
		$result["table"] = $table;
		saveData( $result );
	}
	
	if( !file_exists( "data.txt" ) )
		newGame();
	
	$data = json_decode( file_get_contents( "data.txt" ) );