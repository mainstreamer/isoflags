<?php declare(strict_types=1);
header('Content-Type: text/html; charset=utf-8');

use PHPUnit\Framework\TestCase;
use Rteeom\FlagsGenerator\CountryCodeValidator;
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
    private CountryCodeValidator $validator;

    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->flagsGenerator = new FlagsGenerator();
        $this->validator = new CountryCodeValidator();
    }

    public function testFlagsGeneration(): void
    {
        foreach (self::COUNTRY_FILES as $fileName) {
            self::assertFileExists("tests/countries/$fileName");
            ['countries' => $countries] = json_decode(file_get_contents("tests/countries/$fileName"), true);

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
                    '%s%s  %s %s',
                    PHP_EOL,
                    $country['isoCode'],
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

    public function testGetAllAvailableCodes(): void
    {
        self::assertNotEmpty(FlagsGenerator::getAvailableCodes());
        foreach (FlagsGenerator::getAvailableCodes() as $code) {
            self::assertTrue($this->validator->isValid($code));
        }
    }
}
