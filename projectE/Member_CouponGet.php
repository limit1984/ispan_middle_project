<?php require __DIR__ . './Connect_DataBase.php'; ?>

<?php require __DIR__ . './HeadCssSetting.php'; ?>

<?php require __DIR__ . './CssSetting_YU.php'; ?>

<?php require __DIR__ . './Member_nav.php'; ?>

<h3 id="couponPoint"></h3>

<h2 class="txtACenter fs30">優惠券</h2>
<div id="couponContent" class="disf fw-w f-jcsa">

    <div class="w300 pad10 borderR1">
        <div class="disf">
            <p class="w50p txtACenter">折扣50元</p>
            <p class="w50p txtACenter">領取期限</p>
        </div>
        <h3 class="fs36 txtACenter">50</h3>
        <div class="disf">
            <p class="w50p txtACenter">使用期限</p>
            <p class="w50p txtACenter">店名</p>
        </div>
        <input type="hidden" value="sid">
    </div>

    <div class="w300 pad10 borderR1">
        <div class="disf">
            <p class="w50p txtACenter">折扣50元</p>
            <p class="w50p txtACenter">領取期限</p>
        </div>
        <h3 class="fs36 txtACenter">50</h3>
        <div class="disf">
            <p class="w50p txtACenter">使用期限</p>
            <p class="w50p txtACenter">店名</p>
        </div>
        <input type="hidden" value="sid">
    </div>

</div>
<h2 class="txtACenter fs30">已領取的優惠券</h2>
<div id="gettedCouponContent" class="disf fw-w f-jcsa">

</div>


