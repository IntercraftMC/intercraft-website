<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class RegisterUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $username;
    protected $password;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (is_dir("/home/intercraftusers/" . $this->username))
            return;

        exec(
            "sudo " .
            escapeshellarg(base_path() . '/utils/create_user.sh') . ' ' .
            escapeshellarg($this->username) . ' ' .
            escapeshellarg($this->password) . ''
        );
    }
}
