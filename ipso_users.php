<?php
include("config.php");
include("auth.php");
if($_SESSION["ipso_user"]["role"]!="admin")
{
     header('location: ipso.php');
}
if(!empty($_POST["login"]) && !empty($_POST["password"]) && !empty($_POST["role"]))
{
    
$sql="INSERT INTO ipso (login, password, role) VALUES (?,?,?)";
$statement = $pdo->prepare($sql);
$statement->execute(array($_POST["login"],hash('sha256', hash('sha256', $_POST["password"])),$_POST["role"]));
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Add User</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
        <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="nav-fixed">
        <div id="layoutSidenav">
              <div id="layoutSidenav_nav">
                <nav class="sidenav shadow-right sidenav-light">
                    <div class="sidenav-menu">
                        <div class="nav accordion" id="accordionSidenav">
                          
                            <a class="nav-link" href="ipso.php">
                               
                          На главную
                            </a>
                        
            
                        </div>
                    </div>
                  
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-xl px-4">
                            <div class="page-header-content">
                                <div class="row align-items-center justify-content-between pt-3">
                                    <div class="col-auto mb-3">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="user-plus"></i></div>
                                            Добавить юзера
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <a class="btn btn-sm btn-light text-primary" href="ipso_users_list.php">
                                            <i class="me-1" data-feather="arrow-left"></i>
                                            Back to Users List
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <div class="container-xl px-4 mt-4">
                        <div class="row">
                        
                            <div class="col-xl-8">
                                <!-- Account details card-->
                                <div class="card mb-4">
                                    <div class="card-header">Account Details</div>
                                    <div class="card-body">
                                        <form method="post">
                                            <!-- Form Row-->
                                            <div class="row gx-3 mb-3">
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputlogin">Login</label>
                                                    <input class="form-control" id="inputlogin" type="text" name="login" placeholder="Login" value="" required />
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputpass">Password</label>
                                                    <input class="form-control" id="inputpass" type="password" name="password" placeholder="Password" value="" required />
                                                </div>
                                            </div>
                                         
                                        
                                            <div class="mb-3">
                                                <label class="small mb-1">Role</label>
                                                <select class="form-select" aria-label="Default" name="role" required>
                                                    <option selected disabled>Select a role:</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="user">User</option>

                                                </select>
                                            </div>
                                            <button class="btn btn-primary" type="submit">Add user</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="footer-admin mt-auto footer-light">
                    <div class="container-xl px-4">
                        <div class="row">
                            <div class="col-md-6 small">Copyright &copy; 2026</div>
                            <div class="col-md-6 text-md-end small">
                                
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>