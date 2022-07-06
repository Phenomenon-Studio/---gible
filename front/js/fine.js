function click(cls,func){
  Array.prototype.slice.call(document.querySelectorAll(cls)).forEach(function (element) {
    element.addEventListener('click', function(e) {
       func(element);
       return element;
    });
  });
}

function clickOut(cls,func){
  document.addEventListener('click', function(e){   
  if (document.querySelector(cls).contains(e.target)){
    // Clicked in box
  } else{
    func(e);
  }
    return e;
  });
}

function selector(selector){
  if (document.querySelector(selector)){
    return document.querySelector(selector)
  }
}

function selectors(selector){
  els=[];
  i=0;
  Array.prototype.slice.call(document.querySelectorAll(selector)).forEach(function (element) {
    els[i]=element;
    i++;
  });
  return els;
}

function removeClass(element,cls){
  if (Array.isArray(element)){
    for (var i = 0; i <= element.length-1; i++) {
      element[i].classList.remove(cls)
    }
  }else{
    element.classList.remove(cls)
  }

}
function addClass(element,cls){
  if (Array.isArray(element)){
    for (var i = 0; i <= element.length-1; i++) {
      element[i].classList.add(cls)
    }
  }else{
    element.classList.add(cls)
  }
}


function toggleClass(element,cls){
 if (Array.isArray(element)){
    for (var i = 0; i <= element.length-2; i++) {
      element[i].classList.toggle(cls)
    }
  }else{
    element.classList.toggle(cls)
  }
}


var body = document.body;
let slideUp = (target, duration=500) => {
        let display = window.getComputedStyle(target).display;
        target.style.transitionProperty = 'height, margin, padding';
        target.style.transitionDuration = duration + 'ms';
        target.style.boxSizing = 'border-box';
        target.style.height = target.offsetHeight + 'px';
        target.offsetHeight;
        target.style.overflow = 'hidden';
        target.style.height = 0;
        target.style.paddingTop = 0;
        target.style.paddingBottom = 0;
        target.style.marginTop = 0;
        target.style.marginBottom = 0;
        window.setTimeout( () => {
              target.style.display = 'none';
              target.style.removeProperty('height');
              target.style.removeProperty('padding-top');
              target.style.removeProperty('padding-bottom');
              target.style.removeProperty('margin-top');
              target.style.removeProperty('margin-bottom');
              target.style.removeProperty('overflow');
              target.style.removeProperty('transition-duration');
              target.style.removeProperty('transition-property');
              //alert("!");
        }, duration);
    }

    let slideDown = (target, duration=500) => {
        target.style.removeProperty('display');
        let display = window.getComputedStyle(target).display;
        if (display === 'none') display = 'block';
        target.style.display = display;
        let height = target.offsetHeight;
        target.style.overflow = 'hidden';
        target.style.height = 0;
        target.style.paddingTop = 0;
        target.style.paddingBottom = 0;
        target.style.marginTop = 0;
        target.style.marginBottom = 0;
        target.offsetHeight;
        target.style.boxSizing = 'border-box';
        target.style.transitionProperty = "height, margin, padding";
        target.style.transitionDuration = duration + 'ms';
        target.style.height = height + 'px';
        target.style.removeProperty('padding-top');
        target.style.removeProperty('padding-bottom');
        target.style.removeProperty('margin-top');
        target.style.removeProperty('margin-bottom');
        window.setTimeout( () => {
          target.style.removeProperty('height');
          target.style.removeProperty('overflow');
          target.style.removeProperty('transition-duration');
          target.style.removeProperty('transition-property');
        }, duration);
    }

    
    var slideToggle = (target, duration = 500) => {
        if (window.getComputedStyle(target).display === 'none') {
          return slideDown(target, duration);
        } else {
          return slideUp(target, duration);
        }
    }

// fade out

function fadeOut(el){
  el.style.opacity = 1;

  (function fade() {
    if ((el.style.opacity -= .1) < 0) {
      el.style.display = "none";
    } else {
      requestAnimationFrame(fade);
    }
  })();
}

// fade in

function fadeIn(el){
  el.style.opacity = 0;
  el.style.display = "block";

  (function fade() {
    var val = parseFloat(el.style.opacity);
    if (!((val += .1) > 1)) {
      el.style.opacity = val;
      requestAnimationFrame(fade);
    } 
  })();
}
var fadeToggle = (target, duration = 500) => {
        if (window.getComputedStyle(target).display === 'none') {
          return fadeIn(target, duration);
        } else {
          return fadeOut(target, duration);
        }
    }

