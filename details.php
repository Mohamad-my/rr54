<?php
// الاتصال بقاعدة البيانات
include('include/connected.php');

// الحصول على معرف المنتج من الرابط
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// جلب تفاصيل المنتج من قاعدة البيانات
$sql = "SELECT * FROM product WHERE id = $product_id";
$result = $conn->query($sql);

// التحقق من وجود المنتج
if ($result && $result->num_rows > 0) {
    $product = $result->fetch_assoc();

    // إضافة البيانات إلى جدول details
   
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['proname']; ?> - تفاصيل المنتج</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body dir="rtl">
    <div class="container mt-5">
        <!-- عرض صورة المنتج -->
        <div class="product-image">
            <img src="uploads/img/<?php echo $product['proimg']; ?>" alt="Product Image" class="img-fluid" style="width:290px;">
        </div>

        <!-- عرض اسم المنتج -->
        <h1><?php echo $product['proname']; ?></h1>

        <!-- عرض وصف المنتج -->
        <p><?php echo $product['prodescipr']; ?></p>

        <!-- عرض فيديو عن المنتج إذا كان موجوداً -->
       
        <?php
// تحويل رابط YouTube إلى رابط مدمج
if (!empty($product['video_link'])) {
    $video_url = $product['video_link'];

    // تحويل رابط youtu.be إلى صيغة embed
    if (strpos($video_url, 'youtu.be') !== false) {
        $video_id = substr(parse_url($video_url, PHP_URL_PATH), 1); // استخراج الـ VIDEO_ID
        $video_url = "https://www.youtube.com/embed/" . $video_id;
    }

    // تحويل رابط youtube.com/watch إلى صيغة embed
    if (strpos($video_url, 'watch?v=') !== false) {
        $video_id = explode("v=", $video_url)[1]; // استخراج الـ VIDEO_ID
        $ampersandPosition = strpos($video_id, '&'); // التحقق إذا كان هناك متغيرات بعد الـ ID
        if ($ampersandPosition !== false) {
            $video_id = substr($video_id, 0, $ampersandPosition); // استخراج الـ ID فقط
        }
        $video_url = "https://www.youtube.com/embed/" . $video_id;
    }
?>
    <div class="product-video">
        <iframe width="560" height="315" src="<?php echo $video_url; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div>
<?php } ?>



        <!-- رابط العودة إلى صفحة المنتجات -->
        <a href="index.php" class="btn btn-primary">عودة إلى قائمة المنتجات</a>
    </div>
</body>
</html>

<?php
} else {
    echo "لم يتم العثور على المنتج.";
}

$conn->close();
?>
