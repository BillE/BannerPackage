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
        $this->uri = $uri;
    }


    function __construct(int $display_timestamp_from, int $display_timestamp_to, float $display_weight, string $name, string $banner_uri) {
        $this->timestamp_from = $display_timestamp_from;
        $this->timestamp_to = $display_timestamp_to;
        $this->weight = $display_weight;
        $this->name = $name;
        $this->uri = $banner_uri;
    }


}