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
	    
	    $ModelA->getCloseCombatAttackCount()->willReturn(1);
	    $ModelA->getWeaponSkill()->willReturn(4);
	    $ModelB->getCloseCombatAttackCount()->willReturn(6);
	    $ModelB->getWeaponSkill()->willReturn(4);
	    
	    $FiringUnit->getModelsAtCloseCombatinitiativeStep(4)->willReturn([$ModelA,$ModelB]);
	    // To hit
	    $RollingDice->getRolls(2)->willReturn([4,6]);
	    $RollingDice->getRolls(7)->willReturn([2,4,1,4,4,6,1]);
	    // To wound
	    $TargetUnit->getUnitToughnessLevel()->willReturn(4);
	    $RollingDice->getRolls(6)->willReturn([2,1,1,4,4,5]);
	    // To save
	    $RollingDice->getRolls(3)->willReturn([2,3,5]);
	    $TargetUnit->getUnitArmourSave()->willReturn(6);
	    $this->getCloseCombatUnsavedWounds($FiringUnit,$TargetUnit,true)->shouldReturn(3);
    }
    
    // From https://www.youtube.com/watch?v=yZCZAZq_VPg&t=273s
    // A weird spec, but getting rolls have to have differen counts otherwise they override each other
    function it_determines_many_close_combat_unsaved_wounds(\Unit $FiringUnit, \Unit $TargetUnit,\RollingDice $RollingDice, \Model $ModelA, \Model $ModelB, \Model $ModelC, \Model $ModelD, \Model $ModelE, \Model $ModelF, \Model $ModelG, \Model $ModelH)
    {
	    $this->beConstructedWith($FiringUnit,$TargetUnit,$RollingDice);
	    $this->initiativeLevel=2;
	    $FiringUnit->getUnitStrength()->willReturn(4);
	    $TargetUnit->getUnitWeaponSkill()->willReturn(4);
	    
	    $ModelA->getCloseCombatAttackCount()->willReturn(1);
	    $ModelA->getWeaponSkill()->willReturn(4);
	    $ModelB->getCloseCombatAttackCount()->willReturn(2);
	    $ModelB->getWeaponSkill()->willReturn(4);
	    $ModelC->getCloseCombatAttackCount()->willReturn(3);
	    $ModelC->getWeaponSkill()->willReturn(4);
	    $ModelD->getCloseCombatAttackCount()->willReturn(4);
	    $ModelD->getWeaponSkill()->willReturn(4);
	    $ModelE->getCloseCombatAttackCount()->willReturn(5);
	    $ModelE->getWeaponSkill()->willReturn(4);
	    $ModelF->getCloseCombatAttackCount()->willReturn(6);
	    $ModelF->getWeaponSkill()->willReturn(4);
	    $ModelG->getCloseCombatAttackCount()->willReturn(7);
	    $ModelG->getWeaponSkill()->willReturn(4);
	    $ModelH->getCloseCombatAttackCount()->willReturn(8);
	    $ModelH->getWeaponSkill()->willReturn(4);
	    
	    $FiringUnit->getModelsAtCloseCombatinitiativeStep(2)->willReturn([$ModelA,$ModelB,$ModelC,$ModelD,$ModelE,$ModelF,$ModelG,$ModelH]);
	    // To hit
	    $RollingDice->getRolls(2)->willReturn([5,1]);
	    $RollingDice->getRolls(3)->willReturn([6,1,2]);
	    $RollingDice->getRolls(4)->willReturn([6,1,5,1]);
	    $RollingDice->getRolls(5)->willReturn([5,4,1,1,5]);
	    $RollingDice->getRolls(6)->willReturn([6,2,4,2,3,2]);
	    $RollingDice->getRolls(7)->willReturn([6,1,3,2,1,6,3]);
	    $RollingDice->getRolls(8)->willReturn([1,4,4,1,3,5,6,3]);
	    $RollingDice->getRolls(9)->willReturn([1,5,4,1,3,5,2,3,1]);
	    // To wound
	    $TargetUnit->getUnitToughnessLevel()->willReturn(4);
	    $RollingDice->getRolls(18)->willReturn([6,5,4,1,6,5,1,2,1,6,1,4,5,3,6,4,2,2]);
	    // To save
	    $RollingDice->getRolls(10)->willReturn([4,2,1,1,2,5,1,1,5,1]);
	    $TargetUnit->getUnitArmourSave()->willReturn(3);
	    $this->getCloseCombatUnsavedWounds($FiringUnit,$TargetUnit,true)->shouldReturn(7);
    }
    /*
	    // @TODO: Need to ensure individual weapons from models have an AP etc effect
    function it_determines_hard_close_combat_unsaved_wounds(\Unit $FiringUnit, \Unit $TargetUnit,\RollingDice $RollingDice, \Model $ModelA)
    {
	    $this->beConstructedWith($FiringUnit,$TargetUnit,$RollingDice);
	    $this->initiativeLevel=1;
	    $ModelA->getCloseCombatAttackCount()->willReturn(1);
	    $ModelA->getWeaponSkill()->willReturn(4);
	    $TargetUnit->getUnitWeaponSkill()->willReturn(4);
	    
	    $RollingDice->getRolls(5)->willReturn([2,4,3,1,6]);
	    $FiringUnit->getUnitStrength()->willReturn(10);
	    $TargetUnit->getUnitToughnessLevel()->willReturn(4);
	    $RollingDice->getRolls(3)->willReturn([2,5,2]);
	    $FiringUnit->getModelsAtCloseCombatinitiativeStep(1)->willReturn([$ModelA]);
	    $this->getCloseCombatUnsavedWounds($FiringUnit,$TargetUnit,true)->shouldReturn(7);
	}
	*/ 
    
}
