<?php

namespace Banner\BannerDAO;
/**
 * Allows access to data objects.
 *
 */
interface DAOInterface
{
    function add(int $timestamp_from, int $timestamp_to, float $weight, string $name, string $uri);
    function get(string $name): ?object;
    function getAll(): array;
    function update(int $timestamp_from, int $timestamp_to, float $weight, string $name, string $uri);
    function delete(string $banner_name);
}