<?php

namespace App\Jobs;

use App\Models\TopTopupUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class TopupUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $top10Users = DB::table('topups')->select('user_id', DB::raw('SUM(amount) as count'))
            ->whereDate('created_at', \Carbon\Carbon::yesterday()->toDateString())
            ->groupBy('user_id')
            ->orderByDesc('count')
            ->limit(10)
            ->get();

        $top10Users->each(function ($user) {
            TopTopupUser::updateOrCreate(
                ['user_id' => $user->user_id],
                ['count' => $user->count]
            );
        });
    }
}
