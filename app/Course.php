<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
	/**
	 * @var array
	 */
	protected $fillable = ['id', 'name', 'address', 'value', 'teacher_id']	;
	/**
	 * @var array
	 */
	protected $hidden = ['create_at', 'updated_at'];

	public function students(){
		return $this->belongsToMany(Student::class);
	}

	public function teacher(){
		return $this->hasOne(Teacher::class);
	}
}
