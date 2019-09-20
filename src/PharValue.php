<?php
declare(strict_types=1);

namespace N98\PhiveGenerator;

use N98\PhiveGenerator\ReleaseValue;

class PharValue
{
    /**
     * @var string
     */
    private $baseFileName;

    /**
     * @var array|\N98\PhiveGenerator\ReleaseValue[]
     */
    private $releases;

    /**
     * PharValue constructor.
     * @param string $baseFileName
     * @param \N98\PhiveGenerator\ReleaseValue[] $releases
     */
    public function __construct(string $baseFileName, array $releases)
    {
        $this->baseFileName = $baseFileName;
        $this->releases = $releases;
    }

    /**
     * @return string
     */
    public function getBaseFileName(): string
    {
        return $this->baseFileName;
    }

    /**
     * @return \N98\PhiveGenerator\ReleaseValue[]
     */
    public function getReleases()
    {
        return $this->releases;
    }
}
