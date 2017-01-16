<?php

class PhaseShooting extends Phase
{
	
	
	public function getUnitPhaseOption($Unit)
	{
		$PhaseOption = new PhaseOption('combatRanged');
		if($Unit->canFire())
		{
			$PhaseOption->addOption('combatRanged');
		}
		return($PhaseOption);
	}
	
	

}
