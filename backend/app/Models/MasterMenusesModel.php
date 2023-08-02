<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterMenusesModel extends Model
{
    use HasFactory;
    protected $table      = 'm_menuses';
    protected $primaryKey = 'id';
    protected $guarded    = 'id';
}
