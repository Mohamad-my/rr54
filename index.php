<?php
// تضمين ملف الهيدر
include('file/header.php');

// التأكد من الاتصال بقاعدة البيانات
if (!$conn) {
    die("فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());
}
?>

<!----product start------>
<main>
    <?php
    // استعلام جلب المنتجات
    $query = "SELECT * FROM product";
    $result = mysqli_query($conn, $query);

    // التحقق من وجود نتائج
    if (mysqli_num_rows($result) > 0) {
        // حلقة لجلب كل منتج
        while ($row = mysqli_fetch_assoc($result)) {
            // جلب قيم المنتج
            $proname = $row['proname'];
            $proprice = $row['proprice'];
            $prodescipr = $row['prodescipr'];
            $prouny = $row['prouny'];
            $proimg = $row['proimg'];
    ?>
        <div class="product">
            <!-- عرض الصورة من قاعدة البيانات -->
            <div class="product-img">
                <img src="uploads/img/<?php echo $proimg ?>" alt="Product Image">
                <!-- إذا كانت الكمية غير متوفرة -->
                <?php if ($prouny == 0): ?>
                    <span class="unvailabel">غير متوفر</span>
                <?php endif; ?>
            </div>
            <!-- اسم المنتج -->
            <div class="product-name">
                <a href="details.php?id=<?php echo $row['id']; ?>"><?php echo $proname; ?></a>
            </div>
            <!-- السعر -->
            <div class="product-price">
                <a href="#"><?php echo $proprice; ?> JD</a>
            </div>
            <!-- وصف المنتج -->
            <div class="product-description">
                <a href="details.php?id=<?php echo $row['id']; ?>"><i class="bi bi-eye-fill"></i> تفاصيل المنتج اضغط هنا</a>
            </div>
            <!-- كمية المنتج -->
            <div class="qty-input">
                <input type="number" id="quantity_<?php echo $row['id']; ?>" name="quantity" value="1" min="1" max="<?php echo $prouny; ?>">
            </div>
            <!-- زر الإضافة إلى السلة -->
            <div class="submit">
                <button class="addto-cart" type="button" onclick="addToCart('<?php echo $proname; ?>', <?php echo $proprice; ?>, document.getElementById('quantity_<?php echo $row['id']; ?>').value)">
                    <i class="bi bi-cart">&nbsp; &nbsp;</i> اضف الى السلة
                </button>
            </div>
        </div>
    <?php
        }
    } else {
        echo "لم يتم العثور على منتجات.";
    }
    ?>
</main>
<!----product end------>

</body>
</html>
