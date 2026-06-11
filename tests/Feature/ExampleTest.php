<?php

test('returns a successful response', function () {
    $response = $this->get('/');

    $response
        ->assertOk()
        ->assertSee('My first Laravel Live conference in Japan')
        ->assertSee('assets/conferences/696479322_1565802294968111_4488256334593409955_n.jpg')
        ->assertSee('sql-to-signal')
        ->assertSee('https://github.com/neon2027/sql-to-signal')
        ->assertSee('composer require laravelldone/sql-to-signal')
        ->assertDontSee('Available for opportunities')
        ->assertDontSee('AI-Powered Dev')
        ->assertDontSee('Years Exp.');
});
