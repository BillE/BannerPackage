<?php

class Banner
{
    private int $display_timestamp_from;
    private int $display_timestamp_to;
    private float $display_weight;
    private string $name;
    private string $banner_uri;

    function __construct(int $display_timestamp_from, int $display_timestamp_to, float $display_weight, string $name, string $banner_uri) {
        $this->display_timestamp_from = $display_timestamp_from;
        $this->display_timestamp_to = $display_timestamp_to;
        $this->display_weight = $display_weight;
        $this->name = $name;
        $this->banner_uri = $banner_uri;

    }


}