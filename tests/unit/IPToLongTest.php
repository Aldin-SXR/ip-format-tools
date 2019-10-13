<?php

use PHPUnit\Framework\TestCase;
use IPFormat\IPFormat;

class IPToLongTest extends TestCase {

    public function testCorrectlyConvertsIpv4ToLong() {
        $values = [
            '80.65.165.50',
            '94.34.1.57',
            '31.45.77.112'
        ];

        $expected = [
            1346479410,
            1579286841,
            523062640
        ];

        foreach ($values as $i => $value) {
            $this->assertEquals($expected[$i], IPFormat::ip_to_long($value));
        }
    }

    public function testCorrectlyConvertsIpv6ToLong() {
        $values = [
            '2001:4860:4860::8888',
            '2001::7334',
            '::ffff:5e22:0139',
            '::ffff:32.177.209.53',
        ];


        $expected = [
            '42541956123769884636017138956568135816',
            '42540488161975842760550356425300276020',
            '281472261030201',
            '281471230267701'
        ];

        foreach ($values as $i => $value) {
            $this->assertEquals($expected[$i], IPFormat::ip_to_long($value));
        }
    }

    public function testCorrectlyConvertsLongToIpv4() {
        $values = [
            724989152,
            2049003008,
            4278193505
        ];

        $expected = [
            '43.54.116.224',
            '122.33.78.0',
            '255.0.13.97'
        ];

        foreach ($values as $i => $value) {
            $this->assertEquals($expected[$i], IPFormat::long_to_ip($value));
        }
    }

    public function testCorrectlyConvertsLongToIpv6() {
        $values = [
            '42541956123769884636017138956568135816',
            '42540488161975842760550356425300276020',
            '281472261030201'
        ];

        $expected = [
            '2001:4860:4860::8888',
            '2001::7334',
            'ffff:94.34.1.57'
        ];

        foreach ($values as $i => $value) {
            $this->assertEquals($expected[$i], IPFormat::long_to_ip($value));
        }
    }

    public function testCorrectlyHandlesIncorrectIpAddresses() {
        $values = [
            '45.275.22.15',
            '193.343.23.21.087',
            'notAnIpAddress',
            '2001:4860:4860::88888'
        ];

        foreach ($values as $i => $value) {
            $this->assertEquals(false, IPFormat::ip_to_long($value));
        }
    }
}