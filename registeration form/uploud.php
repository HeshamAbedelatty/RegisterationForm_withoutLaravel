<?php
move_uploaded_file($_FILES['image']["tmp_name"], "upload/'" . $_FILES['image']["name"]);
