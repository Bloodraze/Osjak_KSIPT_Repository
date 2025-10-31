<?php
namespace Tests;
use PHPUnit\Framework\TestCase;
require 'Задание 1\index.php';
require 'Задание 2\index.php';


class IndexTest extends TestCase
{
    public function testIndex1(): void
    {
      $string = " djs  ksdsl lklsd   sldsfsf dswf  fff  ";
       
       $result = spaceRemove($string);
       self::assertEquals("djs ksdsl lklsd sldsfsf dswf fff",$result);
    }
    public function testIndex2(): void
    {
      $goods = [
        [
          'title' => 'Compans',
          'price' => 13000,
          'quantity' => 5,
          'discount' =>5
        ],
        [
          'title' => 'Altair',
          'price' => 15000,
          'quantity' => 15,
          'discount' => 20
        ],
        [
          'title' => 'Zevs',
          'price' => 25000,
          'quantity' => 0,
          'discount' => 11
        ],
        [
          'title' => 'Oven',
          'price' => 18000,
          'quantity' => 3,
          'discount' => 45
        ],
      ];
       
       $result = sortFullPrice($goods, 300, 500);
       self::assertEquals([
        [
          'title' => 'Oven',
          'price' => 18000,
          'quantity' => 3,
          'discount' => 45
        ],
        [
          'title' => 'Altair',
          'price' => 15000,
          'quantity' => 15,
          'discount' => 20
        ],
        [
          'title' => 'Compans',
          'price' => 13000,
          'quantity' => 5,
          'discount' =>5
        ],
     
      ],$result);
    }
}

