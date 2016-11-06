<?php

namespace Chrl\AppBundle\Command;

use Wrep\Daemonizable\Command\EndlessCommand;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;

class QuestionAskerCommand extends EndlessCommand
{
    // This is just a normal Command::configure() method
    protected function configure()
    {
        $this->setName('buktopuha:questionbot')
                ->setDescription('Endless process that monitors time and asks questions')
                ->setTimeout(1);
    }

    // Execute will be called in a endless loop
    protected function execute(InputInterface $input, OutputInterface $output)
    {
    }
}