<script>
    fetch("Member_islogin_api.php").then(r => r.json()).then(res => {
        if (res == 0) {
            alert("請先登入");
            location.href = "Member_login.php";
        }
    })

    let YY = new Date().getFullYear();
    let MO = new Date().getMonth() + 1;
    let DO = new Date().getDate();
    let MM, DD;
    if (MO < 10) {
        MM = '0' + MO;
    } else {
        MM = MO;
    }
    if (DO < 10) {
        DD = '0' + DO;
    } else {
        DD = DO;
    }
    let dnow = `${YY}-${MM}-${DD}`;
    // console.log(dnow)
    //紅利點數顯示
    let couponPoint = document.querySelector("#couponPoint");
    //優惠券顯示框
    let couponContent = document.querySelector("#couponContent");
    //已領取的顯示框
    let gettedCouponContent = document.querySelector("#gettedCouponContent");
    //讀出資料  Read
    fetch("Member_CouponGetRender_api.php").then(r => r.json()).then(res => {
        // console.log(res);
        if (res.length != 0) {
            while (couponContent.hasChildNodes()) {
                couponContent.removeChild(couponContent.lastChild);
            }
        }
        let checkArray = [];
        res.check.forEach((value, index, array) => {
            checkArray[index] = value.coupon_sid;
        });
        // console.log(checkArray);

        //紅利點數
        let memberPoint = res.point;
        couponPoint.innerText = memberPoint;

        // console.log(memberPoint);

        // console.log(res.coupons);
        let couponDocFrag = document.createDocumentFragment();
        let gettedCouponDocFrag = document.createDocumentFragment();
        res.coupons.forEach(value => {
            let {
                coupon_available, //可見狀態
                coupon_name, //名稱
                expire, //使用期限
                get_limit_time, //取得期限
                need_point, //兌換紅利
                sale_detail, //折扣金額
                shop_sid, //商店SID
                sid, //優惠券SID
                use_range, //使用條件
                name //商店名稱
            } = value;

            let getLimit = get_limit_time.substr(0, 10);
            // console.log(getLimit);
            let useLimit = expire.substr(0, 10);
            // console.log(useLimit);

            let today = new Date(dnow);

            //全站使用變換
            let outputName = name;
            if (shop_sid == 101) {
                outputName = "全站通用";
            }

            //檢查是否領過
            let gettedOrNot = false;
            checkArray.forEach(value => {
                if (value == sid) {
                    gettedOrNot = true;
                }
            })

            //優惠券外框  couponTicket
            let couponTicket = document.createElement("div");

            let iro = "";
            if (sale_detail < 50) {
                iro = "coupon10";
            }
            // sale_detail
            else if (sale_detail >= 50 && sale_detail < 100) {
                iro = "coupon50";
            } else if (sale_detail >= 100 && sale_detail < 200) {
                iro = "coupon100";
            } else if (sale_detail >= 200 && sale_detail < 500) {
                iro = "coupon200";
            } else if (sale_detail >= 500 && sale_detail < 1000) {
                iro = "coupon500";
            } else if (sale_detail >= 1000 && sale_detail < 2000) {
                iro = "coupon1000";
            } else if (sale_detail >= 2000) {
                iro = "coupon2000";
            }

            couponTicket.classList.add("w350", "pad10", "borderR1", "aic", "txtACenter", iro);

            //上半   couponTop
            let couponTop = document.createElement("div");
            couponTop.classList.add("disf");

            //名稱   couponName
            let couponName = document.createElement("p");
            couponName.classList.add("w50p", "txtACenter");
            couponNameTxt = document.createTextNode(coupon_name);
            couponName.appendChild(couponNameTxt);
            if (!gettedOrNot) {
                let couponNameBr = document.createElement("br");
                couponName.appendChild(couponNameBr);
                couponNameTxt2 = document.createTextNode(`使用條件:${use_range}`);
                couponName.appendChild(couponNameTxt2);
            }
            couponTop.appendChild(couponName);
            //領取期限  couponLimitTime
            if (!gettedOrNot) {
                let couponLimitTime = document.createElement("p");
                couponLimitTime.classList.add("w50p", "txtACenter");
                couponLimitTimeTxt = document.createTextNode(`領取期限:${getLimit}`);
                couponLimitTime.appendChild(couponLimitTimeTxt);
                let couponLimitTimeBr = document.createElement("br");
                couponLimitTime.appendChild(couponLimitTimeBr);
                couponLimitTimeTxt2 = document.createTextNode(`所需點數:${need_point}`);
                couponLimitTime.appendChild(couponLimitTimeTxt2);
                couponTop.appendChild(couponLimitTime);
            } else if (gettedOrNot) {
                let couponLimitTime = document.createElement("p");
                couponLimitTime.classList.add("w50p", "txtACenter");
                couponLimitTimeTxt = document.createTextNode(`使用條件:$${use_range}`);
                couponLimitTime.appendChild(couponLimitTimeTxt);
                couponTop.appendChild(couponLimitTime);
            }

            couponTicket.appendChild(couponTop);
            //折扣金額   
            let couponPrice = document.createElement("h3");
            couponPrice.classList.add("fs36", "txtACenter");
            let couponPriceTxt = document.createTextNode(sale_detail);
            couponPrice.appendChild(couponPriceTxt);
            couponTicket.appendChild(couponPrice);
            //下半   couponBot
            let couponBot = document.createElement("div");
            couponBot.classList.add("disf");

            //使用期限  useLimitTime
            let useLimitTime = document.createElement("p");
            useLimitTime.classList.add("w50p", "txtACenter");
            useLimitTimeTxt = document.createTextNode(`使用期限:${useLimit}`);

            useLimitTime.appendChild(useLimitTimeTxt);
            couponBot.appendChild(useLimitTime);

            //按鈕.狀態 框
            let availStatus = document.createElement("p");
            availStatus.classList.add("w50p", "txtACenter");
            //店名
            let availStatusTxt = document.createTextNode(outputName);
            availStatus.appendChild(availStatusTxt);
            //狀態
            // let availStatusTxt = document.createTextNode(avail);
            // availStatus.appendChild(availStatusTxt);
            //隱藏SID
            let hiddenSid = document.createElement("input");
            hiddenSid.setAttribute("value", sid);
            hiddenSid.setAttribute("name", "sid");
            hiddenSid.style.visibility = "hidden";
            hiddenSid.style.display = "none";
            availStatus.appendChild(hiddenSid);

            //放入框架
            couponBot.appendChild(availStatus);
            couponTicket.appendChild(couponBot);


            //提示文字
            let alertTxt = "是否要領取優惠券?";
            if (need_point != 0) {
                alertTxt = `是否要消耗${need_point}點領取優惠券?`;
            }




            if (!gettedOrNot) {
                //領取優惠券按鈕
                let getButton = document.createElement("button");
                let getButtonTxt = document.createTextNode("領取優惠券");
                getButton.appendChild(getButtonTxt);
                // availStatus.appendChild(getButton);
                couponTicket.appendChild(getButton);

                getButton.addEventListener("click", () => {
                    if (memberPoint < need_point) {
                        alert("紅利點數不足，無法兌換!");
                    } else if (confirm(alertTxt)) {
                        let FD = new FormData();
                        FD.append("coupon_sid", sid);
                        FD.append("use_point", need_point);
                        FD.append("expire", expire);
                        fetch("Member_CouponGet_api.php", {
                                method: "POST",
                                body: FD
                            })
                            .then(r => r.json()).then(res => {
                                if (res == 1) {
                                    alert("領取成功");
                                    location.reload();
                                }
                            });
                    }
                })
            }

            //放入大框的位置
            if (gettedOrNot) {
                gettedCouponDocFrag.appendChild(couponTicket);
            } else {
                couponDocFrag.appendChild(couponTicket);
            }
        })
        couponContent.appendChild(couponDocFrag);
        gettedCouponContent.appendChild(gettedCouponDocFrag);
    })
</script>

</body>

</html>