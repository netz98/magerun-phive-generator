<?php
/**
 * @copyright Copyright (c) 1999-2018 netz98 GmbH (http://www.netz98.de)
 *
 * @see PROJECT_LICENSE.txt
 */

namespace N98\PhiveGenerator;

class PhiveXmlDocument extends \DOMDocument
{
    /**
     * @var \DOMElement
     */
    private $repositoryElement;

    public function __construct()
    {
        parent::__construct('1.0', 'UTF-8');

        $this->preserveWhiteSpace = true;
        $this->formatOutput = true;

        $repositoryElement = $this->createElementNS(
            'https://phar.io/repository',
            'repository'
        );

        $repositoryElement->setAttribute(
            'xmlns:xsi',
            'http://www.w3.org/2001/xmlschema-instance'
        );

        $repositoryElement->setAttribute(
            'xsi:schemaLocation',
            'https://phar.io/repository https://phar.io/data/repository.xsd'
        );

        $this->repositoryElement = $repositoryElement;
        $this->appendChild($this->repositoryElement);

    }

    public function addPhar(PharValue $pharValue)
    {
        $pharElement = $this->createElement('phar');
        $pharElement->setAttribute('name', $pharValue->getBaseFileName());
        $this->repositoryElement->appendChild($pharElement);

        foreach ($pharValue->getReleases() as $release) {
            /** @var \DOMElement $releaseElement */
            $releaseElement = $this->createElement('release');
            $releaseElement->setAttribute('version', $release->getVersion());
            $releaseElement->setAttribute('url', $release->getUrl());

            $signatureElement = $this->createElement('signature');
            $signatureElement->setAttribute('type', 'gpg');
            $releaseElement->appendChild($signatureElement);

            $hashElement = $this->createElement('hash');
            $hashElement->setAttribute('type', 'sha-256');
            $hashElement->setAttribute('value', $release->getSha256());
            $releaseElement->appendChild($hashElement);

            $pharElement->appendChild($releaseElement);
        }
    }
}

