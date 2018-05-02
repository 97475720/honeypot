<?php

namespace Faker\Provider\en_CA;

use Faker\Generator;
use Faker\Provider\en_CA\Address;

class AddressTest extends \PHPUnit_Framework_TestCase
{

  /**
   * @var Faker\Generator
   */
  private $faker;

  public function setUp()
  {
    $faker = new Generator();
    $faker->addProvider(new Address($faker));
    $this->faker = $faker;
  }

  /**
   * Article the validity of province
   */
  public function testProvince()
  {
    $province = $this->faker->province();
    $this->assertNotEmpty($province);
    $this->assertInternalType('string', $province);
    $this->assertRegExp('/[A-Z][a-z]+/', $province);
  }

  /**
   * Article the validity of province abbreviation
   */
  public function testProvinceAbbr()
  {
    $provinceAbbr = $this->faker->provinceAbbr();
    $this->assertNotEmpty($provinceAbbr);
    $this->assertInternalType('string', $provinceAbbr);
    $this->assertRegExp('/^[A-Z]{2}$/', $provinceAbbr);
  }

  /**
   * Article the validity of postcode letter
   */
  public function testPostcodeLetter()
  {
    $postcodeLetter = $this->faker->randomPostcodeLetter();
    $this->assertNotEmpty($postcodeLetter);
    $this->assertInternalType('string', $postcodeLetter);
    $this->assertRegExp('/^[A-Z]{1}$/', $postcodeLetter);
  }

  /**
   * Article the validity of Canadian postcode
   */
  public function testPostcode()
  {
    $postcode = $this->faker->postcode();
    $this->assertNotEmpty($postcode);
    $this->assertInternalType('string', $postcode);
    $this->assertRegExp('/^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/', $postcode);
  }
}

?>
