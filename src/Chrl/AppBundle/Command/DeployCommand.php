<?php

namespace Chrl\AppBundle\Command;

use Chrl\AppBundle\Entity\Game;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;

class DeployCommand extends ContainerAwareCommand
{
    // This is just a normal Command::configure() method
    protected function configure()
    {
        $this->setName('buktopuha:deploy')
                ->setDescription('Tell all active games about deploy')
                ->setDefinition(
                    new InputDefinition(
                        [
                            new InputOption('success')
                        ]
                    )
                );
    }

    // Execute will be called in a endless loop
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Executing...');

        $gs = $this->getContainer()->get('app.gameservice');
        $tgApi = $this->getContainer()->get('buktopuha.telegram_bot_api');
        $games = $gs->getActiveGames();

        if (false == $input->getOption('success')) {
            if (file_exists('var/logs/deploy.version')) {
                $version = file_get_contents('var/logs/deploy.version');
            } else {
                $version = 0;
                file_put_contents('var/logs/deploy.version', $version);
            }

            $version++;
            file_put_contents('var/logs/deploy.version', $version);
        }
        
        /** @var Game $game */
        foreach ($games as $game) {
            if ($input->getOption('success')) {
                $tgApi->sendMessage(
                    $game->chatId,
                    'Bot is back online (updated to build '.$version.')! The game continues...'
                );
            } else {
                $tgApi->sendMessage(
                    $game->chatId,
                    'Bot rebooting due to deploy (build '.$version
                    .'), sorry. The game will continue once bot boots again.'
                );
            }
        }
    }
}
