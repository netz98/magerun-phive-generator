<?php

namespace N98\PhiveGenerator;

use PHPUnit\Framework\TestCase;

class PhiveXmlFileGeneratorTest extends TestCase
{
    /**
     * @var \N98\PhiveGenerator\PhiveXmlDocument
     */
    private $sut;

    protected function setUp()
    {
        $this->sut = new PhiveXmlDocument();
    }

    /**
     * @test
     */
    public function itShouldGenerateAnEmptyXmlNode()
    {
        $xml = $this->sut->saveXML();

        $this->assertXmlStringEqualsXmlFile(__DIR__ . '/_files/itShouldGenerateAnEmptyXmlNode.xml', $xml);
    }

    /**
     * @test
     */
    public function itShouldRenderAPharRepository()
    {
        $releases = [
            new ReleaseValue(
                'n98-magerun2.phar',
                '1.100.0',
                'https://example.com/n98-magerun2-1.100.0.phar',
                '9df3a015dd2efc8f7a3f90c1c3934f0241e8db350028690f2a4f3d9ed5ead047'
            )
        ];
        $pharValue = new PharValue('n98-magerun2.phar', $releases);
        $this->sut->addPhar($pharValue);

        $xml = $this->sut->saveXML();

        $this->assertXmlStringEqualsXmlFile(__DIR__ . '/_files/itShouldRenderAPharRepository.xml', $xml);
    }
}
