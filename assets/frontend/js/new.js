$(".popupsInfo").click(function(){

  $(this).children("span");
  var a = $(this).children("span").text();
  $(this).parents(".pdt-bx-wrap").next('a').find("img");
  var b = $(this).parents(".pdt-bx-wrap").next('a').find("img").attr("src");
  // console.log(b)



  var modal = document.getElementById("myModal");

  // Get the image and insert it inside the modal - use its "alt" text as a caption
  var img = document.getElementById("myImg");
  var modalImg = document.getElementById("img01");
  var captionText = document.getElementById("caption");
  // img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = b;
    captionText.innerHTML = a;
  // }
  
  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];
  
  // When the user clicks on <span> (x), close the modal
  span.onclick = function() { 
    modal.style.display = "none";
  }

  // $('#exampleModalLong').modal('show');
    
  
  // $( "div.blur_image" ).siblings().first().toggleClass("blur");
  // $(this).
})
// $(".popupsInfos").click(function(){
//   $(this).children("span").toggleClass("show");
//   $(this).parents(".pdt-bx-wraps").next('a').find("img").toggleClass("blur");
//   // $( "div.blur_image" ).siblings().first().toggleClass("blur");
//   // $(this).
// })







var $jq = jQuery.noConflict();
function home_categories(limitation){
  $jq.ajax({
   url: "<?php echo site_url('home/home_categories/'); ?>",
   success: function(response){
    $jq('#home_category_loader').show();
    setInterval(function(){
     $jq('#home_category_loader').hide();
     $jq('#home_category').html(response);
   },1500);

  }
});
}

$jq('.select2').select2({
  width: '99%'
});
$jq(document).ready(function(){


  $jq('.brandy-slider').slick({
    dots: false,
    // infinite: true,
    // autoplay: true,
    // autoplaySpeed: 2000,
    arrows: true,
    speed: 300,
    slidesToShow: 5,
    slidesToScroll: 2,
    responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 2,
        infinite: true,
        dots: false,
        arrows:true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true
      }
    }
    ]
  });

  let $el =$jq('.cata-slider');
$el.on('init', function (slick) {
      $(".loadingspinner").remove()
 });
  $el.slick({
    dots: false,
    infinite: false,
    arrows: false,
    speed: 300,
    slidesToShow: 9,
    slidesToScroll: 2,
    responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 5,
        slidesToScroll: 2,
        infinite: true,
        dots: false,
        arrows:false
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: false
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 5,
        slidesToScroll: 1,
        arrows: false
      }
    }
    ]
  });
  

  $jq('.pdt-bx-slide').slick({
    dots: false,
    infinite: true,
    arrows: false,
    speed: 300,
    slidesToShow: 6,
    slidesToScroll: 2,
    responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 2,
        infinite: true,
        dots: false,
        arrows:false
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: false
      }
    }
    ]
  });
 $jq('.pdt-serv-slide').slick({
    dots: false,
    infinite: true,
    arrows: false,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 2,
    responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 2,
        infinite: true,
        dots: false,
        arrows:false
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: false
      }
    }
    ]
  });

$(function () {
  $('[data-toggle="popover"]').popover()
})

  // $jq('.slider_four_in_line').EasySlides({
  //   'autoplay': true,
  //   'show': 9
  // })


});


 function myFunction(id) {
  var popup = document.getElementById(id);
  var blurryEffect = document.getElementById("blur_image");
  console.log(blurryEffect);
  popup.classList.toggle("show");
  blurryEffect.classList.toggle("blur");
}

