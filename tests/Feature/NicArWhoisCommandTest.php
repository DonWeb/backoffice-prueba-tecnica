<?php

namespace Tests\Feature;


use Symfony\Component\Console\Exception\RuntimeException;
use Tests\TestCase;

class NicArWhoisCommandTest extends TestCase
{
    /**
     * @test
     */
    public function canObtainDomainExpirationDate()
    {
        $domain = "ole.com.ar";
        $this->artisan("nick-ar:whois $domain")
            ->expectsOutput('10:00:00 01/Jan/2024');
    }

    /**
     * @test
     */
    public function cantObtainExpirationDateForUnregisteredDomain()
    {
        $domain = "donwebtest.com.ar";
        $this->artisan("nick-ar:whois $domain")
            ->expectsOutput('Dominio no encontrado');
    }

    /**
     * @test
     */
    public function cantRunCommandForNonComArDomain()
    {
        $domain = "test.com";
        $this->artisan("nick-ar:whois $domain")
            ->expectsOutput('Dominio inválido. Solo se permiten dominios .com.ar')
            ->assertExitCode(-1);
    }
    /**
     * @test
     */
    public function cantRunCommandWithoutDomainParameter()
    {
        $this->expectException(RuntimeException::class);
        $this->artisan("nick-ar:whois");
    }
}
