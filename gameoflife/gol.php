<?php

$board = initNewEmptyBoard(60);
fillBoardWithGliderGun($board);

printMatrix($board);
sleep(1);

livePrinting($board, 400000);

function livePrinting($board, $millisecond)
{
    while(1)
    {
        $board = evolve($board);
        printMatrix($board);
        usleep($millisecond);
    }
}

function initNewEmptyBoard($n)
{
    for($i = 0; $i<$n; $i++){
        for($j = 0; $j<$n; $j++) {
            $board[$i][$j] = 0;
        }
        $j=0;
    }

    return $board;
}

function fillBoardWithGliderGun(&$board)
{
    if(count($board) < 37) {
        die('Cannot fill board with glider gun, min 37x37 board necessary'.PHP_EOL);
    }

    $board[5][1] = 1;
    $board[6][1] = 1;
    $board[5][2] = 1;
    $board[6][2] = 1;
    $board[5][11] = 1;
    $board[6][11] = 1;
    $board[7][11] = 1;
    $board[4][12] = 1;
    $board[8][12] = 1;
    $board[3][13] = 1;
    $board[9][13] = 1;
    $board[6][15] = 1;
    $board[3][14] = 1;
    $board[4][16] = 1;
    $board[5][17] = 1;
    $board[6][17] = 1;
    $board[7][17] = 1;
    $board[8][16] = 1;
    $board[9][14] = 1;
    $board[6][18] = 1;
    $board[3][21] = 1;
    $board[4][21] = 1;
    $board[5][21] = 1;
    $board[3][22] = 1;
    $board[4][22] = 1;
    $board[5][22] = 1;
    $board[2][23] = 1;
    $board[6][23] = 1;
    $board[1][25] = 1;
    $board[2][25] = 1;
    $board[6][25] = 1;
    $board[7][25] = 1;
    $board[3][35] = 1;
    $board[4][35] = 1;
    $board[3][36] = 1;
    $board[4][36] = 1;
}

function evolve($m)
{
    $n = neightboars($m);

    $i = 0; $j = 0;
    foreach($n as $row)
    {
        foreach($row as $v)
        {
            $e[$i][$j] = (($v == 3 || ($v == 2 && $m[$i][$j] == 1)) ? 1 : 0); 
            //$e[$i][$j] = ($v == 2 && $m[$i][$j] == 1) ? 1 : 0;
            //if($v == 2) { echo $i .' '. $j.PHP_EOL; }
            $j++;
        }
        $j = 0;
        $i++;
    }

    return $e;
}

function neightboars($m)
{
    $maxIndex = count($m) - 1;
    for($i = 0; $i < count($m); $i++)
    {
        for($j = 0; $j < count($m); $j++)
        {
            $n[$i][$j] = 0;
            $iPlus = $i < $maxIndex;
            $jPlus = $j < $maxIndex;
            $iMinus = $i > 0;
            $jMinus = $j > 0;
             

            if($iPlus)
            {
                $n[$i][$j] += $m[$i+1][$j];

                if($jPlus)  { $n[$i][$j] += $m[$i+1][$j+1]; }
                if($jMinus) { $n[$i][$j] += $m[$i+1][$j-1]; }
            }
            if($jPlus)
            {
                $n[$i][$j] += $m[$i][$j+1];
                if($iMinus) { $n[$i][$j] += $m[$i-1][$j+1]; }
            }

            if($iMinus)
            {
                $n[$i][$j] += $m[$i-1][$j];
                if($jMinus){ $n[$i][$j] += $m[$i-1][$j-1]; }
            }
            if($jMinus)
            {
                $n[$i][$j] += $m[$i][$j-1]; 
            }
        }
    }

    return $n;
}

function printMatrix($matrix)
{
    foreach($matrix as $row)
    {
        foreach($row as $v)
        {
            echo ($v == 1 ? 'x' : '.')." ";
        }
        echo PHP_EOL;
    }
    
    echo PHP_EOL;
}
