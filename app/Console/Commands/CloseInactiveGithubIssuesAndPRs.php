<?php

namespace App\Console\Commands;

use App\Services\GitHub\Issue;
use App\Services\GitHub\GitHub;
use Illuminate\Console\Command;

class CloseInactiveGithubIssuesAndPRs extends Command
{

    protected $signature = 'bot:close-inactive-github-issues-and-prs';

    protected $description = 'Close inactive GitHub issues and PRs';

    /** @var \App\Services\GitHub */
    protected $gitHub;

    public function __construct(GitHub $gitHub)
    {
        parent::__construct();

        $this->gitHub = $gitHub;
    }

    public function handle()
    {
        $this->info('Start closing issues and PRs...');

        $sixMonthsAgo = now()->subMonths(6);

        $this->gitHub->search('issues', "is:public state:open updated:<{$sixMonthsAgo->format('Y-m-d')} ")->map(function (
            array $issueAttributes
        ) {
            return Issue::create($issueAttributes);
        })->reject(function (Issue $issue) {
            return $issue->hasLabel(['enhancement', 'help wanted', 'bug']);
        })->each(function (Issue $issue) {
            $issue->close('Dear contributor, ' . PHP_EOL . PHP_EOL . "because this {$issue->type()} seems to be inactive for quite some time now, I've automatically closed it. If you feel this {$issue->type()} deserves some attention from my human colleagues feel free to reopen it.");

            $this->comment("Closed {$issue->url()}");
        });

        $this->info('All done');
    }
}
