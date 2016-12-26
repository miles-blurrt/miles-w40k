<?php

namespace spec;

use PhaseShooting;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PhaseShootingSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(PhaseShooting::class);
    }
    
    /*
    function it_resolves_hits(\Unit $FiringUnit, \RollingDice $RollingDice)
    {
	    $RollingDice->getRolls(6)->willReturn([4,2,5,1,6,3]);
	    $FiringUnit->unitShootingResult([4,2,5,1,6,3])->willReturn
	    (
		    [
			    'extra_shot' => 0,
			    'hit' => 3,
			    'miss' => 3
		    ]
	    );
	    
	    $this->getHitsCount($FiringUnit,$RollingDice,6)->shouldReturn(3);
    }
    */

    /*
    function let(\ModelInfantry $FiringModel, \WeaponBolter $FiringWeapon, \ModelInfantry $TargetModel)
   {
   		$this->beConstructedWith($FiringModel,$FiringWeapon,$TargetModel);
   }
   */
   /*
    function it_resolves_shooting_hits(\ModelInfantry $FiringModel, \WeaponBolter $FiringWeapon, \ModelInfantry $TargetModel)
    {
	    $FiringModel->getBallisticSkill()->willReturn(4);
	    $FiringWeapon->getShotsCount()->willReturn(1);
	    $FiringWeapon->getStrength()->willReturn(4);
	    $TargetModel->getAliveCount()->willReturn(8);
	    $TargetModel->getToughness()->willReturn(4);
	    $TargetModel->getArmourSave()->willReturn(6);
	    
		$expectedHitResult=
		[
			'extra_shot' => 0,
			'hit' => 1,
			'miss' => 1
		];
	    $this->resolveShotsToHitCount([4,1])->shouldReturn($expectedHitResult);
	    $this->resolveHitsToWoundCount([4])->shouldReturn(1);
	    
	    
	    $this->resolveWoundSaves([6,5])->shouldReturn(1);
	    
	    
    }
    
    function it_resolves_shooting_hits_with_extra_bs_shots(\ModelInfantry $FiringModel, \WeaponBolter $FiringWeapon, \ModelInfantry $TargetModel)
    {
	    $FiringModel->getBallisticSkill()->willReturn(7);
	    $FiringWeapon->getShotsCount()->willReturn(2);
	    $FiringWeapon->getStrength()->willReturn(4);
	    $TargetModel->getAliveCount()->willReturn(8);
	    $TargetModel->getToughness()->willReturn(4);
	    $TargetModel->getArmourSave()->willReturn(6);
	    
		$expectedHitResult=
		[
			'extra_shot' => 1,
			'hit' => 1,
			'miss' => 0
		];
	    $this->resolveShotsToHitCount([5,1])->shouldReturn($expectedHitResult);
	    $expectedHitResult=
		[
			'extra_shot' => 0,
			'hit' => 1,
			'miss' => 0
		];
		$this->resolveShotsToHitCount([5])->shouldReturn($expectedHitResult);
		
	    $this->resolveHitsToWoundCount([4,2])->shouldReturn(1);
	    
	    
    }
    */
}
