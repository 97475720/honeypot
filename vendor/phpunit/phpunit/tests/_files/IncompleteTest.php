<?php
use PHPUnit\Framework\TestCase;

class IncompleteTest extends TestCase
{
    public function testIncomplete()
    {
        $this->markTestIncomplete('Article incomplete');
    }
}
