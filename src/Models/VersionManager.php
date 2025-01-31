<?php

namespace HansoftTechnologies\LaravelSchemaVersionManager\Models;

use Illuminate\Database\Eloquent\Model;

class VersionManager extends Model
{
	public $table = "version_manager";
	
	protected $guarded = [];
}