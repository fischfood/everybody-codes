<?php
/**
 * Quest 3: The Deepest Fit
 ** Part 1: 0.00038 Seconds (3m02s - 28th)
 ** Part 2: 0.00045 Seconds (6m18s - 40th)
 ** Part 3: 0.00046 Seconds (12m43s - 59th)
 */

// The usual
$starttime = microtime(true);
$sample_ext = '.txt';
$sample_ext = '-sample.txt';

$data_1 = file_get_contents('data/03/data-01' . $sample_ext );
$data_2 = file_get_contents('data/03/data-02' . $sample_ext );
$data_3 = file_get_contents('data/03/data-03' . $sample_ext );

$dataset_1 = explode(",", $data_1);
$dataset_2 = explode(",", $data_2);
$dataset_3 = explode(",", $data_3);

// Part One
function part_one( $dataset ) {
	// Ignore duplicates, get total crates.
	echo array_sum( array_unique( $dataset ) );
}

// Part Two
function part_two( $dataset ) {

	// Ignore duplicates, sort low to high, get first 20, add.
	$crates = array_unique( $dataset );
	asort( $crates );
	$crates = array_values( $crates );
	
	$first_20 = array_slice( $crates, 0, 20 );

	echo array_sum( $first_20 );
}

// Part Three
function part_three( $dataset ) {
	// Find which crate has the highest total, sort low to high, grab the last.
	$crates = array_count_values( $dataset );
	asort( $crates );

	echo array_pop( $crates );
}

echo PHP_EOL . 'Quest 3: The Deepest Fit';
echo PHP_EOL . 'Part 1: ';
part_one( $dataset_1 );
echo PHP_EOL . 'Part 2: ';
part_two( $dataset_2 );
echo PHP_EOL . 'Part 3: ';
part_three( $dataset_3 );
echo PHP_EOL;
echo 'Total time to generate: ' . ( microtime( true ) - $starttime );
echo PHP_EOL;
