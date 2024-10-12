<?php
$host="localhost:3309:3309";
$username="root";
$password="";
$dbname="task";

$conn=mysqli_connect($host ,$username,$password,$dbname);
if(isset($conn)){
    echo"اتصال ناجح بقاعدة البيانات";
}
else{
    echo"لم يتم الاتصال يقاعدة البيانات";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png"href="img/4660619.png">
    <title>منتجات</title>
    <style>
        .navbar {
            background-color: #333;
            padding: 15px;
        }

        .navbar-brand {
            color: #fff;
            font-size: 28px;
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            color: #fff;
            margin-right: 20px;
            font-size: 18px;
        }

        .navbar-nav .nav-link:hover {
            color:gray;
        }
        .cart ul{
           list-style-type: none;
           margin: 0;
           padding: 0;
        }
        .cart ul li{
            display: inline-block;
            margin-left: 15px;
            padding: 2px;
            font-size: 24px;
        }
        .cart ul li a {
            color: #080808;
        }
        .cart  ul li a:hover{
            color:gray
        }
        .cart-icon{
            position: relative;
            display: inline-block;
        }
        .cart-count{
            position: absolute;
            top:-8px;
            right: -8px;
            background-color: red;
            color: #fff;
            padding: 4px 6px;
            border-radius: 50%;
            font-size: 11px;
        }
   /* start product */
       main{
        display: flex;
        flex-wrap: wrap;
       }
       .product{
        background-color:#eeeee6;
        position: relative;
        margin: 10px;
        margin-top: 50px;
        width: 200px;
        padding: 20px;
        border: 1px solid;
        box-shadow: 0 5px 10px rgba(0,0,0,1);
        margin-bottom: 40px;
       }

       .product a{
        text-decoration: none;
        color:#080808;
        font-size: 15px;
        font-weight: bold;
        margin: 4px;
       }
       .product-img{
         text-align: center;
       }
       .product-img img{
        width: 175px;
        height: 150px;
        border-radius: 25px;
       }
       .product-img:hover{
        opacity:0.7 ;
       }
      .product-name{
        margin-top: 15px;
        text-align: center;
       }
       .product-price{
        text-align: center;
        margin-top: 5px;
       }
       .product-price a{
        color:darkcyan;
        font-size: 18px;
        font-weight: bols;
       }
       .product-description{
        text-align: center;
        margin-top: 10px;
       }
       .product-description i{
        margin: 5px;
        color: black;
       }
       .qty-input {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 120px; /* تعديل العرض حسب رغبتك */
}



input[type="number"] {
    text-align: center;
    width: 80px;
    height: 30px;
    border: 2px solid #ccc;
    font-size: 16px;
}
.addto-cart {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            transition: background-color 0.3s ease;
        }

        .addto-cart:hover {
            background-color: seagreen;
        }

        /* تنسيق الأيقونة داخل الزر */
        .addto-cart i {
            margin-right: 8px;
        }
       .unvailabel{
        position: absolute;
        top: 20px;
        left:15px;
        transform: rotate(-25deg);
        width: 100px;
        text-align: center;
        font-size: 18px;
        font-weight: bold;
        color:#080808;
        padding: 5px 5px;
      
       }
       .cart-modal {
    display: none; /* Initially hidden */
    position: fixed;
    top: 0;
    right: 0; /* Directly on the right side */
    width: 400px; /* Fixed width for the modal */
    height: 100%;
    background-color:white; /* Transparent dark overlay */
    z-index: 1000;
    justify-content: flex-end; /* Align the modal content to the right */
    align-items: center;
    visibility: hidden; /* Initially hidden */
}

.cart-modal.show {
    display: flex; /* Show modal */
    visibility: visible; /* Make modal visible */
}

.cart-modal-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    width: 100%; /* Take full width of the modal */
    height: 100%; /* Full height */
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    position: relative;
}

/* Other styles remain unchanged */
.cart-modal-content h2 {
    text-align: center;
    font-size: 1.8rem;
    margin-bottom: 20px;
    color: #333;
}

.cart-items {
    list-style: none;
    padding: 0;
    margin: 0 0 20px 0;
    max-height: 300px;
    overflow-y: auto; /* Allow scroll for long lists */
}

.cart-items li {
    padding: 10px 0;
    border-bottom: 1px solid #ddd;
    display: flex;
    justify-content: space-between;
    font-size: 1.1rem;
}

.cart-items li:last-child {
    border-bottom: none;
}

.cart-summary {
    margin-top: 20px;
    text-align: center;
}

.cart-summary p {
    font-size: 1.4rem;
    font-weight: bold;
    margin-bottom: 15px;
}

.cart-summary button {
    background-color:teal;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1.1rem;
    margin: 5px;
    transition: background-color 0.3s;
}

.cart-summary button:hover {
    background-color:#2f4f4f;
}

.cart-summary button:nth-child(2) {
    background-color: #dc3545;
}

.cart-summary button:nth-child(2):hover {
    background-color: #c82333;
}

/* Close button */
.close {
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 2rem;
    cursor: pointer;
    color: #888;
}

.close:hover {
    color: #333;
}

    /* end product */
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
        <a class="navbar-brand" href="#" style="display: flex; align-items: center;">
    <span>Medical Devices</span>
    <img src="img/34.png" alt="Logo" width="90" height="40" style="margin-left: 10px;">
</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="http://localhost/Task/index.html">Home</a>
                    </li>
                    <li class="nav-item">
                       <a class="nav-link" href="#index"> product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/Task/About_us.html">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/Task/Review.php">Review</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
     <!---------- cart start------------>
     <div class="last-post">
     <div class="cart">
    <ul>
        <li><a href="admain/admin.php"><i class="bi bi-person-circle"></i></a></li>
        <li class="cart-icon">
            <a href="#" onclick="toggleCart()"><i class="bi bi-bag-fill"></i></a>
            <span class="cart-count">0</span>
        </li>
    </ul>
    
<!-- نافذة السلة -->
<div class="cart-modal" id="cartModal" style="display: none;">
    <div class="cart-modal-content">
        <span class="close" onclick="toggleCart()">&times;</span>
        <h2>عناصر السلة</h2>
        <ul class="cart-items"></ul> <!-- هذه القائمة سيتم تعبئتها بعناصر السلة -->
        <div class="cart-summary">
            <p>إجمالي العناصر: 
            <br>
            <button onclick="emptyCart()">إفراغ السلة</button>
            <button onclick="confermcart()">تأكيد الطلب</button>
        </div>
    </div>
</div>

<script>
        function toggleCart() {
            const cartModal = document.getElementById('cartModal');
            console.log("تبديل عرض السلة");
            cartModal.style.display = cartModal.style.display === 'none' ? 'block' : 'none';
        }

        document.querySelector('.cart-icon').addEventListener('click', function() {
    document.querySelector('.cart-modal').classList.add('show');
});

document.querySelector('.close').addEventListener('click', function() {
    document.querySelector('.cart-modal').classList.remove('show');
});


    </script>


</div>
        <!---------- cart end------------>

    </div>

    <script src="je.js"></script>