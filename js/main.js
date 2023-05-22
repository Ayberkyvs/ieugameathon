//            LOADER ICIN JAVASCRIPT KODLARI           //

var preloader = document.getElementById('loader');
      function preLoaderHandler(){
          preloader.style.display = 'none';
      }


var loader;

function loadNow(opacity) {
    if (opacity <= 0) {
        displayContent();
    } else {
        loader.style.opacity = opacity;
        window.setTimeout(function() {
            loadNow(opacity - 0.05);
        }, 30);
    }
}

function displayContent() {
    loader.style.display = 'none';
    document.getElementById('content').style.display = 'block';
}

document.addEventListener("DOMContentLoaded", function() {
    loader = document.getElementById('loader');
    loadNow(3);
});

//            SCROLL DOWN GIFI İÇİN                      //

window.addEventListener('scroll', function() {
    var scrollDiv = document.getElementById('scrolldown');
    var windowHeight = window.innerHeight;
    var scrollThreshold = windowHeight;
  
    var currentScrollPosition = window.pageYOffset || document.documentElement.scrollTop;
  
    if (currentScrollPosition > scrollThreshold) {
      scrollDiv.classList.add('hidden');
    } else {
      scrollDiv.classList.remove('hidden');
    }
  });
  
  

//            LIGHTBOX ICIN JAVASCRIPT KODLARI           //




function openModal() {
    document.getElementById("myModal").style.display = "block";
  }
  
  function closeModal() {
    document.getElementById("myModal").style.display = "none";
  }
  
  var slideIndex = 1;
  showSlides(slideIndex);
  
  function plusSlides(n) {
    showSlides(slideIndex += n);
  }
  
  function currentSlide(n) {
    showSlides(slideIndex = n);
  }
  
  function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("demo");
    var captionText = document.getElementById("caption");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
    captionText.innerHTML = dots[slideIndex-1].alt;
  }

