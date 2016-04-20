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

    protected $client;
    protected $person;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Person $person)
    {
        $settings = [
            'username' => 'Family Tree',
            'channel' => '#general',
            'link_names' => true    
        ];
        
        $this->client = new Client(env('SLACK_WEBHOOK'), $settings);
        $this->person = $person;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->client->send('New person added to Family Tree, name is ' . $this->person->first_name . ' ' . $this->person->last_name);
        
    }
}
