<?php

namespace spec;

use CombatClose;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CombatCloseSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CombatClose::class);
    }
    
    function let(\Unit $FiringUnit, \WeaponBolter $FiringWeapon, \Unit $TargetUnit)
    {
   		$this->beConstructedWith($FiringUnit,$FiringWeapon,$TargetUnit);
    }
    
    function it_determines_successful_charge(\Unit $FiringUnit, \Unit $TargetUnit,\RollingDice $RollingDice)
    {
	    $this->beConstructedWith($FiringUnit,null,$TargetUnit,$RollingDice);
	    
	    $FiringUnit->minDistance($TargetUnit)->willReturn(5);
	    
	    $RollingDice->getRollsTotal(2)->willReturn(7);
	    $FiringUnit->advanceToBaseContact($TargetUnit,7)->shouldBeCalled();
	    $this->chargeSuccessfull()->shouldReturn(true);
	    
    }
    
    function it_determines_unsuccessful_charge(\Unit $FiringUnit, \Unit $TargetUnit,\RollingDice $RollingDice)
    {
	    $this->beConstructedWith($FiringUnit,null,$TargetUnit,$RollingDice);
	    
	    $FiringUnit->minDistance($TargetUnit)->willReturn(5);
	    
	    $RollingDice->getRollsTotal(2)->willReturn(4);
	    $FiringUnit->advanceToBaseContact($TargetUnit,4)->shouldNotBeCalled();
	    $this->chargeSuccessfull()->shouldReturn(false);
    }
    
    function it_determines_close_combat_hits(\Unit $FiringUnit, \Unit $TargetUnit,\RollingDice $RollingDice)
    {
	    $this->beConstructedWith($FiringUnit,null,$TargetUnit,$RollingDice);
	    
	    $FiringUnit->getWeaponSkill()->willReturn(4);
	    $RollingDice->getRoll()->willReturn(5);
	    $this->closeCombatHits()->shouldReturn(true);
	    
	    $RollingDice->getRoll()->willReturn(2);
	    $this->closeCombatHits()->shouldReturn(false);
	    
    }
    
}
