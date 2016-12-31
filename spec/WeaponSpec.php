<?php

namespace spec;

use Weapon;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WeaponSpec extends ObjectBehavior
{
    function it_resolves_weapon_priority()
    {
	    
	    $WeaponA = new Weapon();
	    $WeaponA->setPriority(5);
	    
	    $WeaponB = new Weapon();
	    $WeaponB->setPriority(7);
	    
	    $WeaponC = new Weapon();
	    $WeaponC->setPriority(3);
	    
	    self::getPrimary([$WeaponA,$WeaponB,$WeaponC])->shouldEqual($WeaponB);
    }
    
    function it_builds_a_weapon_from_params()
    {
	    $params = 
	    [
		   'strength' => 2,
		   'id' => 'bolter'
	    ];
	    $this->beConstructedWith($params);
	    
	    $this->getStrength()->shouldEqual(2);
    }
}
