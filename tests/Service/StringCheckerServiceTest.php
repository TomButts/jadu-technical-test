<?php

namespace App\Tests\Service;

use App\Service\StringCheckerService;
use PHPUnit\Framework\TestCase;

class StringCheckerServiceTest extends TestCase
{
    private StringCheckerService $stringCheckerService;

    protected function setUp(): void
    {
        $this->stringCheckerService = new StringCheckerService();
    }

    /**
     * @dataProvider palindromeProvider
     */
    public function testIsPalindrome($word, $expected)
    {
        $this->assertEquals($expected, $this->stringCheckerService->isPalindrome($word));
    }

    /**
     * @dataProvider anagramProvider
     */
    public function testIsAnagram($word, $comparison, $expected)
    {
        $this->assertEquals($expected, $this->stringCheckerService->isAnagram($word, $comparison));
    }

    /**
     * @dataProvider pangramProvider
     */
    public function testIsPangram($phrase, $expected)
    {
        $this->assertEquals($expected, $this->stringCheckerService->isPangram($phrase));
    }

    /**
     * A palindrome is a word, phrase, number, or other sequence of characters
     * which reads the same backward or forward.
     *
     * @return void
     */
    public function palindromeProvider()
    {
        return [
            ["anna", true],
            ["Bark", false],
            ["level", true],
            ["deified", true],
            ["radar", true],
            ["racecar", true],
            ["raCecar", true],
            ["race\x00car", false],
            ["hello", false],
            ["World", false],
            ["\x00madam\x00", true], // any other sequence of characters
            ["civ vic", true],
            ["noon", true],
            ["stats", true],
            ["able was I ere I saw elba", true], // phrase
            ["A man, a plan, a canal, Panama!", false], // the commas aren't symmetrical
            ["Never odd or even", false], // spaces are not symetrical
            ["Able was I saw Elba", true], // case insensitive
            ["12321", true], // any other sequence of characters
        ];
    }

    /**
     * An anagram is the result of rearranging the letters of a word or phrase
     * to produce a new word or phrase, using all the original letters
     * exactly once.
     *
     * @return void
     */
    public function anagramProvider()
    {
        return [
            ["coalface", "cacao elf", true],
            ["coalface", "dark elf", false],
            ["listen", "silent", true],
            ["hello", "world", false],
            ["evil", "vile", true],
            ["listen", "silent", true],
            ["astronomer", "moon starer", true],
            ["clint eastwood", "old west action", true],
            ["debit card", "bad credit", true],
            ["dormitory", "dirty room", true],
            ["school master", "the classroom", true],
            ["listen", "slient", true],
            ["hello", "holle", true],
            ["restful", "fluster", true],
            ["rail safety", "fairy tales", true],
            ["conversation", "voices rant on", true],
            ["client eastwood", "old west action", false],
            ["ab", "ba", true],
        ];
    }

    /**
     * A Pangram for a given alphabet is a sentence using every letter of the
     * alphabet at least once.
     *
     * @return void
     */
    public function pangramProvider()
    {
        return [
            ["The quick brown fox jumps over the lazy dog", true],
            ["Pack my box with five dozen liquor jugs", true],
            ["The five boxing wizards jump quickly", true],
            ["Sphinx of black quartz, judge my vow", true],
            ["The quick brown fox jumps over the lazy cat", false],
            ["The British Broadcasting Corporation (BBC) is a British public service broadcaster.", false],
            ["Amazingly few discotheques provide jukeboxes", true],
            ["Waltz, nymph, for quick jigs vex Bud", true],
            ["Jackdaws love my big sphinx of quartz", true],
            ["How razorback-jumping frogs can level six piqued gymnasts!", true],
            ["He watched silently as the crows circled above", false],
            ["Quick zephyrs blow, vexing daft Jim", true],
            ["The quick brown fox jumps over the lazy badger", true],
            ["The jay, pig, fox, zebra, and my wolves quack!", true],
            ["Mr. Jock, TV quiz PhD, bags few lynx", true],
            ["The five boxing wizards jump quickly!", true],
        ];
    }

}
