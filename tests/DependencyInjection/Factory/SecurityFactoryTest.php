<?php

namespace DCS\Security\Auth\FormBundle\Tests\DependencyInjection\Factory;

use DCS\Security\Auth\FormBundle\DependencyInjection\Factory\SecurityFactory;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class SecurityFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testGetKeyMethod()
    {
        $security = new SecurityFactory();
        $this->assertEquals('dcs_form', $security->getKey());
    }

    public function testCreateAuthProviderMethod()
    {
        $container = new ContainerBuilder();
        $security = new SecurityFactory();

        $configuration = [
            'remember_me' => false,
            'login_path' => '/login',
            'use_forward' => true
        ];

        $security->create($container, 'acme', $configuration, 'user_provider_id', 'default_entry_point_id');
        $this->assertTrue($container->hasDefinition('dcs_security.core.authentication.provider.acme'));
    }
}