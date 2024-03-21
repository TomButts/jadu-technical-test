<?php

namespace App\Command;

use App\Service\StringCheckerService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:string-checker',
    description: 'Check if a string inputed to the console is a palindrome, anagram, or pangram',
)]
class StringCheckerCommand extends Command
{
    protected StringCheckerService $stringCheckerService;

    protected array $supportedCheckers = [
        'palindrome',
        'anagram',
        'pangram',
    ];

    public function __construct(StringCheckerService $stringCheckerService)
    {
        $this->stringCheckerService = $stringCheckerService;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('checker', InputArgument::REQUIRED, 'The type of check to run: palindrome|anagram|pangram')
            ->addArgument('string', InputArgument::REQUIRED, 'The word or phrase to check.')
            ->addArgument('comparison', InputArgument::OPTIONAL, 'Comparsion string for anagram checker.')
            ->setHelp("This command checks if a string is a palindrome, an anagram, or a pangram.\n\nIf checking on a phrase or using the anagram checker its best to put the string and comparison arguments in quotes to avoid errors. For example:\n> php bin/console app:string-checker anagram \"string one\" \"string two\"");
    }

    /**
     * Validate checker types
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $checker = $input->getArgument('checker');

        if (!in_array($checker, $this->supportedCheckers)) {
            $io = new SymfonyStyle($input, $output);

            $io->error(
                sprintf('Invalid checker "%s". Allowed checkers are: %s', $checker, implode(', ', $this->supportedCheckers))
            );

            return Command::FAILURE;
        }
    }

    /**
     * Execution for string checker command.
     *
     * When adding a new check make sure to add the check name to supported checkers array.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return integer
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $checker = $input->getArgument('checker');
        $string = $input->getArgument('string');

        $stringIsCheckType = null;
        $message = '';

        if ('palindrome' === $checker) {
            $stringIsCheckType = $this->stringCheckerService->isPalindrome($string);

            $message = sprintf('Your string \'%s\' %s a palindrome', $string, $stringIsCheckType ? 'is' : 'is not');
        } elseif ('anagram' === $checker) {
            $comparison = $input->getArgument('comparison');

            if (empty($comparison)) {
                $io->error('You must provide a comparison string when checking anagrams.');

                return Command::FAILURE;
            }

            $stringIsCheckType = $this->stringCheckerService->isAnagram($string, $comparison);

            $message = sprintf('Your string \'%s\' %s an anagram of \'%s\'', $string, $stringIsCheckType ? 'is' : 'is not', $comparison);
        } elseif('pangram' === $checker) {
            $stringIsCheckType = $this->stringCheckerService->isPangram($string);

            $message = sprintf('Your phrase \'%s\' %s a pangram', $string, $stringIsCheckType ? 'is' : 'is not');
        }

        if (null === $stringIsCheckType) {
            $io->note(sprintf('Checker %s has not yet been configured', $checker));

            return Command::FAILURE;
        }

        if ($stringIsCheckType) {
            $io->success($message);
        } else {
            $io->warning($message);
        }

        return Command::SUCCESS;
    }
}
