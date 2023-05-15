<?php

namespace App\Models;

use App\Traits\GlobalStatus;
use App\Traits\Searchable;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
	use Searchable, GlobalStatus;


	public function category()
	{
		return $this->belongsTo(Category::class)->withDefault();
	}

	public function provider()
	{
		return $this->belongsTo(ApiProvider::class, 'api_provider_id', 'id');
	}
}
