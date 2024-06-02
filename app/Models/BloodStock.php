<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BloodStock
 * 
 * @property int $id
 * @property int $donation_id
 * @property int $hf_id
 * @property Carbon $entry_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property BloodDonation $blood_donation
 * @property HealthFacility $health_facility
 * @property Collection|BloodUsage[] $blood_usages
 *
 * @package App\Models
 */
class BloodStock extends Model
{
	protected $table = 'blood_stocks';

	protected $casts = [
		'donation_id' => 'int',
		'hf_id' => 'int',
		'entry_date' => 'datetime'
	];

	protected $fillable = [
		'donation_id',
		'hf_id',
		'entry_date'
	];

	public function blood_donation()
	{
		return $this->belongsTo(BloodDonation::class, 'donation_id');
	}

	public function health_facility()
	{
		return $this->belongsTo(HealthFacility::class, 'hf_id');
	}

	public function blood_usages()
	{
		return $this->hasMany(BloodUsage::class, 'stock_id');
	}
}
