let cartItems = []; // تأكد أن لديك هذه المتغيرات في مكان آخر
let cartCount = 0;  // تأكد أن لديك هذه المتغيرات في مكان آخر

// إضافة المنتج إلى السلة
function addToCart(productName, productPrice, quantity) {
    const qty = parseInt(quantity); // تحويل الكمية إلى عدد صحيح

    if (qty > 0) {
        cartCount++; // تحديث عدد المنتجات في السلة
        document.querySelector('.cart-count').innerText = cartCount;

        // تحقق إذا كان المنتج موجود بالفعل في السلة
        const existingProductIndex = cartItems.findIndex(item => item.name === productName);

        if (existingProductIndex !== -1) {
            // إذا كان المنتج موجود بالفعل، قم بتحديث الكمية
            cartItems[existingProductIndex].quantity += qty;
        } else {
            // إضافة المنتج الجديد إلى السلة
            cartItems.push({ name: productName, price: productPrice, quantity: qty });
        }

        updateCartItems(); // تحديث السلة بعد إضافة المنتج
    } else {
        alert(`${productName} غير متوفر.`);
    }
}

// تحديث المنتجات في السلة
function updateCartItems() {
    const cartList = document.querySelector('.cart-items'); // العنصر الذي سيحتوي على العناصر المضافة
    cartList.innerHTML = ''; // تفريغ السلة الحالية

    // إضافة كل عنصر في السلة
    cartItems.forEach((item) => {
        const li = document.createElement('li');
        li.innerHTML = `${item.name} - ${item.price} JD - الكمية: ${item.quantity}`;
        cartList.appendChild(li); // إضافة العنصر إلى القائمة
    });

    // تحديث إجمالي العناصر
    document.querySelector('.cart-summary .cart-count').innerText = cartItems.length;


// إظهار/إخفاء السلة
document.addEventListener('DOMContentLoaded', function() {
    // تعريف toggleCart هنا
    function toggleCart() {
        const cartModal = document.getElementById('cartModal');
        cartModal.style.display = cartModal.style.display === 'none' ? 'block' : 'none';
    }
});
}
// إفراغ السلة
function emptyCart() {
    cartCount = 0; // إعادة تعيين عدد المنتجات
    cartItems = []; // إعادة تعيين مصفوفة العناصر
    document.querySelector('.cart-count').innerText = cartCount; // تحديث العدد
    updateCartItems(); // تحديث السلة
}

function confermcart() {
    console.log("تحقق من العناصر في السلة...");
    console.log(cartItems); // طباعة محتويات السلة في وحدة التحكم

    if (cartItems.length === 0) {
        alert("سلتك فارغة.");
        return;
    }

    let cartDetails = "تفاصيل السلة:\n\n";
    cartItems.forEach(item => {
        cartDetails += `${item.name} - ${item.price} JD\n`;
    });

    cartDetails += `\nعدد المنتجات: ${cartCount}`;

    if (confirm(cartDetails + "\nهل تريد تأكيد الطلب؟")) {
        alert("تم تأكيد الطلب! ستتم إعادة توجيهك الآن.");
        window.location.href = "order_form .html"; // تأكد من أن اسم الملف صحيح
        emptyCart(); // إفراغ السلة بعد التأكيد
    } else {
        alert("تم إلغاء الطلب.");
    }
    
}

import React from 'react';
import ReactDOM from 'react-dom/client';
import { HashRouter as Router } from 'react-router-dom'; // استيراد HashRouter
import App from './App';

const root = ReactDOM.createRoot(document.getElementById('root'));

root.render(
    <Router>  {/* استخدم HashRouter هنا */}
        <App />
    </Router>
);
