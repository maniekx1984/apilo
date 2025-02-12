<?php

namespace App\Command;

use App\Service\FetchDataFromInpost;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Serializer\SerializerInterface;

#[AsCommand(
    name: 'inpost:fetch-data',
    description: 'Add a short description for your command',
)]
class InpostFetchDataCommand extends Command
{
    private FetchDataFromInpost $fetchDataService;

    private SerializerInterface $serializer;

    public function __construct(
        FetchDataFromInpost $fetchDataService,
        SerializerInterface $serializer,
    )
    {
        parent::__construct();
        $this->fetchDataService = $fetchDataService;
        $this->serializer = $serializer;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('scope', InputArgument::REQUIRED, 'Scope')
            ->addArgument('city', InputArgument::REQUIRED, 'City')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $scope = $input->getArgument('scope');
        $city = $input->getArgument('city');

        try {
            $data = $this->fetchDataService->fetchData($scope, $city);
            $io->note($this->serializer->serialize($data, 'json'));

            return Command::SUCCESS;
        } catch (\DomainException|\Exception $exception) {
            $io->error($exception->getMessage());

            return Command::FAILURE;
        }
    }
}
