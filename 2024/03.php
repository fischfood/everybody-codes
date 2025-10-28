<?php
/**
 * Quest 3: Mining Maestro
 ** Part 1: 0.00029 Seconds (13m26s - 1216 - Would be 5th place)
 ** Part 2: 0.00182 Seconds (13m57s - 1205 - Would be 4th place)
 ** Part 3: 0.01025 Seconds (17m36s - 1160 - Would be 3rd place)
 */

// The usual
$starttime = microtime(true);
$sample_ext = '.txt';
$sample_ext = '-sample.txt';

$data_1 = file_get_contents('data/03/data-01' . $sample_ext );
$data_2 = file_get_contents('data/03/data-02' . $sample_ext );
$data_3 = file_get_contents('data/03/data-03' . $sample_ext );

$dataset_1 = explode("\n", $data_1);
$dataset_2 = explode("\n", $data_2);
$dataset_3 = explode("\n", $data_3);

// Part One and Two
function all_parts( $dataset, $directions ) {

	// Map to a grid
	[ $map, $coords_to_check, $dig ] = build_map( $dataset );

	$current_level = 1;

	while ( ! empty( $coords_to_check ) ) {
		[
			$map,
			$coords_to_check,
			$dig,
			$current_level
		] = start_digging( $map, $coords_to_check, $dig, $directions, $current_level );
	}

	echo $dig;

}

$directions_4 = [
	[-1,0],  // up
	[1,0],   // down
	[0,-1],  // left
	[0,1],   // right
];

$directions_8 = [
	[-1,0],  // up
	[1,0],   // down
	[0,-1],  // left
	[0,1],   // right
	[-1,-1], // up-left
	[-1,1],  // up-right
	[1,-1],  // down-left
	[1,1],   // down-right
];

function build_map( $dataset, $coords_to_check = [], $dig = 0 ) {

	foreach( $dataset as $y => $row ) {
		$row_chars = str_split( $row );

		foreach( $row_chars as $x => $char ) {
			if ( '.' === $char ) {
				$char = 0;
			} else {
				$char = 1;
				$dig++;
				$coords_to_check[] = [ $y, $x ];
			}

			$map[$y][$x] = $char;
		}
	}

	return [ $map, $coords_to_check, $dig ];
}

function start_digging( $map, $coords_to_check, $dig, $directions, $current_level = 1 ) {
	
	$new_coords = [];
	foreach( $coords_to_check as $coord ) {
		[ $y, $x ] = $coord;
		$passes = 0;

		foreach( $directions as $direction ) {
			[ $dy, $dx ] = $direction;

			$ny = $y + $dy;
			$nx = $x + $dx;

			if ( isset( $map[$ny][$nx] ) && $current_level <= $map[$ny][$nx] ) {
				$passes++;
			}
		}

		if ( $passes === count( $directions ) ) {
			$map[$y][$x] = $current_level + 1;
			$new_coords[] = [ $y, $x ];
			$dig++;
		}
	}

	$coords_to_check = $new_coords;
	$current_level++;

	return [ $map, $coords_to_check, $dig, $current_level ];
}

echo PHP_EOL . 'Quest 3: Mining Maestro';
echo PHP_EOL . 'Part 1: ';
all_parts( $dataset_1, $directions_4 );
echo PHP_EOL . 'Part 2: ';
all_parts( $dataset_2, $directions_4 );
echo PHP_EOL . 'Part 3: ';
all_parts( $dataset_3, $directions_8 );
echo PHP_EOL;
echo 'Total time to generate: ' . ( microtime( true ) - $starttime );
echo PHP_EOL;
