<?php

namespace Banner\BannerDAO;

use Banner\Banner;

/**
 * Layer of abstraction around banner objects.
 *  Supports CRUD operations.
 *
 */
class DAO implements DAOInterface
{
    private array $banners = array();

    function add(int $timestamp_from, int $timestamp_to, float $weight, string $name, string $uri)
    {
        $this->banners[] = new Banner($timestamp_from, $timestamp_to, $weight, $name, $uri);
    }

    function get(string $name): ?object
    {
        if ($this->banners == null) return null;
        foreach ($this->banners as $banner) {
            if ($banner->getName() == $name) return $banner;
        }
        return null;
    }

    function getAll(): array
    {
        return $this->banners;
    }

    /**
     * TODO: add logic
     *
     * @param int $display_timestamp_from
     * @param int $display_timestamp_to
     * @param float $display_weight
     * @param string $name
     * @param string $uri
     * @return void
     */
    function update(int $timestamp_from, int $timestamp_to, float $weight, string $name, string $uri)
    {

        foreach ($this->banners as $banner) {
            if ($banner->getName() == $name) {
                $banner->setTimestampFrom($timestamp_from);
                $banner->setTimestampTo($timestamp_to);
                $banner->setWeight($weight);
                $banner->setUri($uri);
            }
        }
    }

    /**
     * TODO: add logic
     *
     * @param string $name
     * @return void
     */
    function delete(string $name)
    {

    }

}