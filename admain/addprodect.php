<?php
session_start();
include ('../include/connected.php'); // Correct path
?>
<?php
$proname = $_POST['proname'] ?? null;
$proprice = $_POST['proprice'] ?? null;
$prodescipr = $_POST['prodescipr'] ?? null;
$proquentity = $_POST['proquentity'] ?? null;
$prouny = $_POST['prouny'] ?? null;
$video_link = $_POST['video_link'] ?? null;
$proadd = $_POST['proadd'] ?? null;

if (isset($proadd)) {
    // Validate fields are not empty
    if (empty($proname) || empty($proprice) || empty($prodescipr) || empty($proquentity) || empty($prouny) || empty($video_link)) {
        echo '<script>alert("الرجاء ملىء جميع الحقول ");</script>';
    } else {
        $proimg = null; // Initialize image variable

        // Handle image upload
        if (isset($_FILES['proimg']) && $_FILES['proimg']['error'] == 0) {
            $imgeName = $_FILES['proimg']['name'];
            $imageTmp = $_FILES['proimg']['tmp_name'];
            $proimg = rand(0, 5000) . "_" . $imgeName;
            move_uploaded_file($imageTmp, "../uploads/img/" . $proimg);
        } else {
            echo '<script>alert("لم يتم تحميل الصورة");</script>';
        }

        // Ensure the $proimg variable is not empty before inserting
        if ($proimg) {
            // Insert product into database
            $query = "INSERT INTO product (proname, proprice, prodescipr, proquentity, prouny, video_link, proimg) 
                      VALUES ('$proname', '$proprice', '$prodescipr', '$proquentity', '$prouny', '$video_link', '$proimg')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                // إعادة التوجيه بعد الإضافة لمنع التكرار عند إعادة تحميل الصفحة
                header("Location: addprodect.php?success=1");
                exit();
            } else {
                echo '<script>alert("لم يتم اضافة المنتج");</script>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إضافة منتج</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"], input[type="number"], textarea, input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .alert {
            text-align: center;
        }
    </style>
</head>
<body>
    <center>
        <main>
            <div class="dorm-product">
                <h1>إضافة منتج</h1>

                <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                    <div class="alert alert-success">تمت إضافة المنتج بنجاح!</div>
                <?php endif; ?>

                <form action="addprodect.php" method="POST" enctype="multipart/form-data">
                    <label for="proname">اسم المنتج:</label>
                    <input type="text" id="proname" name="proname" required><br><br>

                    <label for="proimg">اختر صورة المنتج:</label>
                    <input type="file" name="proimg" id="proimg" required><br><br>

                    <label for="proprice">سعر المنتج:</label>
                    <input type="text" id="proprice" name="proprice" required><br><br>

                    <label for="prodescipr">وصف المنتج:</label>
                    <textarea id="prodescipr" name="prodescipr" required></textarea><br><br>

                    <label for="proquentity">كمية المنتج:</label>
                    <input type="number" id="proquentity" name="proquentity" required><br><br>

                    <label for="prouny">توفر المنتج:</label>
                    <input type="text" id="prouny" name="prouny" required><br><br>

                    <label for="link">رابط اليوتيوب:</label>
                    <input type="text" name="video_link" id="video"><br><br>

                    <button class="button" type="submit" name="proadd">إضافة المنتج</button>
                </form>
            </div>
        </main>
    </center>
</body>
</html>
