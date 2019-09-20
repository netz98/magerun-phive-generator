<?php
declare(strict_types=1);

namespace N98\PhiveGenerator;

use Composer\Semver\VersionParser;
use Traversable;

class ReleaseCollection implements \IteratorAggregate
{
    /**
     * @var ReleaseValue[]
     */
    private $releases;

    /**
     * @param string $baseDirectory
     */
    public function __construct($baseDirectory, $pharBaseUrl)
    {
        $this->releases = [];

        foreach (new \GlobIterator($baseDirectory . '/*.phar') as $file) {
            /** @var \SplFileInfo $file */

            $url = rtrim($pharBaseUrl, '/') . '/' . $file->getBasename();

            if (!preg_match('/-(\d+\.\d+\.\d+)/', $file->getBasename(), $matches)) {
                continue;
            }

            $releaseName = substr($file->getBasename(), 0, strpos($file->getBasename(), $matches[1]) - 1);

            $this->releases[] = new ReleaseValue(
                $releaseName,
                $matches[1],
                $url,
                \hash_file('sha256', $file->getPathname())
            );
        }
    }

    /**
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator()
    {
        return new \ArrayObject($this->releases);
    }
}
