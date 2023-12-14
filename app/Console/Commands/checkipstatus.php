<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class checkipstatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
    //     $ip = '172.16.12.234';

    // // Execute the system command to ping the IP
    // exec("ping -c 4 " . $ip, $output, $result);

    // // Check the result of the ping command
    // if ($result === 0) {
    //     // IP is up
    //     return response()->json(['status' => 'up']);
    // } else {
    //     // IP is down
    //     return response()->json(['status' => 'down']);
    // }
        return 0;
    }
}
