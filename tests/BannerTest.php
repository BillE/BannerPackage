<?php

use PHPUnit\Framework\TestCase;

/**
 * Some functionality to test
 *  - in/out of office ips
 *  - set to/from dates in one time zone, access from another
 *  - is weighting accurately reflected in the returned results?
 *
 */
class BannerTest extends TestCase
{
    const IP_IN_OFFICE_1 = '192.0.2.10';
    const IP_IN_OFFICE_2 = '198.51.100.3';
    const IP_IN_OFFICE_3 = '203.0.113.254';
    const IP_NOT_IN_OFFICE = '201.40.26.19';

    /**
     * Test that a banner can be properly added.
     *
     * @return void
     */
    public function testCanAddBanner()
    {
        $bannerManager = new Banner\BannerManager\BannerManager();
        $ip_address = '192.168.1.1';

        // Add a valid banner (A)
        $from_datetime_a = strtotime("-11 day");
        $to_datetime_a = strtotime("+1 week");
        $name_a = "Banner A";
        $uri_a = "http://www.example.com/image_a.jpg";
        $weight_a = 0.1;

        $bannerManager->add($from_datetime_a,$to_datetime_a,$weight_a,$name_a,$uri_a);

        // Test banner fields properly set
        $banner_a = $bannerManager->get($ip_address);
        $this->assertEquals($banner_a->getName(),$name_a);
        $this->assertEquals($banner_a->getTimestampTo(),$to_datetime_a);
        $this->assertEquals($banner_a->getTimestampFrom(),$from_datetime_a);
        $this->assertEquals($banner_a->getWeight(),$weight_a);
        $this->assertEquals($banner_a->getUri(),$uri_a);

    }

    /**
     * Test that banners with a valid "TO" date but a "FROM" date in the future
     *   can be returned from office IP only.
     *
     * @return void
     */
    public function testInOfficeOnlyBanner()
    {
        $bannerManager = new Banner\BannerManager\BannerManager();

        // Add a valid banner (A)
        $from_datetime_a = strtotime("+1 day");
        $to_datetime_a = strtotime("+10 day");
        $name_a = "Banner A";
        $uri_a = "http://www.example.com/image_a.jpg";
        $weight_a = 0.1;

        $bannerManager->add($from_datetime_a,$to_datetime_a,$weight_a,$name_a,$uri_a);

        // If in office, can see
        $banner = $bannerManager->get(self::IP_IN_OFFICE_1);
        self::assertEquals($banner->getName(),$name_a);

        $banner = $bannerManager->get(self::IP_IN_OFFICE_2);
        self::assertEquals($banner->getName(),$name_a);

        $banner = $bannerManager->get(self::IP_IN_OFFICE_3);
        self::assertEquals($banner->getName(),$name_a);

        // If out of office, can not see
        $banner = $bannerManager->get(self::IP_NOT_IN_OFFICE);
        self::assertNull($banner);
    }

    /**
     * Test that a banner with a greater weight is returned more often
     *
     * @return void
     */
    public function testWeight()
    {
        $bannerManager = new Banner\BannerManager\BannerManager();

        // Add a valid banner with weight 0.1 (A)
        $from_datetime_a = strtotime("-1 day");
        $to_datetime_a = strtotime("+1 day");
        $name_a = "Banner A";
        $uri_a = "http://www.example.com/image_a.jpg";
        $weight_a = 0.1;

        $bannerManager->add($from_datetime_a,$to_datetime_a,$weight_a,$name_a,$uri_a);

        // Add a valid banner (B)
        $from_datetime_b = strtotime("-2 days");
        $to_datetime_b = strtotime("+1 week");
        $name_b = "Banner B";
        $uri_b = "http://www.example.com/image_b.jpg";
        $weight_b = 0.4;

        $bannerManager->add($from_datetime_b,$to_datetime_b,$weight_b,$name_b,$uri_b);

        // run this 100 times and count the results
        $count_a = 0;
        $count_b = 0;
        for ($i = 0; $i < 10000; $i++) {
            $name = $bannerManager->get(self::IP_NOT_IN_OFFICE)->getName();
            if ($name == $name_a) {
                $count_a++;
            } else if ($name == $name_b) {
                $count_b++;
            }
        }
        $ratio = $count_b/$count_a;
        // fwrite(STDERR, print_r($ratio, TRUE));
        self::assertGreaterThan(3.5,$ratio);
        self::assertLessThan(4.5,$ratio);
    }

    public function testTBD()
    {
        $bannerManager = new Banner\BannerManager\BannerManager();

        // Add a valid banner with weight 0.1 (A)
        $from_datetime_a = strtotime("-1 day");
        $to_datetime_a = strtotime("+1 day");
        $name_a = "Banner A";
        $uri_a = "http://www.example.com/image_a.jpg";
        $weight_a = 0.1;

        $bannerManager->add($from_datetime_a,$to_datetime_a,$weight_a,$name_a,$uri_a);

        // Add a valid banner (B)
        $from_datetime_b = strtotime("+1 day");
        $to_datetime_b = strtotime("+1 week");
        $name_b = "Banner B";
        $uri_b = "http://www.example.com/image_b.jpg";
        $weight_b = 0.4;

        $bannerManager->add($from_datetime_b,$to_datetime_b,$weight_b,$name_b,$uri_b);

        // Add a valid banner (C)
        $from_datetime_c = strtotime("+1 day");
        $to_datetime_c = strtotime("+1 week");
        $name_c = "Banner C";
        $uri_c = "http://www.example.com/image_c.jpg";
        $weight_c = 0.4;

        $bannerManager->add($from_datetime_c,$to_datetime_c,$weight_c,$name_c,$uri_c);
    }
}
