<?php

namespace DCS\Security\Auth\FormBundle\Tests\DependencyInjection;

use DCS\Security\Auth\FormBundle\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\BooleanNode;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\ScalarNode;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Configuration
     */
    private $configuration;

    protected function setUp()
    {
        $this->configuration = new Configuration();
    }

    public function testInstance()
    {
        $this->assertInstanceOf(ConfigurationInterface::class, $this->configuration);
    }

    public function testGetConfigTreeBuilder()
    {
        $this->assertInstanceOf(TreeBuilder::class, $this->configuration->getConfigTreeBuilder());
    }

    public function testRootNodeNameBuilder()
    {
        $treeBuilder = $this->configuration->getConfigTreeBuilder();
        $this->assertEquals('dcs_security_auth_form', $treeBuilder->buildTree()->getName());
    }

    public function testViewNode()
    {
        $treeBuilder = $this->configuration->getConfigTreeBuilder();

        /** @var \Symfony\Component\Config\Definition\ArrayNode $tree */
        $tree = $treeBuilder->buildTree();

        $children = $tree->getChildren();

        $this->assertArrayHasKey('view', $children);
        $this->assertInstanceOf(ScalarNode::class, $children['view']);
        $this->assertEquals('DCSSecurityAuthFormBundle:Security:login.html.twig', $children['view']->getDefaultValue());
    }

    public function testCsrfTokenNode()
    {
        $treeBuilder = $this->configuration->getConfigTreeBuilder();

        /** @var \Symfony\Component\Config\Definition\ArrayNode $tree */
        $tree = $treeBuilder->buildTree();

        $children = $tree->getChildren();

        $this->assertArrayHasKey('csrf_token', $children);

        $csrfTokenChildren = $children['csrf_token']->getChildren();

        $this->assertArrayHasKey('enable', $csrfTokenChildren);
        $this->assertArrayHasKey('parameter', $csrfTokenChildren);
        $this->assertArrayHasKey('id', $csrfTokenChildren);

        $this->assertInstanceOf(BooleanNode::class, $csrfTokenChildren['enable']);
        $this->assertInstanceOf(ScalarNode::class, $csrfTokenChildren['parameter']);
        $this->assertInstanceOf(ScalarNode::class, $csrfTokenChildren['id']);

        $this->assertTrue($csrfTokenChildren['enable']->getDefaultValue());
        $this->assertEquals('_csrf_token', $csrfTokenChildren['parameter']->getDefaultValue());
        $this->assertEquals('authenticate', $csrfTokenChildren['id']->getDefaultValue());
    }
}