function copyToClipboard(text) {
    if (window.clipboardData && window.clipboardData.setData) {
        // IE specific code path to prevent textarea being shown while dialog is visible.
        return clipboardData.setData("Text", text); 

    } else if (document.queryCommandSupported && document.queryCommandSupported("copy")) {
        var textarea = document.createElement("textarea");
        textarea.textContent = text;
        textarea.style.position = "fixed";  // Prevent scrolling to bottom of page in MS Edge.
        document.body.appendChild(textarea);
        textarea.select();
        try {
            return document.execCommand("copy");  // Security exception may be thrown by some browsers.
        } catch (ex) {
            console.warn("Copy to clipboard failed.", ex);
            return false;
        } finally {
            document.body.removeChild(textarea);
        }
    }
}

function serialize(form) {
    var inputs = form.elements;
    var array = [];
    for(i=0; i < inputs.length; i++) {
      var inputNameValue = inputs[i].name + '=' + inputs[i].value;
      array.push(inputNameValue);
    }
    return array.join('&');
  }

function send(e,form) {
var http = new XMLHttpRequest();
var url = form.action;
var method = form.getAttribute('method');
if (!method){
  method='POST';
}
var params = serialize(form);
//console.log(params)
http.open(method, url, true);

//Send the proper header information along with the request
http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

http.onreadystatechange = function() {//Call a function when the state changes.
    if(http.readyState == 4 && http.status == 200) {
        //alert(http.responseText);
        document.querySelector('.succ').classList.add('active')
    }
    form.reset();
}
http.send(params);
  e.preventDefault();
}

function send2(e,form) {
var http = new XMLHttpRequest();
var url = form.action;
var method = form.getAttribute('method');
if (!method){
  method='POST';
}
var params = serialize(form);
//console.log(params)
http.open(method, url, true);

//Send the proper header information along with the request
http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

http.onreadystatechange = function() {//Call a function when the state changes.
    if(http.readyState == 4 && http.status == 200) {
        //alert(http.responseText);
        fadeIn(document.querySelector('.thanks-popup'),200)
    }
    form.reset();
}
http.send(params);
  e.preventDefault();
}

//scroll

  let d = document;
  anc='';

  function init() {

    Array.prototype.slice.call(document.querySelectorAll('a[href^="#"')).forEach(function (link) {
      link.addEventListener('click', function(e) {
          e.preventDefault();
          let anchor1Link  = link;
          if (this.getAttribute('href')!='#'){
            let href = this.getAttribute('href').substring(1);
            let anchor1      = document.getElementById(href); 
            anc=anchor1Link.offsetTop;
            setTimeout(function(){
              scrollTo(anchor1.offsetTop, e)
            },50);
          }

           
      });
  });
  }
  
  var requestAnimFrame = (function() {
    return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || function(callback) {
      window.setTimeout(callback, 1000 / 60);
    };
  })();

  function scrollTo(to, callback ) {
    duration = 1000   ;  
    if (isDomElement(to)) {
      to = to.offsetTop;
    }
    function move(amount) {
      document.documentElement.scrollTop = amount;
      document.body.parentNode.scrollTop = amount;
      document.body.scrollTop = amount;
    }

    function position() {
      return document.documentElement.offsetTop || document.body.parentNode.offsetTop || document.body.offsetTop;
    }
    var start = window.pageYOffset,
      change = to - start,
      currentTime = 0,
      increment = 20;
    
    var animateScroll = function() {
      currentTime += increment;
      var val = Math.easeInOutQuad(currentTime, start, change, duration);
      move(val);
      if (currentTime < duration) {
        requestAnimFrame(animateScroll);
      }
      else {
        if (callback && typeof(callback) === 'function') {
          callback();
        }
      }
    };
    
    animateScroll();
  }

  init();

Math.easeInOutQuad = function(t, b, c, d) {
  t /= d / 2;
  if (t < 1) {
    return c / 2 * t * t + b
  }
  t--;
  return -c / 2 * (t * (t - 2) - 1) + b;
};

Math.easeInCubic = function(t, b, c, d) {
  var tc = (t /= d) * t * t;
  return b + c * (tc);
};

Math.inOutQuintic = function(t, b, c, d) {
  var ts = (t /= d) * t,
    tc = ts * t;
  return b + c * (6 * tc * ts + -15 * ts * ts + 10 * tc);
};

function isDomElement(obj) {
    return obj instanceof Element;
}

function isMouseEvent(obj) {
    return obj instanceof MouseEvent;
}

function findScrollingElement(element) { //FIXME Test this too
  do {
    if (element.clientHeight < element.scrollHeight || element.clientWidth < element.scrollWidth) {
      return element;
    }
  } while (element = element.parentNode);
}

//scroll end
