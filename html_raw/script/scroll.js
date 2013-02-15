// JScript File

/* Form Script for scrolling photo categories vertically
Developed By	: Sameer Kalia
Date			: 23 May, 2008 
Message			: Contains functions for horizontal scrolling.
*/

//****** Script for scroll images************************************			
dw_scrollObjs = {};
dw_scrollObj.speed = 100; 

function dw_scrollObj(wnId, lyrId, cntId) {

  this.id = wnId; dw_scrollObjs[this.id] = this;
  this.animString = "dw_scrollObjs." + this.id;
  this.load(lyrId, cntId);
}

dw_scrollObj.loadLayer = function(wnId, id, cntId) {

  if ( dw_scrollObjs[wnId] ) dw_scrollObjs[wnId].load(id, cntId);
}

dw_scrollObj.prototype.load = function(lyrId, cntId) {
  if (!document.getElementById) return;
  var wndo, lyr;
  if (this.lyrId) {
    lyr = document.getElementById(this.lyrId);
    lyr.style.visibility = "hidden";
  }
  lyr = document.getElementById(lyrId);
  wndo = document.getElementById(this.id);
  lyr.style.top = this.y = 0; lyr.style.left = this.x = 0;  
  this.maxY = (lyr.offsetHeight - wndo.offsetHeight > 0)? lyr.offsetHeight - wndo.offsetHeight: 0;  
  this.wd = cntId? document.getElementById(cntId).offsetWidth: lyr.offsetWidth;
  this.maxX = (this.wd - wndo.offsetWidth > 0)? this.wd - wndo.offsetWidth: 0;
  this.lyrId = lyrId; // hold id of currently visible layer
  lyr.style.visibility = "visible";
  this.on_load(); this.ready = true;
}

dw_scrollObj.prototype.on_load = function() {}  

dw_scrollObj.prototype.shiftTo = function(lyr, x, y) {
  lyr.style.left = (this.x = x) + "px"; 
  lyr.style.top = (this.y = y) + "px";
}

// remove layers from table for ns6+/mozilla (needed for scrolling inside tables)
dw_scrollObj.GeckoTableBugFix = function() {
  var i, wndo, holderId, holder, x, y;
	if ( navigator.userAgent.indexOf("Gecko") > -1 && navigator.userAgent.indexOf("Firefox") == -1 ) {
    dw_scrollObj.hold = []; // holds id's of wndo and its container
    for (i=0; arguments[i]; i++) {
      if ( dw_scrollObjs[ arguments[i] ] ) {
        wndo = document.getElementById( arguments[i] );
        holderId = wndo.parentNode.id;
        holder = document.getElementById(holderId);
        document.body.appendChild( holder.removeChild(wndo) );
        wndo.style.zIndex = 1000;
        x = holder.offsetLeft; y = holder.offsetTop;
        wndo.style.left = x + "px"; wndo.style.top = y + "px";
        dw_scrollObj.hold[i] = [ arguments[i], holderId ];
      }
    }
   window.addEventListener("resize", dw_scrollObj.rePositionGecko, true);
  }
}

// ns6+/mozilla need to reposition layers onresize when scrolling inside tables.
dw_scrollObj.rePositionGecko = function() {
  var i, wndo, holder, x, y;
  if (dw_scrollObj.hold) {
    for (i=0; dw_scrollObj.hold[i]; i++) {
      wndo = document.getElementById( dw_scrollObj.hold[i][0] );
      holder = document.getElementById( dw_scrollObj.hold[i][1] );
      x = holder.offsetLeft; y = holder.offsetTop;
      wndo.style.left = x + "px"; wndo.style.top = y + "px";
    }
  }
}
dw_scrollObj.stopScroll = function(wnId) {
  if ( dw_scrollObjs[wnId] ) dw_scrollObjs[wnId].endScroll();
}

// increase speed onmousedown of scroll links
dw_scrollObj.doubleSpeed = function(wnId) {
  if ( dw_scrollObjs[wnId] ) dw_scrollObjs[wnId].speed *= 2;
}

dw_scrollObj.resetSpeed = function(wnId) {
  if ( dw_scrollObjs[wnId] ) dw_scrollObjs[wnId].speed /= 2;
}

