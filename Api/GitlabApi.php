<?php

namespace Chaplean\Bundle\GitlabClientBundle\Api;

use Chaplean\Bundle\ApiClientBundle\Api\AbstractApi;
use Chaplean\Bundle\ApiClientBundle\Api\Parameter;
use Chaplean\Bundle\ApiClientBundle\Api\Route;
use GuzzleHttp\ClientInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class GitlabApi.
 *
 * @package   Chaplean\Bundle\GitlabClientBundle\Api
 * @author    Hugo - Chaplean <hugo@chaplean.coop>
 * @copyright 2014 - 2018 Chaplean (https://www.chaplean.coop)
 *
 * @method Route getPipeline()
 * @method Route getArtifacts()
 * @method Route getCommits()
 */
class GitlabApi extends AbstractApi
{
    /**
     * @var string
     */
    protected $urlPrefix;

    /**
     * @var string
     */
    protected $token;

    /**
     * GitlabApi constructor.
     *
     * @param ClientInterface          $client
     * @param EventDispatcherInterface $eventDispatcher
     * @param string                   $urlPrefix
     * @param string                   $token
     */
    public function __construct(ClientInterface $client, EventDispatcherInterface $eventDispatcher, $urlPrefix, $token)
    {
        $this->urlPrefix = $urlPrefix;
        $this->token = $token;

        parent::__construct($client, $eventDispatcher);
    }

    /**
     * @return void
     */
    public function buildApi()
    {
        $this->globalParameters()
            ->headers(
                [
                    'PRIVATE-TOKEN' => Parameter::string()
                        ->defaultValue($this->token)
                ]
            )
            ->sendJson()
            ->expectsJson()
            ->urlPrefix($this->urlPrefix);

        $this->get('pipeline', '/projects/{project_id}/pipelines/{pipeline_id}')
            ->urlParameters(
                [
                    'project_id'  => Parameter::id(),
                    'pipeline_id' => Parameter::id()
                ]
            );

        $this->get('artifacts', '/projects/{project_id}/jobs/{job_id}/artifacts')
            ->expectsBinary()
            ->urlParameters(
                [
                    'project_id' => Parameter::id(),
                    'job_id'     => Parameter::id()
                ]
            );

        $this->get('commits', '/projects/{project_id}/merge_requests/{merge_request_id}/commits')
            ->urlParameters(
                [
                    'project_id'       => Parameter::id(),
                    'merge_request_id' => Parameter::string()
                ]
            )
            ->queryParameters(
                [
                    'per_page' => Parameter::int()
                        ->defaultValue(100),
                ]
            );
    }
}
