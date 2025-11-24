<?php

namespace App\Command;

use App\Entity\User;
use App\Repository\Interface\IHouseVisitRepository;
use Carbon\Carbon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

#[AsCommand(
    name: 'app:test',
    description: 'Add a short description for your command',
)]
class TestCommand extends Command
{
    public function __construct(
        protected TranslatorInterface $translator
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        Carbon::setLocale("cs");
        $months = [];
        $date = Carbon::create(null, 1, 1);
        for ($i = 1; $i <= 12; $i++) {
            $monthName = $date->getTranslatedMonthName();
            $months[$i] = $monthName;
            $date->addMonth();
        }

        dump($months);


        return Command::SUCCESS;
    }
}
