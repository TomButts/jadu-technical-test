<?php

namespace App\Tests\Unit\Service;

use App\Service\StringCheckerService;
use PHPUnit\Framework\TestCase;

class StringCheckerServiceUnitTest extends TestCase
{
    private StringCheckerService $stringCheckerService;

    protected function setUp(): void
    {
        $this->stringCheckerService = new StringCheckerService();
    }

    /**
     * @dataProvider palindromeProvider
     */
    public function testItChecksPalindromeCorrectly(string $word, bool $expected): void
    {
        $this->assertEquals($expected, $this->stringCheckerService->isPalindrome($word));
    }

    /**
     * @dataProvider anagramProvider
     */
    public function testItChecksAnagramCorrectly(string $word, string $comparison, bool $expected): void
    {
        $this->assertEquals($expected, $this->stringCheckerService->isAnagram($word, $comparison));
    }

    /**
     * @dataProvider pangramProvider
     */
    public function testItChecksPangramCorrectly(string $phrase, bool $expected): void
    {
        $this->assertEquals($expected, $this->stringCheckerService->isPangram($phrase));
    }

    /**
     * A palindrome is a word, phrase, number, or other sequence of characters
     * which reads the same backward or forward.
     *
     * @return array
     */
    public function palindromeProvider(): array
    {
        return [
            'Palindrome: anna' => ['anna', true],
            'Palindrome: level' => ['level', true],
            'Palindrome: deified' => ['deified', true],
            'Palindrome: radar' => ['radar', true],
            'Palindrome: racecar' => ['racecar', true],
            'Palindrome: noon' => ['noon', true],
            'Palindrome: stats' => ['stats', true],
            'Not a palindrome: Bark' => ['Bark', false],
            'Not a palindrome: hello' => ['hello', false],
            'Not a palindrome: World' => ['World', false],
            'Case insensitive: raCecar' => ['raCecar', true],
            'Special chars: race\x00car' => ['race\x00car', false],
            'Special chars: \x00madam\x00' => ["\x00madam\x00", true],
            'Special chars: 12321' => ['12321', true],
            'Phrase: civ vic' => ['civ vic', true],
            'Phrase: able was I ere I saw elba' => ['able was I ere I saw elba', true],
            'Phrase: A man, a plan, a canal, Panama!' => ['A man, a plan, a canal, Panama!', false],
            'Phrase: Never odd or even' => ['Never odd or even', false],
            'Phrase: Able was I saw Elba' => ['Able was I saw Elba', true],
        ];
    }

    /**
     * An anagram is the result of rearranging the letters of a word or phrase
     * to produce a new word or phrase, using all the original letters
     * exactly once.
     *
     * @return array
     */
    public function anagramProvider(): array
    {
        return [
            ['coalface', 'cacao elf', true],
            ['coalface', 'dark elf', false],
            ['listen', 'silent', true],
            ['hello', 'world', false],
            ['evil', 'vile', true],
            ['listen', 'silent', true],
            ['astronomer', 'moon starer', true],
            ['clint eastwood', 'old west action', true],
            ['debit card', 'bad credit', true],
            ['dormitory', 'dirty room', true],
            ['school master', 'the classroom', true],
            ['listen', 'slient', true],
            ['hello', 'holle', true],
            ['restful', 'fluster', true],
            ['rail safety', 'fairy tales', true],
            ['conversation', 'voices rant on', true],
            ['client eastwood', 'old west action', false],
            ['ab', 'ba', true],
        ];
    }

    /**
     * A Pangram for a given alphabet is a sentence using every letter of the
     * alphabet at least once.
     *
     * @return array
     */
    public function pangramProvider(): array
    {
        return [
            ['The quick brown fox jumps over the lazy dog', true],
            ['Pack my box with five dozen liquor jugs', true],
            ['The five boxing wizards jump quickly', true],
            ['Sphinx of black quartz, judge my vow', true],
            ['The quick brown fox jumps over the lazy cat', false],
            ['The British Broadcasting Corporation (BBC) is a British public service broadcaster.', false],
            ['Amazingly few discotheques provide jukeboxes', true],
            ['Waltz, nymph, for quick jigs vex Bud', true],
            ['Jackdaws love my big sphinx of quartz', true],
            ['How razorback-jumping frogs can level six piqued gymnasts!', true],
            ['He watched silently as the crows circled above', false],
            ['Quick zephyrs blow, vexing daft Jim', true],
            ['The quick brown fox jumps over the lazy badger', true],
            ['The jay, pig, fox, zebra, and my wolves quack!', true],
            ['Mr. Jock, TV quiz PhD, bags few lynx', true],
            ['The five boxing wizards jump quickly!', true],
        ];
    }

}
