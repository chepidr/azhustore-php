function MobileDetect() {
  var UA = navigator.userAgent.toLowerCase();
  return (/android|webos|iris|bolt|mobile|iphone|ipad|ipod|iemobile|blackberry|windows phone|opera mobi|opera mini/i.test(UA)) ? true : false;
}
jQuery(document).ready(function($) {
  // Если браузер не мобильный, работаем
  if (!MobileDetect()) {
    var
 
      $window = $(window), // Основное окно
 
      $target = $(".header"), // Блок, который нужно фиксировать при прокрутке
 
      $h = $target.offset().top; // Определяем координаты верха нужного блока (например, с навигацией или виджетом, который надо фиксировать)
 
    $window.on('scroll', function() {
 
      // Как далеко вниз прокрутили страницу
      var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
 
      // Если прокрутили скролл ниже макушки нужного блока, включаем ему фиксацию
      if (scrollTop > $h) {
 
        $target.addClass("header__scrolled");
 
        // Иначе возвращаем всё назад
      } else {
 
        $target.removeClass("header__scrolled");
      }
    });
  }

  
});

document.body.onload=function(){
  setTimeout(function(){
    var preloader=document.getElementById('page-preloader');
    if(!preloader.classList.contains('done'))
    {
      preloader.classList.add('done');
    }
  },1000);
}



