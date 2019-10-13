<?php

use PHPUnit\Framework\TestCase;
use IPFormat\IPFormat;

class IPv4ToIPv6Test extends TestCase {

    public function testCorrectlyConvertsIpv4ToIpv6() {
        $values = [
            '94.34.1.57',
            '31.45.77.112',
            '0.1.1.1',
            '0.0.0.0'
        ];

        $expected = [
            'compressed' => [
                '::ffff:5e22:139',
                '::ffff:1f2d:4d70',
                '::ffff:1:101',
                '::ffff:0:0'
            ],
            'shortened' => [
                '0:0:0:0:0:ffff:5e22:0139',
                '0:0:0:0:0:ffff:1f2d:4d70',
                '0:0:0:0:0:ffff:0001:0101',
                '0:0:0:0:0:ffff:0:0'
            ],
            'expanded' => [
                '0000:0000:0000:0000:0000:ffff:5e22:0139',
                '0000:0000:0000:0000:0000:ffff:1f2d:4d70',
                '0000:0000:0000:0000:0000:ffff:0001:0101',
                '0000:0000:0000:0000:0000:ffff:0000:0000'
            ]
        ];

        foreach ($values as $i => $value) {
            $this->assertEquals($expected['compressed'][$i], IPFormat::ipv4_to_ipv6($value));
            $this->assertEquals($expected['shortened'][$i], IPFormat::ipv4_to_ipv6($value, 'shortened'));
            $this->assertEquals($expected['expanded'][$i], IPFormat::ipv4_to_ipv6($value, 'expanded'));
        }
    }

    public function testRejectsIncorrectIpv4Addresses() {
        $values = [
            '45.275.22.15',
            '193.343.23.21.087',
            'notAnIpAddress'
        ];

        foreach ($values as $i => $value) {
            $this->assertEquals(false, IPFormat::ipv4_to_ipv6($value));
        }
    }

    public function testRejectsIncorrectIpv6Format() {
        $this->assertEquals(false, IPFormat::ipv4_to_ipv6('23.110.78.90', 'incorrect'));
    }
}