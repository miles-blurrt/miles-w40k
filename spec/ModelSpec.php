<?php

namespace spec;

use Model;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ModelSpec extends ObjectBehavior
{
    
    function it_calculates_distance_between_two_models()
    {
	    $this->setCoordinates(["x"=>1,"y"=>1,"z"=>1]);
	    $TargetModel = new Model();
	    $TargetModel->setCoordinates(["x"=>3,"y"=>1,"z"=>1]);
	    
	    $this->getDistance($TargetModel)->shouldReturn(2.0);
    }
    
    function it_picks_a_close_combat_weapon_and_sets_initiative_level_override(\WeaponBolter $WeaponBolter, \WeaponPowerfist $WeaponPowerfist)
    {
		$WeaponBolter = new \WeaponBolter;
		$WeaponPowerfist = new \WeaponPowerfist;
	    $this->beConstructedWith([],[$WeaponBolter,$WeaponPowerfist]);
	    $this->getCloseCombatinitiativeLevel()->shouldEqual(1);
    }
}
