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
    
    function let(\ModelInfantry $FiringModel, \WeaponBolter $FiringWeapon, \ModelInfantry $TargetModel)
   {
   		$this->beConstructedWith($FiringModel,$FiringWeapon,$TargetModel);
   }
   
    function it_resolves_shooting_hits(\ModelInfantry $FiringModel, \WeaponBolter $FiringWeapon, \ModelInfantry $TargetModel)
    {
	    $FiringModel->getBallisticSkill()->willReturn(4);
	    $FiringModel->getAliveCount()->willReturn(7);
	    $FiringWeapon->getStrength()->willReturn(4);
	    $TargetModel->getAliveCount()->willReturn(8);
	    $TargetModel->getToughness()->willReturn(4);
	    $TargetModel->getArmourSave()->willReturn(6);
	    
		
	    $this->resolveShotsToHitCount([3,1,3,6,5,5,4])->shouldReturn(6);
	    $this->resolveHitsToWoundCount([4,2,1,1,1,5])->shouldReturn(2);
	    /*
	    $this->resolveWoundSaves([])->shouldReturn(0);
	    
	    $this->getShootingResult()->shouldReturn
	    (
		    [
			    'models_killed' => 6
		    ]
		);
	    */
    }
}
