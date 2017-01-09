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
	    $this->beConstructedWith($FiringUnit,$TargetUnit,$RollingDice);
	    
	    $FiringUnit->minDistance($TargetUnit)->willReturn(5);
	    
	    $RollingDice->getRollsTotal(2)->willReturn(7);
	    //$FiringUnit->advanceToBaseContact($TargetUnit,7)->shouldBeCalled();
	    $this->chargeSuccessfull()->shouldReturn(true);
	    
    }
    
    function it_determines_unsuccessful_charge(\Unit $FiringUnit, \Unit $TargetUnit,\RollingDice $RollingDice)
    {
	    $this->beConstructedWith($FiringUnit,$TargetUnit,$RollingDice);
	    
	    $FiringUnit->minDistance($TargetUnit)->willReturn(5);
	    
	    $RollingDice->getRollsTotal(2)->willReturn(4);
	    $FiringUnit->advanceUnitToBaseContact($TargetUnit,4)->shouldNotBeCalled();
	    $this->chargeSuccessfull()->shouldReturn(false);
    }
    
    function it_determines_close_combat_hits(\Unit $FiringUnit, \Unit $TargetUnit,\RollingDice $RollingDice)
    {
	    $this->closeCombatHits(4,4,5)->shouldReturn(true);
	    
	    $this->closeCombatHits(4,4,2)->shouldReturn(false);
	    
    }
    
    // From https://www.youtube.com/watch?v=yZCZAZq_VPg&t=273s
    function it_determines_close_combat_unsaved_wounds(\Unit $FiringUnit, \Unit $TargetUnit,\RollingDice $RollingDice, \Model $ModelA, \Model $ModelB)
    {
	    $this->beConstructedWith($FiringUnit,$TargetUnit,$RollingDice);
	    $this->initiativeLevel=4;
	    
	    $FiringUnit->getUnitStrength()->willReturn(4);
	    
	    $TargetUnit->getUnitWeaponSkill()->willReturn(4);
	    
	    $ModelA->getCloseCombatAttackCount()->willReturn(5);
	    $ModelA->getWeaponSkill()->willReturn(4);
	    $ModelA->getCloseCombatWeaponAP()->willReturn(7);
	    
	    $ModelB->getCloseCombatAttackCount()->willReturn(6);
	    $ModelB->getWeaponSkill()->willReturn(4);
	    $ModelB->getCloseCombatWeaponAP()->willReturn(7);
	    
	    $FiringUnit->getModelsAtCloseCombatinitiativeStep(4)->willReturn([$ModelA,$ModelB]);
	    // To hit
	    $RollingDice->getRolls(6)->willReturn([4,6,1,4,5,2]);
	    $RollingDice->getRolls(7)->willReturn([2,4,1,4,4,6,5]);
	    // To wound
	    $TargetUnit->getUnitToughnessLevel()->willReturn(4);
	    $RollingDice->getRolls(4)->willReturn([6,1,5,4]);
	    $RollingDice->getRolls(5)->willReturn([6,4,1,2,1]);
	    // To save
	    $RollingDice->getRolls(3)->willReturn([2,6,5]);
	    $RollingDice->getRolls(2)->willReturn([6,5]);
	    $TargetUnit->getUnitArmourSave()->willReturn(6);
	    $this->getCloseCombatUnsavedWounds($FiringUnit,$TargetUnit,true)->shouldReturn(3);
    }
    
    
	    // @TODO: Need to ensure individual weapons from models have an AP etc effect
    function it_determines_hard_close_combat_unsaved_wounds(\Unit $FiringUnit, \Unit $TargetUnit,\RollingDice $RollingDice, \Model $ModelA)
    {
	    $this->beConstructedWith($FiringUnit,$TargetUnit,$RollingDice);
	    $this->initiativeLevel=1;
	    $ModelA->getCloseCombatAttackCount()->willReturn(4);
	    $ModelA->getWeaponSkill()->willReturn(4);
	    $ModelA->getCloseCombatWeaponAP()->willReturn(3);
	    $FiringUnit->getModelsAtCloseCombatinitiativeStep(1)->willReturn([$ModelA]);
	    $TargetUnit->getUnitWeaponSkill()->willReturn(4);
	    
	    $RollingDice->getRolls(5)->willReturn([2,4,3,5,6]);
	    $FiringUnit->getUnitStrength()->willReturn(10);
	    $TargetUnit->getUnitToughnessLevel()->willReturn(4);
	    $RollingDice->getRolls(3)->willReturn([2,5,2]);
	    
	    $TargetUnit->getUnitArmourSave()->willReturn(4);
	    $this->getCloseCombatUnsavedWounds($FiringUnit,$TargetUnit,true)->shouldReturn(3);
	}
	
    
}
