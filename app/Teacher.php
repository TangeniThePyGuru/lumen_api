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

	public function courses(){
		return $this->hasMany(Course::class);
	}


}
