<?php header('Content-Type: text/html; charset=utf-8');

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

    private FlagsGenerator $flagsGenerator;

    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->flagsGenerator = new FlagsGenerator();
    }

    public function testFlagsGeneration(): void
    {
        foreach (self::COUNTRY_FILES as $fileName) {
            self::assertFileExists("tests/countries/$fileName");
            [
                'countries' => $countries
            ] = json_decode(file_get_contents("tests/countries/$fileName"), true);

            foreach ($countries as $country) {
                self::assertNotNull(
                    $this->flagsGenerator->getEmojiFlagOrNull(strtolower($country['isoCode'])),
                    sprintf(
                        'Failed to generate emoji flag for isoCode:%s country:%s',
                        $country['isoCode'],
                        $country['name']
                    )
                );

                echo sprintf(
                    '%s%s  %s',
                    PHP_EOL,
                    $this->flagsGenerator->getEmojiFlagOrNull(strtolower($country['isoCode'])),
                    $country['name'],
                );
            }

            echo sprintf('%s%s',
                PHP_EOL,
                '----------------',
            );
        }
    }
}