<?php

namespace spec;

use Game;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GameSpec extends ObjectBehavior
{
	
	
    function it_is_initializable()
    {
        $this->shouldHaveType(Game::class);
    }
    
    function it_cycles_through_player_turns()
    {
	    $this->setCurrentPlayerNumber(1);
	    $this->playerTurnOrder = [1,2];
	    
	    $this->getCurrentPlayerNumber()->shouldEqual(1);
	    $this->getCurrentTurnNumber()->shouldEqual(1);
	    
	    $this->gotoNextPlayer();
	    $this->getCurrentPlayerNumber()->shouldEqual(2);
	    $this->getCurrentTurnNumber()->shouldEqual(1);
	    
	    $this->gotoNextPlayer();
	    $this->getCurrentPlayerNumber()->shouldEqual(1);
	    $this->getCurrentTurnNumber()->shouldEqual(2);
    }
}
