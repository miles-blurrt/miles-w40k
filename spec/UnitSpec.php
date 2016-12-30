<?php

namespace spec;

use Unit;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UnitSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Unit::class);
    }
    
    function it_passes_leadership(\Model $ThisModel, \RollingDice $RollingDice)
    {
	    $ThisModel->getLeadership()->willReturn(6);
	    $FiringModels = [$ThisModel];
	    
	    $RollingDice->getRoll(12)->willReturn(5);
		$this->beConstructedWith($FiringModels,$RollingDice);    
		$this->passesLeadershipTest()->shouldReturn(true);
    }
    
    function it_fails_leadership(\Model $ThisModel, \RollingDice $RollingDice)
    {
	    $ThisModel->getLeadership()->willReturn(4);
	    $FiringModels = [$ThisModel];
	    
	    $RollingDice->getRoll(12)->willReturn(5);
		$this->beConstructedWith($FiringModels,$RollingDice);    
		$this->passesLeadershipTest()->shouldReturn(false);
    }
    
    function it_passes_leadership_with_a_stronger_leader(\Model $ModelA, \Model $ModelB, \RollingDice $RollingDice)
    {
	    $ModelA->getLeadership()->willReturn(4);
	    $ModelB->getLeadership()->willReturn(6);
	    $FiringModels = [$ModelA,$ModelB];
	    
	    $RollingDice->getRoll(12)->willReturn(5);
		$this->beConstructedWith($FiringModels,$RollingDice);    
		$this->passesLeadershipTest()->shouldReturn(true);
    }
}
