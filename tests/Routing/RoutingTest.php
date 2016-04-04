<?php

namespace DCS\Security\Auth\FormBundle\Tests\Routing;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\XmlFileLoader;
use Symfony\Component\Routing\RouteCollection;

class RoutingTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider loadRoutingProvider
     */
    public function testLoadRouting($routeName, $path, array $methods)
    {
        $locator = new FileLocator();
        $loader = new XmlFileLoader($locator);

        $collection = new RouteCollection();
        $collection->addCollection($loader->load(__DIR__.'/../../src/Resources/config/routing/security.xml'));

        $route = $collection->get($routeName);
        
        $this->assertNotNull($route, sprintf('The route "%s" should exists', $routeName));
        $this->assertEquals($path, $route->getPath());
        $this->assertEquals($methods, $route->getMethods());
    }

    public function loadRoutingProvider()
    {
        return [
            ['dcs_security_login', '/login', ['GET', 'POST']],
            ['dcs_security_login_check', '/login_check', ['POST']],
            ['dcs_security_logout', '/logout', ['GET']],
        ];
    }
}