<?php

namespace AbacatePay\Resources;

use AbacatePay\Enums\PixQrCode\Statuses;
use DateTime;

/**
 * Represents a Pix QRCode resource in the AbacatePay system.
 *
 * This class contains information about a Pix QRCode entity, including the BR Code,
 * amount, status, and expiration details.
 */
class PixQrCode extends Resource
{
    /**
     * Unique identifier for the Pix QRCode.
     *
     * @var string|null
     */
    public ?string $id;

    /**
     * Amount to be paid in cents.
     *
     * @var int|null
     */
    public ?int $amount;

    /**
     * Current status of the Pix QRCode.
     *
     * @var Statuses|null
     */
    public ?Statuses $status;

    /**
     * Indicates whether the Pix QRCode is in development mode.
     *
     * @var bool|null
     */
    public ?bool $dev_mode;

    /**
     * The copy-and-paste BR Code string for the Pix payment.
     *
     * @var string|null
     */
    public ?string $br_code;

    /**
     * Base64 encoded image of the QRCode.
     *
     * @var string|null
     */
    public ?string $br_code_base64;

    /**
     * Platform fees in cents.
     *
     * @var int|null
     */
    public ?int $platform_fee;

    /**
     * Date and time when the Pix QRCode was created.
     *
     * @var DateTime|null
     */
    public ?DateTime $created_at;

    /**
     * Date and time when the Pix QRCode was last updated.
     *
     * @var DateTime|null
     */
    public ?DateTime $updated_at;

    /**
     * Date and time when the Pix QRCode expires.
     *
     * @var DateTime|null
     */
    public ?DateTime $expires_at;

    /**
     * Expiration time in seconds (for creation request).
     *
     * @var int|null
     */
    public ?int $expires_in;

    /**
     * Description message that will appear when paying the Pix.
     *
     * @var string|null
     */
    public ?string $description;

    /**
     * Customer associated with the Pix QRCode.
     *
     * @var Customer|null
     */
    public ?Customer $customer;

    /**
     * Metadata associated with the Pix QRCode.
     *
     * @var array|null
     */
    public ?array $metadata;

    /**
     * Constructor for the PixQrCode class.
     *
     * Initializes the PixQrCode object with the provided data.
     *
     * @param array $data Associative array of Pix QRCode properties.
     */
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $this->__set($key, $value);
        }
    }

    /**
     * Dynamically sets a property value after processing it.
     *
     * @param string $name The name of the property to set.
     * @param mixed $value The value to set for the property.
     */
    public function __set($name, $value)
    {
        $name = $this->__camelToSnakeCase($name);

        if (!property_exists($this, $name)) {
            return;
        }

        $this->{$name} = $this->processValue($name, $value);
    }

    /**
     * Processes the value of a property based on its type and context.
     *
     * @param string $name The name of the property.
     * @param mixed $value The value to process.
     * @return mixed The processed value.
     */
    private function processValue($name, $value)
    {
        if ($value === null) {
            return null;
        }

        switch ($name) {
            case 'status':
                return $this->__initializeEnum(Statuses::class, $value);
            case 'created_at':
            case 'updated_at':
            case 'expires_at':
                return $this->__initializeDateTime($value);
            case 'customer':
                return $this->__initializeResource(Customer::class, $value);
            default:
                return $value;
        }
    }
}
