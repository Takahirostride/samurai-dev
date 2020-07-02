<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Mail; 

use Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use App\Jobs\ScrapeJob;
use App\Jobs\ScrapeUpdateJob;

use DOMDocument;
use DOMXPath;

class ScrapeController extends Controller
{
    //
	public $flag = false;
	public $total_count = 1;
	
	public function scrape() {
		ini_set('max_execution_time', -1);
		$page_count = 3; 
		$data = array('page_count'=>$page_count);
		$job = (new ScrapeJob($data))->delay(60);
//        ScrapeJob::dispatch($data);
		$this->dispatch($job);
		return "Scraping now";
	}
	
	public function update() {
		ini_set('max_execution_time', -1);
		$page_count = 3; 
		$data = array('page_count'=>$page_count);
		$job = (new ScrapeUpdateJob($data))->delay(60);
		$this->dispatch($job);
		return "Scraping Update now. Check your log please...";
	}
}
