<?php
require_once './app/Core/Sessions.php';



use App\Core\Sessions;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>To Do List</title>
    <style>
      * {
          box-sizing: border-box;
          font-family: sans-serif;
        }
        
        .svg_btn {
          background-color: transparent;
          margin: 0;
          padding: 0;
          border: 0;
          outline: 0;
        }


        nav{
          background: #fff;
          border-radius: 9px;
          padding: 10px;
          box-shadow: 0 5px 20px rgba(0,0,0,0.4);
        }
        nav ul li{
          display: inline-block;
          list-style: none;
          font-size: 1.5rem;
          padding: 0 5px;
          margin: 0 5px;
          cursor: pointer;
          position: relative;
        }
        nav ul li:after{
          content: '';
          width: 0;
          height: 3px;
          background: rgb(1, 67, 73);
          position: absolute;
          left: 0;
          bottom: -10px;
          transition: 0.5s;
        }
        nav ul li:hover::after{
          width:100%;
        }

        .navAuth {
          display: flex;
          justify-content: space-between;
          align-items: center;
        }
        .navAuth form{
          margin: 0;
        }

        a {
          text-decoration: none;
          color:rgb(1, 67, 73);
        }

        .logout {
          background-color: transparent;
          border: none;
          padding: 0;
          color: rgb(1, 67, 73);
          font-size: 1.5rem;
          cursor: pointer;
        }

        .errSpan {
          color: rgb(229, 57, 53);
          margin: 2px;
          display: block;
        }
        .container {
          background-color: #00838f;
          padding: 15px;
          width: 90%;
          position: relative;
          border-radius: 6px;
          overflow: auto;
          margin: auto;
          margin-top: 10px;
          margin-bottom: 10px;
        }
        .formTask {
          background-color:rgb(8, 65, 72);
          padding: 5px;
          margin: 3px;
          border-radius: 3px;
        }
        .filter {
          padding: 5px;
          display: flex;
          justify-content: flex-end;
        }
        .container .editing  input, .container > .container .editing  select, .input-data  select, .container  .input-data  input[type=submit], .container  .input-data  input[type=date], .container > .input-data  input[type=text] {
          display: block;
          padding: 10px 5px;
          margin: 2px;
          border-radius: 6px;
          transition: 0.5s ease-in-out;
          border: none;
          font-size: 18px;
        }
        .container .editing  input:focus, .container > .input-data  select:focus,  .container > .input-data  textarea ,.container > .editing  textarea , .container  .input-data  input[type=submit]:focus, .container  .input-data  input[type=date]:focus, .container  .input-data  input[type=text]:focus {
          outline: none;
        }
        .container .editing  input[type=submit], .container > .input-data  input[type=submit] {
          width: 50%;
          margin-top: 10px;
          cursor: pointer;
          background-color: transparent;
          color: white;
          border: 1px solid white;
          transition: 0.5s ease-in;
          font-size: 16px;
        }
        .container .editing  input[type=submit]:hover, .container > .input-data > input[type=submit]:hover {
          background-color: white;
          color: black;
        }
        .container > .input-data > div,.container > .editing  >div {
          display: flex;
          margin: 2px;
          gap: 2%;
        }
        .container > .input-data  input ,
        .container .editing  input {
          padding: 5px;
        }
        .container > .input-data .text {
          width: 80%;
        }
        .container > .input-data .text input{
          width: 100%;
        }
        .container > .input-data .editing input{
          width: 80%;
        }
        .container > .input-data  input[type=text]::-moz-placeholder {
          -moz-transition: 0.5s ease-in-out;
          transition: 0.5s ease-in-out;
          opacity: 0;
        }
        .container > .input-data  input[type=text]::placeholder {
          transition: 0.5s ease-in-out;
          opacity: 0;
        }
        .container > .input-data  textarea ,.container > .editing  textarea {
          display: block;
          height: 100px;
        }
        .container > .input-data  input[type=date], .container > .input-data  select {
          min-width: 10%;
          border: none;
          cursor: pointer;
        }
        .container > .input-data  input[type=submit] {
          display: block;
        }

        .container > .show-data {
          margin: 15px 0;
        }
        .container > .show-data .task {
          display: flex;
          align-items: center;
          font-size: 20px;
          color: white;
          margin: auto;
          margin-top: 10px;
          margin-bottom: 0;
          padding-top: 20px;
          position: relative;
        }
        .container > .show-data .task:not(:last-child) {
          border-bottom: 2px solid #fff;
          margin-bottom: 10px;
        }
        .container > .show-data .task.done {
          color: black;
          overflow: hidden;
          text-decoration: line-through;
        }
        .container > .show-data .task.done .done-btn{
          background-color: white;
          color: white;
        }
        .container > .show-data .task.done span div {
          display: block;
        }
        .container > .show-data .task  .check {
          display: flex;
          justify-content: center;
          align-items: center;
          width: 22px;
          height: 22px;
          border: 2px solid;
          border-radius: 50%;
          margin: 0 5px;
          text-align: center;
          cursor: pointer;
        }
        .container > .show-data .task > span div {
          display: none;
        }
        .container > .show-data .task  .data-task {
          display: flex;
          align-items: center;
          width: 82%;
          padding: 10px 0;
          margin: 0;
          margin-left: 10px;
          margin-right: 10px;
          overflow: hidden;
        }

        .container > .show-data .task > .data-task .important {
          margin: 2px;
          width: 12px;
          height: 12px;
          display: inline-block;
          border-radius: 50%;
          background-color: red;
        }
        .container > .show-data .task > .data-task .important#status_0 {
          background-color: red;
        }
        .container > .show-data .task > .data-task .important#status_1 {
          background-color: blue;
        }
        .container > .show-data .task > .data-task .important#status_2 {
          background-color: green;
        }
        .container > .show-data .task > .data-task h3 {
          margin: 20px 0px;
          font-size: 25px;
          font-weight: normal;
        }
        .container > .show-data .task > .data-task h4 {
          margin: 0;
          font-size: 16px;
          font-weight: normal;
        }
        .container > .show-data .task > .data-task span {
          position: absolute;
          display: flex;
          justify-content: center;
          align-items: center;
          font-size: 10px;
          font-weight: bold;
        }
        .container > .show-data {
          position: relative;
        }
        .container > .show-data .task > .delete, .container > .show-data .task  .pen {
          position: absolute;
          cursor: pointer;
          padding: 8px;
        }
        .container > .show-data .task  .pen  {
          cursor: pointer;
          position: relative;
          z-index: 1;

        }
        .container > .show-data .task  .pen   {
          cursor: pointer;
          width: 16px;
          height: 16px;
          background-color: transparent;
          z-index: 1;
          position: absolute;
          bottom: 60px;
        }
        .container > .show-data .task  .delete {
          cursor: pointer;
        }
        .container .editing {
          position: fixed;
          border-radius: 5px;
          left: 50%;
          top: 50%;
          transform: translate(-50%,-50%);
          display: none;
          justify-content: center;
          align-items: center;
          flex-direction: column;
          z-index: 50;
          background-color: rgba(0, 0, 0, 0.6);
        }
         .update {
          display: flex !important;
        }
        .cancel {
          position: absolute;
          top: -30px;
          left: -4px;
          padding: 4px;
          cursor: pointer;
          color: white;
          z-index: 52;
          background-color: rgba(0, 0, 0, 0.6);
          border-radius: 4px;
        }
        .container .editing > input {
          margin: 5px 0;
        }
        .container .editing > input[type=submit] {
          width: 80%;
        }
    </style>
  </head>
  <body>
    <?php require_once './views/theme/nav.php' ?>
    <div class="container">
      <form action="store" class="input-data formTask" method="POST">
        <div>
          <div class="text">
            <input type="text" placeholder="Write Your Task" value="<?= Sessions::get('title') ?>" name="title" />
            <span class='errSpan'><?= Sessions::getErr('title') ?></span>
          </div>
          <div>
            <input type="date" name="date" value="<?= Sessions::get('task_date') ?>"/>
            <span class='errSpan'><?= Sessions::GetErr('task_date') ?></span>
          </div>
          <div>
              <select name="status" id="status">
                <option value="0">Urgent</option>
                <option value="1">Important</option>
                <option value="2">Not Urgent</option>
              </select>
              <span class='errSpan'><?= Sessions::GetErr('status_type') ?></span>
          </div>
        </div>
        <div>
          <div style="width :100%;">
            <textarea style="display: block; width :100%;" name="description" id=""><?= Sessions::get('description') ?></textarea>
            <span class='errSpan'><?= Sessions::getErr('description') ?></span>
          </div>
        </div>
        <input type="submit" value="Add" />
      </form>
      <form action="filter" class="input-data filter" method="GET">
        <select onchange="this.form.submit()" name="filter" id="filter">
          <optgroup label="filter">
            <option value="all" <?= $filter == 'all' ? 'selected' : '' ?>>All</option>
            <option value="present" <?= $filter == 'present' ? 'selected' : '' ?>>Present</option>
            <option value="past" <?= $filter == 'past' ? 'selected' : '' ?>>Past</option>
            <option value="future" <?= $filter == 'future' ? 'selected' : '' ?>>Future</option>
            <option value="done" <?= $filter == 'done' ? 'selected' : '' ?>>Done</option>
            <option value="noDone" <?= $filter == 'noDone' ? 'selected' : '' ?>>No done</option>
          </optgroup>
        </select>
      </form>
      <div class="show-data">
        <?php
        foreach($tasks as $task) {
          $taskDone = $task->complete == true ? 'done' : '';
          $task_status = $task->status_type == 0 ? 'status_0' : ($task->status_type == 1 ? "status_1" : 'status_2');
          echo "
          <div class='task {$taskDone}' data-time='{$task->task_date}' id='task_{$task->id}'>
          <form action='done' method='POST'>
          <input type='hidden' name='taskId' value='{$task->id}' />
          <input type='hidden' id='userId' name='user_id' value='{$task->user_id}' />
          <input type='hidden' name='complete' value='{$task->complete}' />
            <button type='submit' class='svg_btn'>
          <span class='check done-btn'>
          <svg xmlns='http://www.w3.org/2000/svg' class='check-child' height='16' width='14' viewBox='0 0 448 512'><path opacity='1' fill='#00838f' d='M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z'/></svg>
          </span>
          </button>
          </form>
            <div class='data-task'>
            <div>
            <span id='date'>
            <div class='important' id='{$task_status}'></div>
            {$task->task_date} 
            </span>
            <h3>{$task->title}</h3>
            <h4>{$task->description}</h4>
            </div>
            </div>
            <div>
            <svg class='pen_svg' xmlns='http://www.w3.org/2000/svg' height='16' width='16' viewBox='0 0 512 512'><path opacity='1' fill='#1E3050' d='M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z'/><!-- Code injected by live-server -->
            <div class='pen' >
            </svg>
            </div>
            <form action='delete' method='POST'>
          <input type='hidden' name='taskId' value='{$task->id}' />
              <input type='hidden' id='userId' name='user_id' value='{$task->user_id}' />
          <button type='submit' class='svg_btn'>
          <div  class='delete'>
            <svg xmlns='http://www.w3.org/2000/svg' height='16' width='14' viewBox='0 0 448 512'><path opacity='1' fill='#e53935' d='M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z'/><!-- Code injected by live-server -->
            </svg>
          </div>
          </button>
          </form>
           </div>
          </div>";
        }
        ?>
      </div>
      <div class="editing" >
          <form action="update" class="input-data" id="editInput" method="POST">
        <div>
          <input type="text" id="update_title" name="title" />
          <input type="hidden" id="update_id" value="" name="task_id" />
          <input type="hidden" id="user_id" value="" name="user_id" />
          <input type="date" name="date" id="update_date"/>
          <select name="status" id="update_status">
            <option value="0">Urgent</option>
            <option value="1">Important</option>
            <option value="2">Not Urgent</option>
        </select>
        </div>
        <div>
          <textarea   style="width :100%" name="description" id="update_description"></textarea>
        </div>
        <input type="submit" value="Update" />
        <div class="cancel"> X</div>
      </form>
      </div>
    </div>
    <script>
      document.querySelector(".show-data").addEventListener("click" , (task) => {
        if(task.target.classList.contains("pen")) {
          editingContent(task.target.parentElement.parentElement);
          }
        })
      document.querySelector(".cancel").addEventListener("click" , (task) => {
          document.querySelector('.editing').classList.remove('update');
        })
        document.getElementById('update_user_id').value = document.getElementById('userId').value;
        
      function editingContent(editElement) {
        let ids =  "#" + editElement.getAttribute("id");
        let h3_value = document.querySelector(`${ids} h3`);
        let h4_value = document.querySelector(`${ids} h4`);
        let status_value = document.querySelector(`${ids} .important`).getAttribute("id");
        let span_value = document.querySelector(`${ids} #date`);
        document.querySelector('.editing').classList.add('update');
        document.getElementById('update_title').value = h3_value.innerText;
        document.getElementById('update_description').innerText = h4_value.innerText;
        document.getElementById('update_date').value = span_value.innerText;
        document.getElementById('update_status').value = status_value.slice(status_value.indexOf('_') + 1);
        document.getElementById('update_id').value = ids.slice(6);
        document.getElementById('user_id').value = document.getElementById('userId').value;
      }


    </script>
    <!-- <script src="/script.js"></script> -->
  </body>
</html>
