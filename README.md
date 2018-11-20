# gitlab-client-bundle

[![build status](https://git.chaplean.coop/open-source/bundle/gitlab-client-bundle/badges/master/build.svg)](https://git.chaplean.coop/open-source/bundle/gitlab-client-bundle/commits/master)
[![build status](https://git.chaplean.coop/open-source/bundle/gitlab-client-bundle/badges/master/coverage.svg)](https://git.chaplean.coop/open-source/bundle/gitlab-client-bundle/commits/master)
[![contributions welcome](https://img.shields.io/badge/contributions-welcome-brightgreen.svg?style=flat)](https://github.com/chaplean/gitlab-client-bundle/issues)

This bundle allows you to use the [gitlab api](https://docs.gitlab.com/ce/api/) easily from your php code.

## Table of content

* [Installation](#Installation)
* [Configuration](#Configuration)
* [Usage](#Usage)
* [Versioning](#Versioning)
* [Contributing](#Contributing)
* [Hacking](#Hacking)
* [License](#License)

## Installation

This bundle requires at least Symfony 3.0.

You can use [composer](https://getcomposer.org) to install gitlab-client-bundle:
```bash
composer require chaplean/gitlab-client-bundle
```

Then add to your AppKernel.php:

```php
new Chaplean\Bundle\GitlabClientBundle\ChapleanGitlabClientBundle(),
```

## Configuration

First you will need to import bundle configuration.

config.yml:
```yaml
imports:
    - { resource: '@ChapleanGitlabClientBundle/Resources/config/config.yml' }
```

You must also create some parameters.

parameters.yml:
```yaml
parameters:
    chaplean_gitlab_client.url: 'your gitlab url'
    chaplean_gitlab_client.token: 'your access token'
```

## Usage

Here is an example of how to use the getPipelines route.

```php
$response = $gitlabApi->getPipelines()
    ->bindUrlParameters(['project_id' => 12, 'pipeline_id' => 42])
    ->exec();
    
if ($response->succeeded()) {
    $content = $response->getContent();
    // your code
}
```

### Available functions:

* [Pipelines](https://docs.gitlab.com/ce/api/pipelines.html)
    * [getPipeline()](https://docs.gitlab.com/ce/api/pipelines.html#get-a-single-pipeline)

* [Jobs](https://docs.gitlab.com/ce/api/jobs.html)
    * [getArtifacts()](https://docs.gitlab.com/ce/api/jobs.html#get-job-artifacts)

* [Merge Requests](https://docs.gitlab.com/ce/api/merge_requests.html)
    * [getCommits()](https://docs.gitlab.com/ce/api/merge_requests.html#get-single-mr-commits)

## Versioning

gitlab-client-bundle follows [semantic versioning](https://semver.org/). In short the scheme is MAJOR.MINOR.PATCH where
1. MAJOR is bumped when there is a breaking change,
2. MINOR is bumped when a new feature is added in a backward-compatible way,
3. PATCH is bumped when a bug is fixed in a backward-compatible way.

Versions bellow 1.0.0 are considered experimental and breaking changes may occur at any time.

## Contributing

Contributions are welcomed! There are many ways to contribute, and we appreciate all of them. Here are some of the major ones:

* [Bug Reports](https://github.com/chaplean/gitlab-client-bundle/issues): While we strive for quality software, bugs can happen and we can't fix issues we're not aware of. So please report even if you're not sure about it or just want to ask a question. If anything the issue might indicate that the documentation can still be improved!
* [Feature Request](https://github.com/chaplean/gitlab-client-bundle/issues): You have a use case not covered by the current api? Want to suggest a change or add something? We'd be glad to read about it and start a discussion to try to find the best possible solution.
* [Pull Request](https://github.com/chaplean/gitlab-client-bundle/pulls): Want to contribute code or documentation? We'd love that! If you need help to get started, GitHub as [documentation](https://help.github.com/articles/about-pull-requests/) on pull requests. We use the ["fork and pull model"](https://help.github.com/articles/about-collaborative-development-models/) were contributors push changes to their personnal fork and then create pull requests to the main repository. Please make your pull requests against the `master` branch.

As a reminder, all contributors are expected to follow our [Code of Conduct](CODE_OF_CONDUCT.md).

## Hacking

You might find the following commands usefull when hacking on this project:

```bash
# Install dependencies
composer install

# Run tests
bin/phpunit
```

## License

gitlab-client-bundle is distributed under the terms of the MIT license.

See [LICENSE](LICENSE.md) for details.
