<?php
if(isset($_POST['submit'])) {

    echo "<script> console.log('in post ');</script>";
    //Process the image that is uploaded by the user
    //var_dump($_FILES);
    //$image=addslashes(file_get_contents( $_FILES["imageUpload"]["tmp_name"])); // used to store the filename in a variable

    //storind the data in your database
    //echo "<script> console.log('loaded image'); </script>";
    $id = $_POST["id"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $connect = mysqli_connect("localhost","root","","foodies");
    $query= "INSERT INTO food VALUES ($id,'$name',null,'$price')";
    echo $query;
    $ret = mysqli_query($connect,$query) or die(mysqli_error($connect));
    if($ret) {
        echo "<script> alert('inserted details successfully');</script>";
    }
    else{
        echo "<script> </script>";
    }

    
}
else{
    echo "<script> console.log('post is not set'); </script>";
} ?>

<html>
<body>
    <form action="uploadimages.php" enctype="multipart/form-data" method="post">
        file: <input type="file" name="imageUpload"> <br />
        name: <input type="text" name="name"> <br />
        price: <input type="text" name="price"> <br />

        id: <input type="text" name="id"> <br />
        <input type="submit" value="submit" name="submit">
    </form>
</body>
</html>
<?php
/*

            {
                    $id=$row['id'];
                    $name=$row['name'];
                    $image=$row['image'];

                  $msg.= '<a href="search.php?id='.$id.'"><img src="data:image/jpeg;base64,'.base64_encode($row['image']). ' " />   </a>';

            }
*/
?>