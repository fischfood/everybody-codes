<?php
/**
 * Quest 1: Whispers in the Shell
 ** Part 1: 0.00086 Seconds (14m41s - 85th) - Would have been faster if I read it didn't loop
 ** Part 2: 0.00085 Seconds (15m35s - 66th) - See...
 ** Part 3: 0.00088 Seconds (28m15s - 74th)
 */

// The usual
$starttime = microtime(true);
$sample_ext = '.txt';
$sample_ext = '-sample.txt';

$data_1 = file_get_contents('data/01/data-01' . $sample_ext );
$data_2 = file_get_contents('data/01/data-02' . $sample_ext );
$data_3 = file_get_contents('data/01/data-03' . $sample_ext );

$dataset_1 = explode("\n", $data_1);
$dataset_2 = explode("\n", $data_2);
$dataset_3 = explode("\n", $data_3);

// Part One
function part_one( $dataset ) {

	$names = explode(',', $dataset[0] );
	$moves = explode(',', $dataset[2] );

	$start = 0;
	$max = count( $names ) - 1;

	foreach( $moves as $m ) {
		preg_match_all( '/\d+/', $m, $matches );
		$number = $matches[0][0];

		if ( str_starts_with( $m, 'R' ) ) {

			$start = $start + $number;
			if ( $start > $max ) {
				$start = $max;
			}

		} else {

			$start = $start - $number;
			if ( $start < 0 ) {
				$start = 0;
			}

		}
	}

	echo $names[$start];
}

// Part Two
function part_two( $dataset ) {

	$names = explode(',', $dataset[0] );
	$moves = explode(',', $dataset[2] );

	$start = 0;

	foreach( $moves as $m ) {

		preg_match_all( '/\d+/', $m, $matches );
		$number = $matches[0][0];

		if ( str_starts_with( $m, 'R' ) ) {

			$start = $start + $number;
			if ( $start > count( $names ) ) {
				$start = $start % count( $names );
			}

		} else {

			$start = $start - $number;
			if ( $start < 0 ) {
				$start = $start + count( $names );
			}

		}
	}

	echo $names[$start];
}

// Part Three
function part_three( $dataset ) {

	$names = explode(',', $dataset[0] );
	$moves = explode(',', $dataset[2] );

	for ( $i = 0; $i < count($moves); $i++ ) {
		$m = $moves[$i];

		preg_match_all( '/\d+/', $m, $matches );
		$number = $matches[0][0];

		if ( str_starts_with( $m, 'R' ) ) {
			$rot = ( $number % count( $names ) );
		} else {
			$rot = ( count( $names ) - ( $number % count( $names ) ) ) % count( $names );
		}

		$swap1 = $names[0];
		$swap2 = $names[$rot];

		$names[0] = $swap2;
		$names[$rot] = $swap1;

	}

	echo $names[0];
}

echo PHP_EOL . 'Quest 1: Whispers in the Shell';
echo PHP_EOL . 'Part 1: ';
part_one( $dataset_1 );
echo PHP_EOL . 'Part 2: ';
part_two( $dataset_2 );
echo PHP_EOL . 'Part 3: ';
part_three( $dataset_3 );
echo PHP_EOL;
echo 'Total time to generate: ' . ( microtime( true ) - $starttime );
echo PHP_EOL;
