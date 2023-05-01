<?php require __DIR__ . './Connect_DataBase.php'; ?>

<?php require __DIR__ . './HeadCssSetting.php'; ?>

<?php require __DIR__ . './CssSetting_YU.php'; ?>

<?php require __DIR__ . './Member_nav.php'; ?>

<h2 class="txtACenter orderTitleh2">訂單確認</h2>
<div id="payFrame" class="orderAllFrame">

</div>


<div class="orderAllFrame">


    <div class="orderframe">
        <!-- 訂單概略 -->
        <div class="orderInfo txtACenter">
            <p id="payShopName" class="shopName">
                OO義大利麵
            </p>
            <p id="waittingTime"></p>
        </div>
        <!-- 訂單明細 -->
        <div class="paydetail" id="odFrame">
            <!-- 明細左半 -->
            <div id="payProduct" class="orderProductFrame">
            </div>
            <!-- 明細右半 -->
            <div class="orderProductInfo">
                <label for="payMemo">備註</label><br>
                <textarea cols="40" rows="5" id="payMemo" name="payMemo"></textarea>
                <div>
                    <p>總金額</p>
                    <p id="payTotalPrice"></p>
                </div>
                <div class="priceCut">
                    <p >
                        優惠
                    </p>
                    <div id="priceCutTitle"></div>
                    <select name="priceCutOption" id="priceCut">
                        <option value="0" selected>無</option>
                    </select>
                    <p>折扣後金額</p>
                    <p id="cuttedPrice"></p>
                </div>

                <div>
                    <button id="finalPay">結帳</button>
                </div>
            </div>
        </div>
    </div>

</div>




