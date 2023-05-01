<div class="nav">

    <div>購物車</div>

    <div id="cartcount">0</div>



    <button><a href="index.php">首頁</a></button>

    <?php if (!empty($_SESSION['admin'])) : ?>

        <button><a href="list.php">管理者會員列表</a></button>
        <button><a href="list-forum.php">管理者論壇列表</a></button>
    <?php else : ?>
        <!-- <button><a href="list-forum.php">論壇</a></button> -->
    <?php endif; ?>


    <button id=""><a href="Chat_index.php">論壇</a></button>

    <button id="goCart"><a href="">購物車</a></button>

    <button id="goOrder"><a href="Member_Order.php">訂單</a></button>

    <button id="goCoupon"><a href="Member_CouponShow.php">確認優惠券</a></button>

    <button id="goCouponGet"><a href="Member_CouponGet.php">獲得優惠券</a></button>

    <button><a href="list-user.php">會員修改</a></button>


    <?php if (empty($_SESSION['user'])) : ?>

        <div class="LOGIN"><a href="Member_login.php">登入</a></div>


        <div class="LOGOUT"><a class="nav-link" href="register.php">註冊</a></div>

    <?php else : ?>

        <div class="LOGIN"><?= $_SESSION['user']['nickname'] ?></a></div>


        <div class="LOGOUT"><a class="nav-link" href="Member_logout.php">登出</a></div>

    <?php endif; ?>


    <button id=""><a href="Store_index.php">店家頁面</a></button>

</div>

<style>
    .LOGIN {
        margin: 0 2%;
    }

    .LOGOUT {
        margin: 0 2%;
    }

    .nav {
        display: flex;
        height: 50px;
        width: 100%;
        background-color: #cfc;
        justify-content: end;
        align-items: center;
        padding: 0 5%;
        position: sticky;
        top: 0;
    }
</style>


<script>
    let cartCountBoxNav = document.querySelector("#cartcount");

    function navCheckCartNum(cartAmountTarget) {
        fetch("CartTotal_api.php")
            .then(r => r.json())
            .then(res => {
                cartAmountTarget.innerText = res;
            })
    }
    navCheckCartNum(cartCountBoxNav);

    let cartLink = document.querySelector("#goCart");

    cartLink.addEventListener("click", (evt) => {
        evt.preventDefault();
        fetch("Checkcart_api.php").then(r => r.json()).then(res => {
            if (res == 0) {
                alert("購物車為空!!");
                evt.preventDefault();
            } else if (res == 1) {
                location.href = "CartChooseShop.php";
            }
        })

    })
</script>