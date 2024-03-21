# Work Log

This file contains a break down of my time spent on each task, some thoughts about the direction of the project and a list of what I thought I would acheive next session.

### 19/03/2024

1. Install symfony docker and get it working # 10m
2. Import the checker interface and create service with empty stubs # 5m
3. Install PHPUnit and Write basic unit tests - which at this point will fail # 10m
4. Add dataproviders to the unit tests to help test edge cases # 15m
5. Creating initial implementations of functions # 1h 30m
    1. making simplest solution that passes all tests
    2. thinking about dataprovider test cases
    3. deciding if more requirements need to be captured and writing email with questions
6. Updating instructions mark down

Taking a break at this point. Possibly a minimum viable product has been achieved depending on answers to my questions in the email. No requirements were given in terms of optimisation, but next session will be looking at ways to improve the speed and make sure code quality is high.

Total: 2h 10m


**Next session**
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
    1. test 1 - lookup array by key - 0.644220,0.627844,0.644414 - Surpsingly this is actually slower. # 25m
    2. test 2 - trying to use an in memory array instead of range() with letters in order or most commly used
    Found that it is slightly quicker, but also the order doesn't matter. Ordering by least common first also was quicker
    indicating the improvement was eliminating range() # 15m

Cutting optimisation phase here, to focus on delivering command line app and good installation documentation.

3. Create command line app to run checkers # 1h 20m

Final session will mainly be double checking the project setup and making sure the documentation is good.

Session: 2h 40m
Total: 4h 50m


**Next session**
* Think about tidying anything up where needed
* Delete project and re install - making note of every command needed to get it working
* Finish the installation.md and copy it into README.md
* Make sure to apply github admin write only ruleset and then make the repo public
* Send email about finishing project


### 21/03/2024

1. Tidying up command and creating test with full coverage # 25m
2. Dry run # 35m
    1. Removed project and re-installed to grab all necessary commands
    2. Updated instructions.md and README.md
3. Make github public and set appropriate rules # 20m

Session: 1h 20m
Total: 6h 10m