<?php namespace App\Modules\ProductManagement\Models;

use Illuminate\Database\Eloquent\Model;

class SubProduct extends Model {

	protected $primaryKey = 'id';
	protected $connection = 'masterdb';
    public $table = 'mlst_sub_products';
    public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'product_id',
		'sub_product_name',
        'created_date',
        'created_at',
        'created_by',
        'created_IP',
        'created_browser',
		'created_mac_id',
		'updated_date',
		'updated_at',
		'updated_by',
		'updated_IP',
		'updated_browser',
		'updated_mac_id',
		'deleted_status',
		'deleted_date',
		'deleted_by',
		'deleted_IP',
		'deleted_browser',
		'deleted_mac_id',
	];


}
