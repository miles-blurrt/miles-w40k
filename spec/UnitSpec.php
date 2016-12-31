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
    
    function it_returns_most_common_weapon_skill(\Model $ModelA, \Model $ModelB, \Model $ModelC)
    {
	    $ModelA->getWeaponSkill()->willReturn(4);
	    $ModelB->getWeaponSkill()->willReturn(3);
	    $ModelC->getWeaponSkill()->willReturn(4);
	    $FiringModels = [$ModelA,$ModelB,$ModelC];
	    
	    $this->beConstructedWith($FiringModels);    
		$this->getUnitWeaponSkill()->shouldReturn(4);
    }
    
    function it_returns_most_common_weapon_skill_2(\Model $ModelA, \Model $ModelB, \Model $ModelC)
    {
	    $ModelA->getWeaponSkill()->willReturn(3);
	    $ModelB->getWeaponSkill()->willReturn(3);
	    $ModelC->getWeaponSkill()->willReturn(4);
	    $FiringModels = [$ModelA,$ModelB,$ModelC];
	    
	    $this->beConstructedWith($FiringModels);    
		$this->getUnitWeaponSkill()->shouldReturn(3);
    }
    
    function it_returns_min_distance(\Model $ModelA, \Model $ModelB, \Model $TargetA, \Model $TargetB)
    {
	   $this->beConstructedWith([$ModelA,$ModelB]);
	   
	   $ModelA->getDistance($TargetA)->willReturn(5);
	   $ModelA->getDistance($TargetB)->willReturn(3);
	   
	   $ModelB->getDistance($TargetA)->willReturn(2); 
	   $ModelB->getDistance($TargetB)->willReturn(6); 
	   
	   
    }
}
