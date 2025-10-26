<?php
/**
 * Quest 1: The Battle for the Farmlands
 ** Part 1: 0.00035 Seconds (4m15s - 3635 - Would be 3rd place)
 ** Part 2: 0.00053 Seconds (12m07s - 3072 - Would be 4th place)
 ** Part 3: 0.00116 Seconds (16m00s - 2840 - Would be 3rd place)
 */

// The usual
$starttime = microtime(true);
$sample_ext = '.txt';
$sample_ext = '-sample.txt';

$data_1 = file_get_contents('data/01/data-01' . $sample_ext );
$data_2 = file_get_contents('data/01/data-02' . $sample_ext );
$data_3 = file_get_contents('data/01/data-03' . $sample_ext );

$dataset_1 = str_split($data_1, 1);
$dataset_2 = str_split($data_2, 2);
$dataset_3 = str_split($data_3, 3);

include_once( '../functions.php' );

// Part One
function part_one( $dataset ) {

	$health = [
		'A' => 0,
		'B' => 1,
		'C' => 3,
	];

	$total_potions = 0;

	foreach( $dataset as $creature ) {
		$total_potions += $health[$creature];
	}

	echo $total_potions;

}

// Part Two
function part_two( $dataset ) {

	$health = [
		'A' => 0,
		'B' => 1,
		'C' => 3,
		'D' => 5,
		'x' => 0,
	];

	$total_potions = 0;

	foreach( $dataset as $group ) {
		$creatures = str_split( $group, 1 );

		foreach( $creatures as $creature ) {
			$total_potions += $health[$creature];
		}

		// Additional potions needed for dual battle (one per creature)
		if ( ! str_contains( $group, 'x' ) ) {
			$total_potions += 2;
		}

	}

	echo $total_potions;
}

// Part Three
function part_three( $dataset ) {

	$health = [
		'A' => 0,
		'B' => 1,
		'C' => 3,
		'D' => 5,
		'x' => 0,
	];

	$total_potions = 0;

	foreach( $dataset as $group ) {
		$creatures = str_split( $group, 1 );

		foreach( $creatures as $creature ) {
			$total_potions += $health[$creature];
		}

		// Remove blank battle spots
		$opp = strlen( str_replace('x', '', $group ) );

		// If two opponents, add two (one per creature)
		if ( $opp === 2 ) {
			$total_potions += 2;
		}

		// If three opponents, add six (two per creature)
		if ( $opp === 3 ) {
			$total_potions += 6;
		}

	}

	echo $total_potions;

}

echo PHP_EOL . 'Quest 1: The Battle for the Farmlands';
echo PHP_EOL . 'Part 1: ';
part_one( $dataset_1 );
echo PHP_EOL . 'Part 2: ';
part_two( $dataset_2 );
echo PHP_EOL . 'Part 3: ';
part_three( $dataset_3 );
echo PHP_EOL;
echo 'Total time to generate: ' . ( microtime( true ) - $starttime );
echo PHP_EOL;
