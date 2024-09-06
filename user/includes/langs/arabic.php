<?php

function lang($phrase)
{
    static $lang = array(

        // SignUp Page
        "Confirm Code" => "ادخل رمز التأكيد",
        "Username" => "اسم المستخدم",
        "Fullname" => "الاسم بالكامل",
        "Confirm" => "تأكيد",
        "account-success" => "تم عمل الحساب..يمكنك الان ",
        "account-failed" => "الكود خطأ برجاء المحاولة بعد 5 ثواني",
        "Your Code" => "رمز التأكيد",

        // Login Page
        "Login Form" => "تسحيل الدخول",
        "Email" => "البريد الاليكتروني",
        "Password" => "الباسورد",
        "SignUp" => "عمل حساب",
        "Login" => "تسجيل دخول",


        //Navbar
        "Home" => "الرئيسية",
        "Store" => "المتجر",
        "Cart"  => "العربة",
        "Contact Us" => "تواصل معنا",
        "About Us" => "معلومات عننا",

        //HomePage
        "Message" => "اهلا",
        "WE MAKE" => "نقوم بصنع ",
        "AWESOME PRODUCTS" => "منتجات مميزة",
        "JUST FOR YOU" => "لأجلك",
        "Shop Now" => "تسوق الأن",
        "Feature Products" => "منتجات مميزة",
        "Buy Now" => "اشتري الأن",
        "Menu" => "القوائم",
        "Contact Us" => "تواصل معنا",

        // Store Page
        "Your Store" => "متجرك الاليكتروني",
        "Price" => "السعر",
        "Color" => "اللون",
        "Size"  => "المقاس",
        "Black" => "اسود",
        "White" => "ابيض",
        "Blue"  => "ازرق",
        "black" => "اسود",
        "white" => "ابيض",
        "blue"  => "ازرق",
        "Add To Cart"   => "اضف الي العربة",
        "EGP"   => "جنيها",
        "Add Comment" => "اضف تعليق",
        "Add Your Comment" => "اضف تعليقك",
        "Please"    => "برجاء",
        "Login" => "تسجيل الدخول",
        "Register" => "سجل",
        "or" => "أو",
        "To Add Comment" => "لاضافة تعليق",
        "Related Products" => "منتجات مشابهة",
        "Tags" => "تاجات",
        "No Tag" => "لا يوجد تاج",
        "Search For Products" => "ابحث عن منتجاتك",
        "Categories" => "فئات",
        "All" => "الكل",


        // Cart Page
        "My Carts" => "سلة التسوق",
        "ID"    => "الرقم",
        "Image" => "الصورة",
        "Product" => "المنتج",
        "Quantity" => "الكمية",
        "Subtotal" => "المبلغ الفرعي",
        "Control" => "التحكم",
        "Delete" => "حذف",
        "Total Price" => "المبلغ الكلي",
        "Proceed To Checkout" => "الأنتقال للدفع",
        "No Image" => "لا يوجد صورة",

        // About Page
        "The Mission" => "المهمة",
        "About Message 1" => "في قلب كل شئ <br> نسعي لتقديم <br> افضل جودة لدينا<br>",
        "About Message 2" => "ما يميزنا ليس فقط تنوع <br>التصاميم ولكن الجودة التي تُدرج في كل غرزة.<br>نحن ملتزمون بتوفير لك قمصانًا تيشيرت 
        <br>ليس فقط تظهر بمظهر رائع ولكن أيضًا تشعر برائع ضد<br>بشرتك. التزامنا باستخدام المواد الفاخرة
        <br>ضمانًا بأن كل قميص تيشيرت ناعم وقوي<br>وممتع للارتداء، يومًا بعد يوم.",
        // Contact Page
        "Message" => "رسالتك",
        "Send Message" => "ارسل الرسالة",
        "Message Sent" => "تم ارسال الرسالة",

        // Checkout Page
        "Checkout"  => "الحساب",
        "Personal Data" => "بيانات شخصية",
        "Billing Details" => "تفاصيل الفاتورة",
        "First name" => "الاسم الاول",
        "Last name" => "الاسم الاخير",
        "House number and street name" => "رقم المنزل واسم الشارع",
        "Town / City" => "المدينة / البلد",
        "State / Country" => "الدولة / الولاية",
        "Phone" => "رقم المحمول",
        "Email" => "البريد الاليكتروني",
        "Confirm" => "تأكيد",
        "Shipping" => "الشحن",
        "Free" => "مجانا",
        "Total" => "المبلغ الكلي",
        "pay cash" => "الدفع نقدا عند الاستلام",
        "paymob" => "او الدفع عن طريق",


        // Errors
        "Empty Name" => "لا يجب ان يكون الاسم فارغا",
        "Empty Email" => "لا يجب ان يكون البريد الاليكتروني فارغا",
        "Empty Password" => "لا يجب ان تكون كلمة السر  فارغة",
        "Empty Fullname" => "لا يجب ان يكون الاسم بالكامل فارغا",
        "Empty Comment" => "لا يحب ان يكون التعليق فارغا",
        "Empty Firstname" => "لا يجب ان يكون الاسم الاول فارغا",
        "Empty Lastname" => "لا يجب ان يكون الاسم الاخير فارغا",
        "Empty Street" => "لا يجب ان يكون خانة الشارع فارغة",
        "Empty City" => "لا يجب ان يكون خانة المدينة فارغة",
        "Empty Country" => "لا يجب ان يكون خانة الدولة فارغة",
        "Empty Phone" => "لا يجب ان يكون خانة الرقم فارغة",
        "Empty Cart" => "سلة تسوقك فارغة الأن",
        "Empty Message" => "لا يجب ان تكون خانة الرسالة فارغة",
        "Char Name" => "لا يجب ان يكون الاسم اقل من حرفين",
        "Char Fullname" => "يجب ان يكون الاسم بالكامل اكقر من 5 احرف",
        "Char Password" => "يجب ان تكون كلمة السر اكبر من 7 احرف",
        "Char Message" => "يجب ان تكون الرسالة اقل من 70 حرف",
        "Invalid Email" => "البريد الاليكتروني غير صحيح",
        "Invalid Phone" => "رقم المحمول غير صحيح",
        "error-phone-number" => "خانة الرقم يجب ان تحتوي علي ارقام",
        "check-msg-fail" => "لا يوجد بريد اليكتروني بهذا الاسم",
        "check-acc-fail" => "حسابك غير موجود..يمكنك المحاولة بعد 5 دقائق",
        "Fullname letter" => "يجب ان يحتوي الاسم بالكامل علي حروف ومسافات فقط",
        "Is Not Found" => "غير موجود",
        "Email Exist" => "البريد الاليكتروني مستخدم بالفعل",
        "Email Wrong" => "البريد الاليكتروني او كلمة السر غير صحيح",



        // Success
        "check-msg-suc" => "تم اضافة طلبك بنجاح",
        "login-suc" => "تم التسجيل بنجاح.. سيتم تحويلك الي الصفحة الرئيسية خلال 5 ثواني",
        "suc-msg-login" => "تم عمل الحساب بنجاح ..الان يمكنك ",


        ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩']

    );
    return $lang[$phrase];
}
