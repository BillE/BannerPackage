<?php

/**
 * Controller for all interaction with package.
 *
 */
class BannerManager
{
    private int $ip_address;
    private array $banners;
    private array $office_ips;

    function __construct() {
        // TODO: this is hidden in the code. Let's move it somewhere else.
        $this->office_ips = array(`192.0.2.10`, `198.51.100.3`, `203.0.113.254`);
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
    function display(string $ip_address, string $time_zone): string {
        $banner_text = ''; // TODO: placeholder

        $current_timestamp = date(time());
        // get all eligible banners


        // if more than one, use weighting
        return $banner_text;
    }

    function add(int $display_timestamp_from, int $display_timestamp_to, float $display_weight, string $name, string $banner_uri) {
        // get DAO
        $dao = new DAOCSV();
        $dao->addBanner($display_timestamp_from, $display_timestamp_to, $display_weight, $name, $banner_uri);
    }

    private function is_in_office(string $ip_address): bool {
        return (in_array($ip_address, $this->office_ips ));
    }

    /**
     * @param string $current_time
     * @param bool $is_office
     * @return void
     *
     * Get a list of all eligible banners. Based on time and location (in office vs. out of office).
     *
     */
    private function getBanners(int $current_timestamp, bool $is_office) {
        // get collection of banners to filter


    }



}