<?php

/**
 * Layer of abstraction around banner objects.
 *  Supports CRUD operations.
 *
 */
class DAOCSV implements DAOInterface
{
    private $banners = array();
    private string $path_to_files;
    private const PATH_TO_FILES = '/tmp/testing';

    /**
     * Load all banners from data store. Currently, just flat files.
     *
     */
    function __construct($path_to_files = self::PATH_TO_FILES) {
        $this->path_to_files = $path_to_files;
        $this->load_from_disk();
    }

    function __destruct() {
        $this->write_to_disk();
    }

    function add(int $display_timestamp_from, int $display_timestamp_to, float $display_weight, string $name, string $uri) {
        $this->banners[] = new Banner($display_timestamp_from, $display_timestamp_to, $display_weight, $name, $uri);
    }

    function get(string $name) : object {

        return $this->banners[0]; // TODO: this is a placeholder
    }

    function getAll() : array {
        return $this->banners;
    }

    function update(int $display_timestamp_from, int $display_timestamp_to, float $display_weight, string $name, string $uri) {

    }

    function delete(string $name) {

    }

    private function load_from_disk() {

    }

    private function write_to_disk() {

    }
}