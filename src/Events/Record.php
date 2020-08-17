<?php declare(strict_types=1);
namespace App\Events;

use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;

class Record {

    public function handle(EventDispatcher $dispatcher) {
        $dispatcher->addListener(ConsoleEvents::COMMAND, function (ConsoleCommandEvent $event) {
            $input = $event->getInput();
            $command = $event->getCommand();
            $commandName = $command->getName();

            writeLog(sprintf("%s：%s\n",date('Y-m-d H:i:s'),json_encode([
                "options" => $input->getOptions(),
                "args" => $input->getArguments(),
                "cmd_name" => $commandName])), APP_PATH.'/runtime/logs/cmd.log');
        });
    }
}
