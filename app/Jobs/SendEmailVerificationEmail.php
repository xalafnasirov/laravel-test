<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmailVerificationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $link, public string $email)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $workspaceId = "fef55458-e1ea-474d-8aba-23c50c274828";
        $channelId = "499baace-9881-5524-8c93-076f3cbd3b8c";
        $accessKey = env('CHANNEL_ACCESS_KEY'); // Store your access key in .env

        $url = "https://nest.messagebird.com/workspaces/{$workspaceId}/channels/{$channelId}/messages";

        Http::withHeaders([
            'Authorization' => 'AccessKey ' . $accessKey, // Add the authorization header
            'Content-Type' => 'application/json' // Set content type
        ])
            ->post($url, [
                'receiver' => [
                    'contacts' => [
                        [
                            'identifierValue' => $this->email // Change this to the actual recipient email
                        ]
                    ]
                ],
                'body' => [
                    'type' => 'html',
                    'html' => [
                        'metadata' => [
                            'subject' => 'Otp code!' // Subject of the email
                        ],
                        'html' => "<p>Your verification link: <a href={$this->link} >Təsdiqlə</b></p>", // HTML body
                        'text' => 'Hello' // Plain text body
                    ]
                ]
            ]);
    }
}
