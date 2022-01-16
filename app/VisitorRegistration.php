<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitorRegistration extends Model
{
    protected $table = 'visitor_registration';

    protected $fillable = ['name', 'email', 'mobile', 'gender', 'date_of_birth', 'designation_id', 'department_id'];
}
