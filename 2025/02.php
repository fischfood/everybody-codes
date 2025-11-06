<?php
/**
 * Quest 2: From Complex to Clarity
 ** Part 1: 0.00113 Seconds (16m26s - 91st)
 ** Part 2: 0.20892 Seconds (54m27s - 76th)
 ** Part 3: 20.2104 Seconds (1h04m51s - 82nd) - There's probably a more efficient way to do this
 */

// Big Maps
ini_set('memory_limit', '10G');

// Output Display?
$show_map = false;

// The usual
$starttime = microtime(true);
$sample_ext = '.txt';
$sample_ext = '-sample.txt';

$data_1 = file_get_contents('data/02/data-01' . $sample_ext );
$data_2 = file_get_contents('data/02/data-02' . $sample_ext );
$data_3 = file_get_contents('data/02/data-03' . $sample_ext );

$dataset_1 = $data_1;
$dataset_2 = $data_2;
$dataset_3 = $data_3;

// Part One
function part_one( $dataset ) {

	// Get numbers
	preg_match('/\d+\s*,\s*\d+/', $dataset, $matches);
	[$x2, $y2] = explode(',', $matches[0]);

	// Start with [0,0]
	$x1 = $y1 = 0;

	$i = 0;
	
	// Do it three times
	while ( $i < 3 ) {

		// Multiply by itself
		// Divide by [10,10]
		// Add our original points [x,y]

		[$x1, $y1] = multiply( $x1, $y1, $x1, $y1 );
		[$x1, $y1] = divide( $x1, $y1, 10, 10 );
		[$x1, $y1] = add( $x1, $y1, $x2, $y2 );

		$i++;
	}

	echo "[$x1,$y1]";
}

// Part Two
function part_two_and_three( $dataset, $divisions = 100, $show_map = false ) {

	// Bounds are +1000
	$area = 1000;
	$grid_size = $area / $divisions;

	// Get numbers, can be negative
	preg_match('/-?\d+\s*,\s*-?\d+/', $dataset, $matches);
	[$x2, $y2] = array_map('intval', array_map('trim', explode(',', $matches[0])));

	$x1 = $x2 + $area;
	$y1 = $y2 + $area;

	$check = [];
	$map = [];
	$total = 0;

	// Foreach x and y, add them to a check (and a map)
	for ( $j = $y2; $j <= $y1; $j = $j + $grid_size ) {
		for ( $i = $x2; $i <= $x1; $i = $i + $grid_size ) {
			$check[] = [$i, $j];
			$map[$j][$i] = '.';
		}
	}

	foreach( $check as [ $x, $y ] ) {

		// Save Start points for the addition
		$sx = $x;
		$sy = $y;

		// Start at 0,0
		$x = $y = 0;

		$i = 0;
		$pass = true;

		// Run 100 Times
		while ( $i < 100 ) {

			// Multiply the result by itself.
			// Divide the result by  [100000,100000] .
			// Add the coordinates of the point under examination.

			[$x, $y] = multiply( $x, $y, $x, $y );
			[$x, $y] = divide( $x, $y, 100000, 100000 );
			[$x, $y] = add( $x, $y, $sx, $sy );

			// If it's outside of the exceeding limits, fail
			if ( $x > 1000000 || $x < -1000000 || $y > 1000000 || $y < -1000000 ) {
				$pass = false;
				break;
			}

			$i++;
		}

		// If it's a pass, add to the total (and change the map icon)
		if ( $pass === true ) {
			$map[$sy][$sx] = 'X';
			$total++;
		}
	}

	echo $total;

	// Show map?
	if ( $show_map ) {
		foreach( $map as $y => $m ) {
			echo PHP_EOL;
			foreach ( $m as $x => $char ) {
				echo $char;
			}
		}
	}
}

function multiply($x1, $y1, $x2, $y2) {
	$dx = ( $x1 * $x2 - $y1 * $y2 );
	$dy = ( $x1 * $y2 + $y1 * $x2 );

	return [$dx, $dy];
}

function add( $x1, $y1, $x2, $y2) {
	return [ $x1 + $x2, $y1 + $y2 ];
}

function divide( $x1, $y1, $x2, $y2 ) {
	// Only return first integer
	return [ (int) ($x1 / $x2), (int) ($y1 / $y2) ];
}

echo PHP_EOL . 'Quest 2: From Complex to Clarity';
echo PHP_EOL . 'Part 1: ';
part_one( $dataset_1 );
echo PHP_EOL . 'Part 2: ';
part_two_and_three( $dataset_2, 100, $show_map );
echo PHP_EOL . 'Part 3: ';
part_two_and_three( $dataset_3, 1000, $show_map );
echo PHP_EOL;
echo 'Total time to generate: ' . ( microtime( true ) - $starttime );
echo PHP_EOL;
