<?php

namespace DCS\Security\Auth\FormBundle\Tests\DependencyInjection;

use DCS\Security\Auth\FormBundle\DependencyInjection\DCSSecurityAuthFormExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DCSSecurityAuthFormExtensionTest extends \PHPUnit_Framework_TestCase
{
    private $container;

    protected function setUp()
    {
        $this->container = new ContainerBuilder();

        $mock = $this->getMockBuilder(DCSSecurityAuthFormExtension::class)->setMethods(['processConfiguration'])->getMock();
        $mock->load([], $this->container);
    }

    public function testParameters()
    {
        $this->assertTrue($this->container->hasParameter('dcs_security.auth.form.view'));
        $this->assertEquals('DCSSecurityAuthFormBundle:Security:login.html.twig', $this->container->getParameter('dcs_security.auth.form.view'));

        $this->assertTrue($this->container->hasParameter('dcs_security.auth.form.csrf'));
        $this->assertTrue(is_array($this->container->getParameter('dcs_security.auth.form.csrf')));
    }
}