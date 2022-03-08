<?php

namespace Banner\BannerDAO;
/**
 * Provides access to data objects. It is meant to be tied to a persistent data store.
 *   Supports basic CRUD operations.
 */
interface DAOInterface
{
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
    function add(int $timestamp_from, int $timestamp_to, float $weight, string $name, string $uri) : void;

    /**
     * Get a banner by name
     *
     * @param string $name
     * @return object|null banner if found, otherwise null
     */
    function get(string $name): ?object;

    /**
     * Get all banners
     *
     * @return array list of banners
     */
    function getAll(): array;

    /**
     * Update an existing banner
     *
     * @param int $timestamp_from
     * @param int $timestamp_to
     * @param float $weight
     * @param string $name
     * @param string $uri
     * @return bool true if banner was found and updated
     */
    function update(int $timestamp_from, int $timestamp_to, float $weight, string $name, string $uri) : bool;

    /**
     * Delete a banner, referenced by name
     *
     * @param string $name
     * @return bool true if banner was found and deleted
     */
    function delete(string $name) : bool;
}