<?php

namespace App\Command;

use App\Service\StorageService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:store-items')]
class StoreItemsCommand extends Command
{
    public function __construct(private readonly StorageService $storageService, string $name = null)
    {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            // the command description shown when running "php bin/console list"
            ->setDescription('Handle request.json and store items to database')
            // the command help shown when running the command with the "--help" option
            ->setHelp('This command allows you to store items from request.json file')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->write('Start processing items...');
        $this->storageService->setItems();
        $output->write('Items processed successfully.');

        return Command::SUCCESS;
    }
}
