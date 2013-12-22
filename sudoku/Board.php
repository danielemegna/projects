<?php

namespace Sudoku;

require_once('Cell.php');

class Board
{	
	private $cells;

	public function __construct($n = 9)
	{
		for($i=0; $i<$n; $i++) { for($j=0; $j<$n; $j++) { $this->cells[$i][$j] = new Cell($i, $j); } }
	}

	public function computeFromMin()
	{
		$minCell = NULL;
		foreach($this->cells as $row)
		{
			foreach($row as $cell)
			{
				$c = $cell->getValuesCount();
				if($c == 1)
					continue;

				if($minCell == NULL || $minCell->getValuesCount() > $c)
				{
					$minCell = $cell;
					if($c == 2)
						break;
				}
			}
			if($minCell->getValuesCount() == 2)
				break;
		}
		
		$this->setFixedValue($minCell->x, $minCell->y, $minCell->getFirstValue());
	}

	public function printBoard($mode = 0)
	{
		echo PHP_EOL;
		$n = count($this->cells);
		for($i=0; $i<$n; $i++)
		{
			for($j=0; $j<$n; $j++)
			{
				$cell = $this->cells[$i][$j];
				echo $cell->toString($mode).' ';
			}
			echo PHP_EOL;
		}
		echo PHP_EOL;
	}

	public function refreshBoard()
	{
		$n = count($this->cells);
		for($i=$n-1; $i>=0; $i--)
		{
			for($j=0; $j<$n; $j++)
			{
				$cell = $this->cells[$i][$j];
				$v = $cell->getUniqueValue();
				if($v != NULL)
					$this->setFixedValue($i, $j, $v);
			}
		}
	}

	public function setFixedValue($x, $y, $value)
	{
		$cell = $this->cells[$x][$y];
		$cell->setFixedValue($value);
		$n = count($this->cells);

		for($i=0; $i<$n; $i++)
		{
			if($i == $x)
				continue;

			$cell = $this->cells[$i][$y];
			$v = $cell->remove($value);
			if($v != NULL)
				$this->setFixedValue($i, $y, $v); 

		}

		for($j=0; $j<$n; $j++)
		{
			if($j == $y)
				continue;

			$cell = $this->cells[$x][$j];
			$v = $cell->remove($value);
			if($v != NULL)
				$this->setFixedValue($x, $j, $v); 
		}

		$xSquare = floor($x / 3) * 3;
		$ySquare = floor($y / 3) * 3;

		for($i=$xSquare; $i<3; $i++)
		{
			if($i == $x)
				continue;

			for($j=$ySquare; $j<3; $j++)
			{
				if($j == $y)
					continue;

				$cell = $this->cells[$i][$j];
				$v = $cell->remove($value);
				if($v != NULL)
					$this->setFixedValue($i, $j, $v); 
			}
		}
	}
}

