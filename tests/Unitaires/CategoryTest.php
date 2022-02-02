<?php

namespace App\Tests\Unitaires;

use App\Entity\Category;
use App\Entity\Wish;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function testSomething(): void
    {
        $categorie = (new Category())
            ->setOthers("Sports");

        $this->assertEquals("Sports",$categorie->getOthers());
        $this->assertNotEquals("Couture", $categorie->getOthers());
        $this->assertNull($categorie->getId());

    }
    public function testWishes(): void{

        $categorie =(new Category())
            ->getOthers("Voyages");
        $this->assertCount(0,$categorie->getWishes());
        $categorie->addWish(new Wish());
        $this->assertCount(1,$categorie->getWishes());
    }
}
