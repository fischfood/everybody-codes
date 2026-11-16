<?php
/**
 * Quest 01: The Coneservation (Add 6m to all, since I wasn't logged in at first)
 * Part 1: 0.00022 Seconds (0h31s - 799)
 * Part 2: 0.00022 Seconds (31m06s - 741)
 * Part 3: 0.00029 Seconds (48m17s - 713)
 */

// The usual
$starttime  = microtime( true );
$sample_ext = '.txt';
$sample_ext = '-sample.txt';

$data_1 = file_get_contents( 'data/01/data-01' . $sample_ext );
$data_2 = file_get_contents( 'data/01/data-02' . $sample_ext );
$data_3 = file_get_contents( 'data/01/data-03' . $sample_ext );

$dataset_1 = explode( ',', $data_1 );
$dataset_2 = explode( ',', $data_2 );
$dataset_3 = explode( ',', $data_3 );

require_once '../functions.php';

// Part One
function part_one( $dataset ) {
	$total = 0;
	foreach ( $dataset as $data ) {
		$needed = ( ceil( sqrt( $data ) ) ** 2 ) - $data;
		$total += $needed;
	}

	echo $total;
}

// Part Two
function part_two( $dataset ) {
	$total = 0;
	foreach ( $dataset as $data ) {

		// Perimeter increases by 4 each time, 3x3 = 8, 4x4 = 12, 5x5 = 16...
		// Add 4 to each, so 3 = 12, 4 = 16, 5 = 20 ... So grid * 4.

		// Minimum of 8.
		if ( $data <= 8 ) {
			$needed = 8 - $data;
		} else {
			$needed = ( 4 - ( $data % 4 ) ) % 4;
		}

		$total += $needed;
	}

	echo $total;
}

// Part Three
function part_three( $dataset ) {
	$total = 0;
	foreach ( $dataset as $data ) {

		if ( $data <= 8 ) {
			$needed = 8 - $data;
		} else {

			$grid = ceil( sqrt( $data ) );
			if ( $grid % 2 == 0 ) {
				++$grid;
			}

			$needed = ( $grid ** 2 ) - 1 - $data;

			if ( $needed < 0 ) {
				$needed = ( ( $grid + 2 ) ** 2 ) - 1 - $data;
			}
		}

		$total += $needed;
	}

	echo $total;
}

echo PHP_EOL . 'Quest 01: The Coneservation';
echo PHP_EOL . 'Part 1: ';
part_one( $dataset_1 );
echo PHP_EOL . 'Part 2: ';
part_two( $dataset_2 );
echo PHP_EOL . 'Part 3: ';
part_three( $dataset_3 );
echo PHP_EOL;
echo 'Total time to generate: ' . ( microtime( true ) - $starttime );
echo PHP_EOL;
