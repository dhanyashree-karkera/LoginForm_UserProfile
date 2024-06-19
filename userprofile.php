<?php
include 'connection.php';
session_start();

if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['userId'];

$query = "SELECT email, password, login_time FROM login WHERE id='$userId'";
$result = $con->query($query);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $email = $row['email'];
    $password = $row['password'];
    $loginTime = $row['login_time'];

    ?>
    <?php include 'header.php';?>

    <main class="main" id="main">

    <div class="pagetitle">
        <h1>User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">User</a></li>
                <li class="breadcrumb-item active">Userprofile</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            
    <div class="container">
      <div class="user-container">
        <h3 style="text-align: center">User Profile Details</h3>
        <hr />
        <div class="information">
          <span>Email: <?= $email ?></span>
          <br />
          <span>Password: <?= $password ?></span>
          <br />
          <span>Login Time: <?= date('d-m-Y H:i:s', strtotime($loginTime)) ?></span>
        </div>
      </div>
    </div>
</div>
    </section>
    </main>

    <?php include 'footer.php'; ?>
    <?php
} else {
    echo "User not found.";
}
?>
