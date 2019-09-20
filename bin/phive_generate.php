<?php

use N98\PhiveGenerator\PharValue;
use N98\PhiveGenerator\PhiveXmlDocument;
use N98\PhiveGenerator\ReleaseCollection;
use Symfony\Component\Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/../.env');

$releaseCollection = new ReleaseCollection(
    getenv('PHAR_BASEDIR'),
    getenv('PHAR_BASEURL')
);

$pharReleaseGroup = [];

/** @var \N98\PhiveGenerator\ReleaseValue $release */
foreach ($releaseCollection as $release) {
    $pharReleaseGroup[$release->getName()][] = $release;
}

$xmlDocument = new PhiveXmlDocument();

foreach ($pharReleaseGroup as $pharName => $releases) {
    $xmlDocument->addPhar(
        new PharValue($pharName, $releases)
    );
}

echo $xmlDocument->saveXML();
