<?php

namespace Banner\BannerManager;
use Banner\Banner;
use Banner\BannerDAO\DAO;
use Exception;
use InvalidArgumentException;

/**
 * Controller for all interaction with Banner package.
 *
 */
class BannerManager
{
    private array $office_ips;
    private object $dao;

    function __construct()
    {
        $this->office_ips = array('192.0.2.10', '198.51.100.3', '203.0.113.254');
        $this->dao = new DAO();
    }

    /**
     * Return a banner. Selection criteria include:
     *          - IP address of client
     *          - Time of day
     *          - Weighting of eligible banners
     *
     * @return ?object banner object or null if no matches found
     * @throws InvalidArgumentException
     */
    function get(string $ip_address) : ?object
    {
        if (! filter_var($ip_address, FILTER_VALIDATE_IP)) {
            throw new InvalidArgumentException('A valid IP address must be passed.');
        }

        $current_timestamp = time();
        $eligible_banners = array();

        foreach ($this->dao->getAll() as $banner) {
            if ($this->isInOffice($ip_address)) {
                if ($current_timestamp <= $banner->getTimestampTo()) {
                    $eligible_banners[] = $banner;
                }
            } else {
                if ($current_timestamp <= $banner->getTimestampTo() && $current_timestamp >= $banner->getTimestampFrom()) {
                    $eligible_banners[] = $banner;
                }
            }
        }

        return $this->selectRandom($eligible_banners);
    }

    /**
     * Select a random banner from array of candidates.
     *   Uses an array so algorithmic complexity is O(1).
     *
     * @param array $candidates
     * @return ?object banner
     */
    private function selectRandom(array $candidates) : ?object
    {
        if (count($candidates) == 0) return null;
        if (count($candidates) == 1) return $candidates[0];
        $weighted_array = array();
        foreach ($candidates as $banner) {
            $count = $banner->getWeight() * 10;
            for ($i = 0; $i < $count; $i++) {
                $weighted_array[] = $banner->getName();
            }
        }
        return $this->dao->get( $weighted_array[rand(0, count($weighted_array)-1)] );
    }

    /**
     * Add a banner
     *
     * @param int $timestamp_from
     * @param int $timestamp_to
     * @param float $weight
     * @param string $name
     * @param string $uri
     * @return void
     * @throws InvalidArgumentException|Exception
     */
    public function add(int $timestamp_from, int $timestamp_to, float $weight, string $name, string $uri) : void
    {
        $error_string = Banner::validateInput($weight, $name, $uri);
        if ($error_string != '') throw new InvalidArgumentException($error_string);
        if ($this->exists($name)) throw new Exception("A banner with the name ".$name." already exists. ");

        $this->dao->add($timestamp_from, $timestamp_to, $weight, $name, $uri);
    }

    /**
     * Check if a banner already exists
     *
     * @param string $name
     * @return bool true if banner exists
     */
    private function exists(string $name) : bool
    {
        foreach ($this->dao->getAll() as $banner) {
            if ($banner->getName() == $name) return true;
        }
        return false;
    }

    /**
     * Check if IP address is in the office
     *
     * @param string $ip_address
     * @return bool true if ip address is in office
     */
    private function isInOffice(string $ip_address): bool
    {
        return (in_array($ip_address, $this->office_ips));
    }
}