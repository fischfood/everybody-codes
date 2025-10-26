<?php
/**
 * Quest 2: The Runes of Power
 ** Part 1: 0.00019 Seconds (15m12s - 2352 - Would be 16th place)
 ** Part 2: 0.00749 Seconds (40m34s - 1681 - Would be 13th place)
 ** Part 3: 0.11247 Seconds (4h48m46s - 1174 - N/A)
 */

// The usual
$starttime = microtime(true);
$sample_ext = '.txt';
// $sample_ext = '-sample.txt';

$data_1 = file_get_contents('data/02/data-01' . $sample_ext );
$data_2 = file_get_contents('data/02/data-02' . $sample_ext );
$data_3 = file_get_contents('data/02/data-03' . $sample_ext );

$dataset_1 = explode("\n", $data_1 );
$dataset_2 = explode("\n", $data_2 );
$dataset_3 = explode("\n", $data_3 );

// Part One
function part_one( $dataset ) {
	$word_list = str_replace( 'WORDS:', '', $dataset[0] );
	$sentence = $dataset[2];

	$words = explode( ',', $word_list );
	$total = 0;

	foreach( $words as $word ) {
		$total += substr_count( $sentence, $word ) . ' ';
	}

	echo $total;
}

// Part Two
function part_two( $dataset ) {
	$word_list = str_replace( 'WORDS:', '', $dataset[0] );
	$words = explode( ',', $word_list );

	// Remove first two lines, leave sentence rows
	unset( $dataset[0] );
	unset( $dataset[1] );

	$total = 0;

	foreach( $dataset as $sentences ) {
		$places = [];

		foreach( $words as $word ) {

			$last_pos = 0;
			while ( ( $last_pos = strpos( $sentences, $word, $last_pos ) ) !== false ) {

				for ( $i = 0; $i < strlen( $word ); $i++ ) {
					$places[] = $last_pos + $i;
				}

				// Start at next letter (don't skip in case of overlapping words)
				$last_pos = $last_pos + 1;
			}

			// Check again for reversed string
			$word = strrev( $word );
			$last_pos = 0;

			while ( ($last_pos = strpos($sentences, $word, $last_pos)) !== false) {

				for ( $i = 0; $i < strlen( $word ); $i++ ) {
					$places[] = $last_pos + $i;
				}

				$last_pos = $last_pos + 1;
			}
		}

		$total += count( array_unique( $places ) );
	}

	echo $total;
}

// Part Two
function part_three( $dataset ) {
	$word_list = str_replace( 'WORDS:', '', $dataset[0] );
	$words = explode( ',', $word_list );

	// Remove first two lines, leave sentence rows
	unset( $dataset[0] );
	unset( $dataset[1] );

	// Map to a grid
	$map = [];
	$found_coords = [];

	foreach( $dataset as $y => $row ) {
		$row_chars = str_split( $row );

		foreach( $row_chars as $x => $char ) {
			$map[$y][$x] = $char;
		}
	}

	// Reindex map to start at 0
	$map = array_values( $map );

	foreach( $words as $word ) {

		// Y before X
		$directions = [
			[-1,0],  // up
			[1,0],   // down
			[0,-1],  // left
			[0,1],   // right
		];

		// The right edge is connected back to the left edge, so words can continue left to right, but not top to bottom.
		// Also log the coordinates of found letters to avoid double counting.

		foreach( $map as $y => $row ) {
			foreach( $row as $x => $char ) {

				if ( $char == $word[0] ) {

					// Found first letter, check directions
					foreach( $directions as $dir ) {
						$dx = $dir[0];
						$dy = $dir[1];

						$pos_x = $x;
						$pos_y = $y;
						$match = true;

						for ( $i = 1; $i < strlen( $word ); $i++ ) {
							$pos_x += $dx;
							$pos_y += $dy;

							// Wrap around left-right
							if ( $pos_x < 0 ) {
								$pos_x = count( $map[0] ) - 1;
							} elseif ( $pos_x >= count( $map[0] ) ) {
								$pos_x = 0;
							}

							// Check bounds and letter match
							if ( !isset( $map[$pos_y][$pos_x] ) || $map[$pos_y][$pos_x] != $word[$i] ) {
								$match = false;
								break;
							}
						}

						// If match, log all coordinates
						if ( $match ) {
							for ( $i = 0; $i < strlen( $word ); $i++ ) {
								$coord_x = $x + $i * $dx;
								
								// Fix wrap around
								if ( $coord_x < 0 ) {
									$coord_x = count( $map[0] ) - 1 + $coord_x + 1;
								} elseif ( $coord_x >= count( $map[0] ) ) {
									$coord_x = $coord_x - count( $map[0] );
								}

								$coord_y = $y + $i * $dy;
								$found_coords[] = $coord_y . ',' . $coord_x;
							}
						}
					}
				}
			}
		}
	}

	echo count( array_unique( $found_coords ) );
}

echo PHP_EOL . 'Quest 2: The Runes of Power';
echo PHP_EOL . 'Part 1: ';
part_one( $dataset_1 );
echo PHP_EOL . 'Part 2: ';
part_two( $dataset_2 );
echo PHP_EOL . 'Part 3: ';
part_three( $dataset_3 );
echo PHP_EOL;
echo 'Total time to generate: ' . ( microtime( true ) - $starttime );
echo PHP_EOL;
