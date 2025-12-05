<?php

use AbacatePay\Clients\PixQrCodeClient;
use AbacatePay\Enums\PixQrCode\Statuses;
use AbacatePay\Resources\PixQrCode;
use AbacatePay\Resources\Customer;
use AbacatePay\Resources\Customer\Metadata as CustomerMetadata;

/**
 * Test case: Create a Pix QRCode with minimal data.
 *
 * This test verifies that the `create` method of `PixQrCodeClient` successfully creates
 * a `PixQrCode` instance when only the required amount is provided.
 */
test('Create a Pix QRCode with minimal data', function () {
    // Create a new PixQrCode object with required data
    $pixQrCode = new PixQrCode([
        'amount' => 100,
    ]);

    // Mocked client with a fake response for creating a Pix QRCode
    $fakeClient = getCreatePixQrCodeResponseClient();

    // Create a PixQrCodeClient instance using the mocked client
    $pixQrCodeClient = new PixQrCodeClient($fakeClient);

    // Assert that the `create` method returns a PixQrCode instance
    $result = $pixQrCodeClient->create($pixQrCode);
    expect($result)->toBeInstanceOf(PixQrCode::class);
    expect($result->id)->toBe('pix_char_123456');
    expect($result->amount)->toBe(100);
    expect($result->status)->toBe(Statuses::PENDING);
    expect($result->br_code)->toBe('00020101021226950014br.gov.bcb.pix');
    expect($result->br_code_base64)->toBe('data:image/png;base64,iVBORw0KGgoAAA');
});

/**
 * Test case: Create a Pix QRCode with all optional data.
 *
 * This test verifies that the `create` method of `PixQrCodeClient` successfully creates
 * a `PixQrCode` instance when all optional data is provided.
 */
test('Create a Pix QRCode with all optional data', function () {
    // Create a new PixQrCode object with all data
    $pixQrCode = new PixQrCode([
        'amount' => 100,
        'expires_in' => 3600,
        'description' => 'Payment for services',
        'customer' => new Customer([
            'metadata' => new CustomerMetadata([
                'name' => 'Daniel Lima',
                'cellphone' => '(11) 4002-8922',
                'email' => 'daniel_lima@abacatepay.com',
                'tax_id' => '123.456.789-01'
            ])
        ]),
        'metadata' => [
            'order_id' => 'order_123'
        ]
    ]);

    // Mocked client with a fake response for creating a Pix QRCode
    $fakeClient = getCreatePixQrCodeResponseClient();

    // Create a PixQrCodeClient instance using the mocked client
    $pixQrCodeClient = new PixQrCodeClient($fakeClient);

    // Assert that the `create` method returns a PixQrCode instance
    $result = $pixQrCodeClient->create($pixQrCode);
    expect($result)->toBeInstanceOf(PixQrCode::class);
    expect($result->id)->toBe('pix_char_123456');
});
