<?php

namespace spec;

use TurnOption;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TurnOptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(TurnOption::class);
    }
    
    function it_can_add_options()
    {
	    $UnitA = new \Unit();
	    $UnitB = new \Unit();
	    $this->addOption('shooting',$UnitA);
	    $this->addOption('shooting',$UnitB);
	    $this->addOption('assault',$UnitA);
	    $this->addOption('assault',$UnitB);
	    $this->addOption('shooting',$UnitB);
	    
	    $this->getOptions('assault')->shouldReturn([$UnitA,$UnitB]);
    }
    
    function it_can_remove_options()
    {
	    $UnitA = new \Unit();
	    $UnitB = new \Unit();
	    $UnitC = new \Unit();
	    $this->addOption('shooting',$UnitA);
	    $this->addOption('shooting',$UnitB);
	    $this->addOption('shooting',$UnitC);
	    
	    $this->getOptions('shooting')->shouldHaveCount(3);
	    
	    $this->removeOption('shooting',$UnitB);
	    $this->getOptions('shooting')->shouldHaveCount(2);
    }
    
    
}