<script>
    //商品明細顯示框
    let payFrame = document.querySelector("#payProduct");
    //商店名稱
    let payShopName = document.querySelector("#payShopName");
    //總金額顯示框
    let payTotalPrice = document.querySelector("#payTotalPrice");
    //優惠券選項框
    let priceCut = document.querySelector("#priceCut");
    //折扣後金額顯示框
    let cuttedPrice = document.querySelector("#cuttedPrice");
    //隱藏優惠券SID框
    let priceCutTitle = document.querySelector("#priceCutTitle");
    //結帳按鈕新
    let finalPayBTN = document.querySelector("#finalPay");
    //備註
    let payMemo = document.querySelector("#payMemo");
    //總金額顯示
    let tsum = 0;
    //等待時間框
    let waittingTime = document.querySelector("#waittingTime");
    fetch("Member_PayRender_api.php").then(r => r.json()).then(res => {
        // console.log(res.coupon);
        //讀出購物車
        let docFrag = document.createDocumentFragment();
        payShopName.innerText = res.cart[0].name;
        waittingTime.innerText = res.cart[0].wait_time;


        res.cart.forEach(element => {
            let {
                Sid,
                amount,
                name,
                price,
                product_name,
                shop_sid,
                sid,
                wait_time
            } = element;
            //商品總框
            let orderProduct = document.createElement("div");
            orderProduct.classList.add("orderProduct");
            //產品名
            let productName = document.createElement("h3");
            let productNameIntxt = document.createTextNode(product_name);
            productName.appendChild(productNameIntxt);
            orderProduct.appendChild(productName);
            //單價
            let orderPPrice = document.createElement("div");
            orderPPrice.classList.add("orderPPrice");
            orderPPrice.classList.add("orderNum");
            //單價內容
            //標題
            let orderPPricep1 = document.createElement("p");
            let orderPPricep1txt = document.createTextNode("價格");
            orderPPricep1.appendChild(orderPPricep1txt);
            //內文
            let orderPPricep2 = document.createElement("p");
            let orderPPricep2txt = document.createTextNode(price);
            orderPPricep2.appendChild(orderPPricep2txt);
            orderPPrice.appendChild(orderPPricep1);
            orderPPrice.appendChild(orderPPricep2);
            orderProduct.appendChild(orderPPrice);
            //數量
            let orderPAmount = document.createElement("div");
            orderPAmount.classList.add("orderPAmount");
            orderPAmount.classList.add("orderNum");
            //數量內容
            //標題
            let orderPAmountp1 = document.createElement("p");
            let orderPAmountp1txt = document.createTextNode("數量");
            orderPAmountp1.appendChild(orderPAmountp1txt);
            //內文
            let orderPAmountp2 = document.createElement("p")
            let orderPAmountp2txt = document.createTextNode(amount);
            orderPAmountp2.appendChild(orderPAmountp2txt);
            orderPAmount.appendChild(orderPAmountp1);
            orderPAmount.appendChild(orderPAmountp2);
            orderProduct.appendChild(orderPAmount);
            //總價
            let orderPTotalprice = document.createElement("div");
            orderPTotalprice.classList.add("orderPTotalprice");
            orderPTotalprice.classList.add("orderNum");
            //總價內容
            //標題
            let orderPTotalpricep1 = document.createElement("p");
            let orderPTotalpricep1txt = document.createTextNode("總價");
            orderPTotalpricep1.appendChild(orderPTotalpricep1txt);
            //內文
            let orderPTotalpricep2 = document.createElement("p");
            let orderPTotalpricep2txt = document.createTextNode(amount * price);
            orderPTotalpricep2.appendChild(orderPTotalpricep2txt);
            orderPTotalprice.appendChild(orderPTotalpricep1);
            orderPTotalprice.appendChild(orderPTotalpricep2);
            orderProduct.appendChild(orderPTotalprice);
            docFrag.appendChild(orderProduct);

            tsum += amount * price;
        });
        payFrame.appendChild(docFrag)
        payTotalPrice.innerText = tsum;
        cuttedPrice.innerText = tsum;

        let optionFrag = document.createDocumentFragment();

        let hiddensid = document.createDocumentFragment();
        //讀出優惠券
        res.coupon.forEach(value => {
            let {
                coupon_sid,
                coupon_name,
                sale_detail,
                shop_sid,
                sid,
                expire,
                use_range
            } = value;
            let Dday = new Date(expire);
            // console.log(Dday);
            let Dnow = new Date();
            if (Dday > Dnow && use_range<=tsum) {
                //選項
                let options = document.createElement("option");
                let inContent = document.createTextNode(coupon_name);
                options.value = sale_detail;
                options.appendChild(inContent)
                optionFrag.appendChild(options);
                //隱藏框
                let hinput = document.createElement("input")
                hinput.setAttribute("value", sid);
                hinput.style.visibility = "hidden";
                hinput.style.display = "none";
                hiddensid.appendChild(hinput);

            }
        })

        priceCut.appendChild(optionFrag);
        priceCutTitle.appendChild(hiddensid);
        // console.log(priceCutTitle.childNodes);
    })

    //priceCutTitle 隱藏框
    //cuttedPrice 折扣後金額輸出框
    priceCut.addEventListener("change", () => {
        if (priceCut.selectedIndex != 0) {
            
            //要記得減1
            cuttedPrice.innerText = tsum - priceCut[priceCut.selectedIndex].value;
            //優惠券SID
            console.log(priceCutTitle.childNodes[priceCut.selectedIndex - 1].value);

        } else {
            cuttedPrice.innerText = tsum;
        }
    })
    //結帳按鈕
    finalPayBTN.addEventListener("click", (evt) => {
        evt.preventDefault();
        let wtime = waittingTime.innerText;
        let payTxt = "是否要結帳?";
        if( wtime>= 30){
            payTxt = `等待時間為${wtime}分鐘，是否確定下訂?`
        }
        
        if (!window.confirm(payTxt)) {
            evt.preventDefault();
            return;
        }
        cartPayF();
    })

    function cartPayF() {
        let totalPrize = tsum;
        let cuttedPriceSend = cuttedPrice.innerText;
        let csid =0
        let memoSend = payMemo.value;
        if(priceCut.selectedIndex != 0){
        csid = priceCutTitle.childNodes[priceCut.selectedIndex - 1].value}

        let FD = new FormData();
        FD.append("price", totalPrize);
        FD.append("cuttedprice", cuttedPriceSend);
        FD.append("coupon_sid", csid)
        FD.append("memos", memoSend)

        fetch("Member_Pay_api.php", {

            method: 'POST',
            body: FD,


        }).then(r => r.json()).then(
            (res) => {

                alert("付款成功");
                location.href = "Member_Order.php";

            })
    }
    // location.href = "index.php";



    //測試用
    // document.querySelector("#JStest").addEventListener("click",()=>{
    //     console.log(priceCut.selectedOptions[0].value)

    // })
</script>