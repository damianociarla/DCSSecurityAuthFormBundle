<?php

namespace DCS\Security\Auth\FormBundle\DependencyInjection\Factory;

use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\FormLoginFactory;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Reference;

class SecurityFactory extends FormLoginFactory
{
    public function getKey()
    {
        return 'dcs_form';
    }

    protected function createAuthProvider(ContainerBuilder $container, $id, $config, $userProviderId)
    {
        $provider = 'dcs_security.core.authentication.provider.'.$id;

        $container
            ->setDefinition($provider, new DefinitionDecorator('dcs_security.core.authentication.provider'))
            ->replaceArgument(0, new Reference($userProviderId))
            ->replaceArgument(2, $id);

        return $provider;
    }
}