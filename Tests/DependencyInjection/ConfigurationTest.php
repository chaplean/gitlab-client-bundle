<?php

namespace Chaplean\Bundle\GitlabClientBundle\Tests\DependencyInjection;

use Chaplean\Bundle\GitlabClientBundle\DependencyInjection\ChapleanGitlabClientExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class ConfigurationTest.
 *
 * @package   Chaplean\Bundle\GitlabClientBundle\Tests\DependencyInjection
 * @author    Hugo - Chaplean <hugo@chaplean.coop>
 * @copyright 2014 - 2017 Chaplean (http://www.chaplean.coop)
 * @since     1.0.0
 */
class ConfigurationTest extends TestCase
{
    /**
     * @covers \Chaplean\Bundle\GitlabClientBundle\DependencyInjection\Configuration::getConfigTreeBuilder()
     * @covers \Chaplean\Bundle\GitlabClientBundle\DependencyInjection\Configuration::addApiConfiguration()
     *
     * @return void
     * @throws \Exception
     */
    public function testFullyDefinedConfig()
    {
        $container = new ContainerBuilder();
        $loader = new ChapleanGitlabClientExtension();
        $loader->load([['api' => ['url' => 'url', 'token' => 'token']]], $container);

        $this->assertEquals('%chaplean_gitlab_client.url%', $container->getParameter('chaplean_gitlab_client.api.url'));
        $this->assertEquals('%chaplean_gitlab_client.token%', $container->getParameter('chaplean_gitlab_client.api.token'));
    }

    /**
     * @covers \Chaplean\Bundle\GitlabClientBundle\DependencyInjection\Configuration::getConfigTreeBuilder()
     * @covers \Chaplean\Bundle\GitlabClientBundle\DependencyInjection\Configuration::addApiConfiguration()
     *
     * @return void
     * @throws \Exception
     */
    public function testDefaultConfig()
    {
        $container = new ContainerBuilder();
        $loader = new ChapleanGitlabClientExtension();
        $loader->load([[]], $container);

        $this->assertEquals('%chaplean_gitlab_client.url%', $container->getParameter('chaplean_gitlab_client.api.url'));
        $this->assertEquals('%chaplean_gitlab_client.token%', $container->getParameter('chaplean_gitlab_client.api.token'));
    }
}
