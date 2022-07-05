click('.gam',function(el){
  el.classList.toggle('active');
  slideToggle(selector('.main-menu-wrap'), 200);
});  

click('.close-popup',function(el){
  fadeOut(selector('.main-popup-wrap'), 200);
});   
click('.closer',function(el){
  fadeOut(selector('.main-popup-wrap'), 200);
}); 
click('.clear-form',function(el){
  selector('#search-input').value = ""
}); 

click('.get-share',function(el){
  fadeToggle(selector('#report-wrap .dropdown'),200)
  toggleClass(el,'active')
  return false;
})
click('.get-langs',function(el){
  fadeToggle(selector('#lang-wrap .dropdown'),200)
  toggleClass(el,'active')
  return false;
})

click('.select-wrap input',function(el){
  fadeToggle(selector('.drop-select'),200)
  toggleClass(el,'active')
  return false;
})
if (selector('.select-wrap')){
  clickOut('.select-wrap input',function(el){
    fadeOut(selector('.drop-select'),200)
    removeClass(selector('.select-wrap input'),'active')
    return false;
  })
}

if (selector('#report-wrap')){
  clickOut('#report-wrap',function(el){
    fadeOut(selector('#report-wrap .dropdown'),200)
    removeClass(selector('.get-share'),'active')
    return false;
  })
}

if (selector('#gam')){
  clickOut('#gam',function(el){
    if (window.screen.width<1024){
      removeClass(selector('#gam'),'active')
      slideUp(selector('.main-menu-wrap'), 200);
    }
  })
}

if (selector('#lang-wrap')){
  clickOut('#lang-wrap',function(el){
    fadeOut(selector('#lang-wrap .dropdown'),200)
    removeClass(selector('.get-langs'),'active')
    return false;
  })
}

click("#copy",function(el){
  copyToClipboard(el.getAttribute('data-link'));
})

click(".drop-results p:not(.deleted)",function(el){
  text=el.textContent;
  selector('#search-input').value = text.trim()
})

click(".drop-select p",function(el){
  text=el.getAttribute('data-text');
  selector('input[name="subject"]').value = text.trim()
  removeClass(selectors('.drop-select p'),'active')
  addClass(el,'active')
})



click(".single-help-wrap .list a",function(el){
  hash=el.getAttribute('href');
  var divsToHide = document.getElementsByClassName("tabs"); //divsToHide is an array
    for(var i = 0; i < divsToHide.length; i++){
        divsToHide[i].style.display = "none"; // depending on what you're doing
    } 
  selector(hash).style.display = "block"; 


  removeClass(selectors('.single-help-wrap .list a'),'active')
  addClass(el,'active')
  //return false;
})

click("#lang-wrap p",function(el){
  text=el.textContent;
  selector('.get-langs b').textContent = text.trim()
  fadeOut(selector('#lang-wrap .dropdown'),200)
  removeClass(selector('.get-langs'),'active')
})



//if (window.location.hash){
  
//}

