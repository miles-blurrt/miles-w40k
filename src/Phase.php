<?php

class Phase
{
    public function __construct($Armies = [])
	{
		$this->Armies = $Armies;
		$this->setOptions();
	}
	public function setOptions()
	{
		foreach($this->Armies as $index=>$Army)
		{
			foreach($Army->getUnits() as $Unit)
			{
				$Unit->setOption($this->getUnitPhaseOption($Unit));
			}
		}
	}
}
