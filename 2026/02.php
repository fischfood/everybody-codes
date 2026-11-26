<?php
/**
 * Quest 2: The Axeperiment
 * Part 1: 0.00027 Seconds (18m11s - 653)
 * Part 2: 0.00069 Seconds (32m20s - 584)
 * Part 3: TBD
 */

// The usual
$starttime  = microtime( true );
$sample_ext = '.txt';
$sample_ext = '-sample.txt';

$data_1 = file_get_contents( 'data/02/data-01' . $sample_ext );
$data_2 = file_get_contents( 'data/02/data-02' . $sample_ext );
$data_3 = file_get_contents( 'data/02/data-03' . $sample_ext );

$dataset_1 = explode( "\n", $data_1 );
$dataset_2 = explode( "\n", $data_2 );
$dataset_3 = explode( "\n", $data_3 );

require_once '../functions.php';

// Part One
function part_one( $dataset ) {
	$total = 0;
	foreach ( $dataset as $data ) {
		$comparisons = explode( ' ', $data );

		$harder = array( 5, 4, 3, 2, 1 );

		foreach ( $comparisons as $c ) {
			if ( str_contains( $c, '<' ) ) {
				$harder[] = $c[2];
			} else {
				$harder[] = $c[0];
			}
		}

		$vals = array_count_values( $harder );
		arsort( $vals );

		$total += implode( '', array_keys( $vals ) );
	}

	echo $total;
}

// Part Two
function part_two( $dataset ) {
	$total = 0;

	foreach ( $dataset as $data ) {
		$comparisons = explode( ' ', $data );

		$harder = $softer = array();

		foreach ( $comparisons as $c ) {
			if ( str_contains( $c, '<' ) ) {
				$harder[] = $c[2];
				$softer[] = $c[0];
			} else {
				$harder[] = $c[0];
				$softer[] = $c[2];
			}
		}

		$vals  = array_count_values( $harder );
		$svals = array_count_values( $softer );

		$scores = array();

		foreach ( array_keys( $vals + $svals ) as $key ) {
			$scores[ $key ] = ( $vals[ $key ] ?? 0 ) - ( $svals[ $key ] ?? 0 );
		}

		arsort( $scores );

		$total += (int) implode( '', array_keys( $scores ) );
	}

	echo $total;
}

// Part Three
function part_three( $dataset ) {
	$total = 0;

	foreach ( $dataset as $data ) {
		$comparisons = explode( ' ', $data );

		$harder = $softer = array();

		foreach ( $comparisons as $c ) {
			if ( str_contains( $c, '<' ) ) {
				$harder[] = $c[2];
				$softer[] = $c[0];
			} else {
				$harder[] = $c[0];
				$softer[] = $c[2];
			}
		}
	}

	echo $total;
}

echo PHP_EOL . 'Quest 2: The Axeperiment';
echo PHP_EOL . 'Part 1: ';
part_one( $dataset_1 );
echo PHP_EOL . 'Part 2: ';
part_two( $dataset_2 );
echo PHP_EOL . 'Part 3: ';
part_three( $dataset_3 );
echo PHP_EOL;
echo 'Total time to generate: ' . ( microtime( true ) - $starttime );
echo PHP_EOL;