// algorithms for time-based scrolling and scrolling onmouseover at any angle adapted from youngpup.net
dw_scrollObj.initScroll = function(wnId, deg, sp) {
// alert("hi"+wnId);
	//alert(sp)
  if ( dw_scrollObjs[wnId] ) {
    var cosine, sine;
    if (typeof deg == "string") {
      switch (deg) {
        case "up"    : deg = 90;  break;
        case "down"  : deg = 270; break;
        case "left"  : deg = 180; break;
        case "right" : deg = 0;   break;
        default: 
          alert("Direction of scroll in mouseover scroll links should be 'up', 'down', 'left', 'right' or number: 0 to 360.");
       }
    } 
    deg = deg % 360;
    if (deg % 90 == 0) {
      cosine = (deg == 0)? -1: (deg == 180)? 1: 0;
      sine = (deg == 90)? 1: (deg == 270)? -1: 0;
    } else {
      var angle = deg * Math.PI/180;
      cosine = -Math.cos(angle); sine = Math.sin(angle);
    }
    dw_scrollObjs[wnId].fx = cosine / ( Math.abs(cosine) + Math.abs(sine) );
    dw_scrollObjs[wnId].fy = sine / ( Math.abs(cosine) + Math.abs(sine) );
    dw_scrollObjs[wnId].endX = (deg == 90 || deg == 270)? dw_scrollObjs[wnId].x:
      (deg < 90 || deg > 270)? -dw_scrollObjs[wnId].maxX: 0; 
          dw_scrollObjs[wnId].endY = (deg == 0 || deg == 180)? dw_scrollObjs[wnId].y: 
      (deg < 180)? 0: -dw_scrollObjs[wnId].maxY;
  //  alert(dw_scrollObjs[wnId])
   //    alert(sp)
    dw_scrollObjs[wnId].startScroll(sp);
  }
}

// speed (optional) to override default speed (set in dw_scrollObj.speed)
dw_scrollObj.prototype.startScroll = function(speed) {
  if (!this.ready) return; if (this.timerId) clearInterval(this.timerId);
  this.speed = speed || dw_scrollObj.speed;
  this.lyr = document.getElementById(this.lyrId);
  this.lastTime = ( new Date() ).getTime();
  this.on_scroll_start();  
  this.timerId = setInterval(this.animString + ".scroll()", 10); 
  
}

dw_scrollObj.prototype.scroll = function() {
  var now = ( new Date() ).getTime();
  var d = (now - this.lastTime)/1000 * this.speed;
  if (d > 0) {
    var x = this.x + this.fx * d; var y = this.y + this.fy * d;
    if (this.fx == 0 || this.fy == 0) { // for horizontal or vertical scrolling
      if ( ( this.fx == -1 && x > -this.maxX ) || ( this.fx == 1 && x < 0 ) || 
        ( this.fy == -1 && y > -this.maxY ) || ( this.fy == 1 && y < 0 ) ) {
        this.lastTime = now;
        this.shiftTo(this.lyr, x, y);
        this.on_scroll(x, y);
      } else {
        clearInterval(this.timerId); this.timerId = 0;
        this.shiftTo(this.lyr, this.endX, this.endY);
        this.on_scroll_end(this.endX, this.endY);
      }
    } else { // for scrolling at an angle (stop when reach end on one axis)
      if ( ( this.fx < 0 && x >= -this.maxX && this.fy < 0 && y >= -this.maxY ) ||
        ( this.fx > 0 && x <= 0 && this.fy > 0 && y <= 0 ) ||
        ( this.fx < 0 && x >= -this.maxX && this.fy > 0 && y <= 0 ) ||
        ( this.fx > 0 && x <= 0 && this.fy < 0 && y >= -this.maxY ) ) {
        this.lastTime = now;
        this.shiftTo(this.lyr, x, y);
        this.on_scroll(x, y);
      } else {
        clearInterval(this.timerId); this.timerId = 0;
        this.on_scroll_end(this.x, this.y);
      }
    }
  }
}

dw_scrollObj.prototype.endScroll = function() {
  if (!this.ready) return;
  if (this.timerId) clearInterval(this.timerId);
  this.timerId = 0;  this.lyr = null;
}

dw_scrollObj.prototype.on_scroll = function() {}
dw_scrollObj.prototype.on_scroll_start = function() {}
dw_scrollObj.prototype.on_scroll_end = function() {}

function initScrollLayer() {

  // arguments: id of layer containing scrolling layers (clipped layer), id of layer to scroll, 
  // if horizontal scrolling, id of element containing scrolling content (table?)  
 
 
 var wndo = new dw_scrollObj('wn3', 'lyr3', 't3');
   
  // pass id's of any wndo's that scroll inside tables
  // i.e., if you have 3 (with id's wn1, wn2, wn3): dw_scrollObj.GeckoTableBugFix('wn1', 'wn2', 'wn3');
 
 //dw_scrollObj.GeckoTableBugFix('wn3'); 
  
  
  
}
//********************************************************************
		



