<?php

namespace App\Classes;

class HMAC
{
    public string $key;
    public string $algorithm;

    public function __construct($algorithm = 'sha3-256')
    {
        $this->algorithm = $algorithm;
        $this->generateKey();
    }

    /**
     * Key generation for HMAC.
     * @return void
     */
    private function generateKey(): void
    {
        $this->key = bin2hex(openssl_random_pseudo_bytes(32));
    }

    /**
     * HMAC generation.
     * @param $message
     * @return string
     */
    public function generate($message): string
    {
        return hash_hmac($this->algorithm, $message, $this->key);
    }

    /**
     * Get HMAC key.
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }
}
