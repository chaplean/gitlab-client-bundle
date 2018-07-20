<?php

namespace Chaplean\Bundle\GitlabClientBundle\Tests\DependencyInjection;

use Chaplean\Bundle\GitlabClientBundle\DependencyInjection\ChapleanGitlabClientExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class ChapleanGitlabClientExtensionTest.
 *
 * @package   Chaplean\Bundle\GitlabClientBundle\Tests\DependencyInjection
 * @author    Hugo - Chaplean <hugo@chaplean.coop>
 * @copyright 2014 - 2017 Chaplean (http://www.chaplean.coop)
 * @since     1.0.0
 */
class ChapleanGitlabClientExtensionTest extends TestCase
{
    /**
    /**
     * @covers \Chaplean\Bundle\GitlabClientBundle\DependencyInjection\ChapleanGitlabClientExtension::load()
     *
     * @return void
     * @throws \Exception
     */
    public function testConfigIsLoadedInParameters()
    {
        $container = new ContainerBuilder();
        $loader = new ChapleanGitlabClientExtension();
        $loader->load([['api' => ['url' => 'url', 'token' => 'token']]], $container);

        $this->assertEquals('%chaplean_gitlab_client.url%', $container->getParameter('chaplean_gitlab_client.api.url'));
        $this->assertEquals('%chaplean_gitlab_client.token%', $container->getParameter('chaplean_gitlab_client.api.token'));
    }
}
