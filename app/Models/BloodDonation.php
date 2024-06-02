<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BloodDonation
 * 
 * @property int $id
 * @property int $hf_id
 * @property int $donor_id
 * @property Carbon $donor_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Donor $donor
 * @property HealthFacility $health_facility
 * @property Collection|BloodStock[] $blood_stocks
 *
 * @package App\Models
 */
class BloodDonation extends Model
{
	protected $table = 'blood_donations';

	protected $casts = [
		'hf_id' => 'int',
		'donor_id' => 'int',
		'donor_date' => 'datetime'
	];

	protected $fillable = [
		'hf_id',
		'donor_id',
		'donor_date'
	];

	public function donor()
	{
		return $this->belongsTo(Donor::class);
	}

	public function health_facility()
	{
		return $this->belongsTo(HealthFacility::class, 'hf_id');
	}

	public function blood_stocks()
	{
		return $this->hasMany(BloodStock::class, 'donation_id');
	}
}
