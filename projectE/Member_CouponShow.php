<?php require __DIR__ . './Connect_DataBase.php'; ?>

<?php require __DIR__ . './HeadCssSetting.php'; ?>

<?php require __DIR__ . './CssSetting_YU.php'; ?>

<?php require __DIR__ . './Member_nav.php'; ?>

<div>
    <h2 class="txtACenter fs30">可使用的優惠券</h2>
    <div id="couponContent" class="disf fw-w f-jcsa">
        <!-- <div class="w300 pad10 borderR1">
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
        </div> -->
    </div>
</div>
<div>
    <h2 class="txtACenter fs30">
        已使用優惠券，只顯示近30天的資料
    </h2>
    <div id="usedCouponContent" class="disf fw-w f-jcsa">

    </div>
</div>

<div>
    <h2 class="txtACenter fs30">
        已過期優惠券，只顯示近30天的資料
    </h2>
    <div id="timeoutCouponContent" class="disf fw-w f-jcsa">

    </div>
</div>




<script>
    //

    fetch("Member_islogin_api.php").then(r => r.json()).then(res => {
        if (res == 0) {
            alert("請先登入");
            location.href = "Member_login.php";
        }
    })


    //優惠券顯示框
    let couponContent = document.querySelector("#couponContent");
    //用過的優惠券顯示框
    let usedCouponContent = document.querySelector("#usedCouponContent");
    //過期的優惠券顯示框
    let timeoutCouponContent = document.querySelector("#timeoutCouponContent");



    //讀出資料  Read
    fetch("Member_CouponShowRender_api.php").then(r => r.json()).then(res => {
        // console.log(res);
        if (res.length != 0) {
            while (couponContent.hasChildNodes()) {
                couponContent.removeChild(couponContent.lastChild);
            }
        }


        let docFragCoupon = document.createDocumentFragment();

        let docFragUsedCoupon = document.createDocumentFragment();

        let docFragTimeoutCoupon = document.createDocumentFragment();

        res.reverse().forEach(value => {
            let {
                get_time, //領取時間
                coupon_name, //名稱
                expire, //使用期限
                used_time, //使用的時間
                sale_detail, //折扣金額
                shop_sid, //商店SID
                coupon_sid, //優惠券詳細內容SID
                use_range, //使用條件
                is_used, //是否使用過
                name, //店家名稱
                sid //這張優惠券的SID
            } = value;

            //時間格式變換
            let useLimit = expire.substr(0, 10);
            let useTimeOP;


            if (is_used == 1) {
                useTimeOP = used_time.substr(0, 10);
            }


            //全站使用變換
            let outputName = name;
            if (shop_sid == 101) {
                outputName = "全站通用";
            }
            // console.log(useLimit);


            //時間計算
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

            let day30ToSeconds = 86400 * 30 * 1000;
            let dnow = `${YY}-${MM}-${DD} 23:59:59`;
            // console.log(dnow);
            let today = new Date(dnow).getTime();
            // console.log(today);
            let todayM30 = today - day30ToSeconds;
            // console.log(todayM30);

            //expire, //使用期限
            //used_time, //使用的時間
            //is_used, //是否使用過
            let usedTime = new Date(used_time).getTime();
            let limitTime = new Date(expire).getTime();



            //判斷是否繼續
            let continueOrNot = 0;
            //B   已使用、    使用期限不管        使用時間三十日內
            if (is_used == 1 && today - usedTime < day30ToSeconds) {
                // console.log("已使用並在30日內");
                continueOrNot = 1;
            }
            //C. 未使用  、 使用期限已過      無使用期間
            else if (is_used == 0 && today - limitTime > 0 && today - limitTime < day30ToSeconds) {
                // console.log("已過期並在30日內");
                continueOrNot = 1;
            }
            //A. 未使用 、  使用期限未過期         無使用期間   
            else if (is_used == 0 && today - limitTime <= 0) {
                // console.log("正常");
                continueOrNot = 1;
            }
            //D.  已過期或使用並超過30日  不顯示
            // else {
            //     console.log("已使用或已過期並超過30日")
            // }

            //   is_used    expire              used_time
            //A. 未使用 、  使用期限未過期         無使用期間                 docFragCoupon
            //     0             +0                 null
            //B. 已使用、    使用期限不管        使用時間三十日內     docFragUsedCoupon
            //     1            X                   -30
            //C. 未使用  、 使用期限已過      無使用期間    docFragTimeoutCoupon
            //    0            -30             null

            if (continueOrNot == 1) {

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




                couponTicket.classList.add("w350", "pad10", "borderR1", iro);


                //上半   couponTop
                let couponTop = document.createElement("div");
                couponTop.classList.add("disf");

                //名稱   couponName
                let couponName = document.createElement("p");
                couponName.classList.add("w50p", "txtACenter");
                couponNameTxt = document.createTextNode(coupon_name);
                couponName.appendChild(couponNameTxt);
                couponTop.appendChild(couponName);
                // //使用日期  couponUseDay
                if (is_used == 1) {
                    let couponUseDay = document.createElement("p");
                    couponUseDay.classList.add("w50p", "txtACenter");
                    couponUseDayTxt = document.createTextNode(`使用日期:${useTimeOP}`);
                    couponUseDay.appendChild(couponUseDayTxt);
                    couponTop.appendChild(couponUseDay);
                } else if (is_used == 0 && today - limitTime <= 0) {
                    let couponLimitTime = document.createElement("p");
                    couponLimitTime.classList.add("w50p", "txtACenter");
                    couponLimitTimeTxt = document.createTextNode(`使用限制:$${use_range}`);
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
                if (is_used == 0) {
                    useLimitTimeTxt = document.createTextNode(`使用期限:${useLimit}`);
                    useLimitTime.appendChild(useLimitTimeTxt);
                }

                couponBot.appendChild(useLimitTime);

                //按鈕.狀態 框
                //店名
                let availStatus = document.createElement("p");
                availStatus.classList.add("w50p", "txtACenter");
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

                //A. 未使用 、  使用期限未過期         無使用期間   
                if (is_used == 0 && today - limitTime <= 0) {
                    // console.log("正常");
                    docFragCoupon.appendChild(couponTicket);
                }
                //B   已使用、    使用期限不管        使用時間三十日內
                else if (is_used == 1 && today - usedTime < day30ToSeconds) {
                    // console.log("已使用並在30日內");
                    docFragUsedCoupon.appendChild(couponTicket);
                }
                //C. 未使用  、 使用期限已過      無使用期間
                else if (is_used == 0 && today - limitTime > 0 && today - limitTime < day30ToSeconds) {
                    // console.log("已過期並在30日內");
                    docFragTimeoutCoupon.appendChild(couponTicket);
                }

            }
        })
        couponContent.appendChild(docFragCoupon);
        usedCouponContent.appendChild(docFragUsedCoupon);
        timeoutCouponContent.appendChild(docFragTimeoutCoupon);
    })
</script>

</body>

</html>