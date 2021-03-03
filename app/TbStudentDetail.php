<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TbStudentDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    //use Sortable;

    protected $table = 'tb_student_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['student_name'];
}
