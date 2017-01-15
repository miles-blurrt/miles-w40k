<?php

class TurnOption
{
	var $options = [];
	
	
    public function addOption($phase, $thisUnit)
    {
	    $this->options[$phase][] = $thisUnit;
    }

    public function getOptions($phase)
    {
        return($this->options[$phase]);
    }
    
    public function removeOption($phase,$Unit)
    {
	    foreach($this->options[$phase] as $index=>$thisUnit)
		{
			if($Unit==$thisUnit)
				unset($this->options[$phase][$index]);
		}
		
	    
    }
}
