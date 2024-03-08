<?php

declare(strict_types=1);

namespace Smeghead\PhpVendorCredits\Command;

use Smeghead\PhpVendorCredits\Lib\Usecase\CreditsUsecase;
use Smeghead\PhpVendorCredits\Lib\Usecase\License;

final class CreditsCommand
{
    private string $version;

    public function __construct(string $version)
    {
        $this->version = $version;
    }

    /**
     * @param array<string, string|bool> $options
     * @param array<string> $args
     */
    public function run(array $options, array $args): void
    {
        $usage =<<<EOU
usage: php-vendor-credits [OPTIONS] <project directory>

php-vendor-creadits creates CREDITS file from LICENSE files of dependencies

OPTIONS
  -h, --help                     show this help page.
  -v,-V, --version               show version.

EOU;

        if (isset($options['v']) || isset($options['V']) || isset($options['version'])) {
            fputs(STDERR, sprintf('php-vendor-creates %s%s', $this->version, PHP_EOL));
            exit(-1);
        }
        if (isset($options['h']) || isset($options['help'])) {
            fputs(STDERR, $usage);
            exit(-1);
        }

        /** @var string|null */
        $rootDirectory = array_shift($args);
        if (empty($rootDirectory)) {
            fputs(STDERR, "ERROR: required project directory.\n");
            exit(-1);
        }
        $usecase = new CreditsUsecase(strval($rootDirectory));
        $licenses = $usecase->execute();

        $format = <<<EOC
%s
%s
----------------------------------------------------------------
%s
================================================================

EOC;
        print(implode("\n", array_map(
            fn(License $l) => sprintf(
                $format,
                $l->getName(),
                $l->getUrl(),
                $l->getContent()
            ), $licenses)));

        return;
    }

}
