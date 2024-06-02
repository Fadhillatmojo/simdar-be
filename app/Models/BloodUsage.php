<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BloodUsage
 * 
 * @property int $id
 * @property int $requester_donor_id
 * @property int $stock_id
 * @property int $hf_id
 * @property string $purpose
 * @property Carbon $date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property HealthFacility $health_facility
 * @property Donor $donor
 * @property BloodStock $blood_stock
 *
 * @package App\Models
 */
class BloodUsage extends Model
{
	protected $table = 'blood_usage';

	protected $casts = [
		'requester_donor_id' => 'int',
		'stock_id' => 'int',
		'hf_id' => 'int',
		'date' => 'datetime'
	];

	protected $fillable = [
		'requester_donor_id',
		'stock_id',
		'hf_id',
		'purpose',
		'date'
	];

	public function health_facility()
	{
		return $this->belongsTo(HealthFacility::class, 'hf_id');
	}

	public function donor()
	{
		return $this->belongsTo(Donor::class, 'requester_donor_id');
	}

	public function blood_stock()
	{
		return $this->belongsTo(BloodStock::class, 'stock_id');
	}
}
