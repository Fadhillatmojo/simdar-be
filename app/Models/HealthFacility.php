<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class HealthFacility
 * 
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $phone_number
 * @property string $email
 * @property string $password
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|BloodDonation[] $blood_donations
 * @property Collection|BloodRequest[] $blood_requests
 * @property Collection|BloodStock[] $blood_stocks
 * @property Collection|BloodUsage[] $blood_usages
 *
 * @package App\Models
 */

class HealthFacility extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
	protected $table = 'health_facilities';

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'address',
		'phone_number',
		'email',
		'password'
	];

	public function blood_donations()
	{
		return $this->hasMany(BloodDonation::class, 'hf_id');
	}

	public function blood_requests()
	{
		return $this->hasMany(BloodRequest::class, 'responder_hf_id');
	}

	public function blood_stocks()
	{
		return $this->hasMany(BloodStock::class, 'hf_id');
	}

	public function blood_usages()
	{
		return $this->hasMany(BloodUsage::class, 'hf_id');
	}
}
