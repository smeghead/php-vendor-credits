<?php

declare(strict_types=1);

namespace Smeghead\PhpVendorCredits\Lib\Composer;

final class JsonFile
{
    private \stdClass $object;

    public function __construct(string $content)
    {
        if (empty($content)) {
            throw new \Exception('empty content.');
        }
        $this->object = (object)json_decode($content, null, 512, JSON_THROW_ON_ERROR);
    }

    public function getVendorPath(): string
    {
        $result = 'vendor';
        if (!property_exists($this->object, 'config')) {
            return $result;
        }
        if (!property_exists($this->object->config, 'vendor-dir')) {
            return $result;
        }
        return strval($this->object->config->{'vendor-dir'});
    }
}

