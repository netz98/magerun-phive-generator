<?php
declare(strict_types=1);

namespace N98\PhiveGenerator;

class ReleaseValue
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $version;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $sha256;

    public function __construct(string $name, string $version, string $url, string $sha256)
    {
        $this->name = $name;
        $this->version = $version;
        $this->url = $url;
        $this->sha256 = $sha256;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getSha256(): string
    {
        return $this->sha256;
    }
}
