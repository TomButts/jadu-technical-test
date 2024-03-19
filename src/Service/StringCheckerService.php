<?php

namespace App\Service;

use App\Interface\CheckerInterface;

class StringCheckerService implements CheckerInterface
{
    /**
     * Check if a $word is a palindrome.
     *
     * @param string $word
     *
     * @return boolean
     */
    public function isPalindrome(string $word): bool
    {
        if (strtolower(strrev($word)) === strtolower($word)) {
            return true;
        }

        return false;
    }

    /**
     * Check if a word is an anagram of another word.
     *
     * @param string $word
     * @param string $comparison
     *
     * @return boolean
     */
    public function isAnagram(string $word, string $comparison): bool
    {
        $sortedWord = $this->getLetterArray($word);
        $sortedComparison = $this->getLetterArray($comparison);

        sort($sortedWord);
        sort($sortedComparison);

        return $sortedWord === $sortedComparison;
    }

    /**
     * Check if a string contains all letters of the alphabet.
     *
     * @param string $phrase
     *
     * @return boolean
     */
    public function isPangram(string $phrase): bool
    {
        $alphabetArray = range('a', 'z');

        $phrase = strtolower($phrase);

        foreach ($alphabetArray as $letter) {
            if (strpos($phrase, $letter) === false) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get an array of letters in a string.
     *
     * Make lower case to aid comparison and replace spaces.
     *
     * @return void
     */
    protected function getLetterArray(string $string): array
    {
        return str_split(strtolower(str_replace(' ', '', $string)));
    }
}