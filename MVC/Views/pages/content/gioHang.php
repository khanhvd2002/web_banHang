<?php
if (!isset($_SESSION['user'])) {
    header('Location: /BTL_WEB/auth');
}
?>

<style>
    .wrapOrder {
        margin: 16px 16px;
    }

    .container_Item {
        border: 1px solid;
        display: flex;
        flex-direction: row;
        max-width: 100%;
        max-height: 100px;
        min-height: 100px;
        align-items: center;
        justify-content: space-around;

    }

    .container_Item:first-child {
        border-top-left-radius: 6px;
        border-top-right-radius: 6px;

    }

    .container_Item:last-child {
        border-bottom-left-radius: 6px;
        border-bottom-right-radius: 6px;
    }

    .imgItem {
        max-height: 80px;
        max-width: 15%;
        min-width: 15%;
        margin-right: 5%;
    }

    .tenSP {
        min-width: 20%;
        max-width: 20%;
    }

    .giaSp {
        min-width: 10%;
        max-width: 10%;
    }

    .soLuong {
        min-width: 10%;
        max-width: 10%;
    }

    .SLkho {
        min-width: 10%;
        max-width: 10%;
    }

    .thanhTien {
        min-width: 10%;
        max-width: 10%;
    }

    .check_box {
        margin-left: 20px;
        max-width: 5%;
        min-width: 5%;
    }

    .btn_huyOrder {
        flex-grow: 1;
        cursor: pointer;
    }

    .header_content {
        text-align: center;
        font-size: x-large;
        font-family: auto;
        margin-top: 32px;
        margin-bottom: 26px;
        color: brown;
        color: brown;
    }

    .lablecs {
        font-size: 12px;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        font-weight: bold;
        color: #f27474;
    }

    .datHang {
        margin: 18px;
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .lablecss {
        font-size: 14px;
        font-weight: 600;
    }

    .TongMH {
        font-size: large;
    }

    #ThanhToan {
        display: flex;
        justify-content: end;
        font-size: 16px;
        font-family: none;
        color: #4735dc;
        font-weight: bolder;
        display: none;

    }

    .txt_center {
        text-align: center;
    }

    .btn_huy_item {
        transform: translateX(50%);
    }
</style>
<div class="wrap_container">
    <div class="header_content">
        DANH SÁCH SẢN PHẨM ORDER
        <div class="TongMH">

            <?php if (mysqli_num_rows($data['dataOrder']) == 0) : ?>
                <span class="badge badge-primary">Không có sản phẩm để thanh toán</span>
                <br>
                <span class="badge badge-primary">Mua sắm thôi nào</span>
            <?php endif ?>

            <?php if (mysqli_num_rows($data['dataOrder']) > 0) : ?>
                <span class="badge badge-primary">Tổng có <span style="font-weight: bolder; font-size: 16px;"><?php echo mysqli_num_rows($data['dataOrder']) ?></span> Sản phẩm đang chờ Thanh Toán</span>
            <?php endif ?>
        </div>
    </div>
    <?php if (mysqli_num_rows($data['dataOrder']) > 0) : ?>
    <div class="datHang">
        <form action="http://localhost/btl_web/order/thanhToan" method="post">
            <input id="arrOrder" name="strOrder" value="111" style="display: none;"></input>
            <button type="submit" onclick="ThanhToanCheck()" name="btnOrder" class="btn btn-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                </svg>
                THANH TOÁN <span id="soLuongCheck"></span>
            </button>
        </form>
        <?php endif ?>
    </div>
    <?php if (mysqli_num_rows($data['dataOrder']) > 0) : ?>
        <div class="wrapOrder">
            <div id="ThanhToan"><span id="tongThanhToan"></span></div>
            <div class="container_Item">
                <div class="check_box">
                    <input onchange="checkAllOrder(this)" type="checkbox" class="checkAllOrder" name="order">
                </div>
                <div class="imgItem lablecs">HÌNH ẢNH SP</div>
                <div class="tenSP lablecs">TÊN SẢN PHẨM</div>
                <div class="giaSp lablecs txt_center">GIÁ BÁN</div>
                <div class="soLuong lablecs txt_center">SỐ LƯỢNG MUA</div>
                <div class="SLkho lablecs txt_center">SỐ LƯỢNG KHO</div>
                <div class="thanhTien lablecs txt_center">THÀNH TIỀN</div>
                <div class="btn_huyOrder lablecs txt_center">HỦY ORDER</div>
            </div>
            <?php while ($orderRow = mysqli_fetch_assoc($data['dataOrder'])) : ?>
                <div class="container_Item">
                    <div class="check_box">
                        <input id="<?php echo $orderRow['productID'] ?>" onchange="checkOrder()" type="checkbox" class="checkOrder" value="<?php echo ($orderRow['TongSL'] * $orderRow['giaSanPham']) ?>" name="order">
                    </div>
                    <img class="imgItem lablecss" src="http://localhost/btl_web/public/img/LOGO.gif" alt="">
                    <div class="tenSP lablecss"><?php echo $orderRow['tenSanPham'] ?></div>
                    <div class="giaSp lablecss  txt_center"><?php echo $orderRow['giaSanPham'] ?></div>
                    <div class="soLuong lablecss txt_center"><?php echo $orderRow['TongSL'] ?></div>
                    <div class="SLkho lablecss txt_center"><?php echo $orderRow['soLuongKho'] ?></div>
                    <span class="thanhTien lablecss txt_center"><?php echo ($orderRow['TongSL'] * $orderRow['giaSanPham'])  ?></span>
                    <div class="btn_huyOrder">
                        <a href="http://localhost/btl_web/order/deteOrder/<?php echo $orderRow['productID'] ?>">
                            <button type="button" class="btn btn-danger btn_huy_item">
                                HỦY ĐẶT
                            </button>
                        </a>

                    </div>
                </div>
            <?php endwhile ?>
        </div>
    <?php endif ?>



</div>
<script>
    var p1 = "success";
</script>


<script>
    function ThanhToanCheck() {
        const arrThanhToan = [];
        var inputElems = document.getElementsByClassName('checkOrder');
        for (var i = 0; i < inputElems.length; i++) {
            if (inputElems[i].checked == true) {
                arrThanhToan.push(inputElems[i].id);
            }
        }
        var str = arrThanhToan.join('-');
        console.log(str, "ssss")
        document.getElementById('arrOrder').setAttribute('value', str);

    }

</script>