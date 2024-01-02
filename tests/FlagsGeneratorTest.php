<?php
header('Content-Type: text/html; charset=utf-8');
use PHPUnit\Framework\TestCase;
use Rteeom\FlagsGenerator\FlagsGenerator;

class FlagsGeneratorTest extends TestCase
{
    private const COUNTRY_FILES = [
        'africa.json',
        'americas.json',
        'asia.json',
        'europe.json',
        'oceania.json',
    ];

    public function testAdd()
    {
        $generator = new FlagsGenerator();
        foreach (self::COUNTRY_FILES as $fileName) {
            self::assertFileExists("tests/countries/$fileName");
            ['countries' => $countries] = json_decode(file_get_contents("tests/countries/$fileName"), true);
            foreach ($countries as $country) {
                self::assertNotNull($generator->getEmojiFlagOrNull(strtolower($country['isoCode'])), "failed for " . $country['isoCode'] . $country['name']);
                echo PHP_EOL . $country['name'] . $generator->getEmojiFlagOrNull(strtolower($country['isoCode']));
            }
        }
    }
}