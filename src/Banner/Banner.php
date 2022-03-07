<?php

namespace Banner;

/**
 * Banner to be displayed by consumer of the Banner microservice.
 *
 */
class Banner
{
    private int $display_timestamp_to;
    private int $display_timestamp_from;
    private float $display_weight;
    private string $name;
    private string $banner_uri;


    /**
     * @return int
     */
    public function getDisplayTimestampFrom(): int
    {
        return $this->display_timestamp_from;
    }

    /**
     * @param int $display_timestamp_from
     */
    public function setDisplayTimestampFrom(int $display_timestamp_from): void
    {
        $this->display_timestamp_from = $display_timestamp_from;
    }

    /**
     * @return int
     */
    public function getDisplayTimestampTo(): int
    {
        return $this->display_timestamp_to;
    }

    /**
     * @param int $display_timestamp_to
     */
    public function setDisplayTimestampTo(int $display_timestamp_to): void
    {
        $this->display_timestamp_to = $display_timestamp_to;
    }

    /**
     * @return float
     */
    public function getDisplayWeight(): float
    {
        return $this->display_weight;
    }

    /**
     * @param float $display_weight
     */
    public function setDisplayWeight(float $display_weight): void
    {
        $this->display_weight = $display_weight;
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
    public function getBannerUri(): string
    {
        return $this->banner_uri;
    }

    /**
     * @param string $banner_uri
     */
    public function setBannerUri(string $banner_uri): void
    {
        $this->banner_uri = $banner_uri;
    }


    function __construct(int $display_timestamp_from, int $display_timestamp_to, float $display_weight, string $name, string $banner_uri) {
        $this->display_timestamp_from = $display_timestamp_from;
        $this->display_timestamp_to = $display_timestamp_to;
        $this->display_weight = $display_weight;
        $this->name = $name;
        $this->banner_uri = $banner_uri;
    }


}