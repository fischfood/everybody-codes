<?php
/**
 * Quest 8: The Art of Connection
 ** Part 1: 0.00030 Seconds (7m04s - 104th)
 */

// The usual
$starttime = microtime(true);
$sample_ext = '.txt';
// $sample_ext = '-sample.txt';

$data_1 = file_get_contents('data/08/data-01' . $sample_ext );
$data_2 = file_get_contents('data/08/data-02' . $sample_ext );
$data_3 = file_get_contents('data/08/data-03' . $sample_ext );

$dataset_1 = explode(",", $data_1);
$dataset_2 = str_split($data_2, 2); // explode("\n", $data_2);
$dataset_3 = str_split($data_3, 3); // explode("\n", $data_3);

// Part One
function part_one( $dataset ) {
	$total = $dataset;
	asort( $total );
	
	$mid = 0;
	$total = array_pop( $total );

	for ( $i = 0; $i <= count( $dataset ) - 2; $i++ ) {
		if ( abs( $dataset[$i] - $dataset[$i+1] ) === $total / 2 ) {
			$mid++;
		}
	}

	echo $mid;
}

// Part Two
function part_two( $dataset ) {
	# Do More Things
}

// Part Three
function part_three( $dataset ) {
	# Do Even More Things
}

echo PHP_EOL . 'Quest 8: The Art of Connection';
echo PHP_EOL . 'Part 1: ';
part_one( $dataset_1 );
echo PHP_EOL . 'Part 2: ';
// part_two( $dataset_2 );
echo PHP_EOL . 'Part 3: ';
// part_three( $dataset_3 );
echo PHP_EOL;
echo 'Total time to generate: ' . ( microtime( true ) - $starttime );
echo PHP_EOL;
