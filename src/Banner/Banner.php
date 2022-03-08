<?php

namespace Banner;

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
     * @throws \Exception
     */
    function __construct(int $display_timestamp_from, int $display_timestamp_to, float $weight, string $name, string $uri) {
        $error_string = $this->validateInput($display_timestamp_from, $display_timestamp_to, $weight, $name, $uri);
        if ($error_string != '') throw new \Exception($error_string);

        $this->timestamp_from = $display_timestamp_from;
        $this->timestamp_to = $display_timestamp_to;
        $this->weight = $weight;
        $this->name = $name;
        $this->uri = $uri;
    }

    /**
     * @return int
     */
    public function getTimestampFrom(): int
    {
        return $this->timestamp_from;
    }

    /**
     * @param int $timestamp_from
     */
    public function setTimestampFrom(int $timestamp_from): void
    {
        $this->timestamp_from = $timestamp_from;
    }

    /**
     * @return int
     */
    public function getTimestampTo(): int
    {
        return $this->timestamp_to;
    }

    /**
     * @param int $timestamp_to
     */
    public function setTimestampTo(int $timestamp_to): void
    {
        $this->timestamp_to = $timestamp_to;
    }

    /**
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     */
    public function setWeight(float $weight): void
    {
        if ($weight > 1.0) throw new \Exception('Weight must be less than 1.0.');
        $this->weight = $weight;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        if ($name == '') throw new Error('Name must not be empty.');
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     */
    public function setUri(string $uri): void
    {
        if ($uri =='') throw new Error('URI must not be empty.');
        $this->uri = $uri;
    }

    public static function validateInput(int $display_timestamp_from, int $display_timestamp_to, float $weight, string $name, string $uri) : string {
        if ($weight > 1.0) return 'Weight must be less than 1.0.';
        if ($name == '') return 'Name must not be empty.';
        if ($uri =='') return 'URI must not be empty.';

        return '';
    }

}