<?php

namespace App\Http\Controllers;

use App\Jobs\TopupUserJob;
use App\Models\TopTopupUser;
use App\Models\Topup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TopUserController extends Controller
{
    public function index()
    {
        $topTopupUsers = TopTopupUser::with('user')->orderByDesc('count')->paginate(2);
        return view('top-users', compact('topTopupUsers'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $topTopupUsers = TopTopupUser::with('user')
            ->whereHas('user', function ($query) use ($search) {
                $query->where('id', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            })
            ->orderByDesc('count')
            ->paginate(2);
        return view('top-users', compact('topTopupUsers', 'search'));
    }
    public function findTopUsers()
    {
        try {
            TopupUserJob::dispatch();
            session()->flash('success', 'Top users are being calculated! Check back in a few minutes.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', 'Something went wrong!');
        }
        return redirect()->back();
    }
}
