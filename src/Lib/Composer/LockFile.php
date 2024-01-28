<?php

declare(strict_types=1);

namespace Smeghead\PhpVendorCredits\Lib\Composer;

final class LockFile
{
    private \stdClass $object;

    public function __construct(string $content)
    {
        if (empty($content)) {
            throw new \Exception('empty content.');
        }
        $this->object = (object)json_decode($content, null, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @return array<Package>
     */
    public function getPackages(): array
    {
        $packages = [];
        foreach ($this->object->{'packages'} as $p) {
            $name = $p->name;
            $url = $p->homepage;
            $packages[] = new Package($name, $url);
        }
        return $packages;
    }
}

