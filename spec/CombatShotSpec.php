<?php

namespace spec;

use CombatShot;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CombatShotSpec extends ObjectBehavior
{

   function let(\ModelInfantry $FiringModel)
   {
   		$this->beConstructedWith($FiringModel);
   }
    
    function it_calculates_a_hit_correctly()
    {
	    $this->shotHits(3,4)->shouldReturn(true);
	    
	    $this->shotHits(3,3)->shouldReturn(false);
	    $this->shotHits(4,3)->shouldReturn(true);
    }
    
    function it_resolves_hits(\ModelInfantry $FiringModel)
    {
	    $FiringModel->getBallisticSkill()->willReturn(4);
	    
	    $this->beConstructedWith($FiringModel);
	    $this->getResult(3)->shouldReturn('hit');
	    $this->getResult(2)->shouldReturn('miss');
    }
    
    function it_resolves_high_bs_miss(\ModelInfantry $FiringModel)
    {
	    $FiringModel->getBallisticSkill()->willReturn(7);
	    $this->beConstructedWith($FiringModel);
	    $this->getResult(1)->shouldReturn('extra_shot');
	    $this->getResult(4)->shouldReturn('miss');
    }
    
    function it_resolves_high_bs_hit(\ModelInfantry $FiringModel)
    {
    	// Hits second chance
	    $FiringModel->getBallisticSkill()->willReturn(7);
	    $this->beConstructedWith($FiringModel);
	    $this->getResult(1)->shouldReturn('extra_shot');
	    $this->getResult(5)->shouldReturn('hit');
    }
}
