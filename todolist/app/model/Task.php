<?php

namespace App\Model;
use App\Model\Model;

class Task extends Model {
  protected $fillable = ['title', 'description', 'status_type', 'task_date', 'complete','user_id'];
}