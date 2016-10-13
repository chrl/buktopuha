<?php
namespace Buktopuha;

use Rocketeer\Abstracts\Strategies\AbstractStrategy;
use Rocketeer\Interfaces\Strategies\MigrateStrategyInterface;

class DoctrineSchemaUpdateStrategy extends AbstractStrategy implements MigrateStrategyInterface
{
	public function migrate()
	{
		return $this->binary('bin/console')->runForCurrentRelease('doctrine:schema:update');
	}

	public function seed()
	{
		return true;
	}
}