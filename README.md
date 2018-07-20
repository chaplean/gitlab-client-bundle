# Getting Started With ChapleanGitlabClientBundle

[![build status](https://git.chaplean.coop/open-source/bundle/gitlab-client-bundle/badges/master/build.svg)](https://git.chaplean.coop/open-source/bundle/gitlab-client-bundle/commits/master)
[![build status](https://git.chaplean.coop/open-source/bundle/gitlab-client-bundle/badges/master/coverage.svg)](https://git.chaplean.coop/open-source/bundle/gitlab-client-bundle/commits/master)

# Prerequisites

This version of the bundle requires Symfony 2.8+.

# Installation

## 1. Composer

```bash
composer require chaplean/gitlab-client-bundle
```

## 2. AppKernel.php

Add

```php
new Chaplean\Bundle\GitlabClientBundle\ChapleanGitlabClientBundle(),
```

# Configuration

## 1. config.yml

```yml
imports:
    - { resource: '@ChapleanGitlabClientBundle/Resources/config/config.yml' }
```

## 2. paramters.yml

```yml
chaplean_gitlab_client.url: 'your gitlab url'
chaplean_gitlab_client.token: 'your access token'
```

#Available functions:

* getPipeline()
* getArtifacts()
* getCommits()
