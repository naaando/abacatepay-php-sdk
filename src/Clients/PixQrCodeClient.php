<?php

namespace AbacatePay\Clients;

use AbacatePay\Resources\PixQrCode;
use GuzzleHttp\Client as GuzzleHttpClient;

/**
 * Client class for managing Pix QRCode operations in the AbacatePay API.
 *
 * This class provides methods to create Pix QRCodes for payments.
 */
class PixQrCodeClient extends Client
{
    /**
     * API endpoint for Pix QRCode operations.
     */
    const URI = 'pixQrCode';

    /**
     * Constructor for the PixQrCodeClient class.
     *
     * Initializes the client for the Pix QRCode endpoint.
     *
     * @param GuzzleHttpClient|null $client Optional GuzzleHttpClient instance for custom configurations.
     */
    public function __construct(?GuzzleHttpClient $client = null)
    {
        parent::__construct(self::URI, $client);
    }

    /**
     * Creates a new Pix QRCode.
     *
     * Sends a POST request to the "create" endpoint with the Pix QRCode data and returns the created PixQrCode object.
     *
     * @param PixQrCode $data The Pix QRCode data to be sent for creation.
     * @return PixQrCode The created PixQrCode object.
     */
    public function create(PixQrCode $data): PixQrCode
    {
        $requestData = [
            'amount' => $data->amount,
        ];

        if (isset($data->expires_in)) {
            $requestData['expiresIn'] = $data->expires_in;
        }

        if (isset($data->description)) {
            $requestData['description'] = $data->description;
        }

        if (isset($data->customer)) {
            if (!isset($data->customer->id)) {
                $requestData['customer'] = [
                    'name' => $data->customer->metadata->name,
                    'email' => $data->customer->metadata->email,
                    'cellphone' => $data->customer->metadata->cellphone,
                    'taxId' => $data->customer->metadata->tax_id
                ];
            } else {
                $requestData['customerId'] = $data->customer->id;
            }
        }

        if (isset($data->metadata)) {
            $requestData['metadata'] = $data->metadata;
        }

        $response = $this->request("POST", "create", [
            'json' => $requestData
        ]);

        return new PixQrCode($response);
    }
}
