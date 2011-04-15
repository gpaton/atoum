<?php

namespace mageekguy\atoum\writers;

use
	mageekguy\atoum,
	mageekguy\atoum\reports,
	mageekguy\atoum\exceptions,
	mageekguy\atoum\report\writers
;

abstract class std extends atoum\writer implements writers\realtime, writers\asynchronous
{
	protected $resource = null;

	public function __destruct()
	{
		if ($this->resource !== null)
		{
			$this->adapter->fclose($this->resource);
		}
	}

	public function write($something)
	{
		$this->getResource()->adapter->fwrite($this->resource, $something);

		return $this;
	}

	public function realtimeWrite(reports\realtime $report)
	{
		return $this->write((string) $report);
	}

	public function asynchronousWrite(reports\asynchronous $report)
	{
		return $this->write((string) $report);
	}

	protected abstract function getResource();
}

?>
