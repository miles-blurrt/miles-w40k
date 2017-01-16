<?php

class PhaseOption
{
	var $options = [];
	var $phaseName = "";
	public function __construct($phase="")
	{
		$this->phaseName = $phase;
	}
	
	
	
    public function addOption($action)
    {
	    $this->options[] = $action;
    }
    
	
    public function getOptions()
    {
        return($this->options);
    }
    
    /*
    public function removeOption($phase,$Unit)
    {
	    foreach($this->options[$phase] as $index=>$thisUnit)
		{
			if($Unit==$thisUnit)
				unset($this->options[$phase][$index]);
		}
		
	    
    }
    */
}
