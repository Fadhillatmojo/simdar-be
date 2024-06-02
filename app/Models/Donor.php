<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Donor
 * 
 * @property int $id
 * @property string $name
 * @property string $gender
 * @property string $blood_type
 * @property string $rhesus_type
 * @property Carbon $date_of_birth
 * @property string $address
 * @property string $phone_number
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|BloodDonation[] $blood_donations
 * @property Collection|BloodRequest[] $blood_requests
 * @property Collection|BloodUsage[] $blood_usages
 *
 * @package App\Models
 */
class Donor extends Model
{
	protected $table = 'donors';

	protected $casts = [
		'date_of_birth' => 'datetime'
	];

	protected $fillable = [
		'name',
		'gender',
		'blood_type',
		'rhesus_type',
		'date_of_birth',
		'address',
		'phone_number'
	];

	public function blood_donations()
	{
		return $this->hasMany(BloodDonation::class);
	}

	public function blood_requests()
	{
		return $this->hasMany(BloodRequest::class, 'responder_donor_id');
	}

	public function blood_usages()
	{
		return $this->hasMany(BloodUsage::class, 'requester_donor_id');
	}

	
}
