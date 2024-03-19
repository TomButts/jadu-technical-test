# Work Log

1. Install symfony docker and get it working # 10 mins
2. Import the checker interface and create service with empty stubs # 5 mins
3. Install PHPUnit and Write basic unit tests - which at this point will fail # 10 mins
4. Add dataproviders to the unit tests to help test edge cases # 15 mins
5. Creating initial implementations of functions
    a. making simplest solution that passes all tests
    b. thinking about dataprovider test cases
    c. deciding if more requirements need to be captured and writing email with questions


At this point the minimum viable product has been achieved. No requirements were given in terms of optimisation, but we might as well make some speed improvements.
1. Writing stress tests
2. Further optimisation of algorithms
3. Thinking about possibility of caching common checks using redis
4. Thinking about next steps


Pangram
Palindrome
- Should the check be case insensitive

Anagram
- The interface comment defines the check to be on the letters of a phrase only. How do you wish to handle non alphabetical characters

Would you like a user interface? 'Implement the operations' sounds like this is purely a backend coding exercise so I thought I would check.