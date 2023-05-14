<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="form.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900italic,900" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;family=Poppins:wght@600;700&amp;display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <title>The Form</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script>
            $(document).ready(function(){

                $("#username").keyup(function(){

                    var username = $(this).val().trim();
            
                    if(username != ''){
            
                       
            
                        $.ajax({
                            url: 'ajax.php',
                            type: 'post',
                            data: {username: username},
                            success: function(response){
                
                                $('#uname_response').html(response);
                
                             }
                        });
                    }else{
                        $("#uname_response").html("");
                    }
            
                });

            });
        </script>
</head>

<?php
include 'Header.php'
?>

<body>
    <div class="section1">


        <div class="container">

            <div class="form">
                <div class="form_header">
                    <h1>Restration Form</h1>
                </div>
                <form action="register.php" onsubmit="return validateSpace();" name="myForm" method="POST" enctype="multipart/form-data">

                    <input type="text" id="fname" name="fname" placeholder="Full Name">

                    <input type="tel" id="phone" name="phone" pattern="^01[0-2,5]\d{8}$" required placeholder="Phone" maxlength="11">


                    <input type="text" id="Address" name="Address" placeholder="Address" required>

                    <input type="text" id="username" name="username" placeholder="user name">
                    <div id="uname_response" ></div>
                    <input type="email" id="E-mail" name="E-mail" placeholder="E-mail" required>

                    <input type="password" placeholder="Password" id="password" onkeyup="checkPass(); return false;" name="password" required placeholder="password" maxlength="30" minlength="8">

                    <input type="password" placeholder="Confirm Password" name="confirm_password" id="confirm_password" required placeholder="Confirm password" onblur="validate()">
                    <!-- <br> -->
                    <div class="Birth">
                        <input type="date" id="birthday" name="birthday" placeholder="Birthday" required>
                    </div>
                    <input type="file" name="image">



                    <?php
                    //include 'upload.php';
                    ?>
                    <button type="button" class="API_button" onclick="callApi()">Call API</button>

                    <button type="submit" class="pure-button pure-button-primary">Confirm</button>

                </form>
            </div>
        </div>
    </div>

</body>

</html>
<script>
    function checkPass() {
        var pass1 = document.getElementById('password');
        var message = document.getElementById('error-nwl');
        var goodColor = "#66cc66";
        var badColor = "#ff6666";
        var checkList = /^(?=.*[-\#\$\.\%\&\@\!\+\=\<\>\*])(?=.*[a-zA-Z])(?=.*\d).{8,}$/;
        // /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]$/
        if (pass1.value.length > 8 && pass1.value.length < 15 && pass1.value.match(checkList)) {
            pass1.style.backgroundColor = goodColor;
            message.style.color = goodColor;
            message.innerHTML = "character number ok!"
            return true;
        } else {
            pass1.style.backgroundColor = badColor;
            message.style.color = badColor;
            alert(" you have to enter at least 8 characters with at least 1 number literal and 1 special character");
            return false;
        }
    }

    function validate() {
        var x = document.getElementById("password");
        var y = document.getElementById("confirm_password");
        if (x.value == y.value) return true;
        else {
            alert("password not same");
            return false;
        }


    }
    function validateSpace() {
        var x = document.getElementById("username");
        if (x.value == "")
           {
               alert ("Username field is empty");
               return false;
           }
        var phone = document.getElementById("phone");
        if (phone.value == "")
           {
               alert ("Phone field is empty");
               return false;
           } 
           var address = document.getElementById("Address");
        if (address.value == "")
           {
               alert ("Address field is empty");
               return false;
           }
           var email = document.getElementById("E-mail");
        if (email.value == "")
           {
               alert ("E-mail field is empty");
               return false;
           }          
           var fullName = document.getElementById("fname");
        if (fullName.value == "")
           {
               alert ("Full Name field is empty");
               return false;
           }    

         return true;  


    }
    

</script>
<?php
if (isset($_POST['submit'])) {
    $target_dir = "uploads/"; // specify the directory where the uploaded file will be saved
    $target_file = $target_dir . basename($_FILES["image"]["name"]); // get the name of the uploaded file
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); // get the extension of the uploaded file

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}



?>
<script>
    function callApi() {
        var birthday = document.getElementById('birthday').value;
        var day = birthday.slice(8, 10);
        var month = birthday.slice(5, 7);
        window.location.href = "API_Ops.php?day=" + encodeURIComponent(day) + "&month=" + encodeURIComponent(month);

    }
</script>

<?php
// include 'output.php';
include 'Footer.php';
?>