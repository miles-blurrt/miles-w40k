<?php

class PhaseAssault extends Phase
{
	
	
	public function getUnitPhaseOption($Unit)
	{
		$PhaseOption = new PhaseOption('combatClose');
		if($Unit->canFire())
		{
			$PhaseOption->addOption('combatClose');
		}
		return($PhaseOption);
	}
	
	

}
