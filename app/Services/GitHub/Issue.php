<?php

namespace App\Services\GitHub;

use Github\Client;

class Issue
{

    /** @var array */
    protected $issueAttributes;

    /** @var \App\Services\GitHub\GitHub */
    protected $gitHub;

    public static function create(array $issueAttributes): self
    {
        return app(static::class)->setAttributes($issueAttributes);
    }

    public function __construct(Client $gitHub)
    {
        $this->gitHub = $gitHub;
    }

    public function setAttributes(array $issueAttributes)
    {
        $this->issueAttributes = $issueAttributes;

        return $this;
    }

    public function number(): int
    {
        return $this->issueAttributes['number'];
    }

    public function repositoryName(): string
    {
        return array_reverse(explode('/', $this->issueAttributes['repository_url']))[0];
    }

    /**
     * @param string|array $searchLabels
     *
     * @return bool
     */
    public function hasLabel($searchLabels): bool
    {
        $searchLabels = array_wrap($searchLabels);

        $foundLabels = array_intersect($this->labelNames(), $searchLabels);

        return count($foundLabels) > 0;
    }

    public function labelNames(): array
    {
        return collect($this->issueAttributes['labels'])->pluck('name')->values()->toArray();
    }

    public function type(): string
    {
        return array_has($this->issueAttributes, 'pull_request') ? 'pull request' : 'issue';
    }

    public function url(): string
    {
        return $this->issueAttributes['html_url'];
    }

    public function close(string $message)
    {
        $this->gitHub->api('issue')->comments()->create('datacenter-automation', $this->repositoryName(), $this->number(), ['body' => $message]);

        $this->gitHub->api('issue')->update('datacenter-automation', $this->repositoryName(), $this->number(), ['state' => 'closed']);
    }
}
