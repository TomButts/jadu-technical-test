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
        $sortedWord = $this->filterSpacesAndSplitString($word);
        $sortedComparison = $this->filterSpacesAndSplitString($comparison);

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
        $phrase = strtolower($phrase);

        foreach ($this->getOrderedAlphabetArray() as $letter) {
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
    protected function filterSpacesAndSplitString(string $string): array
    {
        return str_split(strtolower(str_replace(' ', '', $string)));
    }

    /**
     * Alphabet array ordered by least common letters first.
     *
     * @return array
     */
    protected function getOrderedAlphabetArray(): array
    {
        return [
            'z', 'q', 'x', 'j', 'k', 'v', 'b', 'p', 'y', 'g', 'f', 'w', 'm', 'u', 'c', 'l', 'd', 'r', 'h', 's', 'n', 'i', 'o', 'a', 't', 'e'
        ];
    }
}