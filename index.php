<?php
session_start();

if(!isset($_SESSION['userId']))  // if user is not login, go to login page
{
  header('location:login.php');
}
?>

<?php require "assets/function.php" ?>
<?php require 'assets/db.php';?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo siteTitle(); ?></title>
  <?php require "assets/autoloader.php" ?>

  <style type="text/css">
  <?php include 'css/customStyle.css'; ?>
  </style>
</head>

<!----------DOCUMENT BODY---------->

<body style="background: #ECF0F5;padding:0;margin:0">

<div class="dashboard" style="position: fixed;width: 18%;height: 100%;background:#222D32">
<!--------SITE NAME------->
  <div style="background:#357CA5;padding: 14px 3px;color:white;font-size: 15pt;text-align: center;text-shadow: 1px 1px 11px black">
    <a href="index.php" style="color: white;text-decoration: none;"><?php echo strtoupper(siteName());// SHOW SITE NAME IN UPPER CASE
      ?> 
    </a>
  </div>


<!--------MAIN NAVIGATION-------->
  <div style="background: #1A2226;font-size: 10pt;padding: 11px;color: #79978F">MAIN NAVIGATION</div>
  <div>
    <div style="background:#1E282C;color: white;padding: 13px 17px;border-left: 3px solid #3C8DBC;"><span><i class="fa fa-dashboard fa-fw"></i> Dashboard</span></div>
    <div class="item">
      <ul class="nostyle zero">
        <a href="index.php"><li style="color: white"><i class="fa fa-circle-o fa-fw"></i> Home</li></a>
        <a href="inventeries.php"><li><i class="fa fa-circle-o fa-fw"></i> Inventeries</li></a>
       <a href="addnew.php"><li><i class="fa fa-circle-o fa-fw"></i> Add New Item</li></a>
        <a href="reports.php"><li><i class="fa fa-circle-o fa-fw"></i> Report</li></a>
      </ul>

    </div>
  </div>
  <div style="background:#1E282C;color: white;padding: 13px 17px;border-left: 3px solid #3C8DBC;"><span><i class="fa fa-globe fa-fw"></i> Other Menu</span></div>
  <div class="item">
      <ul class="nostyle zero">
        <a href="sitesetting.php"><li><i class="fa fa-circle-o fa-fw"></i> Site Setting</li></a>
       <a href="profile.php"><li><i class="fa fa-circle-o fa-fw"></i> Profile Setting</li></a>
        <a href="accountSetting.php"><li><i class="fa fa-circle-o fa-fw"></i> Account Setting</li></a>
        <a href="logout.php"><li><i class="fa fa-circle-o fa-fw"></i> Sign Out</li></a>
      </ul><
    </div>
</div>

<!----------END MAIN NAVIGATION----------->

<div class="marginLeft" >
 <div style="color:white;background:#3C8DBC" >
    <div class="pull-right flex rightAccount" style="padding-right: 11px;padding: 7px;">
      <div><img src="photo/<?php echo $user['pic'] ?>" style='width: 41px;height: 33px;' class='img-circle'></div>
      <div style="padding: 8px"><?php echo ucfirst($user['name']) ?></div>
    </div>
    <div class="clear"></div>
  </div>
<div class="account" style="display: none;">
  <div style="background: #3C8DBC;padding: 22px;" class="center">
    <img src="photo/<?php echo $user['pic'] ?>" style='width: 100px;height: 100px; margin:auto;' class='img-circle img-thumbnail'>
    <br><br>
    <span style="font-size: 13pt;color:#CEE6F0"><?php echo $user['name'] ?></span><br>
    <span style="color: #CEE6F0;font-size: 10pt">Member Since:<?php echo $user['date']; ?></span>
  </div>
  <div style="padding: 11px;">
    <a href="profile.php"><button class="btn btn-default" style="border-radius:0">Profile</button>
    <a href="logout.php"><button class="btn btn-default pull-right" style="border-radius: 0">Sign Out</button></a>
  </div>
</div>
<!---------------BODY-------------->

  <div class="content2">
    <div>
      <span style="font-size: 16pt;color: #333333;margin-left:13px">Categories </span>
      <a href="manageCat.php"><button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#addIn"><i class="fa fa-gear  fa-fw"> </i> Manage Categories</button></a>

    </div>
    
<!-----Display categories as boxes------->
  <?php 
    $array = $con->query("select * from categories");
    while ($row = $array->fetch_assoc()) 
    {
      $array2 = $con->query("select count(*) from inventeries where catId = '$row[id]'");
      $row2 = $array2->fetch_assoc();
  ?>
    <a href="inventeries.php?catId=<?php echo $row['id'] ?>"><div class="box2 col-md-2">
     <div class="center"> <img src="photo/<?php echo $row['pic'] ?>" style="width: 155px;height: 122px;" class='img-thumbnail'></div>
      <hr style="margin: 7px;">
      <span style="padding: 11px"><strong style="font-size: 10pt">Name</strong><span class="pull-right" style="color:blue;margin-right: 11px;"><?php echo $row['name'] ?></span></span>
      <hr style="margin: 7px;">
      <span style="padding: 11px"><strong style="font-size: 10pt">Available Qty</strong><span class="pull-right" style="color:blue;margin-right: 11px"><?php echo $row2['count(*)']; ?></span></span>
    </div></a>
  <?php
    }
   ?>
  </div>
</div>

</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){$(".rightAccount").click(function(){$(".account").fadeToggle();});});
</script>