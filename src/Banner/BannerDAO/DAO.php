<?php

namespace Banner\BannerDAO;

use Banner\Banner;
use http\Exception\InvalidArgumentException;

/**
 * Layer of abstraction around banner objects.
 *  Supports basic CRUD operations.
 *
 */
class DAO implements DAOInterface
{
    private array $banners = array();

    /**
     * Add a banner
     *
     * @param int $timestamp_from
     * @param int $timestamp_to
     * @param float $weight
     * @param string $name
     * @param string $uri
     * @return void
     */
    function add(int $timestamp_from, int $timestamp_to, float $weight, string $name, string $uri) : void
    {
        $error_string = Banner::validateInput($weight, $name, $uri);
        if ($error_string != '') throw new InvalidArgumentException($error_string);
        $this->banners[] = new Banner($timestamp_from, $timestamp_to, $weight, $name, $uri);
    }

    /**
     * Get a banner object by name
     *
     * @param string $name
     * @return object|null
     */
    function get(string $name): ?object
    {
        if ($this->banners == null) return null;
        foreach ($this->banners as $banner) {
            if ($banner->getName() == $name) return $banner;
        }
        return null;
    }

    /**
     * Get all banners.
     *
     * @return array all banners
     */
    function getAll(): array
    {
        return $this->banners;
    }

    /**
     * Update a banner, referenced by name
     *
     * @param int $display_timestamp_from
     * @param int $display_timestamp_to
     * @param float $display_weight
     * @param string $name
     * @param string $uri
     * @return bool true if banner was found and updated
     */
    function update(int $timestamp_from, int $timestamp_to, float $weight, string $name, string $uri) : bool
    {
        $error_string = Banner::validateInput($weight, $name, $uri);
        if ($error_string != '') throw new InvalidArgumentException($error_string);

        foreach ($this->banners as $banner) {
            if ($banner->getName() == $name) {
                $banner->setTimestampFrom($timestamp_from);
                $banner->setTimestampTo($timestamp_to);
                $banner->setWeight($weight);
                $banner->setUri($uri);
                return true;
            }
        }
        return false;
    }

    /**
     * Delete a banner, referenced by name
     *
     * @param string $name
     * @return bool true if banner existed, false otherwise
     */
    function delete(string $name) : bool
    {
        for ($i = 0; $i < count($this->banners); $i++) {
            if ($this->banners[$i]->getName() == $name) {
                unset($this->banners[$i]);
                return true;
            }
        }
        return false;
    }

}