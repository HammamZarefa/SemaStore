<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\GlobalStatus;
use App\Traits\Searchable;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	use Searchable, GlobalStatus;

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function service()
	{
		return $this->belongsTo(Service::class);
	}

	public function provider()
	{
		return $this->belongsTo(ApiProvider::class, 'api_provider_id', 'id');
	}

	//Scopes
	public function scopePending($query)
	{
		$query->where('status', Status::ORDER_PENDING);
	}

	public function scopeProcessing($query)
	{
		$query->where('status', Status::ORDER_PROCESSING);
	}

	public function scopeCompleted($query)
	{
		$query->where('status', Status::ORDER_COMPLETED);
	}

	public function scopeCancelled($query)
	{
		$query->where('status', Status::ORDER_CANCELLED);
	}

	public function scopeRefunded($query)
	{
		$query->where('status', Status::ORDER_REFUNDED);
	}
}