<?php

declare(strict_types=1);

namespace Smeghead\PhpVendorCredits\Command;

use Smeghead\PhpVendorCredits\Lib\Usecase\CreditsUsecase;
use Smeghead\PhpVendorCredits\Lib\Usecase\License;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CreditsCommand extends Command
{
    protected static $defaultName = 'credits';

    protected function configure(): void
    {
        $this
            ->setDescription('php-vendor-creadits creates CREDITS file from LICENSE files of dependencies')
            ->addArgument('project directory', InputArgument::REQUIRED, 'Specify the directory where `composer.lock` exists.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var string|null */
        $rootDirectory = $input->getArgument('project directory');
        $usecase = new CreditsUsecase(strval($rootDirectory));
        $licenses = $usecase->execute();

        $format = <<<EOC
%s
%s
----------------------------------------------------------------
%s
================================================================

EOC;
        $output->write(implode("\n", array_map(
            fn(License $l) => sprintf(
                $format,
                $l->getName(),
                $l->getUrl(),
                $l->getContent()
            ), $licenses)));

        return Command::SUCCESS;
    }

}