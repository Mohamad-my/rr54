<?php
session_start();
include ('../include/connected.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحة الاجهزه</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .UPDATE{
            color: white;
            font-size: 18px;
            background-color: #007bff;
            padding: 8px 18px;
            border-radius: 2px;
            border: 1px solid black;
            margin-right: 5px;
        }
        .UPDATE:hover{
            background-color:seagreen;
            color: white;
        }

        .delet {
            background-color: red;
            color: white;
            padding: 8px 18px;
            font-size: 18px;
            border-radius: 2px;
            border: 1px solid black;
            cursor: pointer;
        }

        .form-container {
            margin: 20px;
        }
    </style>
</head>
<body>

<?php
//start delete
@$id = $_GET['delete_id'];
if (isset($id)) {
    $query = "DELETE FROM product WHERE id='$id'";
    $delet = mysqli_query($conn, $query);

    if ($delet) {
        echo '<script>alert("تم الحذف بنجاح"); window.location.href="product.php";</script>';
        exit(); 
    } else {
        echo '<script>alert("لم يتم الحذف هناك خطأ");</script>';
    }
}
//end delete

//start update
if (isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];

    // استعلام لجلب بيانات المنتج
    $query = "SELECT * FROM product WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        echo '<script>alert("لم يتم العثور على المنتج");</script>';
        exit();
    }
}

// تحديث بيانات المنتج عند إرسال النموذج
if (isset($_POST['update'])) {
    $proname = $_POST['proname'] ?? null;
    $proprice = $_POST['proprice'] ?? null;
    $prodescipr = $_POST['prodescipr'] ?? null;
    $proquentity= $_POST['proquentity']?? null;
    $prouny = $_POST['prouny'] ?? null;
    $video_link = $_POST['video_link'] ?? null;

    $updateQuery = "UPDATE product SET proname='$proname', proprice='$proprice', prodescipr='$prodescipr',proquentity='$proquentity', prouny='$prouny' ,video_link='$video_link' WHERE id='$id'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        echo '<script>alert("تم تحديث المنتج بنجاح"); window.location.href="product.php";</script>';
        exit();
    } else {
        echo '<script>alert("حدث خطأ أثناء تحديث المنتج");</script>';
    }
}
?>

<?php if (isset($product)): ?>
<!-- نموذج تعديل المنتج -->
<div class="form-container">
    <form action="" method="POST">
        <label for="proname">اسم المنتج:</label>
        <input type="text" id="proname" name="proname" value="<?php echo $product['proname']; ?>" required><br><br>
        
        <label for="proprice">سعر المنتج:</label>
        <input type="text" id="proprice" name="proprice" value="<?php echo $product['proprice']; ?>" required><br><br>
        
        <label for="prodescipr">وصف المنتج:</label>
        <textarea id="prodescipr" name="prodescipr" required><?php echo $product['prodescipr']; ?></textarea><br><br>
        
        <label for="proquentity">كمية المنتج:</label>
        <input type="number" id="proquentity" name="proquentity" value="<?php echo $product['proquentity']; ?>" required><br><br>

        <label for="prouny">توفر المنتج:</label>
        <input type="text" id="prouny" name="prouny" value="<?php echo $product['prouny']; ?>" required><br><br>

        <label for="video_link">رابط اليوتيوب:</label>
<input type="text" name="video_link" id="video_link" value="<?php echo $product['video_link']; ?>"><br><br>
  
        
        <button type="submit" name="update" class="UPDATE">تحديث المنتج</button>
    </form>
</div>
<?php endif; ?>

<div class="sidebar-container">
    <table dir="rtl">
        <tr>
            <th>رقم الجهاز</th>
            <th>عنوان الجهاز</th>
            <th>صور الجهاز</th>
            <th>سعر الجهاز</th>
            <th>تفاصيل الجهاز</th>
            <th>كمية الاجهزة</th>
            <th>توفر الجهاز</th>
            <th>رابط يوتيوب</th>
            <th>حذف الجهاز</th>
            <th>تعديل الجهاز</th>
        </tr>
        <?php 
        $query = "SELECT * FROM product";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['proname']; ?></td>
            <td><img src="../uploads/img/<?php echo $row['proimg']; ?>" width="100"></td>
            <td><?php echo $row['proprice']; ?></td>
            <td><?php echo $row['prodescipr']; ?></td>
            <td><?php echo $row['proquentity']; ?></td>
            <td><?php echo $row['prouny']; ?></td>
            <td><?php echo $row['video_link']; ?></td>
            <td><a href="product.php?delete_id=<?php echo $row['id']; ?>"><button type="button" class="delet">حذف المنتج</button></a></td>
            <td><a href="product.php?edit_id=<?php echo $row['id']; ?>"><button type="button" class="UPDATE">تعديل المنتج</button></a></td>
        </tr>
        <?php
        }
        ?>
    </table>
</div>

</body>
</html>
