<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
	/**
	 * @var array
	 */
	protected $fillable = ['id', 'name', 'address', 'phone', 'profession'];
	/**
	 * @var array
	 */
	protected $hidden = ['create_at', 'updated_at'];
	/**
	 * rules for the model
	 * @var array
	 */
	public static $rules = [
		'name' => 'required',
		'address' => 'required',
		'phone' => 'required|numeric',
		'profession' => 'required|in:engineering,math,physics'
	];

	/**
	 * courses this teacher teaches
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function courses(){
		return $this->hasMany(Course::class);
	}


}
