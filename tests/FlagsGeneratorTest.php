<?php
header('Content-Type: text/html; charset=utf-8');
use PHPUnit\Framework\TestCase;

class FlagsGeneratorTest extends TestCase
{
    public function testAdd()
    {
        $calculator = new \Rteeom\FlagsGenerator();

        self::assertFileExists('tests/countries/africa.json');
        ['countries' => $countries] = json_decode(file_get_contents('tests/countries/africa.json'), true);
        foreach ($countries as $country) {
            self::assertNotNull($calculator->getEmojiFlagOrNull(strtolower($country['isoCode'])), "failed for " . $country['isoCode'] . $country['name']);
            echo PHP_EOL . $country['name'] . $calculator->getEmojiFlagOrNull(strtolower($country['isoCode']));
        }
    }
}