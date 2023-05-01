<div class="nav nav2">
    <button><a href="Store_index.php">店家首頁</a></button>

    <button id=""><a href="simple-product-admin.php">商品管理</a></button>

    <!-- 用if判斷式改變列表連結 -->
    <?php if (empty($_SESSION['admin']) and empty($_SESSION['store'])) : ?>
        <!-- 沒有admin和store 不顯示 -->
    <?php elseif (empty($_SESSION['admin'])) : ?>
        <!-- 有store但沒有admin -->
        <button>
            <a href="store_list.php">店家資料</a>
        </button>
        <!-- 有admin -->
    <?php else : ?>
        <button>
            <a href="store_list.php">店家資料管理</a>
        </button>
    <?php endif; ?>

    <!-- ---------------我是分隔線---------------- -->

    <?php if (empty($_SESSION['admin'])) : ?>

    <?php else : ?>
        <button>
            <a href="store_register-form.php">店家資料新增</a>
        </button>
    <?php endif; ?>

    <!-- ---------------我是分隔線---------------- -->

    <!-- <button ><a href="writetest.php">上傳頁</a></button>

    <button><a href="update.php">修改頁</a></button>

    <button><a href="delete.php">刪除頁</a></button>-->

    <button id="goOrder"><a href="Store_Order.php">訂單</a></button>

    <button id="coupon"><a href="Store_coupon.php">優惠券</a></button>


    <?php if (empty($_SESSION['store']) and empty($_SESSION['admin'])) : ?>

        <div class="LOGIN"><a href="Store_login.php">登入</a></div>


        <div class="LOGOUT"><a class="nav-link" href="Store_register-form.php">註冊</a></div>

    <?php else : ?>

        <div class="LOGIN">
            <a class="nav-link">
                <?php
                if (empty($_SESSION['admin'])) {
                    echo $_SESSION['store']['nickname'];
                } else {
                    echo $_SESSION['admin']['nickname'];
                }
                ?>
            </a>
        </div>


        <div class="LOGOUT"><a class="nav-link" href="Store_logout.php">登出</a></div>

    <?php endif; ?>

    <button id=""><a href="index.php">會員頁面</a></button>

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

    .nav2 {
        background-color: #ccf;
    }
</style>