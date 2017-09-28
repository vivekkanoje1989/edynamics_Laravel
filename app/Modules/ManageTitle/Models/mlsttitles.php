<?php 
namespace App\Modules\ManageTitle\Models;

use Illuminate\Database\Eloquent\Model;

class mlsttitles extends Model {

	public $timestamps = false;
    protected $connection = 'masterdb';
    protected $primaryKey = 'id';
    protected $table = 'mlst_titles';
    protected $casts = [
        'id' => 'int',     
    ];
    
    protected $fillable = [
        'id',
        'title',
        'status',
        'created_date',
        'created_at',
        'created_by',
        'created_IP',
        'created_browser',
        'created_mac_id',
    ];

}