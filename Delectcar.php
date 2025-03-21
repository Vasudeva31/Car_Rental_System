<?php
require_once('connection.php');

if(isset($_POST['delete']) && isset($_POST['car_id'])) {
    $carid = mysqli_real_escape_string($conn, $_POST['car_id']);
    // Display a confirmation dialog before deleting
    echo '<script>
            if (confirm("Are you sure you want to delete this car?")) {
                window.location.href = "' . $_SERVER['PHP_SELF'] . '?car_id=' . $carid . '&confirmed=true";
            }
          </script>';
    exit();
}

if (isset($_GET['confirmed']) && $_GET['confirmed'] === 'true' && isset($_GET['car_id'])) {
    $carid = mysqli_real_escape_string($conn, $_GET['car_id']);
    $sql = "DELETE FROM cars WHERE CAR_ID = '$carid'";
    $result = mysqli_query($con, $sql);
    if($result) {
        echo '<script>alert("CAR DELETED SUCCESSFULLY");</script>';
        echo '<script>window.location.href = "' . $_SERVER['PHP_SELF'] . '";</script>';
        exit();
    } else {
        echo '<script>alert("ERROR: Unable to delete car");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Vehicle</title>
    <style>
       html, body {
    margin: 0;
    padding: 0;
    height: 100%;
    background: linear-gradient(to top, rgba(0, 0, 0, 0)50%, rgba(0, 0, 0, 0)50%), url("ablur.jpg");
    background-position: center;
    background-size: cover;
}
*{
    margin: 0;
    padding: 0;

}
.hai{
    width: 100%;
    background: linear-gradient(to top, rgba(0,0,0,0)50%, rgba(0,0,0,0)50%);
    background-position: center;
    background-size: cover;
    height: 25vh;
    animation: infiniteScrollBg 50s linear infinite;
}
.main{
    width: 100%;
    background-position: center;
    background-size: cover;
    height: 109vh;
    animation: infiniteScrollBg 50s linear infinite;
}
.navbar {
            width: 1200px;
            height: 75px;
            margin-left: 40px;
        }

        .icon {
            width: 200px;
            float: left;
            height: 65px;
            
        }

        .logo {
            color: black;
            font-size: 35px;
            font-family: fantasy;
            float: left;
            padding-left: 0px;
            padding-top: 30px;
        }
        .menu {
            width: 900px;
            float: left;
            height: 70px;
            margin: 23px;
        }

ul{
    float: left;
    display: flex;
    justify-content: center;
    align-items: center;
}

ul li{
    list-style: none;
    margin-left: 62px;
    margin-top: 27px;
    font-size: 14px;

}

ul li a{
    text-decoration: none;
    color: black;
    font-family: fantasy;
    font-weight: bold;
    transition: 0.4s ease-in-out;
    font-size:30px;
}

.content-table{
    border-collapse: collapse;
    
    font-size: 1em;
    min-width: 400px;
    border-radius: 5px 5px 0 0;
    overflow: hidden;
    box-shadow:0 0  20px rgba(0,0,0,0.15);
    margin-left : 100px ;
    margin-top: 25px;
    width: 1300px;
    height: 300px;
}
.content-table thead tr{
    background-color: darkslategrey;
    color: white;
    text-align: center;
}

.content-table th,
.content-table td{
    padding: 12px 15px;


}

.content-table tbody tr{
    background-color: #f3f3f3;
    text-align:center;
}

.content-table tbody tr:last-of-type{
    border-bottom: 2px solid darkslategrey;
}

.content-table thead .active-row{
    font-weight:  bold;
    color: darkslategrey;
    text-align:center;
}


.header{
    margin-top: -700px;
    margin-left: -650px;
    align:center;
}

.add{
    width: 200px;
    height: 40px;
    
    background: #ff7200;
    border:none;
    font-size: 18px;
    border-radius: 10px;
    cursor: pointer;
    color:#fff;
    transition: 0.4s ease;
    margin-left: 1200px;
}

.add a{
    text-decoration: none;
    color: black;
    font-weight: bolder;
    align:center;
}

.but a{
    text-decoration: none;
    color: black;
}
.back {
            top: 34px;
            right: 40px;
            font-size: 18px;
            border-radius: 10px;
            cursor: pointer;
            color: white;
            transition: 0.4s ease;
            position: fixed;
            padding: 7px;
        }

        .back a {
            text-decoration: none;
            color: black;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div>
        <h1 class="header">CHAOS</h1>
        <button class="back" onclick="location.href='adminpage.php'">Back</button>
        <div>
            <div>
                <table class="content-table">
                    <thead>
                        <tr>
                            <th>CAR ID</th>
                            <th>CAR NAME</th>
                            <th>FUEL TYPE</th>
                            <th>CAPACITY</th>
                            <th>PRICE</th>
                            <th>AVAILABLE</th>
                            <th>DELETE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM cars");
                        while($res = mysqli_fetch_array($query)) {
                        ?>
                        <tr class="active-row">
                            <td><?php echo $res['CAR_ID']; ?></td>
                            <td><?php echo $res['CAR_NAME']; ?></td>
                            <td><?php echo $res['FUEL_TYPE']; ?></td>
                            <td><?php echo $res['CAPACITY']; ?></td>
                            <td><?php echo $res['PRICE']; ?></td>
                            <td><?php echo $res['AVAILABLE'] == 'Y' ? 'YES' : 'NO'; ?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="car_id" value="<?php echo $res['CAR_ID']; ?>">
                                    <button type="submit" class="but" name="delete">DELETE CAR</button>
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</body>
</html>