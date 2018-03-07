<?php
	include "common.php";
?>
<tbody>
	<tr>
		<td>
			<table class="gameTable">
				<tbody>
					<?php
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
				</tbody>
			</table>
		</td>
	</tr>
</tbody>