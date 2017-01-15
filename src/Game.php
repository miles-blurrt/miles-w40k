<?php

class Game
{
	var $currentPlayer = 0;
	var $playerTurnOrder = [];
	
	var $turnNumber = 0;
	var $Rules = null;
	
	function __construct($Armies = [], $Rules = null)
	{
		$this->turnNumber = 1;
		$this->Armies = $Armies;
		$this->Turn = new Turn($this->turnNumber,$this->Armies);
		$this->Rules = $Rules;
	}
	
	function getCurrentTurnNumber()
    {
	    return($this->turnNumber);
    }
    
    
    
    function setCurrentPlayerNumber($playerNumber)
    {
	    reset($this->playerTurnOrder);
	    do 
	    {
		    $currentPlayerNumber = next($this->playerTurnOrder);
		    if($currentPlayerNumber==false)
		    	break;
		    
	    } while ($currentPlayerNumber!=$playerNumber);
	    
	    $this->currentPlayer = $playerNumber;
	    
    }
    function getCurrentPlayerNumber()
    {
	   	return($this->currentPlayer); 
    }
    
    
    
    function gotoNextPlayer()
    {
	    $playerNext = next($this->playerTurnOrder);
	    if($playerNext==false)
	    {
		    reset($this->playerTurnOrder);
		    $playerNext = current($this->playerTurnOrder);
		    $this->setupNewTurn();
	    }

	    $this->currentPlayer = $playerNext;
	    
	    
    }
    
    function setupNewTurn()
    {
	    $this->turnNumber++;
	    
	    $this->Turn = new Turn($this->turnNumber,$this->Armies);
    }
    
	
    
    
}
