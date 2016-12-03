<?php

namespace DCS\Security\Auth\FormBundle\Tests;

use DCS\Security\Auth\FormBundle\DCSSecurityAuthFormBundle;
use DCS\Security\Auth\FormBundle\DependencyInjection\Factory\SecurityFactory;
use Symfony\Bundle\SecurityBundle\DependencyInjection\SecurityExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DCSSecurityAuthFormBundleTest extends \PHPUnit_Framework_TestCase
{
    public function testSecurityListenerFactory()
    {
        $securityExtension = $this->getMockBuilder(SecurityExtension::class)->getMock();
        $securityExtension->expects($this->once())
            ->method('addSecurityListenerFactory')
            ->with($this->isInstanceOf(SecurityFactory::class));

        $containerBuilder = $this->getMockBuilder(ContainerBuilder::class)->getMock();
        $containerBuilder->expects($this->once())
            ->method('getExtension')
            ->with('security')
            ->willReturn($securityExtension);

        $bundle = new DCSSecurityAuthFormBundle();
        $bundle->build($containerBuilder);
    }
}