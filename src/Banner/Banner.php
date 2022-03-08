<?php

namespace Banner;

use http\Exception\InvalidArgumentException;

/**
 * Banner to be displayed by consumer of the Banner service.
 *
 */
class Banner
{
    private int $timestamp_to;
    private int $timestamp_from;
    private float $weight;
    private string $name;
    private string $uri;

    /**
     * @throws InvalidArgumentException
     */
    function __construct(int $display_timestamp_from, int $display_timestamp_to, float $weight, string $name, string $uri)
    {
        $error_string = $this->validateInput($weight, $name, $uri);
        if ($error_string != '') throw new InvalidArgumentException($error_string);

        $this->timestamp_from = $display_timestamp_from;
        $this->timestamp_to = $display_timestamp_to;
        $this->weight = $weight;
        $this->name = $name;
        $this->uri = $uri;
    }

    /**
     * Get valid from timestamp
     *
     * @return int valid from timestamp
     */
    public function getTimestampFrom(): int
    {
        return $this->timestamp_from;
    }

    /**
     * Set valid from timestamp
     *
     * @param int $timestamp_from valid from timestamp
     */
    public function setTimestampFrom(int $timestamp_from): void
    {
        $this->timestamp_from = $timestamp_from;
    }

    /**
     * Get valid to timestamp
     *
     * @return int valid to timestamp
     */
    public function getTimestampTo(): int
    {
        return $this->timestamp_to;
    }

    /**
     * Set valid to timestamp
     *
     * @param int $timestamp_to valid to timestamp
     */
    public function setTimestampTo(int $timestamp_to): void
    {
        $this->timestamp_to = $timestamp_to;
    }

    /**
     * Get display weight of banner
     *
     * @return float display weight of banner
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * Set display weight of banner
     *
     * @param float $weight display weight of banner
     * @return void
     * @throws InvalidArgumentException
     */
    public function setWeight(float $weight): void
    {
        if ($weight > 1.0) throw new InvalidArgumentException('Weight must be less than 1.0.');
        $this->weight = $weight;
    }

    /**
     * Get name of banner
     *
     * @return string name of banner
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name of banner
     *
     * @param string $name name of banner
     * @throws InvalidArgumentException
     */
    public function setName(string $name): void
    {
        if ($name == '') throw new InvalidArgumentException('Name must not be empty.');
        $this->name = $name;
    }

    /**
     * Get URI of banner
     *
     * @return string URI of banner
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * Set URI of banner
     *
     * @param string $uri URI of banner
     * @throws InvalidArgumentException
     */
    public function setUri(string $uri): void
    {
        if ($uri =='') throw new InvalidArgumentException('URI must not be empty.');
        $this->uri = $uri;
    }

    /**
     * Validate the arguments passed
     *
     * @param float $weight weight of banner
     * @param string $name name of banner
     * @param string $uri URI of banner
     * @return string error string or empty if no errors
     */
    public static function validateInput(float $weight, string $name, string $uri) : string {
        if ($weight > 1.0) return 'Weight must be less than 1.0.';
        if ($name == '') return 'Name must not be empty.';
        if ($uri =='') return 'URI must not be empty.';

        return '';
    }

}