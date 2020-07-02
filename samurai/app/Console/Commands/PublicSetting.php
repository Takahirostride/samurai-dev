<?php
 
namespace App\Console\Commands;
 
use DB;
use Illuminate\Console\Command;
 
class PublicSetting extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'public:setting';
 
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change publication_setting';
 
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
     * @return mixed
     */
    public function handle()
    {
        $currentDate = date('Y-m-d');
        DB::table('policy')
        ->where('subscript_duration_detail', '<', $currentDate)
        ->where('subscript_duration_option', 0)
        ->where('publication_setting', 0)
        ->update(['publication_setting'=>3]);
        
        
    }
}