<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session, Cookie;

class AdminEditInfo extends Model
{
    protected $table = 'admin_edit_info';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'staff_id',
        'staff_name',
        'edit_page',
        'edit_content',
    ];
    
    public $timestamps = false;

    public static function add_info($edit_page, $edit_content, $staff_id=null, $staff_name=null)
    {
		if ($staff_id == null)
			$staff_id = @session('admin_id');
		if ($staff_name == null)
			$staff_name = @session('admin_name');
		self::create([
			"staff_id" => $staff_id,
			"staff_name" => $staff_name,
			"edit_page" => $edit_page,
			"edit_content" => $edit_content
		]);
    }
}
