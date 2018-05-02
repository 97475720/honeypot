<?php
$I = new CliGuy($scenario);
$I->wantTo('see that my group extension works');
$I->amInPath('tests/data/sandbox');
$I->executeCommand('run skipped -g notorun -c codeception_grouped.yml');
$I->dontSeeInShellOutput("======> Entering NoGroup Article Scope\nMake it incomplete");
$I->dontSeeInShellOutput('<====== Ending NoGroup Article Scope');
$I->executeCommand('run dummy -g ok -c codeception_grouped.yml');
$I->dontSeeInShellOutput("======> Entering Ok Article Scope\nMake it incomplete");
$I->dontSeeInShellOutput('<====== Ending Ok Article Scope');
