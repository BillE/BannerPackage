<?php

namespace Banner\TimeZones;

/**
 * Convert between given time zone and UTC time.
 */
class TimeZones
{
    public static function setTimestamp(string $time_zone, int $timestamp): int
    {
        // TODO: look up timezone from string.

        return 1; //TODO: placeholder
    }

    public static function getTimestamp(): int
    {

        return 1; //TODO: placeholder
    }

    public static function isValidTimezone(string $time_zone): bool
    {
        return in_array($time_zone, timezone_identifiers_list());
    }
}