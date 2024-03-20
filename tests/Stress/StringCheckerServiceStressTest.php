<?php

namespace App\Tests\Unit\Service;

use App\Service\StringCheckerService;
use Generator;
use PHPUnit\Framework\TestCase;

/**
 * Test the string service using predefined set dictionaries.
 *
 * No assertions are needed, logic is tested in the unit tests. This class focusses on timings in relation to a set group of data.
 *
 * This is a separate file to the unit tests making it easier to ignore in pipelines going forward.
 */
class StringCheckerServiceStressTest extends TestCase
{
    private StringCheckerService $stringChecker;
    private string $wordDictionaryPath = '/app/tests/Stress/dictionary/word-dictionary.csv';
    private string $phraseDictionaryPath = '/app/tests/Stress/dictionary/phrase-dictionary.csv';

    protected function setUp(): void
    {
        $this->stringChecker = new StringCheckerService();
    }

    /**
     * @group benchmarks
     */
    public function testIsPalindromeTimings()
    {
        $words = $this->readDictionaryCsv($this->wordDictionaryPath);

        $startTime = microtime(true);

        foreach ($words as $word) {
            $this->stringChecker->isPalindrome($word);
        }

        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;

        echo sprintf('Palindrome execution: %.6f %s', $executionTime, PHP_EOL);
    }

    /**
     * @group benchmarks
     */
    public function testIsAnagramTimings()
    {
        $words = $this->readDictionaryCsv($this->wordDictionaryPath); // Read phrases from the dictionary

        $comparison = 'last word';

        $startTime = microtime(true);

        foreach ($words as $word) {
            $this->stringChecker->isAnagram($word, $comparison);

            $comparison = $word;
        }

        $endTime = microtime(true);

        $executionTime = $endTime - $startTime;

        echo sprintf('Anagram execution: %.6f %s', $executionTime, PHP_EOL);
    }

    /**
     * @group benchmarks
     */
    public function testIsPangramTimings()
    {
        $phrases = $this->readDictionaryCsv($this->phraseDictionaryPath);

        $startTime = microtime(true);

        foreach ($phrases as $phrase) {
            $this->stringChecker->isPangram($phrase);
        }

        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;

        echo sprintf('Pangram execution: %.6f %s', $executionTime, PHP_EOL);
    }

    /**
     * Read the CSV dictionary file and return a generator for each row.
     *
     * @param string $absolutePath
     *
     * @return Generator
     */
    private function readDictionaryCsv(string $absolutePath): Generator
    {
        $csvFile = fopen($absolutePath, 'r');

        while (($line = fgetcsv($csvFile)) !== false) {
            yield $line[0];
        }

        fclose($csvFile);
    }
}
