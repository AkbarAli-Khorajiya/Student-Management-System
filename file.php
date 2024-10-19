<?php

    $conn = mysqli_connect('localhost','root','','contact');


    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if(isset($_POST['submit']))
        {
            $p_name = $_POST['p_name'];
            $p_price = $_POST['p_price'];
            $types = $_FILES['p_image']['type'];
            $type = explode('/',$types);            
            $des_upload_image = 'assets/images/'.$p_name.'.'.$type[1];

            $stmt = "INSERT INTO `card`(`name`, `price`, `image`) VALUES ('$p_name','$p_price','$des_upload_image')";
            $result = mysqli_query($conn,$stmt);
            if($result)
            {
                move_uploaded_file($_FILES['p_image']['tmp_name'],$des_upload_image);
            }
            else{
                echo "Something went wrong";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>file</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">

        <input type="text" name="p_name" placeholder="enter product name">
        <input type="text" name="p_price" placeholder="enter product price">
        <input type="file" name="p_image" accept="png,jpg,jpeg">

        <input type="submit" name="submit">
    </form>
</body>
</html>