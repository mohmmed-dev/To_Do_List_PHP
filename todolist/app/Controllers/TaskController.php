<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Validation;
use App\Model\Task;

class TaskController {

  protected $table;

  public function __construct() {
    $this->table = new Task();
  }


  public function index() {
    $auth = auth();
    if(!empty($auth)) {
      $tasks =  $this->table->where('user_id', '=', $auth->id);
    } else {
      $tasks =  [];
    }
    return view('tasks.index',['tasks'=> $tasks,'filter' => 'all']);
  }

  public function store() {
    $auth = auth();
    if(empty($auth)) {
      return redirect('login');
    }
    $rules = [
      'title' => 'required|string',
      'description' => 'required|string',
      'status_type' => 'numeric',
      'task_date' => 'string'
    ];
    
    $data = [
      'title' => Request::get("title"),
      'description' =>  Request::get("description"),
      'status_type' => Request::get("status"),
      'task_date' => Request::get("date")
    ];
    $data = Validation::make($data,$rules); 
    $data['user_id'] = $auth->id;
    $this->table->create($data);
    return back();
  }

  public function done() {
    $auth = auth();
    $userId = Request::get('user_id');
    if($auth->id != $userId) {
      return back();
    }
    $taskId = Request::get("taskId");
    $complete = Request::get("complete") == 1 ? 0 : 1 ;
    $this->table->update($taskId,['complete' => $complete]);
    return back();
  }

  public function update() {
    $auth = auth();
    $userId = Request::get('user_id');
    if($auth->id != $userId) {
      return back();
    }
    $data = Validation::make(
      [
      'title' => Request::get("title"),
      'description' =>  Request::get("description"),
      'status_type' => Request::get("status"),
      'task_date' => Request::get("date")
    ], 
    [
      'title' => 'required|string',
      'description' => 'required|string',
      'status_type' => 'numeric',
      'task_date' => 'string'
    ]); 
    $taskId = Request::get("task_id");
    $this->table->update($taskId, $data);
    return back();
  }

  public function delete() {
    $auth = auth();
    $userId = Request::get('user_id');
    if($auth->id != $userId) {
      return back();
    }
    $taskId =  Request::get("taskId");
    $this->table->delete($taskId);
    return back();
  }

  public function filtersTask() {
    $filter = Request::get("filter");
    $today = date('y-m-d');
    if('present' == $filter) {
      $tasks = $this->table->where('task_date', '=', $today);
    } elseif ('past' == $filter) {
      $tasks = $this->table->where('task_date', '<', $today);
    } elseif ('future' == $filter) {
      $tasks = $this->table->where('task_date', '>', $today);
    } elseif($filter == 'done') {
      $tasks = $this->table->where('complete', '=', 1);
    } elseif ($filter == 'noDone') {
      $tasks = $this->table->where('complete', '=', 0);
    } else {
      $tasks = $this->table->all();
    }

    return view('tasks.index',['tasks'=> $tasks,'filter' => $filter]);
  }
}