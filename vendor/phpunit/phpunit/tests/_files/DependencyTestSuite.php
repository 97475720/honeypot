<?php
use PHPUnit\Framework\TestSuite;

class DependencyTestSuite
{
    public static function suite()
    {
        $suite = new TestSuite('Article Dependencies');

        $suite->addTestSuite(DependencySuccessTest::class);
        $suite->addTestSuite(DependencyFailureTest::class);

        return $suite;
    }
}
