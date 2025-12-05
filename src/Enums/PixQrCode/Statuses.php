<?php

namespace AbacatePay\Enums\PixQrCode;

/**
 * Enumeration defining Pix QRCode statuses.
 *
 * This enumeration is used to represent the various statuses that a Pix QRCode can have.
 */
enum Statuses: string
{
    /**
     * Pending status.
     *
     * Indicates that the Pix QRCode is pending and has not yet been paid.
     */
    case PENDING = "PENDING";

    /**
     * Expired status.
     *
     * Indicates that the Pix QRCode has expired and is no longer valid.
     */
    case EXPIRED = "EXPIRED";

    /**
     * Cancelled status.
     *
     * Indicates that the Pix QRCode has been cancelled.
     */
    case CANCELLED = "CANCELLED";

    /**
     * Paid status.
     *
     * Indicates that the Pix QRCode has been paid.
     */
    case PAID = "PAID";

    /**
     * Refunded status.
     *
     * Indicates that the Pix QRCode payment has been refunded.
     */
    case REFUNDED = "REFUNDED";
}
