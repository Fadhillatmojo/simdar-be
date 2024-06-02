<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BloodRequest
 * 
 * @property int $id
 * @property int $requester_hf_id
 * @property int $responder_hf_id
 * @property int $responder_donor_id
 * @property int $quantity
 * @property string $status
 * @property string $purpose
 * @property Carbon $request_date
 * @property Carbon|null $confirmed_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property HealthFacility $health_facility
 * @property Donor $donor
 *
 * @package App\Models
 */
class BloodRequest extends Model
{
	protected $table = 'blood_requests';

	protected $casts = [
		'requester_hf_id' => 'int',
		'responder_hf_id' => 'int',
		'responder_donor_id' => 'int',
		'quantity' => 'int',
		'request_date' => 'datetime',
		'confirmed_date' => 'datetime'
	];

	protected $fillable = [
		'requester_hf_id',
		'responder_hf_id',
		'responder_donor_id',
		'quantity',
		'status',
		'purpose',
		'request_date',
		'confirmed_date'
	];

	public function health_facility()
	{
		return $this->belongsTo(HealthFacility::class, 'responder_hf_id');
	}

	public function donor()
	{
		return $this->belongsTo(Donor::class, 'responder_donor_id');
	}
}
