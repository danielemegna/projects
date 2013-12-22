<?php

namespace Sudoku;

class Cell
{
	private $values;
	public $x;
	public $y;

	public function __construct($x, $y)
	{
		$this->x = $x;
		$this->y = $y;
		$this->values = array(1,2,3,4,5,6,7,8,9);
	}

	public function setFixedValue($n)
	{
		$this->values = array($n);
	}

	public function getUniqueValue()
	{
		return (count($this->values) > 1 ? NULL : $this->getFirstValue());
	}

	public function getFirstValue()
	{
		return $this->values[0];
	}

	public function getValuesCount()
	{
		return count($this->values);
	}

	public function remove($n)
	{
		$oldCount = count($this->values);

		$newValues = array();
		foreach($this->values as $value)
		{
			if($value != $n)
				array_push($newValues, $value);
		}
		
		$this->values = $newValues;
		//$this->values = array_diff($this->values, array($n));

		if(count($this->values) == 0)
			die('Error in remove, no values remains!');

		if($oldCount > 1 && count($this->values) == 1)
			return $this->values[0];
		
		return NULL;
	}

	public function toString($mode = 0)
	{
		if(count($this->values) == 1)
			return ' '.$this->values[0].' ';

		if(count($this->values) == 0)
			return 'Err';

		switch($mode)
		{
			case 0: return ' . ';
			case 1: return '(' . count($this->values) . ')';
			case 2: return '|'.$this->values[0].'|';
		}
	}

}
