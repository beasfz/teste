<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LedgerTest extends TestCase
{
    /**
     * Basic test for get list of currencies and then balance.
     *
     * @return void
     */
    public function testGetLedger()
    {
        $user = User::whereEmail('airesjoao25@gmail.com')->first();
        $this->assertTrue(isset($user));

        $token = $user->createToken('Personal Access Token')->accessToken;

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ])->json('GET', '/api/ledger', []);

        $response->assertStatus(200);
    }

    /**
     * Basic test to check performe exchange
     * 
     * @return void
     */
    public function testPerformeExchange()
    {
        $user = User::whereEmail('airesjoao25@gmail.com')->first();
        $this->assertTrue(isset($user));

        $token = $user->createToken('Personal Access Token')->accessToken;

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ])->json('GET', '/api/ledger/exchange/eth', []);

        $response->assertStatus(200);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ])->json('GET', '/api/ledger/exchange/btc', []);

        $response->assertStatus(400);
    }
}
