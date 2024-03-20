# Work Log

### 19/03/2024
1. Install symfony docker and get it working # 10m
2. Import the checker interface and create service with empty stubs # 5m
3. Install PHPUnit and Write basic unit tests - which at this point will fail # 10m
4. Add dataproviders to the unit tests to help test edge cases # 15m
5. Creating initial implementations of functions # 1h30m
    a. making simplest solution that passes all tests
    b. thinking about dataprovider test cases
    c. deciding if more requirements need to be captured and writing email with questions
6. Updating instructions mark down

Total: 2h10m

Taking a break at this point. Possibly a minimum viable product has been achieved depending on answers to email. No requirements were given in terms of optimisation, but next session will be looking at ways to improve the speed and make sure code quality is high.

Todo next session
-----------------
* Writing stress tests to obtain timings
* Further optimisation of algorithms
* Thinking about possibility of caching common checks using redis
* Thinking about next steps

### 20/03/2024

1. Writing stress tests and obtaining initial benchmarks #40m

Both the palidrome and anagram solvers are fast. Probably no need for optimisation given no mention of performance in the spec.

palindromeBenchMark = ~0.098;
anagramBenchMark = ~0.23;
pangramBenchMark = ~0.58;

2. Trying to improve pangram speed
    a. test 1 - lookup array by key - 0.644220,0.627844,0.644414 - Surpsingly this is actually slower. #25m
    b. test 2 - trying to use an in memory array instead of range() with letters in order or most commly used
    Found that it is slightly quicker, but also the order doesn't matter. Ordering by least common first also was quicker
    indicating the improvement was eliminating range() # 15m

Cutting optimisation phase here, to focus on delivering command line app and good installation documentation.

4. Create command line app to run checkers #1h20m

php bin/console app:string-checker anagram "string one" "string two"

Stopping off here. Final session will mainly be double checking the project setup and making sure the documentation is good.

Todo next session
-----------------
1. Think about tidying anything up where needed
2. Delete project and re install - making note of every command needed to get it working
3. Finish the installation.md - move it into README.md also just so the repo looks good on github
4. Make sure to apply github admin write only ruleset and then make github public
5. Send email about finishing project
