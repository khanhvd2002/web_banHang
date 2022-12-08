<?php
// 
require_once "./Classes/PHPExcel.php";
$_SESSION['login'] = 1;
$mysqli = new mysqli("localhost", "root", "", "shopquanao_btlweb");
$thongbao = '';
$kq = '';
$TenBlog = '';
$NoiDung = '';
$IDUser = '';
$ThoiGian = '';
$HinhAnh = '';
//Nhâp Blog
if (isset($_POST['btnLuu'])) {

    $TenBlog = $_POST['txtTenBlog'];
    $NoiDung = $_POST['txtNoiDung'];
    $ThoiGian = $_POST['txtDate'];
    $HinhAnh = basename($_FILES["fileToUpload"]["name"]);
    $target_dir = "./upload/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
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
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        var_dump($target_file);
        var_dump($_FILES["fileToUpload"]["tmp_name"]);

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    $IDUser = $_GET['userID'];
    $sql = "INSERT INTO tblblog VALUES (null,'$TenBlog','$NoiDung','$IDUser','$ThoiGian','$HinhAnh')";
    $result = mysqli_query($mysqli, $sql);
    header("location: http://localhost/BTL_WEB/blog");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Thêm mới BLOG</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Nhom 6 - tt23">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="http://localhost/BTL_WEB/public/Css/bootstrap4/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/BTL_WEB/public/Css/main_styles.css">
    <link rel="stylesheet" href="http://localhost/BTL_WEB/public/plugins/font-awesome-4.7.0/css/font-awesome.css">
    <style>


        .header {
            text-align: center;
            width: 100%;
            height: 124px;
            line-height: 124px;
            font-size: 30px;
            color: wheat;
        }

        .box-til {
            font-size: 20px;
            color: white;
            font-weight: 800;
            background: linear-gradient(#ee4d2d, #ff7337);
            width: 220px;
            text-align: center;
            height: 60px;
            line-height: 60px;
            margin-bottom: 0 !important;
            margin-top: 24px;
        }

        .row {
            margin-right: 15px;
            margin-top: 0px;
            min-width: 800px;
            /* margin-left: 500px; */
            display: block;
            align-self: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .row1 {
            width: 100%;
            height: 590px;
            display: flex;
            background-image: url(data:image/jpeg;base64,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);
            background-size: 100%;
        }
    </style>

</head>

<body>
    <div class="noidung">
        <div class="row1">
            <div class="row" style="margin-left: 500px; display:block;">
                <div class="col-6">
                    <form method="post" enctype="multipart/form-data">
                        <caption>
                            <h3>Nhập Vào Blog</h3>
                        </caption>
                        <table>
                            <tr>
                                <td>Tên Blog: </td>
                                <td>
                                    <input style="margin-bottom: 10px;" type="text" name="txtTenBlog" id="">
                                </td>
                            </tr>
                            <br>
                            <tr>
                                <td>Nội Dung: </td>
                                <td>
                                    <input style="margin-bottom: 10px;" type="text" name="txtNoiDung" id="">
                                </td>
                            </tr>
                            <tr>
                                <td>Thời Gian: </td>
                                <td>
                                    <input style="margin-bottom: 10px;" type="date" name="txtDate" id="">
                                </td>
                            </tr>
                            <tr>
                                <td>Upload image: </td>
                                <td>
                                    <input type="file" name="fileToUpload" id="fileToUpload">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <button style="margin-bottom: 10px; margin: 20px;" type="submit" name="btnLuu">Lưu
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                    <!-- <form method="post" enctype="multipart/form-data">
                        <caption>
                            <h3>Import Excel</h3>
                        </caption>
                        <input type="file" name="file" id="">
                        <button type="submit" name="btnGui">Import</button>
                    </form> -->
                </div>
            </div>
        </div>
    </div>
    <script src="http://localhost/BTL_WEB/public/Styles/bootstrap4/bootstrap.min.js"></script>
</body>

</html>