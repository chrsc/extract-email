<?php

namespace Chrsc\ExtractEmail\Tests;

use Chrsc\ExtractEmail\ExtractEmail;
use PHPUnit\Framework\TestCase;

class ExtractEmailTest extends TestCase
{
    /** @test */
    public function canOnlyReturnEmailAddresses()
    {
        $extractEmail = new ExtractEmail('http://soniccode.com');
        $results = $extractEmail->getEmail();
        foreach ($results as $result) {
            $this->assertRegExp($extractEmail::EMAIL_REGEX, $result);
        }
    }
}