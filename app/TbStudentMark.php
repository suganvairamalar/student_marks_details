<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TbStudentMark extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tb_student_marks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['student_id', 'mark1', 'mark2', 'mark3', 'total', 'rank','result'];
}
