<!-- navbar --> 
      <nav class="navbar navbar-expand-md navbar-light bg-light">
      <a class="navbar-brand" href="index.php" style="color : #495057;"><img src="img/bnklg.png" alt="Logo" width="26" style="margin-bottom:4px;"> <b>SIMPLE BANKING SYSTEM</b></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="index.php" style="color : #495057;"><b>Home</b></a>
              </li>
              <li class="nav-item">
                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Account Controll 
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="createuser.php">Create Account</a>
                    <a class="dropdown-item" href="removeuser.php">Remove Account</a>
                    <a class="dropdown-item" href="#">Edit Account</a>
                  </div>
                </div>             
              </li>
             
              <li class="nav-item">
              <a class="nav-link" href="transfermoney.php" style="color : #495057;"><b>Finacional Operations</b></a>            
              </li>
              <li class="nav-item">
                <a class="nav-link" href="transactionhistory.php" style="color : #495057;"><b>Transaction History</b></a>
              </li>
          </div>
       </nav>