<?php

namespace Tests\Feature;


use Tests\TestCase;

class WhoisQueryTest extends TestCase
{
    /**
     * @test
     */
    public function aWhoisQueryCanBeDone(): void
    {
        $domain = 'test.com';
        $response = $this->get("/api/v1/whois?domain=$domain");
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function aValidDomainShouldReturnDNS()
    {
        $domain = 'sistemasdg.com';
        $response = $this->get("/api/v1/whois?domain=$domain");
        $response->assertStatus(200);
        $response->assertJson([
            'Name Servers' => [
                'ns1.donweb.cl',
                'ns1.donweb.co',
                'ns1.donweb.mx',
                'ns1.donweb.uy',
                'ns1.traxhost.com',
                'ns2.donweb.bo',
                'ns2.donweb.com.br',
                'ns2.donweb.pe',
                'ns3.hostmar.com',
                //'NS1.EMPRETIENDA.NET',
                //'NS2.EMPRETIENDA.NET',
                //'NS3.EMPRETIENDA.NET',
                //'NS4.EMPRETIENDA.NET'
            ]
        ]);
    }

    /**
     * @test
     */
    public function anInvalidDomainShouldReturnEmptyNameServers(): void
    {
        $domain = 'testfornoregistereddomain.com';
        $response = $this->get("/api/v1/whois?domain=$domain");
        $response->assertStatus(200);
        $response->assertJson([
            'Name Servers' => []
        ]);
    }

}
