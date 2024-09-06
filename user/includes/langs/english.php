<?php

function lang($phrase)
{

    $lang = array(

        // SignUp Page
        "Confirm Code" => "Enter Confirmation Code",
        "Username" => "Username",
        "Fullname" => "Fullname",
        "Confirm" => "Confirm",
        "account-success" => "Your Account Is Created. Now You Can",
        "account-failed" => "Wrong Code Please Try Again After 5 Seconds",
        "Your Code" => "Your Code",

        // Login Page
        "Login Form" => "Login Form",
        "Email" => "Email",
        "Password" => "Password",
        "SignUp" => "SignUp",
        "Login" => "Login",


        // Navbar Page
        "Home" => "Home",
        "Store" => "Store",
        "Cart"  => "Cart",
        "Contact Us" => "Contact Us",
        "About Us" => "About Us",

        // HomePage
        "Message" => "Welcome",
        "WE MAKE" => "WE MAKE",
        "AWESOME PRODUCTS" => "AWESOME PRODUCTS",
        "JUST FOR YOU" => "JUST FOR YOU",
        "Shop Now" => "Shop Now",
        "Feature Products" => "Feature Products",
        "Buy Now" => "Buy Now",
        "Menu" => "Menu",
        "Contact Us" => "Contact Us",

        // Store Page
        "Your Store" => "Your Store",
        "Price" => "Price",
        "Color" => "Color",
        "Size"  => "Size",
        "Black" => "Black",
        "White" => "White",
        "Blue"  => "Blue",
        "black" => "Black",
        "white" => "White",
        "blue"  => "Blue",
        "Add To Cart"   => "Add To Cart",
        "EGP"   => "EGP",
        "Add Your Comment" => "Add Your Comment",
        "Add Comment" => "Add Comment",
        "Login" => "Login",
        "Please"    => "Please",
        "Register" => "Register",
        "or" => "or",
        "To Add Comment" => "To Add Comment",
        "Related Products" => "Related Products",
        "Tags" => "Tags",
        "No Tag" => "No Tag",
        "Search For Products" => "Search For Products",
        "Categories" => "Categories",
        "All" => "All",

        // Cart Page
        "My Carts" => "My Carts",
        "ID"    => "ID",
        "Image" => "Image",
        "Product" => "Product",
        "Quantity" => "Quantity",
        "Subtotal" => "Subtotal",
        "Control" => "Control",
        "Delete" => "Delete",
        "Total Price" => "Total Price",
        "Proceed To Checkout" => "Proceed To Checkout",
        "No Image" => "No Image",

        // About Page
        "The Mission" => "THE MISSION",
        "About Message 1" => "At the heart of <br> everything, we set out to <br> offer the best quality.<br>",
        "About Message 2" => "What sets us apart is not just the variety of <br>designs, but the quality that goes into every stitch. <br>We're dedicated to providing you with T-shirts that <br>not only look great but also feel amazing against <br>your skin. Our commitment to using premium <br>fabrics ensures that each T-shirt is soft, durable, <br>and a joy to wear, day in and day out.",
        // Contact Page
        "Message" => "Message",
        "Send Message" => "Send Message",
        "Message Sent" => "Message Sent",

        // Checkout Page
        "Checkout"  => "Checkout",
        "Personal Data" => "Personal Data",
        "Billing Details" => "Billing Details",
        "First name" => "First name",
        "Last name" => "Last name",
        "House number and street name" => "House number and street name",
        "Town / City" => "Town / City",
        "State / Country" => "State / Country",
        "Phone" => "Phone",
        "Email" => "Email",
        "Confirm" => "Confirm",
        "Shipping" => "Shipping",
        "Free" => "Free",
        "Total" => "Total",
        "pay cash" => "Pay with cash upon delivery",
        "paymob" => "Or Pay With",

        // Errors
        "Empty Name" => "Your Name Can't Be Empty",
        "Empty Email" => "Your Email Can't Be Empty",
        "Empty Password" => "Your Password Can't Be Empty",
        "Empty Fullname" => "Your Fullname Can't Be Empty",
        "Empty Comment" => "Comment Can't Be Empty",
        "Empty Firstname" => "First name Can't Be Empty",
        "Empty Lastname" => "Last name Can't Be Empty",
        "Empty Street" => "Street Field Can't Be Empty",
        "Empty City" => "City Field Can't Be Empty",
        "Empty Country" => "Country Field Can't Be Empty",
        "Empty Phone" => "Phone Field Can't Be Empty",
        "Empty Cart" => "Your Cart Is Empty",
        "Empty Message" => "Message Field Can't Be Empty",
        "Char Name" => "Your Name Should Be More Than 2 Characters",
        "Char Fullname" => "Your FullName Should Be More Than 5 Characters",
        "Char Password" => "Your Password Should Be More Than 7 Characters",
        "Char Message" => "Message Must be Less Than 70 Chars",
        "Invalid Email" => "Invalid Email Format",
        "Invalid Phone" => "Invalid Phone Number",
        "check-msg-fail" => "Email Is Not Exist",
        "check-acc-fail" => "Your Account Is Not Exist..Please Try Again After 5 Seconds",
        "error-phone-number" => "Phone Field Should Be Number",
        "Fullname letter" => "Fullname Contain Only letters and white space",
        "Is Not Found" => "Is Not Found",
        "Email Exist" => "Email Is Already Used",
        "Email Wrong" => "Email or Password Is Wrong",

        // Success
        "check-msg-suc" => "Your Order Has Been Added",
        "login-suc" => "Login Successfuly.. You Will Go To HomePage Within 5 Seconds",
        "suc-msg-login" => "Your Account Is Created Now You Can ",


        ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9']
    );
    return $lang[$phrase];
}
