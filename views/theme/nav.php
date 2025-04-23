
<div class="container">
  <nav>
    <ul>
      <?php
        if(empty(auth())) {
          echo '<li><a href="login">Login</a></li>
            <li><a href="register">Register</a></li>';
        } else {
          $user = auth()->username;
          echo "
          <div class='navAuth'> 
          <div>$user</div>
          <li>
          <form action='logout' method='POST'>
          <button class='logout' type='submit'>
          Logout
          </button>
          </form>
          </li>
          </div>
          ";
        }
      ?>
    </ul>
  </nav>
</div>