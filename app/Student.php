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
	 * rules for this model
	 * @var array
	 */
	public static $rules = [
		'name' => 'required',
		'phone' => 'required|numeric',
		'address' => 'required',
		'career' => 'required|in:engineering,math,physics'
	];

	/**
	 * courses this student attends
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function courses(){
		return $this->belongsToMany(Course::class);
	}
}
