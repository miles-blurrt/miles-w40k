<?php

class PhaseDeployment extends Phase
{
	
	
	public function getUnitPhaseOption($Unit)
	{
		$PhaseOption = new PhaseOption('deployment');
		if(!($Unit->arrivingAsReserve()))
		{
			$PhaseOption->addOption('deploy');
		}
		return($PhaseOption);
	}
	
	public function performAction($Unit)
	{
		$Unit->enterBattleSpace();
	}
}
