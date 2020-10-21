<?php

namespace App\Http\Controllers;

use Github\Client;

class CopyIssuesController extends Controller
{
    public function __invoke()
    {
        $client = new Client();

        $user = auth()->user();

        $client->authenticate($user->token, null, Client::AUTH_ACCESS_TOKEN);

        $fromUser = explode('/', request('from'))[0];
        $fromRepo = explode('/', request('from'))[1];

        $toUser = explode('/', request('to'))[0];
        $toRepo = explode('/', request('to'))[1];

        $issues = $client->api('issue')->all($fromUser, $fromRepo, array('state' => 'open'));

        $this->syncLabels($client, $fromUser, $fromRepo, $toUser, $toRepo);

        foreach ($issues as $issue) {
            $labels = [];

            foreach($issue['labels'] ?? [] as $label){
                $labels[] = $label['name'];
            }

            $client->api('issue')->create(
                $toUser,
                $toRepo,
                [
                    'title' => $issue['title'],
                    'body' => $issue['body'],
                    'labels' => $labels
                ]
            );
        }

        return view('home.success', [
            'from' => request('from'),
            'to' => request('to'),
            'issues' => $issues
        ]);
    }

    protected function syncLabels($client, $fromUser, $fromRepo, $toUser, $toRepo){
        $labels = $client->api('issue')->labels()->all($fromUser, $fromRepo);

        foreach($labels as $label){
            try{
                $client->api('issue')->labels()->create($toUser, $toRepo, [
                    'name' => $label['name'],
                    'description' => $label['description'] ?? '',
                    'color' => $label['color'] ?? null,
                ]);
            }catch (\Exception $exception){
                report($exception);
            }
        }
    }
}
