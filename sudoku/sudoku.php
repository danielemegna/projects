<?php

namespace Sudoku;

require_once('Board.php');

$board = new Board();

$board->setFixedValue(0,0,9);
$board->setFixedValue(0,5,2);
$board->setFixedValue(0,8,1);
$board->setFixedValue(1,1,6);
$board->setFixedValue(1,3,4);
$board->setFixedValue(1,4,5);
$board->setFixedValue(1,7,7);
$board->setFixedValue(2,3,8);
$board->setFixedValue(3,0,1);
$board->setFixedValue(3,4,7);
$board->setFixedValue(3,6,4);
$board->setFixedValue(3,7,6);
$board->setFixedValue(4,1,7);
$board->setFixedValue(4,4,1);
$board->setFixedValue(4,7,9);
$board->setFixedValue(5,1,5);
$board->setFixedValue(5,2,3);
$board->setFixedValue(5,4,2);
$board->setFixedValue(5,8,8);
$board->setFixedValue(6,5,6);
$board->setFixedValue(7,1,2);
$board->setFixedValue(7,4,9);
$board->setFixedValue(7,5,5);
$board->setFixedValue(7,7,4);
$board->setFixedValue(8,0,8);
$board->setFixedValue(8,3,2);
$board->setFixedValue(8,8,3);

$board->printBoard();
$board->computeFromMin();

while(1)
{
	$c = readline();

	switch($c)
	{
		case 'p':
			$board->printBoard();
			break;
		case 'c':
			$board->computeFromMin();
			$board->printBoard();
			break;
		case 'r':
			$board->refreshBoard();
			$board->printBoard();
			break;
		case 'q':
			die();
			break;
		default:
			$board->setFixedValue($c[0], $c[1], $c[2]);
			$board->printBoard();
			break;
	}
}


