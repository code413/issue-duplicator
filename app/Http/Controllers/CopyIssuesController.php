<?php

namespace App\Http\Controllers;

use App\Services\GithubService;

class CopyIssuesController extends Controller
{
    public function __invoke(GithubService $github)
    {
        $github->syncLabels(request('from'), request('to'));

        $issues = $github->syncIssues(request('from'), request('to'));

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
