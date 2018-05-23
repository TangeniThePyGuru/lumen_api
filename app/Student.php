<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	/**
	 * @var array
	 */
	protected $fillable = ['id', 'name', 'address', 'phone', 'career'];
	/**
	 * @var array
	 */
	protected $hidden = ['create_at', 'updated_at'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function courses(){
		return $this->belongsTo(Course::class);
	}
}
