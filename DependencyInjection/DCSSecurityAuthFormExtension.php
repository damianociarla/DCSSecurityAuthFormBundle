<?php

namespace DCS\Security\Auth\FormBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class DCSSecurityAuthFormExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $configs);

        $container->setParameter('dcs_security.auth.form.view', $config['view']);
        $container->setParameter('dcs_security.auth.form.csrf', $config['csrf_token']);
    }
}