<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Orders;
use Carbon\Carbon;
use App\Http\Controllers\MailController;

class ProductReportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:report {email} {start} {end}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Report order quantity';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
 
    public function handle()
    {
        $email = $this->argument('email');
        $data = ['email' => $email, 'count' => 0];
        $start = Carbon::parse($this->argument('start'));
        $end = Carbon::parse($this->argument('end'));
        $data['count'] = count(Orders::where('created_at', '>', $start)->where('created_at','<', $end)->get());
        MailController::sendOrdersReport($data);

        $this->info('Report has sent to email: '.$email.' '.$data['count']);      
    }
}
