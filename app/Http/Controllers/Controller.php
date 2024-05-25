<?php

namespace App\Http\Controllers;

use App\Models\DetailTeam;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index() {
        $data = Project::with(['team.user', 'user'])->findOrFail(3);
        
        // dd($data);

        return view('project', compact('data'));
    }
}
