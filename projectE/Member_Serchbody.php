<div class="sbar">
    <label id="searchTypeTxt" class="txtACenter lh40" for="IPSEARCH">請輸入商品名稱&nbsp;</label>
    <input id="IPSEARCH" class="searchbar" type="text">
</div>
<div class="sbar">
    <label for="">升序</label><input value="up" id="SORTUP" name="sort" type="radio" checked>
    <label for="">降序</label><input value="down" id="SORTDOWN" name="sort" type="radio">
    <button id="mae" disabled>上一頁</button>
    <button id="usiro">下一頁</button>

    <label for="">商品名稱</label></label><input value="searchName" id="searchProduct" name="searchOption" type="radio" checked>
    <label for="">店家SID</label><input value="searchStore" id="searchShop" name="searchOption" type="radio">
</div>

<div id="cardFrame">
</div>
<div id="btnFR">
</div>





<script>
    fetch("Member_SerchbodyRender_api.php", )
        .then(r => r.json())
        .then(ar => {
            // console.log(ar);
            let productList = JSON.parse(JSON.stringify(ar))
            // console.log(productList)
            //現在頁數
            let pagenow = 1;
            //全部頁數
            let pageall;
            //切割數量
            let cutAmount = 8;
            //頁數按鈕外框
            const FR = document.querySelector("#btnFR")
            //上下頁按鍵
            const MAE = document.querySelector("#mae");
            const USIRO = document.querySelector("#usiro");
            //輸入框、顯示框
            const searchInput = document.querySelector("#IPSEARCH");
            const showBox = document.querySelector("#cardFrame");
            //排序鍵
            const sortUpbox = document.querySelector("#SORTUP");
            const sortDownbox = document.querySelector("#SORTDOWN");
            //搜尋方式 0為商品名稱 1為店家SID
            let searchType = 0;
            //搜尋方式選擇
            const searchShop = document.querySelector("#searchShop");
            const searchProduct = document.querySelector("#searchProduct");
            //搜尋框前文字
            const searchTypeTxt = document.querySelector("#searchTypeTxt");


            //searchProduct.checked 0 商品名稱
            //searchShop.checked 1 店家SID

            Output(showBox, clipArr(arrforsort(productList, 0), cutAmount, pagenow));

            //店家
            searchShop.addEventListener("click", () => {
                let searchContent = searchInput.value;
                let sorted = 1
                if (sortUpbox.checked) {
                    sorted = 0;
                }
                Output(showBox, clipArr(arrforsort(shopSidFilt(productList, searchContent), sorted), cutAmount, pagenow));
                if (searchContent == "") {
                    Output(showBox, clipArr(arrforsort(productFilt(productList, searchContent), sorted), cutAmount, pagenow));
                }
                searchTypeTxt.innerHTML = "請輸入店家SID(1~100)&nbsp"
            })
            //商品
            searchProduct.addEventListener("click", () => {
                let searchContent = searchInput.value;
                let sorted = 1
                if (sortUpbox.checked) {
                    sorted = 0;
                }
                Output(showBox, clipArr(arrforsort(productFilt(productList, searchContent), sorted), cutAmount, pagenow));
                searchTypeTxt.innerHTML = "請輸入商品名稱&nbsp"
            })

            //排序
            sortUpbox.addEventListener("click", () => {
                let searchContent = searchInput.value;
                let sorted = 1
                if (sortUpbox.checked) {
                    sorted = 0;
                }
                if (searchProduct.checked) {
                    Output(showBox, clipArr(arrforsort(productFilt(productList, searchContent), sorted), cutAmount, pagenow));
                } else if (searchShop.checked) {
                    Output(showBox, clipArr(arrforsort(shopSidFilt(productList, searchContent), sorted), cutAmount, pagenow));
                }

            })
            sortDownbox.addEventListener("click", () => {
                let searchContent = searchInput.value;
                let sorted = 1
                if (sortUpbox.checked) {
                    sorted = 0;
                }
                if (searchProduct.checked) {
                    Output(showBox, clipArr(arrforsort(productFilt(productList, searchContent), sorted), cutAmount, pagenow));
                } else if (searchShop.checked) {
                    Output(showBox, clipArr(arrforsort(shopSidFilt(productList, searchContent), sorted), cutAmount, pagenow));
                }
            })
            //上一頁
            USIRO.addEventListener("click", () => {
                if (pagenow == 1) {
                    MAE.disabled = false;
                }
                if (pagenow == pageall - 1) {
                    USIRO.disabled = true;
                }
                pagenow++;
                let searchContent = searchInput.value;
                let sorted = 1
                if (sortUpbox.checked) {
                    sorted = 0;
                }
                if (searchProduct.checked) {
                    Output(showBox, clipArr(arrforsort(productFilt(productList, searchContent), sorted), cutAmount, pagenow));
                } else if (searchShop.checked) {
                    Output(showBox, clipArr(arrforsort(shopSidFilt(productList, searchContent), sorted), cutAmount, pagenow));
                }
                if (searchContent == "") {
                    Output(showBox, clipArr(arrforsort(productFilt(productList, searchContent), sorted), cutAmount, pagenow));
                }

            })
            //下一頁
            MAE.addEventListener("click", () => {
                if (pagenow == 2) {
                    MAE.disabled = true;
                }
                if (pagenow == pageall) {
                    USIRO.disabled = false;
                }
                pagenow--;
                let searchContent = searchInput.value;
                let sorted = 1
                if (sortUpbox.checked) {
                    sorted = 0;
                }

                if (searchProduct.checked) {
                    Output(showBox, clipArr(arrforsort(productFilt(productList, searchContent), sorted), cutAmount, pagenow));
                } else if (searchShop.checked) {
                    Output(showBox, clipArr(arrforsort(shopSidFilt(productList, searchContent), sorted), cutAmount, pagenow));
                }
                if (searchContent == "") {
                    Output(showBox, clipArr(arrforsort(productFilt(productList, searchContent), sorted), cutAmount, pagenow));
                }

            })


            searchInput.addEventListener("keyup", (evt) => {
                let searchContent = evt.target.value;

                let sorted = 1
                pagenow = 1
                if (sortUpbox.checked) {
                    sorted = 0;
                }
                if (searchContent !== "") {
                    if (searchProduct.checked) {
                        Output(showBox, clipArr(arrforsort(productFilt(productList, searchContent), sorted), cutAmount, pagenow));
                    } else if (searchShop.checked) {
                        Output(showBox, clipArr(arrforsort(shopSidFilt(productList, searchContent), sorted), cutAmount, pagenow));
                    }
                }
                if (searchContent == "") {
                    Output(showBox, clipArr(arrforsort(productFilt(productList, searchContent), sorted), cutAmount, pagenow));
                }
            })


            //設定頁數 (按鈕外框,資料全長,切割長度)
            function SetPageButton(btnFrameOP, fullArrayLength, cutLength) {
                while (btnFrameOP.hasChildNodes()) {
                    btnFrameOP.removeChild(btnFrameOP.lastChild);
                }
                let page = Math.ceil(fullArrayLength / cutLength);

                let docFrag = document.createDocumentFragment();

                for (let i = 0; i < page; i++) {
                    let pageNumber = document.createElement("div");
                    pageNumber.classList.add("btnpage");
                    let num = document.createTextNode(`${i + 1}`);
                    pageNumber.appendChild(num)
                    docFrag.appendChild(pageNumber);
                }
                btnFrameOP.appendChild(docFrag);

                if (btnFrameOP.hasChildNodes()) {
                    btnFrameOP.childNodes[pagenow - 1].setAttribute("style", "color: red")
                }
                //&&pagenow>5&&pagenow<page-5
                // console.log(btnFrameOP.childNodes.length)
                //console.log()
                if (btnFrameOP.childNodes.length >= 10) {
                    if (pagenow >= 5 && pagenow <= page - 4) {
                        for (let i = 0; i < page; i++) {
                            if (i + 1 < pagenow - 4 || i + 1 > pagenow + 4)
                                btnFrameOP.childNodes[i].style.display = "none";
                        }
                    } else if (pagenow < 5) {
                        for (let i = 9; i < page; i++) {
                            btnFrameOP.childNodes[i].style.display = "none";
                        }
                    } else if (pagenow > page - 4) {
                        for (let i = 0; i < page - 9; i++) {
                            btnFrameOP.childNodes[i].style.display = "none";
                        }
                    }
                }



                let pages = document.querySelectorAll(".btnpage")
                for (let i = 0; i < pages.length; i++) {
                    pages[i].addEventListener("click", () => {
                        pagenow = i + 1;
                        let searchContent = searchInput.value;
                        let sorted = 1
                        if (sortUpbox.checked) {
                            sorted = 0;
                        }
                        if (searchProduct.checked) {
                            Output(showBox, clipArr(arrforsort(productFilt(productList, searchContent), sorted), cutAmount, pagenow));
                        } else if (searchShop.checked) {
                            Output(showBox, clipArr(arrforsort(shopSidFilt(productList, searchContent), sorted), cutAmount, pagenow));
                        }
                        if (searchContent == "") {
                            Output(showBox, clipArr(arrforsort(productFilt(productList, searchContent), sorted), cutAmount, pagenow));
                        }

                    })
                }
            }


            //切割陣列(陣列,切割數量,第幾頁) 輸出陣列
            function clipArr(arrin, amount, page) {
                let START = (page - 1) * amount;
                let END = page * amount;
                let arrcliped = arrin.slice(START, END);

                pageall = Math.ceil(arrin.length / amount)
                SetPageButton(FR, arrin.length, amount);
                return arrcliped;

            }

            //搜尋 (要搜尋的文字，搜尋對象資料，輸出框，排序方式)
            function search(text, arr, frame, sort) {
                Output(frame, arrforsort(productFilt(arr, text), sort));
            }




            //篩選 輸入(陣列，要篩選的文字) 回傳陣列 移用時要改篩選對象  //shopSidFilt
            function shopSidFilt(arr, txt) {
                let arrout = arr.filter((value, index, array) => {
                    if (value.shop_sid == txt) {
                        return value;
                    }
                })
                return arrout;
            }

            //原版   //篩選 輸入(陣列，要篩選的文字) 回傳陣列 移用時要改篩選對象  //productFilt
            function productFilt(arr, txt) {
                let arrout = arr.filter((value, index, array) => {
                    if (value.name.indexOf(txt) !== -1) {
                        return value.name;
                    }
                })
                return arrout;
            }





            //排序(陣列，排序方式0升序，1降序)  回傳陣列
            function arrforsort(arrin, sort) {
                let arrsorted = arrin.sort((a, b) => {
                    if (sort === 1) {
                        return b.price - a.price; //降序
                    } else {
                        return a.price - b.price; //升序
                    }
                })
                return arrsorted;
            }

            //顯示結果  (輸出框,要輸出的陣列)
            function Output(frameOP, arrayOP) {
                if (pagenow == 1) {
                    MAE.disabled = true;
                } else {
                    MAE.disabled = false;
                }
                if (pagenow == pageall) {
                    USIRO.disabled = true;
                } else {
                    USIRO.disabled = false;
                }
                while (frameOP.hasChildNodes()) {
                    frameOP.removeChild(frameOP.lastChild);
                }
                let docFrag = document.createDocumentFragment();
                //console.log(arrayOP)
                arrayOP.forEach(data => {
                    let {
                        name,
                        price,
                        src,
                        sid,
                        shop_sid
                    } = data;
                    let cardcol = document.createElement("div");
                    cardcol.classList.add("col");
                    let cardM = document.createElement("div");
                    cardM.classList.add("cardtest");
                    let cardH3 = document.createElement("h3");
                    let contentIn = document.createTextNode(name);
                    let cardp = document.createElement("p");
                    let contentPrize = document.createTextNode(price);
                    cardH3.appendChild(contentIn);
                    cardp.appendChild(contentPrize);
                    cardM.appendChild(cardH3);
                    if (src !== "") {
                        let ImgFR = document.createElement("div");
                        ImgFR.classList.add("imgFR");
                        let Img = document.createElement("img");
                        Img.setAttribute("src", `${src}`);
                        ImgFR.appendChild(Img);
                        cardM.appendChild(ImgFR);
                    }
                    cardM.appendChild(cardp);
                    let btnBox = document.createElement("form");
                    btnBox.setAttribute("name", `form${sid}`);
                    btnBox.classList.add("productform")
                    //產品SID隱藏框
                    let input01 = document.createElement("input")
                    input01.setAttribute("value", sid);
                    input01.setAttribute("name", "sid");
                    input01.style.visibility = "hidden";
                    input01.style.display = "none";
                    //店家SID隱藏框
                    let input02 = document.createElement("input")
                    input02.setAttribute("value", shop_sid);
                    input02.setAttribute("name", "shop_sid");
                    input02.style.visibility = "hidden";
                    input02.style.display = "none";
                    //加號按鈕
                    let cartBtn1 = document.createElement("button")
                    let contentInBTN1 = document.createTextNode("＋");
                    cartBtn1.setAttribute("name", `form${sid}`);
                    cartBtn1.appendChild(contentInBTN1);
                    cartBtn1.addEventListener("click", (evt) => {
                        evt.preventDefault();
                        cartset(evt);
                    })
                    //減號按鈕
                    let cartBtn2 = document.createElement("button")
                    let contentInBTN2 = document.createTextNode("－");
                    cartBtn2.setAttribute("name", `form${sid}`);
                    cartBtn1.appendChild(contentInBTN1);
                    cartBtn2.addEventListener("click", (evt) => {
                        evt.preventDefault();
                        cartCut(evt);
                    })
                    cartBtn2.appendChild(contentInBTN2);
                    btnBox.appendChild(cartBtn1);
                    btnBox.appendChild(cartBtn2);
                    btnBox.appendChild(input01);
                    btnBox.appendChild(input02);
                    cardM.appendChild(btnBox);
                    cardcol.appendChild(cardM);
                    docFrag.appendChild(cardcol);
                })
                frameOP.appendChild(docFrag);
            }
        })
    //購物車計數，在NAV
    let cartCountBox = document.querySelector("#cartcount")
    //購物車點選API
    async function cartset(evt) {
        let FM = evt.target.parentNode
        let FD = new FormData(FM);
        FD.append("state", 0)
        fetch('Cart_MonoSet_api.php', {
                method: 'POST',
                body: FD
            })
            .then(r => r.json())
            .then(
                res => {
                    cartCountBox.innerText = res;
                }
            )
    }
    async function cartCut(evt) {
        let FM = evt.target.parentNode
        let FD = new FormData(FM);
        FD.append("state", 1)
        fetch('Cart_MonoSet_api.php', {
                method: 'POST',
                body: FD
            })
            .then(r => r.json())
            .then(
                res => {
                    cartCountBox.innerText = res;
                }
            )
    }
</script>
</body>

</html>