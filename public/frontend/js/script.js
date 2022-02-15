new WOW().init();

// owl carousel
$('#testimonial_carousel').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    navText : ["<i class='las la-angle-left'></i>","<i class='las la-angle-right'></i>"],
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
            items:2,
            nav:true,
            loop:false  ,
        }
    }
})
// owl carousel
$('#services_os_slider').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    navText : ["<i class='las la-angle-left'></i>","<i class='las la-angle-right'></i>"],
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
            items:4,
            nav:true,
            loop:false  ,
        }
    }
});
$('#yoga_slider').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    navText : ["<i class='las la-angle-left'></i>","<i class='las la-angle-right'></i>"],
    responsive:{
        0:{
            items:1,
            nav:false
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
            items:1,
            nav:false,
            loop:false  ,
        }
    }
});
$('#yoga_class_slider').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    navText : ["<i class='las la-angle-left'></i>","<i class='las la-angle-right'></i>"],
    responsive:{
        0:{
            items:1,
            nav:false
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
            items:4,
            nav:true,
            loop:true  ,
        }
    }
});
$('#id_planning').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    navText : ["<i class='las la-angle-left'></i>","<i class='las la-angle-right'></i>"],
    responsive:{
        0:{
            items:1,
            nav:false
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
            items:3,
            nav:true,
            loop:true  ,
        }
    }
});
$('#id_cafe_slider').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    navText : ["<i class='las la-angle-left'></i>","<i class='las la-angle-right'></i>"],
    responsive:{
        0:{
            items:1,
            nav:false
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
            items:4,
            nav:true,
            loop:true  ,
        }
    }
});

$(window).scroll(function(){
    var top = $(window).scrollTop();
    if(top > 10){
        $(document).find('header#site_header').addClass('sticky_nav');
    }
    else{
        $(document).find('header#site_header').removeClass('sticky_nav');
    }
})

// full calendar
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth'
    });
    calendar.render();
  });

  $('.grid').masonry({
    itemSelector: '.grid-item',
    columnWidth: 200
  });

//   ********************************************************************************
 