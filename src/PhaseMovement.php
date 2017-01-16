<?php

class PhaseMovement extends Phase
{
    public function getUnitPhaseOption($Unit)
	{
		$PhaseOption = new PhaseOption('movement');
		if($Unit->canMove())
		{
			$PhaseOption->addOption('move');
		}
		return($PhaseOption);
	}
	
	public function performAction($Unit)
	{
		
		
	}
}
