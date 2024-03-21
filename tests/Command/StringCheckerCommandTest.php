<?php

namespace App\Tests\Command;

use App\Command\StringCheckerCommand;
use App\Service\StringCheckerService;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;

class StringCheckerCommandTest extends KernelTestCase
{
    protected Command $command;
    protected CommandTester $commandTester;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $application->add(new StringCheckerCommand(new StringCheckerService()));

        $this->command = $application->find('app:string-checker');
        $this->commandTester = new CommandTester($this->command);
    }

    /**
     * @dataProvider supportedCheckersProvider
     *
     * @return void
     */
    public function testItOnlyAllowsSupportedCheckers(array $consoleInput, string $expected): void
    {
        $this->commandTester->execute($consoleInput);

        $output = $this->commandTester->getDisplay();

        $this->assertStringContainsString($expected, $output);
    }

    public function supportedCheckersProvider(): array
    {
        return [
            'test palindrome checker command' => [
                ['checker' => 'palindrome', 'string' => 'hi ho!'],
                'is not a palindrome',
            ],
            'test non valid checker' => [
                ['checker' => 'bananagram', 'string' => 'hi ho!'],
                'Invalid checker',
            ],
            'test anagram checker command without comparison' => [
                ['checker' => 'anagram', 'string' => 'hi ho!'],
                'You must provide a comparison string when checking anagrams',
            ],
            'test valid anagram checker command' => [
                ['checker' => 'anagram', 'string' => 'hi ho!', 'comparison' => '!hi oh'],
                'Your string \'hi ho!\' is an anagram of \'!hi oh\'',
            ],
            'test valid pangram checker command' => [
                ['checker' => 'pangram', 'string' => 'Hello, friend'],
                'Your phrase \'Hello, friend\' is not a pangram',
            ],
        ];
    }
}
