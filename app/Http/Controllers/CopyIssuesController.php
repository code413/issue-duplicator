<?php

namespace App\Http\Controllers;

use App\Services\GithubService;

class CopyIssuesController extends Controller
{
    public function __invoke(GithubService $github)
    {
        if (request('labels')) {
            $github->syncLabels(
                request('from'),
                request('to'),
                request('labels') === 'aggressive'
            );
        }

        $issues = $github->syncIssues(request('from'), request('to'), request('labels') === null);

        return view(
            'home.success',
            [
                'from' => request('from'),
                'to' => request('to'),
                'issues' => $issues
            ]
        );
    }
}
