<?php

namespace Eccube\Tests\Repository;

use Eccube\Application;
use Eccube\Tests\EccubeTestCase;
use Plugin\Point\Entity\Point;
/**
 * Class PointInfoRepositoryTest
 *
 * @package Eccube\Tests\Repository
 */
class PointProductRateRepositoryTest extends EccubeTestCase
{
    public function testSavePointProductRate(){
        $Product = $this->createProductRate();
        $repository = $this->app['eccube.plugin.point.repository.pointproductrate'];
        $PointProduct = $repository->findOneBy(
            array('Product' => $Product)
        );
        $this->expected = 2;
        $this->actual = $PointProduct->getPlgPointProductRate();
        $this->verify();
    }

    public function testIsSamePoint(){
        $Product = $this->createProductRate();
        $repository = $this->app['eccube.plugin.point.repository.pointproductrate'];
        $isSamePoint = $repository->isSamePoint(2, $Product->getId());
        $this->assertTrue($isSamePoint);
    }

    public function testGetLastPointProductRateById(){
        $Product = $this->createProductRate();
        $repository = $this->app['eccube.plugin.point.repository.pointproductrate'];
        $productRatePoint = $repository->getLastPointProductRateById($Product->getId());
        $this->expected = 2;
        $this->actual = $productRatePoint;
        $this->verify();
    }

    public function testGetLastPointProductRate(){
        $Product = $this->createProductRate();
        $repository = $this->app['eccube.plugin.point.repository.pointproductrate'];
        $pointRate = $repository->getLastPointProductRate();
        $this->expected = 2;
        $this->actual = $pointRate;
        $this->verify();
    }

    public function testGetPointProductRateByEntity(){
        $Customer = $this->createCustomer();
        $Order = $this->createOrder($Customer);
        $repository = $this->app['eccube.plugin.point.repository.pointproductrate'];
        $OrderDetails = $Order->getOrderDetails();
        $Product = $OrderDetails[0]->getProduct();
        $products = array();
        $products[$Product->getId()] = $OrderDetails[0];
        $repository->savePointProductRate(2, $Product);
        $productRates = $repository->getPointProductRateByEntity($products);
        $this->expected = 2;
        $this->actual = $productRates[1];
        $this->verify();
    }

    public function createProductRate(){
        $Product = $this->createProduct();
        $repository = $this->app['eccube.plugin.point.repository.pointproductrate'];
        $repository->savePointProductRate(2, $Product);
        return $Product;
    }


}
