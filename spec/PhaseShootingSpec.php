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
    
    
    
    */
}
