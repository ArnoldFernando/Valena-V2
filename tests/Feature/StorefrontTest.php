<?php

it('renders the public products page', function () {
    $response = $this->get('/products');

    $response->assertOk();
});

it('renders the public facilities page', function () {
    $response = $this->get('/facilities');

    $response->assertOk();
});
