$(function() {
    $hidenitem = $(".hidenitem");
    $itemproduct = $(".item-product");
    $itemproduct.hover(function() {
        $(this).children(".hidenitem").show(100);
    }, function() {
        $hidenitem.hide(500);
    })
})

$(function() {
    $updatecart = $(".updatecart"); //lay class updatecart -> tạo sự kiện onclick
    $updatecart.click(function(e) { //nếu click vào class đó
        e.preventDefault(); //để nó không load lại trang
        $qty = $(this).parents("tr").find(".qty").val(); //lấy số lượng khi user muốn cập nhật -> từ thẻ id "tbody" -> rồi tìm tới #qty

        $key = $(this).attr("data-key"); //lấy key của đơn hangf cần sửa (số lượng)
        $.ajax({ //dùng ajax gửi snags trang cập nhật giỏ hàng .php
            url: 'cap-nhat-gio-hang.php',
            type: 'GET', //method => lấy dữ liệu
            data: {
                'qty': $qty,
                'key': $key
            }, //file cập nhật dữ liệu là qty và key
            success: function(data) {

                if (data == 1) { //if value return == 1 (in cap-nhat-gio-hang.php)
                    alert(" Cập nhật giỏ hàng thành công. ");
                    location.href = 'gio-hang.php';
                }
            }
        });
    })
})
//use to rollback
$(window).scroll(function() {
    if ($(this).scrollTop() >= 200) { // If page is scrolled more than 200px
        $('#return-to-top').fadeIn(200); // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200); // Else fade out the arrow
    }
});

$('#return-to-top').click(function() { // When arrow is clicked
    $('body,html').animate({
        scrollTop: 0 // Scroll to top of body
    }, 500);
});

$(document).ready(function(){
    $('.owl-carousel').owlCarousel({
        items:4,
        loop:true,
        margin:10,
        // dots:false,
        autoplay:true,
        autoplayTimeout:2000,
        autoplayHoverPause:true
    });
});

// send email front end
$(document).ready(function () {
    $('.flip').click(function () {
      $('.cont-flip').toggleClass('flipped');
      return false;
    });
  });

$(".step").click(function () {
    $(this).addClass("active").prevAll().addClass("active");
    $(this).nextAll().removeClass("active");
});

function showForm() {
    var selopt = document.getElementById("thanhtoan").value;
    if(selopt === 'Thanh toán qua thẻ ngân hàng') {
        document.getElementById("ngan-hang").style.display = "block";        
    } else {
        document.getElementById("ngan-hang").style.display = "none";        
    }
}

$(".step01").click(function () {
    $("#line-progress").css("width", "3%");
    $(".discovery").addClass("active").siblings().removeClass("active");
});

$(".step02").click(function () {
    $("#line-progress").css("width", "35%");
    $(".strategy").addClass("active").siblings().removeClass("active");
});

$(".step03").click(function () {
    $("#line-progress").css("width", "66%");
    $(".creative").addClass("active").siblings().removeClass("active");
});

$(".step04").click(function () {
    $("#line-progress").css("width", "98%");
    $(".production").addClass("active").siblings().removeClass("active");
});