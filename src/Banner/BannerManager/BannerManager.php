<?php

namespace Banner\BannerManager;
use Banner\BannerDAO\DAOCSV;
use Banner\TimeZones\TimeZones;

/**
 * Controller for all interaction with package.
 *
 */
class BannerManager
{
    private int $ip_address;
    private array $office_ips;
    private string $time_zone;
    private object $dao;

    function __construct()
    {
        // TODO: this is hidden in the code. Let's move it somewhere else. Maybe config.php
        $this->office_ips = array('192.0.2.10', '198.51.100.3', '203.0.113.254');
        $this->time_zone = date_default_timezone_get();
        $this->dao = new DAOCSV();
    }

    /**
     * Override default time zone.
     *
     * @param string $time_zone
     * @return void
     */
    function setTimezone(string $time_zone)
    {
        if (TimeZones::IsValidTimezone($time_zone)) {
            $this->time_zone = $time_zone;
        }
    }

    /**
     * @return string return the name of banner to display
     *      Selection criteria include:
     *          - IP address of client
     *          - Time of day
     *          - Time zone. We can NOT rely on local sever time as code can be deployed across multiple time zones
     *          - Weighting of eligible banners
     *
     * TODO: error-handling including error codes
     */
    function display(string $ip_address): string
    {
        $banner_text = ''; // TODO: placeholder

        $current_timestamp = date(time());
        // get all eligible banners


        // if more than one, use weighting
        return $banner_text;
    }

    function add(int $display_timestamp_from, int $display_timestamp_to, float $display_weight, string $name, string $uri)
    {
        $this->dao->add($display_timestamp_from, $display_timestamp_to, $display_weight, $name, $uri);
    }

    private function isInOffice(string $ip_address): boolIs
    {
        return (in_array($ip_address, $this->office_ips));
    }

    /**
     * Get a list of all eligible banners. Based on time and location (in office vs. out of office).
     *
     *
     * @param string $current_time
     * @param bool $is_office
     * @return void
     *
     */
    private function getActive(int $current_timestamp, bool $is_office)
    {
        // get collection of banners to filter


    }

    /**
     * Get a list of all banners.
     *
     * @return array
     */
    public function getAll() : array
    {
        // get collection of banners to filter

        return $this->dao->getAll();
    }


}