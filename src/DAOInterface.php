<?php

/**
 * Allows access to data objects.
 *
 */
interface DAOInterface
{
    function add(int $display_timestamp_from, int $display_timestamp_to, float $display_weight, string $name, string $banner_uri);
    function get(string $name) : object;
    function getAll() : array;
    function update(int $display_timestamp_from, int $display_timestamp_to, float $display_weight, string $name, string $banner_uri);
    function delete(string $banner_name);
}