<style>
        /* option{
            text-align: center;
        } */
        body {
            position: relative;
        }

        .disf {
            display: flex;
        }

        .disb {
            display: block;
        }

        .disn {
            display: none;
        }

        .sbar {
            width: 80%;
            display: flex;
            justify-content: center;
            margin: 10px auto;

        }

        #IPSEARCH {
            border-radius: 10px;
            padding: 0 5px;
            width: 340px;
            height: 40px;
            line-height: 40px;
            font-size: 36px;
        }

        img {
            width: 100%;
        }

        #cardFrame {
            width: 60%;
            display: flex;
            background-color: #ccc;
            justify-content: flex-start;
            flex-wrap: wrap;
            margin: 0 auto;
        }

        .col {
            width: 25%;
            padding: 10px 10px;


        }

        .cardtest {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            border-radius: 10px;
            background-color: #3c3;
            aspect-ratio: 1;
            justify-content: space-around;
            padding: 0 3%;
        }

        .cardtest .imgFR {
            height: 70%;
            width: 80%;
        }

        h3 {
            font-size: 24px;
            line-height: 30px;
            text-align: center;
        }

        p {
            text-align: center;
            /* width: 100%; */
            word-wrap: break-word;
        }

        #btnFR {
            display: flex;
            width: 500px;
            justify-content: space-around;
            margin: 20px auto;
        }

        .btnpage {
            cursor: pointer;
            border: 1px solid red;
            width: 20px;
            height: 20px;
            text-align: center;
        }



        fieldset {
            width: fit-content;
            border: 3px dotted aqua;
            border-radius: 10px;
            margin: 20px auto;
        }

        legend {
            border: 3px dotted aqua;
            border-radius: 10px;
            padding: 5px 20px;
        }

        .st {
            width: 400px;
            border-bottom: 3px double #F0F;
            padding-bottom: 10px;
            margin: 20px;

        }

        .title {
            width: 100px;
            float: left;
            text-align: right;
            padding-right: 10px;
        }

        textarea {
            border-width: 2px;
        }

        .btn {
            text-align: center;
        }

        .cartListFrame {
            width: 80%;
            margin: 2% auto;
        }

        .cardrow {
            background-color: #ecc;
            height: 150px;
            display: flex;
            padding: 2%;
        }

        .productimg {
            width: 20%;
            border: 1px red solid;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .productName {
            width: 45%;
            border: 1px red solid;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 28px;
        }

        .controlPlate {
            border: 1px red solid;
            width: 15%;
            display: flex;
            align-items: center;
            justify-content: space-around;
        }

        .price {
            width: 10%;
            border: 1px red solid;
            justify-content: center;
            display: flex;
            align-items: center;
        }

        /* .price::before{
            content:'單價:'
        } */
        .totalprice {
            display: flex;
            border: 1px red solid;
            align-items: center;
            width: 10%;
            justify-content: space-around;
        }

        .cartForm {
            display: flex;
            align-items: center;
            justify-content: space-around;
            flex-wrap: wrap;
            line-height: 50px;

        }

        #sum {
            width: 10%;
            height: 20%;
            background-color: #cfc;
            position: fixed;
            right: 0;
            top: 40%;
            flex-direction: column;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        .orderAllFrame {
            /* background-color: #cfc; */
            width: 90%;
            margin: 0 auto;
        }

        .orderframe {
            background-color: #ccc;
            width: 100%;
            margin: 5px auto;
            border-radius: 20px;
            text-align: center;
            overflow: hidden;
        }

        .orderInfo {
            display: flex;
            /* justify-content: space-between; */
            padding: 0 2%;
            height: 50px;
            align-items: center;
            text-align: center;
        }

        .orderInfo>* {
            width: 20%;
        }

        .txtACenter {
            text-align: center;
        }


        .orderD {
            cursor: pointer;
            color: #00F;
        }

        .orderdetail {
            /* height: 600px; */
            transition: 1s;
            background-color: #eee;
            /* padding: 10px; */
            display: none;
        }

        .paydetail {
            background-color: #eee;
            display: flex;
        }

        .orderProductFrame {
            width: 65%;
            padding: 10px;
            background-color: #cff;
        }

        .orderProductInfo {
            width: 35%;
            background-color: #cfc;
            /* height: 100%; */
            padding: 10px;
        }

        .orderProductInfo>div {
            margin: 20px 0;
        }

        .orderProduct {
            width: 100%;
            background-color: #fcf;
            margin: 1% auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-radius: 10px;
        }

        .productImg {
            width: 20%;
            line-height: 0;
        }

        .orderProduct h3 {
            font-size: 20px;
        }

        .opintxt {
            height: 100%;
            display: flex;
            flex-direction: column;
            line-height: 24px;
        }

        .opinfotxt {
            display: flex;
            flex-direction: column;
            line-height: 30px;
        }

        .orderPS {
            text-align: justify;
        }

        .orderTitleh2 {
            font-size: 28px;
            margin: 10px 0;
            font-weight: 700;

        }

        .storeControlOrderBTN {
            margin: 5px;
        }

        .orderNum {
            width: 10%;
        }

        .w20p {
            width: 20%;
        }

        .w30p {
            width: 30%;
        }

        .w25p {
            width: 25%;
        }

        .w40p {
            width: 40%;
        }
        .w80p{
            width: 80%;
        }

        .lh40 {
            line-height: 40px;
        }

        .setCenter {
            margin: 0 auto;
        }

        .fs30 {
            font-size: 30px;
        }

        .fs36 {
            font-size: 36px;
        }

        .txtEnd {
            text-align: end;
        }

        .w300 {
            width: 300px;
        }

        .pad10 {
            padding: 10px;
        }

        .borderR1 {
            border: 1px red solid;
        }

        .fw-w {
            flex-wrap: wrap;
        }

        .w50p {
            width: 50%;
        }

        .f-jcC {
            justify-content: center;
        }

        .f-jcsa {
            justify-content: space-around;
        }

        .w350 {
            width: 350px;
        }

        .couponForm {
            position: fixed;
            width: 400px;
            height: 200px;
            background-color: #FFF;
            left: calc(50% - 200px);
            top: calc(50% - 100px);
            z-index: 100;
            display: none;
        }

        .grayBack {
            background-color: #5555;
            width: 100%;
            position: fixed;
            height: 100vh;
            z-index: 99;
            top: 0;
            display: none;
        }

        .aic {
            align-items: center;
        }

        .coupon10 {
            background-color: silver;
        }

        .coupon50 {
            background-color: gold;
        }

        .coupon100 {
            background-color: #C33;
        }

        .coupon200 {
            background-color: #3c3;
        }

        .coupon500 {
            background-color: #550;
        }

        .coupon1000 {
            background-color: #55e;
        }

        .coupon2000 {
            background-color: #c3c;
        }

        #couponPoint::before {
            content: "紅利點數：";
        }

        .choosePTotal::before {
            content: "商品總數：";
        }

        .cursor_pointer {
            cursor: pointer;
        }
        .mr10{
            margin-left:10px ;
            margin-right: 10px;
        }
        .h80{
            height: 80px;
        }
        .fd-c{
            flex-direction: column;
        }
        #waittingTime::before{
            content: "等待時間：";
        }        
        #waittingTime::after{
            content: "分鐘";
        }
    </style>

