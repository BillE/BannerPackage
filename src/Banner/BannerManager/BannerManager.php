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
    function get(string $ip_address): object
    {
        $current_timestamp = time();
        $eligible_banners = array();

        foreach ($this->dao->getAll() as $banner) {
            if ($this->isInOffice($ip_address)) {
                if ($current_timestamp <= $banner->getDisplayTimestampTo() && $banner->getDisplayTimestampFrom() >= $banner->getDisplayTimestampFrom()) {
                    $eligible_banners[] = $banner;
                }
            } else {
                if ($current_timestamp <= $banner->getDisplayTimestampTo()) {
                    $eligible_banners[] = $banner;
                }
            }
        }

        return $this->selectRandom($eligible_banners);
    }

    private function selectRandom(array $candidates) : object {
        if (count($candidates) == 1) return $candidates[0];
        $weighted_array = array();
        foreach ($candidates as $banner) {
            $count = $banner->getWeight * 10;
            for ($i = 0; $i < $count; $i++) {
                $weighted_array[] = $banner->getName();
            }
        }

        return $this->dao->get($weighted_array[rand(0, count($weighted_array))]);
    }

    function add(int $display_timestamp_from, int $display_timestamp_to, float $display_weight, string $name, string $uri)
    {
        $this->dao->add($display_timestamp_from, $display_timestamp_to, $display_weight, $name, $uri);
    }

    private function isInOffice(string $ip_address): bool
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