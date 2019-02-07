<?php

namespace Chaplean\Bundle\GitlabClientBundle\Tests\Api;

use Chaplean\Bundle\GitlabClientBundle\Api\GitlabApi;
use Chaplean\Bundle\ApiClientBundle\Api\Response\Failure\InvalidParameterResponse;
use Chaplean\Bundle\ApiClientBundle\Api\Route;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * GitlabApiTest.php.
 *
 * @author    Hugo - Chaplean <hugo@chaplean.coop>
 * @copyright 2014 - 2018 Chaplean (https://www.chaplean.coop)
 */
class GitlabApiTest extends MockeryTestCase
{
    /**
     * @var ClientInterface|\Mockery\MockInterface
     */
    private $client;

    /**
     * @var EventDispatcherInterface|\Mockery\MockInterface
     */
    private $eventDispatcher;

    /**
     * @var GitlabApi
     */
    private $api;

    /**
     * @return void
     */
    public function setUp()
    {
        $this->client = \Mockery::mock(ClientInterface::class);
        $this->eventDispatcher = \Mockery::mock(EventDispatcherInterface::class);
        $this->api = new GitlabApi($this->client, $this->eventDispatcher, 'url', 'token');

        $this->client->shouldReceive('request')->andReturn(new Response(200));
        $this->eventDispatcher->shouldReceive('dispatch');
    }

    /**
     * @covers  \Chaplean\Bundle\GitlabClientBundle\Api\GitlabApi::__construct()
     *
     * @return void
     */
    public function testConstruct()
    {
        $this->assertInstanceOf(GitlabApi::class, $this->api);
    }

    /**
     * @covers \Chaplean\Bundle\GitlabClientBundle\Api\GitlabApi::buildApi()
     *
     * @return void
     */
    public function testGetRoutes()
    {
        $this->assertInstanceOf(Route::class, $this->api->getArtifacts());
        $this->assertInstanceOf(Route::class, $this->api->getArtifacts());
    }

    /**
     * @covers \Chaplean\Bundle\GitlabClientBundle\Api\GitlabApi::buildApi()
     *
     * @return void
     */
    public function testBuildApiPrefixIsCorrectlyConfigured()
    {
        $this->assertStringStartsWith('url', $this->api->getArtifacts()->bindUrlParameters(['project_id' => 1, 'job_id' => 1])->getUrl());
    }

    /**
     * @covers \Chaplean\Bundle\GitlabClientBundle\Api\GitlabApi::buildApi()
     *
     * @return void
     */
    public function testGetArtifacts()
    {
        $response = $this->api->getArtifacts()
            ->bindUrlParameters(['project_id' => 1, 'job_id' => 1])
            ->exec();

        $this->assertNotInstanceOf(InvalidParameterResponse::class, $response);
    }

    /**
     * @covers \Chaplean\Bundle\GitlabClientBundle\Api\GitlabApi::buildApi()
     *
     * @return void
     */
    public function testGetArtifactsWithoutProjectId()
    {
        $response = $this->api->getArtifacts()
            ->bindUrlParameters(['job_id' => 1])
            ->exec();

        $this->assertInstanceOf(InvalidParameterResponse::class, $response);
    }

    /**
     * @covers \Chaplean\Bundle\GitlabClientBundle\Api\GitlabApi::buildApi()
     *
     * @return void
     */
    public function testGetArtifactsWithoutJobId()
    {
        $response = $this->api->getArtifacts()
            ->bindUrlParameters(['project_id' => 1])
            ->exec();

        $this->assertInstanceOf(InvalidParameterResponse::class, $response);
    }

    /**
     * @covers \Chaplean\Bundle\GitlabClientBundle\Api\GitlabApi::buildApi()
     *
     * @return void
     */
    public function testGetPipeline()
    {
        $response = $this->api->getPipeline()
            ->bindUrlParameters(['project_id' => 1, 'pipeline_id' => 1])
            ->exec();

        $this->assertNotInstanceOf(InvalidParameterResponse::class, $response);
    }

    /**
     * @covers \Chaplean\Bundle\GitlabClientBundle\Api\GitlabApi::buildApi()
     *
     * @return void
     */
    public function testGetPipelineWithoutPipelineId()
    {
        $response = $this->api->getPipeline()
            ->bindUrlParameters(['pipeline_id' => 1])
            ->exec();

        $this->assertInstanceOf(InvalidParameterResponse::class, $response);
    }

    /**
     * @covers \Chaplean\Bundle\GitlabClientBundle\Api\GitlabApi::buildApi()
     *
     * @return void
     */
    public function testGetPipelineWithoutJobId()
    {
        $response = $this->api->getPipeline()
            ->bindUrlParameters(['project_id' => 1])
            ->exec();

        $this->assertInstanceOf(InvalidParameterResponse::class, $response);
    }
}
