<?php
	include "common.php";
?>
<tbody>
	<tr>
		<td>
			<table class="gameTable">
				<tbody>
					<?php
						$cardsTaken = [ CARD_CIVILIAN => 0, CARD_RED => 0, CARD_BLUE => 0, CARD_SPY => 0 ];
						for( $row = 0; $row < ROWS; $row++ ) {
							for( $col = 0; $col < COLS; $col++ ) {
								$rec = $data->table[$row][$col];
								if( $rec->discovered )
									$cardsTaken[$rec->type]++;
							}
						}
						
						for( $row = 0; $row < ROWS; $row++ ) {
							echo "<tr>";
							
							for( $col = 0; $col < COLS; $col++ ) {
								$record = $data->table[$row][$col];
								?>
								<td class="card <?= $record->discovered ? "discovered " . $typeClasses[$record->type] : "" ?>">
									<?= $record->word ?>
								</td>
								<?php
							}
							
							echo "</tr>";
						}
					?>
					<tr>
						<td class="taken" colspan="<?= COLS ?>">
							<?php
								for( $i = 0; $i < STARTING_PLAYER_CARD_COUNT - $cardsTaken[$data->startingPlayer]; $i++ )
									echo "<div class='" . ($data->startingPlayer == CARD_RED ? "red" : "blue") . "'></div>";
								
								for( $i = 0; $i < STARTING_PLAYER_CARD_COUNT - 1 - $cardsTaken[$data->startingPlayer == CARD_RED ? CARD_BLUE : CARD_RED]; $i++ )
									echo "<div class='" . ($data->startingPlayer == CARD_RED ? "blue" : "red") . "'></div>";
							?>
						</td>
					</tr>
				</tbody>
			</table>
		</td>
	</tr>
</tbody>