<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shop</title>

  <link rel="stylesheet" href="assets/css/bootstrap5.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="user/style.css">
  <link rel="stylesheet" href="user/cart2.css">

</head>
<style>
  body {
    background-color: whitesmoke;
  }

  /* Navbar */
  #navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    background-color: #A39193;
    position: sticky;
    top: 0;
    z-index: 100;
  }

  .logo img {
    max-width: 100px;
    height: auto;
  }

  .search-container {
    display: flex;
    align-items: center;
  }

  .search-container input[type="text"] {
    padding: 5px;
    margin-right: 5px;
    border-radius: 5px;
    border: 1px solid #ccc;
    width: 200px;
    transition: width 0.3s ease-in-out;
  }

  @media screen and (max-width: 600px) {
    .search-container input[type="text"] {
      width: 100px;
    }
  }


  #search-button {
    padding: 5px 10px;
    border-radius: 5px;
    border: none;
    background-color: #555;
    color: #fff;
    cursor: pointer;
  }

  .item ul {
    display: flex;
    list-style-type: none;
    margin: 0;
    padding: 0;
  }

  .item ul li {
    margin-right: 10px;
  }

  .item ul li a {
    text-decoration: none;
    color: #555;
  }

  .cart a {
    text-decoration: none;
    color: #555;
  }

  .cart span {
    background-color: #555;
    color: #fff;
    padding: 2px 5px;
    border-radius: 50%;
    font-size: 12px;
  }

  .item-dropdown ul {
    display: flex;
    list-style-type: none;

    margin-right: 50px;
    padding: 0;
  }

  .item-dropdown ul li {
    margin-right: 10px;
  }

  .item-dropdown ul li a {
    text-decoration: none;
    color: #555;
  }

  /* Dropdown */
  .dropdown-menu {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    padding: 12px 16px;
    z-index: 1;
    top: 100%;
  }

  .nav-item.dropdown {
    position: relative;
  }

  .nav-item.dropdown:hover .dropdown-menu {
    display: block;
  }

  .dropdown-menu li {
    display: none;
  }

  .nav-item.dropdown:hover .dropdown-menu li {
    display: block;
  }

  /* Responsive Styles */
  @media (max-width: 768px) {
    .logo img {
      max-width: 80px;
    }

    #search-input {
      width: 150px;
    }

    #search-button {
      padding: 3px 8px;
    }
  }

  :root {
    --bg-color: #ecf29f9;
    --outer-shadow: 3px 3px 3px #fff, -3px -3px 3px #ceced1;
    --inner-shadow: inset 3px 3px 3px #fff, inset -3px -3px 3px #ceced1;
    --color: olive;
  }

  /* SHOP */
  h1 {
    font-size: 30px;
    text-align: center;
    margin: 2rem auto;
    text-transform: uppercase;
    color: #555;
  }

  .product-item-container {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(15rem, 1rem));
  }

  .product-item-container img {
    width: 150px;
    height: 150px;
    padding: .5rem;
    box-shadow: var(--outer-shadow);
    margin: 1rem 0;
    border-radius: 50%;
  }

  .product-item-container .box {
    box-shadow: var(--outer-shadow);
    margin: .4rem;
    text-align: center;
  }

  .product-item-container .btn {
    width: 150px;
    margin: .5rem auto;
    cursor: pointer;
    text-transform: uppercase;
    box-shadow: var(--outer-shadow);
    color: olive;
    border: none;
    outline: none;
    background-color: transparent;
  }

  .message {
    margin-top: 4rem;
    max-width: 1000px;
    margin: 0 auto;
    text-transform: uppercase;
    color: olive;
    background-color: #000;
    padding: 1rem 3px;
    border-radius: 5px;
  }

  .message i {
    font-size: 2rem;
    cursor: pointer;
    float: right;
    cursor: var(--color);
  }

  .btn .option-btn .delete-btn {
    cursor: pointer;
    text-transform: uppercase;
    box-shadow: var(--outer-shadow);
    color: olive;
    border: none;
    outline: none;
    background-color: transparent;
  }

  .delete-btn .option-btn {
    font-size: 14px;
    padding: .5rem 1rem;
    border-radius: 5px;
    color: red;
    font-weight: bold;
  }

  .option-btn {
    color: olive;
  }

  .cart-container table {
    background-color: var(--bg-color);
    width: 70vw;
    margin: 0 auto;
    text-align: center;
    border-radius: 10px;
  }

  .cart-container table tr {
    padding: 1rem 0;
    box-shadow: var(--outer-shadow);
  }

  .cart-container table tr td {
    margin: 1rem;
    border-bottom: 1px solid #333;
    font-size: 1rem;
    color: #555;
  }

  .cart-container input[type='number'] {
    padding: .5rem 1rem;
    width: 5rem;
  }

  .cart-container input[type='submit'] {
    width: 80px;
    border-radius: 5px;
    padding: .5rem;
    cursor: pointer;
    color: orange;
    text-transform: uppercase;
  }

  .cart-container .delete-btn,
  .cart-container .option-btn {
    font-size: 15px;
    padding: .5rem 1rem;
    border-radius: 5px;
  }

  .cart-container .delete-btn:hover {
    box-shadow: var(--inner-shadow);
  }

  .table-bottom {
    padding: 1rem 2rem;
  }

  .table-bottom tr td {
    border-bottom: none;
  }

  .cart-container img {
    height: 100px;
    width: 100px;
    border-radius: 50%;
    padding: .5rem;
    box-shadow: var(--inner-shadow);
  }

  .cart-container .checkout-btn {
    text-align: center;
    margin-top: 2rem;
  }

  .checkout-btn a {
    width: auto;
    margin: 0 auto;
    background-color: olive;
    color: #fff;
    border-radius: 5px;
    padding: .5rem 2rem;
  }

  .checkout-btn a.disabled {
    pointer-events: none;
    opacity: .5;
    user-select: none;
    background-color: orangered;
  }

  /* checkout */

  .checkout-form {
    width: 70vw;
    margin: 0 auto;
  }

  .checkout-form form {
    width: 100%;
    box-shadow: var(--outer-shadow);
    background-color: var(--bg-color);
    margin-top: 4rem;
    margin-bottom: 2rem;
    padding: 2rem;
    border-radius: 10px;
    display: flex;
    flex-wrap: wrap;
  }

  .checkout-form form .input-field {
    width: 48%;
    margin: 0 .5rem;
  }

  .checkout-form form .input-field input {
    width: 100%;
    box-shadow: var(--outer-shadow);
    background-color: transparent;
    border-radius: 5px;
    border: none;
    padding: 1rem;
    margin: .5rem 0;
    outline: none;
    color: olive;
  }

  .checkout-form form .input-field select {
    width: 100%;
    box-shadow: var(--outer-shadow);
    background-color: transparent;
    border-radius: 5px;
    border: none;
    padding: 1rem;
    margin: .5rem 0;
    outline: none;
    color: olive;
  }

  .btn {
    cursor: pointer;
    text-transform: uppercase;
    box-shadow: var(--outer-shadow);
    color: olive;
    border: none;
    outline: none;
    background-color: transparent;
    margin-top: 10px;
    text-align: center;
    margin-left: 28rem;
  }

  .checkout-form span {
    text-transform: uppercase;
    color: #555;
  }

  .display-order span {
    display: inline-block;
    box-shadow: var(--outer-shadow);
    padding: .4rem;
  }

  .display-order {
    margin: 0 auto;
    box-shadow: var(--inner-shadow);
    border-radius: 5px;
    text-align: center;
    padding: .9rem 2rem;
  }

  .display-order .grand-total {
    width: 100%;
    background-color: red;
    color: #fff;
    cursor: pointer;
  }

  .order-confirm-container {
    position: fixed;
    top: 0;
    left: 0;
    min-height: 100vh;
    overflow-y: scroll;
    overflow-x: hidden;
    padding: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1100;
    background-color: var(--bg-color);
    width: 100%;
  }

  .message-container {
    width: 40rem;
    line-height: 2;
    box-shadow: var(--outer-shadow);
    border-radius: 20px;
    padding: 2rem;
    text-align: center;
  }

  .message-container h3 {
    color: orange;
    text-align: center;
    text-transform: uppercase;
  }

  .order-detail {
    box-shadow: var(--inner-shadow);
    border-radius: 5px;
    padding: 1rem;
    margin: 1rem 0;
  }

  .order-detail span {
    color: #555;
    border-radius: .5rem;
    box-shadow: var(--outer-shadow);
    font-size: 1.3rem;
    display: inline-block;
    padding: 1rem 1.5rem;
  }

  .order-detail .total {

    display: inline-block;
    background-color: red;
    color: #fff;
    text-transform: uppercase;
  }

  .customer-detail {
    text-transform: capitalize;
    font-size: 1.4rem;
  }

  .customer-detail span {
    color: olive;
    font-weight: bold;
  }

  .pay {
    margin: 1rem;
  }

  .order-confirm-container .btn {
    padding: .4rem 1rem;
    border-radius: 5px;
  }

  .order-message-container {
    margin-top: 50px;
    margin-bottom: 180px;
    margin-left: 28%;
    padding: 10px;
  }



  /* Modal Styles */
  .modal {
    display: none;
    position: fixed;
    z-index: 1;
    padding-top: 100px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
    margin-top: 30px;
  }

  .modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 600px;
    text-align: center;
    position: relative;
  }

  .modal-close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
    position: absolute;
    top: 10px;
    right: 10px;
  }

  .modal-content img {
    max-height: 200px;
    /* Adjust the height value as needed */
    width: auto;
    margin: 0 auto;
    display: block;
  }
</style>


<body>