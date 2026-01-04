<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Rteeom\FlagsGenerator\CountryCodeValidator;
use Rteeom\FlagsGenerator\Enums\CodeSet;
use Rteeom\FlagsGenerator\FlagsGenerator;

class FlagsGeneratorTest extends TestCase
{
    private const array FILES_MAP = [
        CodeSet::ISO3166->name => [
            'africa.json', 'americas.json', 'asia.json', 'europe.json', 'oceania.json'
        ],
        CodeSet::EXTENDED->name => [
            'africa_extended.json',
            'americas.json',
            'asia_extended.json',
            'europe_extended.json',
            'oceania.json',
        ],
    ];

    private FlagsGenerator $sut;

    public function setUp(): void
    {
        $this->sut = new FlagsGenerator();
    }

    /** @dataProvider extendedCodesDataProvider */
    /** @dataProvider isoCodesDataProvider */
    public function test_flags_are_generated(string $isoCode, CodeSet $codeSet): void
    {
        $this->assertNotNull(FlagsGenerator::getFlagOrNull($isoCode, $codeSet));
        $this->assertNotNull($this->sut->getEmojiFlagOrNull($isoCode, $codeSet));
    }

    /** @dataProvider codeSetDataProvider */
    public function test_GetAllAvailableCodes_returns_result(CodeSet $codeSet): void
    {
        $codes = FlagsGenerator::getAvailableCodes($codeSet);
        $this->assertIsArray($codes);
        $this->assertNotEmpty($codes, "Empty available codes for {$codeSet->name}");

        foreach ($codes as $code) {
            self::assertTrue(CountryCodeValidator::isValidCountryCode($code, $codeSet));
        }
    }

    public static function codeSetDataProvider(): Generator
    {
        yield CodeSet::ISO3166->name => [CodeSet::ISO3166];
        yield CodeSet::EXTENDED->name => [CodeSet::EXTENDED];
    }

    /**
     * @throws JsonException
     */
    public static function isoCodesDataProvider(): Generator
    {
        foreach (self::FILES_MAP[CodeSet::ISO3166->name] as $fileName) {
            $countries = self::loadFromJson($fileName);
            foreach ($countries as $country) {
                yield CodeSet::ISO3166->name . $country['isoCode'] => [strtolower($country['isoCode']), CodeSet::ISO3166];
            }
        }
    }

    /**
     * @throws JsonException
     */
    private static function loadFromJson(string $fileName): array
    {
        $path = __DIR__ . "/resources/" . $fileName;
        if (!file_exists($path)) {
            throw new RuntimeException("Resource missing: $fileName");
        }

        return json_decode(
            json: file_get_contents($path),
            associative: true,
            flags: JSON_THROW_ON_ERROR,
        );
    }

    /**
     * @throws JsonException
     */
    public static function extendedCodesDataProvider(): Generator
    {
        foreach (self::FILES_MAP[CodeSet::EXTENDED->name] as $fileName) {
            $countries = self::loadFromJson($fileName);
            foreach ($countries as $country) {
                yield CodeSet::EXTENDED->name . $country['isoCode'] => [strtolower($country['isoCode']), CodeSet::EXTENDED];
            }
        }
    }

    public function test_invalid_code_returns_null(): void
    {
        $this->assertNull(FlagsGenerator::getFlagOrNull('AA'));
        $this->assertNull(FlagsGenerator::getFlagOrNull('123'));
    }

    /**
     * @throws JsonException
     * @dataProvider codeSetDataProvider
     */
    public function test_available_codes_count_matches_json_source(CodeSet $codeSet): void
    {
        $jsonFiles = self::FILES_MAP[$codeSet->name];
        $totalJsonEntries = 0;
        foreach ($jsonFiles as $file) {
            $totalJsonEntries += count(self::loadFromJson($file));
        }

        $generatedCodes = FlagsGenerator::getAvailableCodes($codeSet);

        $this->assertCount(
            $totalJsonEntries,
            $generatedCodes,
            "JSON entries: $totalJsonEntries. ENUM entries: " . count($generatedCodes)
        );
    }
}
