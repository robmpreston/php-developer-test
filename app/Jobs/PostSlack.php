<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Models\Person;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maknz\Slack\Client;

class PostSlack extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $person;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Person $person)
    {
        $this->person = $person;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $settings = [
            'username' => 'Family Tree',
            'channel' => '#general',
            'link_names' => true
        ];

        $client = new Client(env('SLACK_WEBHOOK'), $settings);
        $client->send('New person added to Family Tree, name is ' . $this->person->name);
    }
}
