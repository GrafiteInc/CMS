/*!
 * Bootstrap v3.3.5 (http://getbootstrap.com)
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under the MIT license
 */
if("undefined"==typeof jQuery)throw new Error("Bootstrap's JavaScript requires jQuery");+function(a){"use strict";var b=a.fn.jquery.split(" ")[0].split(".");if(b[0]<2&&b[1]<9||1==b[0]&&9==b[1]&&b[2]<1)throw new Error("Bootstrap's JavaScript requires jQuery version 1.9.1 or higher")}(jQuery),+function(a){"use strict";function b(){var a=document.createElement("bootstrap"),b={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd otransitionend",transition:"transitionend"};for(var c in b)if(void 0!==a.style[c])return{end:b[c]};return!1}a.fn.emulateTransitionEnd=function(b){var c=!1,d=this;a(this).one("bsTransitionEnd",function(){c=!0});var e=function(){c||a(d).trigger(a.support.transition.end)};return setTimeout(e,b),this},a(function(){a.support.transition=b(),a.support.transition&&(a.event.special.bsTransitionEnd={bindType:a.support.transition.end,delegateType:a.support.transition.end,handle:function(b){return a(b.target).is(this)?b.handleObj.handler.apply(this,arguments):void 0}})})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var c=a(this),e=c.data("bs.alert");e||c.data("bs.alert",e=new d(this)),"string"==typeof b&&e[b].call(c)})}var c='[data-dismiss="alert"]',d=function(b){a(b).on("click",c,this.close)};d.VERSION="3.3.5",d.TRANSITION_DURATION=150,d.prototype.close=function(b){function c(){g.detach().trigger("closed.bs.alert").remove()}var e=a(this),f=e.attr("data-target");f||(f=e.attr("href"),f=f&&f.replace(/.*(?=#[^\s]*$)/,""));var g=a(f);b&&b.preventDefault(),g.length||(g=e.closest(".alert")),g.trigger(b=a.Event("close.bs.alert")),b.isDefaultPrevented()||(g.removeClass("in"),a.support.transition&&g.hasClass("fade")?g.one("bsTransitionEnd",c).emulateTransitionEnd(d.TRANSITION_DURATION):c())};var e=a.fn.alert;a.fn.alert=b,a.fn.alert.Constructor=d,a.fn.alert.noConflict=function(){return a.fn.alert=e,this},a(document).on("click.bs.alert.data-api",c,d.prototype.close)}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.button"),f="object"==typeof b&&b;e||d.data("bs.button",e=new c(this,f)),"toggle"==b?e.toggle():b&&e.setState(b)})}var c=function(b,d){this.$element=a(b),this.options=a.extend({},c.DEFAULTS,d),this.isLoading=!1};c.VERSION="3.3.5",c.DEFAULTS={loadingText:"loading..."},c.prototype.setState=function(b){var c="disabled",d=this.$element,e=d.is("input")?"val":"html",f=d.data();b+="Text",null==f.resetText&&d.data("resetText",d[e]()),setTimeout(a.proxy(function(){d[e](null==f[b]?this.options[b]:f[b]),"loadingText"==b?(this.isLoading=!0,d.addClass(c).attr(c,c)):this.isLoading&&(this.isLoading=!1,d.removeClass(c).removeAttr(c))},this),0)},c.prototype.toggle=function(){var a=!0,b=this.$element.closest('[data-toggle="buttons"]');if(b.length){var c=this.$element.find("input");"radio"==c.prop("type")?(c.prop("checked")&&(a=!1),b.find(".active").removeClass("active"),this.$element.addClass("active")):"checkbox"==c.prop("type")&&(c.prop("checked")!==this.$element.hasClass("active")&&(a=!1),this.$element.toggleClass("active")),c.prop("checked",this.$element.hasClass("active")),a&&c.trigger("change")}else this.$element.attr("aria-pressed",!this.$element.hasClass("active")),this.$element.toggleClass("active")};var d=a.fn.button;a.fn.button=b,a.fn.button.Constructor=c,a.fn.button.noConflict=function(){return a.fn.button=d,this},a(document).on("click.bs.button.data-api",'[data-toggle^="button"]',function(c){var d=a(c.target);d.hasClass("btn")||(d=d.closest(".btn")),b.call(d,"toggle"),a(c.target).is('input[type="radio"]')||a(c.target).is('input[type="checkbox"]')||c.preventDefault()}).on("focus.bs.button.data-api blur.bs.button.data-api",'[data-toggle^="button"]',function(b){a(b.target).closest(".btn").toggleClass("focus",/^focus(in)?$/.test(b.type))})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.carousel"),f=a.extend({},c.DEFAULTS,d.data(),"object"==typeof b&&b),g="string"==typeof b?b:f.slide;e||d.data("bs.carousel",e=new c(this,f)),"number"==typeof b?e.to(b):g?e[g]():f.interval&&e.pause().cycle()})}var c=function(b,c){this.$element=a(b),this.$indicators=this.$element.find(".carousel-indicators"),this.options=c,this.paused=null,this.sliding=null,this.interval=null,this.$active=null,this.$items=null,this.options.keyboard&&this.$element.on("keydown.bs.carousel",a.proxy(this.keydown,this)),"hover"==this.options.pause&&!("ontouchstart"in document.documentElement)&&this.$element.on("mouseenter.bs.carousel",a.proxy(this.pause,this)).on("mouseleave.bs.carousel",a.proxy(this.cycle,this))};c.VERSION="3.3.5",c.TRANSITION_DURATION=600,c.DEFAULTS={interval:5e3,pause:"hover",wrap:!0,keyboard:!0},c.prototype.keydown=function(a){if(!/input|textarea/i.test(a.target.tagName)){switch(a.which){case 37:this.prev();break;case 39:this.next();break;default:return}a.preventDefault()}},c.prototype.cycle=function(b){return b||(this.paused=!1),this.interval&&clearInterval(this.interval),this.options.interval&&!this.paused&&(this.interval=setInterval(a.proxy(this.next,this),this.options.interval)),this},c.prototype.getItemIndex=function(a){return this.$items=a.parent().children(".item"),this.$items.index(a||this.$active)},c.prototype.getItemForDirection=function(a,b){var c=this.getItemIndex(b),d="prev"==a&&0===c||"next"==a&&c==this.$items.length-1;if(d&&!this.options.wrap)return b;var e="prev"==a?-1:1,f=(c+e)%this.$items.length;return this.$items.eq(f)},c.prototype.to=function(a){var b=this,c=this.getItemIndex(this.$active=this.$element.find(".item.active"));return a>this.$items.length-1||0>a?void 0:this.sliding?this.$element.one("slid.bs.carousel",function(){b.to(a)}):c==a?this.pause().cycle():this.slide(a>c?"next":"prev",this.$items.eq(a))},c.prototype.pause=function(b){return b||(this.paused=!0),this.$element.find(".next, .prev").length&&a.support.transition&&(this.$element.trigger(a.support.transition.end),this.cycle(!0)),this.interval=clearInterval(this.interval),this},c.prototype.next=function(){return this.sliding?void 0:this.slide("next")},c.prototype.prev=function(){return this.sliding?void 0:this.slide("prev")},c.prototype.slide=function(b,d){var e=this.$element.find(".item.active"),f=d||this.getItemForDirection(b,e),g=this.interval,h="next"==b?"left":"right",i=this;if(f.hasClass("active"))return this.sliding=!1;var j=f[0],k=a.Event("slide.bs.carousel",{relatedTarget:j,direction:h});if(this.$element.trigger(k),!k.isDefaultPrevented()){if(this.sliding=!0,g&&this.pause(),this.$indicators.length){this.$indicators.find(".active").removeClass("active");var l=a(this.$indicators.children()[this.getItemIndex(f)]);l&&l.addClass("active")}var m=a.Event("slid.bs.carousel",{relatedTarget:j,direction:h});return a.support.transition&&this.$element.hasClass("slide")?(f.addClass(b),f[0].offsetWidth,e.addClass(h),f.addClass(h),e.one("bsTransitionEnd",function(){f.removeClass([b,h].join(" ")).addClass("active"),e.removeClass(["active",h].join(" ")),i.sliding=!1,setTimeout(function(){i.$element.trigger(m)},0)}).emulateTransitionEnd(c.TRANSITION_DURATION)):(e.removeClass("active"),f.addClass("active"),this.sliding=!1,this.$element.trigger(m)),g&&this.cycle(),this}};var d=a.fn.carousel;a.fn.carousel=b,a.fn.carousel.Constructor=c,a.fn.carousel.noConflict=function(){return a.fn.carousel=d,this};var e=function(c){var d,e=a(this),f=a(e.attr("data-target")||(d=e.attr("href"))&&d.replace(/.*(?=#[^\s]+$)/,""));if(f.hasClass("carousel")){var g=a.extend({},f.data(),e.data()),h=e.attr("data-slide-to");h&&(g.interval=!1),b.call(f,g),h&&f.data("bs.carousel").to(h),c.preventDefault()}};a(document).on("click.bs.carousel.data-api","[data-slide]",e).on("click.bs.carousel.data-api","[data-slide-to]",e),a(window).on("load",function(){a('[data-ride="carousel"]').each(function(){var c=a(this);b.call(c,c.data())})})}(jQuery),+function(a){"use strict";function b(b){var c,d=b.attr("data-target")||(c=b.attr("href"))&&c.replace(/.*(?=#[^\s]+$)/,"");return a(d)}function c(b){return this.each(function(){var c=a(this),e=c.data("bs.collapse"),f=a.extend({},d.DEFAULTS,c.data(),"object"==typeof b&&b);!e&&f.toggle&&/show|hide/.test(b)&&(f.toggle=!1),e||c.data("bs.collapse",e=new d(this,f)),"string"==typeof b&&e[b]()})}var d=function(b,c){this.$element=a(b),this.options=a.extend({},d.DEFAULTS,c),this.$trigger=a('[data-toggle="collapse"][href="#'+b.id+'"],[data-toggle="collapse"][data-target="#'+b.id+'"]'),this.transitioning=null,this.options.parent?this.$parent=this.getParent():this.addAriaAndCollapsedClass(this.$element,this.$trigger),this.options.toggle&&this.toggle()};d.VERSION="3.3.5",d.TRANSITION_DURATION=350,d.DEFAULTS={toggle:!0},d.prototype.dimension=function(){var a=this.$element.hasClass("width");return a?"width":"height"},d.prototype.show=function(){if(!this.transitioning&&!this.$element.hasClass("in")){var b,e=this.$parent&&this.$parent.children(".panel").children(".in, .collapsing");if(!(e&&e.length&&(b=e.data("bs.collapse"),b&&b.transitioning))){var f=a.Event("show.bs.collapse");if(this.$element.trigger(f),!f.isDefaultPrevented()){e&&e.length&&(c.call(e,"hide"),b||e.data("bs.collapse",null));var g=this.dimension();this.$element.removeClass("collapse").addClass("collapsing")[g](0).attr("aria-expanded",!0),this.$trigger.removeClass("collapsed").attr("aria-expanded",!0),this.transitioning=1;var h=function(){this.$element.removeClass("collapsing").addClass("collapse in")[g](""),this.transitioning=0,this.$element.trigger("shown.bs.collapse")};if(!a.support.transition)return h.call(this);var i=a.camelCase(["scroll",g].join("-"));this.$element.one("bsTransitionEnd",a.proxy(h,this)).emulateTransitionEnd(d.TRANSITION_DURATION)[g](this.$element[0][i])}}}},d.prototype.hide=function(){if(!this.transitioning&&this.$element.hasClass("in")){var b=a.Event("hide.bs.collapse");if(this.$element.trigger(b),!b.isDefaultPrevented()){var c=this.dimension();this.$element[c](this.$element[c]())[0].offsetHeight,this.$element.addClass("collapsing").removeClass("collapse in").attr("aria-expanded",!1),this.$trigger.addClass("collapsed").attr("aria-expanded",!1),this.transitioning=1;var e=function(){this.transitioning=0,this.$element.removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse")};return a.support.transition?void this.$element[c](0).one("bsTransitionEnd",a.proxy(e,this)).emulateTransitionEnd(d.TRANSITION_DURATION):e.call(this)}}},d.prototype.toggle=function(){this[this.$element.hasClass("in")?"hide":"show"]()},d.prototype.getParent=function(){return a(this.options.parent).find('[data-toggle="collapse"][data-parent="'+this.options.parent+'"]').each(a.proxy(function(c,d){var e=a(d);this.addAriaAndCollapsedClass(b(e),e)},this)).end()},d.prototype.addAriaAndCollapsedClass=function(a,b){var c=a.hasClass("in");a.attr("aria-expanded",c),b.toggleClass("collapsed",!c).attr("aria-expanded",c)};var e=a.fn.collapse;a.fn.collapse=c,a.fn.collapse.Constructor=d,a.fn.collapse.noConflict=function(){return a.fn.collapse=e,this},a(document).on("click.bs.collapse.data-api",'[data-toggle="collapse"]',function(d){var e=a(this);e.attr("data-target")||d.preventDefault();var f=b(e),g=f.data("bs.collapse"),h=g?"toggle":e.data();c.call(f,h)})}(jQuery),+function(a){"use strict";function b(b){var c=b.attr("data-target");c||(c=b.attr("href"),c=c&&/#[A-Za-z]/.test(c)&&c.replace(/.*(?=#[^\s]*$)/,""));var d=c&&a(c);return d&&d.length?d:b.parent()}function c(c){c&&3===c.which||(a(e).remove(),a(f).each(function(){var d=a(this),e=b(d),f={relatedTarget:this};e.hasClass("open")&&(c&&"click"==c.type&&/input|textarea/i.test(c.target.tagName)&&a.contains(e[0],c.target)||(e.trigger(c=a.Event("hide.bs.dropdown",f)),c.isDefaultPrevented()||(d.attr("aria-expanded","false"),e.removeClass("open").trigger("hidden.bs.dropdown",f))))}))}function d(b){return this.each(function(){var c=a(this),d=c.data("bs.dropdown");d||c.data("bs.dropdown",d=new g(this)),"string"==typeof b&&d[b].call(c)})}var e=".dropdown-backdrop",f='[data-toggle="dropdown"]',g=function(b){a(b).on("click.bs.dropdown",this.toggle)};g.VERSION="3.3.5",g.prototype.toggle=function(d){var e=a(this);if(!e.is(".disabled, :disabled")){var f=b(e),g=f.hasClass("open");if(c(),!g){"ontouchstart"in document.documentElement&&!f.closest(".navbar-nav").length&&a(document.createElement("div")).addClass("dropdown-backdrop").insertAfter(a(this)).on("click",c);var h={relatedTarget:this};if(f.trigger(d=a.Event("show.bs.dropdown",h)),d.isDefaultPrevented())return;e.trigger("focus").attr("aria-expanded","true"),f.toggleClass("open").trigger("shown.bs.dropdown",h)}return!1}},g.prototype.keydown=function(c){if(/(38|40|27|32)/.test(c.which)&&!/input|textarea/i.test(c.target.tagName)){var d=a(this);if(c.preventDefault(),c.stopPropagation(),!d.is(".disabled, :disabled")){var e=b(d),g=e.hasClass("open");if(!g&&27!=c.which||g&&27==c.which)return 27==c.which&&e.find(f).trigger("focus"),d.trigger("click");var h=" li:not(.disabled):visible a",i=e.find(".dropdown-menu"+h);if(i.length){var j=i.index(c.target);38==c.which&&j>0&&j--,40==c.which&&j<i.length-1&&j++,~j||(j=0),i.eq(j).trigger("focus")}}}};var h=a.fn.dropdown;a.fn.dropdown=d,a.fn.dropdown.Constructor=g,a.fn.dropdown.noConflict=function(){return a.fn.dropdown=h,this},a(document).on("click.bs.dropdown.data-api",c).on("click.bs.dropdown.data-api",".dropdown form",function(a){a.stopPropagation()}).on("click.bs.dropdown.data-api",f,g.prototype.toggle).on("keydown.bs.dropdown.data-api",f,g.prototype.keydown).on("keydown.bs.dropdown.data-api",".dropdown-menu",g.prototype.keydown)}(jQuery),+function(a){"use strict";function b(b,d){return this.each(function(){var e=a(this),f=e.data("bs.modal"),g=a.extend({},c.DEFAULTS,e.data(),"object"==typeof b&&b);f||e.data("bs.modal",f=new c(this,g)),"string"==typeof b?f[b](d):g.show&&f.show(d)})}var c=function(b,c){this.options=c,this.$body=a(document.body),this.$element=a(b),this.$dialog=this.$element.find(".modal-dialog"),this.$backdrop=null,this.isShown=null,this.originalBodyPad=null,this.scrollbarWidth=0,this.ignoreBackdropClick=!1,this.options.remote&&this.$element.find(".modal-content").load(this.options.remote,a.proxy(function(){this.$element.trigger("loaded.bs.modal")},this))};c.VERSION="3.3.5",c.TRANSITION_DURATION=300,c.BACKDROP_TRANSITION_DURATION=150,c.DEFAULTS={backdrop:!0,keyboard:!0,show:!0},c.prototype.toggle=function(a){return this.isShown?this.hide():this.show(a)},c.prototype.show=function(b){var d=this,e=a.Event("show.bs.modal",{relatedTarget:b});this.$element.trigger(e),this.isShown||e.isDefaultPrevented()||(this.isShown=!0,this.checkScrollbar(),this.setScrollbar(),this.$body.addClass("modal-open"),this.escape(),this.resize(),this.$element.on("click.dismiss.bs.modal",'[data-dismiss="modal"]',a.proxy(this.hide,this)),this.$dialog.on("mousedown.dismiss.bs.modal",function(){d.$element.one("mouseup.dismiss.bs.modal",function(b){a(b.target).is(d.$element)&&(d.ignoreBackdropClick=!0)})}),this.backdrop(function(){var e=a.support.transition&&d.$element.hasClass("fade");d.$element.parent().length||d.$element.appendTo(d.$body),d.$element.show().scrollTop(0),d.adjustDialog(),e&&d.$element[0].offsetWidth,d.$element.addClass("in"),d.enforceFocus();var f=a.Event("shown.bs.modal",{relatedTarget:b});e?d.$dialog.one("bsTransitionEnd",function(){d.$element.trigger("focus").trigger(f)}).emulateTransitionEnd(c.TRANSITION_DURATION):d.$element.trigger("focus").trigger(f)}))},c.prototype.hide=function(b){b&&b.preventDefault(),b=a.Event("hide.bs.modal"),this.$element.trigger(b),this.isShown&&!b.isDefaultPrevented()&&(this.isShown=!1,this.escape(),this.resize(),a(document).off("focusin.bs.modal"),this.$element.removeClass("in").off("click.dismiss.bs.modal").off("mouseup.dismiss.bs.modal"),this.$dialog.off("mousedown.dismiss.bs.modal"),a.support.transition&&this.$element.hasClass("fade")?this.$element.one("bsTransitionEnd",a.proxy(this.hideModal,this)).emulateTransitionEnd(c.TRANSITION_DURATION):this.hideModal())},c.prototype.enforceFocus=function(){a(document).off("focusin.bs.modal").on("focusin.bs.modal",a.proxy(function(a){this.$element[0]===a.target||this.$element.has(a.target).length||this.$element.trigger("focus")},this))},c.prototype.escape=function(){this.isShown&&this.options.keyboard?this.$element.on("keydown.dismiss.bs.modal",a.proxy(function(a){27==a.which&&this.hide()},this)):this.isShown||this.$element.off("keydown.dismiss.bs.modal")},c.prototype.resize=function(){this.isShown?a(window).on("resize.bs.modal",a.proxy(this.handleUpdate,this)):a(window).off("resize.bs.modal")},c.prototype.hideModal=function(){var a=this;this.$element.hide(),this.backdrop(function(){a.$body.removeClass("modal-open"),a.resetAdjustments(),a.resetScrollbar(),a.$element.trigger("hidden.bs.modal")})},c.prototype.removeBackdrop=function(){this.$backdrop&&this.$backdrop.remove(),this.$backdrop=null},c.prototype.backdrop=function(b){var d=this,e=this.$element.hasClass("fade")?"fade":"";if(this.isShown&&this.options.backdrop){var f=a.support.transition&&e;if(this.$backdrop=a(document.createElement("div")).addClass("modal-backdrop "+e).appendTo(this.$body),this.$element.on("click.dismiss.bs.modal",a.proxy(function(a){return this.ignoreBackdropClick?void(this.ignoreBackdropClick=!1):void(a.target===a.currentTarget&&("static"==this.options.backdrop?this.$element[0].focus():this.hide()))},this)),f&&this.$backdrop[0].offsetWidth,this.$backdrop.addClass("in"),!b)return;f?this.$backdrop.one("bsTransitionEnd",b).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION):b()}else if(!this.isShown&&this.$backdrop){this.$backdrop.removeClass("in");var g=function(){d.removeBackdrop(),b&&b()};a.support.transition&&this.$element.hasClass("fade")?this.$backdrop.one("bsTransitionEnd",g).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION):g()}else b&&b()},c.prototype.handleUpdate=function(){this.adjustDialog()},c.prototype.adjustDialog=function(){var a=this.$element[0].scrollHeight>document.documentElement.clientHeight;this.$element.css({paddingLeft:!this.bodyIsOverflowing&&a?this.scrollbarWidth:"",paddingRight:this.bodyIsOverflowing&&!a?this.scrollbarWidth:""})},c.prototype.resetAdjustments=function(){this.$element.css({paddingLeft:"",paddingRight:""})},c.prototype.checkScrollbar=function(){var a=window.innerWidth;if(!a){var b=document.documentElement.getBoundingClientRect();a=b.right-Math.abs(b.left)}this.bodyIsOverflowing=document.body.clientWidth<a,this.scrollbarWidth=this.measureScrollbar()},c.prototype.setScrollbar=function(){var a=parseInt(this.$body.css("padding-right")||0,10);this.originalBodyPad=document.body.style.paddingRight||"",this.bodyIsOverflowing&&this.$body.css("padding-right",a+this.scrollbarWidth)},c.prototype.resetScrollbar=function(){this.$body.css("padding-right",this.originalBodyPad)},c.prototype.measureScrollbar=function(){var a=document.createElement("div");a.className="modal-scrollbar-measure",this.$body.append(a);var b=a.offsetWidth-a.clientWidth;return this.$body[0].removeChild(a),b};var d=a.fn.modal;a.fn.modal=b,a.fn.modal.Constructor=c,a.fn.modal.noConflict=function(){return a.fn.modal=d,this},a(document).on("click.bs.modal.data-api",'[data-toggle="modal"]',function(c){var d=a(this),e=d.attr("href"),f=a(d.attr("data-target")||e&&e.replace(/.*(?=#[^\s]+$)/,"")),g=f.data("bs.modal")?"toggle":a.extend({remote:!/#/.test(e)&&e},f.data(),d.data());d.is("a")&&c.preventDefault(),f.one("show.bs.modal",function(a){a.isDefaultPrevented()||f.one("hidden.bs.modal",function(){d.is(":visible")&&d.trigger("focus")})}),b.call(f,g,this)})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.tooltip"),f="object"==typeof b&&b;(e||!/destroy|hide/.test(b))&&(e||d.data("bs.tooltip",e=new c(this,f)),"string"==typeof b&&e[b]())})}var c=function(a,b){this.type=null,this.options=null,this.enabled=null,this.timeout=null,this.hoverState=null,this.$element=null,this.inState=null,this.init("tooltip",a,b)};c.VERSION="3.3.5",c.TRANSITION_DURATION=150,c.DEFAULTS={animation:!0,placement:"top",selector:!1,template:'<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',trigger:"hover focus",title:"",delay:0,html:!1,container:!1,viewport:{selector:"body",padding:0}},c.prototype.init=function(b,c,d){if(this.enabled=!0,this.type=b,this.$element=a(c),this.options=this.getOptions(d),this.$viewport=this.options.viewport&&a(a.isFunction(this.options.viewport)?this.options.viewport.call(this,this.$element):this.options.viewport.selector||this.options.viewport),this.inState={click:!1,hover:!1,focus:!1},this.$element[0]instanceof document.constructor&&!this.options.selector)throw new Error("`selector` option must be specified when initializing "+this.type+" on the window.document object!");for(var e=this.options.trigger.split(" "),f=e.length;f--;){var g=e[f];if("click"==g)this.$element.on("click."+this.type,this.options.selector,a.proxy(this.toggle,this));else if("manual"!=g){var h="hover"==g?"mouseenter":"focusin",i="hover"==g?"mouseleave":"focusout";this.$element.on(h+"."+this.type,this.options.selector,a.proxy(this.enter,this)),this.$element.on(i+"."+this.type,this.options.selector,a.proxy(this.leave,this))}}this.options.selector?this._options=a.extend({},this.options,{trigger:"manual",selector:""}):this.fixTitle()},c.prototype.getDefaults=function(){return c.DEFAULTS},c.prototype.getOptions=function(b){return b=a.extend({},this.getDefaults(),this.$element.data(),b),b.delay&&"number"==typeof b.delay&&(b.delay={show:b.delay,hide:b.delay}),b},c.prototype.getDelegateOptions=function(){var b={},c=this.getDefaults();return this._options&&a.each(this._options,function(a,d){c[a]!=d&&(b[a]=d)}),b},c.prototype.enter=function(b){var c=b instanceof this.constructor?b:a(b.currentTarget).data("bs."+this.type);return c||(c=new this.constructor(b.currentTarget,this.getDelegateOptions()),a(b.currentTarget).data("bs."+this.type,c)),b instanceof a.Event&&(c.inState["focusin"==b.type?"focus":"hover"]=!0),c.tip().hasClass("in")||"in"==c.hoverState?void(c.hoverState="in"):(clearTimeout(c.timeout),c.hoverState="in",c.options.delay&&c.options.delay.show?void(c.timeout=setTimeout(function(){"in"==c.hoverState&&c.show()},c.options.delay.show)):c.show())},c.prototype.isInStateTrue=function(){for(var a in this.inState)if(this.inState[a])return!0;return!1},c.prototype.leave=function(b){var c=b instanceof this.constructor?b:a(b.currentTarget).data("bs."+this.type);return c||(c=new this.constructor(b.currentTarget,this.getDelegateOptions()),a(b.currentTarget).data("bs."+this.type,c)),b instanceof a.Event&&(c.inState["focusout"==b.type?"focus":"hover"]=!1),c.isInStateTrue()?void 0:(clearTimeout(c.timeout),c.hoverState="out",c.options.delay&&c.options.delay.hide?void(c.timeout=setTimeout(function(){"out"==c.hoverState&&c.hide()},c.options.delay.hide)):c.hide())},c.prototype.show=function(){var b=a.Event("show.bs."+this.type);if(this.hasContent()&&this.enabled){this.$element.trigger(b);var d=a.contains(this.$element[0].ownerDocument.documentElement,this.$element[0]);if(b.isDefaultPrevented()||!d)return;var e=this,f=this.tip(),g=this.getUID(this.type);this.setContent(),f.attr("id",g),this.$element.attr("aria-describedby",g),this.options.animation&&f.addClass("fade");var h="function"==typeof this.options.placement?this.options.placement.call(this,f[0],this.$element[0]):this.options.placement,i=/\s?auto?\s?/i,j=i.test(h);j&&(h=h.replace(i,"")||"top"),f.detach().css({top:0,left:0,display:"block"}).addClass(h).data("bs."+this.type,this),this.options.container?f.appendTo(this.options.container):f.insertAfter(this.$element),this.$element.trigger("inserted.bs."+this.type);var k=this.getPosition(),l=f[0].offsetWidth,m=f[0].offsetHeight;if(j){var n=h,o=this.getPosition(this.$viewport);h="bottom"==h&&k.bottom+m>o.bottom?"top":"top"==h&&k.top-m<o.top?"bottom":"right"==h&&k.right+l>o.width?"left":"left"==h&&k.left-l<o.left?"right":h,f.removeClass(n).addClass(h)}var p=this.getCalculatedOffset(h,k,l,m);this.applyPlacement(p,h);var q=function(){var a=e.hoverState;e.$element.trigger("shown.bs."+e.type),e.hoverState=null,"out"==a&&e.leave(e)};a.support.transition&&this.$tip.hasClass("fade")?f.one("bsTransitionEnd",q).emulateTransitionEnd(c.TRANSITION_DURATION):q()}},c.prototype.applyPlacement=function(b,c){var d=this.tip(),e=d[0].offsetWidth,f=d[0].offsetHeight,g=parseInt(d.css("margin-top"),10),h=parseInt(d.css("margin-left"),10);isNaN(g)&&(g=0),isNaN(h)&&(h=0),b.top+=g,b.left+=h,a.offset.setOffset(d[0],a.extend({using:function(a){d.css({top:Math.round(a.top),left:Math.round(a.left)})}},b),0),d.addClass("in");var i=d[0].offsetWidth,j=d[0].offsetHeight;"top"==c&&j!=f&&(b.top=b.top+f-j);var k=this.getViewportAdjustedDelta(c,b,i,j);k.left?b.left+=k.left:b.top+=k.top;var l=/top|bottom/.test(c),m=l?2*k.left-e+i:2*k.top-f+j,n=l?"offsetWidth":"offsetHeight";d.offset(b),this.replaceArrow(m,d[0][n],l)},c.prototype.replaceArrow=function(a,b,c){this.arrow().css(c?"left":"top",50*(1-a/b)+"%").css(c?"top":"left","")},c.prototype.setContent=function(){var a=this.tip(),b=this.getTitle();a.find(".tooltip-inner")[this.options.html?"html":"text"](b),a.removeClass("fade in top bottom left right")},c.prototype.hide=function(b){function d(){"in"!=e.hoverState&&f.detach(),e.$element.removeAttr("aria-describedby").trigger("hidden.bs."+e.type),b&&b()}var e=this,f=a(this.$tip),g=a.Event("hide.bs."+this.type);return this.$element.trigger(g),g.isDefaultPrevented()?void 0:(f.removeClass("in"),a.support.transition&&f.hasClass("fade")?f.one("bsTransitionEnd",d).emulateTransitionEnd(c.TRANSITION_DURATION):d(),this.hoverState=null,this)},c.prototype.fixTitle=function(){var a=this.$element;(a.attr("title")||"string"!=typeof a.attr("data-original-title"))&&a.attr("data-original-title",a.attr("title")||"").attr("title","")},c.prototype.hasContent=function(){return this.getTitle()},c.prototype.getPosition=function(b){b=b||this.$element;var c=b[0],d="BODY"==c.tagName,e=c.getBoundingClientRect();null==e.width&&(e=a.extend({},e,{width:e.right-e.left,height:e.bottom-e.top}));var f=d?{top:0,left:0}:b.offset(),g={scroll:d?document.documentElement.scrollTop||document.body.scrollTop:b.scrollTop()},h=d?{width:a(window).width(),height:a(window).height()}:null;return a.extend({},e,g,h,f)},c.prototype.getCalculatedOffset=function(a,b,c,d){return"bottom"==a?{top:b.top+b.height,left:b.left+b.width/2-c/2}:"top"==a?{top:b.top-d,left:b.left+b.width/2-c/2}:"left"==a?{top:b.top+b.height/2-d/2,left:b.left-c}:{top:b.top+b.height/2-d/2,left:b.left+b.width}},c.prototype.getViewportAdjustedDelta=function(a,b,c,d){var e={top:0,left:0};if(!this.$viewport)return e;var f=this.options.viewport&&this.options.viewport.padding||0,g=this.getPosition(this.$viewport);if(/right|left/.test(a)){var h=b.top-f-g.scroll,i=b.top+f-g.scroll+d;h<g.top?e.top=g.top-h:i>g.top+g.height&&(e.top=g.top+g.height-i)}else{var j=b.left-f,k=b.left+f+c;j<g.left?e.left=g.left-j:k>g.right&&(e.left=g.left+g.width-k)}return e},c.prototype.getTitle=function(){var a,b=this.$element,c=this.options;return a=b.attr("data-original-title")||("function"==typeof c.title?c.title.call(b[0]):c.title)},c.prototype.getUID=function(a){do a+=~~(1e6*Math.random());while(document.getElementById(a));return a},c.prototype.tip=function(){if(!this.$tip&&(this.$tip=a(this.options.template),1!=this.$tip.length))throw new Error(this.type+" `template` option must consist of exactly 1 top-level element!");return this.$tip},c.prototype.arrow=function(){return this.$arrow=this.$arrow||this.tip().find(".tooltip-arrow")},c.prototype.enable=function(){this.enabled=!0},c.prototype.disable=function(){this.enabled=!1},c.prototype.toggleEnabled=function(){this.enabled=!this.enabled},c.prototype.toggle=function(b){var c=this;b&&(c=a(b.currentTarget).data("bs."+this.type),c||(c=new this.constructor(b.currentTarget,this.getDelegateOptions()),a(b.currentTarget).data("bs."+this.type,c))),b?(c.inState.click=!c.inState.click,c.isInStateTrue()?c.enter(c):c.leave(c)):c.tip().hasClass("in")?c.leave(c):c.enter(c)},c.prototype.destroy=function(){var a=this;clearTimeout(this.timeout),this.hide(function(){a.$element.off("."+a.type).removeData("bs."+a.type),a.$tip&&a.$tip.detach(),a.$tip=null,a.$arrow=null,a.$viewport=null})};var d=a.fn.tooltip;a.fn.tooltip=b,a.fn.tooltip.Constructor=c,a.fn.tooltip.noConflict=function(){return a.fn.tooltip=d,this}}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.popover"),f="object"==typeof b&&b;(e||!/destroy|hide/.test(b))&&(e||d.data("bs.popover",e=new c(this,f)),"string"==typeof b&&e[b]())})}var c=function(a,b){this.init("popover",a,b)};if(!a.fn.tooltip)throw new Error("Popover requires tooltip.js");c.VERSION="3.3.5",c.DEFAULTS=a.extend({},a.fn.tooltip.Constructor.DEFAULTS,{placement:"right",trigger:"click",content:"",template:'<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'}),c.prototype=a.extend({},a.fn.tooltip.Constructor.prototype),c.prototype.constructor=c,c.prototype.getDefaults=function(){return c.DEFAULTS},c.prototype.setContent=function(){var a=this.tip(),b=this.getTitle(),c=this.getContent();a.find(".popover-title")[this.options.html?"html":"text"](b),a.find(".popover-content").children().detach().end()[this.options.html?"string"==typeof c?"html":"append":"text"](c),a.removeClass("fade top bottom left right in"),a.find(".popover-title").html()||a.find(".popover-title").hide()},c.prototype.hasContent=function(){return this.getTitle()||this.getContent()},c.prototype.getContent=function(){var a=this.$element,b=this.options;return a.attr("data-content")||("function"==typeof b.content?b.content.call(a[0]):b.content)},c.prototype.arrow=function(){return this.$arrow=this.$arrow||this.tip().find(".arrow")};var d=a.fn.popover;a.fn.popover=b,a.fn.popover.Constructor=c,a.fn.popover.noConflict=function(){return a.fn.popover=d,this}}(jQuery),+function(a){"use strict";function b(c,d){this.$body=a(document.body),this.$scrollElement=a(a(c).is(document.body)?window:c),this.options=a.extend({},b.DEFAULTS,d),this.selector=(this.options.target||"")+" .nav li > a",this.offsets=[],this.targets=[],this.activeTarget=null,this.scrollHeight=0,this.$scrollElement.on("scroll.bs.scrollspy",a.proxy(this.process,this)),this.refresh(),this.process()}function c(c){return this.each(function(){var d=a(this),e=d.data("bs.scrollspy"),f="object"==typeof c&&c;e||d.data("bs.scrollspy",e=new b(this,f)),"string"==typeof c&&e[c]()})}b.VERSION="3.3.5",b.DEFAULTS={offset:10},b.prototype.getScrollHeight=function(){return this.$scrollElement[0].scrollHeight||Math.max(this.$body[0].scrollHeight,document.documentElement.scrollHeight)},b.prototype.refresh=function(){var b=this,c="offset",d=0;this.offsets=[],this.targets=[],this.scrollHeight=this.getScrollHeight(),a.isWindow(this.$scrollElement[0])||(c="position",d=this.$scrollElement.scrollTop()),this.$body.find(this.selector).map(function(){var b=a(this),e=b.data("target")||b.attr("href"),f=/^#./.test(e)&&a(e);return f&&f.length&&f.is(":visible")&&[[f[c]().top+d,e]]||null}).sort(function(a,b){return a[0]-b[0]}).each(function(){b.offsets.push(this[0]),b.targets.push(this[1])})},b.prototype.process=function(){var a,b=this.$scrollElement.scrollTop()+this.options.offset,c=this.getScrollHeight(),d=this.options.offset+c-this.$scrollElement.height(),e=this.offsets,f=this.targets,g=this.activeTarget;if(this.scrollHeight!=c&&this.refresh(),b>=d)return g!=(a=f[f.length-1])&&this.activate(a);if(g&&b<e[0])return this.activeTarget=null,this.clear();for(a=e.length;a--;)g!=f[a]&&b>=e[a]&&(void 0===e[a+1]||b<e[a+1])&&this.activate(f[a])},b.prototype.activate=function(b){this.activeTarget=b,this.clear();var c=this.selector+'[data-target="'+b+'"],'+this.selector+'[href="'+b+'"]',d=a(c).parents("li").addClass("active");d.parent(".dropdown-menu").length&&(d=d.closest("li.dropdown").addClass("active")),
d.trigger("activate.bs.scrollspy")},b.prototype.clear=function(){a(this.selector).parentsUntil(this.options.target,".active").removeClass("active")};var d=a.fn.scrollspy;a.fn.scrollspy=c,a.fn.scrollspy.Constructor=b,a.fn.scrollspy.noConflict=function(){return a.fn.scrollspy=d,this},a(window).on("load.bs.scrollspy.data-api",function(){a('[data-spy="scroll"]').each(function(){var b=a(this);c.call(b,b.data())})})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.tab");e||d.data("bs.tab",e=new c(this)),"string"==typeof b&&e[b]()})}var c=function(b){this.element=a(b)};c.VERSION="3.3.5",c.TRANSITION_DURATION=150,c.prototype.show=function(){var b=this.element,c=b.closest("ul:not(.dropdown-menu)"),d=b.data("target");if(d||(d=b.attr("href"),d=d&&d.replace(/.*(?=#[^\s]*$)/,"")),!b.parent("li").hasClass("active")){var e=c.find(".active:last a"),f=a.Event("hide.bs.tab",{relatedTarget:b[0]}),g=a.Event("show.bs.tab",{relatedTarget:e[0]});if(e.trigger(f),b.trigger(g),!g.isDefaultPrevented()&&!f.isDefaultPrevented()){var h=a(d);this.activate(b.closest("li"),c),this.activate(h,h.parent(),function(){e.trigger({type:"hidden.bs.tab",relatedTarget:b[0]}),b.trigger({type:"shown.bs.tab",relatedTarget:e[0]})})}}},c.prototype.activate=function(b,d,e){function f(){g.removeClass("active").find("> .dropdown-menu > .active").removeClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded",!1),b.addClass("active").find('[data-toggle="tab"]').attr("aria-expanded",!0),h?(b[0].offsetWidth,b.addClass("in")):b.removeClass("fade"),b.parent(".dropdown-menu").length&&b.closest("li.dropdown").addClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded",!0),e&&e()}var g=d.find("> .active"),h=e&&a.support.transition&&(g.length&&g.hasClass("fade")||!!d.find("> .fade").length);g.length&&h?g.one("bsTransitionEnd",f).emulateTransitionEnd(c.TRANSITION_DURATION):f(),g.removeClass("in")};var d=a.fn.tab;a.fn.tab=b,a.fn.tab.Constructor=c,a.fn.tab.noConflict=function(){return a.fn.tab=d,this};var e=function(c){c.preventDefault(),b.call(a(this),"show")};a(document).on("click.bs.tab.data-api",'[data-toggle="tab"]',e).on("click.bs.tab.data-api",'[data-toggle="pill"]',e)}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.affix"),f="object"==typeof b&&b;e||d.data("bs.affix",e=new c(this,f)),"string"==typeof b&&e[b]()})}var c=function(b,d){this.options=a.extend({},c.DEFAULTS,d),this.$target=a(this.options.target).on("scroll.bs.affix.data-api",a.proxy(this.checkPosition,this)).on("click.bs.affix.data-api",a.proxy(this.checkPositionWithEventLoop,this)),this.$element=a(b),this.affixed=null,this.unpin=null,this.pinnedOffset=null,this.checkPosition()};c.VERSION="3.3.5",c.RESET="affix affix-top affix-bottom",c.DEFAULTS={offset:0,target:window},c.prototype.getState=function(a,b,c,d){var e=this.$target.scrollTop(),f=this.$element.offset(),g=this.$target.height();if(null!=c&&"top"==this.affixed)return c>e?"top":!1;if("bottom"==this.affixed)return null!=c?e+this.unpin<=f.top?!1:"bottom":a-d>=e+g?!1:"bottom";var h=null==this.affixed,i=h?e:f.top,j=h?g:b;return null!=c&&c>=e?"top":null!=d&&i+j>=a-d?"bottom":!1},c.prototype.getPinnedOffset=function(){if(this.pinnedOffset)return this.pinnedOffset;this.$element.removeClass(c.RESET).addClass("affix");var a=this.$target.scrollTop(),b=this.$element.offset();return this.pinnedOffset=b.top-a},c.prototype.checkPositionWithEventLoop=function(){setTimeout(a.proxy(this.checkPosition,this),1)},c.prototype.checkPosition=function(){if(this.$element.is(":visible")){var b=this.$element.height(),d=this.options.offset,e=d.top,f=d.bottom,g=Math.max(a(document).height(),a(document.body).height());"object"!=typeof d&&(f=e=d),"function"==typeof e&&(e=d.top(this.$element)),"function"==typeof f&&(f=d.bottom(this.$element));var h=this.getState(g,b,e,f);if(this.affixed!=h){null!=this.unpin&&this.$element.css("top","");var i="affix"+(h?"-"+h:""),j=a.Event(i+".bs.affix");if(this.$element.trigger(j),j.isDefaultPrevented())return;this.affixed=h,this.unpin="bottom"==h?this.getPinnedOffset():null,this.$element.removeClass(c.RESET).addClass(i).trigger(i.replace("affix","affixed")+".bs.affix")}"bottom"==h&&this.$element.offset({top:g-b-f})}};var d=a.fn.affix;a.fn.affix=b,a.fn.affix.Constructor=c,a.fn.affix.noConflict=function(){return a.fn.affix=d,this},a(window).on("load",function(){a('[data-spy="affix"]').each(function(){var c=a(this),d=c.data();d.offset=d.offset||{},null!=d.offsetBottom&&(d.offset.bottom=d.offsetBottom),null!=d.offsetTop&&(d.offset.top=d.offsetTop),b.call(c,d)})})}(jQuery);

/*
|--------------------------------------------------------------------------
| Generals
|--------------------------------------------------------------------------
*/

$(function() {
    $(".non-form-btn").bind("click", function(e){
        e.preventDefault();
    });

    $(".delete-btn").bind("click", function(e){
        e.preventDefault();
        $('#deleteModal').modal('toggle');
        var _parentForm = $(this).parent('form');
        $('#deleteBtn').bind('click', function(){
            _parentForm[0].submit();
        });
    });

    $(".delete-link-btn").bind("click", function(e){
        e.preventDefault();
        $('#deleteLinkModal').modal('toggle');
        var _parentForm = $(this).parent('form');
        $('#deleteLinkBtn').bind('click', function(){
            _parentForm[0].submit();
        });
    });

    $(".delete-btn-confirm").bind("click", function(e){
        e.preventDefault();
    });

    $('form.add, form.edit').submit(function(){
        $('.loading-overlay').show();
    });

    $('a.slow-link').click(function(){
        $('.loading-overlay').show();
    });

    $("#gondolynLoginPanel").bind("click", function(e) {
        e.preventDefault();
        gondolynModal();
        showLoginPanel();
    });

    $(".gondolyn-modal").bind("click", function(){
        $(".gondolyn-modal").fadeOut();
        $(".gondolyn-login").removeClass("gondolyn-login-animate");
    });

    $(window).resize(function(){
        _setDashboard();
    });

    _setDashboard();
});

/*
|--------------------------------------------------------------------------
| Notifications - Growl Style
|--------------------------------------------------------------------------
*/

function quarxNotify(message, _type) {
    $(".gondolyn-notification").css("display", "block");
    $(".gondolyn-notification").addClass(_type);

    $(".gondolyn-notify-comment").html(message);
    $(".gondolyn-notification").animate({
        right: "20px",
    });

    $(".gondolyn-notify-closer-icon").click(function(){
        $(".gondolyn-notification").animate({
            right: "-300px"
        },"", function(){
            $(".gondolyn-notification").css("display", "none");
            $(".gondolyn-notify-comment").html("");
        });
    });

    setTimeout(function(){
        $(".gondolyn-notification").animate({
            right: "-300px"
        },"", function(){
            $(".gondolyn-notification").css("display", "none");
            $(".gondolyn-notify-comment").html("");
        });
    }, 8000);
}

/*
|--------------------------------------------------------------------------
| Modal Screen
|--------------------------------------------------------------------------
*/

function gondolynModal() {
    $(".gondolyn-modal").fadeIn();
}

/*
|--------------------------------------------------------------------------
| Twitter Typeahead - Taken straight from Twitter's docs
|--------------------------------------------------------------------------
*/

var typeaheadMatcher = function(strs) {
    return function findMatches(q, cb) {
        var matches, substringRegex;

        // an array that will be populated with substring matches
        matches = [];

        // regex used to determine if a string contains the substring `q`
        substrRegex = new RegExp(q, 'i');

        // iterate through the pool of strings and for any string that
        // contains the substring `q`, add it to the `matches` array
        $.each(strs, function(i, str) {
            if (substrRegex.test(str)) {
                matches.push(str);
            }
        });

        cb(matches);
    };
};

/*
|--------------------------------------------------------------------------
| Quarx JS
|--------------------------------------------------------------------------
*/

var _redactorConfig = {
    toolbar: true,
    visual: true,
    minHeight: 175,
    convertVideoLinks: true,
    imageUpload: true,
    buttonSource: true,
    replaceDivs: false,
    paragraphize: false,
    pastePlaintext: true,
    deniedTags: ['script'],
    imageManagerJson: _url+'/quarx/api/images/list',
    fileManagerJson: _url+'/quarx/api/files/list',
    stockImageManagerJson: 'https://pixabay.com/api/',
    plugins: ['table','video', 'fontcolor', 'imagemanager', 'stockimagemanager', 'filemanager', 'specialchar'],
    buttons: ['html', 'formatting', 'fontcolor', 'bold', 'italic', 'underline', 'deleted', 'unorderedlist', 'orderedlist',
          'outdent', 'indent', 'image', 'filemanager', 'stockimagemanager', 'video', 'link', 'alignment', 'horizontalrule'], // + 'underline'
};

$(window).load(function() {

    $('.pull-down').each(function() {
        var height = 300 - $(this).siblings('.thumbnail').height() - $(this).height() - 48;
        $(this).css('margin-top', height);
    });

    $('textarea.redactor').redactor(_redactorConfig);
});

$(function(){
    function _urlPrepare (title) {
        return title.replace(/[^\w\s]/gi, '').replace(/ /g, '-').toLowerCase();
    }

    $('#Title, #Name').bind('keyup', function() {
        $('#Url').val(_urlPrepare($(this).val()));
    });

    $('.timepicker').datetimepicker({ format: 'LT' });
    $('.datepicker').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    $('.datetimepicker').datetimepicker({
        showTodayButton: true,
        format: 'YYYY-MM-DD h:m:s'
    });

    $('.tags').tagsinput();
});

/*!
 * typeahead.js 0.11.1
 * https://github.com/twitter/typeahead.js
 * Copyright 2013-2015 Twitter, Inc. and other contributors; Licensed MIT
 */

(function(root, factory) {
    if (typeof define === "function" && define.amd) {
        define("bloodhound", [ "jquery" ], function(a0) {
            return root["Bloodhound"] = factory(a0);
        });
    } else if (typeof exports === "object") {
        module.exports = factory(require("jquery"));
    } else {
        root["Bloodhound"] = factory(jQuery);
    }
})(this, function($) {
    var _ = function() {
        "use strict";
        return {
            isMsie: function() {
                return /(msie|trident)/i.test(navigator.userAgent) ? navigator.userAgent.match(/(msie |rv:)(\d+(.\d+)?)/i)[2] : false;
            },
            isBlankString: function(str) {
                return !str || /^\s*$/.test(str);
            },
            escapeRegExChars: function(str) {
                return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
            },
            isString: function(obj) {
                return typeof obj === "string";
            },
            isNumber: function(obj) {
                return typeof obj === "number";
            },
            isArray: $.isArray,
            isFunction: $.isFunction,
            isObject: $.isPlainObject,
            isUndefined: function(obj) {
                return typeof obj === "undefined";
            },
            isElement: function(obj) {
                return !!(obj && obj.nodeType === 1);
            },
            isJQuery: function(obj) {
                return obj instanceof $;
            },
            toStr: function toStr(s) {
                return _.isUndefined(s) || s === null ? "" : s + "";
            },
            bind: $.proxy,
            each: function(collection, cb) {
                $.each(collection, reverseArgs);
                function reverseArgs(index, value) {
                    return cb(value, index);
                }
            },
            map: $.map,
            filter: $.grep,
            every: function(obj, test) {
                var result = true;
                if (!obj) {
                    return result;
                }
                $.each(obj, function(key, val) {
                    if (!(result = test.call(null, val, key, obj))) {
                        return false;
                    }
                });
                return !!result;
            },
            some: function(obj, test) {
                var result = false;
                if (!obj) {
                    return result;
                }
                $.each(obj, function(key, val) {
                    if (result = test.call(null, val, key, obj)) {
                        return false;
                    }
                });
                return !!result;
            },
            mixin: $.extend,
            identity: function(x) {
                return x;
            },
            clone: function(obj) {
                return $.extend(true, {}, obj);
            },
            getIdGenerator: function() {
                var counter = 0;
                return function() {
                    return counter++;
                };
            },
            templatify: function templatify(obj) {
                return $.isFunction(obj) ? obj : template;
                function template() {
                    return String(obj);
                }
            },
            defer: function(fn) {
                setTimeout(fn, 0);
            },
            debounce: function(func, wait, immediate) {
                var timeout, result;
                return function() {
                    var context = this, args = arguments, later, callNow;
                    later = function() {
                        timeout = null;
                        if (!immediate) {
                            result = func.apply(context, args);
                        }
                    };
                    callNow = immediate && !timeout;
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                    if (callNow) {
                        result = func.apply(context, args);
                    }
                    return result;
                };
            },
            throttle: function(func, wait) {
                var context, args, timeout, result, previous, later;
                previous = 0;
                later = function() {
                    previous = new Date();
                    timeout = null;
                    result = func.apply(context, args);
                };
                return function() {
                    var now = new Date(), remaining = wait - (now - previous);
                    context = this;
                    args = arguments;
                    if (remaining <= 0) {
                        clearTimeout(timeout);
                        timeout = null;
                        previous = now;
                        result = func.apply(context, args);
                    } else if (!timeout) {
                        timeout = setTimeout(later, remaining);
                    }
                    return result;
                };
            },
            stringify: function(val) {
                return _.isString(val) ? val : JSON.stringify(val);
            },
            noop: function() {}
        };
    }();
    var VERSION = "0.11.1";
    var tokenizers = function() {
        "use strict";
        return {
            nonword: nonword,
            whitespace: whitespace,
            obj: {
                nonword: getObjTokenizer(nonword),
                whitespace: getObjTokenizer(whitespace)
            }
        };
        function whitespace(str) {
            str = _.toStr(str);
            return str ? str.split(/\s+/) : [];
        }
        function nonword(str) {
            str = _.toStr(str);
            return str ? str.split(/\W+/) : [];
        }
        function getObjTokenizer(tokenizer) {
            return function setKey(keys) {
                keys = _.isArray(keys) ? keys : [].slice.call(arguments, 0);
                return function tokenize(o) {
                    var tokens = [];
                    _.each(keys, function(k) {
                        tokens = tokens.concat(tokenizer(_.toStr(o[k])));
                    });
                    return tokens;
                };
            };
        }
    }();
    var LruCache = function() {
        "use strict";
        function LruCache(maxSize) {
            this.maxSize = _.isNumber(maxSize) ? maxSize : 100;
            this.reset();
            if (this.maxSize <= 0) {
                this.set = this.get = $.noop;
            }
        }
        _.mixin(LruCache.prototype, {
            set: function set(key, val) {
                var tailItem = this.list.tail, node;
                if (this.size >= this.maxSize) {
                    this.list.remove(tailItem);
                    delete this.hash[tailItem.key];
                    this.size--;
                }
                if (node = this.hash[key]) {
                    node.val = val;
                    this.list.moveToFront(node);
                } else {
                    node = new Node(key, val);
                    this.list.add(node);
                    this.hash[key] = node;
                    this.size++;
                }
            },
            get: function get(key) {
                var node = this.hash[key];
                if (node) {
                    this.list.moveToFront(node);
                    return node.val;
                }
            },
            reset: function reset() {
                this.size = 0;
                this.hash = {};
                this.list = new List();
            }
        });
        function List() {
            this.head = this.tail = null;
        }
        _.mixin(List.prototype, {
            add: function add(node) {
                if (this.head) {
                    node.next = this.head;
                    this.head.prev = node;
                }
                this.head = node;
                this.tail = this.tail || node;
            },
            remove: function remove(node) {
                node.prev ? node.prev.next = node.next : this.head = node.next;
                node.next ? node.next.prev = node.prev : this.tail = node.prev;
            },
            moveToFront: function(node) {
                this.remove(node);
                this.add(node);
            }
        });
        function Node(key, val) {
            this.key = key;
            this.val = val;
            this.prev = this.next = null;
        }
        return LruCache;
    }();
    var PersistentStorage = function() {
        "use strict";
        var LOCAL_STORAGE;
        try {
            LOCAL_STORAGE = window.localStorage;
            LOCAL_STORAGE.setItem("~~~", "!");
            LOCAL_STORAGE.removeItem("~~~");
        } catch (err) {
            LOCAL_STORAGE = null;
        }
        function PersistentStorage(namespace, override) {
            this.prefix = [ "__", namespace, "__" ].join("");
            this.ttlKey = "__ttl__";
            this.keyMatcher = new RegExp("^" + _.escapeRegExChars(this.prefix));
            this.ls = override || LOCAL_STORAGE;
            !this.ls && this._noop();
        }
        _.mixin(PersistentStorage.prototype, {
            _prefix: function(key) {
                return this.prefix + key;
            },
            _ttlKey: function(key) {
                return this._prefix(key) + this.ttlKey;
            },
            _noop: function() {
                this.get = this.set = this.remove = this.clear = this.isExpired = _.noop;
            },
            _safeSet: function(key, val) {
                try {
                    this.ls.setItem(key, val);
                } catch (err) {
                    if (err.name === "QuotaExceededError") {
                        this.clear();
                        this._noop();
                    }
                }
            },
            get: function(key) {
                if (this.isExpired(key)) {
                    this.remove(key);
                }
                return decode(this.ls.getItem(this._prefix(key)));
            },
            set: function(key, val, ttl) {
                if (_.isNumber(ttl)) {
                    this._safeSet(this._ttlKey(key), encode(now() + ttl));
                } else {
                    this.ls.removeItem(this._ttlKey(key));
                }
                return this._safeSet(this._prefix(key), encode(val));
            },
            remove: function(key) {
                this.ls.removeItem(this._ttlKey(key));
                this.ls.removeItem(this._prefix(key));
                return this;
            },
            clear: function() {
                var i, keys = gatherMatchingKeys(this.keyMatcher);
                for (i = keys.length; i--; ) {
                    this.remove(keys[i]);
                }
                return this;
            },
            isExpired: function(key) {
                var ttl = decode(this.ls.getItem(this._ttlKey(key)));
                return _.isNumber(ttl) && now() > ttl ? true : false;
            }
        });
        return PersistentStorage;
        function now() {
            return new Date().getTime();
        }
        function encode(val) {
            return JSON.stringify(_.isUndefined(val) ? null : val);
        }
        function decode(val) {
            return $.parseJSON(val);
        }
        function gatherMatchingKeys(keyMatcher) {
            var i, key, keys = [], len = LOCAL_STORAGE.length;
            for (i = 0; i < len; i++) {
                if ((key = LOCAL_STORAGE.key(i)).match(keyMatcher)) {
                    keys.push(key.replace(keyMatcher, ""));
                }
            }
            return keys;
        }
    }();
    var Transport = function() {
        "use strict";
        var pendingRequestsCount = 0, pendingRequests = {}, maxPendingRequests = 6, sharedCache = new LruCache(10);
        function Transport(o) {
            o = o || {};
            this.cancelled = false;
            this.lastReq = null;
            this._send = o.transport;
            this._get = o.limiter ? o.limiter(this._get) : this._get;
            this._cache = o.cache === false ? new LruCache(0) : sharedCache;
        }
        Transport.setMaxPendingRequests = function setMaxPendingRequests(num) {
            maxPendingRequests = num;
        };
        Transport.resetCache = function resetCache() {
            sharedCache.reset();
        };
        _.mixin(Transport.prototype, {
            _fingerprint: function fingerprint(o) {
                o = o || {};
                return o.url + o.type + $.param(o.data || {});
            },
            _get: function(o, cb) {
                var that = this, fingerprint, jqXhr;
                fingerprint = this._fingerprint(o);
                if (this.cancelled || fingerprint !== this.lastReq) {
                    return;
                }
                if (jqXhr = pendingRequests[fingerprint]) {
                    jqXhr.done(done).fail(fail);
                } else if (pendingRequestsCount < maxPendingRequests) {
                    pendingRequestsCount++;
                    pendingRequests[fingerprint] = this._send(o).done(done).fail(fail).always(always);
                } else {
                    this.onDeckRequestArgs = [].slice.call(arguments, 0);
                }
                function done(resp) {
                    cb(null, resp);
                    that._cache.set(fingerprint, resp);
                }
                function fail() {
                    cb(true);
                }
                function always() {
                    pendingRequestsCount--;
                    delete pendingRequests[fingerprint];
                    if (that.onDeckRequestArgs) {
                        that._get.apply(that, that.onDeckRequestArgs);
                        that.onDeckRequestArgs = null;
                    }
                }
            },
            get: function(o, cb) {
                var resp, fingerprint;
                cb = cb || $.noop;
                o = _.isString(o) ? {
                    url: o
                } : o || {};
                fingerprint = this._fingerprint(o);
                this.cancelled = false;
                this.lastReq = fingerprint;
                if (resp = this._cache.get(fingerprint)) {
                    cb(null, resp);
                } else {
                    this._get(o, cb);
                }
            },
            cancel: function() {
                this.cancelled = true;
            }
        });
        return Transport;
    }();
    var SearchIndex = window.SearchIndex = function() {
        "use strict";
        var CHILDREN = "c", IDS = "i";
        function SearchIndex(o) {
            o = o || {};
            if (!o.datumTokenizer || !o.queryTokenizer) {
                $.error("datumTokenizer and queryTokenizer are both required");
            }
            this.identify = o.identify || _.stringify;
            this.datumTokenizer = o.datumTokenizer;
            this.queryTokenizer = o.queryTokenizer;
            this.reset();
        }
        _.mixin(SearchIndex.prototype, {
            bootstrap: function bootstrap(o) {
                this.datums = o.datums;
                this.trie = o.trie;
            },
            add: function(data) {
                var that = this;
                data = _.isArray(data) ? data : [ data ];
                _.each(data, function(datum) {
                    var id, tokens;
                    that.datums[id = that.identify(datum)] = datum;
                    tokens = normalizeTokens(that.datumTokenizer(datum));
                    _.each(tokens, function(token) {
                        var node, chars, ch;
                        node = that.trie;
                        chars = token.split("");
                        while (ch = chars.shift()) {
                            node = node[CHILDREN][ch] || (node[CHILDREN][ch] = newNode());
                            node[IDS].push(id);
                        }
                    });
                });
            },
            get: function get(ids) {
                var that = this;
                return _.map(ids, function(id) {
                    return that.datums[id];
                });
            },
            search: function search(query) {
                var that = this, tokens, matches;
                tokens = normalizeTokens(this.queryTokenizer(query));
                _.each(tokens, function(token) {
                    var node, chars, ch, ids;
                    if (matches && matches.length === 0) {
                        return false;
                    }
                    node = that.trie;
                    chars = token.split("");
                    while (node && (ch = chars.shift())) {
                        node = node[CHILDREN][ch];
                    }
                    if (node && chars.length === 0) {
                        ids = node[IDS].slice(0);
                        matches = matches ? getIntersection(matches, ids) : ids;
                    } else {
                        matches = [];
                        return false;
                    }
                });
                return matches ? _.map(unique(matches), function(id) {
                    return that.datums[id];
                }) : [];
            },
            all: function all() {
                var values = [];
                for (var key in this.datums) {
                    values.push(this.datums[key]);
                }
                return values;
            },
            reset: function reset() {
                this.datums = {};
                this.trie = newNode();
            },
            serialize: function serialize() {
                return {
                    datums: this.datums,
                    trie: this.trie
                };
            }
        });
        return SearchIndex;
        function normalizeTokens(tokens) {
            tokens = _.filter(tokens, function(token) {
                return !!token;
            });
            tokens = _.map(tokens, function(token) {
                return token.toLowerCase();
            });
            return tokens;
        }
        function newNode() {
            var node = {};
            node[IDS] = [];
            node[CHILDREN] = {};
            return node;
        }
        function unique(array) {
            var seen = {}, uniques = [];
            for (var i = 0, len = array.length; i < len; i++) {
                if (!seen[array[i]]) {
                    seen[array[i]] = true;
                    uniques.push(array[i]);
                }
            }
            return uniques;
        }
        function getIntersection(arrayA, arrayB) {
            var ai = 0, bi = 0, intersection = [];
            arrayA = arrayA.sort();
            arrayB = arrayB.sort();
            var lenArrayA = arrayA.length, lenArrayB = arrayB.length;
            while (ai < lenArrayA && bi < lenArrayB) {
                if (arrayA[ai] < arrayB[bi]) {
                    ai++;
                } else if (arrayA[ai] > arrayB[bi]) {
                    bi++;
                } else {
                    intersection.push(arrayA[ai]);
                    ai++;
                    bi++;
                }
            }
            return intersection;
        }
    }();
    var Prefetch = function() {
        "use strict";
        var keys;
        keys = {
            data: "data",
            protocol: "protocol",
            thumbprint: "thumbprint"
        };
        function Prefetch(o) {
            this.url = o.url;
            this.ttl = o.ttl;
            this.cache = o.cache;
            this.prepare = o.prepare;
            this.transform = o.transform;
            this.transport = o.transport;
            this.thumbprint = o.thumbprint;
            this.storage = new PersistentStorage(o.cacheKey);
        }
        _.mixin(Prefetch.prototype, {
            _settings: function settings() {
                return {
                    url: this.url,
                    type: "GET",
                    dataType: "json"
                };
            },
            store: function store(data) {
                if (!this.cache) {
                    return;
                }
                this.storage.set(keys.data, data, this.ttl);
                this.storage.set(keys.protocol, location.protocol, this.ttl);
                this.storage.set(keys.thumbprint, this.thumbprint, this.ttl);
            },
            fromCache: function fromCache() {
                var stored = {}, isExpired;
                if (!this.cache) {
                    return null;
                }
                stored.data = this.storage.get(keys.data);
                stored.protocol = this.storage.get(keys.protocol);
                stored.thumbprint = this.storage.get(keys.thumbprint);
                isExpired = stored.thumbprint !== this.thumbprint || stored.protocol !== location.protocol;
                return stored.data && !isExpired ? stored.data : null;
            },
            fromNetwork: function(cb) {
                var that = this, settings;
                if (!cb) {
                    return;
                }
                settings = this.prepare(this._settings());
                this.transport(settings).fail(onError).done(onResponse);
                function onError() {
                    cb(true);
                }
                function onResponse(resp) {
                    cb(null, that.transform(resp));
                }
            },
            clear: function clear() {
                this.storage.clear();
                return this;
            }
        });
        return Prefetch;
    }();
    var Remote = function() {
        "use strict";
        function Remote(o) {
            this.url = o.url;
            this.prepare = o.prepare;
            this.transform = o.transform;
            this.transport = new Transport({
                cache: o.cache,
                limiter: o.limiter,
                transport: o.transport
            });
        }
        _.mixin(Remote.prototype, {
            _settings: function settings() {
                return {
                    url: this.url,
                    type: "GET",
                    dataType: "json"
                };
            },
            get: function get(query, cb) {
                var that = this, settings;
                if (!cb) {
                    return;
                }
                query = query || "";
                settings = this.prepare(query, this._settings());
                return this.transport.get(settings, onResponse);
                function onResponse(err, resp) {
                    err ? cb([]) : cb(that.transform(resp));
                }
            },
            cancelLastRequest: function cancelLastRequest() {
                this.transport.cancel();
            }
        });
        return Remote;
    }();
    var oParser = function() {
        "use strict";
        return function parse(o) {
            var defaults, sorter;
            defaults = {
                initialize: true,
                identify: _.stringify,
                datumTokenizer: null,
                queryTokenizer: null,
                sufficient: 5,
                sorter: null,
                local: [],
                prefetch: null,
                remote: null
            };
            o = _.mixin(defaults, o || {});
            !o.datumTokenizer && $.error("datumTokenizer is required");
            !o.queryTokenizer && $.error("queryTokenizer is required");
            sorter = o.sorter;
            o.sorter = sorter ? function(x) {
                return x.sort(sorter);
            } : _.identity;
            o.local = _.isFunction(o.local) ? o.local() : o.local;
            o.prefetch = parsePrefetch(o.prefetch);
            o.remote = parseRemote(o.remote);
            return o;
        };
        function parsePrefetch(o) {
            var defaults;
            if (!o) {
                return null;
            }
            defaults = {
                url: null,
                ttl: 24 * 60 * 60 * 1e3,
                cache: true,
                cacheKey: null,
                thumbprint: "",
                prepare: _.identity,
                transform: _.identity,
                transport: null
            };
            o = _.isString(o) ? {
                url: o
            } : o;
            o = _.mixin(defaults, o);
            !o.url && $.error("prefetch requires url to be set");
            o.transform = o.filter || o.transform;
            o.cacheKey = o.cacheKey || o.url;
            o.thumbprint = VERSION + o.thumbprint;
            o.transport = o.transport ? callbackToDeferred(o.transport) : $.ajax;
            return o;
        }
        function parseRemote(o) {
            var defaults;
            if (!o) {
                return;
            }
            defaults = {
                url: null,
                cache: true,
                prepare: null,
                replace: null,
                wildcard: null,
                limiter: null,
                rateLimitBy: "debounce",
                rateLimitWait: 300,
                transform: _.identity,
                transport: null
            };
            o = _.isString(o) ? {
                url: o
            } : o;
            o = _.mixin(defaults, o);
            !o.url && $.error("remote requires url to be set");
            o.transform = o.filter || o.transform;
            o.prepare = toRemotePrepare(o);
            o.limiter = toLimiter(o);
            o.transport = o.transport ? callbackToDeferred(o.transport) : $.ajax;
            delete o.replace;
            delete o.wildcard;
            delete o.rateLimitBy;
            delete o.rateLimitWait;
            return o;
        }
        function toRemotePrepare(o) {
            var prepare, replace, wildcard;
            prepare = o.prepare;
            replace = o.replace;
            wildcard = o.wildcard;
            if (prepare) {
                return prepare;
            }
            if (replace) {
                prepare = prepareByReplace;
            } else if (o.wildcard) {
                prepare = prepareByWildcard;
            } else {
                prepare = idenityPrepare;
            }
            return prepare;
            function prepareByReplace(query, settings) {
                settings.url = replace(settings.url, query);
                return settings;
            }
            function prepareByWildcard(query, settings) {
                settings.url = settings.url.replace(wildcard, encodeURIComponent(query));
                return settings;
            }
            function idenityPrepare(query, settings) {
                return settings;
            }
        }
        function toLimiter(o) {
            var limiter, method, wait;
            limiter = o.limiter;
            method = o.rateLimitBy;
            wait = o.rateLimitWait;
            if (!limiter) {
                limiter = /^throttle$/i.test(method) ? throttle(wait) : debounce(wait);
            }
            return limiter;
            function debounce(wait) {
                return function debounce(fn) {
                    return _.debounce(fn, wait);
                };
            }
            function throttle(wait) {
                return function throttle(fn) {
                    return _.throttle(fn, wait);
                };
            }
        }
        function callbackToDeferred(fn) {
            return function wrapper(o) {
                var deferred = $.Deferred();
                fn(o, onSuccess, onError);
                return deferred;
                function onSuccess(resp) {
                    _.defer(function() {
                        deferred.resolve(resp);
                    });
                }
                function onError(err) {
                    _.defer(function() {
                        deferred.reject(err);
                    });
                }
            };
        }
    }();
    var Bloodhound = function() {
        "use strict";
        var old;
        old = window && window.Bloodhound;
        function Bloodhound(o) {
            o = oParser(o);
            this.sorter = o.sorter;
            this.identify = o.identify;
            this.sufficient = o.sufficient;
            this.local = o.local;
            this.remote = o.remote ? new Remote(o.remote) : null;
            this.prefetch = o.prefetch ? new Prefetch(o.prefetch) : null;
            this.index = new SearchIndex({
                identify: this.identify,
                datumTokenizer: o.datumTokenizer,
                queryTokenizer: o.queryTokenizer
            });
            o.initialize !== false && this.initialize();
        }
        Bloodhound.noConflict = function noConflict() {
            window && (window.Bloodhound = old);
            return Bloodhound;
        };
        Bloodhound.tokenizers = tokenizers;
        _.mixin(Bloodhound.prototype, {
            __ttAdapter: function ttAdapter() {
                var that = this;
                return this.remote ? withAsync : withoutAsync;
                function withAsync(query, sync, async) {
                    return that.search(query, sync, async);
                }
                function withoutAsync(query, sync) {
                    return that.search(query, sync);
                }
            },
            _loadPrefetch: function loadPrefetch() {
                var that = this, deferred, serialized;
                deferred = $.Deferred();
                if (!this.prefetch) {
                    deferred.resolve();
                } else if (serialized = this.prefetch.fromCache()) {
                    this.index.bootstrap(serialized);
                    deferred.resolve();
                } else {
                    this.prefetch.fromNetwork(done);
                }
                return deferred.promise();
                function done(err, data) {
                    if (err) {
                        return deferred.reject();
                    }
                    that.add(data);
                    that.prefetch.store(that.index.serialize());
                    deferred.resolve();
                }
            },
            _initialize: function initialize() {
                var that = this, deferred;
                this.clear();
                (this.initPromise = this._loadPrefetch()).done(addLocalToIndex);
                return this.initPromise;
                function addLocalToIndex() {
                    that.add(that.local);
                }
            },
            initialize: function initialize(force) {
                return !this.initPromise || force ? this._initialize() : this.initPromise;
            },
            add: function add(data) {
                this.index.add(data);
                return this;
            },
            get: function get(ids) {
                ids = _.isArray(ids) ? ids : [].slice.call(arguments);
                return this.index.get(ids);
            },
            search: function search(query, sync, async) {
                var that = this, local;
                local = this.sorter(this.index.search(query));
                sync(this.remote ? local.slice() : local);
                if (this.remote && local.length < this.sufficient) {
                    this.remote.get(query, processRemote);
                } else if (this.remote) {
                    this.remote.cancelLastRequest();
                }
                return this;
                function processRemote(remote) {
                    var nonDuplicates = [];
                    _.each(remote, function(r) {
                        !_.some(local, function(l) {
                            return that.identify(r) === that.identify(l);
                        }) && nonDuplicates.push(r);
                    });
                    async && async(nonDuplicates);
                }
            },
            all: function all() {
                return this.index.all();
            },
            clear: function clear() {
                this.index.reset();
                return this;
            },
            clearPrefetchCache: function clearPrefetchCache() {
                this.prefetch && this.prefetch.clear();
                return this;
            },
            clearRemoteCache: function clearRemoteCache() {
                Transport.resetCache();
                return this;
            },
            ttAdapter: function ttAdapter() {
                return this.__ttAdapter();
            }
        });
        return Bloodhound;
    }();
    return Bloodhound;
});

(function(root, factory) {
    if (typeof define === "function" && define.amd) {
        define("typeahead.js", [ "jquery" ], function(a0) {
            return factory(a0);
        });
    } else if (typeof exports === "object") {
        module.exports = factory(require("jquery"));
    } else {
        factory(jQuery);
    }
})(this, function($) {
    var _ = function() {
        "use strict";
        return {
            isMsie: function() {
                return /(msie|trident)/i.test(navigator.userAgent) ? navigator.userAgent.match(/(msie |rv:)(\d+(.\d+)?)/i)[2] : false;
            },
            isBlankString: function(str) {
                return !str || /^\s*$/.test(str);
            },
            escapeRegExChars: function(str) {
                return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
            },
            isString: function(obj) {
                return typeof obj === "string";
            },
            isNumber: function(obj) {
                return typeof obj === "number";
            },
            isArray: $.isArray,
            isFunction: $.isFunction,
            isObject: $.isPlainObject,
            isUndefined: function(obj) {
                return typeof obj === "undefined";
            },
            isElement: function(obj) {
                return !!(obj && obj.nodeType === 1);
            },
            isJQuery: function(obj) {
                return obj instanceof $;
            },
            toStr: function toStr(s) {
                return _.isUndefined(s) || s === null ? "" : s + "";
            },
            bind: $.proxy,
            each: function(collection, cb) {
                $.each(collection, reverseArgs);
                function reverseArgs(index, value) {
                    return cb(value, index);
                }
            },
            map: $.map,
            filter: $.grep,
            every: function(obj, test) {
                var result = true;
                if (!obj) {
                    return result;
                }
                $.each(obj, function(key, val) {
                    if (!(result = test.call(null, val, key, obj))) {
                        return false;
                    }
                });
                return !!result;
            },
            some: function(obj, test) {
                var result = false;
                if (!obj) {
                    return result;
                }
                $.each(obj, function(key, val) {
                    if (result = test.call(null, val, key, obj)) {
                        return false;
                    }
                });
                return !!result;
            },
            mixin: $.extend,
            identity: function(x) {
                return x;
            },
            clone: function(obj) {
                return $.extend(true, {}, obj);
            },
            getIdGenerator: function() {
                var counter = 0;
                return function() {
                    return counter++;
                };
            },
            templatify: function templatify(obj) {
                return $.isFunction(obj) ? obj : template;
                function template() {
                    return String(obj);
                }
            },
            defer: function(fn) {
                setTimeout(fn, 0);
            },
            debounce: function(func, wait, immediate) {
                var timeout, result;
                return function() {
                    var context = this, args = arguments, later, callNow;
                    later = function() {
                        timeout = null;
                        if (!immediate) {
                            result = func.apply(context, args);
                        }
                    };
                    callNow = immediate && !timeout;
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                    if (callNow) {
                        result = func.apply(context, args);
                    }
                    return result;
                };
            },
            throttle: function(func, wait) {
                var context, args, timeout, result, previous, later;
                previous = 0;
                later = function() {
                    previous = new Date();
                    timeout = null;
                    result = func.apply(context, args);
                };
                return function() {
                    var now = new Date(), remaining = wait - (now - previous);
                    context = this;
                    args = arguments;
                    if (remaining <= 0) {
                        clearTimeout(timeout);
                        timeout = null;
                        previous = now;
                        result = func.apply(context, args);
                    } else if (!timeout) {
                        timeout = setTimeout(later, remaining);
                    }
                    return result;
                };
            },
            stringify: function(val) {
                return _.isString(val) ? val : JSON.stringify(val);
            },
            noop: function() {}
        };
    }();
    var WWW = function() {
        "use strict";
        var defaultClassNames = {
            wrapper: "twitter-typeahead",
            input: "tt-input",
            hint: "tt-hint",
            menu: "tt-menu",
            dataset: "tt-dataset",
            suggestion: "tt-suggestion",
            selectable: "tt-selectable",
            empty: "tt-empty",
            open: "tt-open",
            cursor: "tt-cursor",
            highlight: "tt-highlight"
        };
        return build;
        function build(o) {
            var www, classes;
            classes = _.mixin({}, defaultClassNames, o);
            www = {
                css: buildCss(),
                classes: classes,
                html: buildHtml(classes),
                selectors: buildSelectors(classes)
            };
            return {
                css: www.css,
                html: www.html,
                classes: www.classes,
                selectors: www.selectors,
                mixin: function(o) {
                    _.mixin(o, www);
                }
            };
        }
        function buildHtml(c) {
            return {
                wrapper: '<span class="' + c.wrapper + '"></span>',
                menu: '<div class="' + c.menu + '"></div>'
            };
        }
        function buildSelectors(classes) {
            var selectors = {};
            _.each(classes, function(v, k) {
                selectors[k] = "." + v;
            });
            return selectors;
        }
        function buildCss() {
            var css = {
                wrapper: {
                    position: "relative",
                    display: "inline-block"
                },
                hint: {
                    position: "absolute",
                    top: "0",
                    left: "0",
                    borderColor: "transparent",
                    boxShadow: "none",
                    opacity: "1"
                },
                input: {
                    position: "relative",
                    verticalAlign: "top",
                    backgroundColor: "transparent"
                },
                inputWithNoHint: {
                    position: "relative",
                    verticalAlign: "top"
                },
                menu: {
                    position: "absolute",
                    top: "100%",
                    left: "0",
                    zIndex: "100",
                    display: "none"
                },
                ltr: {
                    left: "0",
                    right: "auto"
                },
                rtl: {
                    left: "auto",
                    right: " 0"
                }
            };
            if (_.isMsie()) {
                _.mixin(css.input, {
                    backgroundImage: "url(data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7)"
                });
            }
            return css;
        }
    }();
    var EventBus = function() {
        "use strict";
        var namespace, deprecationMap;
        namespace = "typeahead:";
        deprecationMap = {
            render: "rendered",
            cursorchange: "cursorchanged",
            select: "selected",
            autocomplete: "autocompleted"
        };
        function EventBus(o) {
            if (!o || !o.el) {
                $.error("EventBus initialized without el");
            }
            this.$el = $(o.el);
        }
        _.mixin(EventBus.prototype, {
            _trigger: function(type, args) {
                var $e;
                $e = $.Event(namespace + type);
                (args = args || []).unshift($e);
                this.$el.trigger.apply(this.$el, args);
                return $e;
            },
            before: function(type) {
                var args, $e;
                args = [].slice.call(arguments, 1);
                $e = this._trigger("before" + type, args);
                return $e.isDefaultPrevented();
            },
            trigger: function(type) {
                var deprecatedType;
                this._trigger(type, [].slice.call(arguments, 1));
                if (deprecatedType = deprecationMap[type]) {
                    this._trigger(deprecatedType, [].slice.call(arguments, 1));
                }
            }
        });
        return EventBus;
    }();
    var EventEmitter = function() {
        "use strict";
        var splitter = /\s+/, nextTick = getNextTick();
        return {
            onSync: onSync,
            onAsync: onAsync,
            off: off,
            trigger: trigger
        };
        function on(method, types, cb, context) {
            var type;
            if (!cb) {
                return this;
            }
            types = types.split(splitter);
            cb = context ? bindContext(cb, context) : cb;
            this._callbacks = this._callbacks || {};
            while (type = types.shift()) {
                this._callbacks[type] = this._callbacks[type] || {
                    sync: [],
                    async: []
                };
                this._callbacks[type][method].push(cb);
            }
            return this;
        }
        function onAsync(types, cb, context) {
            return on.call(this, "async", types, cb, context);
        }
        function onSync(types, cb, context) {
            return on.call(this, "sync", types, cb, context);
        }
        function off(types) {
            var type;
            if (!this._callbacks) {
                return this;
            }
            types = types.split(splitter);
            while (type = types.shift()) {
                delete this._callbacks[type];
            }
            return this;
        }
        function trigger(types) {
            var type, callbacks, args, syncFlush, asyncFlush;
            if (!this._callbacks) {
                return this;
            }
            types = types.split(splitter);
            args = [].slice.call(arguments, 1);
            while ((type = types.shift()) && (callbacks = this._callbacks[type])) {
                syncFlush = getFlush(callbacks.sync, this, [ type ].concat(args));
                asyncFlush = getFlush(callbacks.async, this, [ type ].concat(args));
                syncFlush() && nextTick(asyncFlush);
            }
            return this;
        }
        function getFlush(callbacks, context, args) {
            return flush;
            function flush() {
                var cancelled;
                for (var i = 0, len = callbacks.length; !cancelled && i < len; i += 1) {
                    cancelled = callbacks[i].apply(context, args) === false;
                }
                return !cancelled;
            }
        }
        function getNextTick() {
            var nextTickFn;
            if (window.setImmediate) {
                nextTickFn = function nextTickSetImmediate(fn) {
                    setImmediate(function() {
                        fn();
                    });
                };
            } else {
                nextTickFn = function nextTickSetTimeout(fn) {
                    setTimeout(function() {
                        fn();
                    }, 0);
                };
            }
            return nextTickFn;
        }
        function bindContext(fn, context) {
            return fn.bind ? fn.bind(context) : function() {
                fn.apply(context, [].slice.call(arguments, 0));
            };
        }
    }();
    var highlight = function(doc) {
        "use strict";
        var defaults = {
            node: null,
            pattern: null,
            tagName: "strong",
            className: null,
            wordsOnly: false,
            caseSensitive: false
        };
        return function hightlight(o) {
            var regex;
            o = _.mixin({}, defaults, o);
            if (!o.node || !o.pattern) {
                return;
            }
            o.pattern = _.isArray(o.pattern) ? o.pattern : [ o.pattern ];
            regex = getRegex(o.pattern, o.caseSensitive, o.wordsOnly);
            traverse(o.node, hightlightTextNode);
            function hightlightTextNode(textNode) {
                var match, patternNode, wrapperNode;
                if (match = regex.exec(textNode.data)) {
                    wrapperNode = doc.createElement(o.tagName);
                    o.className && (wrapperNode.className = o.className);
                    patternNode = textNode.splitText(match.index);
                    patternNode.splitText(match[0].length);
                    wrapperNode.appendChild(patternNode.cloneNode(true));
                    textNode.parentNode.replaceChild(wrapperNode, patternNode);
                }
                return !!match;
            }
            function traverse(el, hightlightTextNode) {
                var childNode, TEXT_NODE_TYPE = 3;
                for (var i = 0; i < el.childNodes.length; i++) {
                    childNode = el.childNodes[i];
                    if (childNode.nodeType === TEXT_NODE_TYPE) {
                        i += hightlightTextNode(childNode) ? 1 : 0;
                    } else {
                        traverse(childNode, hightlightTextNode);
                    }
                }
            }
        };
        function getRegex(patterns, caseSensitive, wordsOnly) {
            var escapedPatterns = [], regexStr;
            for (var i = 0, len = patterns.length; i < len; i++) {
                escapedPatterns.push(_.escapeRegExChars(patterns[i]));
            }
            regexStr = wordsOnly ? "\\b(" + escapedPatterns.join("|") + ")\\b" : "(" + escapedPatterns.join("|") + ")";
            return caseSensitive ? new RegExp(regexStr) : new RegExp(regexStr, "i");
        }
    }(window.document);
    var Input = function() {
        "use strict";
        var specialKeyCodeMap;
        specialKeyCodeMap = {
            9: "tab",
            27: "esc",
            37: "left",
            39: "right",
            13: "enter",
            38: "up",
            40: "down"
        };
        function Input(o, www) {
            o = o || {};
            if (!o.input) {
                $.error("input is missing");
            }
            www.mixin(this);
            this.$hint = $(o.hint);
            this.$input = $(o.input);
            this.query = this.$input.val();
            this.queryWhenFocused = this.hasFocus() ? this.query : null;
            this.$overflowHelper = buildOverflowHelper(this.$input);
            this._checkLanguageDirection();
            if (this.$hint.length === 0) {
                this.setHint = this.getHint = this.clearHint = this.clearHintIfInvalid = _.noop;
            }
        }
        Input.normalizeQuery = function(str) {
            return _.toStr(str).replace(/^\s*/g, "").replace(/\s{2,}/g, " ");
        };
        _.mixin(Input.prototype, EventEmitter, {
            _onBlur: function onBlur() {
                this.resetInputValue();
                this.trigger("blurred");
            },
            _onFocus: function onFocus() {
                this.queryWhenFocused = this.query;
                this.trigger("focused");
            },
            _onKeydown: function onKeydown($e) {
                var keyName = specialKeyCodeMap[$e.which || $e.keyCode];
                this._managePreventDefault(keyName, $e);
                if (keyName && this._shouldTrigger(keyName, $e)) {
                    this.trigger(keyName + "Keyed", $e);
                }
            },
            _onInput: function onInput() {
                this._setQuery(this.getInputValue());
                this.clearHintIfInvalid();
                this._checkLanguageDirection();
            },
            _managePreventDefault: function managePreventDefault(keyName, $e) {
                var preventDefault;
                switch (keyName) {
                  case "up":
                  case "down":
                    preventDefault = !withModifier($e);
                    break;

                  default:
                    preventDefault = false;
                }
                preventDefault && $e.preventDefault();
            },
            _shouldTrigger: function shouldTrigger(keyName, $e) {
                var trigger;
                switch (keyName) {
                  case "tab":
                    trigger = !withModifier($e);
                    break;

                  default:
                    trigger = true;
                }
                return trigger;
            },
            _checkLanguageDirection: function checkLanguageDirection() {
                var dir = (this.$input.css("direction") || "ltr").toLowerCase();
                if (this.dir !== dir) {
                    this.dir = dir;
                    this.$hint.attr("dir", dir);
                    this.trigger("langDirChanged", dir);
                }
            },
            _setQuery: function setQuery(val, silent) {
                var areEquivalent, hasDifferentWhitespace;
                areEquivalent = areQueriesEquivalent(val, this.query);
                hasDifferentWhitespace = areEquivalent ? this.query.length !== val.length : false;
                this.query = val;
                if (!silent && !areEquivalent) {
                    this.trigger("queryChanged", this.query);
                } else if (!silent && hasDifferentWhitespace) {
                    this.trigger("whitespaceChanged", this.query);
                }
            },
            bind: function() {
                var that = this, onBlur, onFocus, onKeydown, onInput;
                onBlur = _.bind(this._onBlur, this);
                onFocus = _.bind(this._onFocus, this);
                onKeydown = _.bind(this._onKeydown, this);
                onInput = _.bind(this._onInput, this);
                this.$input.on("blur.tt", onBlur).on("focus.tt", onFocus).on("keydown.tt", onKeydown);
                if (!_.isMsie() || _.isMsie() > 9) {
                    this.$input.on("input.tt", onInput);
                } else {
                    this.$input.on("keydown.tt keypress.tt cut.tt paste.tt", function($e) {
                        if (specialKeyCodeMap[$e.which || $e.keyCode]) {
                            return;
                        }
                        _.defer(_.bind(that._onInput, that, $e));
                    });
                }
                return this;
            },
            focus: function focus() {
                this.$input.focus();
            },
            blur: function blur() {
                this.$input.blur();
            },
            getLangDir: function getLangDir() {
                return this.dir;
            },
            getQuery: function getQuery() {
                return this.query || "";
            },
            setQuery: function setQuery(val, silent) {
                this.setInputValue(val);
                this._setQuery(val, silent);
            },
            hasQueryChangedSinceLastFocus: function hasQueryChangedSinceLastFocus() {
                return this.query !== this.queryWhenFocused;
            },
            getInputValue: function getInputValue() {
                return this.$input.val();
            },
            setInputValue: function setInputValue(value) {
                this.$input.val(value);
                this.clearHintIfInvalid();
                this._checkLanguageDirection();
            },
            resetInputValue: function resetInputValue() {
                this.setInputValue(this.query);
            },
            getHint: function getHint() {
                return this.$hint.val();
            },
            setHint: function setHint(value) {
                this.$hint.val(value);
            },
            clearHint: function clearHint() {
                this.setHint("");
            },
            clearHintIfInvalid: function clearHintIfInvalid() {
                var val, hint, valIsPrefixOfHint, isValid;
                val = this.getInputValue();
                hint = this.getHint();
                valIsPrefixOfHint = val !== hint && hint.indexOf(val) === 0;
                isValid = val !== "" && valIsPrefixOfHint && !this.hasOverflow();
                !isValid && this.clearHint();
            },
            hasFocus: function hasFocus() {
                return this.$input.is(":focus");
            },
            hasOverflow: function hasOverflow() {
                var constraint = this.$input.width() - 2;
                this.$overflowHelper.text(this.getInputValue());
                return this.$overflowHelper.width() >= constraint;
            },
            isCursorAtEnd: function() {
                var valueLength, selectionStart, range;
                valueLength = this.$input.val().length;
                selectionStart = this.$input[0].selectionStart;
                if (_.isNumber(selectionStart)) {
                    return selectionStart === valueLength;
                } else if (document.selection) {
                    range = document.selection.createRange();
                    range.moveStart("character", -valueLength);
                    return valueLength === range.text.length;
                }
                return true;
            },
            destroy: function destroy() {
                this.$hint.off(".tt");
                this.$input.off(".tt");
                this.$overflowHelper.remove();
                this.$hint = this.$input = this.$overflowHelper = $("<div>");
            }
        });
        return Input;
        function buildOverflowHelper($input) {
            return $('<pre aria-hidden="true"></pre>').css({
                position: "absolute",
                visibility: "hidden",
                whiteSpace: "pre",
                fontFamily: $input.css("font-family"),
                fontSize: $input.css("font-size"),
                fontStyle: $input.css("font-style"),
                fontVariant: $input.css("font-variant"),
                fontWeight: $input.css("font-weight"),
                wordSpacing: $input.css("word-spacing"),
                letterSpacing: $input.css("letter-spacing"),
                textIndent: $input.css("text-indent"),
                textRendering: $input.css("text-rendering"),
                textTransform: $input.css("text-transform")
            }).insertAfter($input);
        }
        function areQueriesEquivalent(a, b) {
            return Input.normalizeQuery(a) === Input.normalizeQuery(b);
        }
        function withModifier($e) {
            return $e.altKey || $e.ctrlKey || $e.metaKey || $e.shiftKey;
        }
    }();
    var Dataset = function() {
        "use strict";
        var keys, nameGenerator;
        keys = {
            val: "tt-selectable-display",
            obj: "tt-selectable-object"
        };
        nameGenerator = _.getIdGenerator();
        function Dataset(o, www) {
            o = o || {};
            o.templates = o.templates || {};
            o.templates.notFound = o.templates.notFound || o.templates.empty;
            if (!o.source) {
                $.error("missing source");
            }
            if (!o.node) {
                $.error("missing node");
            }
            if (o.name && !isValidName(o.name)) {
                $.error("invalid dataset name: " + o.name);
            }
            www.mixin(this);
            this.highlight = !!o.highlight;
            this.name = o.name || nameGenerator();
            this.limit = o.limit || 5;
            this.displayFn = getDisplayFn(o.display || o.displayKey);
            this.templates = getTemplates(o.templates, this.displayFn);
            this.source = o.source.__ttAdapter ? o.source.__ttAdapter() : o.source;
            this.async = _.isUndefined(o.async) ? this.source.length > 2 : !!o.async;
            this._resetLastSuggestion();
            this.$el = $(o.node).addClass(this.classes.dataset).addClass(this.classes.dataset + "-" + this.name);
        }
        Dataset.extractData = function extractData(el) {
            var $el = $(el);
            if ($el.data(keys.obj)) {
                return {
                    val: $el.data(keys.val) || "",
                    obj: $el.data(keys.obj) || null
                };
            }
            return null;
        };
        _.mixin(Dataset.prototype, EventEmitter, {
            _overwrite: function overwrite(query, suggestions) {
                suggestions = suggestions || [];
                if (suggestions.length) {
                    this._renderSuggestions(query, suggestions);
                } else if (this.async && this.templates.pending) {
                    this._renderPending(query);
                } else if (!this.async && this.templates.notFound) {
                    this._renderNotFound(query);
                } else {
                    this._empty();
                }
                this.trigger("rendered", this.name, suggestions, false);
            },
            _append: function append(query, suggestions) {
                suggestions = suggestions || [];
                if (suggestions.length && this.$lastSuggestion.length) {
                    this._appendSuggestions(query, suggestions);
                } else if (suggestions.length) {
                    this._renderSuggestions(query, suggestions);
                } else if (!this.$lastSuggestion.length && this.templates.notFound) {
                    this._renderNotFound(query);
                }
                this.trigger("rendered", this.name, suggestions, true);
            },
            _renderSuggestions: function renderSuggestions(query, suggestions) {
                var $fragment;
                $fragment = this._getSuggestionsFragment(query, suggestions);
                this.$lastSuggestion = $fragment.children().last();
                this.$el.html($fragment).prepend(this._getHeader(query, suggestions)).append(this._getFooter(query, suggestions));
            },
            _appendSuggestions: function appendSuggestions(query, suggestions) {
                var $fragment, $lastSuggestion;
                $fragment = this._getSuggestionsFragment(query, suggestions);
                $lastSuggestion = $fragment.children().last();
                this.$lastSuggestion.after($fragment);
                this.$lastSuggestion = $lastSuggestion;
            },
            _renderPending: function renderPending(query) {
                var template = this.templates.pending;
                this._resetLastSuggestion();
                template && this.$el.html(template({
                    query: query,
                    dataset: this.name
                }));
            },
            _renderNotFound: function renderNotFound(query) {
                var template = this.templates.notFound;
                this._resetLastSuggestion();
                template && this.$el.html(template({
                    query: query,
                    dataset: this.name
                }));
            },
            _empty: function empty() {
                this.$el.empty();
                this._resetLastSuggestion();
            },
            _getSuggestionsFragment: function getSuggestionsFragment(query, suggestions) {
                var that = this, fragment;
                fragment = document.createDocumentFragment();
                _.each(suggestions, function getSuggestionNode(suggestion) {
                    var $el, context;
                    context = that._injectQuery(query, suggestion);
                    $el = $(that.templates.suggestion(context)).data(keys.obj, suggestion).data(keys.val, that.displayFn(suggestion)).addClass(that.classes.suggestion + " " + that.classes.selectable);
                    fragment.appendChild($el[0]);
                });
                this.highlight && highlight({
                    className: this.classes.highlight,
                    node: fragment,
                    pattern: query
                });
                return $(fragment);
            },
            _getFooter: function getFooter(query, suggestions) {
                return this.templates.footer ? this.templates.footer({
                    query: query,
                    suggestions: suggestions,
                    dataset: this.name
                }) : null;
            },
            _getHeader: function getHeader(query, suggestions) {
                return this.templates.header ? this.templates.header({
                    query: query,
                    suggestions: suggestions,
                    dataset: this.name
                }) : null;
            },
            _resetLastSuggestion: function resetLastSuggestion() {
                this.$lastSuggestion = $();
            },
            _injectQuery: function injectQuery(query, obj) {
                return _.isObject(obj) ? _.mixin({
                    _query: query
                }, obj) : obj;
            },
            update: function update(query) {
                var that = this, canceled = false, syncCalled = false, rendered = 0;
                this.cancel();
                this.cancel = function cancel() {
                    canceled = true;
                    that.cancel = $.noop;
                    that.async && that.trigger("asyncCanceled", query);
                };
                this.source(query, sync, async);
                !syncCalled && sync([]);
                function sync(suggestions) {
                    if (syncCalled) {
                        return;
                    }
                    syncCalled = true;
                    suggestions = (suggestions || []).slice(0, that.limit);
                    rendered = suggestions.length;
                    that._overwrite(query, suggestions);
                    if (rendered < that.limit && that.async) {
                        that.trigger("asyncRequested", query);
                    }
                }
                function async(suggestions) {
                    suggestions = suggestions || [];
                    if (!canceled && rendered < that.limit) {
                        that.cancel = $.noop;
                        rendered += suggestions.length;
                        that._append(query, suggestions.slice(0, that.limit - rendered));
                        that.async && that.trigger("asyncReceived", query);
                    }
                }
            },
            cancel: $.noop,
            clear: function clear() {
                this._empty();
                this.cancel();
                this.trigger("cleared");
            },
            isEmpty: function isEmpty() {
                return this.$el.is(":empty");
            },
            destroy: function destroy() {
                this.$el = $("<div>");
            }
        });
        return Dataset;
        function getDisplayFn(display) {
            display = display || _.stringify;
            return _.isFunction(display) ? display : displayFn;
            function displayFn(obj) {
                return obj[display];
            }
        }
        function getTemplates(templates, displayFn) {
            return {
                notFound: templates.notFound && _.templatify(templates.notFound),
                pending: templates.pending && _.templatify(templates.pending),
                header: templates.header && _.templatify(templates.header),
                footer: templates.footer && _.templatify(templates.footer),
                suggestion: templates.suggestion || suggestionTemplate
            };
            function suggestionTemplate(context) {
                return $("<div>").text(displayFn(context));
            }
        }
        function isValidName(str) {
            return /^[_a-zA-Z0-9-]+$/.test(str);
        }
    }();
    var Menu = function() {
        "use strict";
        function Menu(o, www) {
            var that = this;
            o = o || {};
            if (!o.node) {
                $.error("node is required");
            }
            www.mixin(this);
            this.$node = $(o.node);
            this.query = null;
            this.datasets = _.map(o.datasets, initializeDataset);
            function initializeDataset(oDataset) {
                var node = that.$node.find(oDataset.node).first();
                oDataset.node = node.length ? node : $("<div>").appendTo(that.$node);
                return new Dataset(oDataset, www);
            }
        }
        _.mixin(Menu.prototype, EventEmitter, {
            _onSelectableClick: function onSelectableClick($e) {
                this.trigger("selectableClicked", $($e.currentTarget));
            },
            _onRendered: function onRendered(type, dataset, suggestions, async) {
                this.$node.toggleClass(this.classes.empty, this._allDatasetsEmpty());
                this.trigger("datasetRendered", dataset, suggestions, async);
            },
            _onCleared: function onCleared() {
                this.$node.toggleClass(this.classes.empty, this._allDatasetsEmpty());
                this.trigger("datasetCleared");
            },
            _propagate: function propagate() {
                this.trigger.apply(this, arguments);
            },
            _allDatasetsEmpty: function allDatasetsEmpty() {
                return _.every(this.datasets, isDatasetEmpty);
                function isDatasetEmpty(dataset) {
                    return dataset.isEmpty();
                }
            },
            _getSelectables: function getSelectables() {
                return this.$node.find(this.selectors.selectable);
            },
            _removeCursor: function _removeCursor() {
                var $selectable = this.getActiveSelectable();
                $selectable && $selectable.removeClass(this.classes.cursor);
            },
            _ensureVisible: function ensureVisible($el) {
                var elTop, elBottom, nodeScrollTop, nodeHeight;
                elTop = $el.position().top;
                elBottom = elTop + $el.outerHeight(true);
                nodeScrollTop = this.$node.scrollTop();
                nodeHeight = this.$node.height() + parseInt(this.$node.css("paddingTop"), 10) + parseInt(this.$node.css("paddingBottom"), 10);
                if (elTop < 0) {
                    this.$node.scrollTop(nodeScrollTop + elTop);
                } else if (nodeHeight < elBottom) {
                    this.$node.scrollTop(nodeScrollTop + (elBottom - nodeHeight));
                }
            },
            bind: function() {
                var that = this, onSelectableClick;
                onSelectableClick = _.bind(this._onSelectableClick, this);
                this.$node.on("click.tt", this.selectors.selectable, onSelectableClick);
                _.each(this.datasets, function(dataset) {
                    dataset.onSync("asyncRequested", that._propagate, that).onSync("asyncCanceled", that._propagate, that).onSync("asyncReceived", that._propagate, that).onSync("rendered", that._onRendered, that).onSync("cleared", that._onCleared, that);
                });
                return this;
            },
            isOpen: function isOpen() {
                return this.$node.hasClass(this.classes.open);
            },
            open: function open() {
                this.$node.addClass(this.classes.open);
            },
            close: function close() {
                this.$node.removeClass(this.classes.open);
                this._removeCursor();
            },
            setLanguageDirection: function setLanguageDirection(dir) {
                this.$node.attr("dir", dir);
            },
            selectableRelativeToCursor: function selectableRelativeToCursor(delta) {
                var $selectables, $oldCursor, oldIndex, newIndex;
                $oldCursor = this.getActiveSelectable();
                $selectables = this._getSelectables();
                oldIndex = $oldCursor ? $selectables.index($oldCursor) : -1;
                newIndex = oldIndex + delta;
                newIndex = (newIndex + 1) % ($selectables.length + 1) - 1;
                newIndex = newIndex < -1 ? $selectables.length - 1 : newIndex;
                return newIndex === -1 ? null : $selectables.eq(newIndex);
            },
            setCursor: function setCursor($selectable) {
                this._removeCursor();
                if ($selectable = $selectable && $selectable.first()) {
                    $selectable.addClass(this.classes.cursor);
                    this._ensureVisible($selectable);
                }
            },
            getSelectableData: function getSelectableData($el) {
                return $el && $el.length ? Dataset.extractData($el) : null;
            },
            getActiveSelectable: function getActiveSelectable() {
                var $selectable = this._getSelectables().filter(this.selectors.cursor).first();
                return $selectable.length ? $selectable : null;
            },
            getTopSelectable: function getTopSelectable() {
                var $selectable = this._getSelectables().first();
                return $selectable.length ? $selectable : null;
            },
            update: function update(query) {
                var isValidUpdate = query !== this.query;
                if (isValidUpdate) {
                    this.query = query;
                    _.each(this.datasets, updateDataset);
                }
                return isValidUpdate;
                function updateDataset(dataset) {
                    dataset.update(query);
                }
            },
            empty: function empty() {
                _.each(this.datasets, clearDataset);
                this.query = null;
                this.$node.addClass(this.classes.empty);
                function clearDataset(dataset) {
                    dataset.clear();
                }
            },
            destroy: function destroy() {
                this.$node.off(".tt");
                this.$node = $("<div>");
                _.each(this.datasets, destroyDataset);
                function destroyDataset(dataset) {
                    dataset.destroy();
                }
            }
        });
        return Menu;
    }();
    var DefaultMenu = function() {
        "use strict";
        var s = Menu.prototype;
        function DefaultMenu() {
            Menu.apply(this, [].slice.call(arguments, 0));
        }
        _.mixin(DefaultMenu.prototype, Menu.prototype, {
            open: function open() {
                !this._allDatasetsEmpty() && this._show();
                return s.open.apply(this, [].slice.call(arguments, 0));
            },
            close: function close() {
                this._hide();
                return s.close.apply(this, [].slice.call(arguments, 0));
            },
            _onRendered: function onRendered() {
                if (this._allDatasetsEmpty()) {
                    this._hide();
                } else {
                    this.isOpen() && this._show();
                }
                return s._onRendered.apply(this, [].slice.call(arguments, 0));
            },
            _onCleared: function onCleared() {
                if (this._allDatasetsEmpty()) {
                    this._hide();
                } else {
                    this.isOpen() && this._show();
                }
                return s._onCleared.apply(this, [].slice.call(arguments, 0));
            },
            setLanguageDirection: function setLanguageDirection(dir) {
                this.$node.css(dir === "ltr" ? this.css.ltr : this.css.rtl);
                return s.setLanguageDirection.apply(this, [].slice.call(arguments, 0));
            },
            _hide: function hide() {
                this.$node.hide();
            },
            _show: function show() {
                this.$node.css("display", "block");
            }
        });
        return DefaultMenu;
    }();
    var Typeahead = function() {
        "use strict";
        function Typeahead(o, www) {
            var onFocused, onBlurred, onEnterKeyed, onTabKeyed, onEscKeyed, onUpKeyed, onDownKeyed, onLeftKeyed, onRightKeyed, onQueryChanged, onWhitespaceChanged;
            o = o || {};
            if (!o.input) {
                $.error("missing input");
            }
            if (!o.menu) {
                $.error("missing menu");
            }
            if (!o.eventBus) {
                $.error("missing event bus");
            }
            www.mixin(this);
            this.eventBus = o.eventBus;
            this.minLength = _.isNumber(o.minLength) ? o.minLength : 1;
            this.input = o.input;
            this.menu = o.menu;
            this.enabled = true;
            this.active = false;
            this.input.hasFocus() && this.activate();
            this.dir = this.input.getLangDir();
            this._hacks();
            this.menu.bind().onSync("selectableClicked", this._onSelectableClicked, this).onSync("asyncRequested", this._onAsyncRequested, this).onSync("asyncCanceled", this._onAsyncCanceled, this).onSync("asyncReceived", this._onAsyncReceived, this).onSync("datasetRendered", this._onDatasetRendered, this).onSync("datasetCleared", this._onDatasetCleared, this);
            onFocused = c(this, "activate", "open", "_onFocused");
            onBlurred = c(this, "deactivate", "_onBlurred");
            onEnterKeyed = c(this, "isActive", "isOpen", "_onEnterKeyed");
            onTabKeyed = c(this, "isActive", "isOpen", "_onTabKeyed");
            onEscKeyed = c(this, "isActive", "_onEscKeyed");
            onUpKeyed = c(this, "isActive", "open", "_onUpKeyed");
            onDownKeyed = c(this, "isActive", "open", "_onDownKeyed");
            onLeftKeyed = c(this, "isActive", "isOpen", "_onLeftKeyed");
            onRightKeyed = c(this, "isActive", "isOpen", "_onRightKeyed");
            onQueryChanged = c(this, "_openIfActive", "_onQueryChanged");
            onWhitespaceChanged = c(this, "_openIfActive", "_onWhitespaceChanged");
            this.input.bind().onSync("focused", onFocused, this).onSync("blurred", onBlurred, this).onSync("enterKeyed", onEnterKeyed, this).onSync("tabKeyed", onTabKeyed, this).onSync("escKeyed", onEscKeyed, this).onSync("upKeyed", onUpKeyed, this).onSync("downKeyed", onDownKeyed, this).onSync("leftKeyed", onLeftKeyed, this).onSync("rightKeyed", onRightKeyed, this).onSync("queryChanged", onQueryChanged, this).onSync("whitespaceChanged", onWhitespaceChanged, this).onSync("langDirChanged", this._onLangDirChanged, this);
        }
        _.mixin(Typeahead.prototype, {
            _hacks: function hacks() {
                var $input, $menu;
                $input = this.input.$input || $("<div>");
                $menu = this.menu.$node || $("<div>");
                $input.on("blur.tt", function($e) {
                    var active, isActive, hasActive;
                    active = document.activeElement;
                    isActive = $menu.is(active);
                    hasActive = $menu.has(active).length > 0;
                    if (_.isMsie() && (isActive || hasActive)) {
                        $e.preventDefault();
                        $e.stopImmediatePropagation();
                        _.defer(function() {
                            $input.focus();
                        });
                    }
                });
                $menu.on("mousedown.tt", function($e) {
                    $e.preventDefault();
                });
            },
            _onSelectableClicked: function onSelectableClicked(type, $el) {
                this.select($el);
            },
            _onDatasetCleared: function onDatasetCleared() {
                this._updateHint();
            },
            _onDatasetRendered: function onDatasetRendered(type, dataset, suggestions, async) {
                this._updateHint();
                this.eventBus.trigger("render", suggestions, async, dataset);
            },
            _onAsyncRequested: function onAsyncRequested(type, dataset, query) {
                this.eventBus.trigger("asyncrequest", query, dataset);
            },
            _onAsyncCanceled: function onAsyncCanceled(type, dataset, query) {
                this.eventBus.trigger("asynccancel", query, dataset);
            },
            _onAsyncReceived: function onAsyncReceived(type, dataset, query) {
                this.eventBus.trigger("asyncreceive", query, dataset);
            },
            _onFocused: function onFocused() {
                this._minLengthMet() && this.menu.update(this.input.getQuery());
            },
            _onBlurred: function onBlurred() {
                if (this.input.hasQueryChangedSinceLastFocus()) {
                    this.eventBus.trigger("change", this.input.getQuery());
                }
            },
            _onEnterKeyed: function onEnterKeyed(type, $e) {
                var $selectable;
                if ($selectable = this.menu.getActiveSelectable()) {
                    this.select($selectable) && $e.preventDefault();
                }
            },
            _onTabKeyed: function onTabKeyed(type, $e) {
                var $selectable;
                if ($selectable = this.menu.getActiveSelectable()) {
                    this.select($selectable) && $e.preventDefault();
                } else if ($selectable = this.menu.getTopSelectable()) {
                    this.autocomplete($selectable) && $e.preventDefault();
                }
            },
            _onEscKeyed: function onEscKeyed() {
                this.close();
            },
            _onUpKeyed: function onUpKeyed() {
                this.moveCursor(-1);
            },
            _onDownKeyed: function onDownKeyed() {
                this.moveCursor(+1);
            },
            _onLeftKeyed: function onLeftKeyed() {
                if (this.dir === "rtl" && this.input.isCursorAtEnd()) {
                    this.autocomplete(this.menu.getTopSelectable());
                }
            },
            _onRightKeyed: function onRightKeyed() {
                if (this.dir === "ltr" && this.input.isCursorAtEnd()) {
                    this.autocomplete(this.menu.getTopSelectable());
                }
            },
            _onQueryChanged: function onQueryChanged(e, query) {
                this._minLengthMet(query) ? this.menu.update(query) : this.menu.empty();
            },
            _onWhitespaceChanged: function onWhitespaceChanged() {
                this._updateHint();
            },
            _onLangDirChanged: function onLangDirChanged(e, dir) {
                if (this.dir !== dir) {
                    this.dir = dir;
                    this.menu.setLanguageDirection(dir);
                }
            },
            _openIfActive: function openIfActive() {
                this.isActive() && this.open();
            },
            _minLengthMet: function minLengthMet(query) {
                query = _.isString(query) ? query : this.input.getQuery() || "";
                return query.length >= this.minLength;
            },
            _updateHint: function updateHint() {
                var $selectable, data, val, query, escapedQuery, frontMatchRegEx, match;
                $selectable = this.menu.getTopSelectable();
                data = this.menu.getSelectableData($selectable);
                val = this.input.getInputValue();
                if (data && !_.isBlankString(val) && !this.input.hasOverflow()) {
                    query = Input.normalizeQuery(val);
                    escapedQuery = _.escapeRegExChars(query);
                    frontMatchRegEx = new RegExp("^(?:" + escapedQuery + ")(.+$)", "i");
                    match = frontMatchRegEx.exec(data.val);
                    match && this.input.setHint(val + match[1]);
                } else {
                    this.input.clearHint();
                }
            },
            isEnabled: function isEnabled() {
                return this.enabled;
            },
            enable: function enable() {
                this.enabled = true;
            },
            disable: function disable() {
                this.enabled = false;
            },
            isActive: function isActive() {
                return this.active;
            },
            activate: function activate() {
                if (this.isActive()) {
                    return true;
                } else if (!this.isEnabled() || this.eventBus.before("active")) {
                    return false;
                } else {
                    this.active = true;
                    this.eventBus.trigger("active");
                    return true;
                }
            },
            deactivate: function deactivate() {
                if (!this.isActive()) {
                    return true;
                } else if (this.eventBus.before("idle")) {
                    return false;
                } else {
                    this.active = false;
                    this.close();
                    this.eventBus.trigger("idle");
                    return true;
                }
            },
            isOpen: function isOpen() {
                return this.menu.isOpen();
            },
            open: function open() {
                if (!this.isOpen() && !this.eventBus.before("open")) {
                    this.menu.open();
                    this._updateHint();
                    this.eventBus.trigger("open");
                }
                return this.isOpen();
            },
            close: function close() {
                if (this.isOpen() && !this.eventBus.before("close")) {
                    this.menu.close();
                    this.input.clearHint();
                    this.input.resetInputValue();
                    this.eventBus.trigger("close");
                }
                return !this.isOpen();
            },
            setVal: function setVal(val) {
                this.input.setQuery(_.toStr(val));
            },
            getVal: function getVal() {
                return this.input.getQuery();
            },
            select: function select($selectable) {
                var data = this.menu.getSelectableData($selectable);
                if (data && !this.eventBus.before("select", data.obj)) {
                    this.input.setQuery(data.val, true);
                    this.eventBus.trigger("select", data.obj);
                    this.close();
                    return true;
                }
                return false;
            },
            autocomplete: function autocomplete($selectable) {
                var query, data, isValid;
                query = this.input.getQuery();
                data = this.menu.getSelectableData($selectable);
                isValid = data && query !== data.val;
                if (isValid && !this.eventBus.before("autocomplete", data.obj)) {
                    this.input.setQuery(data.val);
                    this.eventBus.trigger("autocomplete", data.obj);
                    return true;
                }
                return false;
            },
            moveCursor: function moveCursor(delta) {
                var query, $candidate, data, payload, cancelMove;
                query = this.input.getQuery();
                $candidate = this.menu.selectableRelativeToCursor(delta);
                data = this.menu.getSelectableData($candidate);
                payload = data ? data.obj : null;
                cancelMove = this._minLengthMet() && this.menu.update(query);
                if (!cancelMove && !this.eventBus.before("cursorchange", payload)) {
                    this.menu.setCursor($candidate);
                    if (data) {
                        this.input.setInputValue(data.val);
                    } else {
                        this.input.resetInputValue();
                        this._updateHint();
                    }
                    this.eventBus.trigger("cursorchange", payload);
                    return true;
                }
                return false;
            },
            destroy: function destroy() {
                this.input.destroy();
                this.menu.destroy();
            }
        });
        return Typeahead;
        function c(ctx) {
            var methods = [].slice.call(arguments, 1);
            return function() {
                var args = [].slice.call(arguments);
                _.each(methods, function(method) {
                    return ctx[method].apply(ctx, args);
                });
            };
        }
    }();
    (function() {
        "use strict";
        var old, keys, methods;
        old = $.fn.typeahead;
        keys = {
            www: "tt-www",
            attrs: "tt-attrs",
            typeahead: "tt-typeahead"
        };
        methods = {
            initialize: function initialize(o, datasets) {
                var www;
                datasets = _.isArray(datasets) ? datasets : [].slice.call(arguments, 1);
                o = o || {};
                www = WWW(o.classNames);
                return this.each(attach);
                function attach() {
                    var $input, $wrapper, $hint, $menu, defaultHint, defaultMenu, eventBus, input, menu, typeahead, MenuConstructor;
                    _.each(datasets, function(d) {
                        d.highlight = !!o.highlight;
                    });
                    $input = $(this);
                    $wrapper = $(www.html.wrapper);
                    $hint = $elOrNull(o.hint);
                    $menu = $elOrNull(o.menu);
                    defaultHint = o.hint !== false && !$hint;
                    defaultMenu = o.menu !== false && !$menu;
                    defaultHint && ($hint = buildHintFromInput($input, www));
                    defaultMenu && ($menu = $(www.html.menu).css(www.css.menu));
                    $hint && $hint.val("");
                    $input = prepInput($input, www);
                    if (defaultHint || defaultMenu) {
                        $wrapper.css(www.css.wrapper);
                        $input.css(defaultHint ? www.css.input : www.css.inputWithNoHint);
                        $input.wrap($wrapper).parent().prepend(defaultHint ? $hint : null).append(defaultMenu ? $menu : null);
                    }
                    MenuConstructor = defaultMenu ? DefaultMenu : Menu;
                    eventBus = new EventBus({
                        el: $input
                    });
                    input = new Input({
                        hint: $hint,
                        input: $input
                    }, www);
                    menu = new MenuConstructor({
                        node: $menu,
                        datasets: datasets
                    }, www);
                    typeahead = new Typeahead({
                        input: input,
                        menu: menu,
                        eventBus: eventBus,
                        minLength: o.minLength
                    }, www);
                    $input.data(keys.www, www);
                    $input.data(keys.typeahead, typeahead);
                }
            },
            isEnabled: function isEnabled() {
                var enabled;
                ttEach(this.first(), function(t) {
                    enabled = t.isEnabled();
                });
                return enabled;
            },
            enable: function enable() {
                ttEach(this, function(t) {
                    t.enable();
                });
                return this;
            },
            disable: function disable() {
                ttEach(this, function(t) {
                    t.disable();
                });
                return this;
            },
            isActive: function isActive() {
                var active;
                ttEach(this.first(), function(t) {
                    active = t.isActive();
                });
                return active;
            },
            activate: function activate() {
                ttEach(this, function(t) {
                    t.activate();
                });
                return this;
            },
            deactivate: function deactivate() {
                ttEach(this, function(t) {
                    t.deactivate();
                });
                return this;
            },
            isOpen: function isOpen() {
                var open;
                ttEach(this.first(), function(t) {
                    open = t.isOpen();
                });
                return open;
            },
            open: function open() {
                ttEach(this, function(t) {
                    t.open();
                });
                return this;
            },
            close: function close() {
                ttEach(this, function(t) {
                    t.close();
                });
                return this;
            },
            select: function select(el) {
                var success = false, $el = $(el);
                ttEach(this.first(), function(t) {
                    success = t.select($el);
                });
                return success;
            },
            autocomplete: function autocomplete(el) {
                var success = false, $el = $(el);
                ttEach(this.first(), function(t) {
                    success = t.autocomplete($el);
                });
                return success;
            },
            moveCursor: function moveCursoe(delta) {
                var success = false;
                ttEach(this.first(), function(t) {
                    success = t.moveCursor(delta);
                });
                return success;
            },
            val: function val(newVal) {
                var query;
                if (!arguments.length) {
                    ttEach(this.first(), function(t) {
                        query = t.getVal();
                    });
                    return query;
                } else {
                    ttEach(this, function(t) {
                        t.setVal(newVal);
                    });
                    return this;
                }
            },
            destroy: function destroy() {
                ttEach(this, function(typeahead, $input) {
                    revert($input);
                    typeahead.destroy();
                });
                return this;
            }
        };
        $.fn.typeahead = function(method) {
            if (methods[method]) {
                return methods[method].apply(this, [].slice.call(arguments, 1));
            } else {
                return methods.initialize.apply(this, arguments);
            }
        };
        $.fn.typeahead.noConflict = function noConflict() {
            $.fn.typeahead = old;
            return this;
        };
        function ttEach($els, fn) {
            $els.each(function() {
                var $input = $(this), typeahead;
                (typeahead = $input.data(keys.typeahead)) && fn(typeahead, $input);
            });
        }
        function buildHintFromInput($input, www) {
            return $input.clone().addClass(www.classes.hint).removeData().css(www.css.hint).css(getBackgroundStyles($input)).prop("readonly", true).removeAttr("id name placeholder required").attr({
                autocomplete: "off",
                spellcheck: "false",
                tabindex: -1
            });
        }
        function prepInput($input, www) {
            $input.data(keys.attrs, {
                dir: $input.attr("dir"),
                autocomplete: $input.attr("autocomplete"),
                spellcheck: $input.attr("spellcheck"),
                style: $input.attr("style")
            });
            $input.addClass(www.classes.input).attr({
                autocomplete: "off",
                spellcheck: false
            });
            try {
                !$input.attr("dir") && $input.attr("dir", "auto");
            } catch (e) {}
            return $input;
        }
        function getBackgroundStyles($el) {
            return {
                backgroundAttachment: $el.css("background-attachment"),
                backgroundClip: $el.css("background-clip"),
                backgroundColor: $el.css("background-color"),
                backgroundImage: $el.css("background-image"),
                backgroundOrigin: $el.css("background-origin"),
                backgroundPosition: $el.css("background-position"),
                backgroundRepeat: $el.css("background-repeat"),
                backgroundSize: $el.css("background-size")
            };
        }
        function revert($input) {
            var www, $wrapper;
            www = $input.data(keys.www);
            $wrapper = $input.parent().filter(www.selectors.wrapper);
            _.each($input.data(keys.attrs), function(val, key) {
                _.isUndefined(val) ? $input.removeAttr(key) : $input.attr(key, val);
            });
            $input.removeData(keys.typeahead).removeData(keys.www).removeData(keys.attr).removeClass(www.classes.input);
            if ($wrapper.length) {
                $input.detach().insertAfter($wrapper);
                $wrapper.remove();
            }
        }
        function $elOrNull(obj) {
            var isValid, $el;
            isValid = _.isJQuery(obj) || _.isElement(obj);
            $el = isValid ? $(obj).first() : [];
            return $el.length ? $el : null;
        }
    })();
});
/*
 * bootstrap-tagsinput v0.4.2 by Tim Schlechter
 *
 */

!function(a){"use strict";function b(b,c){this.itemsArray=[],this.$element=a(b),this.$element.hide(),this.isSelect="SELECT"===b.tagName,this.multiple=this.isSelect&&b.hasAttribute("multiple"),this.objectItems=c&&c.itemValue,this.placeholderText=b.hasAttribute("placeholder")?this.$element.attr("placeholder"):"",this.inputSize=Math.max(1,this.placeholderText.length),this.$container=a('<div class="bootstrap-tagsinput"></div>'),this.$input=a('<input type="text" placeholder="'+this.placeholderText+'"/>').appendTo(this.$container),this.$element.after(this.$container);var d=(this.inputSize<3?3:this.inputSize)+"em";this.$input.get(0).style.cssText="width: "+d+" !important; padding: 8px;",this.build(c)}function c(a,b){if("function"!=typeof a[b]){var c=a[b];a[b]=function(a){return a[c]}}}function d(a,b){if("function"!=typeof a[b]){var c=a[b];a[b]=function(){return c}}}function e(a){return a?i.text(a).html():""}function f(a){var b=0;if(document.selection){a.focus();var c=document.selection.createRange();c.moveStart("character",-a.value.length),b=c.text.length}else(a.selectionStart||"0"==a.selectionStart)&&(b=a.selectionStart);return b}function g(b,c){var d=!1;return a.each(c,function(a,c){if("number"==typeof c&&b.which===c)return d=!0,!1;if(b.which===c.which){var e=!c.hasOwnProperty("altKey")||b.altKey===c.altKey,f=!c.hasOwnProperty("shiftKey")||b.shiftKey===c.shiftKey,g=!c.hasOwnProperty("ctrlKey")||b.ctrlKey===c.ctrlKey;if(e&&f&&g)return d=!0,!1}}),d}var h={tagClass:function(){return"label label-info"},itemValue:function(a){return a?a.toString():a},itemText:function(a){return this.itemValue(a)},freeInput:!0,addOnBlur:!0,maxTags:void 0,maxChars:void 0,confirmKeys:[13,44],onTagExists:function(a,b){b.hide().fadeIn()},trimValue:!1,allowDuplicates:!1};b.prototype={constructor:b,add:function(b,c){var d=this;if(!(d.options.maxTags&&d.itemsArray.length>=d.options.maxTags||b!==!1&&!b)){if("string"==typeof b&&d.options.trimValue&&(b=a.trim(b)),"object"==typeof b&&!d.objectItems)throw"Can't add objects when itemValue option is not set";if(!b.toString().match(/^\s*$/)){if(d.isSelect&&!d.multiple&&d.itemsArray.length>0&&d.remove(d.itemsArray[0]),"string"==typeof b&&"INPUT"===this.$element[0].tagName){var f=b.split(",");if(f.length>1){for(var g=0;g<f.length;g++)this.add(f[g],!0);return void(c||d.pushVal())}}var h=d.options.itemValue(b),i=d.options.itemText(b),j=d.options.tagClass(b),k=a.grep(d.itemsArray,function(a){return d.options.itemValue(a)===h})[0];if(!k||d.options.allowDuplicates){if(!(d.items().toString().length+b.length+1>d.options.maxInputLength)){var l=a.Event("beforeItemAdd",{item:b,cancel:!1});if(d.$element.trigger(l),!l.cancel){d.itemsArray.push(b);var m=a('<span class="tag '+e(j)+'">'+e(i)+'<span data-role="remove"></span></span>');if(m.data("item",b),d.findInputWrapper().before(m),m.after(" "),d.isSelect&&!a('option[value="'+encodeURIComponent(h)+'"]',d.$element)[0]){var n=a("<option selected>"+e(i)+"</option>");n.data("item",b),n.attr("value",h),d.$element.append(n)}c||d.pushVal(),(d.options.maxTags===d.itemsArray.length||d.items().toString().length===d.options.maxInputLength)&&d.$container.addClass("bootstrap-tagsinput-max"),d.$element.trigger(a.Event("itemAdded",{item:b}))}}}else if(d.options.onTagExists){var o=a(".tag",d.$container).filter(function(){return a(this).data("item")===k});d.options.onTagExists(b,o)}}}},remove:function(b,c){var d=this;if(d.objectItems&&(b="object"==typeof b?a.grep(d.itemsArray,function(a){return d.options.itemValue(a)==d.options.itemValue(b)}):a.grep(d.itemsArray,function(a){return d.options.itemValue(a)==b}),b=b[b.length-1]),b){var e=a.Event("beforeItemRemove",{item:b,cancel:!1});if(d.$element.trigger(e),e.cancel)return;a(".tag",d.$container).filter(function(){return a(this).data("item")===b}).remove(),a("option",d.$element).filter(function(){return a(this).data("item")===b}).remove(),-1!==a.inArray(b,d.itemsArray)&&d.itemsArray.splice(a.inArray(b,d.itemsArray),1)}c||d.pushVal(),d.options.maxTags>d.itemsArray.length&&d.$container.removeClass("bootstrap-tagsinput-max"),d.$element.trigger(a.Event("itemRemoved",{item:b}))},removeAll:function(){var b=this;for(a(".tag",b.$container).remove(),a("option",b.$element).remove();b.itemsArray.length>0;)b.itemsArray.pop();b.pushVal()},refresh:function(){var b=this;a(".tag",b.$container).each(function(){var c=a(this),d=c.data("item"),f=b.options.itemValue(d),g=b.options.itemText(d),h=b.options.tagClass(d);if(c.attr("class",null),c.addClass("tag "+e(h)),c.contents().filter(function(){return 3==this.nodeType})[0].nodeValue=e(g),b.isSelect){var i=a("option",b.$element).filter(function(){return a(this).data("item")===d});i.attr("value",f)}})},items:function(){return this.itemsArray},pushVal:function(){var b=this,c=a.map(b.items(),function(a){return b.options.itemValue(a).toString()});b.$element.val(c,!0).trigger("change")},build:function(b){var e=this;if(e.options=a.extend({},h,b),e.objectItems&&(e.options.freeInput=!1),c(e.options,"itemValue"),c(e.options,"itemText"),d(e.options,"tagClass"),e.options.typeahead){var i=e.options.typeahead||{};d(i,"source"),e.$input.typeahead(a.extend({},i,{source:function(b,c){function d(a){for(var b=[],d=0;d<a.length;d++){var g=e.options.itemText(a[d]);f[g]=a[d],b.push(g)}c(b)}this.map={};var f=this.map,g=i.source(b);a.isFunction(g.success)?g.success(d):a.isFunction(g.then)?g.then(d):a.when(g).then(d)},updater:function(a){e.add(this.map[a])},matcher:function(a){return-1!==a.toLowerCase().indexOf(this.query.trim().toLowerCase())},sorter:function(a){return a.sort()},highlighter:function(a){var b=new RegExp("("+this.query+")","gi");return a.replace(b,"<strong>$1</strong>")}}))}if(e.options.typeaheadjs){var j=e.options.typeaheadjs||{};e.$input.typeahead(null,j).on("typeahead:selected",a.proxy(function(a,b){e.add(j.valueKey?b[j.valueKey]:b),e.$input.typeahead("val","")},e))}e.$container.on("click",a.proxy(function(){e.$element.attr("disabled")||e.$input.removeAttr("disabled"),e.$input.focus()},e)),e.options.addOnBlur&&e.options.freeInput&&e.$input.on("focusout",a.proxy(function(){0===a(".typeahead, .twitter-typeahead",e.$container).length&&(e.add(e.$input.val()),e.$input.val(""))},e)),e.$container.on("keydown","input",a.proxy(function(b){var c=a(b.target),d=e.findInputWrapper();if(e.$element.attr("disabled"))return void e.$input.attr("disabled","disabled");switch(b.which){case 8:if(0===f(c[0])){var g=d.prev();g&&e.remove(g.data("item"))}break;case 46:if(0===f(c[0])){var h=d.next();h&&e.remove(h.data("item"))}break;case 37:var i=d.prev();0===c.val().length&&i[0]&&(i.before(d),c.focus());break;case 39:var j=d.next();0===c.val().length&&j[0]&&(j.after(d),c.focus())}{var k=c.val().length;Math.ceil(k/5)}c.attr("size",Math.max(this.inputSize,c.val().length))},e)),e.$container.on("keypress","input",a.proxy(function(b){var c=a(b.target);if(e.$element.attr("disabled"))return void e.$input.attr("disabled","disabled");var d=c.val(),f=e.options.maxChars&&d.length>=e.options.maxChars;e.options.freeInput&&(g(b,e.options.confirmKeys)||f)&&(e.add(f?d.substr(0,e.options.maxChars):d),c.val(""),b.preventDefault());{var h=c.val().length;Math.ceil(h/5)}c.attr("size",Math.max(this.inputSize,c.val().length))},e)),e.$container.on("click","[data-role=remove]",a.proxy(function(b){e.$element.attr("disabled")||e.remove(a(b.target).closest(".tag").data("item"))},e)),e.options.itemValue===h.itemValue&&("INPUT"===e.$element[0].tagName?e.add(e.$element.val()):a("option",e.$element).each(function(){e.add(a(this).attr("value"),!0)}))},destroy:function(){var a=this;a.$container.off("keypress","input"),a.$container.off("click","[role=remove]"),a.$container.remove(),a.$element.removeData("tagsinput"),a.$element.show()},focus:function(){this.$input.focus()},input:function(){return this.$input},findInputWrapper:function(){for(var b=this.$input[0],c=this.$container[0];b&&b.parentNode!==c;)b=b.parentNode;return a(b)}},a.fn.tagsinput=function(c,d){var e=[];return this.each(function(){var f=a(this).data("tagsinput");if(f)if(c||d){if(void 0!==f[c]){var g=f[c](d);void 0!==g&&e.push(g)}}else e.push(f);else f=new b(this,c),a(this).data("tagsinput",f),e.push(f),"SELECT"===this.tagName&&a("option",a(this)).attr("selected","selected"),a(this).val(a(this).val())}),"string"==typeof c?e.length>1?e:e[0]:e},a.fn.tagsinput.Constructor=b;var i=a("<div />");a(function(){a("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput()})}(window.jQuery);
//! moment.js
//! version : 2.10.6
//! authors : Tim Wood, Iskren Chernev, Moment.js contributors
//! license : MIT
//! momentjs.com

(function (global, factory) {
    typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
    typeof define === 'function' && define.amd ? define(factory) :
    global.moment = factory()
}(this, function () { 'use strict';

    var hookCallback;

    function utils_hooks__hooks () {
        return hookCallback.apply(null, arguments);
    }

    // This is done to register the method called with moment()
    // without creating circular dependencies.
    function setHookCallback (callback) {
        hookCallback = callback;
    }

    function isArray(input) {
        return Object.prototype.toString.call(input) === '[object Array]';
    }

    function isDate(input) {
        return input instanceof Date || Object.prototype.toString.call(input) === '[object Date]';
    }

    function map(arr, fn) {
        var res = [], i;
        for (i = 0; i < arr.length; ++i) {
            res.push(fn(arr[i], i));
        }
        return res;
    }

    function hasOwnProp(a, b) {
        return Object.prototype.hasOwnProperty.call(a, b);
    }

    function extend(a, b) {
        for (var i in b) {
            if (hasOwnProp(b, i)) {
                a[i] = b[i];
            }
        }

        if (hasOwnProp(b, 'toString')) {
            a.toString = b.toString;
        }

        if (hasOwnProp(b, 'valueOf')) {
            a.valueOf = b.valueOf;
        }

        return a;
    }

    function create_utc__createUTC (input, format, locale, strict) {
        return createLocalOrUTC(input, format, locale, strict, true).utc();
    }

    function defaultParsingFlags() {
        // We need to deep clone this object.
        return {
            empty           : false,
            unusedTokens    : [],
            unusedInput     : [],
            overflow        : -2,
            charsLeftOver   : 0,
            nullInput       : false,
            invalidMonth    : null,
            invalidFormat   : false,
            userInvalidated : false,
            iso             : false
        };
    }

    function getParsingFlags(m) {
        if (m._pf == null) {
            m._pf = defaultParsingFlags();
        }
        return m._pf;
    }

    function valid__isValid(m) {
        if (m._isValid == null) {
            var flags = getParsingFlags(m);
            m._isValid = !isNaN(m._d.getTime()) &&
                flags.overflow < 0 &&
                !flags.empty &&
                !flags.invalidMonth &&
                !flags.invalidWeekday &&
                !flags.nullInput &&
                !flags.invalidFormat &&
                !flags.userInvalidated;

            if (m._strict) {
                m._isValid = m._isValid &&
                    flags.charsLeftOver === 0 &&
                    flags.unusedTokens.length === 0 &&
                    flags.bigHour === undefined;
            }
        }
        return m._isValid;
    }

    function valid__createInvalid (flags) {
        var m = create_utc__createUTC(NaN);
        if (flags != null) {
            extend(getParsingFlags(m), flags);
        }
        else {
            getParsingFlags(m).userInvalidated = true;
        }

        return m;
    }

    var momentProperties = utils_hooks__hooks.momentProperties = [];

    function copyConfig(to, from) {
        var i, prop, val;

        if (typeof from._isAMomentObject !== 'undefined') {
            to._isAMomentObject = from._isAMomentObject;
        }
        if (typeof from._i !== 'undefined') {
            to._i = from._i;
        }
        if (typeof from._f !== 'undefined') {
            to._f = from._f;
        }
        if (typeof from._l !== 'undefined') {
            to._l = from._l;
        }
        if (typeof from._strict !== 'undefined') {
            to._strict = from._strict;
        }
        if (typeof from._tzm !== 'undefined') {
            to._tzm = from._tzm;
        }
        if (typeof from._isUTC !== 'undefined') {
            to._isUTC = from._isUTC;
        }
        if (typeof from._offset !== 'undefined') {
            to._offset = from._offset;
        }
        if (typeof from._pf !== 'undefined') {
            to._pf = getParsingFlags(from);
        }
        if (typeof from._locale !== 'undefined') {
            to._locale = from._locale;
        }

        if (momentProperties.length > 0) {
            for (i in momentProperties) {
                prop = momentProperties[i];
                val = from[prop];
                if (typeof val !== 'undefined') {
                    to[prop] = val;
                }
            }
        }

        return to;
    }

    var updateInProgress = false;

    // Moment prototype object
    function Moment(config) {
        copyConfig(this, config);
        this._d = new Date(config._d != null ? config._d.getTime() : NaN);
        // Prevent infinite loop in case updateOffset creates new moment
        // objects.
        if (updateInProgress === false) {
            updateInProgress = true;
            utils_hooks__hooks.updateOffset(this);
            updateInProgress = false;
        }
    }

    function isMoment (obj) {
        return obj instanceof Moment || (obj != null && obj._isAMomentObject != null);
    }

    function absFloor (number) {
        if (number < 0) {
            return Math.ceil(number);
        } else {
            return Math.floor(number);
        }
    }

    function toInt(argumentForCoercion) {
        var coercedNumber = +argumentForCoercion,
            value = 0;

        if (coercedNumber !== 0 && isFinite(coercedNumber)) {
            value = absFloor(coercedNumber);
        }

        return value;
    }

    function compareArrays(array1, array2, dontConvert) {
        var len = Math.min(array1.length, array2.length),
            lengthDiff = Math.abs(array1.length - array2.length),
            diffs = 0,
            i;
        for (i = 0; i < len; i++) {
            if ((dontConvert && array1[i] !== array2[i]) ||
                (!dontConvert && toInt(array1[i]) !== toInt(array2[i]))) {
                diffs++;
            }
        }
        return diffs + lengthDiff;
    }

    function Locale() {
    }

    var locales = {};
    var globalLocale;

    function normalizeLocale(key) {
        return key ? key.toLowerCase().replace('_', '-') : key;
    }

    // pick the locale from the array
    // try ['en-au', 'en-gb'] as 'en-au', 'en-gb', 'en', as in move through the list trying each
    // substring from most specific to least, but move to the next array item if it's a more specific variant than the current root
    function chooseLocale(names) {
        var i = 0, j, next, locale, split;

        while (i < names.length) {
            split = normalizeLocale(names[i]).split('-');
            j = split.length;
            next = normalizeLocale(names[i + 1]);
            next = next ? next.split('-') : null;
            while (j > 0) {
                locale = loadLocale(split.slice(0, j).join('-'));
                if (locale) {
                    return locale;
                }
                if (next && next.length >= j && compareArrays(split, next, true) >= j - 1) {
                    //the next array item is better than a shallower substring of this one
                    break;
                }
                j--;
            }
            i++;
        }
        return null;
    }

    function loadLocale(name) {
        var oldLocale = null;
        // TODO: Find a better way to register and load all the locales in Node
        if (!locales[name] && typeof module !== 'undefined' &&
                module && module.exports) {
            try {
                oldLocale = globalLocale._abbr;
                require('./locale/' + name);
                // because defineLocale currently also sets the global locale, we
                // want to undo that for lazy loaded locales
                locale_locales__getSetGlobalLocale(oldLocale);
            } catch (e) { }
        }
        return locales[name];
    }

    // This function will load locale and then set the global locale.  If
    // no arguments are passed in, it will simply return the current global
    // locale key.
    function locale_locales__getSetGlobalLocale (key, values) {
        var data;
        if (key) {
            if (typeof values === 'undefined') {
                data = locale_locales__getLocale(key);
            }
            else {
                data = defineLocale(key, values);
            }

            if (data) {
                // moment.duration._locale = moment._locale = data;
                globalLocale = data;
            }
        }

        return globalLocale._abbr;
    }

    function defineLocale (name, values) {
        if (values !== null) {
            values.abbr = name;
            locales[name] = locales[name] || new Locale();
            locales[name].set(values);

            // backwards compat for now: also set the locale
            locale_locales__getSetGlobalLocale(name);

            return locales[name];
        } else {
            // useful for testing
            delete locales[name];
            return null;
        }
    }

    // returns locale data
    function locale_locales__getLocale (key) {
        var locale;

        if (key && key._locale && key._locale._abbr) {
            key = key._locale._abbr;
        }

        if (!key) {
            return globalLocale;
        }

        if (!isArray(key)) {
            //short-circuit everything else
            locale = loadLocale(key);
            if (locale) {
                return locale;
            }
            key = [key];
        }

        return chooseLocale(key);
    }

    var aliases = {};

    function addUnitAlias (unit, shorthand) {
        var lowerCase = unit.toLowerCase();
        aliases[lowerCase] = aliases[lowerCase + 's'] = aliases[shorthand] = unit;
    }

    function normalizeUnits(units) {
        return typeof units === 'string' ? aliases[units] || aliases[units.toLowerCase()] : undefined;
    }

    function normalizeObjectUnits(inputObject) {
        var normalizedInput = {},
            normalizedProp,
            prop;

        for (prop in inputObject) {
            if (hasOwnProp(inputObject, prop)) {
                normalizedProp = normalizeUnits(prop);
                if (normalizedProp) {
                    normalizedInput[normalizedProp] = inputObject[prop];
                }
            }
        }

        return normalizedInput;
    }

    function makeGetSet (unit, keepTime) {
        return function (value) {
            if (value != null) {
                get_set__set(this, unit, value);
                utils_hooks__hooks.updateOffset(this, keepTime);
                return this;
            } else {
                return get_set__get(this, unit);
            }
        };
    }

    function get_set__get (mom, unit) {
        return mom._d['get' + (mom._isUTC ? 'UTC' : '') + unit]();
    }

    function get_set__set (mom, unit, value) {
        return mom._d['set' + (mom._isUTC ? 'UTC' : '') + unit](value);
    }

    // MOMENTS

    function getSet (units, value) {
        var unit;
        if (typeof units === 'object') {
            for (unit in units) {
                this.set(unit, units[unit]);
            }
        } else {
            units = normalizeUnits(units);
            if (typeof this[units] === 'function') {
                return this[units](value);
            }
        }
        return this;
    }

    function zeroFill(number, targetLength, forceSign) {
        var absNumber = '' + Math.abs(number),
            zerosToFill = targetLength - absNumber.length,
            sign = number >= 0;
        return (sign ? (forceSign ? '+' : '') : '-') +
            Math.pow(10, Math.max(0, zerosToFill)).toString().substr(1) + absNumber;
    }

    var formattingTokens = /(\[[^\[]*\])|(\\)?(Mo|MM?M?M?|Do|DDDo|DD?D?D?|ddd?d?|do?|w[o|w]?|W[o|W]?|Q|YYYYYY|YYYYY|YYYY|YY|gg(ggg?)?|GG(GGG?)?|e|E|a|A|hh?|HH?|mm?|ss?|S{1,9}|x|X|zz?|ZZ?|.)/g;

    var localFormattingTokens = /(\[[^\[]*\])|(\\)?(LTS|LT|LL?L?L?|l{1,4})/g;

    var formatFunctions = {};

    var formatTokenFunctions = {};

    // token:    'M'
    // padded:   ['MM', 2]
    // ordinal:  'Mo'
    // callback: function () { this.month() + 1 }
    function addFormatToken (token, padded, ordinal, callback) {
        var func = callback;
        if (typeof callback === 'string') {
            func = function () {
                return this[callback]();
            };
        }
        if (token) {
            formatTokenFunctions[token] = func;
        }
        if (padded) {
            formatTokenFunctions[padded[0]] = function () {
                return zeroFill(func.apply(this, arguments), padded[1], padded[2]);
            };
        }
        if (ordinal) {
            formatTokenFunctions[ordinal] = function () {
                return this.localeData().ordinal(func.apply(this, arguments), token);
            };
        }
    }

    function removeFormattingTokens(input) {
        if (input.match(/\[[\s\S]/)) {
            return input.replace(/^\[|\]$/g, '');
        }
        return input.replace(/\\/g, '');
    }

    function makeFormatFunction(format) {
        var array = format.match(formattingTokens), i, length;

        for (i = 0, length = array.length; i < length; i++) {
            if (formatTokenFunctions[array[i]]) {
                array[i] = formatTokenFunctions[array[i]];
            } else {
                array[i] = removeFormattingTokens(array[i]);
            }
        }

        return function (mom) {
            var output = '';
            for (i = 0; i < length; i++) {
                output += array[i] instanceof Function ? array[i].call(mom, format) : array[i];
            }
            return output;
        };
    }

    // format date using native date object
    function formatMoment(m, format) {
        if (!m.isValid()) {
            return m.localeData().invalidDate();
        }

        format = expandFormat(format, m.localeData());
        formatFunctions[format] = formatFunctions[format] || makeFormatFunction(format);

        return formatFunctions[format](m);
    }

    function expandFormat(format, locale) {
        var i = 5;

        function replaceLongDateFormatTokens(input) {
            return locale.longDateFormat(input) || input;
        }

        localFormattingTokens.lastIndex = 0;
        while (i >= 0 && localFormattingTokens.test(format)) {
            format = format.replace(localFormattingTokens, replaceLongDateFormatTokens);
            localFormattingTokens.lastIndex = 0;
            i -= 1;
        }

        return format;
    }

    var match1         = /\d/;            //       0 - 9
    var match2         = /\d\d/;          //      00 - 99
    var match3         = /\d{3}/;         //     000 - 999
    var match4         = /\d{4}/;         //    0000 - 9999
    var match6         = /[+-]?\d{6}/;    // -999999 - 999999
    var match1to2      = /\d\d?/;         //       0 - 99
    var match1to3      = /\d{1,3}/;       //       0 - 999
    var match1to4      = /\d{1,4}/;       //       0 - 9999
    var match1to6      = /[+-]?\d{1,6}/;  // -999999 - 999999

    var matchUnsigned  = /\d+/;           //       0 - inf
    var matchSigned    = /[+-]?\d+/;      //    -inf - inf

    var matchOffset    = /Z|[+-]\d\d:?\d\d/gi; // +00:00 -00:00 +0000 -0000 or Z

    var matchTimestamp = /[+-]?\d+(\.\d{1,3})?/; // 123456789 123456789.123

    // any word (or two) characters or numbers including two/three word month in arabic.
    var matchWord = /[0-9]*['a-z\u00A0-\u05FF\u0700-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+|[\u0600-\u06FF\/]+(\s*?[\u0600-\u06FF]+){1,2}/i;

    var regexes = {};

    function isFunction (sth) {
        // https://github.com/moment/moment/issues/2325
        return typeof sth === 'function' &&
            Object.prototype.toString.call(sth) === '[object Function]';
    }


    function addRegexToken (token, regex, strictRegex) {
        regexes[token] = isFunction(regex) ? regex : function (isStrict) {
            return (isStrict && strictRegex) ? strictRegex : regex;
        };
    }

    function getParseRegexForToken (token, config) {
        if (!hasOwnProp(regexes, token)) {
            return new RegExp(unescapeFormat(token));
        }

        return regexes[token](config._strict, config._locale);
    }

    // Code from http://stackoverflow.com/questions/3561493/is-there-a-regexp-escape-function-in-javascript
    function unescapeFormat(s) {
        return s.replace('\\', '').replace(/\\(\[)|\\(\])|\[([^\]\[]*)\]|\\(.)/g, function (matched, p1, p2, p3, p4) {
            return p1 || p2 || p3 || p4;
        }).replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
    }

    var tokens = {};

    function addParseToken (token, callback) {
        var i, func = callback;
        if (typeof token === 'string') {
            token = [token];
        }
        if (typeof callback === 'number') {
            func = function (input, array) {
                array[callback] = toInt(input);
            };
        }
        for (i = 0; i < token.length; i++) {
            tokens[token[i]] = func;
        }
    }

    function addWeekParseToken (token, callback) {
        addParseToken(token, function (input, array, config, token) {
            config._w = config._w || {};
            callback(input, config._w, config, token);
        });
    }

    function addTimeToArrayFromToken(token, input, config) {
        if (input != null && hasOwnProp(tokens, token)) {
            tokens[token](input, config._a, config, token);
        }
    }

    var YEAR = 0;
    var MONTH = 1;
    var DATE = 2;
    var HOUR = 3;
    var MINUTE = 4;
    var SECOND = 5;
    var MILLISECOND = 6;

    function daysInMonth(year, month) {
        return new Date(Date.UTC(year, month + 1, 0)).getUTCDate();
    }

    // FORMATTING

    addFormatToken('M', ['MM', 2], 'Mo', function () {
        return this.month() + 1;
    });

    addFormatToken('MMM', 0, 0, function (format) {
        return this.localeData().monthsShort(this, format);
    });

    addFormatToken('MMMM', 0, 0, function (format) {
        return this.localeData().months(this, format);
    });

    // ALIASES

    addUnitAlias('month', 'M');

    // PARSING

    addRegexToken('M',    match1to2);
    addRegexToken('MM',   match1to2, match2);
    addRegexToken('MMM',  matchWord);
    addRegexToken('MMMM', matchWord);

    addParseToken(['M', 'MM'], function (input, array) {
        array[MONTH] = toInt(input) - 1;
    });

    addParseToken(['MMM', 'MMMM'], function (input, array, config, token) {
        var month = config._locale.monthsParse(input, token, config._strict);
        // if we didn't find a month name, mark the date as invalid.
        if (month != null) {
            array[MONTH] = month;
        } else {
            getParsingFlags(config).invalidMonth = input;
        }
    });

    // LOCALES

    var defaultLocaleMonths = 'January_February_March_April_May_June_July_August_September_October_November_December'.split('_');
    function localeMonths (m) {
        return this._months[m.month()];
    }

    var defaultLocaleMonthsShort = 'Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec'.split('_');
    function localeMonthsShort (m) {
        return this._monthsShort[m.month()];
    }

    function localeMonthsParse (monthName, format, strict) {
        var i, mom, regex;

        if (!this._monthsParse) {
            this._monthsParse = [];
            this._longMonthsParse = [];
            this._shortMonthsParse = [];
        }

        for (i = 0; i < 12; i++) {
            // make the regex if we don't have it already
            mom = create_utc__createUTC([2000, i]);
            if (strict && !this._longMonthsParse[i]) {
                this._longMonthsParse[i] = new RegExp('^' + this.months(mom, '').replace('.', '') + '$', 'i');
                this._shortMonthsParse[i] = new RegExp('^' + this.monthsShort(mom, '').replace('.', '') + '$', 'i');
            }
            if (!strict && !this._monthsParse[i]) {
                regex = '^' + this.months(mom, '') + '|^' + this.monthsShort(mom, '');
                this._monthsParse[i] = new RegExp(regex.replace('.', ''), 'i');
            }
            // test the regex
            if (strict && format === 'MMMM' && this._longMonthsParse[i].test(monthName)) {
                return i;
            } else if (strict && format === 'MMM' && this._shortMonthsParse[i].test(monthName)) {
                return i;
            } else if (!strict && this._monthsParse[i].test(monthName)) {
                return i;
            }
        }
    }

    // MOMENTS

    function setMonth (mom, value) {
        var dayOfMonth;

        // TODO: Move this out of here!
        if (typeof value === 'string') {
            value = mom.localeData().monthsParse(value);
            // TODO: Another silent failure?
            if (typeof value !== 'number') {
                return mom;
            }
        }

        dayOfMonth = Math.min(mom.date(), daysInMonth(mom.year(), value));
        mom._d['set' + (mom._isUTC ? 'UTC' : '') + 'Month'](value, dayOfMonth);
        return mom;
    }

    function getSetMonth (value) {
        if (value != null) {
            setMonth(this, value);
            utils_hooks__hooks.updateOffset(this, true);
            return this;
        } else {
            return get_set__get(this, 'Month');
        }
    }

    function getDaysInMonth () {
        return daysInMonth(this.year(), this.month());
    }

    function checkOverflow (m) {
        var overflow;
        var a = m._a;

        if (a && getParsingFlags(m).overflow === -2) {
            overflow =
                a[MONTH]       < 0 || a[MONTH]       > 11  ? MONTH :
                a[DATE]        < 1 || a[DATE]        > daysInMonth(a[YEAR], a[MONTH]) ? DATE :
                a[HOUR]        < 0 || a[HOUR]        > 24 || (a[HOUR] === 24 && (a[MINUTE] !== 0 || a[SECOND] !== 0 || a[MILLISECOND] !== 0)) ? HOUR :
                a[MINUTE]      < 0 || a[MINUTE]      > 59  ? MINUTE :
                a[SECOND]      < 0 || a[SECOND]      > 59  ? SECOND :
                a[MILLISECOND] < 0 || a[MILLISECOND] > 999 ? MILLISECOND :
                -1;

            if (getParsingFlags(m)._overflowDayOfYear && (overflow < YEAR || overflow > DATE)) {
                overflow = DATE;
            }

            getParsingFlags(m).overflow = overflow;
        }

        return m;
    }

    function warn(msg) {
        if (utils_hooks__hooks.suppressDeprecationWarnings === false && typeof console !== 'undefined' && console.warn) {
            console.warn('Deprecation warning: ' + msg);
        }
    }

    function deprecate(msg, fn) {
        var firstTime = true;

        return extend(function () {
            if (firstTime) {
                warn(msg + '\n' + (new Error()).stack);
                firstTime = false;
            }
            return fn.apply(this, arguments);
        }, fn);
    }

    var deprecations = {};

    function deprecateSimple(name, msg) {
        if (!deprecations[name]) {
            warn(msg);
            deprecations[name] = true;
        }
    }

    utils_hooks__hooks.suppressDeprecationWarnings = false;

    var from_string__isoRegex = /^\s*(?:[+-]\d{6}|\d{4})-(?:(\d\d-\d\d)|(W\d\d$)|(W\d\d-\d)|(\d\d\d))((T| )(\d\d(:\d\d(:\d\d(\.\d+)?)?)?)?([\+\-]\d\d(?::?\d\d)?|\s*Z)?)?$/;

    var isoDates = [
        ['YYYYYY-MM-DD', /[+-]\d{6}-\d{2}-\d{2}/],
        ['YYYY-MM-DD', /\d{4}-\d{2}-\d{2}/],
        ['GGGG-[W]WW-E', /\d{4}-W\d{2}-\d/],
        ['GGGG-[W]WW', /\d{4}-W\d{2}/],
        ['YYYY-DDD', /\d{4}-\d{3}/]
    ];

    // iso time formats and regexes
    var isoTimes = [
        ['HH:mm:ss.SSSS', /(T| )\d\d:\d\d:\d\d\.\d+/],
        ['HH:mm:ss', /(T| )\d\d:\d\d:\d\d/],
        ['HH:mm', /(T| )\d\d:\d\d/],
        ['HH', /(T| )\d\d/]
    ];

    var aspNetJsonRegex = /^\/?Date\((\-?\d+)/i;

    // date from iso format
    function configFromISO(config) {
        var i, l,
            string = config._i,
            match = from_string__isoRegex.exec(string);

        if (match) {
            getParsingFlags(config).iso = true;
            for (i = 0, l = isoDates.length; i < l; i++) {
                if (isoDates[i][1].exec(string)) {
                    config._f = isoDates[i][0];
                    break;
                }
            }
            for (i = 0, l = isoTimes.length; i < l; i++) {
                if (isoTimes[i][1].exec(string)) {
                    // match[6] should be 'T' or space
                    config._f += (match[6] || ' ') + isoTimes[i][0];
                    break;
                }
            }
            if (string.match(matchOffset)) {
                config._f += 'Z';
            }
            configFromStringAndFormat(config);
        } else {
            config._isValid = false;
        }
    }

    // date from iso format or fallback
    function configFromString(config) {
        var matched = aspNetJsonRegex.exec(config._i);

        if (matched !== null) {
            config._d = new Date(+matched[1]);
            return;
        }

        configFromISO(config);
        if (config._isValid === false) {
            delete config._isValid;
            utils_hooks__hooks.createFromInputFallback(config);
        }
    }

    utils_hooks__hooks.createFromInputFallback = deprecate(
        'moment construction falls back to js Date. This is ' +
        'discouraged and will be removed in upcoming major ' +
        'release. Please refer to ' +
        'https://github.com/moment/moment/issues/1407 for more info.',
        function (config) {
            config._d = new Date(config._i + (config._useUTC ? ' UTC' : ''));
        }
    );

    function createDate (y, m, d, h, M, s, ms) {
        //can't just apply() to create a date:
        //http://stackoverflow.com/questions/181348/instantiating-a-javascript-object-by-calling-prototype-constructor-apply
        var date = new Date(y, m, d, h, M, s, ms);

        //the date constructor doesn't accept years < 1970
        if (y < 1970) {
            date.setFullYear(y);
        }
        return date;
    }

    function createUTCDate (y) {
        var date = new Date(Date.UTC.apply(null, arguments));
        if (y < 1970) {
            date.setUTCFullYear(y);
        }
        return date;
    }

    addFormatToken(0, ['YY', 2], 0, function () {
        return this.year() % 100;
    });

    addFormatToken(0, ['YYYY',   4],       0, 'year');
    addFormatToken(0, ['YYYYY',  5],       0, 'year');
    addFormatToken(0, ['YYYYYY', 6, true], 0, 'year');

    // ALIASES

    addUnitAlias('year', 'y');

    // PARSING

    addRegexToken('Y',      matchSigned);
    addRegexToken('YY',     match1to2, match2);
    addRegexToken('YYYY',   match1to4, match4);
    addRegexToken('YYYYY',  match1to6, match6);
    addRegexToken('YYYYYY', match1to6, match6);

    addParseToken(['YYYYY', 'YYYYYY'], YEAR);
    addParseToken('YYYY', function (input, array) {
        array[YEAR] = input.length === 2 ? utils_hooks__hooks.parseTwoDigitYear(input) : toInt(input);
    });
    addParseToken('YY', function (input, array) {
        array[YEAR] = utils_hooks__hooks.parseTwoDigitYear(input);
    });

    // HELPERS

    function daysInYear(year) {
        return isLeapYear(year) ? 366 : 365;
    }

    function isLeapYear(year) {
        return (year % 4 === 0 && year % 100 !== 0) || year % 400 === 0;
    }

    // HOOKS

    utils_hooks__hooks.parseTwoDigitYear = function (input) {
        return toInt(input) + (toInt(input) > 68 ? 1900 : 2000);
    };

    // MOMENTS

    var getSetYear = makeGetSet('FullYear', false);

    function getIsLeapYear () {
        return isLeapYear(this.year());
    }

    addFormatToken('w', ['ww', 2], 'wo', 'week');
    addFormatToken('W', ['WW', 2], 'Wo', 'isoWeek');

    // ALIASES

    addUnitAlias('week', 'w');
    addUnitAlias('isoWeek', 'W');

    // PARSING

    addRegexToken('w',  match1to2);
    addRegexToken('ww', match1to2, match2);
    addRegexToken('W',  match1to2);
    addRegexToken('WW', match1to2, match2);

    addWeekParseToken(['w', 'ww', 'W', 'WW'], function (input, week, config, token) {
        week[token.substr(0, 1)] = toInt(input);
    });

    // HELPERS

    // firstDayOfWeek       0 = sun, 6 = sat
    //                      the day of the week that starts the week
    //                      (usually sunday or monday)
    // firstDayOfWeekOfYear 0 = sun, 6 = sat
    //                      the first week is the week that contains the first
    //                      of this day of the week
    //                      (eg. ISO weeks use thursday (4))
    function weekOfYear(mom, firstDayOfWeek, firstDayOfWeekOfYear) {
        var end = firstDayOfWeekOfYear - firstDayOfWeek,
            daysToDayOfWeek = firstDayOfWeekOfYear - mom.day(),
            adjustedMoment;


        if (daysToDayOfWeek > end) {
            daysToDayOfWeek -= 7;
        }

        if (daysToDayOfWeek < end - 7) {
            daysToDayOfWeek += 7;
        }

        adjustedMoment = local__createLocal(mom).add(daysToDayOfWeek, 'd');
        return {
            week: Math.ceil(adjustedMoment.dayOfYear() / 7),
            year: adjustedMoment.year()
        };
    }

    // LOCALES

    function localeWeek (mom) {
        return weekOfYear(mom, this._week.dow, this._week.doy).week;
    }

    var defaultLocaleWeek = {
        dow : 0, // Sunday is the first day of the week.
        doy : 6  // The week that contains Jan 1st is the first week of the year.
    };

    function localeFirstDayOfWeek () {
        return this._week.dow;
    }

    function localeFirstDayOfYear () {
        return this._week.doy;
    }

    // MOMENTS

    function getSetWeek (input) {
        var week = this.localeData().week(this);
        return input == null ? week : this.add((input - week) * 7, 'd');
    }

    function getSetISOWeek (input) {
        var week = weekOfYear(this, 1, 4).week;
        return input == null ? week : this.add((input - week) * 7, 'd');
    }

    addFormatToken('DDD', ['DDDD', 3], 'DDDo', 'dayOfYear');

    // ALIASES

    addUnitAlias('dayOfYear', 'DDD');

    // PARSING

    addRegexToken('DDD',  match1to3);
    addRegexToken('DDDD', match3);
    addParseToken(['DDD', 'DDDD'], function (input, array, config) {
        config._dayOfYear = toInt(input);
    });

    // HELPERS

    //http://en.wikipedia.org/wiki/ISO_week_date#Calculating_a_date_given_the_year.2C_week_number_and_weekday
    function dayOfYearFromWeeks(year, week, weekday, firstDayOfWeekOfYear, firstDayOfWeek) {
        var week1Jan = 6 + firstDayOfWeek - firstDayOfWeekOfYear, janX = createUTCDate(year, 0, 1 + week1Jan), d = janX.getUTCDay(), dayOfYear;
        if (d < firstDayOfWeek) {
            d += 7;
        }

        weekday = weekday != null ? 1 * weekday : firstDayOfWeek;

        dayOfYear = 1 + week1Jan + 7 * (week - 1) - d + weekday;

        return {
            year: dayOfYear > 0 ? year : year - 1,
            dayOfYear: dayOfYear > 0 ?  dayOfYear : daysInYear(year - 1) + dayOfYear
        };
    }

    // MOMENTS

    function getSetDayOfYear (input) {
        var dayOfYear = Math.round((this.clone().startOf('day') - this.clone().startOf('year')) / 864e5) + 1;
        return input == null ? dayOfYear : this.add((input - dayOfYear), 'd');
    }

    // Pick the first defined of two or three arguments.
    function defaults(a, b, c) {
        if (a != null) {
            return a;
        }
        if (b != null) {
            return b;
        }
        return c;
    }

    function currentDateArray(config) {
        var now = new Date();
        if (config._useUTC) {
            return [now.getUTCFullYear(), now.getUTCMonth(), now.getUTCDate()];
        }
        return [now.getFullYear(), now.getMonth(), now.getDate()];
    }

    // convert an array to a date.
    // the array should mirror the parameters below
    // note: all values past the year are optional and will default to the lowest possible value.
    // [year, month, day , hour, minute, second, millisecond]
    function configFromArray (config) {
        var i, date, input = [], currentDate, yearToUse;

        if (config._d) {
            return;
        }

        currentDate = currentDateArray(config);

        //compute day of the year from weeks and weekdays
        if (config._w && config._a[DATE] == null && config._a[MONTH] == null) {
            dayOfYearFromWeekInfo(config);
        }

        //if the day of the year is set, figure out what it is
        if (config._dayOfYear) {
            yearToUse = defaults(config._a[YEAR], currentDate[YEAR]);

            if (config._dayOfYear > daysInYear(yearToUse)) {
                getParsingFlags(config)._overflowDayOfYear = true;
            }

            date = createUTCDate(yearToUse, 0, config._dayOfYear);
            config._a[MONTH] = date.getUTCMonth();
            config._a[DATE] = date.getUTCDate();
        }

        // Default to current date.
        // * if no year, month, day of month are given, default to today
        // * if day of month is given, default month and year
        // * if month is given, default only year
        // * if year is given, don't default anything
        for (i = 0; i < 3 && config._a[i] == null; ++i) {
            config._a[i] = input[i] = currentDate[i];
        }

        // Zero out whatever was not defaulted, including time
        for (; i < 7; i++) {
            config._a[i] = input[i] = (config._a[i] == null) ? (i === 2 ? 1 : 0) : config._a[i];
        }

        // Check for 24:00:00.000
        if (config._a[HOUR] === 24 &&
                config._a[MINUTE] === 0 &&
                config._a[SECOND] === 0 &&
                config._a[MILLISECOND] === 0) {
            config._nextDay = true;
            config._a[HOUR] = 0;
        }

        config._d = (config._useUTC ? createUTCDate : createDate).apply(null, input);
        // Apply timezone offset from input. The actual utcOffset can be changed
        // with parseZone.
        if (config._tzm != null) {
            config._d.setUTCMinutes(config._d.getUTCMinutes() - config._tzm);
        }

        if (config._nextDay) {
            config._a[HOUR] = 24;
        }
    }

    function dayOfYearFromWeekInfo(config) {
        var w, weekYear, week, weekday, dow, doy, temp;

        w = config._w;
        if (w.GG != null || w.W != null || w.E != null) {
            dow = 1;
            doy = 4;

            // TODO: We need to take the current isoWeekYear, but that depends on
            // how we interpret now (local, utc, fixed offset). So create
            // a now version of current config (take local/utc/offset flags, and
            // create now).
            weekYear = defaults(w.GG, config._a[YEAR], weekOfYear(local__createLocal(), 1, 4).year);
            week = defaults(w.W, 1);
            weekday = defaults(w.E, 1);
        } else {
            dow = config._locale._week.dow;
            doy = config._locale._week.doy;

            weekYear = defaults(w.gg, config._a[YEAR], weekOfYear(local__createLocal(), dow, doy).year);
            week = defaults(w.w, 1);

            if (w.d != null) {
                // weekday -- low day numbers are considered next week
                weekday = w.d;
                if (weekday < dow) {
                    ++week;
                }
            } else if (w.e != null) {
                // local weekday -- counting starts from begining of week
                weekday = w.e + dow;
            } else {
                // default to begining of week
                weekday = dow;
            }
        }
        temp = dayOfYearFromWeeks(weekYear, week, weekday, doy, dow);

        config._a[YEAR] = temp.year;
        config._dayOfYear = temp.dayOfYear;
    }

    utils_hooks__hooks.ISO_8601 = function () {};

    // date from string and format string
    function configFromStringAndFormat(config) {
        // TODO: Move this to another part of the creation flow to prevent circular deps
        if (config._f === utils_hooks__hooks.ISO_8601) {
            configFromISO(config);
            return;
        }

        config._a = [];
        getParsingFlags(config).empty = true;

        // This array is used to make a Date, either with `new Date` or `Date.UTC`
        var string = '' + config._i,
            i, parsedInput, tokens, token, skipped,
            stringLength = string.length,
            totalParsedInputLength = 0;

        tokens = expandFormat(config._f, config._locale).match(formattingTokens) || [];

        for (i = 0; i < tokens.length; i++) {
            token = tokens[i];
            parsedInput = (string.match(getParseRegexForToken(token, config)) || [])[0];
            if (parsedInput) {
                skipped = string.substr(0, string.indexOf(parsedInput));
                if (skipped.length > 0) {
                    getParsingFlags(config).unusedInput.push(skipped);
                }
                string = string.slice(string.indexOf(parsedInput) + parsedInput.length);
                totalParsedInputLength += parsedInput.length;
            }
            // don't parse if it's not a known token
            if (formatTokenFunctions[token]) {
                if (parsedInput) {
                    getParsingFlags(config).empty = false;
                }
                else {
                    getParsingFlags(config).unusedTokens.push(token);
                }
                addTimeToArrayFromToken(token, parsedInput, config);
            }
            else if (config._strict && !parsedInput) {
                getParsingFlags(config).unusedTokens.push(token);
            }
        }

        // add remaining unparsed input length to the string
        getParsingFlags(config).charsLeftOver = stringLength - totalParsedInputLength;
        if (string.length > 0) {
            getParsingFlags(config).unusedInput.push(string);
        }

        // clear _12h flag if hour is <= 12
        if (getParsingFlags(config).bigHour === true &&
                config._a[HOUR] <= 12 &&
                config._a[HOUR] > 0) {
            getParsingFlags(config).bigHour = undefined;
        }
        // handle meridiem
        config._a[HOUR] = meridiemFixWrap(config._locale, config._a[HOUR], config._meridiem);

        configFromArray(config);
        checkOverflow(config);
    }


    function meridiemFixWrap (locale, hour, meridiem) {
        var isPm;

        if (meridiem == null) {
            // nothing to do
            return hour;
        }
        if (locale.meridiemHour != null) {
            return locale.meridiemHour(hour, meridiem);
        } else if (locale.isPM != null) {
            // Fallback
            isPm = locale.isPM(meridiem);
            if (isPm && hour < 12) {
                hour += 12;
            }
            if (!isPm && hour === 12) {
                hour = 0;
            }
            return hour;
        } else {
            // this is not supposed to happen
            return hour;
        }
    }

    function configFromStringAndArray(config) {
        var tempConfig,
            bestMoment,

            scoreToBeat,
            i,
            currentScore;

        if (config._f.length === 0) {
            getParsingFlags(config).invalidFormat = true;
            config._d = new Date(NaN);
            return;
        }

        for (i = 0; i < config._f.length; i++) {
            currentScore = 0;
            tempConfig = copyConfig({}, config);
            if (config._useUTC != null) {
                tempConfig._useUTC = config._useUTC;
            }
            tempConfig._f = config._f[i];
            configFromStringAndFormat(tempConfig);

            if (!valid__isValid(tempConfig)) {
                continue;
            }

            // if there is any input that was not parsed add a penalty for that format
            currentScore += getParsingFlags(tempConfig).charsLeftOver;

            //or tokens
            currentScore += getParsingFlags(tempConfig).unusedTokens.length * 10;

            getParsingFlags(tempConfig).score = currentScore;

            if (scoreToBeat == null || currentScore < scoreToBeat) {
                scoreToBeat = currentScore;
                bestMoment = tempConfig;
            }
        }

        extend(config, bestMoment || tempConfig);
    }

    function configFromObject(config) {
        if (config._d) {
            return;
        }

        var i = normalizeObjectUnits(config._i);
        config._a = [i.year, i.month, i.day || i.date, i.hour, i.minute, i.second, i.millisecond];

        configFromArray(config);
    }

    function createFromConfig (config) {
        var res = new Moment(checkOverflow(prepareConfig(config)));
        if (res._nextDay) {
            // Adding is smart enough around DST
            res.add(1, 'd');
            res._nextDay = undefined;
        }

        return res;
    }

    function prepareConfig (config) {
        var input = config._i,
            format = config._f;

        config._locale = config._locale || locale_locales__getLocale(config._l);

        if (input === null || (format === undefined && input === '')) {
            return valid__createInvalid({nullInput: true});
        }

        if (typeof input === 'string') {
            config._i = input = config._locale.preparse(input);
        }

        if (isMoment(input)) {
            return new Moment(checkOverflow(input));
        } else if (isArray(format)) {
            configFromStringAndArray(config);
        } else if (format) {
            configFromStringAndFormat(config);
        } else if (isDate(input)) {
            config._d = input;
        } else {
            configFromInput(config);
        }

        return config;
    }

    function configFromInput(config) {
        var input = config._i;
        if (input === undefined) {
            config._d = new Date();
        } else if (isDate(input)) {
            config._d = new Date(+input);
        } else if (typeof input === 'string') {
            configFromString(config);
        } else if (isArray(input)) {
            config._a = map(input.slice(0), function (obj) {
                return parseInt(obj, 10);
            });
            configFromArray(config);
        } else if (typeof(input) === 'object') {
            configFromObject(config);
        } else if (typeof(input) === 'number') {
            // from milliseconds
            config._d = new Date(input);
        } else {
            utils_hooks__hooks.createFromInputFallback(config);
        }
    }

    function createLocalOrUTC (input, format, locale, strict, isUTC) {
        var c = {};

        if (typeof(locale) === 'boolean') {
            strict = locale;
            locale = undefined;
        }
        // object construction must be done this way.
        // https://github.com/moment/moment/issues/1423
        c._isAMomentObject = true;
        c._useUTC = c._isUTC = isUTC;
        c._l = locale;
        c._i = input;
        c._f = format;
        c._strict = strict;

        return createFromConfig(c);
    }

    function local__createLocal (input, format, locale, strict) {
        return createLocalOrUTC(input, format, locale, strict, false);
    }

    var prototypeMin = deprecate(
         'moment().min is deprecated, use moment.min instead. https://github.com/moment/moment/issues/1548',
         function () {
             var other = local__createLocal.apply(null, arguments);
             return other < this ? this : other;
         }
     );

    var prototypeMax = deprecate(
        'moment().max is deprecated, use moment.max instead. https://github.com/moment/moment/issues/1548',
        function () {
            var other = local__createLocal.apply(null, arguments);
            return other > this ? this : other;
        }
    );

    // Pick a moment m from moments so that m[fn](other) is true for all
    // other. This relies on the function fn to be transitive.
    //
    // moments should either be an array of moment objects or an array, whose
    // first element is an array of moment objects.
    function pickBy(fn, moments) {
        var res, i;
        if (moments.length === 1 && isArray(moments[0])) {
            moments = moments[0];
        }
        if (!moments.length) {
            return local__createLocal();
        }
        res = moments[0];
        for (i = 1; i < moments.length; ++i) {
            if (!moments[i].isValid() || moments[i][fn](res)) {
                res = moments[i];
            }
        }
        return res;
    }

    // TODO: Use [].sort instead?
    function min () {
        var args = [].slice.call(arguments, 0);

        return pickBy('isBefore', args);
    }

    function max () {
        var args = [].slice.call(arguments, 0);

        return pickBy('isAfter', args);
    }

    function Duration (duration) {
        var normalizedInput = normalizeObjectUnits(duration),
            years = normalizedInput.year || 0,
            quarters = normalizedInput.quarter || 0,
            months = normalizedInput.month || 0,
            weeks = normalizedInput.week || 0,
            days = normalizedInput.day || 0,
            hours = normalizedInput.hour || 0,
            minutes = normalizedInput.minute || 0,
            seconds = normalizedInput.second || 0,
            milliseconds = normalizedInput.millisecond || 0;

        // representation for dateAddRemove
        this._milliseconds = +milliseconds +
            seconds * 1e3 + // 1000
            minutes * 6e4 + // 1000 * 60
            hours * 36e5; // 1000 * 60 * 60
        // Because of dateAddRemove treats 24 hours as different from a
        // day when working around DST, we need to store them separately
        this._days = +days +
            weeks * 7;
        // It is impossible translate months into days without knowing
        // which months you are are talking about, so we have to store
        // it separately.
        this._months = +months +
            quarters * 3 +
            years * 12;

        this._data = {};

        this._locale = locale_locales__getLocale();

        this._bubble();
    }

    function isDuration (obj) {
        return obj instanceof Duration;
    }

    function offset (token, separator) {
        addFormatToken(token, 0, 0, function () {
            var offset = this.utcOffset();
            var sign = '+';
            if (offset < 0) {
                offset = -offset;
                sign = '-';
            }
            return sign + zeroFill(~~(offset / 60), 2) + separator + zeroFill(~~(offset) % 60, 2);
        });
    }

    offset('Z', ':');
    offset('ZZ', '');

    // PARSING

    addRegexToken('Z',  matchOffset);
    addRegexToken('ZZ', matchOffset);
    addParseToken(['Z', 'ZZ'], function (input, array, config) {
        config._useUTC = true;
        config._tzm = offsetFromString(input);
    });

    // HELPERS

    // timezone chunker
    // '+10:00' > ['10',  '00']
    // '-1530'  > ['-15', '30']
    var chunkOffset = /([\+\-]|\d\d)/gi;

    function offsetFromString(string) {
        var matches = ((string || '').match(matchOffset) || []);
        var chunk   = matches[matches.length - 1] || [];
        var parts   = (chunk + '').match(chunkOffset) || ['-', 0, 0];
        var minutes = +(parts[1] * 60) + toInt(parts[2]);

        return parts[0] === '+' ? minutes : -minutes;
    }

    // Return a moment from input, that is local/utc/zone equivalent to model.
    function cloneWithOffset(input, model) {
        var res, diff;
        if (model._isUTC) {
            res = model.clone();
            diff = (isMoment(input) || isDate(input) ? +input : +local__createLocal(input)) - (+res);
            // Use low-level api, because this fn is low-level api.
            res._d.setTime(+res._d + diff);
            utils_hooks__hooks.updateOffset(res, false);
            return res;
        } else {
            return local__createLocal(input).local();
        }
    }

    function getDateOffset (m) {
        // On Firefox.24 Date#getTimezoneOffset returns a floating point.
        // https://github.com/moment/moment/pull/1871
        return -Math.round(m._d.getTimezoneOffset() / 15) * 15;
    }

    // HOOKS

    // This function will be called whenever a moment is mutated.
    // It is intended to keep the offset in sync with the timezone.
    utils_hooks__hooks.updateOffset = function () {};

    // MOMENTS

    // keepLocalTime = true means only change the timezone, without
    // affecting the local hour. So 5:31:26 +0300 --[utcOffset(2, true)]-->
    // 5:31:26 +0200 It is possible that 5:31:26 doesn't exist with offset
    // +0200, so we adjust the time as needed, to be valid.
    //
    // Keeping the time actually adds/subtracts (one hour)
    // from the actual represented time. That is why we call updateOffset
    // a second time. In case it wants us to change the offset again
    // _changeInProgress == true case, then we have to adjust, because
    // there is no such time in the given timezone.
    function getSetOffset (input, keepLocalTime) {
        var offset = this._offset || 0,
            localAdjust;
        if (input != null) {
            if (typeof input === 'string') {
                input = offsetFromString(input);
            }
            if (Math.abs(input) < 16) {
                input = input * 60;
            }
            if (!this._isUTC && keepLocalTime) {
                localAdjust = getDateOffset(this);
            }
            this._offset = input;
            this._isUTC = true;
            if (localAdjust != null) {
                this.add(localAdjust, 'm');
            }
            if (offset !== input) {
                if (!keepLocalTime || this._changeInProgress) {
                    add_subtract__addSubtract(this, create__createDuration(input - offset, 'm'), 1, false);
                } else if (!this._changeInProgress) {
                    this._changeInProgress = true;
                    utils_hooks__hooks.updateOffset(this, true);
                    this._changeInProgress = null;
                }
            }
            return this;
        } else {
            return this._isUTC ? offset : getDateOffset(this);
        }
    }

    function getSetZone (input, keepLocalTime) {
        if (input != null) {
            if (typeof input !== 'string') {
                input = -input;
            }

            this.utcOffset(input, keepLocalTime);

            return this;
        } else {
            return -this.utcOffset();
        }
    }

    function setOffsetToUTC (keepLocalTime) {
        return this.utcOffset(0, keepLocalTime);
    }

    function setOffsetToLocal (keepLocalTime) {
        if (this._isUTC) {
            this.utcOffset(0, keepLocalTime);
            this._isUTC = false;

            if (keepLocalTime) {
                this.subtract(getDateOffset(this), 'm');
            }
        }
        return this;
    }

    function setOffsetToParsedOffset () {
        if (this._tzm) {
            this.utcOffset(this._tzm);
        } else if (typeof this._i === 'string') {
            this.utcOffset(offsetFromString(this._i));
        }
        return this;
    }

    function hasAlignedHourOffset (input) {
        input = input ? local__createLocal(input).utcOffset() : 0;

        return (this.utcOffset() - input) % 60 === 0;
    }

    function isDaylightSavingTime () {
        return (
            this.utcOffset() > this.clone().month(0).utcOffset() ||
            this.utcOffset() > this.clone().month(5).utcOffset()
        );
    }

    function isDaylightSavingTimeShifted () {
        if (typeof this._isDSTShifted !== 'undefined') {
            return this._isDSTShifted;
        }

        var c = {};

        copyConfig(c, this);
        c = prepareConfig(c);

        if (c._a) {
            var other = c._isUTC ? create_utc__createUTC(c._a) : local__createLocal(c._a);
            this._isDSTShifted = this.isValid() &&
                compareArrays(c._a, other.toArray()) > 0;
        } else {
            this._isDSTShifted = false;
        }

        return this._isDSTShifted;
    }

    function isLocal () {
        return !this._isUTC;
    }

    function isUtcOffset () {
        return this._isUTC;
    }

    function isUtc () {
        return this._isUTC && this._offset === 0;
    }

    var aspNetRegex = /(\-)?(?:(\d*)\.)?(\d+)\:(\d+)(?:\:(\d+)\.?(\d{3})?)?/;

    // from http://docs.closure-library.googlecode.com/git/closure_goog_date_date.js.source.html
    // somewhat more in line with 4.4.3.2 2004 spec, but allows decimal anywhere
    var create__isoRegex = /^(-)?P(?:(?:([0-9,.]*)Y)?(?:([0-9,.]*)M)?(?:([0-9,.]*)D)?(?:T(?:([0-9,.]*)H)?(?:([0-9,.]*)M)?(?:([0-9,.]*)S)?)?|([0-9,.]*)W)$/;

    function create__createDuration (input, key) {
        var duration = input,
            // matching against regexp is expensive, do it on demand
            match = null,
            sign,
            ret,
            diffRes;

        if (isDuration(input)) {
            duration = {
                ms : input._milliseconds,
                d  : input._days,
                M  : input._months
            };
        } else if (typeof input === 'number') {
            duration = {};
            if (key) {
                duration[key] = input;
            } else {
                duration.milliseconds = input;
            }
        } else if (!!(match = aspNetRegex.exec(input))) {
            sign = (match[1] === '-') ? -1 : 1;
            duration = {
                y  : 0,
                d  : toInt(match[DATE])        * sign,
                h  : toInt(match[HOUR])        * sign,
                m  : toInt(match[MINUTE])      * sign,
                s  : toInt(match[SECOND])      * sign,
                ms : toInt(match[MILLISECOND]) * sign
            };
        } else if (!!(match = create__isoRegex.exec(input))) {
            sign = (match[1] === '-') ? -1 : 1;
            duration = {
                y : parseIso(match[2], sign),
                M : parseIso(match[3], sign),
                d : parseIso(match[4], sign),
                h : parseIso(match[5], sign),
                m : parseIso(match[6], sign),
                s : parseIso(match[7], sign),
                w : parseIso(match[8], sign)
            };
        } else if (duration == null) {// checks for null or undefined
            duration = {};
        } else if (typeof duration === 'object' && ('from' in duration || 'to' in duration)) {
            diffRes = momentsDifference(local__createLocal(duration.from), local__createLocal(duration.to));

            duration = {};
            duration.ms = diffRes.milliseconds;
            duration.M = diffRes.months;
        }

        ret = new Duration(duration);

        if (isDuration(input) && hasOwnProp(input, '_locale')) {
            ret._locale = input._locale;
        }

        return ret;
    }

    create__createDuration.fn = Duration.prototype;

    function parseIso (inp, sign) {
        // We'd normally use ~~inp for this, but unfortunately it also
        // converts floats to ints.
        // inp may be undefined, so careful calling replace on it.
        var res = inp && parseFloat(inp.replace(',', '.'));
        // apply sign while we're at it
        return (isNaN(res) ? 0 : res) * sign;
    }

    function positiveMomentsDifference(base, other) {
        var res = {milliseconds: 0, months: 0};

        res.months = other.month() - base.month() +
            (other.year() - base.year()) * 12;
        if (base.clone().add(res.months, 'M').isAfter(other)) {
            --res.months;
        }

        res.milliseconds = +other - +(base.clone().add(res.months, 'M'));

        return res;
    }

    function momentsDifference(base, other) {
        var res;
        other = cloneWithOffset(other, base);
        if (base.isBefore(other)) {
            res = positiveMomentsDifference(base, other);
        } else {
            res = positiveMomentsDifference(other, base);
            res.milliseconds = -res.milliseconds;
            res.months = -res.months;
        }

        return res;
    }

    function createAdder(direction, name) {
        return function (val, period) {
            var dur, tmp;
            //invert the arguments, but complain about it
            if (period !== null && !isNaN(+period)) {
                deprecateSimple(name, 'moment().' + name  + '(period, number) is deprecated. Please use moment().' + name + '(number, period).');
                tmp = val; val = period; period = tmp;
            }

            val = typeof val === 'string' ? +val : val;
            dur = create__createDuration(val, period);
            add_subtract__addSubtract(this, dur, direction);
            return this;
        };
    }

    function add_subtract__addSubtract (mom, duration, isAdding, updateOffset) {
        var milliseconds = duration._milliseconds,
            days = duration._days,
            months = duration._months;
        updateOffset = updateOffset == null ? true : updateOffset;

        if (milliseconds) {
            mom._d.setTime(+mom._d + milliseconds * isAdding);
        }
        if (days) {
            get_set__set(mom, 'Date', get_set__get(mom, 'Date') + days * isAdding);
        }
        if (months) {
            setMonth(mom, get_set__get(mom, 'Month') + months * isAdding);
        }
        if (updateOffset) {
            utils_hooks__hooks.updateOffset(mom, days || months);
        }
    }

    var add_subtract__add      = createAdder(1, 'add');
    var add_subtract__subtract = createAdder(-1, 'subtract');

    function moment_calendar__calendar (time, formats) {
        // We want to compare the start of today, vs this.
        // Getting start-of-today depends on whether we're local/utc/offset or not.
        var now = time || local__createLocal(),
            sod = cloneWithOffset(now, this).startOf('day'),
            diff = this.diff(sod, 'days', true),
            format = diff < -6 ? 'sameElse' :
                diff < -1 ? 'lastWeek' :
                diff < 0 ? 'lastDay' :
                diff < 1 ? 'sameDay' :
                diff < 2 ? 'nextDay' :
                diff < 7 ? 'nextWeek' : 'sameElse';
        return this.format(formats && formats[format] || this.localeData().calendar(format, this, local__createLocal(now)));
    }

    function clone () {
        return new Moment(this);
    }

    function isAfter (input, units) {
        var inputMs;
        units = normalizeUnits(typeof units !== 'undefined' ? units : 'millisecond');
        if (units === 'millisecond') {
            input = isMoment(input) ? input : local__createLocal(input);
            return +this > +input;
        } else {
            inputMs = isMoment(input) ? +input : +local__createLocal(input);
            return inputMs < +this.clone().startOf(units);
        }
    }

    function isBefore (input, units) {
        var inputMs;
        units = normalizeUnits(typeof units !== 'undefined' ? units : 'millisecond');
        if (units === 'millisecond') {
            input = isMoment(input) ? input : local__createLocal(input);
            return +this < +input;
        } else {
            inputMs = isMoment(input) ? +input : +local__createLocal(input);
            return +this.clone().endOf(units) < inputMs;
        }
    }

    function isBetween (from, to, units) {
        return this.isAfter(from, units) && this.isBefore(to, units);
    }

    function isSame (input, units) {
        var inputMs;
        units = normalizeUnits(units || 'millisecond');
        if (units === 'millisecond') {
            input = isMoment(input) ? input : local__createLocal(input);
            return +this === +input;
        } else {
            inputMs = +local__createLocal(input);
            return +(this.clone().startOf(units)) <= inputMs && inputMs <= +(this.clone().endOf(units));
        }
    }

    function diff (input, units, asFloat) {
        var that = cloneWithOffset(input, this),
            zoneDelta = (that.utcOffset() - this.utcOffset()) * 6e4,
            delta, output;

        units = normalizeUnits(units);

        if (units === 'year' || units === 'month' || units === 'quarter') {
            output = monthDiff(this, that);
            if (units === 'quarter') {
                output = output / 3;
            } else if (units === 'year') {
                output = output / 12;
            }
        } else {
            delta = this - that;
            output = units === 'second' ? delta / 1e3 : // 1000
                units === 'minute' ? delta / 6e4 : // 1000 * 60
                units === 'hour' ? delta / 36e5 : // 1000 * 60 * 60
                units === 'day' ? (delta - zoneDelta) / 864e5 : // 1000 * 60 * 60 * 24, negate dst
                units === 'week' ? (delta - zoneDelta) / 6048e5 : // 1000 * 60 * 60 * 24 * 7, negate dst
                delta;
        }
        return asFloat ? output : absFloor(output);
    }

    function monthDiff (a, b) {
        // difference in months
        var wholeMonthDiff = ((b.year() - a.year()) * 12) + (b.month() - a.month()),
            // b is in (anchor - 1 month, anchor + 1 month)
            anchor = a.clone().add(wholeMonthDiff, 'months'),
            anchor2, adjust;

        if (b - anchor < 0) {
            anchor2 = a.clone().add(wholeMonthDiff - 1, 'months');
            // linear across the month
            adjust = (b - anchor) / (anchor - anchor2);
        } else {
            anchor2 = a.clone().add(wholeMonthDiff + 1, 'months');
            // linear across the month
            adjust = (b - anchor) / (anchor2 - anchor);
        }

        return -(wholeMonthDiff + adjust);
    }

    utils_hooks__hooks.defaultFormat = 'YYYY-MM-DDTHH:mm:ssZ';

    function toString () {
        return this.clone().locale('en').format('ddd MMM DD YYYY HH:mm:ss [GMT]ZZ');
    }

    function moment_format__toISOString () {
        var m = this.clone().utc();
        if (0 < m.year() && m.year() <= 9999) {
            if ('function' === typeof Date.prototype.toISOString) {
                // native implementation is ~50x faster, use it when we can
                return this.toDate().toISOString();
            } else {
                return formatMoment(m, 'YYYY-MM-DD[T]HH:mm:ss.SSS[Z]');
            }
        } else {
            return formatMoment(m, 'YYYYYY-MM-DD[T]HH:mm:ss.SSS[Z]');
        }
    }

    function format (inputString) {
        var output = formatMoment(this, inputString || utils_hooks__hooks.defaultFormat);
        return this.localeData().postformat(output);
    }

    function from (time, withoutSuffix) {
        if (!this.isValid()) {
            return this.localeData().invalidDate();
        }
        return create__createDuration({to: this, from: time}).locale(this.locale()).humanize(!withoutSuffix);
    }

    function fromNow (withoutSuffix) {
        return this.from(local__createLocal(), withoutSuffix);
    }

    function to (time, withoutSuffix) {
        if (!this.isValid()) {
            return this.localeData().invalidDate();
        }
        return create__createDuration({from: this, to: time}).locale(this.locale()).humanize(!withoutSuffix);
    }

    function toNow (withoutSuffix) {
        return this.to(local__createLocal(), withoutSuffix);
    }

    function locale (key) {
        var newLocaleData;

        if (key === undefined) {
            return this._locale._abbr;
        } else {
            newLocaleData = locale_locales__getLocale(key);
            if (newLocaleData != null) {
                this._locale = newLocaleData;
            }
            return this;
        }
    }

    var lang = deprecate(
        'moment().lang() is deprecated. Instead, use moment().localeData() to get the language configuration. Use moment().locale() to change languages.',
        function (key) {
            if (key === undefined) {
                return this.localeData();
            } else {
                return this.locale(key);
            }
        }
    );

    function localeData () {
        return this._locale;
    }

    function startOf (units) {
        units = normalizeUnits(units);
        // the following switch intentionally omits break keywords
        // to utilize falling through the cases.
        switch (units) {
        case 'year':
            this.month(0);
            /* falls through */
        case 'quarter':
        case 'month':
            this.date(1);
            /* falls through */
        case 'week':
        case 'isoWeek':
        case 'day':
            this.hours(0);
            /* falls through */
        case 'hour':
            this.minutes(0);
            /* falls through */
        case 'minute':
            this.seconds(0);
            /* falls through */
        case 'second':
            this.milliseconds(0);
        }

        // weeks are a special case
        if (units === 'week') {
            this.weekday(0);
        }
        if (units === 'isoWeek') {
            this.isoWeekday(1);
        }

        // quarters are also special
        if (units === 'quarter') {
            this.month(Math.floor(this.month() / 3) * 3);
        }

        return this;
    }

    function endOf (units) {
        units = normalizeUnits(units);
        if (units === undefined || units === 'millisecond') {
            return this;
        }
        return this.startOf(units).add(1, (units === 'isoWeek' ? 'week' : units)).subtract(1, 'ms');
    }

    function to_type__valueOf () {
        return +this._d - ((this._offset || 0) * 60000);
    }

    function unix () {
        return Math.floor(+this / 1000);
    }

    function toDate () {
        return this._offset ? new Date(+this) : this._d;
    }

    function toArray () {
        var m = this;
        return [m.year(), m.month(), m.date(), m.hour(), m.minute(), m.second(), m.millisecond()];
    }

    function toObject () {
        var m = this;
        return {
            years: m.year(),
            months: m.month(),
            date: m.date(),
            hours: m.hours(),
            minutes: m.minutes(),
            seconds: m.seconds(),
            milliseconds: m.milliseconds()
        };
    }

    function moment_valid__isValid () {
        return valid__isValid(this);
    }

    function parsingFlags () {
        return extend({}, getParsingFlags(this));
    }

    function invalidAt () {
        return getParsingFlags(this).overflow;
    }

    addFormatToken(0, ['gg', 2], 0, function () {
        return this.weekYear() % 100;
    });

    addFormatToken(0, ['GG', 2], 0, function () {
        return this.isoWeekYear() % 100;
    });

    function addWeekYearFormatToken (token, getter) {
        addFormatToken(0, [token, token.length], 0, getter);
    }

    addWeekYearFormatToken('gggg',     'weekYear');
    addWeekYearFormatToken('ggggg',    'weekYear');
    addWeekYearFormatToken('GGGG',  'isoWeekYear');
    addWeekYearFormatToken('GGGGG', 'isoWeekYear');

    // ALIASES

    addUnitAlias('weekYear', 'gg');
    addUnitAlias('isoWeekYear', 'GG');

    // PARSING

    addRegexToken('G',      matchSigned);
    addRegexToken('g',      matchSigned);
    addRegexToken('GG',     match1to2, match2);
    addRegexToken('gg',     match1to2, match2);
    addRegexToken('GGGG',   match1to4, match4);
    addRegexToken('gggg',   match1to4, match4);
    addRegexToken('GGGGG',  match1to6, match6);
    addRegexToken('ggggg',  match1to6, match6);

    addWeekParseToken(['gggg', 'ggggg', 'GGGG', 'GGGGG'], function (input, week, config, token) {
        week[token.substr(0, 2)] = toInt(input);
    });

    addWeekParseToken(['gg', 'GG'], function (input, week, config, token) {
        week[token] = utils_hooks__hooks.parseTwoDigitYear(input);
    });

    // HELPERS

    function weeksInYear(year, dow, doy) {
        return weekOfYear(local__createLocal([year, 11, 31 + dow - doy]), dow, doy).week;
    }

    // MOMENTS

    function getSetWeekYear (input) {
        var year = weekOfYear(this, this.localeData()._week.dow, this.localeData()._week.doy).year;
        return input == null ? year : this.add((input - year), 'y');
    }

    function getSetISOWeekYear (input) {
        var year = weekOfYear(this, 1, 4).year;
        return input == null ? year : this.add((input - year), 'y');
    }

    function getISOWeeksInYear () {
        return weeksInYear(this.year(), 1, 4);
    }

    function getWeeksInYear () {
        var weekInfo = this.localeData()._week;
        return weeksInYear(this.year(), weekInfo.dow, weekInfo.doy);
    }

    addFormatToken('Q', 0, 0, 'quarter');

    // ALIASES

    addUnitAlias('quarter', 'Q');

    // PARSING

    addRegexToken('Q', match1);
    addParseToken('Q', function (input, array) {
        array[MONTH] = (toInt(input) - 1) * 3;
    });

    // MOMENTS

    function getSetQuarter (input) {
        return input == null ? Math.ceil((this.month() + 1) / 3) : this.month((input - 1) * 3 + this.month() % 3);
    }

    addFormatToken('D', ['DD', 2], 'Do', 'date');

    // ALIASES

    addUnitAlias('date', 'D');

    // PARSING

    addRegexToken('D',  match1to2);
    addRegexToken('DD', match1to2, match2);
    addRegexToken('Do', function (isStrict, locale) {
        return isStrict ? locale._ordinalParse : locale._ordinalParseLenient;
    });

    addParseToken(['D', 'DD'], DATE);
    addParseToken('Do', function (input, array) {
        array[DATE] = toInt(input.match(match1to2)[0], 10);
    });

    // MOMENTS

    var getSetDayOfMonth = makeGetSet('Date', true);

    addFormatToken('d', 0, 'do', 'day');

    addFormatToken('dd', 0, 0, function (format) {
        return this.localeData().weekdaysMin(this, format);
    });

    addFormatToken('ddd', 0, 0, function (format) {
        return this.localeData().weekdaysShort(this, format);
    });

    addFormatToken('dddd', 0, 0, function (format) {
        return this.localeData().weekdays(this, format);
    });

    addFormatToken('e', 0, 0, 'weekday');
    addFormatToken('E', 0, 0, 'isoWeekday');

    // ALIASES

    addUnitAlias('day', 'd');
    addUnitAlias('weekday', 'e');
    addUnitAlias('isoWeekday', 'E');

    // PARSING

    addRegexToken('d',    match1to2);
    addRegexToken('e',    match1to2);
    addRegexToken('E',    match1to2);
    addRegexToken('dd',   matchWord);
    addRegexToken('ddd',  matchWord);
    addRegexToken('dddd', matchWord);

    addWeekParseToken(['dd', 'ddd', 'dddd'], function (input, week, config) {
        var weekday = config._locale.weekdaysParse(input);
        // if we didn't get a weekday name, mark the date as invalid
        if (weekday != null) {
            week.d = weekday;
        } else {
            getParsingFlags(config).invalidWeekday = input;
        }
    });

    addWeekParseToken(['d', 'e', 'E'], function (input, week, config, token) {
        week[token] = toInt(input);
    });

    // HELPERS

    function parseWeekday(input, locale) {
        if (typeof input !== 'string') {
            return input;
        }

        if (!isNaN(input)) {
            return parseInt(input, 10);
        }

        input = locale.weekdaysParse(input);
        if (typeof input === 'number') {
            return input;
        }

        return null;
    }

    // LOCALES

    var defaultLocaleWeekdays = 'Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday'.split('_');
    function localeWeekdays (m) {
        return this._weekdays[m.day()];
    }

    var defaultLocaleWeekdaysShort = 'Sun_Mon_Tue_Wed_Thu_Fri_Sat'.split('_');
    function localeWeekdaysShort (m) {
        return this._weekdaysShort[m.day()];
    }

    var defaultLocaleWeekdaysMin = 'Su_Mo_Tu_We_Th_Fr_Sa'.split('_');
    function localeWeekdaysMin (m) {
        return this._weekdaysMin[m.day()];
    }

    function localeWeekdaysParse (weekdayName) {
        var i, mom, regex;

        this._weekdaysParse = this._weekdaysParse || [];

        for (i = 0; i < 7; i++) {
            // make the regex if we don't have it already
            if (!this._weekdaysParse[i]) {
                mom = local__createLocal([2000, 1]).day(i);
                regex = '^' + this.weekdays(mom, '') + '|^' + this.weekdaysShort(mom, '') + '|^' + this.weekdaysMin(mom, '');
                this._weekdaysParse[i] = new RegExp(regex.replace('.', ''), 'i');
            }
            // test the regex
            if (this._weekdaysParse[i].test(weekdayName)) {
                return i;
            }
        }
    }

    // MOMENTS

    function getSetDayOfWeek (input) {
        var day = this._isUTC ? this._d.getUTCDay() : this._d.getDay();
        if (input != null) {
            input = parseWeekday(input, this.localeData());
            return this.add(input - day, 'd');
        } else {
            return day;
        }
    }

    function getSetLocaleDayOfWeek (input) {
        var weekday = (this.day() + 7 - this.localeData()._week.dow) % 7;
        return input == null ? weekday : this.add(input - weekday, 'd');
    }

    function getSetISODayOfWeek (input) {
        // behaves the same as moment#day except
        // as a getter, returns 7 instead of 0 (1-7 range instead of 0-6)
        // as a setter, sunday should belong to the previous week.
        return input == null ? this.day() || 7 : this.day(this.day() % 7 ? input : input - 7);
    }

    addFormatToken('H', ['HH', 2], 0, 'hour');
    addFormatToken('h', ['hh', 2], 0, function () {
        return this.hours() % 12 || 12;
    });

    function meridiem (token, lowercase) {
        addFormatToken(token, 0, 0, function () {
            return this.localeData().meridiem(this.hours(), this.minutes(), lowercase);
        });
    }

    meridiem('a', true);
    meridiem('A', false);

    // ALIASES

    addUnitAlias('hour', 'h');

    // PARSING

    function matchMeridiem (isStrict, locale) {
        return locale._meridiemParse;
    }

    addRegexToken('a',  matchMeridiem);
    addRegexToken('A',  matchMeridiem);
    addRegexToken('H',  match1to2);
    addRegexToken('h',  match1to2);
    addRegexToken('HH', match1to2, match2);
    addRegexToken('hh', match1to2, match2);

    addParseToken(['H', 'HH'], HOUR);
    addParseToken(['a', 'A'], function (input, array, config) {
        config._isPm = config._locale.isPM(input);
        config._meridiem = input;
    });
    addParseToken(['h', 'hh'], function (input, array, config) {
        array[HOUR] = toInt(input);
        getParsingFlags(config).bigHour = true;
    });

    // LOCALES

    function localeIsPM (input) {
        // IE8 Quirks Mode & IE7 Standards Mode do not allow accessing strings like arrays
        // Using charAt should be more compatible.
        return ((input + '').toLowerCase().charAt(0) === 'p');
    }

    var defaultLocaleMeridiemParse = /[ap]\.?m?\.?/i;
    function localeMeridiem (hours, minutes, isLower) {
        if (hours > 11) {
            return isLower ? 'pm' : 'PM';
        } else {
            return isLower ? 'am' : 'AM';
        }
    }


    // MOMENTS

    // Setting the hour should keep the time, because the user explicitly
    // specified which hour he wants. So trying to maintain the same hour (in
    // a new timezone) makes sense. Adding/subtracting hours does not follow
    // this rule.
    var getSetHour = makeGetSet('Hours', true);

    addFormatToken('m', ['mm', 2], 0, 'minute');

    // ALIASES

    addUnitAlias('minute', 'm');

    // PARSING

    addRegexToken('m',  match1to2);
    addRegexToken('mm', match1to2, match2);
    addParseToken(['m', 'mm'], MINUTE);

    // MOMENTS

    var getSetMinute = makeGetSet('Minutes', false);

    addFormatToken('s', ['ss', 2], 0, 'second');

    // ALIASES

    addUnitAlias('second', 's');

    // PARSING

    addRegexToken('s',  match1to2);
    addRegexToken('ss', match1to2, match2);
    addParseToken(['s', 'ss'], SECOND);

    // MOMENTS

    var getSetSecond = makeGetSet('Seconds', false);

    addFormatToken('S', 0, 0, function () {
        return ~~(this.millisecond() / 100);
    });

    addFormatToken(0, ['SS', 2], 0, function () {
        return ~~(this.millisecond() / 10);
    });

    addFormatToken(0, ['SSS', 3], 0, 'millisecond');
    addFormatToken(0, ['SSSS', 4], 0, function () {
        return this.millisecond() * 10;
    });
    addFormatToken(0, ['SSSSS', 5], 0, function () {
        return this.millisecond() * 100;
    });
    addFormatToken(0, ['SSSSSS', 6], 0, function () {
        return this.millisecond() * 1000;
    });
    addFormatToken(0, ['SSSSSSS', 7], 0, function () {
        return this.millisecond() * 10000;
    });
    addFormatToken(0, ['SSSSSSSS', 8], 0, function () {
        return this.millisecond() * 100000;
    });
    addFormatToken(0, ['SSSSSSSSS', 9], 0, function () {
        return this.millisecond() * 1000000;
    });


    // ALIASES

    addUnitAlias('millisecond', 'ms');

    // PARSING

    addRegexToken('S',    match1to3, match1);
    addRegexToken('SS',   match1to3, match2);
    addRegexToken('SSS',  match1to3, match3);

    var token;
    for (token = 'SSSS'; token.length <= 9; token += 'S') {
        addRegexToken(token, matchUnsigned);
    }

    function parseMs(input, array) {
        array[MILLISECOND] = toInt(('0.' + input) * 1000);
    }

    for (token = 'S'; token.length <= 9; token += 'S') {
        addParseToken(token, parseMs);
    }
    // MOMENTS

    var getSetMillisecond = makeGetSet('Milliseconds', false);

    addFormatToken('z',  0, 0, 'zoneAbbr');
    addFormatToken('zz', 0, 0, 'zoneName');

    // MOMENTS

    function getZoneAbbr () {
        return this._isUTC ? 'UTC' : '';
    }

    function getZoneName () {
        return this._isUTC ? 'Coordinated Universal Time' : '';
    }

    var momentPrototype__proto = Moment.prototype;

    momentPrototype__proto.add          = add_subtract__add;
    momentPrototype__proto.calendar     = moment_calendar__calendar;
    momentPrototype__proto.clone        = clone;
    momentPrototype__proto.diff         = diff;
    momentPrototype__proto.endOf        = endOf;
    momentPrototype__proto.format       = format;
    momentPrototype__proto.from         = from;
    momentPrototype__proto.fromNow      = fromNow;
    momentPrototype__proto.to           = to;
    momentPrototype__proto.toNow        = toNow;
    momentPrototype__proto.get          = getSet;
    momentPrototype__proto.invalidAt    = invalidAt;
    momentPrototype__proto.isAfter      = isAfter;
    momentPrototype__proto.isBefore     = isBefore;
    momentPrototype__proto.isBetween    = isBetween;
    momentPrototype__proto.isSame       = isSame;
    momentPrototype__proto.isValid      = moment_valid__isValid;
    momentPrototype__proto.lang         = lang;
    momentPrototype__proto.locale       = locale;
    momentPrototype__proto.localeData   = localeData;
    momentPrototype__proto.max          = prototypeMax;
    momentPrototype__proto.min          = prototypeMin;
    momentPrototype__proto.parsingFlags = parsingFlags;
    momentPrototype__proto.set          = getSet;
    momentPrototype__proto.startOf      = startOf;
    momentPrototype__proto.subtract     = add_subtract__subtract;
    momentPrototype__proto.toArray      = toArray;
    momentPrototype__proto.toObject     = toObject;
    momentPrototype__proto.toDate       = toDate;
    momentPrototype__proto.toISOString  = moment_format__toISOString;
    momentPrototype__proto.toJSON       = moment_format__toISOString;
    momentPrototype__proto.toString     = toString;
    momentPrototype__proto.unix         = unix;
    momentPrototype__proto.valueOf      = to_type__valueOf;

    // Year
    momentPrototype__proto.year       = getSetYear;
    momentPrototype__proto.isLeapYear = getIsLeapYear;

    // Week Year
    momentPrototype__proto.weekYear    = getSetWeekYear;
    momentPrototype__proto.isoWeekYear = getSetISOWeekYear;

    // Quarter
    momentPrototype__proto.quarter = momentPrototype__proto.quarters = getSetQuarter;

    // Month
    momentPrototype__proto.month       = getSetMonth;
    momentPrototype__proto.daysInMonth = getDaysInMonth;

    // Week
    momentPrototype__proto.week           = momentPrototype__proto.weeks        = getSetWeek;
    momentPrototype__proto.isoWeek        = momentPrototype__proto.isoWeeks     = getSetISOWeek;
    momentPrototype__proto.weeksInYear    = getWeeksInYear;
    momentPrototype__proto.isoWeeksInYear = getISOWeeksInYear;

    // Day
    momentPrototype__proto.date       = getSetDayOfMonth;
    momentPrototype__proto.day        = momentPrototype__proto.days             = getSetDayOfWeek;
    momentPrototype__proto.weekday    = getSetLocaleDayOfWeek;
    momentPrototype__proto.isoWeekday = getSetISODayOfWeek;
    momentPrototype__proto.dayOfYear  = getSetDayOfYear;

    // Hour
    momentPrototype__proto.hour = momentPrototype__proto.hours = getSetHour;

    // Minute
    momentPrototype__proto.minute = momentPrototype__proto.minutes = getSetMinute;

    // Second
    momentPrototype__proto.second = momentPrototype__proto.seconds = getSetSecond;

    // Millisecond
    momentPrototype__proto.millisecond = momentPrototype__proto.milliseconds = getSetMillisecond;

    // Offset
    momentPrototype__proto.utcOffset            = getSetOffset;
    momentPrototype__proto.utc                  = setOffsetToUTC;
    momentPrototype__proto.local                = setOffsetToLocal;
    momentPrototype__proto.parseZone            = setOffsetToParsedOffset;
    momentPrototype__proto.hasAlignedHourOffset = hasAlignedHourOffset;
    momentPrototype__proto.isDST                = isDaylightSavingTime;
    momentPrototype__proto.isDSTShifted         = isDaylightSavingTimeShifted;
    momentPrototype__proto.isLocal              = isLocal;
    momentPrototype__proto.isUtcOffset          = isUtcOffset;
    momentPrototype__proto.isUtc                = isUtc;
    momentPrototype__proto.isUTC                = isUtc;

    // Timezone
    momentPrototype__proto.zoneAbbr = getZoneAbbr;
    momentPrototype__proto.zoneName = getZoneName;

    // Deprecations
    momentPrototype__proto.dates  = deprecate('dates accessor is deprecated. Use date instead.', getSetDayOfMonth);
    momentPrototype__proto.months = deprecate('months accessor is deprecated. Use month instead', getSetMonth);
    momentPrototype__proto.years  = deprecate('years accessor is deprecated. Use year instead', getSetYear);
    momentPrototype__proto.zone   = deprecate('moment().zone is deprecated, use moment().utcOffset instead. https://github.com/moment/moment/issues/1779', getSetZone);

    var momentPrototype = momentPrototype__proto;

    function moment__createUnix (input) {
        return local__createLocal(input * 1000);
    }

    function moment__createInZone () {
        return local__createLocal.apply(null, arguments).parseZone();
    }

    var defaultCalendar = {
        sameDay : '[Today at] LT',
        nextDay : '[Tomorrow at] LT',
        nextWeek : 'dddd [at] LT',
        lastDay : '[Yesterday at] LT',
        lastWeek : '[Last] dddd [at] LT',
        sameElse : 'L'
    };

    function locale_calendar__calendar (key, mom, now) {
        var output = this._calendar[key];
        return typeof output === 'function' ? output.call(mom, now) : output;
    }

    var defaultLongDateFormat = {
        LTS  : 'h:mm:ss A',
        LT   : 'h:mm A',
        L    : 'MM/DD/YYYY',
        LL   : 'MMMM D, YYYY',
        LLL  : 'MMMM D, YYYY h:mm A',
        LLLL : 'dddd, MMMM D, YYYY h:mm A'
    };

    function longDateFormat (key) {
        var format = this._longDateFormat[key],
            formatUpper = this._longDateFormat[key.toUpperCase()];

        if (format || !formatUpper) {
            return format;
        }

        this._longDateFormat[key] = formatUpper.replace(/MMMM|MM|DD|dddd/g, function (val) {
            return val.slice(1);
        });

        return this._longDateFormat[key];
    }

    var defaultInvalidDate = 'Invalid date';

    function invalidDate () {
        return this._invalidDate;
    }

    var defaultOrdinal = '%d';
    var defaultOrdinalParse = /\d{1,2}/;

    function ordinal (number) {
        return this._ordinal.replace('%d', number);
    }

    function preParsePostFormat (string) {
        return string;
    }

    var defaultRelativeTime = {
        future : 'in %s',
        past   : '%s ago',
        s  : 'a few seconds',
        m  : 'a minute',
        mm : '%d minutes',
        h  : 'an hour',
        hh : '%d hours',
        d  : 'a day',
        dd : '%d days',
        M  : 'a month',
        MM : '%d months',
        y  : 'a year',
        yy : '%d years'
    };

    function relative__relativeTime (number, withoutSuffix, string, isFuture) {
        var output = this._relativeTime[string];
        return (typeof output === 'function') ?
            output(number, withoutSuffix, string, isFuture) :
            output.replace(/%d/i, number);
    }

    function pastFuture (diff, output) {
        var format = this._relativeTime[diff > 0 ? 'future' : 'past'];
        return typeof format === 'function' ? format(output) : format.replace(/%s/i, output);
    }

    function locale_set__set (config) {
        var prop, i;
        for (i in config) {
            prop = config[i];
            if (typeof prop === 'function') {
                this[i] = prop;
            } else {
                this['_' + i] = prop;
            }
        }
        // Lenient ordinal parsing accepts just a number in addition to
        // number + (possibly) stuff coming from _ordinalParseLenient.
        this._ordinalParseLenient = new RegExp(this._ordinalParse.source + '|' + (/\d{1,2}/).source);
    }

    var prototype__proto = Locale.prototype;

    prototype__proto._calendar       = defaultCalendar;
    prototype__proto.calendar        = locale_calendar__calendar;
    prototype__proto._longDateFormat = defaultLongDateFormat;
    prototype__proto.longDateFormat  = longDateFormat;
    prototype__proto._invalidDate    = defaultInvalidDate;
    prototype__proto.invalidDate     = invalidDate;
    prototype__proto._ordinal        = defaultOrdinal;
    prototype__proto.ordinal         = ordinal;
    prototype__proto._ordinalParse   = defaultOrdinalParse;
    prototype__proto.preparse        = preParsePostFormat;
    prototype__proto.postformat      = preParsePostFormat;
    prototype__proto._relativeTime   = defaultRelativeTime;
    prototype__proto.relativeTime    = relative__relativeTime;
    prototype__proto.pastFuture      = pastFuture;
    prototype__proto.set             = locale_set__set;

    // Month
    prototype__proto.months       =        localeMonths;
    prototype__proto._months      = defaultLocaleMonths;
    prototype__proto.monthsShort  =        localeMonthsShort;
    prototype__proto._monthsShort = defaultLocaleMonthsShort;
    prototype__proto.monthsParse  =        localeMonthsParse;

    // Week
    prototype__proto.week = localeWeek;
    prototype__proto._week = defaultLocaleWeek;
    prototype__proto.firstDayOfYear = localeFirstDayOfYear;
    prototype__proto.firstDayOfWeek = localeFirstDayOfWeek;

    // Day of Week
    prototype__proto.weekdays       =        localeWeekdays;
    prototype__proto._weekdays      = defaultLocaleWeekdays;
    prototype__proto.weekdaysMin    =        localeWeekdaysMin;
    prototype__proto._weekdaysMin   = defaultLocaleWeekdaysMin;
    prototype__proto.weekdaysShort  =        localeWeekdaysShort;
    prototype__proto._weekdaysShort = defaultLocaleWeekdaysShort;
    prototype__proto.weekdaysParse  =        localeWeekdaysParse;

    // Hours
    prototype__proto.isPM = localeIsPM;
    prototype__proto._meridiemParse = defaultLocaleMeridiemParse;
    prototype__proto.meridiem = localeMeridiem;

    function lists__get (format, index, field, setter) {
        var locale = locale_locales__getLocale();
        var utc = create_utc__createUTC().set(setter, index);
        return locale[field](utc, format);
    }

    function list (format, index, field, count, setter) {
        if (typeof format === 'number') {
            index = format;
            format = undefined;
        }

        format = format || '';

        if (index != null) {
            return lists__get(format, index, field, setter);
        }

        var i;
        var out = [];
        for (i = 0; i < count; i++) {
            out[i] = lists__get(format, i, field, setter);
        }
        return out;
    }

    function lists__listMonths (format, index) {
        return list(format, index, 'months', 12, 'month');
    }

    function lists__listMonthsShort (format, index) {
        return list(format, index, 'monthsShort', 12, 'month');
    }

    function lists__listWeekdays (format, index) {
        return list(format, index, 'weekdays', 7, 'day');
    }

    function lists__listWeekdaysShort (format, index) {
        return list(format, index, 'weekdaysShort', 7, 'day');
    }

    function lists__listWeekdaysMin (format, index) {
        return list(format, index, 'weekdaysMin', 7, 'day');
    }

    locale_locales__getSetGlobalLocale('en', {
        ordinalParse: /\d{1,2}(th|st|nd|rd)/,
        ordinal : function (number) {
            var b = number % 10,
                output = (toInt(number % 100 / 10) === 1) ? 'th' :
                (b === 1) ? 'st' :
                (b === 2) ? 'nd' :
                (b === 3) ? 'rd' : 'th';
            return number + output;
        }
    });

    // Side effect imports
    utils_hooks__hooks.lang = deprecate('moment.lang is deprecated. Use moment.locale instead.', locale_locales__getSetGlobalLocale);
    utils_hooks__hooks.langData = deprecate('moment.langData is deprecated. Use moment.localeData instead.', locale_locales__getLocale);

    var mathAbs = Math.abs;

    function duration_abs__abs () {
        var data           = this._data;

        this._milliseconds = mathAbs(this._milliseconds);
        this._days         = mathAbs(this._days);
        this._months       = mathAbs(this._months);

        data.milliseconds  = mathAbs(data.milliseconds);
        data.seconds       = mathAbs(data.seconds);
        data.minutes       = mathAbs(data.minutes);
        data.hours         = mathAbs(data.hours);
        data.months        = mathAbs(data.months);
        data.years         = mathAbs(data.years);

        return this;
    }

    function duration_add_subtract__addSubtract (duration, input, value, direction) {
        var other = create__createDuration(input, value);

        duration._milliseconds += direction * other._milliseconds;
        duration._days         += direction * other._days;
        duration._months       += direction * other._months;

        return duration._bubble();
    }

    // supports only 2.0-style add(1, 's') or add(duration)
    function duration_add_subtract__add (input, value) {
        return duration_add_subtract__addSubtract(this, input, value, 1);
    }

    // supports only 2.0-style subtract(1, 's') or subtract(duration)
    function duration_add_subtract__subtract (input, value) {
        return duration_add_subtract__addSubtract(this, input, value, -1);
    }

    function absCeil (number) {
        if (number < 0) {
            return Math.floor(number);
        } else {
            return Math.ceil(number);
        }
    }

    function bubble () {
        var milliseconds = this._milliseconds;
        var days         = this._days;
        var months       = this._months;
        var data         = this._data;
        var seconds, minutes, hours, years, monthsFromDays;

        // if we have a mix of positive and negative values, bubble down first
        // check: https://github.com/moment/moment/issues/2166
        if (!((milliseconds >= 0 && days >= 0 && months >= 0) ||
                (milliseconds <= 0 && days <= 0 && months <= 0))) {
            milliseconds += absCeil(monthsToDays(months) + days) * 864e5;
            days = 0;
            months = 0;
        }

        // The following code bubbles up values, see the tests for
        // examples of what that means.
        data.milliseconds = milliseconds % 1000;

        seconds           = absFloor(milliseconds / 1000);
        data.seconds      = seconds % 60;

        minutes           = absFloor(seconds / 60);
        data.minutes      = minutes % 60;

        hours             = absFloor(minutes / 60);
        data.hours        = hours % 24;

        days += absFloor(hours / 24);

        // convert days to months
        monthsFromDays = absFloor(daysToMonths(days));
        months += monthsFromDays;
        days -= absCeil(monthsToDays(monthsFromDays));

        // 12 months -> 1 year
        years = absFloor(months / 12);
        months %= 12;

        data.days   = days;
        data.months = months;
        data.years  = years;

        return this;
    }

    function daysToMonths (days) {
        // 400 years have 146097 days (taking into account leap year rules)
        // 400 years have 12 months === 4800
        return days * 4800 / 146097;
    }

    function monthsToDays (months) {
        // the reverse of daysToMonths
        return months * 146097 / 4800;
    }

    function as (units) {
        var days;
        var months;
        var milliseconds = this._milliseconds;

        units = normalizeUnits(units);

        if (units === 'month' || units === 'year') {
            days   = this._days   + milliseconds / 864e5;
            months = this._months + daysToMonths(days);
            return units === 'month' ? months : months / 12;
        } else {
            // handle milliseconds separately because of floating point math errors (issue #1867)
            days = this._days + Math.round(monthsToDays(this._months));
            switch (units) {
                case 'week'   : return days / 7     + milliseconds / 6048e5;
                case 'day'    : return days         + milliseconds / 864e5;
                case 'hour'   : return days * 24    + milliseconds / 36e5;
                case 'minute' : return days * 1440  + milliseconds / 6e4;
                case 'second' : return days * 86400 + milliseconds / 1000;
                // Math.floor prevents floating point math errors here
                case 'millisecond': return Math.floor(days * 864e5) + milliseconds;
                default: throw new Error('Unknown unit ' + units);
            }
        }
    }

    // TODO: Use this.as('ms')?
    function duration_as__valueOf () {
        return (
            this._milliseconds +
            this._days * 864e5 +
            (this._months % 12) * 2592e6 +
            toInt(this._months / 12) * 31536e6
        );
    }

    function makeAs (alias) {
        return function () {
            return this.as(alias);
        };
    }

    var asMilliseconds = makeAs('ms');
    var asSeconds      = makeAs('s');
    var asMinutes      = makeAs('m');
    var asHours        = makeAs('h');
    var asDays         = makeAs('d');
    var asWeeks        = makeAs('w');
    var asMonths       = makeAs('M');
    var asYears        = makeAs('y');

    function duration_get__get (units) {
        units = normalizeUnits(units);
        return this[units + 's']();
    }

    function makeGetter(name) {
        return function () {
            return this._data[name];
        };
    }

    var milliseconds = makeGetter('milliseconds');
    var seconds      = makeGetter('seconds');
    var minutes      = makeGetter('minutes');
    var hours        = makeGetter('hours');
    var days         = makeGetter('days');
    var months       = makeGetter('months');
    var years        = makeGetter('years');

    function weeks () {
        return absFloor(this.days() / 7);
    }

    var round = Math.round;
    var thresholds = {
        s: 45,  // seconds to minute
        m: 45,  // minutes to hour
        h: 22,  // hours to day
        d: 26,  // days to month
        M: 11   // months to year
    };

    // helper function for moment.fn.from, moment.fn.fromNow, and moment.duration.fn.humanize
    function substituteTimeAgo(string, number, withoutSuffix, isFuture, locale) {
        return locale.relativeTime(number || 1, !!withoutSuffix, string, isFuture);
    }

    function duration_humanize__relativeTime (posNegDuration, withoutSuffix, locale) {
        var duration = create__createDuration(posNegDuration).abs();
        var seconds  = round(duration.as('s'));
        var minutes  = round(duration.as('m'));
        var hours    = round(duration.as('h'));
        var days     = round(duration.as('d'));
        var months   = round(duration.as('M'));
        var years    = round(duration.as('y'));

        var a = seconds < thresholds.s && ['s', seconds]  ||
                minutes === 1          && ['m']           ||
                minutes < thresholds.m && ['mm', minutes] ||
                hours   === 1          && ['h']           ||
                hours   < thresholds.h && ['hh', hours]   ||
                days    === 1          && ['d']           ||
                days    < thresholds.d && ['dd', days]    ||
                months  === 1          && ['M']           ||
                months  < thresholds.M && ['MM', months]  ||
                years   === 1          && ['y']           || ['yy', years];

        a[2] = withoutSuffix;
        a[3] = +posNegDuration > 0;
        a[4] = locale;
        return substituteTimeAgo.apply(null, a);
    }

    // This function allows you to set a threshold for relative time strings
    function duration_humanize__getSetRelativeTimeThreshold (threshold, limit) {
        if (thresholds[threshold] === undefined) {
            return false;
        }
        if (limit === undefined) {
            return thresholds[threshold];
        }
        thresholds[threshold] = limit;
        return true;
    }

    function humanize (withSuffix) {
        var locale = this.localeData();
        var output = duration_humanize__relativeTime(this, !withSuffix, locale);

        if (withSuffix) {
            output = locale.pastFuture(+this, output);
        }

        return locale.postformat(output);
    }

    var iso_string__abs = Math.abs;

    function iso_string__toISOString() {
        // for ISO strings we do not use the normal bubbling rules:
        //  * milliseconds bubble up until they become hours
        //  * days do not bubble at all
        //  * months bubble up until they become years
        // This is because there is no context-free conversion between hours and days
        // (think of clock changes)
        // and also not between days and months (28-31 days per month)
        var seconds = iso_string__abs(this._milliseconds) / 1000;
        var days         = iso_string__abs(this._days);
        var months       = iso_string__abs(this._months);
        var minutes, hours, years;

        // 3600 seconds -> 60 minutes -> 1 hour
        minutes           = absFloor(seconds / 60);
        hours             = absFloor(minutes / 60);
        seconds %= 60;
        minutes %= 60;

        // 12 months -> 1 year
        years  = absFloor(months / 12);
        months %= 12;


        // inspired by https://github.com/dordille/moment-isoduration/blob/master/moment.isoduration.js
        var Y = years;
        var M = months;
        var D = days;
        var h = hours;
        var m = minutes;
        var s = seconds;
        var total = this.asSeconds();

        if (!total) {
            // this is the same as C#'s (Noda) and python (isodate)...
            // but not other JS (goog.date)
            return 'P0D';
        }

        return (total < 0 ? '-' : '') +
            'P' +
            (Y ? Y + 'Y' : '') +
            (M ? M + 'M' : '') +
            (D ? D + 'D' : '') +
            ((h || m || s) ? 'T' : '') +
            (h ? h + 'H' : '') +
            (m ? m + 'M' : '') +
            (s ? s + 'S' : '');
    }

    var duration_prototype__proto = Duration.prototype;

    duration_prototype__proto.abs            = duration_abs__abs;
    duration_prototype__proto.add            = duration_add_subtract__add;
    duration_prototype__proto.subtract       = duration_add_subtract__subtract;
    duration_prototype__proto.as             = as;
    duration_prototype__proto.asMilliseconds = asMilliseconds;
    duration_prototype__proto.asSeconds      = asSeconds;
    duration_prototype__proto.asMinutes      = asMinutes;
    duration_prototype__proto.asHours        = asHours;
    duration_prototype__proto.asDays         = asDays;
    duration_prototype__proto.asWeeks        = asWeeks;
    duration_prototype__proto.asMonths       = asMonths;
    duration_prototype__proto.asYears        = asYears;
    duration_prototype__proto.valueOf        = duration_as__valueOf;
    duration_prototype__proto._bubble        = bubble;
    duration_prototype__proto.get            = duration_get__get;
    duration_prototype__proto.milliseconds   = milliseconds;
    duration_prototype__proto.seconds        = seconds;
    duration_prototype__proto.minutes        = minutes;
    duration_prototype__proto.hours          = hours;
    duration_prototype__proto.days           = days;
    duration_prototype__proto.weeks          = weeks;
    duration_prototype__proto.months         = months;
    duration_prototype__proto.years          = years;
    duration_prototype__proto.humanize       = humanize;
    duration_prototype__proto.toISOString    = iso_string__toISOString;
    duration_prototype__proto.toString       = iso_string__toISOString;
    duration_prototype__proto.toJSON         = iso_string__toISOString;
    duration_prototype__proto.locale         = locale;
    duration_prototype__proto.localeData     = localeData;

    // Deprecations
    duration_prototype__proto.toIsoString = deprecate('toIsoString() is deprecated. Please use toISOString() instead (notice the capitals)', iso_string__toISOString);
    duration_prototype__proto.lang = lang;

    // Side effect imports

    addFormatToken('X', 0, 0, 'unix');
    addFormatToken('x', 0, 0, 'valueOf');

    // PARSING

    addRegexToken('x', matchSigned);
    addRegexToken('X', matchTimestamp);
    addParseToken('X', function (input, array, config) {
        config._d = new Date(parseFloat(input, 10) * 1000);
    });
    addParseToken('x', function (input, array, config) {
        config._d = new Date(toInt(input));
    });

    // Side effect imports


    utils_hooks__hooks.version = '2.10.6';

    setHookCallback(local__createLocal);

    utils_hooks__hooks.fn                    = momentPrototype;
    utils_hooks__hooks.min                   = min;
    utils_hooks__hooks.max                   = max;
    utils_hooks__hooks.utc                   = create_utc__createUTC;
    utils_hooks__hooks.unix                  = moment__createUnix;
    utils_hooks__hooks.months                = lists__listMonths;
    utils_hooks__hooks.isDate                = isDate;
    utils_hooks__hooks.locale                = locale_locales__getSetGlobalLocale;
    utils_hooks__hooks.invalid               = valid__createInvalid;
    utils_hooks__hooks.duration              = create__createDuration;
    utils_hooks__hooks.isMoment              = isMoment;
    utils_hooks__hooks.weekdays              = lists__listWeekdays;
    utils_hooks__hooks.parseZone             = moment__createInZone;
    utils_hooks__hooks.localeData            = locale_locales__getLocale;
    utils_hooks__hooks.isDuration            = isDuration;
    utils_hooks__hooks.monthsShort           = lists__listMonthsShort;
    utils_hooks__hooks.weekdaysMin           = lists__listWeekdaysMin;
    utils_hooks__hooks.defineLocale          = defineLocale;
    utils_hooks__hooks.weekdaysShort         = lists__listWeekdaysShort;
    utils_hooks__hooks.normalizeUnits        = normalizeUnits;
    utils_hooks__hooks.relativeTimeThreshold = duration_humanize__getSetRelativeTimeThreshold;

    var _moment = utils_hooks__hooks;

    return _moment;

}));
/*! version : 4.17.37
 =========================================================
 bootstrap-datetimejs
 https://github.com/Eonasdan/bootstrap-datetimepicker
 Copyright (c) 2015 Jonathan Peterson
 =========================================================
 */
!function(a){"use strict";if("function"==typeof define&&define.amd)define(["jquery","moment"],a);else if("object"==typeof exports)a(require("jquery"),require("moment"));else{if("undefined"==typeof jQuery)throw"bootstrap-datetimepicker requires jQuery to be loaded first";if("undefined"==typeof moment)throw"bootstrap-datetimepicker requires Moment.js to be loaded first";a(jQuery,moment)}}(function(a,b){"use strict";if(!b)throw new Error("bootstrap-datetimepicker requires Moment.js to be loaded first");var c=function(c,d){var e,f,g,h,i,j,k,l={},m=!0,n=!1,o=!1,p=0,q=[{clsName:"days",navFnc:"M",navStep:1},{clsName:"months",navFnc:"y",navStep:1},{clsName:"years",navFnc:"y",navStep:10},{clsName:"decades",navFnc:"y",navStep:100}],r=["days","months","years","decades"],s=["top","bottom","auto"],t=["left","right","auto"],u=["default","top","bottom"],v={up:38,38:"up",down:40,40:"down",left:37,37:"left",right:39,39:"right",tab:9,9:"tab",escape:27,27:"escape",enter:13,13:"enter",pageUp:33,33:"pageUp",pageDown:34,34:"pageDown",shift:16,16:"shift",control:17,17:"control",space:32,32:"space",t:84,84:"t","delete":46,46:"delete"},w={},x=function(a){var c,e,f,g,h,i=!1;return void 0!==b.tz&&void 0!==d.timeZone&&null!==d.timeZone&&""!==d.timeZone&&(i=!0),void 0===a||null===a?c=i?b().tz(d.timeZone).startOf("d"):b().startOf("d"):i?(e=b().tz(d.timeZone).utcOffset(),f=b(a,j,d.useStrict).utcOffset(),f!==e?(g=b().tz(d.timeZone).format("Z"),h=b(a,j,d.useStrict).format("YYYY-MM-DD[T]HH:mm:ss")+g,c=b(h,j,d.useStrict).tz(d.timeZone)):c=b(a,j,d.useStrict).tz(d.timeZone)):c=b(a,j,d.useStrict),c},y=function(a){if("string"!=typeof a||a.length>1)throw new TypeError("isEnabled expects a single character string parameter");switch(a){case"y":return-1!==i.indexOf("Y");case"M":return-1!==i.indexOf("M");case"d":return-1!==i.toLowerCase().indexOf("d");case"h":case"H":return-1!==i.toLowerCase().indexOf("h");case"m":return-1!==i.indexOf("m");case"s":return-1!==i.indexOf("s");default:return!1}},z=function(){return y("h")||y("m")||y("s")},A=function(){return y("y")||y("M")||y("d")},B=function(){var b=a("<thead>").append(a("<tr>").append(a("<th>").addClass("prev").attr("data-action","previous").append(a("<span>").addClass(d.icons.previous))).append(a("<th>").addClass("picker-switch").attr("data-action","pickerSwitch").attr("colspan",d.calendarWeeks?"6":"5")).append(a("<th>").addClass("next").attr("data-action","next").append(a("<span>").addClass(d.icons.next)))),c=a("<tbody>").append(a("<tr>").append(a("<td>").attr("colspan",d.calendarWeeks?"8":"7")));return[a("<div>").addClass("datepicker-days").append(a("<table>").addClass("table-condensed").append(b).append(a("<tbody>"))),a("<div>").addClass("datepicker-months").append(a("<table>").addClass("table-condensed").append(b.clone()).append(c.clone())),a("<div>").addClass("datepicker-years").append(a("<table>").addClass("table-condensed").append(b.clone()).append(c.clone())),a("<div>").addClass("datepicker-decades").append(a("<table>").addClass("table-condensed").append(b.clone()).append(c.clone()))]},C=function(){var b=a("<tr>"),c=a("<tr>"),e=a("<tr>");return y("h")&&(b.append(a("<td>").append(a("<a>").attr({href:"#",tabindex:"-1",title:d.tooltips.incrementHour}).addClass("btn").attr("data-action","incrementHours").append(a("<span>").addClass(d.icons.up)))),c.append(a("<td>").append(a("<span>").addClass("timepicker-hour").attr({"data-time-component":"hours",title:d.tooltips.pickHour}).attr("data-action","showHours"))),e.append(a("<td>").append(a("<a>").attr({href:"#",tabindex:"-1",title:d.tooltips.decrementHour}).addClass("btn").attr("data-action","decrementHours").append(a("<span>").addClass(d.icons.down))))),y("m")&&(y("h")&&(b.append(a("<td>").addClass("separator")),c.append(a("<td>").addClass("separator").html(":")),e.append(a("<td>").addClass("separator"))),b.append(a("<td>").append(a("<a>").attr({href:"#",tabindex:"-1",title:d.tooltips.incrementMinute}).addClass("btn").attr("data-action","incrementMinutes").append(a("<span>").addClass(d.icons.up)))),c.append(a("<td>").append(a("<span>").addClass("timepicker-minute").attr({"data-time-component":"minutes",title:d.tooltips.pickMinute}).attr("data-action","showMinutes"))),e.append(a("<td>").append(a("<a>").attr({href:"#",tabindex:"-1",title:d.tooltips.decrementMinute}).addClass("btn").attr("data-action","decrementMinutes").append(a("<span>").addClass(d.icons.down))))),y("s")&&(y("m")&&(b.append(a("<td>").addClass("separator")),c.append(a("<td>").addClass("separator").html(":")),e.append(a("<td>").addClass("separator"))),b.append(a("<td>").append(a("<a>").attr({href:"#",tabindex:"-1",title:d.tooltips.incrementSecond}).addClass("btn").attr("data-action","incrementSeconds").append(a("<span>").addClass(d.icons.up)))),c.append(a("<td>").append(a("<span>").addClass("timepicker-second").attr({"data-time-component":"seconds",title:d.tooltips.pickSecond}).attr("data-action","showSeconds"))),e.append(a("<td>").append(a("<a>").attr({href:"#",tabindex:"-1",title:d.tooltips.decrementSecond}).addClass("btn").attr("data-action","decrementSeconds").append(a("<span>").addClass(d.icons.down))))),h||(b.append(a("<td>").addClass("separator")),c.append(a("<td>").append(a("<button>").addClass("btn btn-primary").attr({"data-action":"togglePeriod",tabindex:"-1",title:d.tooltips.togglePeriod}))),e.append(a("<td>").addClass("separator"))),a("<div>").addClass("timepicker-picker").append(a("<table>").addClass("table-condensed").append([b,c,e]))},D=function(){var b=a("<div>").addClass("timepicker-hours").append(a("<table>").addClass("table-condensed")),c=a("<div>").addClass("timepicker-minutes").append(a("<table>").addClass("table-condensed")),d=a("<div>").addClass("timepicker-seconds").append(a("<table>").addClass("table-condensed")),e=[C()];return y("h")&&e.push(b),y("m")&&e.push(c),y("s")&&e.push(d),e},E=function(){var b=[];return d.showTodayButton&&b.push(a("<td>").append(a("<a>").attr({"data-action":"today",title:d.tooltips.today}).append(a("<span>").addClass(d.icons.today)))),!d.sideBySide&&A()&&z()&&b.push(a("<td>").append(a("<a>").attr({"data-action":"togglePicker",title:d.tooltips.selectTime}).append(a("<span>").addClass(d.icons.time)))),d.showClear&&b.push(a("<td>").append(a("<a>").attr({"data-action":"clear",title:d.tooltips.clear}).append(a("<span>").addClass(d.icons.clear)))),d.showClose&&b.push(a("<td>").append(a("<a>").attr({"data-action":"close",title:d.tooltips.close}).append(a("<span>").addClass(d.icons.close)))),a("<table>").addClass("table-condensed").append(a("<tbody>").append(a("<tr>").append(b)))},F=function(){var b=a("<div>").addClass("bootstrap-datetimepicker-widget dropdown-menu"),c=a("<div>").addClass("datepicker").append(B()),e=a("<div>").addClass("timepicker").append(D()),f=a("<ul>").addClass("list-unstyled"),g=a("<li>").addClass("picker-switch"+(d.collapse?" accordion-toggle":"")).append(E());return d.inline&&b.removeClass("dropdown-menu"),h&&b.addClass("usetwentyfour"),y("s")&&!h&&b.addClass("wider"),d.sideBySide&&A()&&z()?(b.addClass("timepicker-sbs"),"top"===d.toolbarPlacement&&b.append(g),b.append(a("<div>").addClass("row").append(c.addClass("col-md-6")).append(e.addClass("col-md-6"))),"bottom"===d.toolbarPlacement&&b.append(g),b):("top"===d.toolbarPlacement&&f.append(g),A()&&f.append(a("<li>").addClass(d.collapse&&z()?"collapse in":"").append(c)),"default"===d.toolbarPlacement&&f.append(g),z()&&f.append(a("<li>").addClass(d.collapse&&A()?"collapse":"").append(e)),"bottom"===d.toolbarPlacement&&f.append(g),b.append(f))},G=function(){var b,e={};return b=c.is("input")||d.inline?c.data():c.find("input").data(),b.dateOptions&&b.dateOptions instanceof Object&&(e=a.extend(!0,e,b.dateOptions)),a.each(d,function(a){var c="date"+a.charAt(0).toUpperCase()+a.slice(1);void 0!==b[c]&&(e[a]=b[c])}),e},H=function(){var b,e=(n||c).position(),f=(n||c).offset(),g=d.widgetPositioning.vertical,h=d.widgetPositioning.horizontal;if(d.widgetParent)b=d.widgetParent.append(o);else if(c.is("input"))b=c.after(o).parent();else{if(d.inline)return void(b=c.append(o));b=c,c.children().first().after(o)}if("auto"===g&&(g=f.top+1.5*o.height()>=a(window).height()+a(window).scrollTop()&&o.height()+c.outerHeight()<f.top?"top":"bottom"),"auto"===h&&(h=b.width()<f.left+o.outerWidth()/2&&f.left+o.outerWidth()>a(window).width()?"right":"left"),"top"===g?o.addClass("top").removeClass("bottom"):o.addClass("bottom").removeClass("top"),"right"===h?o.addClass("pull-right"):o.removeClass("pull-right"),"relative"!==b.css("position")&&(b=b.parents().filter(function(){return"relative"===a(this).css("position")}).first()),0===b.length)throw new Error("datetimepicker component should be placed within a relative positioned container");o.css({top:"top"===g?"auto":e.top+c.outerHeight(),bottom:"top"===g?e.top+c.outerHeight():"auto",left:"left"===h?b===c?0:e.left:"auto",right:"left"===h?"auto":b.outerWidth()-c.outerWidth()-(b===c?0:e.left)})},I=function(a){"dp.change"===a.type&&(a.date&&a.date.isSame(a.oldDate)||!a.date&&!a.oldDate)||c.trigger(a)},J=function(a){"y"===a&&(a="YYYY"),I({type:"dp.update",change:a,viewDate:f.clone()})},K=function(a){o&&(a&&(k=Math.max(p,Math.min(3,k+a))),o.find(".datepicker > div").hide().filter(".datepicker-"+q[k].clsName).show())},L=function(){var b=a("<tr>"),c=f.clone().startOf("w").startOf("d");for(d.calendarWeeks===!0&&b.append(a("<th>").addClass("cw").text("#"));c.isBefore(f.clone().endOf("w"));)b.append(a("<th>").addClass("dow").text(c.format("dd"))),c.add(1,"d");o.find(".datepicker-days thead").append(b)},M=function(a){return d.disabledDates[a.format("YYYY-MM-DD")]===!0},N=function(a){return d.enabledDates[a.format("YYYY-MM-DD")]===!0},O=function(a){return d.disabledHours[a.format("H")]===!0},P=function(a){return d.enabledHours[a.format("H")]===!0},Q=function(b,c){if(!b.isValid())return!1;if(d.disabledDates&&"d"===c&&M(b))return!1;if(d.enabledDates&&"d"===c&&!N(b))return!1;if(d.minDate&&b.isBefore(d.minDate,c))return!1;if(d.maxDate&&b.isAfter(d.maxDate,c))return!1;if(d.daysOfWeekDisabled&&"d"===c&&-1!==d.daysOfWeekDisabled.indexOf(b.day()))return!1;if(d.disabledHours&&("h"===c||"m"===c||"s"===c)&&O(b))return!1;if(d.enabledHours&&("h"===c||"m"===c||"s"===c)&&!P(b))return!1;if(d.disabledTimeIntervals&&("h"===c||"m"===c||"s"===c)){var e=!1;if(a.each(d.disabledTimeIntervals,function(){return b.isBetween(this[0],this[1])?(e=!0,!1):void 0}),e)return!1}return!0},R=function(){for(var b=[],c=f.clone().startOf("y").startOf("d");c.isSame(f,"y");)b.push(a("<span>").attr("data-action","selectMonth").addClass("month").text(c.format("MMM"))),c.add(1,"M");o.find(".datepicker-months td").empty().append(b)},S=function(){var b=o.find(".datepicker-months"),c=b.find("th"),g=b.find("tbody").find("span");c.eq(0).find("span").attr("title",d.tooltips.prevYear),c.eq(1).attr("title",d.tooltips.selectYear),c.eq(2).find("span").attr("title",d.tooltips.nextYear),b.find(".disabled").removeClass("disabled"),Q(f.clone().subtract(1,"y"),"y")||c.eq(0).addClass("disabled"),c.eq(1).text(f.year()),Q(f.clone().add(1,"y"),"y")||c.eq(2).addClass("disabled"),g.removeClass("active"),e.isSame(f,"y")&&!m&&g.eq(e.month()).addClass("active"),g.each(function(b){Q(f.clone().month(b),"M")||a(this).addClass("disabled")})},T=function(){var a=o.find(".datepicker-years"),b=a.find("th"),c=f.clone().subtract(5,"y"),g=f.clone().add(6,"y"),h="";for(b.eq(0).find("span").attr("title",d.tooltips.prevDecade),b.eq(1).attr("title",d.tooltips.selectDecade),b.eq(2).find("span").attr("title",d.tooltips.nextDecade),a.find(".disabled").removeClass("disabled"),d.minDate&&d.minDate.isAfter(c,"y")&&b.eq(0).addClass("disabled"),b.eq(1).text(c.year()+"-"+g.year()),d.maxDate&&d.maxDate.isBefore(g,"y")&&b.eq(2).addClass("disabled");!c.isAfter(g,"y");)h+='<span data-action="selectYear" class="year'+(c.isSame(e,"y")&&!m?" active":"")+(Q(c,"y")?"":" disabled")+'">'+c.year()+"</span>",c.add(1,"y");a.find("td").html(h)},U=function(){var a=o.find(".datepicker-decades"),c=a.find("th"),g=b({y:f.year()-f.year()%100-1}),h=g.clone().add(100,"y"),i=g.clone(),j="";for(c.eq(0).find("span").attr("title",d.tooltips.prevCentury),c.eq(2).find("span").attr("title",d.tooltips.nextCentury),a.find(".disabled").removeClass("disabled"),(g.isSame(b({y:1900}))||d.minDate&&d.minDate.isAfter(g,"y"))&&c.eq(0).addClass("disabled"),c.eq(1).text(g.year()+"-"+h.year()),(g.isSame(b({y:2e3}))||d.maxDate&&d.maxDate.isBefore(h,"y"))&&c.eq(2).addClass("disabled");!g.isAfter(h,"y");)j+='<span data-action="selectDecade" class="decade'+(g.isSame(e,"y")?" active":"")+(Q(g,"y")?"":" disabled")+'" data-selection="'+(g.year()+6)+'">'+(g.year()+1)+" - "+(g.year()+12)+"</span>",g.add(12,"y");j+="<span></span><span></span><span></span>",a.find("td").html(j),c.eq(1).text(i.year()+1+"-"+g.year())},V=function(){var b,c,g,h,i=o.find(".datepicker-days"),j=i.find("th"),k=[];if(A()){for(j.eq(0).find("span").attr("title",d.tooltips.prevMonth),j.eq(1).attr("title",d.tooltips.selectMonth),j.eq(2).find("span").attr("title",d.tooltips.nextMonth),i.find(".disabled").removeClass("disabled"),j.eq(1).text(f.format(d.dayViewHeaderFormat)),Q(f.clone().subtract(1,"M"),"M")||j.eq(0).addClass("disabled"),Q(f.clone().add(1,"M"),"M")||j.eq(2).addClass("disabled"),b=f.clone().startOf("M").startOf("w").startOf("d"),h=0;42>h;h++)0===b.weekday()&&(c=a("<tr>"),d.calendarWeeks&&c.append('<td class="cw">'+b.week()+"</td>"),k.push(c)),g="",b.isBefore(f,"M")&&(g+=" old"),b.isAfter(f,"M")&&(g+=" new"),b.isSame(e,"d")&&!m&&(g+=" active"),Q(b,"d")||(g+=" disabled"),b.isSame(x(),"d")&&(g+=" today"),(0===b.day()||6===b.day())&&(g+=" weekend"),c.append('<td data-action="selectDay" data-day="'+b.format("L")+'" class="day'+g+'">'+b.date()+"</td>"),b.add(1,"d");i.find("tbody").empty().append(k),S(),T(),U()}},W=function(){var b=o.find(".timepicker-hours table"),c=f.clone().startOf("d"),d=[],e=a("<tr>");for(f.hour()>11&&!h&&c.hour(12);c.isSame(f,"d")&&(h||f.hour()<12&&c.hour()<12||f.hour()>11);)c.hour()%4===0&&(e=a("<tr>"),d.push(e)),e.append('<td data-action="selectHour" class="hour'+(Q(c,"h")?"":" disabled")+'">'+c.format(h?"HH":"hh")+"</td>"),c.add(1,"h");b.empty().append(d)},X=function(){for(var b=o.find(".timepicker-minutes table"),c=f.clone().startOf("h"),e=[],g=a("<tr>"),h=1===d.stepping?5:d.stepping;f.isSame(c,"h");)c.minute()%(4*h)===0&&(g=a("<tr>"),e.push(g)),g.append('<td data-action="selectMinute" class="minute'+(Q(c,"m")?"":" disabled")+'">'+c.format("mm")+"</td>"),c.add(h,"m");b.empty().append(e)},Y=function(){for(var b=o.find(".timepicker-seconds table"),c=f.clone().startOf("m"),d=[],e=a("<tr>");f.isSame(c,"m");)c.second()%20===0&&(e=a("<tr>"),d.push(e)),e.append('<td data-action="selectSecond" class="second'+(Q(c,"s")?"":" disabled")+'">'+c.format("ss")+"</td>"),c.add(5,"s");b.empty().append(d)},Z=function(){var a,b,c=o.find(".timepicker span[data-time-component]");h||(a=o.find(".timepicker [data-action=togglePeriod]"),b=e.clone().add(e.hours()>=12?-12:12,"h"),a.text(e.format("A")),Q(b,"h")?a.removeClass("disabled"):a.addClass("disabled")),c.filter("[data-time-component=hours]").text(e.format(h?"HH":"hh")),c.filter("[data-time-component=minutes]").text(e.format("mm")),c.filter("[data-time-component=seconds]").text(e.format("ss")),W(),X(),Y()},$=function(){o&&(V(),Z())},_=function(a){var b=m?null:e;return a?(a=a.clone().locale(d.locale),1!==d.stepping&&a.minutes(Math.round(a.minutes()/d.stepping)*d.stepping%60).seconds(0),void(Q(a)?(e=a,f=e.clone(),g.val(e.format(i)),c.data("date",e.format(i)),m=!1,$(),I({type:"dp.change",date:e.clone(),oldDate:b})):(d.keepInvalid||g.val(m?"":e.format(i)),I({type:"dp.error",date:a})))):(m=!0,g.val(""),c.data("date",""),I({type:"dp.change",date:!1,oldDate:b}),void $())},aa=function(){var b=!1;return o?(o.find(".collapse").each(function(){var c=a(this).data("collapse");return c&&c.transitioning?(b=!0,!1):!0}),b?l:(n&&n.hasClass("btn")&&n.toggleClass("active"),o.hide(),a(window).off("resize",H),o.off("click","[data-action]"),o.off("mousedown",!1),o.remove(),o=!1,I({type:"dp.hide",date:e.clone()}),g.blur(),l)):l},ba=function(){_(null)},ca={next:function(){var a=q[k].navFnc;f.add(q[k].navStep,a),V(),J(a)},previous:function(){var a=q[k].navFnc;f.subtract(q[k].navStep,a),V(),J(a)},pickerSwitch:function(){K(1)},selectMonth:function(b){var c=a(b.target).closest("tbody").find("span").index(a(b.target));f.month(c),k===p?(_(e.clone().year(f.year()).month(f.month())),d.inline||aa()):(K(-1),V()),J("M")},selectYear:function(b){var c=parseInt(a(b.target).text(),10)||0;f.year(c),k===p?(_(e.clone().year(f.year())),d.inline||aa()):(K(-1),V()),J("YYYY")},selectDecade:function(b){var c=parseInt(a(b.target).data("selection"),10)||0;f.year(c),k===p?(_(e.clone().year(f.year())),d.inline||aa()):(K(-1),V()),J("YYYY")},selectDay:function(b){var c=f.clone();a(b.target).is(".old")&&c.subtract(1,"M"),a(b.target).is(".new")&&c.add(1,"M"),_(c.date(parseInt(a(b.target).text(),10))),z()||d.keepOpen||d.inline||aa()},incrementHours:function(){var a=e.clone().add(1,"h");Q(a,"h")&&_(a)},incrementMinutes:function(){var a=e.clone().add(d.stepping,"m");Q(a,"m")&&_(a)},incrementSeconds:function(){var a=e.clone().add(1,"s");Q(a,"s")&&_(a)},decrementHours:function(){var a=e.clone().subtract(1,"h");Q(a,"h")&&_(a)},decrementMinutes:function(){var a=e.clone().subtract(d.stepping,"m");Q(a,"m")&&_(a)},decrementSeconds:function(){var a=e.clone().subtract(1,"s");Q(a,"s")&&_(a)},togglePeriod:function(){_(e.clone().add(e.hours()>=12?-12:12,"h"))},togglePicker:function(b){var c,e=a(b.target),f=e.closest("ul"),g=f.find(".in"),h=f.find(".collapse:not(.in)");if(g&&g.length){if(c=g.data("collapse"),c&&c.transitioning)return;g.collapse?(g.collapse("hide"),h.collapse("show")):(g.removeClass("in"),h.addClass("in")),e.is("span")?e.toggleClass(d.icons.time+" "+d.icons.date):e.find("span").toggleClass(d.icons.time+" "+d.icons.date)}},showPicker:function(){o.find(".timepicker > div:not(.timepicker-picker)").hide(),o.find(".timepicker .timepicker-picker").show()},showHours:function(){o.find(".timepicker .timepicker-picker").hide(),o.find(".timepicker .timepicker-hours").show()},showMinutes:function(){o.find(".timepicker .timepicker-picker").hide(),o.find(".timepicker .timepicker-minutes").show()},showSeconds:function(){o.find(".timepicker .timepicker-picker").hide(),o.find(".timepicker .timepicker-seconds").show()},selectHour:function(b){var c=parseInt(a(b.target).text(),10);h||(e.hours()>=12?12!==c&&(c+=12):12===c&&(c=0)),_(e.clone().hours(c)),ca.showPicker.call(l)},selectMinute:function(b){_(e.clone().minutes(parseInt(a(b.target).text(),10))),ca.showPicker.call(l)},selectSecond:function(b){_(e.clone().seconds(parseInt(a(b.target).text(),10))),ca.showPicker.call(l)},clear:ba,today:function(){var a=x();Q(a,"d")&&_(a)},close:aa},da=function(b){return a(b.currentTarget).is(".disabled")?!1:(ca[a(b.currentTarget).data("action")].apply(l,arguments),!1)},ea=function(){var b,c={year:function(a){return a.month(0).date(1).hours(0).seconds(0).minutes(0)},month:function(a){return a.date(1).hours(0).seconds(0).minutes(0)},day:function(a){return a.hours(0).seconds(0).minutes(0)},hour:function(a){return a.seconds(0).minutes(0)},minute:function(a){return a.seconds(0)}};return g.prop("disabled")||!d.ignoreReadonly&&g.prop("readonly")||o?l:(void 0!==g.val()&&0!==g.val().trim().length?_(ga(g.val().trim())):d.useCurrent&&m&&(g.is("input")&&0===g.val().trim().length||d.inline)&&(b=x(),"string"==typeof d.useCurrent&&(b=c[d.useCurrent](b)),_(b)),o=F(),L(),R(),o.find(".timepicker-hours").hide(),o.find(".timepicker-minutes").hide(),o.find(".timepicker-seconds").hide(),$(),K(),a(window).on("resize",H),o.on("click","[data-action]",da),o.on("mousedown",!1),n&&n.hasClass("btn")&&n.toggleClass("active"),o.show(),H(),d.focusOnShow&&!g.is(":focus")&&g.focus(),I({type:"dp.show"}),l)},fa=function(){return o?aa():ea()},ga=function(a){return a=void 0===d.parseInputDate?b.isMoment(a)||a instanceof Date?b(a):x(a):d.parseInputDate(a),a.locale(d.locale),a},ha=function(a){var b,c,e,f,g=null,h=[],i={},j=a.which,k="p";w[j]=k;for(b in w)w.hasOwnProperty(b)&&w[b]===k&&(h.push(b),parseInt(b,10)!==j&&(i[b]=!0));for(b in d.keyBinds)if(d.keyBinds.hasOwnProperty(b)&&"function"==typeof d.keyBinds[b]&&(e=b.split(" "),e.length===h.length&&v[j]===e[e.length-1])){for(f=!0,c=e.length-2;c>=0;c--)if(!(v[e[c]]in i)){f=!1;break}if(f){g=d.keyBinds[b];break}}g&&(g.call(l,o),a.stopPropagation(),a.preventDefault())},ia=function(a){w[a.which]="r",a.stopPropagation(),a.preventDefault()},ja=function(b){var c=a(b.target).val().trim(),d=c?ga(c):null;return _(d),b.stopImmediatePropagation(),!1},ka=function(){g.on({change:ja,blur:d.debug?"":aa,keydown:ha,keyup:ia,focus:d.allowInputToggle?ea:""}),c.is("input")?g.on({focus:ea}):n&&(n.on("click",fa),n.on("mousedown",!1))},la=function(){g.off({change:ja,blur:blur,keydown:ha,keyup:ia,focus:d.allowInputToggle?aa:""}),c.is("input")?g.off({focus:ea}):n&&(n.off("click",fa),n.off("mousedown",!1))},ma=function(b){var c={};return a.each(b,function(){var a=ga(this);a.isValid()&&(c[a.format("YYYY-MM-DD")]=!0)}),Object.keys(c).length?c:!1},na=function(b){var c={};return a.each(b,function(){c[this]=!0}),Object.keys(c).length?c:!1},oa=function(){var a=d.format||"L LT";i=a.replace(/(\[[^\[]*\])|(\\)?(LTS|LT|LL?L?L?|l{1,4})/g,function(a){var b=e.localeData().longDateFormat(a)||a;return b.replace(/(\[[^\[]*\])|(\\)?(LTS|LT|LL?L?L?|l{1,4})/g,function(a){return e.localeData().longDateFormat(a)||a})}),j=d.extraFormats?d.extraFormats.slice():[],j.indexOf(a)<0&&j.indexOf(i)<0&&j.push(i),h=i.toLowerCase().indexOf("a")<1&&i.replace(/\[.*?\]/g,"").indexOf("h")<1,y("y")&&(p=2),y("M")&&(p=1),y("d")&&(p=0),k=Math.max(p,k),m||_(e)};if(l.destroy=function(){aa(),la(),c.removeData("DateTimePicker"),c.removeData("date")},l.toggle=fa,l.show=ea,l.hide=aa,l.disable=function(){return aa(),n&&n.hasClass("btn")&&n.addClass("disabled"),g.prop("disabled",!0),l},l.enable=function(){return n&&n.hasClass("btn")&&n.removeClass("disabled"),g.prop("disabled",!1),l},l.ignoreReadonly=function(a){if(0===arguments.length)return d.ignoreReadonly;if("boolean"!=typeof a)throw new TypeError("ignoreReadonly () expects a boolean parameter");return d.ignoreReadonly=a,l},l.options=function(b){if(0===arguments.length)return a.extend(!0,{},d);if(!(b instanceof Object))throw new TypeError("options() options parameter should be an object");return a.extend(!0,d,b),a.each(d,function(a,b){if(void 0===l[a])throw new TypeError("option "+a+" is not recognized!");l[a](b)}),l},l.date=function(a){if(0===arguments.length)return m?null:e.clone();if(!(null===a||"string"==typeof a||b.isMoment(a)||a instanceof Date))throw new TypeError("date() parameter must be one of [null, string, moment or Date]");return _(null===a?null:ga(a)),l},l.format=function(a){if(0===arguments.length)return d.format;if("string"!=typeof a&&("boolean"!=typeof a||a!==!1))throw new TypeError("format() expects a sting or boolean:false parameter "+a);return d.format=a,i&&oa(),l},l.timeZone=function(a){return 0===arguments.length?d.timeZone:(d.timeZone=a,l)},l.dayViewHeaderFormat=function(a){if(0===arguments.length)return d.dayViewHeaderFormat;if("string"!=typeof a)throw new TypeError("dayViewHeaderFormat() expects a string parameter");return d.dayViewHeaderFormat=a,l},l.extraFormats=function(a){if(0===arguments.length)return d.extraFormats;if(a!==!1&&!(a instanceof Array))throw new TypeError("extraFormats() expects an array or false parameter");return d.extraFormats=a,j&&oa(),l},l.disabledDates=function(b){if(0===arguments.length)return d.disabledDates?a.extend({},d.disabledDates):d.disabledDates;if(!b)return d.disabledDates=!1,$(),l;if(!(b instanceof Array))throw new TypeError("disabledDates() expects an array parameter");return d.disabledDates=ma(b),d.enabledDates=!1,$(),l},l.enabledDates=function(b){if(0===arguments.length)return d.enabledDates?a.extend({},d.enabledDates):d.enabledDates;if(!b)return d.enabledDates=!1,$(),l;if(!(b instanceof Array))throw new TypeError("enabledDates() expects an array parameter");return d.enabledDates=ma(b),d.disabledDates=!1,$(),l},l.daysOfWeekDisabled=function(a){if(0===arguments.length)return d.daysOfWeekDisabled.splice(0);if("boolean"==typeof a&&!a)return d.daysOfWeekDisabled=!1,$(),l;if(!(a instanceof Array))throw new TypeError("daysOfWeekDisabled() expects an array parameter");if(d.daysOfWeekDisabled=a.reduce(function(a,b){return b=parseInt(b,10),b>6||0>b||isNaN(b)?a:(-1===a.indexOf(b)&&a.push(b),a)},[]).sort(),d.useCurrent&&!d.keepInvalid){for(var b=0;!Q(e,"d");){if(e.add(1,"d"),7===b)throw"Tried 7 times to find a valid date";b++}_(e)}return $(),l},l.maxDate=function(a){if(0===arguments.length)return d.maxDate?d.maxDate.clone():d.maxDate;if("boolean"==typeof a&&a===!1)return d.maxDate=!1,$(),l;"string"==typeof a&&("now"===a||"moment"===a)&&(a=x());var b=ga(a);if(!b.isValid())throw new TypeError("maxDate() Could not parse date parameter: "+a);if(d.minDate&&b.isBefore(d.minDate))throw new TypeError("maxDate() date parameter is before options.minDate: "+b.format(i));return d.maxDate=b,d.useCurrent&&!d.keepInvalid&&e.isAfter(a)&&_(d.maxDate),f.isAfter(b)&&(f=b.clone().subtract(d.stepping,"m")),$(),l},l.minDate=function(a){if(0===arguments.length)return d.minDate?d.minDate.clone():d.minDate;if("boolean"==typeof a&&a===!1)return d.minDate=!1,$(),l;"string"==typeof a&&("now"===a||"moment"===a)&&(a=x());var b=ga(a);if(!b.isValid())throw new TypeError("minDate() Could not parse date parameter: "+a);if(d.maxDate&&b.isAfter(d.maxDate))throw new TypeError("minDate() date parameter is after options.maxDate: "+b.format(i));return d.minDate=b,d.useCurrent&&!d.keepInvalid&&e.isBefore(a)&&_(d.minDate),f.isBefore(b)&&(f=b.clone().add(d.stepping,"m")),$(),l},l.defaultDate=function(a){if(0===arguments.length)return d.defaultDate?d.defaultDate.clone():d.defaultDate;if(!a)return d.defaultDate=!1,l;"string"==typeof a&&("now"===a||"moment"===a)&&(a=x());var b=ga(a);if(!b.isValid())throw new TypeError("defaultDate() Could not parse date parameter: "+a);if(!Q(b))throw new TypeError("defaultDate() date passed is invalid according to component setup validations");return d.defaultDate=b,(d.defaultDate&&d.inline||""===g.val().trim())&&_(d.defaultDate),l},l.locale=function(a){if(0===arguments.length)return d.locale;if(!b.localeData(a))throw new TypeError("locale() locale "+a+" is not loaded from moment locales!");return d.locale=a,e.locale(d.locale),f.locale(d.locale),i&&oa(),o&&(aa(),ea()),l},l.stepping=function(a){return 0===arguments.length?d.stepping:(a=parseInt(a,10),(isNaN(a)||1>a)&&(a=1),d.stepping=a,l)},l.useCurrent=function(a){var b=["year","month","day","hour","minute"];if(0===arguments.length)return d.useCurrent;if("boolean"!=typeof a&&"string"!=typeof a)throw new TypeError("useCurrent() expects a boolean or string parameter");if("string"==typeof a&&-1===b.indexOf(a.toLowerCase()))throw new TypeError("useCurrent() expects a string parameter of "+b.join(", "));return d.useCurrent=a,l},l.collapse=function(a){if(0===arguments.length)return d.collapse;if("boolean"!=typeof a)throw new TypeError("collapse() expects a boolean parameter");return d.collapse===a?l:(d.collapse=a,o&&(aa(),ea()),l)},l.icons=function(b){if(0===arguments.length)return a.extend({},d.icons);if(!(b instanceof Object))throw new TypeError("icons() expects parameter to be an Object");return a.extend(d.icons,b),o&&(aa(),ea()),l},l.tooltips=function(b){if(0===arguments.length)return a.extend({},d.tooltips);if(!(b instanceof Object))throw new TypeError("tooltips() expects parameter to be an Object");return a.extend(d.tooltips,b),o&&(aa(),ea()),l},l.useStrict=function(a){if(0===arguments.length)return d.useStrict;if("boolean"!=typeof a)throw new TypeError("useStrict() expects a boolean parameter");return d.useStrict=a,l},l.sideBySide=function(a){if(0===arguments.length)return d.sideBySide;if("boolean"!=typeof a)throw new TypeError("sideBySide() expects a boolean parameter");return d.sideBySide=a,o&&(aa(),ea()),l},l.viewMode=function(a){if(0===arguments.length)return d.viewMode;if("string"!=typeof a)throw new TypeError("viewMode() expects a string parameter");if(-1===r.indexOf(a))throw new TypeError("viewMode() parameter must be one of ("+r.join(", ")+") value");return d.viewMode=a,k=Math.max(r.indexOf(a),p),K(),l},l.toolbarPlacement=function(a){if(0===arguments.length)return d.toolbarPlacement;if("string"!=typeof a)throw new TypeError("toolbarPlacement() expects a string parameter");if(-1===u.indexOf(a))throw new TypeError("toolbarPlacement() parameter must be one of ("+u.join(", ")+") value");return d.toolbarPlacement=a,o&&(aa(),ea()),l},l.widgetPositioning=function(b){if(0===arguments.length)return a.extend({},d.widgetPositioning);if("[object Object]"!=={}.toString.call(b))throw new TypeError("widgetPositioning() expects an object variable");if(b.horizontal){if("string"!=typeof b.horizontal)throw new TypeError("widgetPositioning() horizontal variable must be a string");if(b.horizontal=b.horizontal.toLowerCase(),-1===t.indexOf(b.horizontal))throw new TypeError("widgetPositioning() expects horizontal parameter to be one of ("+t.join(", ")+")");d.widgetPositioning.horizontal=b.horizontal}if(b.vertical){if("string"!=typeof b.vertical)throw new TypeError("widgetPositioning() vertical variable must be a string");if(b.vertical=b.vertical.toLowerCase(),-1===s.indexOf(b.vertical))throw new TypeError("widgetPositioning() expects vertical parameter to be one of ("+s.join(", ")+")");d.widgetPositioning.vertical=b.vertical}return $(),l},l.calendarWeeks=function(a){if(0===arguments.length)return d.calendarWeeks;if("boolean"!=typeof a)throw new TypeError("calendarWeeks() expects parameter to be a boolean value");return d.calendarWeeks=a,$(),l},l.showTodayButton=function(a){if(0===arguments.length)return d.showTodayButton;if("boolean"!=typeof a)throw new TypeError("showTodayButton() expects a boolean parameter");return d.showTodayButton=a,o&&(aa(),ea()),l},l.showClear=function(a){if(0===arguments.length)return d.showClear;if("boolean"!=typeof a)throw new TypeError("showClear() expects a boolean parameter");return d.showClear=a,o&&(aa(),ea()),l},l.widgetParent=function(b){if(0===arguments.length)return d.widgetParent;if("string"==typeof b&&(b=a(b)),null!==b&&"string"!=typeof b&&!(b instanceof a))throw new TypeError("widgetParent() expects a string or a jQuery object parameter");return d.widgetParent=b,o&&(aa(),ea()),l},l.keepOpen=function(a){if(0===arguments.length)return d.keepOpen;if("boolean"!=typeof a)throw new TypeError("keepOpen() expects a boolean parameter");return d.keepOpen=a,l},l.focusOnShow=function(a){if(0===arguments.length)return d.focusOnShow;if("boolean"!=typeof a)throw new TypeError("focusOnShow() expects a boolean parameter");return d.focusOnShow=a,l},l.inline=function(a){if(0===arguments.length)return d.inline;if("boolean"!=typeof a)throw new TypeError("inline() expects a boolean parameter");return d.inline=a,l},l.clear=function(){return ba(),l},l.keyBinds=function(a){return d.keyBinds=a,l},l.getMoment=function(a){return x(a)},l.debug=function(a){if("boolean"!=typeof a)throw new TypeError("debug() expects a boolean parameter");return d.debug=a,l},l.allowInputToggle=function(a){if(0===arguments.length)return d.allowInputToggle;if("boolean"!=typeof a)throw new TypeError("allowInputToggle() expects a boolean parameter");return d.allowInputToggle=a,l},l.showClose=function(a){if(0===arguments.length)return d.showClose;if("boolean"!=typeof a)throw new TypeError("showClose() expects a boolean parameter");return d.showClose=a,l},l.keepInvalid=function(a){if(0===arguments.length)return d.keepInvalid;if("boolean"!=typeof a)throw new TypeError("keepInvalid() expects a boolean parameter");return d.keepInvalid=a,l},l.datepickerInput=function(a){if(0===arguments.length)return d.datepickerInput;if("string"!=typeof a)throw new TypeError("datepickerInput() expects a string parameter");return d.datepickerInput=a,l},l.parseInputDate=function(a){if(0===arguments.length)return d.parseInputDate;
if("function"!=typeof a)throw new TypeError("parseInputDate() sholud be as function");return d.parseInputDate=a,l},l.disabledTimeIntervals=function(b){if(0===arguments.length)return d.disabledTimeIntervals?a.extend({},d.disabledTimeIntervals):d.disabledTimeIntervals;if(!b)return d.disabledTimeIntervals=!1,$(),l;if(!(b instanceof Array))throw new TypeError("disabledTimeIntervals() expects an array parameter");return d.disabledTimeIntervals=b,$(),l},l.disabledHours=function(b){if(0===arguments.length)return d.disabledHours?a.extend({},d.disabledHours):d.disabledHours;if(!b)return d.disabledHours=!1,$(),l;if(!(b instanceof Array))throw new TypeError("disabledHours() expects an array parameter");if(d.disabledHours=na(b),d.enabledHours=!1,d.useCurrent&&!d.keepInvalid){for(var c=0;!Q(e,"h");){if(e.add(1,"h"),24===c)throw"Tried 24 times to find a valid date";c++}_(e)}return $(),l},l.enabledHours=function(b){if(0===arguments.length)return d.enabledHours?a.extend({},d.enabledHours):d.enabledHours;if(!b)return d.enabledHours=!1,$(),l;if(!(b instanceof Array))throw new TypeError("enabledHours() expects an array parameter");if(d.enabledHours=na(b),d.disabledHours=!1,d.useCurrent&&!d.keepInvalid){for(var c=0;!Q(e,"h");){if(e.add(1,"h"),24===c)throw"Tried 24 times to find a valid date";c++}_(e)}return $(),l},l.viewDate=function(a){if(0===arguments.length)return f.clone();if(!a)return f=e.clone(),l;if(!("string"==typeof a||b.isMoment(a)||a instanceof Date))throw new TypeError("viewDate() parameter must be one of [string, moment or Date]");return f=ga(a),J(),l},c.is("input"))g=c;else if(g=c.find(d.datepickerInput),0===g.size())g=c.find("input");else if(!g.is("input"))throw new Error('CSS class "'+d.datepickerInput+'" cannot be applied to non input element');if(c.hasClass("input-group")&&(n=0===c.find(".datepickerbutton").size()?c.find(".input-group-addon"):c.find(".datepickerbutton")),!d.inline&&!g.is("input"))throw new Error("Could not initialize DateTimePicker without an input element");return e=x(),f=e.clone(),a.extend(!0,d,G()),l.options(d),oa(),ka(),g.prop("disabled")&&l.disable(),g.is("input")&&0!==g.val().trim().length?_(ga(g.val().trim())):d.defaultDate&&void 0===g.attr("placeholder")&&_(d.defaultDate),d.inline&&ea(),l};a.fn.datetimepicker=function(b){return this.each(function(){var d=a(this);d.data("DateTimePicker")||(b=a.extend(!0,{},a.fn.datetimepicker.defaults,b),d.data("DateTimePicker",c(d,b)))})},a.fn.datetimepicker.defaults={timeZone:"Etc/UTC",format:!1,dayViewHeaderFormat:"MMMM YYYY",extraFormats:!1,stepping:1,minDate:!1,maxDate:!1,useCurrent:!0,collapse:!0,locale:b.locale(),defaultDate:!1,disabledDates:!1,enabledDates:!1,icons:{time:"glyphicon glyphicon-time",date:"glyphicon glyphicon-calendar",up:"glyphicon glyphicon-chevron-up",down:"glyphicon glyphicon-chevron-down",previous:"glyphicon glyphicon-chevron-left",next:"glyphicon glyphicon-chevron-right",today:"glyphicon glyphicon-screenshot",clear:"glyphicon glyphicon-trash",close:"glyphicon glyphicon-remove"},tooltips:{today:"Go to today",clear:"Clear selection",close:"Close the picker",selectMonth:"Select Month",prevMonth:"Previous Month",nextMonth:"Next Month",selectYear:"Select Year",prevYear:"Previous Year",nextYear:"Next Year",selectDecade:"Select Decade",prevDecade:"Previous Decade",nextDecade:"Next Decade",prevCentury:"Previous Century",nextCentury:"Next Century",pickHour:"Pick Hour",incrementHour:"Increment Hour",decrementHour:"Decrement Hour",pickMinute:"Pick Minute",incrementMinute:"Increment Minute",decrementMinute:"Decrement Minute",pickSecond:"Pick Second",incrementSecond:"Increment Second",decrementSecond:"Decrement Second",togglePeriod:"Toggle Period",selectTime:"Select Time"},useStrict:!1,sideBySide:!1,daysOfWeekDisabled:!1,calendarWeeks:!1,viewMode:"days",toolbarPlacement:"default",showTodayButton:!1,showClear:!1,showClose:!1,widgetPositioning:{horizontal:"auto",vertical:"auto"},widgetParent:null,ignoreReadonly:!1,keepOpen:!1,focusOnShow:!0,inline:!1,keepInvalid:!1,datepickerInput:".datepickerinput",keyBinds:{up:function(a){if(a){var b=this.date()||this.getMoment();a.find(".datepicker").is(":visible")?this.date(b.clone().subtract(7,"d")):this.date(b.clone().add(this.stepping(),"m"))}},down:function(a){if(!a)return void this.show();var b=this.date()||this.getMoment();a.find(".datepicker").is(":visible")?this.date(b.clone().add(7,"d")):this.date(b.clone().subtract(this.stepping(),"m"))},"control up":function(a){if(a){var b=this.date()||this.getMoment();a.find(".datepicker").is(":visible")?this.date(b.clone().subtract(1,"y")):this.date(b.clone().add(1,"h"))}},"control down":function(a){if(a){var b=this.date()||this.getMoment();a.find(".datepicker").is(":visible")?this.date(b.clone().add(1,"y")):this.date(b.clone().subtract(1,"h"))}},left:function(a){if(a){var b=this.date()||this.getMoment();a.find(".datepicker").is(":visible")&&this.date(b.clone().subtract(1,"d"))}},right:function(a){if(a){var b=this.date()||this.getMoment();a.find(".datepicker").is(":visible")&&this.date(b.clone().add(1,"d"))}},pageUp:function(a){if(a){var b=this.date()||this.getMoment();a.find(".datepicker").is(":visible")&&this.date(b.clone().subtract(1,"M"))}},pageDown:function(a){if(a){var b=this.date()||this.getMoment();a.find(".datepicker").is(":visible")&&this.date(b.clone().add(1,"M"))}},enter:function(){this.hide()},escape:function(){this.hide()},"control space":function(a){a.find(".timepicker").is(":visible")&&a.find('.btn[data-action="togglePeriod"]').click()},t:function(){this.date(this.getMoment())},"delete":function(){this.clear()}},debug:!1,allowInputToggle:!1,disabledTimeIntervals:!1,disabledHours:!1,enabledHours:!1,viewDate:!1}});
/*
    Redactor v10.0.9
    Updated: March 16, 2015

    http://imperavi.com/redactor/

    Copyright (c) 2009-2015, Imperavi LLC.
    License: http://imperavi.com/redactor/license/

    Usage: $('#content').redactor();
*/

(function($)
{
    'use strict';

    if (!Function.prototype.bind)
    {
        Function.prototype.bind = function(scope)
        {
            var fn = this;
            return function()
            {
                return fn.apply(scope);
            };
        };
    }

    var uuid = 0;

    var reUrlYoutube = /https?:\/\/(?:[0-9A-Z-]+\.)?(?:youtu\.be\/|youtube\.com\S*[^\w\-\s])([\w\-]{11})(?=[^\w\-]|$)(?![?=&+%\w.\-]*(?:['"][^<>]*>|<\/a>))[?=&+%\w.-]*/ig;
    var reUrlVimeo = /https?:\/\/(www\.)?vimeo.com\/(\d+)($|\/)/;

    // Plugin
    $.fn.redactor = function(options)
    {
        var val = [];
        var args = Array.prototype.slice.call(arguments, 1);

        if (typeof options === 'string')
        {
            this.each(function()
            {
                var instance = $.data(this, 'redactor');
                var func;

                if (options.search(/\./) != '-1')
                {
                    func = options.split('.');
                    if (typeof instance[func[0]] != 'undefined')
                    {
                        func = instance[func[0]][func[1]];
                    }
                }
                else
                {
                    func = instance[options];
                }

                if (typeof instance !== 'undefined' && $.isFunction(func))
                {
                    var methodVal = func.apply(instance, args);
                    if (methodVal !== undefined && methodVal !== instance)
                    {
                        val.push(methodVal);
                    }
                }
                else
                {
                    $.error('No such method "' + options + '" for Redactor');
                }
            });
        }
        else
        {
            this.each(function()
            {
                $.data(this, 'redactor', {});
                $.data(this, 'redactor', Redactor(this, options));
            });
        }

        if (val.length === 0) return this;
        else if (val.length === 1) return val[0];
        else return val;

    };

    // Initialization
    function Redactor(el, options)
    {
        return new Redactor.prototype.init(el, options);
    }

    // Functionality
    $.Redactor = Redactor;
    $.Redactor.VERSION = '10.0.9';
    $.Redactor.modules = ['alignment', 'autosave', 'block', 'buffer', 'build', 'button',
                          'caret', 'clean', 'code', 'core', 'dropdown', 'file', 'focus',
                          'image', 'indent', 'inline', 'insert', 'keydown', 'keyup',
                          'lang', 'line', 'link', 'list', 'modal', 'observe', 'paragraphize',
                          'paste', 'placeholder', 'progress', 'selection', 'shortcuts',
                          'tabifier', 'tidy',  'toolbar', 'upload', 'utils'];

    $.Redactor.opts = {

        // settings
        lang: 'en',
        direction: 'ltr', // ltr or rtl

        plugins: false, // array

        focus: false,
        focusEnd: false,

        placeholder: false,

        visual: true,
        tabindex: false,

        minHeight: false,
        maxHeight: false,

        linebreaks: false,
        replaceDivs: true,
        paragraphize: true,
        cleanStyleOnEnter: false,
        enterKey: true,

        cleanOnPaste: true,
        cleanSpaces: true,
        pastePlainText: false,

        autosave: false, // false or url
        autosaveName: false,
        autosaveInterval: 60, // seconds
        autosaveOnChange: false,
        autosaveFields: false,

        linkTooltip: true,
        linkProtocol: 'http',
        linkNofollow: false,
        linkSize: 50,

        imageEditable: true,
        imageLink: true,
        imagePosition: true,
        imageFloatMargin: '10px',
        imageResizable: true,

        imageUpload: null,
        imageUploadParam: 'file',

        uploadImageField: false,

        dragImageUpload: true,

        fileUpload: null,
        fileUploadParam: 'file',

        dragFileUpload: true,

        s3: false,

        convertLinks: true,
        convertUrlLinks: true,
        convertImageLinks: true,
        convertVideoLinks: true,

        preSpaces: 4, // or false
        tabAsSpaces: false, // true or number of spaces
        tabKey: true,

        scrollTarget: false,

        toolbar: true,
        toolbarFixed: true,
        toolbarFixedTarget: document,
        toolbarFixedTopOffset: 0, // pixels
        toolbarExternal: false, // ID selector
        toolbarOverflow: false,

        source: true,
        buttons: ['html', 'formatting', 'bold', 'italic', 'deleted', 'unorderedlist', 'orderedlist',
                  'outdent', 'indent', 'image', 'file', 'link', 'alignment', 'horizontalrule'], // + 'underline'

        buttonsHide: [],
        buttonsHideOnMobile: [],

        formatting: ['p', 'blockquote', 'pre', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'sup', 'sub', 'small'],
        formattingAdd: false,

        tabifier: true,

        deniedTags: ['script', 'style'],
        allowedTags: false, // or array

        removeComments: false,
        replaceTags: [
            ['strike', 'del']
        ],
        replaceStyles: [
            ['font-weight:\\s?bold', "strong"],
            ['font-style:\\s?italic', "em"],
            ['text-decoration:\\s?underline', "u"],
            ['text-decoration:\\s?line-through', 'del']
        ],
        removeDataAttr: false,

        removeAttr: false, // or multi array
        allowedAttr: false, // or multi array

        removeWithoutAttr: ['span'], // or false
        removeEmpty: ['p'], // or false;

        activeButtons: ['deleted', 'italic', 'bold', 'underline', 'unorderedlist', 'orderedlist',
                        'alignleft', 'aligncenter', 'alignright', 'justify'],
        activeButtonsStates: {
            b: 'bold',
            strong: 'bold',
            i: 'italic',
            em: 'italic',
            del: 'deleted',
            strike: 'deleted',
            ul: 'unorderedlist',
            ol: 'orderedlist',
            u: 'underline'
        },

        shortcuts: {
            'ctrl+shift+m, meta+shift+m': { func: 'inline.removeFormat' },
            'ctrl+b, meta+b': { func: 'inline.format', params: ['bold'] },
            'ctrl+i, meta+i': { func: 'inline.format', params: ['italic'] },
            'ctrl+h, meta+h': { func: 'inline.format', params: ['superscript'] },
            'ctrl+l, meta+l': { func: 'inline.format', params: ['subscript'] },
            'ctrl+k, meta+k': { func: 'link.show' },
            'ctrl+shift+7':   { func: 'list.toggle', params: ['orderedlist'] },
            'ctrl+shift+8':   { func: 'list.toggle', params: ['unorderedlist'] }
        },
        shortcutsAdd: false,

        // private
        buffer: [],
        rebuffer: [],
        emptyHtml: '<p>&#x200b;</p>',
        invisibleSpace: '&#x200b;',
        imageTypes: ['image/png', 'image/jpeg', 'image/gif'],
        indentValue: 20,
        verifiedTags:       ['a', 'img', 'b', 'strong', 'sub', 'sup', 'i', 'em', 'u', 'small', 'strike', 'del', 'cite', 'ul', 'ol', 'li'], // and for span tag special rule
        inlineTags:         ['strong', 'b', 'u', 'em', 'i', 'code', 'del', 'ins', 'samp', 'kbd', 'sup', 'sub', 'mark', 'var', 'cite', 'small'],
        alignmentTags:      ['P', 'H1', 'H2', 'H3', 'H4', 'H5', 'H6',  'DL', 'DT', 'DD', 'DIV', 'TD', 'BLOCKQUOTE', 'OUTPUT', 'FIGCAPTION', 'ADDRESS', 'SECTION', 'HEADER', 'FOOTER', 'ASIDE', 'ARTICLE'],
        blockLevelElements: ['PRE', 'UL', 'OL', 'LI'],


        // lang
        langs: {
            en: {
                html: 'HTML',
                video: 'Insert Video',
                image: 'Insert Image',
                table: 'Table',
                link: 'Link',
                link_insert: 'Insert link',
                link_edit: 'Edit link',
                unlink: 'Unlink',
                formatting: 'Formatting',
                paragraph: 'Normal text',
                quote: 'Quote',
                code: 'Code',
                header1: 'Header 1',
                header2: 'Header 2',
                header3: 'Header 3',
                header4: 'Header 4',
                header5: 'Header 5',
                bold: 'Bold',
                italic: 'Italic',
                fontcolor: 'Font Color',
                backcolor: 'Back Color',
                unorderedlist: 'Unordered List',
                orderedlist: 'Ordered List',
                outdent: 'Outdent',
                indent: 'Indent',
                cancel: 'Cancel',
                insert: 'Insert',
                save: 'Save',
                _delete: 'Delete',
                insert_table: 'Insert Table',
                insert_row_above: 'Add Row Above',
                insert_row_below: 'Add Row Below',
                insert_column_left: 'Add Column Left',
                insert_column_right: 'Add Column Right',
                delete_column: 'Delete Column',
                delete_row: 'Delete Row',
                delete_table: 'Delete Table',
                rows: 'Rows',
                columns: 'Columns',
                add_head: 'Add Head',
                delete_head: 'Delete Head',
                title: 'Title',
                image_position: 'Position',
                none: 'None',
                left: 'Left',
                right: 'Right',
                center: 'Center',
                image_web_link: 'Image Web Link',
                text: 'Text',
                mailto: 'Email',
                web: 'URL',
                video_html_code: 'Video Embed Code or Youtube/Vimeo Link',
                file: 'Insert File',
                upload: 'Upload',
                download: 'Download',
                choose: 'Choose',
                or_choose: 'Or choose',
                drop_file_here: 'Drop file here',
                align_left: 'Align text to the left',
                align_center: 'Center text',
                align_right: 'Align text to the right',
                align_justify: 'Justify text',
                horizontalrule: 'Insert Horizontal Rule',
                deleted: 'Deleted',
                anchor: 'Anchor',
                link_new_tab: 'Open link in new tab',
                underline: 'Underline',
                alignment: 'Alignment',
                filename: 'Name (optional)',
                edit: 'Edit',
                upload_label: 'Drop file here or '

            }
        }
    };

    // Functionality
    Redactor.fn = $.Redactor.prototype = {

        keyCode: {
            BACKSPACE: 8,
            DELETE: 46,
            DOWN: 40,
            ENTER: 13,
            SPACE: 32,
            ESC: 27,
            TAB: 9,
            CTRL: 17,
            META: 91,
            SHIFT: 16,
            ALT: 18,
            RIGHT: 39,
            LEFT: 37,
            LEFT_WIN: 91
        },

        // Initialization
        init: function(el, options)
        {
            this.$element = $(el);
            this.uuid = uuid++;

            // if paste event detected = true
            this.rtePaste = false;
            this.$pasteBox = false;

            this.loadOptions(options);
            this.loadModules();

            // formatting storage
            this.formatting = {};

            // block level tags
            $.merge(this.opts.blockLevelElements, this.opts.alignmentTags);
            this.reIsBlock = new RegExp('^(' + this.opts.blockLevelElements.join('|' ) + ')$', 'i');

            // setup allowed and denied tags
            this.tidy.setupAllowed();

            // setup denied tags
            if (this.opts.deniedTags !== false)
            {
                var tags = ['html', 'head', 'link', 'body', 'meta', 'applet'];
                for (var i = 0; i < tags.length; i++)
                {
                    this.opts.deniedTags.push(tags[i]);
                }
            }

            // load lang
            this.lang.load();

            // extend shortcuts
            $.extend(this.opts.shortcuts, this.opts.shortcutsAdd);

            // start callback
            this.core.setCallback('start');

            // build
            this.start = true;
            this.build.run();
        },

        loadOptions: function(options)
        {
            this.opts = $.extend(
                {},
                $.extend(true, {}, $.Redactor.opts),
                this.$element.data(),
                options
            );
        },
        getModuleMethods: function(object)
        {
            return Object.getOwnPropertyNames(object).filter(function(property)
            {
                return typeof object[property] == 'function';
            });
        },
        loadModules: function()
        {
            var len = $.Redactor.modules.length;
            for (var i = 0; i < len; i++)
            {
                this.bindModuleMethods($.Redactor.modules[i]);
            }
        },
        bindModuleMethods: function(module)
        {
            if (typeof this[module] == 'undefined') return;

            // init module
            this[module] = this[module]();

            var methods = this.getModuleMethods(this[module]);
            var len = methods.length;

            // bind methods
            for (var z = 0; z < len; z++)
            {
                this[module][methods[z]] = this[module][methods[z]].bind(this);
            }
        },

        alignment: function()
        {
            return {
                left: function()
                {
                    this.alignment.set('');
                },
                right: function()
                {
                    this.alignment.set('right');
                },
                center: function()
                {
                    this.alignment.set('center');
                },
                justify: function()
                {
                    this.alignment.set('justify');
                },
                set: function(type)
                {
                    // focus
                    if (!this.utils.browser('msie')) this.$editor.focus();

                    this.buffer.set();
                    this.selection.save();

                    // get blocks
                    this.alignment.blocks = this.selection.getBlocks();
                    this.alignment.type = type;

                    // set alignment
                    if (this.alignment.isLinebreaksOrNoBlocks())
                    {
                        this.alignment.setText();
                    }
                    else
                    {
                        this.alignment.setBlocks();
                    }

                    // sync
                    this.selection.restore();
                    this.code.sync();
                },
                setText: function()
                {
                    var wrapper = this.selection.wrap('div');
                    $(wrapper).attr('data-tagblock', 'redactor').css('text-align', this.alignment.type);
                },
                setBlocks: function()
                {
                    $.each(this.alignment.blocks, $.proxy(function(i, el)
                    {
                        var $el = this.utils.getAlignmentElement(el);
                        if (!$el) return;

                        if (this.alignment.isNeedReplaceElement($el))
                        {
                            this.alignment.replaceElement($el);
                        }
                        else
                        {
                            this.alignment.alignElement($el);
                        }

                    }, this));
                },
                isLinebreaksOrNoBlocks: function()
                {
                    return (this.opts.linebreaks && this.alignment.blocks[0] === false);
                },
                isNeedReplaceElement: function($el)
                {
                    return (this.alignment.type === '' && typeof($el.data('tagblock')) !== 'undefined');
                },
                replaceElement: function($el)
                {
                    $el.replaceWith($el.html());
                },
                alignElement: function($el)
                {
                    $el.css('text-align', this.alignment.type);
                    this.utils.removeEmptyAttr($el, 'style');
                }
            };
        },
        autosave: function()
        {
            return {
                enable: function()
                {
                    if (!this.opts.autosave) return;

                    this.autosave.html = false;
                    this.autosave.name = (this.opts.autosaveName) ? this.opts.autosaveName : this.$textarea.attr('name');

                    if (this.opts.autosaveOnChange) return;
                    this.autosaveInterval = setInterval(this.autosave.load, this.opts.autosaveInterval * 1000);
                },
                onChange: function()
                {
                    if (!this.opts.autosaveOnChange) return;
                    this.autosave.load();
                },
                load: function()
                {
                    this.autosave.source = this.code.get();

                    if (this.autosave.html === this.autosave.source) return;
                    if (this.utils.isEmpty(this.autosave.source)) return;

                    // data
                    var data = {};
                    data['name'] = this.autosave.name;
                    data[this.autosave.name] = this.autosave.source;
                    data = this.autosave.getHiddenFields(data);

                    // ajax
                    var jsxhr = $.ajax({
                        url: this.opts.autosave,
                        type: 'post',
                        data: data
                    });

                    jsxhr.done(this.autosave.success);
                },
                getHiddenFields: function(data)
                {
                    if (this.opts.autosaveFields === false || typeof this.opts.autosaveFields !== 'object')
                    {
                        return data;
                    }

                    $.each(this.opts.autosaveFields, $.proxy(function(k, v)
                    {
                        if (v !== null && v.toString().indexOf('#') === 0) v = $(v).val();
                        data[k] = v;

                    }, this));

                    return data;

                },
                success: function(data)
                {
                    var json;
                    try
                    {
                        json = $.parseJSON(data);
                    }
                    catch(e)
                    {
                        //data has already been parsed
                        json = data;
                    }

                    var callbackName = (typeof json.error == 'undefined') ? 'autosave' :  'autosaveError';

                    this.core.setCallback(callbackName, this.autosave.name, json);
                    this.autosave.html = this.autosave.source;
                },
                disable: function()
                {
                    clearInterval(this.autosaveInterval);
                }
            };
        },
        block: function()
        {
            return {
                formatting: function(name)
                {
                    this.block.clearStyle = false;
                    var type, value;

                    if (typeof this.formatting[name].data != 'undefined') type = 'data';
                    else if (typeof this.formatting[name].attr != 'undefined') type = 'attr';
                    else if (typeof this.formatting[name]['class'] != 'undefined') type = 'class';

                    if (typeof this.formatting[name].clear != 'undefined')
                    {
                        this.block.clearStyle = true;
                    }

                    if (type) value = this.formatting[name][type];

                    this.block.format(this.formatting[name].tag, type, value);

                },
                format: function(tag, type, value)
                {
                    if (tag == 'quote') tag = 'blockquote';

                    var formatTags = ['p', 'pre', 'blockquote', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'sup', 'sub', 'small'];
                    if ($.inArray(tag, formatTags) == -1) return;

                    this.block.isRemoveInline = (tag == 'pre' || tag.search(/h[1-6]/i) != -1);

                    // focus
                    if (!this.utils.browser('msie')) this.$editor.focus();

                    this.block.blocks = this.selection.getBlocks();

                    this.block.blocksSize = this.block.blocks.length;
                    this.block.type = type;
                    this.block.value = value;

                    this.buffer.set();
                    this.selection.save();

                    this.block.set(tag);

                    this.selection.restore();
                    this.code.sync();

                },
                set: function(tag)
                {
                    this.selection.get();
                    this.block.containerTag = this.range.commonAncestorContainer.tagName;

                    if (this.range.collapsed)
                    {
                        this.block.setCollapsed(tag);
                    }
                    else
                    {
                        this.block.setMultiple(tag);
                    }
                },
                setCollapsed: function(tag)
                {
                    var block = this.block.blocks[0];
                    if (block === false) return;

                    if (block.tagName == 'LI')
                    {
                        if (tag != 'blockquote') return;

                        this.block.formatListToBlockquote();
                        return;
                    }

                    var isContainerTable = (this.block.containerTag  == 'TD' || this.block.containerTag  == 'TH');
                    if (isContainerTable && !this.opts.linebreaks)
                    {

                        document.execCommand('formatblock', false, '<' + tag + '>');

                        block = this.selection.getBlock();
                        this.block.toggle($(block));

                    }
                    else if (block.tagName.toLowerCase() != tag)
                    {
                        if (this.opts.linebreaks && tag == 'p')
                        {
                            $(block).prepend('<br>').append('<br>');
                            this.utils.replaceWithContents(block);
                        }
                        else
                        {
                            var $formatted = this.utils.replaceToTag(block, tag);

                            this.block.toggle($formatted);

                            if (tag != 'p' && tag != 'blockquote') $formatted.find('img').remove();
                            if (this.block.isRemoveInline) this.utils.removeInlineTags($formatted);
                            if (tag == 'p' || this.block.headTag) $formatted.find('p').contents().unwrap();

                            this.block.formatTableWrapping($formatted);
                        }
                    }
                    else if (tag == 'blockquote' && block.tagName.toLowerCase() == tag)
                    {
                        // blockquote off
                        if (this.opts.linebreaks)
                        {
                            $(block).prepend('<br>').append('<br>');
                            this.utils.replaceWithContents(block);
                        }
                        else
                        {
                            var $el = this.utils.replaceToTag(block, 'p');
                            this.block.toggle($el);
                        }
                    }
                    else if (block.tagName.toLowerCase() == tag)
                    {
                        this.block.toggle($(block));
                    }

                    if (typeof this.block.type == 'undefined' && typeof this.block.value == 'undefined')
                    {
                        $(block).removeAttr('class').removeAttr('style');
                    }

                },
                setMultiple: function(tag)
                {
                    var block = this.block.blocks[0];
                    var isContainerTable = (this.block.containerTag  == 'TD' || this.block.containerTag  == 'TH');

                    if (block !== false && this.block.blocksSize === 1)
                    {
                        if (block.tagName.toLowerCase() == tag &&  tag == 'blockquote')
                        {
                            // blockquote off
                            if (this.opts.linebreaks)
                            {
                                $(block).prepend('<br>').append('<br>');
                                this.utils.replaceWithContents(block);
                            }
                            else
                            {
                                var $el = this.utils.replaceToTag(block, 'p');
                                this.block.toggle($el);
                            }
                        }
                        else if (block.tagName == 'LI')
                        {
                            if (tag != 'blockquote') return;

                            this.block.formatListToBlockquote();
                        }
                        else if (this.block.containerTag == 'BLOCKQUOTE')
                        {
                            this.block.formatBlockquote(tag);
                        }
                        else if (this.opts.linebreaks && ((isContainerTable) || (this.range.commonAncestorContainer != block)))
                        {
                            this.block.formatWrap(tag);
                        }
                        else
                        {
                            if (this.opts.linebreaks && tag == 'p')
                            {
                                $(block).prepend('<br>').append('<br>');
                                this.utils.replaceWithContents(block);
                            }
                            else if (block.tagName === 'TD')
                            {
                                this.block.formatWrap(tag);
                            }
                            else
                            {
                                var $formatted = this.utils.replaceToTag(block, tag);

                                this.block.toggle($formatted);

                                if (this.block.isRemoveInline) this.utils.removeInlineTags($formatted);
                                if (tag == 'p' || this.block.headTag) $formatted.find('p').contents().unwrap();
                            }
                        }
                    }
                    else
                    {

                        if (this.opts.linebreaks || tag != 'p')
                        {
                            if (tag == 'blockquote')
                            {
                                var count = 0;
                                for (var i = 0; i < this.block.blocksSize; i++)
                                {
                                    if (this.block.blocks[i].tagName == 'BLOCKQUOTE') count++;
                                }

                                // only blockquote selected
                                if (count == this.block.blocksSize)
                                {
                                    $.each(this.block.blocks, $.proxy(function(i,s)
                                    {
                                        var $formatted = false;
                                        if (this.opts.linebreaks)
                                        {
                                            $(s).prepend('<br>').append('<br>');
                                            $formatted = this.utils.replaceWithContents(s);
                                        }
                                        else
                                        {
                                            $formatted = this.utils.replaceToTag(s, 'p');
                                        }

                                        if ($formatted && typeof this.block.type == 'undefined' && typeof this.block.value == 'undefined')
                                        {
                                            $formatted.removeAttr('class').removeAttr('style');
                                        }

                                    }, this));

                                    return;
                                }

                            }


                            this.block.formatWrap(tag);
                        }
                        else
                        {
                            var classSize = 0;
                            var toggleType = false;
                            if (this.block.type == 'class')
                            {
                                toggleType = 'toggle';
                                classSize = $(this.block.blocks).filter('.' + this.block.value).length;

                                if (this.block.blocksSize == classSize) toggleType = 'toggle';
                                else if (this.block.blocksSize > classSize) toggleType = 'set';
                                else if (classSize === 0) toggleType = 'set';

                            }

                            var exceptTags = ['ul', 'ol', 'li', 'td', 'th', 'dl', 'dt', 'dd'];
                            $.each(this.block.blocks, $.proxy(function(i,s)
                            {
                                if ($.inArray(s.tagName.toLowerCase(), exceptTags) != -1) return;

                                var $formatted = this.utils.replaceToTag(s, tag);

                                if (toggleType)
                                {
                                    if (toggleType == 'toggle') this.block.toggle($formatted);
                                    else if (toggleType == 'remove') this.block.remove($formatted);
                                    else if (toggleType == 'set') this.block.setForce($formatted);
                                }
                                else this.block.toggle($formatted);

                                if (tag != 'p' && tag != 'blockquote') $formatted.find('img').remove();
                                if (this.block.isRemoveInline) this.utils.removeInlineTags($formatted);
                                if (tag == 'p' || this.block.headTag) $formatted.find('p').contents().unwrap();

                                if (typeof this.block.type == 'undefined' && typeof this.block.value == 'undefined')
                                {
                                    $formatted.removeAttr('class').removeAttr('style');
                                }


                            }, this));
                        }
                    }
                },
                setForce: function($el)
                {
                    // remove style and class if the specified setting
                    if (this.block.clearStyle)
                    {
                        $el.removeAttr('class').removeAttr('style');
                    }

                    if (this.block.type == 'class')
                    {
                        $el.addClass(this.block.value);
                        return;
                    }
                    else if (this.block.type == 'attr' || this.block.type == 'data')
                    {
                        $el.attr(this.block.value.name, this.block.value.value);
                        return;
                    }
                },
                toggle: function($el)
                {
                    // remove style and class if the specified setting
                    if (this.block.clearStyle)
                    {
                        $el.removeAttr('class').removeAttr('style');
                    }

                    if (this.block.type == 'class')
                    {
                        $el.toggleClass(this.block.value);
                        return;
                    }
                    else if (this.block.type == 'attr' || this.block.type == 'data')
                    {
                        if ($el.attr(this.block.value.name) == this.block.value.value)
                        {
                            $el.removeAttr(this.block.value.name);
                        }
                        else
                        {
                            $el.attr(this.block.value.name, this.block.value.value);
                        }

                        return;
                    }
                    else
                    {
                        $el.removeAttr('style class');
                        return;
                    }
                },
                remove: function($el)
                {
                    $el.removeClass(this.block.value);
                },
                formatListToBlockquote: function()
                {
                    var block = $(this.block.blocks[0]).closest('ul, ol');

                    $(block).find('ul, ol').contents().unwrap();
                    $(block).find('li').append($('<br>')).contents().unwrap();

                    var $el = this.utils.replaceToTag(block, 'blockquote');
                    this.block.toggle($el);
                },
                formatBlockquote: function(tag)
                {
                    document.execCommand('outdent');
                    document.execCommand('formatblock', false, tag);

                    this.clean.clearUnverified();
                    this.$editor.find('p:empty').remove();

                    var formatted = this.selection.getBlock();

                    if (tag != 'p')
                    {
                        $(formatted).find('img').remove();
                    }

                    if (!this.opts.linebreaks)
                    {
                        this.block.toggle($(formatted));
                    }

                    this.$editor.find('ul, ol, tr, blockquote, p').each($.proxy(this.utils.removeEmpty, this));

                    if (this.opts.linebreaks && tag == 'p')
                    {
                        this.utils.replaceWithContents(formatted);
                    }

                },
                formatWrap: function(tag)
                {
                    if (this.block.containerTag == 'UL' || this.block.containerTag == 'OL')
                    {
                        if (tag == 'blockquote')
                        {
                            this.block.formatListToBlockquote();
                        }
                        else
                        {
                            return;
                        }
                    }

                    var formatted = this.selection.wrap(tag);
                    if (formatted === false) return;

                    var $formatted = $(formatted);

                    this.block.formatTableWrapping($formatted);

                    var $elements = $formatted.find(this.opts.blockLevelElements.join(',') + ', td, table, thead, tbody, tfoot, th, tr');

                    if ((this.opts.linebreaks && tag == 'p') || tag == 'pre' || tag == 'blockquote')
                    {
                        $elements.append('<br />');
                    }

                    $elements.contents().unwrap();

                    if (tag != 'p' && tag != 'blockquote') $formatted.find('img').remove();

                    $.each(this.block.blocks, $.proxy(this.utils.removeEmpty, this));

                    $formatted.append(this.selection.getMarker(2));

                    if (!this.opts.linebreaks)
                    {
                        this.block.toggle($formatted);
                    }

                    this.$editor.find('ul, ol, tr, blockquote, p').each($.proxy(this.utils.removeEmpty, this));
                    $formatted.find('blockquote:empty').remove();

                    if (this.block.isRemoveInline)
                    {
                        this.utils.removeInlineTags($formatted);
                    }

                    if (this.opts.linebreaks && tag == 'p')
                    {
                        this.utils.replaceWithContents($formatted);
                    }

                },
                formatTableWrapping: function($formatted)
                {
                    if ($formatted.closest('table').length === 0) return;

                    if ($formatted.closest('tr').length === 0) $formatted.wrap('<tr>');
                    if ($formatted.closest('td').length === 0 && $formatted.closest('th').length === 0)
                    {
                        $formatted.wrap('<td>');
                    }
                },
                removeData: function(name, value)
                {
                    var blocks = this.selection.getBlocks();
                    $(blocks).removeAttr('data-' + name);

                    this.code.sync();
                },
                setData: function(name, value)
                {
                    var blocks = this.selection.getBlocks();
                    $(blocks).attr('data-' + name, value);

                    this.code.sync();
                },
                toggleData: function(name, value)
                {
                    var blocks = this.selection.getBlocks();
                    $.each(blocks, function()
                    {
                        if ($(this).attr('data-' + name))
                        {
                            $(this).removeAttr('data-' + name);
                        }
                        else
                        {
                            $(this).attr('data-' + name, value);
                        }
                    });
                },
                removeAttr: function(attr, value)
                {
                    var blocks = this.selection.getBlocks();
                    $(blocks).removeAttr(attr);

                    this.code.sync();
                },
                setAttr: function(attr, value)
                {
                    var blocks = this.selection.getBlocks();
                    $(blocks).attr(attr, value);

                    this.code.sync();
                },
                toggleAttr: function(attr, value)
                {
                    var blocks = this.selection.getBlocks();
                    $.each(blocks, function()
                    {
                        if ($(this).attr(name))
                        {
                            $(this).removeAttr(name);
                        }
                        else
                        {
                            $(this).attr(name, value);
                        }
                    });
                },
                removeClass: function(className)
                {
                    var blocks = this.selection.getBlocks();
                    $(blocks).removeClass(className);

                    this.utils.removeEmptyAttr(blocks, 'class');

                    this.code.sync();
                },
                setClass: function(className)
                {
                    var blocks = this.selection.getBlocks();
                    $(blocks).addClass(className);

                    this.code.sync();
                },
                toggleClass: function(className)
                {
                    var blocks = this.selection.getBlocks();
                    $(blocks).toggleClass(className);

                    this.code.sync();
                }
            };
        },
        buffer: function()
        {
            return {
                set: function(type)
                {
                    if (typeof type == 'undefined' || type == 'undo')
                    {
                        this.buffer.setUndo();
                    }
                    else
                    {
                        this.buffer.setRedo();
                    }
                },
                setUndo: function()
                {
                    this.selection.save();
                    this.opts.buffer.push(this.$editor.html());
                    this.selection.restore();
                },
                setRedo: function()
                {
                    this.selection.save();
                    this.opts.rebuffer.push(this.$editor.html());
                    this.selection.restore();
                },
                getUndo: function()
                {
                    this.$editor.html(this.opts.buffer.pop());
                },
                getRedo: function()
                {
                    this.$editor.html(this.opts.rebuffer.pop());
                },
                add: function()
                {
                    this.opts.buffer.push(this.$editor.html());
                },
                undo: function()
                {
                    if (this.opts.buffer.length === 0) return;

                    this.buffer.set('redo');
                    this.buffer.getUndo();

                    this.selection.restore();

                    setTimeout($.proxy(this.observe.load, this), 50);
                },
                redo: function()
                {
                    if (this.opts.rebuffer.length === 0) return;

                    this.buffer.set('undo');
                    this.buffer.getRedo();

                    this.selection.restore();

                    setTimeout($.proxy(this.observe.load, this), 50);
                }
            };
        },
        build: function()
        {
            return {
                run: function()
                {
                    this.build.createContainerBox();
                    this.build.loadContent();
                    this.build.loadEditor();
                    this.build.enableEditor();
                    this.build.setCodeAndCall();
                },
                isTextarea: function()
                {
                    return (this.$element[0].tagName === 'TEXTAREA');
                },
                createContainerBox: function()
                {
                    this.$box = $('<div class="redactor-box" />');
                },
                createTextarea: function()
                {
                    this.$textarea = $('<textarea />').attr('name', this.build.getTextareaName());
                },
                getTextareaName: function()
                {
                    return ((typeof(name) == 'undefined')) ? 'content-' + this.uuid : this.$element.attr('id');
                },
                loadContent: function()
                {
                    var func = (this.build.isTextarea()) ? 'val' : 'html';
                    this.content = $.trim(this.$element[func]());
                },
                enableEditor: function()
                {
                    this.$editor.attr({ 'contenteditable': true, 'dir': this.opts.direction });
                },
                loadEditor: function()
                {
                    var func = (this.build.isTextarea()) ? 'fromTextarea' : 'fromElement';
                    this.build[func]();
                },
                fromTextarea: function()
                {
                    this.$editor = $('<div />');
                    this.$textarea = this.$element;
                    this.$box.insertAfter(this.$element).append(this.$editor).append(this.$element);
                    this.$editor.addClass('redactor-editor');

                    this.$element.hide();
                },
                fromElement: function()
                {
                    this.$editor = this.$element;
                    this.build.createTextarea();
                    this.$box.insertAfter(this.$editor).append(this.$editor).append(this.$textarea);
                    this.$editor.addClass('redactor-editor');

                    this.$textarea.hide();
                },
                setCodeAndCall: function()
                {
                    // set code
                    this.code.set(this.content);

                    this.build.setOptions();
                    this.build.callEditor();

                    // code mode
                    if (this.opts.visual) return;
                    setTimeout($.proxy(this.code.showCode, this), 200);
                },
                callEditor: function()
                {
                    this.build.disableMozillaEditing();
                    this.build.setEvents();
                    this.build.setHelpers();

                    // load toolbar
                    if (this.opts.toolbar)
                    {
                        this.opts.toolbar = this.toolbar.init();
                        this.toolbar.build();
                    }

                    // modal templates init
                    this.modal.loadTemplates();

                    // plugins
                    this.build.plugins();

                    // observers
                    setTimeout($.proxy(this.observe.load, this), 4);

                    // init callback
                    this.core.setCallback('init');
                },
                setOptions: function()
                {
                    // textarea direction
                    $(this.$textarea).attr('dir', this.opts.direction);

                    if (this.opts.linebreaks) this.$editor.addClass('redactor-linebreaks');

                    if (this.opts.tabindex) this.$editor.attr('tabindex', this.opts.tabindex);

                    if (this.opts.minHeight) this.$editor.css('minHeight', this.opts.minHeight);
                    if (this.opts.maxHeight) this.$editor.css('maxHeight', this.opts.maxHeight);

                },
                setEventDropUpload: function(e)
                {
                    e.preventDefault();

                    if (!this.opts.dragImageUpload || !this.opts.dragFileUpload) return;

                    var files = e.dataTransfer.files;
                    this.upload.directUpload(files[0], e);
                },
                setEventDrop: function(e)
                {
                    this.code.sync();
                    setTimeout(this.clean.clearUnverified, 1);
                    this.core.setCallback('drop', e);
                },
                setEvents: function()
                {
                    // drop
                    this.$editor.on('drop.redactor', $.proxy(function(e)
                    {
                        e = e.originalEvent || e;

                        if (window.FormData === undefined || !e.dataTransfer) return true;

                        if (e.dataTransfer.files.length === 0)
                        {
                            return this.build.setEventDrop(e);
                        }
                        else
                        {
                            this.build.setEventDropUpload(e);
                        }

                        setTimeout(this.clean.clearUnverified, 1);
                        this.core.setCallback('drop', e);

                    }, this));


                    // click
                    this.$editor.on('click.redactor', $.proxy(function(e)
                    {
                        var event = this.core.getEvent();
                        var type = (event == 'click' || event == 'arrow') ? false : 'click';

                        this.core.addEvent(type);
                        this.utils.disableSelectAll();
                        this.core.setCallback('click', e);

                    }, this));

                    // paste
                    this.$editor.on('paste.redactor', $.proxy(this.paste.init, this));

                    // keydown
                    this.$editor.on('keydown.redactor', $.proxy(this.keydown.init, this));

                    // keyup
                    this.$editor.on('keyup.redactor', $.proxy(this.keyup.init, this));

                    // textarea keydown
                    if ($.isFunction(this.opts.codeKeydownCallback))
                    {
                        this.$textarea.on('keydown.redactor-textarea', $.proxy(this.opts.codeKeydownCallback, this));
                    }

                    // textarea keyup
                    if ($.isFunction(this.opts.codeKeyupCallback))
                    {
                        this.$textarea.on('keyup.redactor-textarea', $.proxy(this.opts.codeKeyupCallback, this));
                    }

                    // focus
                    if ($.isFunction(this.opts.focusCallback))
                    {
                        this.$editor.on('focus.redactor', $.proxy(this.opts.focusCallback, this));
                    }

                    var clickedElement;
                    $(document).on('mousedown', function(e) { clickedElement = e.target; });

                    // blur
                    this.$editor.on('blur.redactor', $.proxy(function(e)
                    {
                        if (this.rtePaste) return;
                        if (!this.build.isBlured(clickedElement)) return;

                        this.utils.disableSelectAll();
                        if ($.isFunction(this.opts.blurCallback)) this.core.setCallback('blur', e);

                    }, this));
                },
                isBlured: function(clickedElement)
                {
                    var $el = $(clickedElement);

                    return (!$el.hasClass('redactor-toolbar, redactor-dropdown') && !$el.is('#redactor-modal') && $el.parents('.redactor-toolbar, .redactor-dropdown, #redactor-modal').length === 0);
                },
                setHelpers: function()
                {
                    // autosave
                    this.autosave.enable();

                    // placeholder
                    this.placeholder.enable();

                    // focus
                    if (this.opts.focus) setTimeout(this.focus.setStart, 100);
                    if (this.opts.focusEnd) setTimeout(this.focus.setEnd, 100);

                },
                plugins: function()
                {
                    if (!this.opts.plugins) return;
                    if (!RedactorPlugins) return;

                    $.each(this.opts.plugins, $.proxy(function(i, s)
                    {
                        if (typeof RedactorPlugins[s] === 'undefined') return;

                        if ($.inArray(s, $.Redactor.modules) !== -1)
                        {
                            $.error('Plugin name "' + s + '" matches the name of the Redactor\'s module.');
                            return;
                        }

                        if (!$.isFunction(RedactorPlugins[s])) return;

                        this[s] = RedactorPlugins[s]();

                        // get methods
                        var methods = this.getModuleMethods(this[s]);
                        var len = methods.length;

                        // bind methods
                        for (var z = 0; z < len; z++)
                        {
                            this[s][methods[z]] = this[s][methods[z]].bind(this);
                        }

                        if ($.isFunction(this[s].init)) this[s].init();


                    }, this));

                },
                disableMozillaEditing: function()
                {
                    if (!this.utils.browser('mozilla')) return;

                    // FF fix
                    try {
                        document.execCommand('enableObjectResizing', false, false);
                        document.execCommand('enableInlineTableEditing', false, false);
                    } catch (e) {}
                }
            };
        },
        button: function()
        {
            return {
                build: function(btnName, btnObject)
                {
                    var $button = $('<a href="#" class="re-icon re-' + btnName + '" rel="' + btnName + '" />').attr('tabindex', '-1');

                    // click
                    if (btnObject.func || btnObject.command || btnObject.dropdown)
                    {
                        this.button.setEvent($button, btnName, btnObject);
                    }

                    // dropdown
                    if (btnObject.dropdown)
                    {
                        var $dropdown = $('<div class="redactor-dropdown redactor-dropdown-' +  + this.uuid + ' redactor-dropdown-box-' + btnName + '" style="display: none;">');
                        $button.data('dropdown', $dropdown);
                        this.dropdown.build(btnName, $dropdown, btnObject.dropdown);
                    }

                    // tooltip
                    if (this.utils.isDesktop())
                    {
                        this.button.createTooltip($button, btnName, btnObject.title);
                    }

                    return $button;
                },
                setEvent: function($button, btnName, btnObject)
                {
                    $button.on('touchstart click', $.proxy(function(e)
                    {
                        if ($button.hasClass('redactor-button-disabled')) return false;

                        var type = 'func';
                        var callback = btnObject.func;

                        if (btnObject.command)
                        {
                            type = 'command';
                            callback = btnObject.command;
                        }
                        else if (btnObject.dropdown)
                        {
                            type = 'dropdown';
                            callback = false;
                        }

                        this.button.onClick(e, btnName, type, callback);

                    }, this));
                },
                createTooltip: function($button, name, title)
                {
                    var $tooltip = $('<span>').addClass('redactor-toolbar-tooltip redactor-toolbar-tooltip-' + name).hide().html(title);
                    $tooltip.appendTo('body');

                    $button.on('mouseover', function()
                    {
                        if ($(this).hasClass('redactor-button-disabled')) return;

                        var pos = $button.offset();

                        $tooltip.show();
                        $tooltip.css({
                            top: (pos.top + $button.innerHeight()) + 'px',
                            left: (pos.left + $button.innerWidth()/2 - $tooltip.innerWidth()/2) + 'px'
                        });
                    });

                    $button.on('mouseout', function()
                    {
                        $tooltip.hide();
                    });

                },
                onClick: function(e, btnName, type, callback)
                {
                    this.button.caretOffset = this.caret.getOffset();

                    e.preventDefault();

                    if (this.utils.browser('msie')) e.returnValue = false;

                    if (type == 'command') this.inline.format(callback);
                    else if (type == 'dropdown') this.dropdown.show(e, btnName);
                    else this.button.onClickCallback(e, callback, btnName);
                },
                onClickCallback: function(e, callback, btnName)
                {
                    var func;

                    if ($.isFunction(callback)) callback.call(this, btnName);
                    else if (callback.search(/\./) != '-1')
                    {
                        func = callback.split('.');
                        if (typeof this[func[0]] == 'undefined') return;

                        this[func[0]][func[1]](btnName);
                    }
                    else this[callback](btnName);

                    this.observe.buttons(e, btnName);
                },
                get: function(key)
                {
                    return this.$toolbar.find('a.re-' + key);
                },
                setActive: function(key)
                {
                    this.button.get(key).addClass('redactor-act');
                },
                setInactive: function(key)
                {
                    this.button.get(key).removeClass('redactor-act');
                },
                setInactiveAll: function(key)
                {
                    if (typeof key === 'undefined')
                    {
                        this.$toolbar.find('a.re-icon').removeClass('redactor-act');
                    }
                    else
                    {
                        this.$toolbar.find('a.re-icon').not('.re-' + key).removeClass('redactor-act');
                    }
                },
                setActiveInVisual: function()
                {
                    this.$toolbar.find('a.re-icon').not('a.re-html').removeClass('redactor-button-disabled');
                },
                setInactiveInCode: function()
                {
                    this.$toolbar.find('a.re-icon').not('a.re-html').addClass('redactor-button-disabled');
                },
                changeIcon: function(key, classname)
                {
                    this.button.get(key).addClass('re-' + classname);
                },
                removeIcon: function(key, classname)
                {
                    this.button.get(key).removeClass('re-' + classname);
                },
                setAwesome: function(key, name)
                {
                    var $button = this.button.get(key);
                    $button.removeClass('redactor-btn-image').addClass('fa-redactor-btn');
                    $button.html('<i class="fa ' + name + '"></i>');
                },
                addCallback: function($btn, callback)
                {
                    var type = (callback == 'dropdown') ? 'dropdown' : 'func';
                    var key = $btn.attr('rel');
                    $btn.on('touchstart click', $.proxy(function(e)
                    {
                        if ($btn.hasClass('redactor-button-disabled')) return false;
                        this.button.onClick(e, key, type, callback);

                    }, this));
                },
                addDropdown: function($btn, dropdown)
                {
                    var key = $btn.attr('rel');
                    this.button.addCallback($btn, 'dropdown');

                    var $dropdown = $('<div class="redactor-dropdown redactor-dropdown-' +  + this.uuid + ' redactor-dropdown-box-' + key + '" style="display: none;">');
                    $btn.data('dropdown', $dropdown);

                    // build dropdown
                    if (dropdown) this.dropdown.build(key, $dropdown, dropdown);

                    return $dropdown;
                },
                add: function(key, title)
                {
                    if (!this.opts.toolbar) return;

                    var btn = this.button.build(key, { title: title });
                    btn.addClass('redactor-btn-image');

                    this.$toolbar.append($('<li>').append(btn));

                    return btn;
                },
                addFirst: function(key, title)
                {
                    if (!this.opts.toolbar) return;

                    var btn = this.button.build(key, { title: title });
                    btn.addClass('redactor-btn-image');
                    this.$toolbar.prepend($('<li>').append(btn));

                    return btn;
                },
                addAfter: function(afterkey, key, title)
                {
                    if (!this.opts.toolbar) return;

                    var btn = this.button.build(key, { title: title });
                    btn.addClass('redactor-btn-image');
                    var $btn = this.button.get(afterkey);

                    if ($btn.length !== 0) $btn.parent().after($('<li>').append(btn));
                    else this.$toolbar.append($('<li>').append(btn));

                    return btn;
                },
                addBefore: function(beforekey, key, title)
                {
                    if (!this.opts.toolbar) return;

                    var btn = this.button.build(key, { title: title });
                    btn.addClass('redactor-btn-image');
                    var $btn = this.button.get(beforekey);

                    if ($btn.length !== 0) $btn.parent().before($('<li>').append(btn));
                    else this.$toolbar.append($('<li>').append(btn));

                    return btn;
                },
                remove: function(key)
                {
                    this.button.get(key).remove();
                }
            };
        },
        caret: function()
        {
            return {
                setStart: function(node)
                {
                    // inline tag
                    if (!this.utils.isBlock(node))
                    {
                        var space = this.utils.createSpaceElement();

                        $(node).prepend(space);
                        this.caret.setEnd(space);
                    }
                    else
                    {
                        this.caret.set(node, 0, node, 0);
                    }
                },
                setEnd: function(node)
                {
                    this.caret.set(node, 1, node, 1);
                },
                set: function(orgn, orgo, focn, foco)
                {
                    // focus
                    // disabled in 10.0.7
                    // if (!this.utils.browser('msie')) this.$editor.focus();

                    orgn = orgn[0] || orgn;
                    focn = focn[0] || focn;

                    if (this.utils.isBlockTag(orgn.tagName) && orgn.innerHTML === '')
                    {
                        orgn.innerHTML = this.opts.invisibleSpace;
                    }

                    if (orgn.tagName == 'BR' && this.opts.linebreaks === false)
                    {
                        var parent = $(this.opts.emptyHtml)[0];
                        $(orgn).replaceWith(parent);
                        orgn = parent;
                        focn = orgn;
                    }

                    this.selection.get();

                    try
                    {
                        this.range.setStart(orgn, orgo);
                        this.range.setEnd(focn, foco);
                    }
                    catch (e) {}

                    this.selection.addRange();
                },
                setAfter: function(node)
                {
                    try
                    {
                        var tag = $(node)[0].tagName;

                        // inline tag
                        if (tag != 'BR' && !this.utils.isBlock(node))
                        {
                            var space = this.utils.createSpaceElement();

                            $(node).after(space);
                            this.caret.setEnd(space);
                        }
                        else
                        {
                            if (tag != 'BR' && this.utils.browser('msie'))
                            {
                                this.caret.setStart($(node).next());
                            }
                            else
                            {
                                this.caret.setAfterOrBefore(node, 'after');
                            }
                        }
                    }
                    catch (e)
                    {
                        var space = this.utils.createSpaceElement();
                        $(node).after(space);
                        this.caret.setEnd(space);
                    }
                },
                setBefore: function(node)
                {
                    // block tag
                    if (this.utils.isBlock(node))
                    {
                        this.caret.setEnd($(node).prev());
                    }
                    else
                    {
                        this.caret.setAfterOrBefore(node, 'before');
                    }
                },
                setAfterOrBefore: function(node, type)
                {
                    // focus
                    if (!this.utils.browser('msie')) this.$editor.focus();

                    node = node[0] || node;

                    this.selection.get();

                    if (type == 'after')
                    {
                        try {

                            this.range.setStartAfter(node);
                            this.range.setEndAfter(node);
                        }
                        catch (e) {}
                    }
                    else
                    {
                        try {
                            this.range.setStartBefore(node);
                            this.range.setEndBefore(node);
                        }
                        catch (e) {}
                    }


                    this.range.collapse(false);
                    this.selection.addRange();
                },
                getOffsetOfElement: function(node)
                {
                    node = node[0] || node;

                    this.selection.get();

                    var cloned = this.range.cloneRange();
                    cloned.selectNodeContents(node);
                    cloned.setEnd(this.range.endContainer, this.range.endOffset);

                    return $.trim(cloned.toString()).length;
                },
                getOffset: function()
                {
                    var offset = 0;
                    var sel = window.getSelection();

                    if (sel.rangeCount > 0)
                    {
                        var range = window.getSelection().getRangeAt(0);
                        var caretRange = range.cloneRange();
                        caretRange.selectNodeContents(this.$editor[0]);
                        caretRange.setEnd(range.endContainer, range.endOffset);
                        offset = caretRange.toString().length;
                    }

                    return offset;
                },
                setOffset: function(start, end)
                {
                    if (typeof end == 'undefined') end = start;
                    if (!this.focus.isFocused()) this.focus.setStart();

                    var sel = this.selection.get();
                    var node, offset = 0;
                    var walker = document.createTreeWalker(this.$editor[0], NodeFilter.SHOW_TEXT, null, null);

                    while (node = walker.nextNode())
                    {
                        offset += node.nodeValue.length;
                        if (offset > start)
                        {
                            this.range.setStart(node, node.nodeValue.length + start - offset);
                            start = Infinity;
                        }

                        if (offset >= end)
                        {
                            this.range.setEnd(node, node.nodeValue.length + end - offset);
                            break;
                        }
                    }

                    this.range.collapse(false);
                    this.selection.addRange();
                },
                // deprecated
                setToPoint: function(start, end)
                {
                    this.caret.setOffset(start, end);
                },
                getCoords: function()
                {
                    return this.caret.getOffset();
                }
            };
        },
        clean: function()
        {
            return {
                onSet: function(html)
                {
                    html = this.clean.savePreCode(html);

                    // convert script tag
                    html = html.replace(/<script(.*?[^>]?)>([\w\W]*?)<\/script>/gi, '<pre class="redactor-script-tag" style="display: none;" $1>$2</pre>');

                    // replace dollar sign to entity
                    html = html.replace(/\$/g, '&#36;');

                    // replace special characters in links
                    html = html.replace(/<a href="(.*?[^>]?)®(.*?[^>]?)">/gi, '<a href="$1&reg$2">');

                    if (this.opts.replaceDivs) html = this.clean.replaceDivs(html);
                    if (this.opts.linebreaks)  html = this.clean.replaceParagraphsToBr(html);

                    // save form tag
                    html = this.clean.saveFormTags(html);

                    // convert font tag to span
                    var $div = $('<div>');
                    $div.html(html);
                    var fonts = $div.find('font[style]');
                    if (fonts.length !== 0)
                    {
                        fonts.replaceWith(function()
                        {
                            var $el = $(this);
                            var $span = $('<span>').attr('style', $el.attr('style'));
                            return $span.append($el.contents());
                        });

                        html = $div.html();
                    }
                    $div.remove();

                    // remove font tag
                    html = html.replace(/<font(.*?[^<])>/gi, '');
                    html = html.replace(/<\/font>/gi, '');

                    // tidy html
                    html = this.tidy.load(html);

                    // paragraphize
                    if (this.opts.paragraphize) html = this.paragraphize.load(html);

                    // verified
                    html = this.clean.setVerified(html);

                    // convert inline tags
                    html = this.clean.convertInline(html);

                    return html;
                },
                onSync: function(html)
                {
                    // remove spaces
                    html = html.replace(/[\u200B-\u200D\uFEFF]/g, '');
                    html = html.replace(/&#x200b;/gi, '');

                    if (this.opts.cleanSpaces)
                    {
                        html = html.replace(/&nbsp;/gi, ' ');
                    }

                    if (html.search(/^<p>(||\s||<br\s?\/?>||&nbsp;)<\/p>$/i) != -1)
                    {
                        return '';
                    }

                    // reconvert script tag
                    html = html.replace(/<pre class="redactor-script-tag" style="display: none;"(.*?[^>]?)>([\w\W]*?)<\/pre>/gi, '<script$1>$2</script>');

                    // restore form tag
                    html = this.clean.restoreFormTags(html);

                    var chars = {
                        '\u2122': '&trade;',
                        '\u00a9': '&copy;',
                        '\u2026': '&hellip;',
                        '\u2014': '&mdash;',
                        '\u2010': '&dash;'
                    };
                    // replace special characters
                    $.each(chars, function(i,s)
                    {
                        html = html.replace(new RegExp(i, 'g'), s);
                    });

                    // remove br in the of li
                    html = html.replace(new RegExp('<br\\s?/?></li>', 'gi'), '</li>');
                    html = html.replace(new RegExp('</li><br\\s?/?>', 'gi'), '</li>');
                    // remove verified
                    html = html.replace(new RegExp('<div(.*?[^>]) data-tagblock="redactor"(.*?[^>])>', 'gi'), '<div$1$2>');
                    html = html.replace(new RegExp('<(.*?) data-verified="redactor"(.*?[^>])>', 'gi'), '<$1$2>');
                    html = html.replace(new RegExp('<span(.*?[^>])\srel="(.*?[^>])"(.*?[^>])>', 'gi'), '<span$1$3>');
                    html = html.replace(new RegExp('<img(.*?[^>])\srel="(.*?[^>])"(.*?[^>])>', 'gi'), '<img$1$3>');
                    html = html.replace(new RegExp('<img(.*?[^>])\sstyle="" (.*?[^>])>', 'gi'), '<img$1 $2>');
                    html = html.replace(new RegExp('<img(.*?[^>])\sstyle (.*?[^>])>', 'gi'), '<img$1 $2>');
                    html = html.replace(new RegExp('<span class="redactor-invisible-space">(.*?)</span>', 'gi'), '$1');
                    html = html.replace(/ data-save-url="(.*?[^>])"/gi, '');

                    // remove image resize
                    html = html.replace(/<span(.*?)id="redactor-image-box"(.*?[^>])>([\w\W]*?)<img(.*?)><\/span>/gi, '$3<img$4>');
                    html = html.replace(/<span(.*?)id="redactor-image-resizer"(.*?[^>])>(.*?)<\/span>/gi, '');
                    html = html.replace(/<span(.*?)id="redactor-image-editter"(.*?[^>])>(.*?)<\/span>/gi, '');

                    // remove font tag
                    html = html.replace(/<font(.*?[^<])>/gi, '');
                    html = html.replace(/<\/font>/gi, '');

                    // tidy html
                    html = this.tidy.load(html);

                    // link nofollow
                    if (this.opts.linkNofollow)
                    {
                        html = html.replace(/<a(.*?)rel="nofollow"(.*?[^>])>/gi, '<a$1$2>');
                        html = html.replace(/<a(.*?[^>])>/gi, '<a$1 rel="nofollow">');
                    }

                    // reconvert inline
                    html = html.replace(/\sdata-redactor-(tag|class|style)="(.*?[^>])"/gi, '');
                    html = html.replace(new RegExp('<(.*?) data-verified="redactor"(.*?[^>])>', 'gi'), '<$1$2>');
                    html = html.replace(new RegExp('<(.*?) data-verified="redactor">', 'gi'), '<$1>');

                    return html;
                },
                onPaste: function(html, setMode)
                {
                    html = $.trim(html);

                    html = html.replace(/\$/g, '&#36;');

                    // convert dirty spaces
                    html = html.replace(/<span class="s1">/gi, '<span>');
                    html = html.replace(/<span class="Apple-converted-space">&nbsp;<\/span>/gi, ' ');
                    html = html.replace(/<span class="Apple-tab-span"[^>]*>\t<\/span>/gi, '\t');
                    html = html.replace(/<span[^>]*>(\s|&nbsp;)<\/span>/gi, ' ');

                    if (this.opts.pastePlainText)
                    {
                        return this.clean.getPlainText(html);
                    }

                    if (!this.utils.isSelectAll() && typeof setMode == 'undefined')
                    {
                        if (this.utils.isCurrentOrParent(['FIGCAPTION', 'A']))
                        {
                            return this.clean.getPlainText(html, false);
                        }

                        if (this.utils.isCurrentOrParent('PRE'))
                        {
                            html = html.replace(/”/g, '"');
                            html = html.replace(/“/g, '"');
                            html = html.replace(/‘/g, '\'');
                            html = html.replace(/’/g, '\'');

                            return this.clean.getPreCode(html);
                        }

                        if (this.utils.isCurrentOrParent(['BLOCKQUOTE', 'H1', 'H2', 'H3', 'H4', 'H5', 'H6']))
                        {
                            html = this.clean.getOnlyImages(html);

                            if (!this.utils.browser('msie'))
                            {
                                var block = this.selection.getBlock();
                                if (block && block.tagName == 'P')
                                {
                                    html = html.replace(/<img(.*?)>/gi, '<p><img$1></p>');
                                }
                            }

                            return html;
                        }

                        if (this.utils.isCurrentOrParent(['TD']))
                        {
                            html = this.clean.onPasteTidy(html, 'td');

                            if (this.opts.linebreaks) html = this.clean.replaceParagraphsToBr(html);

                            html = this.clean.replaceDivsToBr(html);

                            return html;
                        }


                        if (this.utils.isCurrentOrParent(['LI']))
                        {
                            return this.clean.onPasteTidy(html, 'li');
                        }
                    }


                    html = this.clean.isSingleLine(html, setMode);

                    if (!this.clean.singleLine)
                    {
                        if (this.opts.linebreaks)  html = this.clean.replaceParagraphsToBr(html);
                        if (this.opts.replaceDivs) html = this.clean.replaceDivs(html);

                        html = this.clean.saveFormTags(html);
                    }


                    html = this.clean.onPasteWord(html);
                    html = this.clean.onPasteExtra(html);

                    html = this.clean.onPasteTidy(html, 'all');


                    // paragraphize
                    if (!this.clean.singleLine && this.opts.paragraphize)
                    {
                        html = this.paragraphize.load(html);
                    }

                    html = this.clean.removeDirtyStyles(html);
                    html = this.clean.onPasteRemoveSpans(html);
                    html = this.clean.onPasteRemoveEmpty(html);


                    html = this.clean.convertInline(html);

                    return html;
                },
                onPasteWord: function(html)
                {
                    // comments
                    html = html.replace(/<!--[\s\S]*?-->/gi, '');

                    // style
                    html = html.replace(/<style[^>]*>[\s\S]*?<\/style>/gi, '');

                    if (/(class=\"?Mso|style=\"[^\"]*\bmso\-|w:WordDocument)/.test(html))
                    {
                        html = this.clean.onPasteIeFixLinks(html);

                        // shapes
                        html = html.replace(/<img(.*?)v:shapes=(.*?)>/gi, '');
                        html = html.replace(/src="file\:\/\/(.*?)"/, 'src=""');

                        // list
                        html = html.replace(/<p(.*?)class="MsoListParagraphCxSpFirst"([\w\W]*?)<\/p>/gi, '<ul><li$2</li>');
                        html = html.replace(/<p(.*?)class="MsoListParagraphCxSpMiddle"([\w\W]*?)<\/p>/gi, '<li$2</li>');
                        html = html.replace(/<p(.*?)class="MsoListParagraphCxSpLast"([\w\W]*?)<\/p>/gi, '<li$2</li></ul>');
                        // one line
                        html = html.replace(/<p(.*?)class="MsoListParagraph"([\w\W]*?)<\/p>/gi, '<ul><li$2</li></ul>');
                        // remove ms word's bullet
                        html = html.replace(/·/g, '');
                        html = html.replace(/<p class="Mso(.*?)"/gi, '<p');

                        // classes
                        html = html.replace(/ class=\"(mso[^\"]*)\"/gi, "");
                        html = html.replace(/ class=(mso\w+)/gi, "");

                        // remove ms word tags
                        html = html.replace(/<o:p(.*?)>([\w\W]*?)<\/o:p>/gi, '$2');

                        // ms word break lines
                        html = html.replace(/\n/g, ' ');

                        // ms word lists break lines
                        html = html.replace(/<p>\n?<li>/gi, '<li>');
                    }

                    // remove nbsp
                    if (this.opts.cleanSpaces)
                    {
                        html = html.replace(/(\s|&nbsp;)+/g, ' ');
                    }

                    return html;
                },
                onPasteExtra: function(html)
                {
                    // remove google docs markers
                    html = html.replace(/<b\sid="internal-source-marker(.*?)">([\w\W]*?)<\/b>/gi, "$2");
                    html = html.replace(/<b(.*?)id="docs-internal-guid(.*?)">([\w\W]*?)<\/b>/gi, "$3");

                    // google docs styles
                    html = html.replace(/<span[^>]*(font-style: italic; font-weight: bold|font-weight: bold; font-style: italic)[^>]*>/gi, '<span style="font-weight: bold;"><span style="font-style: italic;">');
                    html = html.replace(/<span[^>]*font-style: italic[^>]*>/gi, '<span style="font-style: italic;">');
                    html = html.replace(/<span[^>]*font-weight: bold[^>]*>/gi, '<span style="font-weight: bold;">');
                    html = html.replace(/<span[^>]*text-decoration: underline[^>]*>/gi, '<span style="text-decoration: underline;">');

                    html = html.replace(/<img>/gi, '');
                    html = html.replace(/\n{3,}/gi, '\n');
                    html = html.replace(/<font(.*?)>([\w\W]*?)<\/font>/gi, '$2');

                    // remove dirty p
                    html = html.replace(/<p><p>/gi, '<p>');
                    html = html.replace(/<\/p><\/p>/gi, '</p>');
                    html = html.replace(/<li>(\s*|\t*|\n*)<p>/gi, '<li>');
                    html = html.replace(/<\/p>(\s*|\t*|\n*)<\/li>/gi, '</li>');

                    // remove space between paragraphs
                    html = html.replace(/<\/p>\s<p/gi, '<\/p><p');

                    // remove safari local images
                    html = html.replace(/<img src="webkit-fake-url\:\/\/(.*?)"(.*?)>/gi, '');

                    // bullets
                    html = html.replace(/<p>•([\w\W]*?)<\/p>/gi, '<li>$1</li>');

                    // FF fix
                    if (this.utils.browser('mozilla'))
                    {
                        html = html.replace(/<br\s?\/?>$/gi, '');
                    }

                    return html;
                },
                onPasteTidy: function(html, type)
                {
                    // remove all tags except these
                    var tags = ['span', 'a', 'pre', 'blockquote', 'small', 'em', 'strong', 'code', 'kbd', 'mark', 'address', 'cite', 'var', 'samp', 'dfn', 'sup', 'sub', 'b', 'i', 'u', 'del',
                                'ol', 'ul', 'li', 'dl', 'dt', 'dd', 'p', 'br', 'video', 'audio', 'iframe', 'embed', 'param', 'object', 'img', 'table',
                                'td', 'th', 'tr', 'tbody', 'tfoot', 'thead', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'sup', 'sub'];
                    var tagsEmpty = false;
                    var attrAllowed =  [
                            ['a', '*'],
                            ['img', ['src', 'alt']],
                            ['span', ['class', 'rel', 'data-verified']],
                            ['iframe', '*'],
                            ['video', '*'],
                            ['audio', '*'],
                            ['embed', '*'],
                            ['object', '*'],
                            ['param', '*'],
                            ['source', '*']
                        ];

                    if (type == 'all')
                    {
                        tagsEmpty = ['p', 'span', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'];
                        attrAllowed =  [
                            ['table', 'class'],
                            ['td', ['colspan', 'rowspan']],
                            ['a', '*'],
                            ['img', ['src', 'alt', 'data-redactor-inserted-image']],
                            ['span', ['class', 'rel', 'data-verified']],
                            ['iframe', '*'],
                            ['video', '*'],
                            ['audio', '*'],
                            ['embed', '*'],
                            ['object', '*'],
                            ['param', '*'],
                            ['source', '*']
                        ];
                    }
                    else if (type == 'td')
                    {
                        // remove all tags except these and remove all table tags: tr, td etc
                        tags = ['ul', 'ol', 'li', 'span', 'a', 'small', 'em', 'strong', 'code', 'kbd', 'mark', 'cite', 'var', 'samp', 'dfn', 'sup', 'sub', 'b', 'i', 'u', 'del',
                                'ol', 'ul', 'li', 'dl', 'dt', 'dd', 'br', 'iframe', 'video', 'audio', 'embed', 'param', 'object', 'img', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'];

                    }
                    else if (type == 'li')
                    {
                        // only inline tags and ul, ol, li
                        tags = ['ul', 'ol', 'li', 'span', 'a', 'small', 'em', 'strong', 'code', 'kbd', 'mark', 'cite', 'var', 'samp', 'dfn', 'sup', 'sub', 'b', 'i', 'u', 'del', 'br',
                                'iframe', 'video', 'audio', 'embed', 'param', 'object', 'img'];
                    }

                    var options = {
                        deniedTags: false,
                        allowedTags: tags,
                        removeComments: true,
                        removePhp: true,
                        removeAttr: false,
                        allowedAttr: attrAllowed,
                        removeEmpty: tagsEmpty
                    };

                    // denied tags
                    if (this.opts.deniedTags)
                    {
                        options.deniedTags = this.opts.deniedTags;
                    }

                    // allowed tags
                    if (this.opts.allowedTags)
                    {
                        options.allowedTags = this.opts.allowedTags;
                    }

                    return this.tidy.load(html, options);

                },
                onPasteRemoveEmpty: function(html)
                {
                    html = html.replace(/<(p|h[1-6])>(|\s|\n|\t|<br\s?\/?>)<\/(p|h[1-6])>/gi, '');

                    // remove br in the end
                    if (!this.opts.linebreaks) html = html.replace(/<br>$/i, '');

                    return html;
                },
                onPasteRemoveSpans: function(html)
                {
                    html = html.replace(/<span>(.*?)<\/span>/gi, '$1');
                    html = html.replace(/<span[^>]*>\s|&nbsp;<\/span>/gi, ' ');

                    return html;
                },
                onPasteIeFixLinks: function(html)
                {
                    if (!this.utils.browser('msie')) return html;

                    var tmp = $.trim(html);
                    if (tmp.search(/^<a(.*?)>(.*?)<\/a>$/i) === 0)
                    {
                        html = html.replace(/^<a(.*?)>(.*?)<\/a>$/i, "$2");
                    }

                    return html;
                },
                isSingleLine: function(html, setMode)
                {
                    this.clean.singleLine = false;

                    if (!this.utils.isSelectAll() && typeof setMode == 'undefined')
                    {
                        var blocks = this.opts.blockLevelElements.join('|').replace('P|', '').replace('DIV|', '');

                        var matchBlocks = html.match(new RegExp('</(' + blocks + ')>', 'gi'));
                        var matchContainers = html.match(/<\/(p|div)>/gi);

                        if (!matchBlocks && (matchContainers === null || (matchContainers && matchContainers.length <= 1)))
                        {
                            var matchBR = html.match(/<br\s?\/?>/gi);
                            var matchIMG = html.match(/<img(.*?[^>])>/gi);
                            if (!matchBR && !matchIMG)
                            {
                                this.clean.singleLine = true;
                                html = html.replace(/<\/?(p|div)(.*?)>/gi, '');
                            }
                        }
                    }

                    return html;
                },
                stripTags: function(input, allowed)
                {
                    allowed = (((allowed || '') + '').toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join('');
                    var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi;

                    return input.replace(tags, function ($0, $1) {
                        return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';
                    });
                },
                savePreCode: function(html)
                {
                    html = this.clean.savePreFormatting(html);
                    html = this.clean.saveCodeFormatting(html);

                    return html;
                },
                savePreFormatting: function(html)
                {
                    var pre = html.match(/<pre(.*?)>([\w\W]*?)<\/pre>/gi);
                    if (pre !== null)
                    {
                        $.each(pre, $.proxy(function(i,s)
                        {
                            var arr = s.match(/<pre(.*?)>([\w\W]*?)<\/pre>/i);

                            arr[2] = arr[2].replace(/<br\s?\/?>/g, '\n');
                            arr[2] = arr[2].replace(/&nbsp;/g, ' ');

                            if (this.opts.preSpaces)
                            {
                                arr[2] = arr[2].replace(/\t/g, Array(this.opts.preSpaces + 1).join(' '));
                            }

                            arr[2] = this.clean.encodeEntities(arr[2]);

                            // $ fix
                            arr[2] = arr[2].replace(/\$/g, '&#36;');

                            html = html.replace(s, '<pre' + arr[1] + '>' + arr[2] + '</pre>');

                        }, this));
                    }

                    return html;
                },
                saveCodeFormatting: function(html)
                {
                    var code = html.match(/<code(.*?[^>])>(.*?)<\/code>/gi);
                    if (code !== null)
                    {
                        $.each(code, $.proxy(function(i,s)
                        {
                            var arr = s.match(/<code(.*?[^>])>(.*?)<\/code>/i);

                            arr[2] = arr[2].replace(/&nbsp;/g, ' ');
                            arr[2] = this.clean.encodeEntities(arr[2]);

                            // $ fix
                            arr[2] = arr[2].replace(/\$/g, '&#36;');

                            html = html.replace(s, '<code' + arr[1] + '>' + arr[2] + '</code>');

                        }, this));
                    }

                    return html;
                },
                getTextFromHtml: function(html)
                {
                    html = html.replace(/<br\s?\/?>|<\/H[1-6]>|<\/p>|<\/div>|<\/li>|<\/td>/gi, '\n');

                    var tmp = document.createElement('div');
                    tmp.innerHTML = html;
                    html = tmp.textContent || tmp.innerText;

                    return $.trim(html);
                },
                getPlainText: function(html, paragraphize)
                {
                    html = this.clean.getTextFromHtml(html);
                    html = html.replace(/\n/g, '<br />');

                    if (this.opts.paragraphize && typeof paragraphize == 'undefined' && !this.utils.browser('mozilla'))
                    {
                        html = this.paragraphize.load(html);
                    }

                    return html;
                },
                getPreCode: function(html)
                {
                    html = html.replace(/<img(.*?) style="(.*?)"(.*?[^>])>/gi, '<img$1$3>');
                    html = html.replace(/<img(.*?)>/gi, '&lt;img$1&gt;');
                    html = this.clean.getTextFromHtml(html);

                    if (this.opts.preSpaces)
                    {
                        html = html.replace(/\t/g, Array(this.opts.preSpaces + 1).join(' '));
                    }

                    html = this.clean.encodeEntities(html);

                    return html;
                },
                getOnlyImages: function(html)
                {
                    html = html.replace(/<img(.*?)>/gi, '[img$1]');

                    // remove all tags
                    html = html.replace(/<([Ss]*?)>/gi, '');

                    html = html.replace(/\[img(.*?)\]/gi, '<img$1>');

                    return html;
                },
                getOnlyLinksAndImages: function(html)
                {
                    html = html.replace(/<a(.*?)href="(.*?)"(.*?)>([\w\W]*?)<\/a>/gi, '[a href="$2"]$4[/a]');
                    html = html.replace(/<img(.*?)>/gi, '[img$1]');

                    // remove all tags
                    html = html.replace(/<(.*?)>/gi, '');

                    html = html.replace(/\[a href="(.*?)"\]([\w\W]*?)\[\/a\]/gi, '<a href="$1">$2</a>');
                    html = html.replace(/\[img(.*?)\]/gi, '<img$1>');

                    return html;
                },
                encodeEntities: function(str)
                {
                    str = String(str).replace(/&amp;/g, '&').replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/&quot;/g, '"');
                    return str.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
                },
                removeDirtyStyles: function(html)
                {
                    if (this.utils.browser('msie')) return html;

                    var div = document.createElement('div');
                    div.innerHTML = html;

                    this.clean.clearUnverifiedRemove($(div));

                    html = div.innerHTML;
                    $(div).remove();

                    return html;
                },
                clearUnverified: function()
                {
                    if (this.utils.browser('msie')) return;

                    this.clean.clearUnverifiedRemove(this.$editor);

                    var headers = this.$editor.find('h1, h2, h3, h4, h5, h6');
                    headers.find('span').removeAttr('style');
                    headers.find(this.opts.verifiedTags.join(', ')).removeAttr('style');

                    this.code.sync();
                },
                clearUnverifiedRemove: function($editor)
                {
                    $editor.find(this.opts.verifiedTags.join(', ')).removeAttr('style');
                    $editor.find('span').not('[data-verified="redactor"]').removeAttr('style');

                    $editor.find('span[data-verified="redactor"], img[data-verified="redactor"]').each(function(i, s)
                    {
                        var $s = $(s);
                        $s.attr('style', $s.attr('rel'));
                    });

                },
                setVerified: function(html)
                {
                    if (this.utils.browser('msie')) return html;

                    html = html.replace(new RegExp('<img(.*?[^>])>', 'gi'), '<img$1 data-verified="redactor">');
                    html = html.replace(new RegExp('<span(.*?[^>])>', 'gi'), '<span$1 data-verified="redactor">');

                    var matches = html.match(new RegExp('<(span|img)(.*?)style="(.*?)"(.*?[^>])>', 'gi'));

                    if (matches)
                    {
                        var len = matches.length;
                        for (var i = 0; i < len; i++)
                        {
                            try {

                                var newTag = matches[i].replace(/style="(.*?)"/i, 'style="$1" rel="$1"');
                                html = html.replace(matches[i], newTag);

                            }
                            catch (e) {}
                        }
                    }

                    return html;
                },
                convertInline: function(html)
                {
                    var $div = $('<div />').html(html);

                    var tags = this.opts.inlineTags;
                    tags.push('span');

                    $div.find(tags.join(',')).each(function()
                    {
                        var $el = $(this);
                        var tag = this.tagName.toLowerCase();
                        $el.attr('data-redactor-tag', tag);

                        if (tag == 'span')
                        {
                            if ($el.attr('style')) $el.attr('data-redactor-style', $el.attr('style'));
                            else if ($el.attr('class')) $el.attr('data-redactor-class', $el.attr('class'));
                        }

                    });

                    html = $div.html();
                    $div.remove();

                    return html;
                },
                normalizeLists: function()
                {
                    this.$editor.find('li').each(function(i,s)
                    {
                        var $next = $(s).next();
                        if ($next.length !== 0 && ($next[0].tagName == 'UL' || $next[0].tagName == 'OL'))
                        {
                            $(s).append($next);
                        }

                    });
                },
                removeSpaces: function(html)
                {
                    html = html.replace(/\n/g, '');
                    html = html.replace(/[\t]*/g, '');
                    html = html.replace(/\n\s*\n/g, "\n");
                    html = html.replace(/^[\s\n]*/g, ' ');
                    html = html.replace(/[\s\n]*$/g, ' ');
                    html = html.replace( />\s{2,}</g, '> <'); // between inline tags can be only one space
                    html = html.replace(/\n\n/g, "\n");
                    html = html.replace(/[\u200B-\u200D\uFEFF]/g, '');

                    return html;
                },
                replaceDivs: function(html)
                {
                    if (this.opts.linebreaks)
                    {
                        html = html.replace(/<div><br\s?\/?><\/div>/gi, '<br />');
                        html = html.replace(/<div(.*?)>([\w\W]*?)<\/div>/gi, '$2<br />');
                    }
                    else
                    {
                        html = html.replace(/<div(.*?)>([\w\W]*?)<\/div>/gi, '<p$1>$2</p>');
                    }

                    html = html.replace(/<div(.*?[^>])>/gi, '');
                    html = html.replace(/<\/div>/gi, '');

                    return html;
                },
                replaceDivsToBr: function(html)
                {
                    html = html.replace(/<div\s(.*?)>/gi, '<p>');
                    html = html.replace(/<div><br\s?\/?><\/div>/gi, '<br /><br />');
                    html = html.replace(/<div>([\w\W]*?)<\/div>/gi, '$1<br /><br />');

                    return html;
                },
                replaceParagraphsToBr: function(html)
                {
                    html = html.replace(/<p\s(.*?)>/gi, '<p>');
                    html = html.replace(/<p><br\s?\/?><\/p>/gi, '<br />');
                    html = html.replace(/<p>([\w\W]*?)<\/p>/gi, '$1<br /><br />');
                    html = html.replace(/(<br\s?\/?>){1,}\n?<\/blockquote>/gi, '</blockquote>');

                    return html;
                },
                saveFormTags: function(html)
                {
                    return html.replace(/<form(.*?)>([\w\W]*?)<\/form>/gi, '<section$1 rel="redactor-form-tag">$2</section>');
                },
                restoreFormTags: function(html)
                {
                    return html.replace(/<section(.*?) rel="redactor-form-tag"(.*?)>([\w\W]*?)<\/section>/gi, '<form$1$2>$3</form>');
                }
            };
        },
        code: function()
        {
            return {
                set: function(html)
                {
                    html = $.trim(html.toString());

                    // clean
                    html = this.clean.onSet(html);

                    this.$editor.html(html);
                    this.code.sync();

                    if (html !== '') this.placeholder.remove();

                    setTimeout($.proxy(this.buffer.add, this), 15);
                    if (this.start === false) this.observe.load();

                },
                get: function()
                {
                    var code = this.$textarea.val();

                    // indent code
                    code = this.tabifier.get(code);

                    return code;
                },
                sync: function()
                {
                    setTimeout($.proxy(this.code.startSync, this), 10);
                },
                startSync: function()
                {
                    var html = this.$editor.html();

                    // is there a need to synchronize
                    if (this.code.syncCode && this.code.syncCode == html)
                    {
                        // do not sync
                        return;
                    }

                    // save code
                    this.code.syncCode = html;

                    // before clean callback
                    html = this.core.setCallback('syncBefore', html);

                    // clean
                    html = this.clean.onSync(html);

                    // set code
                    this.$textarea.val(html);

                    // after sync callback
                    this.core.setCallback('sync', html);

                    if (this.start === false)
                    {
                        this.core.setCallback('change', html);
                    }

                    this.start = false;

                    // autosave on change
                    this.autosave.onChange();
                },
                toggle: function()
                {
                    if (this.opts.visual)
                    {
                        this.code.showCode();
                    }
                    else
                    {
                        this.code.showVisual();
                    }
                },
                showCode: function()
                {
                    this.code.offset = this.caret.getOffset();
                    var scroll = $(window).scrollTop();

                    var height = this.$editor.innerHeight();

                    this.$editor.hide();

                    var html = this.$textarea.val();
                    this.modified = this.clean.removeSpaces(html);

                    // indent code
                    html = this.tabifier.get(html);

                    this.$textarea.val(html).height(height).show().focus();
                    this.$textarea.on('keydown.redactor-textarea-indenting', this.code.textareaIndenting);

                    $(window).scrollTop(scroll);

                    if (this.$textarea[0].setSelectionRange)
                    {
                        this.$textarea[0].setSelectionRange(0, 0);
                    }

                    this.$textarea[0].scrollTop = 0;

                    this.opts.visual = false;

                    this.button.setInactiveInCode();
                    this.button.setActive('html');
                    this.core.setCallback('source', html);
                },
                showVisual: function()
                {
                    if (this.opts.visual) return;

                    var html = this.$textarea.hide().val();

                    if (this.modified !== this.clean.removeSpaces(html))
                    {
                        this.code.set(html);
                    }

                    this.$editor.show();

                    if (!this.utils.isEmpty(html))
                    {
                        this.placeholder.remove();
                    }

                    this.caret.setOffset(this.code.offset);

                    this.$textarea.off('keydown.redactor-textarea-indenting');

                    this.button.setActiveInVisual();
                    this.button.setInactive('html');

                    this.observe.load();
                    this.opts.visual = true;
                    this.core.setCallback('visual', html);
                },
                textareaIndenting: function(e)
                {
                    if (e.keyCode !== 9) return true;

                    var $el = this.$textarea;
                    var start = $el.get(0).selectionStart;
                    $el.val($el.val().substring(0, start) + "\t" + $el.val().substring($el.get(0).selectionEnd));
                    $el.get(0).selectionStart = $el.get(0).selectionEnd = start + 1;

                    return false;
                }
            };
        },
        core: function()
        {
            return {
                getObject: function()
                {
                    return $.extend({}, this);
                },
                getEditor: function()
                {
                    return this.$editor;
                },
                getBox: function()
                {
                    return this.$box;
                },
                getElement: function()
                {
                    return this.$element;
                },
                getTextarea: function()
                {
                    return this.$textarea;
                },
                getToolbar: function()
                {
                    return (this.$toolbar) ? this.$toolbar : false;
                },
                addEvent: function(name)
                {
                    this.core.event = name;
                },
                getEvent: function()
                {
                    return this.core.event;
                },
                setCallback: function(type, e, data)
                {
                    var callback = this.opts[type + 'Callback'];
                    if ($.isFunction(callback))
                    {
                        return (typeof data == 'undefined') ? callback.call(this, e) : callback.call(this, e, data);
                    }
                    else
                    {
                        return (typeof data == 'undefined') ? e : data;
                    }
                },
                destroy: function()
                {
                    this.core.setCallback('destroy');

                    // off events and remove data
                    this.$element.off('.redactor').removeData('redactor');
                    this.$editor.off('.redactor');

                    $(document).off('click.redactor-image-delete.' + this.uuid);
                    $(document).off('click.redactor-image-resize-hide.' + this.uuid);
                    $(document).off('touchstart.redactor.' + this.uuid + ' click.redactor.' + this.uuid);
                    $("body").off('scroll.redactor.' + this.uuid);
                    $(this.opts.toolbarFixedTarget).off('scroll.redactor.' + this.uuid);

                    // common
                    this.$editor.removeClass('redactor-editor redactor-linebreaks redactor-placeholder');
                    this.$editor.removeAttr('contenteditable');

                    var html = this.code.get();

                    // dropdowns off
                    this.$toolbar.find('a').each(function()
                    {
                        var $el = $(this);
                        if ($el.data('dropdown'))
                        {
                            $el.data('dropdown').remove();
                            $el.data('dropdown', {});
                        }
                    });


                    if (this.build.isTextarea())
                    {
                        this.$box.after(this.$element);
                        this.$box.remove();
                        this.$element.val(html).show();
                    }
                    else
                    {
                        this.$box.after(this.$editor);
                        this.$box.remove();
                        this.$element.html(html).show();
                    }

                    // paste box
                    if (this.$pasteBox) this.$pasteBox.remove();

                    // modal
                    if (this.$modalBox) this.$modalBox.remove();
                    if (this.$modalOverlay) this.$modalOverlay.remove();

                    // buttons tooltip
                    $('.redactor-toolbar-tooltip').remove();

                    // autosave
                    clearInterval(this.autosaveInterval);

                }
            };
        },
        dropdown: function()
        {
            return {
                build: function(name, $dropdown, dropdownObject)
                {
                    if (name == 'formatting' && this.opts.formattingAdd)
                    {
                        $.each(this.opts.formattingAdd, $.proxy(function(i,s)
                        {
                            var name = s.tag;
                            if (typeof s['class'] != 'undefined')
                            {
                                name = name + '-' + s['class'];
                            }

                            s.type = (this.utils.isBlockTag(s.tag)) ? 'block' : 'inline';
                            var func = (s.type == 'inline') ? 'inline.formatting' : 'block.formatting';

                            if (this.opts.linebreaks && s.type == 'block' && s.tag == 'p') return;

                            this.formatting[name] = {
                                tag: s.tag,
                                style: s.style,
                                'class': s['class'],
                                attr: s.attr,
                                data: s.data,
                                clear: s.clear
                            };

                            dropdownObject[name] = {
                                func: func,
                                title: s.title
                            };

                        }, this));

                    }

                    $.each(dropdownObject, $.proxy(function(btnName, btnObject)
                    {
                        var $item = $('<a href="#" class="redactor-dropdown-' + btnName + '">' + btnObject.title + '</a>');
                        if (name == 'formatting') $item.addClass('redactor-formatting-' + btnName);

                        $item.on('click', $.proxy(function(e)
                        {
                            e.preventDefault();

                            var type = 'func';
                            var callback = btnObject.func;
                            if (btnObject.command)
                            {
                                type = 'command';
                                callback = btnObject.command;
                            }
                            else if (btnObject.dropdown)
                            {
                                type = 'dropdown';
                                callback = btnObject.dropdown;
                            }

                            this.button.onClick(e, btnName, type, callback);
                            this.dropdown.hideAll();

                        }, this));

                        $dropdown.append($item);

                    }, this));
                },
                show: function(e, key)
                {
                    if (!this.opts.visual)
                    {
                        e.preventDefault();
                        return false;
                    }

                    var $button = this.button.get(key);

                    // Always re-append it to the end of <body> so it always has the highest sub-z-index.
                    var $dropdown = $button.data('dropdown').appendTo(document.body);

                    // ios keyboard hide
                    if (this.utils.isMobile() && !this.utils.browser('msie'))
                    {
                        document.activeElement.blur();
                    }

                    if ($button.hasClass('dropact'))
                    {
                        this.dropdown.hideAll();
                    }
                    else
                    {
                        this.dropdown.hideAll();
                        this.core.setCallback('dropdownShow', { dropdown: $dropdown, key: key, button: $button });

                        this.button.setActive(key);

                        $button.addClass('dropact');

                        var keyPosition = $button.offset();

                        // fix right placement
                        var dropdownWidth = $dropdown.width();
                        if ((keyPosition.left + dropdownWidth) > $(document).width())
                        {
                            keyPosition.left = Math.max(0, keyPosition.left - dropdownWidth);
                        }

                        var left = keyPosition.left + 'px';
                        if (this.$toolbar.hasClass('toolbar-fixed-box'))
                        {
                            var top = this.$toolbar.innerHeight() + this.opts.toolbarFixedTopOffset;
                            var position = 'fixed';
                            if (this.opts.toolbarFixedTarget !== document)
                            {
                                top = (this.$toolbar.innerHeight() + this.$toolbar.offset().top) + this.opts.toolbarFixedTopOffset;
                                position = 'absolute';
                            }

                            $dropdown.css({ position: position, left: left, top: top + 'px' }).show();
                        }
                        else
                        {
                            var top = ($button.innerHeight() + keyPosition.top) + 'px';

                            $dropdown.css({ position: 'absolute', left: left, top: top }).show();
                        }

                        this.core.setCallback('dropdownShown', { dropdown: $dropdown, key: key, button: $button });
                    }

                    $(document).one('click', $.proxy(this.dropdown.hide, this));
                    this.$editor.one('click', $.proxy(this.dropdown.hide, this));

                    // disable scroll whan dropdown scroll
                    var $body = $(document.body);
                    var width = $body.width();

                    $dropdown.on('mouseover', function() {

                        $body.addClass('body-redactor-hidden');
                        $body.css('margin-right', ($body.width() - width) + 'px');

                     });

                    $dropdown.on('mouseout', function() {

                        $body.removeClass('body-redactor-hidden').css('margin-right', 0);

                    });


                    e.stopPropagation();
                },
                hideAll: function()
                {
                    this.$toolbar.find('a.dropact').removeClass('redactor-act').removeClass('dropact');

                    $(document.body).removeClass('body-redactor-hidden').css('margin-right', 0);
                    $('.redactor-dropdown-' + this.uuid).hide();
                    this.core.setCallback('dropdownHide');
                },
                hide: function (e)
                {
                    var $dropdown = $(e.target);
                    if (!$dropdown.hasClass('dropact'))
                    {
                        $dropdown.removeClass('dropact');
                        this.dropdown.hideAll();
                    }
                }
            };
        },
        file: function()
        {
            return {
                show: function()
                {
                    this.modal.load('file', this.lang.get('file'), 700);
                    this.upload.init('#redactor-modal-file-upload', this.opts.fileUpload, this.file.insert);

                    this.selection.save();

                    this.selection.get();
                    var text = this.sel.toString();

                    $('#redactor-filename').val(text);

                    this.modal.show();
                },
                insert: function(json, direct, e)
                {
                    // error callback
                    if (typeof json.error != 'undefined')
                    {
                        this.modal.close();
                        this.selection.restore();
                        this.core.setCallback('fileUploadError', json);
                        return;
                    }

                    var link;
                    if (typeof json == 'string')
                    {
                        link = json;
                    }
                    else
                    {
                        var text = $('#redactor-filename').val();
                        if (typeof text == 'undefined' || text === '') text = json.filename;

                        link = '<a href="' + json.filelink + '" id="filelink-marker">' + text + '</a>';
                    }

                    if (direct)
                    {
                        this.selection.removeMarkers();
                        var marker = this.selection.getMarker();
                        this.insert.nodeToCaretPositionFromPoint(e, marker);
                    }
                    else
                    {
                        this.modal.close();
                    }

                    this.selection.restore();
                    this.buffer.set();

                    this.insert.htmlWithoutClean(link);

                    if (typeof json == 'string') return;

                    var linkmarker = $(this.$editor.find('a#filelink-marker'));
                    if (linkmarker.length !== 0)
                    {
                        linkmarker.removeAttr('id').removeAttr('style');
                    }
                    else linkmarker = false;

                    this.core.setCallback('fileUpload', linkmarker, json);

                }
            };
        },
        focus: function()
        {
            return {
                setStart: function()
                {
                    this.$editor.focus();

                    var first = this.$editor.children().first();

                    if (first.length === 0) return;
                    if (first[0].length === 0 || first[0].tagName == 'BR' || first[0].nodeType == 3)
                    {
                        return;
                    }

                    if (first[0].tagName == 'UL' || first[0].tagName == 'OL')
                    {
                        var child = first.find('li').first();
                        if (!this.utils.isBlock(child) && child.text() === '')
                        {
                            // empty inline tag in li
                            this.caret.setStart(child);
                            return;
                        }
                    }

                    if (this.opts.linebreaks && !this.utils.isBlockTag(first[0].tagName))
                    {
                        this.selection.get();
                        this.range.setStart(this.$editor[0], 0);
                        this.range.setEnd(this.$editor[0], 0);
                        this.selection.addRange();

                        return;
                    }

                    // if node is tag
                    this.caret.setStart(first);
                },
                setEnd: function()
                {
                    if (this.utils.browser('mozilla') || this.utils.browser('msie'))
                    {
                        var last = this.$editor.children().last();

                        this.$editor.focus();
                        this.caret.setEnd(last);
                    }
                    else
                    {
                        this.selection.get();

                        try {
                            this.range.selectNodeContents(this.$editor[0]);
                            this.range.collapse(false);

                            this.selection.addRange();
                        }
                        catch (e) {}
                    }

                },
                isFocused: function()
                {
                    var focusNode = document.getSelection().focusNode;
                    if (focusNode === null) return false;

                    if (this.opts.linebreaks && $(focusNode.parentNode).hasClass('redactor-linebreaks')) return true;
                    else if (!this.utils.isRedactorParent(focusNode.parentNode)) return false;

                    return this.$editor.is(':focus');
                }
            };
        },
        image: function()
        {
            return {
                show: function()
                {
                    this.modal.load('image', this.lang.get('image'), 700);
                    this.upload.init('#redactor-modal-image-droparea', this.opts.imageUpload, this.image.insert);

                    this.selection.save();
                    this.modal.show();

                },
                showEdit: function($image)
                {
                    var $link = $image.closest('a');

                    this.modal.load('imageEdit', this.lang.get('edit'), 705);

                    this.modal.createCancelButton();
                    this.image.buttonDelete = this.modal.createDeleteButton(this.lang.get('_delete'));
                    this.image.buttonSave = this.modal.createActionButton(this.lang.get('save'));

                    this.image.buttonDelete.on('click', $.proxy(function()
                    {
                        this.image.remove($image);

                    }, this));

                    this.image.buttonSave.on('click', $.proxy(function()
                    {
                        this.image.update($image);

                    }, this));

                    $('#redactor-image-title').val($image.attr('alt'));

                    if ($image.attr('style').indexOf('width: 100%;') >= 0) {
                        $('#redactor-image-full-screen-width').attr('checked', true);
                    };

                    if (!this.opts.imageLink) $('.redactor-image-link-option').hide();
                    else
                    {
                        var $redactorImageLink = $('#redactor-image-link');

                        $redactorImageLink.attr('href', $image.attr('src'));
                        if ($link.length !== 0)
                        {
                            $redactorImageLink.val($link.attr('href'));
                            if ($link.attr('target') == '_blank') $('#redactor-image-link-blank').prop('checked', true);
                        }
                    }

                    if (!this.opts.imagePosition) $('.redactor-image-position-option').hide();
                    else
                    {
                        var floatValue = ($image.css('display') == 'block' && $image.css('float') == 'none') ? 'center' : $image.css('float');
                        $('#redactor-image-align').val(floatValue);
                    }

                    this.modal.show();

                },
                setFloating: function($image)
                {
                    var floating = $('#redactor-image-align').val();

                    var imageFloat = '';
                    var imageDisplay = '';
                    var imageMargin = '';

                    switch (floating)
                    {
                        case 'left':
                            imageFloat = 'left';
                            imageMargin = '0 ' + this.opts.imageFloatMargin + ' ' + this.opts.imageFloatMargin + ' 0';
                        break;
                        case 'right':
                            imageFloat = 'right';
                            imageMargin = '0 0 ' + this.opts.imageFloatMargin + ' ' + this.opts.imageFloatMargin;
                        break;
                        case 'center':
                            imageDisplay = 'block';
                            imageMargin = 'auto';
                        break;
                    }

                    $image.css({ 'float': imageFloat, display: imageDisplay, margin: imageMargin });
                    $image.attr('rel', $image.attr('style'));
                },
                update: function($image)
                {
                    this.image.hideResize();
                    this.buffer.set();

                    var $link = $image.closest('a');

                    $image.attr('alt', $('#redactor-image-title').val());
                    if ($('#redactor-image-full-screen-width').is(':checked')) {
                        $image.css({
                            width: '100%',
                            height: 'auto'
                        });
                    } else {
                        $image.attr('style', $image.attr('style').replace('width: 100%; height: auto;', ''));
                    }

                    this.image.setFloating($image);

                    // as link
                    var link = $.trim($('#redactor-image-link').val());
                    if (link !== '')
                    {
                        // test url (add protocol)
                        var pattern = '((xn--)?[a-z0-9]+(-[a-z0-9]+)*\\.)+[a-z]{2,}';
                        var re = new RegExp('^(http|ftp|https)://' + pattern, 'i');
                        var re2 = new RegExp('^' + pattern, 'i');

                        if (link.search(re) == -1 && link.search(re2) === 0 && this.opts.linkProtocol)
                        {
                            link = this.opts.linkProtocol + '://' + link;
                        }

                        var target = ($('#redactor-image-link-blank').prop('checked')) ? true : false;

                        if ($link.length === 0)
                        {
                            var a = $('<a href="' + link + '">' + this.utils.getOuterHtml($image) + '</a>');
                            if (target) a.attr('target', '_blank');

                            $image.replaceWith(a);
                        }
                        else
                        {
                            $link.attr('href', link);
                            if (target)
                            {
                                $link.attr('target', '_blank');
                            }
                            else
                            {
                                $link.removeAttr('target');
                            }
                        }
                    }
                    else if ($link.length !== 0)
                    {
                        $link.replaceWith(this.utils.getOuterHtml($image));

                    }

                    this.modal.close();
                    this.observe.images();
                    this.code.sync();


                },
                setEditable: function($image)
                {
                    if (this.opts.imageEditable)
                    {
                        $image.on('dragstart', $.proxy(this.image.onDrag, this));
                    }

                    $image.on('mousedown', $.proxy(this.image.hideResize, this));
                    $image.on('click.redactor touchstart', $.proxy(function(e)
                    {
                        this.observe.image = $image;

                        if (this.$editor.find('#redactor-image-box').length !== 0) return false;

                        this.image.resizer = this.image.loadEditableControls($image);

                        $(document).on('click.redactor-image-resize-hide.' + this.uuid, $.proxy(this.image.hideResize, this));
                        this.$editor.on('click.redactor-image-resize-hide.' + this.uuid, $.proxy(this.image.hideResize, this));

                        // resize
                        if (!this.opts.imageResizable) return;

                        this.image.resizer.on('mousedown.redactor touchstart.redactor', $.proxy(function(e)
                        {
                            this.image.setResizable(e, $image);
                        }, this));


                    }, this));
                },
                setResizable: function(e, $image)
                {
                    e.preventDefault();

                    this.image.resizeHandle = {
                        x : e.pageX,
                        y : e.pageY,
                        el : $image,
                        ratio: $image.width() / $image.height(),
                        h: $image.height()
                    };

                    e = e.originalEvent || e;

                    if (e.targetTouches)
                    {
                         this.image.resizeHandle.x = e.targetTouches[0].pageX;
                         this.image.resizeHandle.y = e.targetTouches[0].pageY;
                    }

                    this.image.startResize();


                },
                startResize: function()
                {
                    $(document).on('mousemove.redactor-image-resize touchmove.redactor-image-resize', $.proxy(this.image.moveResize, this));
                    $(document).on('mouseup.redactor-image-resize touchend.redactor-image-resize', $.proxy(this.image.stopResize, this));
                },
                moveResize: function(e)
                {
                    e.preventDefault();

                    e = e.originalEvent || e;

                    var height = this.image.resizeHandle.h;

                    if (e.targetTouches) height += (e.targetTouches[0].pageY -  this.image.resizeHandle.y);
                    else height += (e.pageY -  this.image.resizeHandle.y);

                    var width = Math.round(height * this.image.resizeHandle.ratio);

                    if (height < 50 || width < 100) return;

                    this.image.resizeHandle.el.width(width);
                    this.image.resizeHandle.el.height(this.image.resizeHandle.el.width()/this.image.resizeHandle.ratio);

                    this.code.sync();
                },
                stopResize: function()
                {
                    this.handle = false;
                    $(document).off('.redactor-image-resize');

                    this.image.hideResize();
                },
                onDrag: function(e)
                {
                    if (this.$editor.find('#redactor-image-box').length !== 0)
                    {
                        e.preventDefault();
                        return false;
                    }

                    this.$editor.on('drop.redactor-image-inside-drop', $.proxy(function()
                    {
                        setTimeout($.proxy(this.image.onDrop, this), 1);

                    }, this));
                },
                onDrop: function()
                {
                    this.image.fixImageSourceAfterDrop();
                    this.observe.images();
                    this.$editor.off('drop.redactor-image-inside-drop');
                    this.clean.clearUnverified();
                    this.code.sync();
                },
                fixImageSourceAfterDrop: function()
                {
                    this.$editor.find('img[data-save-url]').each(function()
                    {
                        var $el = $(this);
                        $el.attr('src', $el.attr('data-save-url'));
                        $el.removeAttr('data-save-url');
                    });
                },
                hideResize: function(e)
                {
                    if (e && $(e.target).closest('#redactor-image-box').length !== 0) return;
                    if (e && e.target.tagName == 'IMG')
                    {
                        var $image = $(e.target);
                        $image.attr('data-save-url', $image.attr('src'));
                    }

                    var imageBox = this.$editor.find('#redactor-image-box');
                    if (imageBox.length === 0) return;

                    if (this.opts.imageEditable)
                    {
                        this.image.editter.remove();
                    }

                    $(this.image.resizer).remove();

                    imageBox.find('img').css({
                        marginTop: imageBox[0].style.marginTop,
                        marginBottom: imageBox[0].style.marginBottom,
                        marginLeft: imageBox[0].style.marginLeft,
                        marginRight: imageBox[0].style.marginRight
                    });

                    imageBox.css('margin', '');
                    imageBox.find('img').css('opacity', '');
                    imageBox.replaceWith(function()
                    {
                        return $(this).contents();
                    });

                    $(document).off('click.redactor-image-resize-hide.' + this.uuid);
                    this.$editor.off('click.redactor-image-resize-hide.' + this.uuid);

                    if (typeof this.image.resizeHandle !== 'undefined')
                    {
                        this.image.resizeHandle.el.attr('rel', this.image.resizeHandle.el.attr('style'));
                    }

                    this.code.sync();

                },
                loadResizableControls: function($image, imageBox)
                {
                    if (this.opts.imageResizable && !this.utils.isMobile())
                    {
                        var imageResizer = $('<span id="redactor-image-resizer" data-redactor="verified"></span>');

                        if (!this.utils.isDesktop())
                        {
                            imageResizer.css({ width: '15px', height: '15px' });
                        }

                        imageResizer.attr('contenteditable', false);
                        imageBox.append(imageResizer);
                        imageBox.append($image);

                        return imageResizer;
                    }
                    else
                    {
                        imageBox.append($image);
                        return false;
                    }
                },
                loadEditableControls: function($image)
                {
                    var imageBox = $('<span id="redactor-image-box" data-redactor="verified">');
                    imageBox.css('float', $image.css('float')).attr('contenteditable', false);

                    if ($image[0].style.margin != 'auto')
                    {
                        imageBox.css({
                            marginTop: $image[0].style.marginTop,
                            marginBottom: $image[0].style.marginBottom,
                            marginLeft: $image[0].style.marginLeft,
                            marginRight: $image[0].style.marginRight
                        });

                        $image.css('margin', '');
                    }
                    else
                    {
                        imageBox.css({ 'display': 'block', 'margin': 'auto' });
                    }

                    $image.css('opacity', '.5').after(imageBox);


                    if (this.opts.imageEditable)
                    {
                        // editter
                        this.image.editter = $('<span id="redactor-image-editter" data-redactor="verified">' + this.lang.get('edit') + '</span>');
                        this.image.editter.attr('contenteditable', false);
                        this.image.editter.on('click', $.proxy(function()
                        {
                            this.image.showEdit($image);
                        }, this));

                        imageBox.append(this.image.editter);

                        // position correction
                        var editerWidth = this.image.editter.innerWidth();
                        this.image.editter.css('margin-left', '-' + editerWidth/2 + 'px');
                    }

                    return this.image.loadResizableControls($image, imageBox);

                },
                remove: function(image)
                {
                    var $image = $(image);
                    var $link = $image.closest('a');
                    var $figure = $image.closest('figure');
                    var $parent = $image.parent();
                    if ($('#redactor-image-box').length !== 0)
                    {
                        $parent = $('#redactor-image-box').parent();
                    }

                    var $next;
                    if ($figure.length !== 0)
                    {
                        $next = $figure.next();
                        $figure.remove();
                    }
                    else if ($link.length !== 0)
                    {
                        $parent = $link.parent();
                        $link.remove();
                    }
                    else
                    {
                        $image.remove();
                    }

                    $('#redactor-image-box').remove();

                    if ($figure.length !== 0)
                    {
                        this.caret.setStart($next);
                    }
                    else
                    {
                        this.caret.setStart($parent);
                    }

                    // delete callback
                    this.core.setCallback('imageDelete', $image[0].src, $image);

                    this.modal.close();
                    this.code.sync();
                },
                insert: function(json, direct, e)
                {
                    // error callback
                    if (typeof json.error != 'undefined')
                    {
                        this.modal.close();
                        this.selection.restore();
                        this.core.setCallback('imageUploadError', json);
                        return;
                    }

                    var $img;
                    if (typeof json == 'string')
                    {
                        $img = $(json).attr('data-redactor-inserted-image', 'true');
                    }
                    else
                    {
                        $img = $('<img>');
                        $img.attr('src', json.filelink).attr('data-redactor-inserted-image', 'true');
                    }


                    var node = $img;
                    var isP = this.utils.isCurrentOrParent('P');
                    if (isP)
                    {
                        // will replace
                        node = $('<blockquote />').append($img);
                    }

                    if (direct)
                    {
                        this.selection.removeMarkers();
                        var marker = this.selection.getMarker();
                        this.insert.nodeToCaretPositionFromPoint(e, marker);
                    }
                    else
                    {
                        this.modal.close();
                    }

                    this.selection.restore();
                    this.buffer.set();

                    this.insert.html(this.utils.getOuterHtml(node), false);

                    var $image = this.$editor.find('img[data-redactor-inserted-image=true]').removeAttr('data-redactor-inserted-image');

                    if (isP)
                    {
                        $image.parent().contents().unwrap().wrap('<p />');
                    }
                    else if (this.opts.linebreaks)
                    {
                        $image.before('<br>').after('<br>');
                    }

                    if (typeof json == 'string') return;

                    this.core.setCallback('imageUpload', $image, json);

                }
            };
        },
        indent: function()
        {
            return {
                increase: function()
                {
                    // focus
                    if (!this.utils.browser('msie')) this.$editor.focus();

                    this.buffer.set();
                    this.selection.save();

                    var block = this.selection.getBlock();

                    if (block && block.tagName == 'LI')
                    {
                        this.indent.increaseLists();
                    }
                    else if (block === false && this.opts.linebreaks)
                    {
                        this.indent.increaseText();
                    }
                    else
                    {
                        this.indent.increaseBlocks();
                    }

                    this.selection.restore();
                    this.code.sync();
                },
                increaseLists: function()
                {
                    document.execCommand('indent');

                    this.indent.fixEmptyIndent();
                    this.clean.normalizeLists();
                    this.clean.clearUnverified();
                },
                increaseBlocks: function()
                {
                    $.each(this.selection.getBlocks(), $.proxy(function(i, elem)
                    {
                        if (elem.tagName === 'TD' || elem.tagName === 'TH') return;

                        var $el = this.utils.getAlignmentElement(elem);

                        var left = this.utils.normalize($el.css('margin-left')) + this.opts.indentValue;
                        $el.css('margin-left', left + 'px');

                    }, this));
                },
                increaseText: function()
                {
                    var wrapper = this.selection.wrap('div');
                    $(wrapper).attr('data-tagblock', 'redactor');
                    $(wrapper).css('margin-left', this.opts.indentValue + 'px');
                },
                decrease: function()
                {
                    this.buffer.set();
                    this.selection.save();

                    var block = this.selection.getBlock();
                    if (block && block.tagName == 'LI')
                    {
                        this.indent.decreaseLists();
                    }
                    else
                    {
                        this.indent.decreaseBlocks();
                    }

                    this.selection.restore();
                    this.code.sync();
                },
                decreaseLists: function ()
                {
                    document.execCommand('outdent');

                    var current = this.selection.getCurrent();

                    var $item = $(current).closest('li');
                    var $parent = $item.parent();
                    if ($item.length !== 0 && $parent.length !== 0 && $parent[0].tagName == 'LI')
                    {
                        $parent.after($item);
                    }

                    this.indent.fixEmptyIndent();

                    if (!this.opts.linebreaks && $item.length === 0)
                    {
                        document.execCommand('formatblock', false, 'p');
                        this.$editor.find('ul, ol, blockquote, p').each($.proxy(this.utils.removeEmpty, this));
                    }

                    this.clean.clearUnverified();
                },
                decreaseBlocks: function()
                {
                    $.each(this.selection.getBlocks(), $.proxy(function(i, elem)
                    {
                        var $el = this.utils.getAlignmentElement(elem);
                        var left = this.utils.normalize($el.css('margin-left')) - this.opts.indentValue;

                        if (left <= 0)
                        {
                            if (this.opts.linebreaks && typeof($el.data('tagblock')) !== 'undefined')
                            {
                                $el.replaceWith($el.html() + '<br />');
                            }
                            else
                            {
                                $el.css('margin-left', '');
                                this.utils.removeEmptyAttr($el, 'style');
                            }
                        }
                        else
                        {
                            $el.css('margin-left', left + 'px');
                        }

                    }, this));
                },
                fixEmptyIndent: function()
                {
                    var block = this.selection.getBlock();

                    if (this.range.collapsed && block && block.tagName == 'LI' && this.utils.isEmpty($(block).text()))
                    {
                        var $block = $(block);
                        $block.find('span').not('.redactor-selection-marker').contents().unwrap();
                        $block.append('<br>');
                    }
                }
            };
        },
        inline: function()
        {
            return {
                formatting: function(name)
                {
                    var type, value;

                    if (typeof this.formatting[name].style != 'undefined') type = 'style';
                    else if (typeof this.formatting[name]['class'] != 'undefined') type = 'class';

                    if (type) value = this.formatting[name][type];

                    this.inline.format(this.formatting[name].tag, type, value);

                },
                format: function(tag, type, value)
                {
                    // Stop formatting pre and headers
                    if (this.utils.isCurrentOrParent('PRE') || this.utils.isCurrentOrParentHeader()) return;

                    var tags = ['b', 'bold', 'i', 'italic', 'underline', 'strikethrough', 'deleted', 'superscript', 'subscript'];
                    var replaced = ['strong', 'strong', 'em', 'em', 'u', 'del', 'del', 'sup', 'sub'];

                    for (var i = 0; i < tags.length; i++)
                    {
                        if (tag == tags[i]) tag = replaced[i];
                    }

                    this.inline.type = type || false;
                    this.inline.value = value || false;

                    this.buffer.set();

                    if (!this.utils.browser('msie'))
                    {
                        this.$editor.focus();
                    }

                    this.selection.get();

                    if (this.range.collapsed)
                    {
                        this.inline.formatCollapsed(tag);
                    }
                    else
                    {
                        this.inline.formatMultiple(tag);
                    }
                },
                formatCollapsed: function(tag)
                {
                    var current = this.selection.getCurrent();
                    var $parent = $(current).closest(tag + '[data-redactor-tag=' + tag + ']');

                    // inline there is
                    if ($parent.length !== 0 && (this.inline.type != 'style' && $parent[0].tagName != 'SPAN'))
                    {
                        // remove empty
                        if (this.utils.isEmpty($parent.text()))
                        {
                            this.caret.setAfter($parent[0]);

                            $parent.remove();
                            this.code.sync();
                        }
                        else if (this.utils.isEndOfElement($parent))
                        {
                            this.caret.setAfter($parent[0]);
                        }

                        return;
                    }

                    // create empty inline
                    var node = $('<' + tag + '>').attr('data-verified', 'redactor').attr('data-redactor-tag', tag);
                    node.html(this.opts.invisibleSpace);

                    node = this.inline.setFormat(node);

                    var node = this.insert.node(node);
                    this.caret.setEnd(node);

                    this.code.sync();
                },
                formatMultiple: function(tag)
                {
                    this.inline.formatConvert(tag);

                    this.selection.save();
                    document.execCommand('strikethrough');

                    this.$editor.find('strike').each($.proxy(function(i,s)
                    {
                        var $el = $(s);

                        this.inline.formatRemoveSameChildren($el, tag);

                        var $span;
                        if (this.inline.type)
                        {
                            $span = $('<span>').attr('data-redactor-tag', tag).attr('data-verified', 'redactor');
                            $span = this.inline.setFormat($span);
                        }
                        else
                        {
                            $span = $('<' + tag + '>').attr('data-redactor-tag', tag).attr('data-verified', 'redactor');
                        }

                        $el.replaceWith($span.html($el.contents()));

                        if (tag == 'span')
                        {
                            var $parent = $span.parent();
                            if ($parent && $parent[0].tagName == 'SPAN' && this.inline.type == 'style')
                            {
                                var arr = this.inline.value.split(';');

                                for (var z = 0; z < arr.length; z++)
                                {
                                    if (arr[z] === '') return;
                                    var style = arr[z].split(':');
                                    $parent.css(style[0], '');

                                    if (this.utils.removeEmptyAttr($parent, 'style'))
                                    {
                                        $parent.replaceWith($parent.contents());
                                    }

                                }

                            }
                        }

                    }, this));

                    // clear text decoration
                    if (tag != 'span')
                    {
                        this.$editor.find(this.opts.inlineTags.join(', ')).each($.proxy(function(i,s)
                        {
                            var $el = $(s);
                            var property = $el.css('text-decoration');
                            if (property == 'line-through')
                            {
                                $el.css('text-decoration', '');
                                this.utils.removeEmptyAttr($el, 'style');
                            }
                        }, this));
                    }

                    if (tag != 'del')
                    {
                        var _this = this;
                        this.$editor.find('inline').each(function(i,s)
                        {
                            _this.utils.replaceToTag(s, 'del');
                        });
                    }

                    this.selection.restore();
                    this.code.sync();

                },
                formatRemoveSameChildren: function($el, tag)
                {
                    var self = this;
                    $el.children(tag).each(function()
                    {
                        var $child = $(this);

                        if (!$child.hasClass('redactor-selection-marker'))
                        {
                            if (self.inline.type == 'style')
                            {
                                var arr = self.inline.value.split(';');

                                for (var z = 0; z < arr.length; z++)
                                {
                                    if (arr[z] === '') return;

                                    var style = arr[z].split(':');
                                    $child.css(style[0], '');

                                    if (self.utils.removeEmptyAttr($child , 'style'))
                                    {
                                        $child.replaceWith($child.contents());
                                    }

                                }
                            }
                            else
                            {
                                $child.contents().unwrap();
                            }
                        }

                    });
                },
                formatConvert: function(tag)
                {
                    this.selection.save();

                    var find = '';
                    if (this.inline.type == 'class') find = '[data-redactor-class=' + this.inline.value + ']';
                    else if (this.inline.type == 'style')
                    {
                        find = '[data-redactor-style="' + this.inline.value + '"]';
                    }

                    var self = this;
                    if (tag != 'del')
                    {
                        this.$editor.find('del').each(function(i,s)
                        {
                            self.utils.replaceToTag(s, 'inline');
                        });
                    }

                    if (tag != 'span')
                    {
                        this.$editor.find(tag).each(function()
                        {
                            var $el = $(this);
                            $el.replaceWith($('<strike />').html($el.contents()));

                        });
                    }

                    this.$editor.find('[data-redactor-tag="' + tag + '"]' + find).each(function()
                    {
                        if (find === '' && tag == 'span' && this.tagName.toLowerCase() == tag) return;

                        var $el = $(this);
                        $el.replaceWith($('<strike />').html($el.contents()));

                    });

                    this.selection.restore();
                },
                setFormat: function(node)
                {
                    switch (this.inline.type)
                    {
                        case 'class':

                            if (node.hasClass(this.inline.value))
                            {
                                node.removeClass(this.inline.value);
                                node.removeAttr('data-redactor-class');
                            }
                            else
                            {
                                node.addClass(this.inline.value);
                                node.attr('data-redactor-class', this.inline.value);
                            }


                        break;
                        case 'style':

                            node[0].style.cssText = this.inline.value;
                            node.attr('data-redactor-style', this.inline.value);

                        break;
                    }

                    return node;
                },
                removeStyle: function()
                {
                    this.buffer.set();
                    var current = this.selection.getCurrent();
                    var nodes = this.selection.getInlines();

                    this.selection.save();

                    if (current && current.tagName === 'SPAN')
                    {
                        var $s = $(current);

                        $s.removeAttr('style');
                        if ($s[0].attributes.length === 0)
                        {
                            $s.replaceWith($s.contents());
                        }
                    }

                    $.each(nodes, $.proxy(function(i,s)
                    {
                        var $s = $(s);
                        if ($.inArray(s.tagName.toLowerCase(), this.opts.inlineTags) != -1 && !$s.hasClass('redactor-selection-marker'))
                        {
                            $s.removeAttr('style');
                            if ($s[0].attributes.length === 0)
                            {
                                $s.replaceWith($s.contents());
                            }
                        }
                    }, this));

                    this.selection.restore();
                    this.code.sync();

                },
                removeStyleRule: function(name)
                {
                    this.buffer.set();
                    var parent = this.selection.getParent();
                    var nodes = this.selection.getInlines();

                    this.selection.save();

                    if (parent && parent.tagName === 'SPAN')
                    {
                        var $s = $(parent);

                        $s.css(name, '');
                        this.utils.removeEmptyAttr($s, 'style');
                        if ($s[0].attributes.length === 0)
                        {
                            $s.replaceWith($s.contents());
                        }
                    }

                    $.each(nodes, $.proxy(function(i,s)
                    {
                        var $s = $(s);
                        if ($.inArray(s.tagName.toLowerCase(), this.opts.inlineTags) != -1 && !$s.hasClass('redactor-selection-marker'))
                        {
                            $s.css(name, '');
                            this.utils.removeEmptyAttr($s, 'style');
                            if ($s[0].attributes.length === 0)
                            {
                                $s.replaceWith($s.contents());
                            }
                        }
                    }, this));

                    this.selection.restore();
                    this.code.sync();
                },
                removeFormat: function()
                {
                    this.buffer.set();
                    var current = this.selection.getCurrent();

                    this.selection.save();

                    document.execCommand('removeFormat');

                    if (current && current.tagName === 'SPAN')
                    {
                        $(current).replaceWith($(current).contents());
                    }


                    $.each(this.selection.getNodes(), $.proxy(function(i,s)
                    {
                        var $s = $(s);
                        if ($.inArray(s.tagName.toLowerCase(), this.opts.inlineTags) != -1 && !$s.hasClass('redactor-selection-marker'))
                        {
                            $s.replaceWith($s.contents());
                        }
                    }, this));

                    this.selection.restore();
                    this.code.sync();

                },
                toggleClass: function(className)
                {
                    this.inline.format('span', 'class', className);
                },
                toggleStyle: function(value)
                {
                    this.inline.format('span', 'style', value);
                }
            };
        },
        insert: function()
        {
            return {
                set: function(html, clean)
                {
                    this.placeholder.remove();

                    html = this.clean.setVerified(html);

                    if (typeof clean == 'undefined')
                    {
                        html = this.clean.onPaste(html, false);
                    }

                    this.$editor.html(html);
                    this.selection.remove();
                    this.focus.setEnd();
                    this.clean.normalizeLists();
                    this.code.sync();
                    this.observe.load();

                    if (typeof clean == 'undefined')
                    {
                        setTimeout($.proxy(this.clean.clearUnverified, this), 10);
                    }
                },
                text: function(text)
                {
                    this.placeholder.remove();

                    text = text.toString();
                    text = $.trim(text);
                    text = this.clean.getPlainText(text, false);

                    this.$editor.focus();

                    if (this.utils.browser('msie'))
                    {
                        this.insert.htmlIe(text);
                    }
                    else
                    {
                        this.selection.get();

                        this.range.deleteContents();
                        var el = document.createElement("div");
                        el.innerHTML = text;
                        var frag = document.createDocumentFragment(), node, lastNode;
                        while ((node = el.firstChild))
                        {
                            lastNode = frag.appendChild(node);
                        }

                        this.range.insertNode(frag);

                        if (lastNode)
                        {
                            var range = this.range.cloneRange();
                            range.setStartAfter(lastNode);
                            range.collapse(true);
                            this.sel.removeAllRanges();
                            this.sel.addRange(range);
                        }
                    }

                    this.code.sync();
                    this.clean.clearUnverified();
                },
                htmlWithoutClean: function(html)
                {
                    this.insert.html(html, false);
                },
                html: function(html, clean)
                {
                    this.placeholder.remove();

                    if (typeof clean == 'undefined') clean = true;

                    this.$editor.focus();

                    html = this.clean.setVerified(html);

                    if (clean)
                    {
                        html = this.clean.onPaste(html);
                    }

                    if (this.utils.browser('msie'))
                    {
                        this.insert.htmlIe(html);
                    }
                    else
                    {
                        if (this.clean.singleLine) this.insert.execHtml(html);
                        else document.execCommand('insertHTML', false, html);

                        this.insert.htmlFixMozilla();

                    }

                    this.clean.normalizeLists();

                    // remove empty paragraphs finaly
                    if (!this.opts.linebreaks)
                    {
                        this.$editor.find('p').each($.proxy(this.utils.removeEmpty, this));
                    }

                    this.code.sync();
                    this.observe.load();

                    if (clean)
                    {
                        this.clean.clearUnverified();
                    }

                },
                htmlFixMozilla: function()
                {
                    // FF inserts empty p when content was selected dblclick
                    if (!this.utils.browser('mozilla')) return;

                    var $next = $(this.selection.getBlock()).next();
                    if ($next.length > 0 && $next[0].tagName == 'P' && $next.html() === '')
                    {
                        $next.remove();
                    }

                },
                htmlIe: function(html)
                {
                    if (this.utils.isIe11())
                    {
                        var parent = this.utils.isCurrentOrParent('P');
                        var $html = $('<div>').append(html);
                        var blocksMatch = $html.contents().is('p, :header, dl, ul, ol, div, table, td, blockquote, pre, address, section, header, footer, aside, article');

                        if (parent && blocksMatch) this.insert.ie11FixInserting(parent, html);
                        else this.insert.ie11PasteFrag(html);

                        return;
                    }

                    document.selection.createRange().pasteHTML(html);

                },
                execHtml: function(html)
                {
                    html = this.clean.setVerified(html);

                    this.selection.get();

                    this.range.deleteContents();

                    var el = document.createElement('div');
                    el.innerHTML = html;

                    var frag = document.createDocumentFragment(), node, lastNode;
                    while ((node = el.firstChild))
                    {
                        lastNode = frag.appendChild(node);
                    }

                    this.range.insertNode(frag);

                    this.range.collapse(true);
                    this.caret.setAfter(lastNode);

                },
                node: function(node, deleteContents)
                {
                    node = node[0] || node;

                    var html = this.utils.getOuterHtml(node);
                    html = this.clean.setVerified(html);

                    if (html.match(/</g) !== null)
                    {
                        node = $(html)[0];
                    }

                    this.selection.get();

                    if (deleteContents !== false)
                    {
                        this.range.deleteContents();
                    }

                    this.range.insertNode(node);
                    this.range.collapse(false);
                    this.selection.addRange();

                    return node;
                },
                nodeToPoint: function(node, x, y)
                {
                    node = node[0] || node;

                    this.selection.get();

                    var range;
                    if (document.caretPositionFromPoint)
                    {
                        var pos = document.caretPositionFromPoint(x, y);

                        this.range.setStart(pos.offsetNode, pos.offset);
                        this.range.collapse(true);
                        this.range.insertNode(node);
                    }
                    else if (document.caretRangeFromPoint)
                    {
                        range = document.caretRangeFromPoint(x, y);
                        range.insertNode(node);
                    }
                    else if (typeof document.body.createTextRange != "undefined")
                    {
                        range = document.body.createTextRange();
                        range.moveToPoint(x, y);
                        var endRange = range.duplicate();
                        endRange.moveToPoint(x, y);
                        range.setEndPoint("EndToEnd", endRange);
                        range.select();
                    }
                },
                nodeToCaretPositionFromPoint: function(e, node)
                {
                    node = node[0] || node;

                    var range;
                    var x = e.clientX, y = e.clientY;
                    if (document.caretPositionFromPoint)
                    {
                        var pos = document.caretPositionFromPoint(x, y);
                        var sel = document.getSelection();
                        range = sel.getRangeAt(0);
                        range.setStart(pos.offsetNode, pos.offset);
                        range.collapse(true);
                        range.insertNode(node);
                    }
                    else if (document.caretRangeFromPoint)
                    {
                        range = document.caretRangeFromPoint(x, y);
                        range.insertNode(node);
                    }
                    else if (typeof document.body.createTextRange != "undefined")
                    {
                        range = document.body.createTextRange();
                        range.moveToPoint(x, y);
                        var endRange = range.duplicate();
                        endRange.moveToPoint(x, y);
                        range.setEndPoint("EndToEnd", endRange);
                        range.select();
                    }

                },
                ie11FixInserting: function(parent, html)
                {
                    var node = document.createElement('span');
                    node.className = 'redactor-ie-paste';
                    this.insert.node(node);

                    var parHtml = $(parent).html();

                    parHtml = '<p>' + parHtml.replace(/<span class="redactor-ie-paste"><\/span>/gi, '</p>' + html + '<p>') + '</p>';
                    $(parent).replaceWith(parHtml);
                },
                ie11PasteFrag: function(html)
                {
                    this.selection.get();
                    this.range.deleteContents();

                    var el = document.createElement("div");
                    el.innerHTML = html;

                    var frag = document.createDocumentFragment(), node, lastNode;
                    while ((node = el.firstChild))
                    {
                        lastNode = frag.appendChild(node);
                    }

                    this.range.insertNode(frag);
                    this.range.collapse(false);
                    this.selection.addRange();
                }
            };
        },
        keydown: function()
        {
            return {
                init: function(e)
                {
                    if (this.rtePaste) return;

                    var key = e.which;
                    var arrow = (key >= 37 && key <= 40);

                    this.keydown.ctrl = e.ctrlKey || e.metaKey;
                    this.keydown.current = this.selection.getCurrent();
                    this.keydown.parent = this.selection.getParent();
                    this.keydown.block = this.selection.getBlock();

                    // detect tags
                    this.keydown.pre = this.utils.isTag(this.keydown.current, 'pre');
                    this.keydown.blockquote = this.utils.isTag(this.keydown.current, 'blockquote');
                    this.keydown.figcaption = this.utils.isTag(this.keydown.current, 'figcaption');

                    // shortcuts setup
                    this.shortcuts.init(e, key);

                    this.keydown.checkEvents(arrow, key);
                    this.keydown.setupBuffer(e, key);
                    this.keydown.addArrowsEvent(arrow);
                    this.keydown.setupSelectAll(e, key);

                    // callback
                    var keydownStop = this.core.setCallback('keydown', e);
                    if (keydownStop === false)
                    {
                        e.preventDefault();
                        return false;
                    }

                    // ie and ff exit from table
                    if (this.opts.enterKey && (this.utils.browser('msie') || this.utils.browser('mozilla')) && (key === this.keyCode.DOWN || key === this.keyCode.RIGHT))
                    {
                        var isEndOfTable = false;
                        var $table = false;
                        if (this.keydown.block && this.keydown.block.tagName === 'TD')
                        {
                            $table = $(this.keydown.block).closest('table');
                        }

                        if ($table && $table.find('td').last()[0] === this.keydown.block)
                        {
                            isEndOfTable = true;
                        }

                        if (this.utils.isEndOfElement() && isEndOfTable)
                        {
                            var node = $(this.opts.emptyHtml);
                            $table.after(node);
                            this.caret.setStart(node);
                        }
                    }

                    // down
                    if (this.opts.enterKey && key === this.keyCode.DOWN)
                    {
                        this.keydown.onArrowDown();
                    }

                    // turn off enter key
                    if (!this.opts.enterKey && key === this.keyCode.ENTER)
                    {
                        e.preventDefault();
                        // remove selected
                        if (!this.range.collapsed) this.range.deleteContents();
                        return;
                    }

                    // on enter
                    if (key == this.keyCode.ENTER && !e.shiftKey && !e.ctrlKey && !e.metaKey)
                    {
                        var stop = this.core.setCallback('enter', e);
                        if (stop === false)
                        {
                            e.preventDefault();
                            return false;
                        }

                        if (this.keydown.blockquote && this.keydown.exitFromBlockquote(e) === true)
                        {
                            return false;
                        }

                        var current, $next;
                        if (this.keydown.pre)
                        {
                            return this.keydown.insertNewLine(e);
                        }
                        else if (this.keydown.blockquote || this.keydown.figcaption)
                        {
                            current = this.selection.getCurrent();
                            $next = $(current).next();

                            if ($next.length !== 0 && $next[0].tagName == 'BR')
                            {
                                return this.keydown.insertBreakLine(e);
                            }
                            else if (this.utils.isEndOfElement() && (current && current != 'SPAN'))
                            {
                                return this.keydown.insertDblBreakLine(e);
                            }
                            else
                            {
                                return this.keydown.insertBreakLine(e);
                            }
                        }
                        else if (this.opts.linebreaks && !this.keydown.block)
                        {
                            current = this.selection.getCurrent();
                            $next = $(this.keydown.current).next();



                            if ($next.length !== 0 && $next[0].tagName == 'BR')
                            {
                                return this.keydown.insertBreakLine(e);
                            }
                            else if (current !== false && $(current).hasClass('redactor-invisible-space'))
                            {
                                this.caret.setAfter(current);
                                $(current).contents().unwrap();

                                return this.keydown.insertDblBreakLine(e);
                            }
                            else
                            {
                                if (this.utils.isEndOfEditor())
                                {
                                    return this.keydown.insertDblBreakLine(e);
                                }
                                else if ($next.length === 0 && current === false && typeof $next.context != 'undefined')
                                {
                                    return this.keydown.insertBreakLine(e);
                                }

                                return this.keydown.insertBreakLine(e);
                            }
                        }
                        else if (this.opts.linebreaks && this.keydown.block)
                        {
                            setTimeout($.proxy(this.keydown.replaceDivToBreakLine, this), 1);
                        }
                        // paragraphs
                        else if (!this.opts.linebreaks && this.keydown.block)
                        {
                            if (this.keydown.block.tagName !== 'LI')
                            {
                                setTimeout($.proxy(this.keydown.replaceDivToParagraph, this), 1);
                            }
                            else
                            {
                                current = this.selection.getCurrent();
                                var $parent = $(current).closest('li');
                                var $list = $parent.closest('ul,ol');

                                if ($parent.length !== 0 && this.utils.isEmpty($parent.html()) && $list.next().length === 0)
                                {
                                    var node = $(this.opts.emptyHtml);
                                    $list.after(node);
                                    this.caret.setStart(node);

                                    return false;
                                }
                            }
                        }
                        else if (!this.opts.linebreaks && !this.keydown.block)
                        {
                            return this.keydown.insertParagraph(e);
                        }
                    }

                    // Shift+Enter or Ctrl+Enter
                    if (key === this.keyCode.ENTER && (e.ctrlKey || e.shiftKey))
                    {
                        return this.keydown.onShiftEnter(e);
                    }


                    // tab or cmd + [
                    if (key === this.keyCode.TAB || e.metaKey && key === 221 || e.metaKey && key === 219)
                    {
                        return this.keydown.onTab(e, key);
                    }

                    // image delete and backspace
                    if (key === this.keyCode.BACKSPACE || key === this.keyCode.DELETE)
                    {
                        if (this.utils.browser('mozilla') && this.keydown.current && this.keydown.current.tagName === 'TD')
                        {
                            e.preventDefault();
                            return false;
                        }

                        var nodes = this.selection.getNodes();
                        if (nodes)
                        {
                            var len = nodes.length;
                            var last;
                            for (var i = 0; i < len; i++)
                            {
                                var children = $(nodes[i]).children('img');
                                if (children.length !== 0)
                                {
                                    var self = this;
                                    $.each(children, function(z,s)
                                    {
                                        var $s = $(s);
                                        if ($s.css('float') != 'none') return;

                                        // image delete callback
                                        self.core.setCallback('imageDelete', s.src, $s);
                                        last = s;
                                    });
                                }
                                else if (nodes[i].tagName == 'IMG')
                                {
                                    if (last != nodes[i])
                                    {
                                        // image delete callback
                                        this.core.setCallback('imageDelete', nodes[i].src, $(nodes[i]));
                                        last = nodes[i];
                                    }
                                }
                            }
                        }
                    }

                    // backspace
                    if (key === this.keyCode.BACKSPACE)
                    {
                        this.keydown.removeInvisibleSpace();
                        this.keydown.removeEmptyListInTable(e);
                    }

                    this.code.sync();
                },
                checkEvents: function(arrow, key)
                {
                    if (!arrow && (this.core.getEvent() == 'click' || this.core.getEvent() == 'arrow'))
                    {
                        this.core.addEvent(false);

                        if (this.keydown.checkKeyEvents(key))
                        {
                            this.buffer.set();
                        }
                    }
                },
                checkKeyEvents: function(key)
                {
                    var k = this.keyCode;
                    var keys = [k.BACKSPACE, k.DELETE, k.ENTER, k.SPACE, k.ESC, k.TAB, k.CTRL, k.META, k.ALT, k.SHIFT];

                    return ($.inArray(key, keys) == -1) ? true : false;

                },
                addArrowsEvent: function(arrow)
                {
                    if (!arrow) return;

                    if ((this.core.getEvent() == 'click' || this.core.getEvent() == 'arrow'))
                    {
                        this.core.addEvent(false);
                        return;
                    }

                    this.core.addEvent('arrow');
                },
                setupBuffer: function(e, key)
                {
                    if (this.keydown.ctrl && key === 90 && !e.shiftKey && !e.altKey && this.opts.buffer.length) // z key
                    {
                        e.preventDefault();
                        this.buffer.undo();
                        return;
                    }
                    // undo
                    else if (this.keydown.ctrl && key === 90 && e.shiftKey && !e.altKey && this.opts.rebuffer.length !== 0)
                    {
                        e.preventDefault();
                        this.buffer.redo();
                        return;
                    }
                    else if (!this.keydown.ctrl)
                    {
                        if (key == this.keyCode.BACKSPACE || key == this.keyCode.DELETE || (key == this.keyCode.ENTER && !e.ctrlKey && !e.shiftKey) || key == this.keyCode.SPACE)
                        {
                            this.buffer.set();
                        }
                    }
                },
                setupSelectAll: function(e, key)
                {
                    if (this.keydown.ctrl && key === 65)
                    {
                        this.utils.enableSelectAll();
                    }
                    else if (key != this.keyCode.LEFT_WIN && !this.keydown.ctrl)
                    {
                        this.utils.disableSelectAll();
                    }
                },
                onArrowDown: function()
                {
                    var tags = [this.keydown.blockquote, this.keydown.pre, this.keydown.figcaption];

                    for (var i = 0; i < tags.length; i++)
                    {
                        if (tags[i])
                        {
                            this.keydown.insertAfterLastElement(tags[i]);
                            return false;
                        }
                    }
                },
                onShiftEnter: function(e)
                {
                    this.buffer.set();

                    if (this.utils.isEndOfElement())
                    {
                        return this.keydown.insertDblBreakLine(e);
                    }

                    return this.keydown.insertBreakLine(e);
                },
                onTab: function(e, key)
                {
                    if (!this.opts.tabKey) return true;
                    if (this.utils.isEmpty(this.code.get()) && this.opts.tabAsSpaces === false) return true;

                    e.preventDefault();

                    var node;
                    if (this.keydown.pre && !e.shiftKey)
                    {
                        node = (this.opts.preSpaces) ? document.createTextNode(Array(this.opts.preSpaces + 1).join('\u00a0')) : document.createTextNode('\t');
                        this.insert.node(node);
                        this.code.sync();
                    }
                    else if (this.opts.tabAsSpaces !== false)
                    {
                        node = document.createTextNode(Array(this.opts.tabAsSpaces + 1).join('\u00a0'));
                        this.insert.node(node);
                        this.code.sync();
                    }
                    else
                    {
                        if (e.metaKey && key === 219) this.indent.decrease();
                        else if (e.metaKey && key === 221) this.indent.increase();
                        else if (!e.shiftKey) this.indent.increase();
                        else this.indent.decrease();
                    }

                    return false;
                },
                replaceDivToBreakLine: function()
                {
                    var blockElem = this.selection.getBlock();
                    var blockHtml = blockElem.innerHTML.replace(/<br\s?\/?>/gi, '');
                    if ((blockElem.tagName === 'DIV' || blockElem.tagName === 'P') && blockHtml === '' && !$(blockElem).hasClass('redactor-editor'))
                    {
                        var br = document.createElement('br');

                        $(blockElem).replaceWith(br);
                        this.caret.setBefore(br);

                        this.code.sync();

                        return false;
                    }
                },
                replaceDivToParagraph: function()
                {
                    var blockElem = this.selection.getBlock();
                    var blockHtml = blockElem.innerHTML.replace(/<br\s?\/?>/gi, '');
                    if (blockElem.tagName === 'DIV' && blockHtml === '' && !$(blockElem).hasClass('redactor-editor'))
                    {
                        var p = document.createElement('p');
                        p.innerHTML = this.opts.invisibleSpace;

                        $(blockElem).replaceWith(p);
                        this.caret.setStart(p);

                        this.code.sync();

                        return false;
                    }
                    else if (this.opts.cleanStyleOnEnter && blockElem.tagName == 'P')
                    {
                        $(blockElem).removeAttr('class').removeAttr('style');
                    }
                },
                insertParagraph: function(e)
                {
                    e.preventDefault();

                    this.selection.get();

                    var p = document.createElement('p');
                    p.innerHTML = this.opts.invisibleSpace;

                    this.range.deleteContents();
                    this.range.insertNode(p);

                    this.caret.setStart(p);

                    this.code.sync();

                    return false;
                },
                exitFromBlockquote: function(e)
                {
                    if (!this.utils.isEndOfElement()) return;

                    var tmp = $.trim($(this.keydown.block).html());
                    if (tmp.search(/(<br\s?\/?>){2}$/i) != -1)
                    {
                        e.preventDefault();

                        if (this.opts.linebreaks)
                        {
                            var br = document.createElement('br');
                            $(this.keydown.blockquote).after(br);

                            this.caret.setBefore(br);
                            $(this.keydown.block).html(tmp.replace(/<br\s?\/?>$/i, ''));
                        }
                        else
                        {
                            var node = $(this.opts.emptyHtml);
                            $(this.keydown.blockquote).after(node);
                            this.caret.setStart(node);
                        }

                        return true;

                    }

                    return;

                },
                insertAfterLastElement: function(element)
                {
                    if (!this.utils.isEndOfElement()) return;

                    this.buffer.set();

                    if (this.opts.linebreaks)
                    {
                        var contents = $('<div>').append($.trim(this.$editor.html())).contents();
                        var last = contents.last()[0];
                        if (last.tagName == 'SPAN' && last.innerHTML === '')
                        {
                            last = contents.prev()[0];
                        }

                        if (this.utils.getOuterHtml(last) != this.utils.getOuterHtml(element)) return;

                        var br = document.createElement('br');
                        $(element).after(br);
                        this.caret.setAfter(br);

                    }
                    else
                    {
                        if (this.$editor.contents().last()[0] !== element) return;

                        var node = $(this.opts.emptyHtml);
                        $(element).after(node);
                        this.caret.setStart(node);
                    }
                },
                insertNewLine: function(e)
                {
                    e.preventDefault();

                    var node = document.createTextNode('\n');

                    this.selection.get();

                    this.range.deleteContents();
                    this.range.insertNode(node);

                    this.caret.setAfter(node);

                    this.code.sync();

                    return false;
                },
                insertBreakLine: function(e)
                {
                    return this.keydown.insertBreakLineProcessing(e);
                },
                insertDblBreakLine: function(e)
                {
                    return this.keydown.insertBreakLineProcessing(e, true);
                },
                insertBreakLineProcessing: function(e, dbl)
                {
                    e.stopPropagation();

                    this.selection.get();
                    var br1 = document.createElement('br');

                    if (this.utils.browser('msie'))
                    {
                        this.range.collapse(false);
                        this.range.setEnd(this.range.endContainer, this.range.endOffset);
                    }
                    else
                    {
                        this.range.deleteContents();
                    }

                    this.range.insertNode(br1);

                    if (dbl === true)
                    {

                        var $next = $(br1).next();
                        if ($next.length !== 0 && $next[0].tagName === 'BR' && this.utils.isEndOfEditor())
                        {
                            this.caret.setAfter(br1);
                            this.code.sync();
                            return false;
                        }

                        var br2 = document.createElement('br');
                        this.range.insertNode(br2);
                        this.caret.setAfter(br2);
                    }
                    else
                    {
                        this.keydown.insertBreakLineProcessingAfter(br1);
                    }

                    this.code.sync();
                    return false;
                },
                insertBreakLineProcessingAfter: function(node)
                {
                    var space = this.utils.createSpaceElement();
                    $(node).after(space);
                    this.selection.selectElement(space);

                    $(space).replaceWith(function()
                    {
                        return $(this).contents();
                    });
                },
                removeInvisibleSpace: function()
                {
                    var $current = $(this.keydown.current);
                    if ($current.text().search(/^\u200B$/g) === 0)
                    {
                        $current.remove();
                    }
                },
                removeEmptyListInTable: function(e)
                {
                    var $current = $(this.keydown.current);
                    var $parent = $(this.keydown.parent);
                    var td = $current.closest('td');

                    if (td.length !== 0 && $current.closest('li') && $parent.children('li').length === 1)
                    {
                        if (!this.utils.isEmpty($current.text())) return;

                        e.preventDefault();

                        $current.remove();
                        $parent.remove();

                        this.caret.setStart(td);
                    }
                }
            };
        },
        keyup: function()
        {
            return {
                init: function(e)
                {
                    if (this.rtePaste) return;

                    var key = e.which;

                    this.keyup.current = this.selection.getCurrent();
                    this.keyup.parent = this.selection.getParent();
                    var $parent = this.utils.isRedactorParent($(this.keyup.parent).parent());

                    // callback
                    var keyupStop = this.core.setCallback('keyup', e);
                    if (keyupStop === false)
                    {
                        e.preventDefault();
                        return false;
                    }

                    // replace to p before / after the table or body
                    if (!this.opts.linebreaks && this.keyup.current.nodeType == 3 && this.keyup.current.length <= 1 && (this.keyup.parent === false || this.keyup.parent.tagName == 'BODY'))
                    {
                        this.keyup.replaceToParagraph();
                    }

                    // replace div after lists
                    if (!this.opts.linebreaks && this.utils.isRedactorParent(this.keyup.current) && this.keyup.current.tagName === 'DIV')
                    {
                        this.keyup.replaceToParagraph(false);
                    }


                    if (!this.opts.linebreaks && $(this.keyup.parent).hasClass('redactor-invisible-space') && ($parent === false || $parent[0].tagName == 'BODY'))
                    {
                        $(this.keyup.parent).contents().unwrap();
                        this.keyup.replaceToParagraph();
                    }

                    // linkify
                    if (this.keyup.isLinkify(key))
                    {
                        this.formatLinkify(this.opts.linkProtocol, this.opts.convertLinks, this.opts.convertUrlLinks, this.opts.convertImageLinks, this.opts.convertVideoLinks, this.opts.linkSize);

                        this.observe.load();
                        this.code.sync();
                    }

                    if (key === this.keyCode.DELETE || key === this.keyCode.BACKSPACE)
                    {
                        // clear unverified
                        this.clean.clearUnverified();

                        if (this.observe.image)
                        {
                            e.preventDefault();

                            this.image.hideResize();

                            this.buffer.set();
                            this.image.remove(this.observe.image);
                            this.observe.image = false;

                            return false;
                        }

                        // remove empty paragraphs
                        this.$editor.find('p').each($.proxy(this.utils.removeEmpty, this));

                        // remove invisible space
                        if (this.opts.linebreaks && this.keyup.current && this.keyup.current.tagName == 'DIV' && this.utils.isEmpty(this.keyup.current.innerHTML))
                        {
                            $(this.keyup.current).after(this.selection.getMarkerAsHtml());
                            this.selection.restore();
                            $(this.keyup.current).remove();
                        }

                        // if empty
                        return this.keyup.formatEmpty(e);
                    }
                },
                isLinkify: function(key)
                {
                    return this.opts.convertLinks && (this.opts.convertUrlLinks || this.opts.convertImageLinks || this.opts.convertVideoLinks) && key === this.keyCode.ENTER && !this.utils.isCurrentOrParent('PRE');
                },
                replaceToParagraph: function(clone)
                {
                    var $current = $(this.keyup.current);

                    var node;
                    if (clone === false)
                    {
                        node = $('<p>').append($current.html());
                    }
                    else
                    {
                        node = $('<p>').append($current.clone());
                    }

                    $current.replaceWith(node);
                    var next = $(node).next();
                    if (typeof(next[0]) !== 'undefined' && next[0].tagName == 'BR')
                    {
                        next.remove();
                    }

                    this.caret.setEnd(node);
                },
                formatEmpty: function(e)
                {
                    var html = $.trim(this.$editor.html());

                    if (!this.utils.isEmpty(html)) return;

                    e.preventDefault();

                    if (this.opts.linebreaks)
                    {
                        this.$editor.html(this.selection.getMarkerAsHtml());
                        this.selection.restore();
                    }
                    else
                    {
                        html = '<p><br /></p>';

                        this.$editor.html(html);
                        this.focus.setStart();
                    }

                    this.code.sync();

                    return false;
                }
            };
        },
        lang: function()
        {
            return {
                load: function()
                {
                    this.opts.curLang = this.opts.langs[this.opts.lang];
                },
                get: function(name)
                {
                    return (typeof this.opts.curLang[name] != 'undefined') ? this.opts.curLang[name] : '';
                }
            };
        },
        line: function()
        {
            return {
                insert: function()
                {
                    this.buffer.set();

                    var blocks = this.selection.getBlocks();
                    if (blocks[0] !== false && this.line.isExceptLastOrFirst(blocks))
                    {
                        if (!this.utils.browser('msie')) this.$editor.focus();
                        return;
                    }

                    if (this.utils.browser('msie'))
                    {
                        this.line.insertInIe();
                    }
                    else
                    {
                        this.line.insertInOthersBrowsers();
                    }
                },
                isExceptLastOrFirst: function(blocks)
                {
                    var exceptTags = ['li', 'td', 'th', 'blockquote', 'figcaption', 'pre', 'dl', 'dt', 'dd'];

                    var first = blocks[0].tagName.toLowerCase();
                    var last = this.selection.getLastBlock();

                    last = (typeof last == 'undefined') ? first : last.tagName.toLowerCase();

                    var firstFound = $.inArray(first, exceptTags) != -1;
                    var lastFound = $.inArray(last, exceptTags) != -1;

                    if ((firstFound && lastFound) || firstFound)
                    {
                        return true;
                    }
                },
                insertInIe: function()
                {
                    this.utils.saveScroll();
                    this.buffer.set();

                    this.insert.node(document.createElement('hr'));

                    this.utils.restoreScroll();
                    this.code.sync();
                },
                insertInOthersBrowsers: function()
                {
                    this.buffer.set();

                    var extra = '<p id="redactor-insert-line"><br /></p>';
                    if (this.opts.linebreaks) extra = '<br id="redactor-insert-line">';

                    document.execCommand('insertHTML', false, '<hr>' + extra);

                    this.line.setFocus();
                    this.code.sync();
                },
                setFocus: function()
                {
                    var node = this.$editor.find('#redactor-insert-line');
                    var next = $(node).next()[0];

                    if (next)
                    {
                        this.caret.setAfter(node);
                        node.remove();
                    }
                    else
                    {
                        node.removeAttr('id');
                    }
                }
            };
        },
        link: function()
        {
            return {
                show: function(e)
                {
                    if (typeof e != 'undefined' && e.preventDefault) e.preventDefault();

                    this.modal.load('link', this.lang.get('link_insert'), 600);

                    this.modal.createCancelButton();
                    this.link.buttonInsert = this.modal.createActionButton(this.lang.get('insert'));

                    this.selection.get();

                    this.link.getData();
                    this.link.cleanUrl();

                    if (this.link.target == '_blank') $('#redactor-link-blank').prop('checked', true);

                    this.link.$inputUrl = $('#redactor-link-url');
                    this.link.$inputText = $('#redactor-link-url-text');

                    this.link.$inputText.val(this.link.text);
                    this.link.$inputUrl.val(this.link.url);

                    this.link.buttonInsert.on('click', $.proxy(this.link.insert, this));

                    // hide link's tooltip
                    $('.redactor-link-tooltip').remove();

                    // show modal
                    this.selection.save();
                    this.modal.show();
                    this.link.$inputUrl.focus();
                },
                cleanUrl: function()
                {
                    var thref = self.location.href.replace(/\/$/i, '');
                    this.link.url = this.link.url.replace(thref, '');
                    this.link.url = this.link.url.replace(/^\/#/, '#');
                    this.link.url = this.link.url.replace('mailto:', '');

                    // remove host from href
                    if (!this.opts.linkProtocol)
                    {
                        var re = new RegExp('^(http|ftp|https)://' + self.location.host, 'i');
                        this.link.url = this.link.url.replace(re, '');
                    }

                },
                getData: function()
                {
                    this.link.$node = false;

                    var $el = $(this.selection.getCurrent()).closest('a');
                    if ($el.length !== 0 && $el[0].tagName === 'A')
                    {
                        this.link.$node = $el;

                        this.link.url = $el.attr('href');
                        this.link.text = $el.text();
                        this.link.target = $el.attr('target');
                    }
                    else
                    {
                        this.link.text = this.sel.toString();
                        this.link.url = '';
                        this.link.target = '';
                    }

                },
                insert: function()
                {
                    var target = '';
                    var link = this.link.$inputUrl.val();
                    var text = this.link.$inputText.val();

                    if ($.trim(link) === '')
                    {
                        this.link.$inputUrl.addClass('redactor-input-error').on('keyup', function()
                        {
                            $(this).removeClass('redactor-input-error');
                            $(this).off('keyup');

                        });

                        return;
                    }

                    // mailto
                    if (link.search('@') != -1 && /(http|ftp|https):\/\//i.test(link) === false)
                    {
                        link = 'mailto:' + link;
                    }
                    // url, not anchor
                    else if (link.search('#') !== 0)
                    {
                        if ($('#redactor-link-blank').prop('checked'))
                        {
                            target = '_blank';
                        }

                        // test url (add protocol)
                        var pattern = '((xn--)?[a-z0-9]+(-[a-z0-9]+)*\\.)+[a-z]{2,}';
                        var re = new RegExp('^(http|ftp|https)://' + pattern, 'i');
                        var re2 = new RegExp('^' + pattern, 'i');
                        var re3 = new RegExp('\.(html|php)$', 'i');
                        if (link.search(re) == -1 && link.search(re3) == -1 && link.search(re2) === 0 && this.opts.linkProtocol)
                        {
                            link = this.opts.linkProtocol + '://' + link;
                        }
                    }

                    this.link.set(text, link, target);
                    this.modal.close();
                },
                set: function(text, link, target)
                {
                    text = $.trim(text.replace(/<|>/g, ''));

                    this.selection.restore();

                    if (text === '' && link === '') return;
                    if (text === '' && link !== '') text = link;

                    if (this.link.$node)
                    {
                        this.buffer.set();

                        this.link.$node.text(text).attr('href', link);
                        if (target !== '')
                        {
                            this.link.$node.attr('target', target);
                        }
                        else
                        {
                            this.link.$node.removeAttr('target');
                        }

                        this.code.sync();
                    }
                    else
                    {
                        if (this.utils.browser('mozilla') && this.link.text === '')
                        {
                            var $a = $('<a />').attr('href', link).text(text);
                            if (target !== '') $a.attr('target', target);

                            this.insert.node($a);
                            this.selection.selectElement($a);
                        }
                        else
                        {
                            var $a;
                            if (this.utils.browser('msie'))
                            {
                                $a = $('<a href="' + link + '">').text(text);
                                if (target !== '') $a.attr('target', target);

                                $a = $(this.insert.node($a));
                                this.selection.selectElement($a);
                            }
                            else
                            {
                                document.execCommand('createLink', false, link);

                                $a = $(this.selection.getCurrent()).closest('a');
                                if (this.utils.browser('mozilla'))
                                {
                                    $a = $('a[_moz_dirty=""]');
                                }

                                if (target !== '') $a.attr('target', target);
                                $a.removeAttr('style').removeAttr('_moz_dirty');

                                if (this.link.text !== '' || this.link.text != text)
                                {

                                    $a.text(text);
                                    this.selection.selectElement($a);
                                }
                            }
                        }

                        this.code.sync();
                        this.core.setCallback('insertedLink', $a);

                    }

                    // link tooltip
                    setTimeout($.proxy(function()
                    {
                        this.observe.links();

                    }, this), 5);
                },
                unlink: function(e)
                {
                    if (typeof e != 'undefined' && e.preventDefault)
                    {
                        e.preventDefault();
                    }

                    var nodes = this.selection.getNodes();
                    if (!nodes) return;

                    this.buffer.set();

                    var len = nodes.length;
                    for (var i = 0; i < len; i++)
                    {
                        var $node = $(nodes[i]).closest('a');
                        $node.replaceWith($node.contents());
                    }

                    // hide link's tooltip
                    $('.redactor-link-tooltip').remove();

                    this.code.sync();

                },
                toggleClass: function(className)
                {
                    this.link.setClass(className, 'toggleClass');
                },
                addClass: function(className)
                {
                    this.link.setClass(className, 'addClass');
                },
                removeClass: function(className)
                {
                    this.link.setClass(className, 'removeClass');
                },
                setClass: function(className, func)
                {
                    var links = this.selection.getInlinesTags(['a']);
                    if (links === false) return;

                    $.each(links, function()
                    {
                        $(this)[func](className);
                    });
                }
            };
        },
        list: function()
        {
            return {
                toggle: function(cmd)
                {
                    this.placeholder.remove();
                    if (!this.utils.browser('msie')) this.$editor.focus();

                    this.buffer.set();
                    this.selection.save();

                    var parent = this.selection.getParent();
                    var $list = $(parent).closest('ol, ul');

                    if (!this.utils.isRedactorParent($list) && $list.length !== 0)
                    {
                        $list = false;
                    }

                    var isUnorderedCmdOrdered, isOrderedCmdUnordered;
                    var remove = false;
                    if ($list && $list.length)
                    {
                        remove = true;
                        var listTag = $list[0].tagName;

                        isUnorderedCmdOrdered = (cmd === 'orderedlist' && listTag === 'UL');
                        isOrderedCmdUnordered = (cmd === 'unorderedlist' && listTag === 'OL');
                    }

                    if (isUnorderedCmdOrdered)
                    {
                        this.utils.replaceToTag($list, 'ol');
                    }
                    else if (isOrderedCmdUnordered)
                    {
                        this.utils.replaceToTag($list, 'ul');
                    }
                    else
                    {
                        if (remove)
                        {
                            this.list.remove(cmd);
                        }
                        else
                        {
                            this.list.insert(cmd);
                        }
                    }


                    this.selection.restore();
                    this.code.sync();
                },
                insert: function(cmd)
                {
                    var parent = this.selection.getParent();
                    var current = this.selection.getCurrent();
                    var $td = $(current).closest('td, th');

                    if (this.utils.browser('msie') && this.opts.linebreaks)
                    {
                        this.list.insertInIe(cmd);
                    }
                    else
                    {
                        document.execCommand('insert' + cmd);
                    }

                    var $list = $(this.selection.getParent()).closest('ol, ul');

                    if ($td.length !== 0)
                    {
                        var prev = $td.prev();
                        var html = $td.html();
                        $td.html('');
                        if (prev && prev.length === 1 && (prev[0].tagName === 'TD' || prev[0].tagName === 'TH'))
                        {
                            $(prev).after($td);
                        }
                        else
                        {
                            $(parent).prepend($td);
                        }

                        $td.html(html);
                    }

                    if (this.utils.isEmpty($list.find('li').text()))
                    {
                        var $children = $list.children('li');
                        $children.find('br').remove();
                        $children.append(this.selection.getMarkerAsHtml());
                    }

                    if ($list.length)
                    {
                        // remove block-element list wrapper
                        var $listParent = $list.parent();
                        if (this.utils.isRedactorParent($listParent) && $listParent[0].tagName != 'LI' && this.utils.isBlock($listParent[0]))
                        {
                            $listParent.replaceWith($listParent.contents());
                        }
                    }

                    if (!this.utils.browser('msie'))
                    {
                        this.$editor.focus();
                    }

                    this.clean.clearUnverified();
                },
                insertInIe: function(cmd)
                {
                    var wrapper = this.selection.wrap('div');
                    var wrapperHtml = $(wrapper).html();

                    var tmpList = (cmd == 'orderedlist') ? $('<ol>') : $('<ul>');
                    var tmpLi = $('<li>');

                    if ($.trim(wrapperHtml) === '')
                    {
                        tmpLi.append(this.selection.getMarkerAsHtml());
                        tmpList.append(tmpLi);
                        this.$editor.find('#selection-marker-1').replaceWith(tmpList);
                    }
                    else
                    {
                        var items = wrapperHtml.split(/<br\s?\/?>/gi);
                        if (items)
                        {
                            for (var i = 0; i < items.length; i++)
                            {
                                if ($.trim(items[i]) !== '')
                                {
                                    tmpList.append($('<li>').html(items[i]));
                                }
                            }
                        }
                        else
                        {
                            tmpLi.append(wrapperHtml);
                            tmpList.append(tmpLi);
                        }

                        $(wrapper).replaceWith(tmpList);
                    }
                },
                remove: function(cmd)
                {
                    document.execCommand('insert' + cmd);

                    var $current = $(this.selection.getCurrent());

                    this.indent.fixEmptyIndent();

                    if (!this.opts.linebreaks && $current.closest('li, th, td').length === 0)
                    {
                        document.execCommand('formatblock', false, 'p');
                        this.$editor.find('ul, ol, blockquote').each($.proxy(this.utils.removeEmpty, this));
                    }

                    var $table = $(this.selection.getCurrent()).closest('table');
                    var $prev = $table.prev();
                    if (!this.opts.linebreaks && $table.length !== 0 && $prev.length !== 0 && $prev[0].tagName == 'BR')
                    {
                        $prev.remove();
                    }

                    this.clean.clearUnverified();

                }
            };
        },
        modal: function()
        {
            return {
                callbacks: {},
                loadTemplates: function()
                {
                    this.opts.modal = {
                        imageEdit: String()
                        + '<section id="redactor-modal-image-edit">'
                            + '<label>' + this.lang.get('title') + '</label>'
                            + '<input type="text" id="redactor-image-title" />'
                            + '<label class="redactor-image-link-option">' + this.lang.get('link') + '</label>'
                            + '<input type="text" id="redactor-image-link" class="redactor-image-link-option" />'
                            + '<label class="redactor-image-link-option"><input type="checkbox" id="redactor-image-link-blank"> ' + this.lang.get('link_new_tab') + '</label>'
                            + '<label class="redactor-image-position-option">' + this.lang.get('image_position') + '</label>'
                            + '<select class="redactor-image-position-option" id="redactor-image-align">'
                                + '<option value="none">' + this.lang.get('none') + '</option>'
                                + '<option value="left">' + this.lang.get('left') + '</option>'
                                + '<option value="center">' + this.lang.get('center') + '</option>'
                                + '<option value="right">' + this.lang.get('right') + '</option>'
                            + '</select>'
                            + '<label>Full Screen Width</label>'
                            + '<input type="checkbox" id="redactor-image-full-screen-width" />'
                        + '</section>',

                        image: String()
                        + '<section id="redactor-modal-image-insert">'
                            + '<div id="redactor-modal-image-droparea"></div>'
                        + '</section>',

                        file: String()
                        + '<section id="redactor-modal-file-insert">'
                            + '<div id="redactor-modal-file-upload-box">'
                                + '<label>' + this.lang.get('filename') + '</label>'
                                + '<input type="text" id="redactor-filename" /><br><br>'
                                + '<div id="redactor-modal-file-upload"></div>'
                            + '</div>'
                        + '</section>',

                        link: String()
                        + '<section id="redactor-modal-link-insert">'
                            + '<label>URL</label>'
                            + '<input type="url" id="redactor-link-url" />'
                            + '<label>' + this.lang.get('text') + '</label>'
                            + '<input type="text" id="redactor-link-url-text" />'
                            + '<label><input type="checkbox" id="redactor-link-blank"> ' + this.lang.get('link_new_tab') + '</label>'
                        + '</section>'
                    };


                    $.extend(this.opts, this.opts.modal);

                },
                addCallback: function(name, callback)
                {
                    this.modal.callbacks[name] = callback;
                },
                createTabber: function($modal)
                {
                    this.modal.$tabber = $('<div>').attr('id', 'redactor-modal-tabber');

                    $modal.prepend(this.modal.$tabber);
                },
                addTab: function(id, name, active)
                {
                    var $tab = $('<a href="#" rel="tab' + id + '">').text(name);
                    if (active)
                    {
                        $tab.addClass('active');
                    }

                    var self = this;
                    $tab.on('click', function(e)
                    {
                        e.preventDefault();
                        $('.redactor-tab').hide();
                        $('.redactor-' + $(this).attr('rel')).show();

                        self.modal.$tabber.find('a').removeClass('active');
                        $(this).addClass('active');

                    });

                    this.modal.$tabber.append($tab);
                },
                addTemplate: function(name, template)
                {
                    this.opts.modal[name] = template;
                },
                getTemplate: function(name)
                {
                    return this.opts.modal[name];
                },
                getModal: function()
                {
                    return this.$modalBody.find('section');
                },
                load: function(templateName, title, width)
                {
                    this.modal.templateName = templateName;
                    this.modal.width = width;

                    this.modal.build();
                    this.modal.enableEvents();
                    this.modal.setTitle(title);
                    this.modal.setDraggable();
                    this.modal.setContent();

                    // callbacks
                    if (typeof this.modal.callbacks[templateName] != 'undefined')
                    {
                        this.modal.callbacks[templateName].call(this);
                    }

                },
                show: function()
                {
                    // ios keyboard hide
                    if (this.utils.isMobile() && !this.utils.browser('msie'))
                    {
                        document.activeElement.blur();
                    }

                    $(document.body).removeClass('body-redactor-hidden');
                    this.modal.bodyOveflow = $(document.body).css('overflow');
                    $(document.body).css('overflow', 'hidden');

                    if (this.utils.isMobile())
                    {
                        this.modal.showOnMobile();
                    }
                    else
                    {
                        this.modal.showOnDesktop();
                    }

                    this.$modalOverlay.show();
                    this.$modalBox.show();

                    this.modal.setButtonsWidth();

                    this.utils.saveScroll();

                    // resize
                    if (!this.utils.isMobile())
                    {
                        setTimeout($.proxy(this.modal.showOnDesktop, this), 0);
                        $(window).on('resize.redactor-modal', $.proxy(this.modal.resize, this));
                    }

                    // modal shown callback
                    this.core.setCallback('modalOpened', this.modal.templateName, this.$modal);

                    // fix bootstrap modal focus
                    $(document).off('focusin.modal');

                    // enter
                    this.$modal.find('input[type=text],input[type=url],input[type=email]').on('keydown.redactor-modal', $.proxy(this.modal.setEnter, this));
                },
                showOnDesktop: function()
                {
                    var height = this.$modal.outerHeight();
                    var windowHeight = $(window).height();
                    var windowWidth = $(window).width();

                    if (this.modal.width > windowWidth)
                    {
                        this.$modal.css({
                            width: '96%',
                            marginTop: (windowHeight/2 - height/2) + 'px'
                        });
                        return;
                    }

                    if (height > windowHeight)
                    {
                        this.$modal.css({
                            width: this.modal.width + 'px',
                            marginTop: '20px'
                        });
                    }
                    else
                    {
                        this.$modal.css({
                            width: this.modal.width + 'px',
                            marginTop: (windowHeight/2 - height/2) + 'px'
                        });
                    }
                },
                showOnMobile: function()
                {
                    this.$modal.css({
                        width: '96%',
                        marginTop: '2%'
                    });

                },
                resize: function()
                {
                    if (this.utils.isMobile())
                    {
                        this.modal.showOnMobile();
                    }
                    else
                    {
                        this.modal.showOnDesktop();
                    }
                },
                setTitle: function(title)
                {
                    this.$modalHeader.html(title);
                },
                setContent: function()
                {
                    this.$modalBody.html(this.modal.getTemplate(this.modal.templateName));
                },
                setDraggable: function()
                {
                    if (typeof $.fn.draggable === 'undefined') return;

                    this.$modal.draggable({ handle: this.$modalHeader });
                    this.$modalHeader.css('cursor', 'move');
                },
                setEnter: function(e)
                {
                    if (e.which != 13) return;

                    e.preventDefault();
                    this.$modal.find('button.redactor-modal-action-btn').click();
                },
                createCancelButton: function()
                {
                    var button = $('<button>').addClass('redactor-modal-btn redactor-modal-close-btn').html(this.lang.get('cancel'));
                    button.on('click', $.proxy(this.modal.close, this));

                    this.$modalFooter.append(button);
                },
                createDeleteButton: function(label)
                {
                    return this.modal.createButton(label, 'delete');
                },
                createActionButton: function(label)
                {
                    return this.modal.createButton(label, 'action');
                },
                createButton: function(label, className)
                {
                    var button = $('<button>').addClass('redactor-modal-btn').addClass('redactor-modal-' + className + '-btn').html(label);
                    this.$modalFooter.append(button);

                    return button;
                },
                setButtonsWidth: function()
                {
                    var buttons = this.$modalFooter.find('button');
                    var buttonsSize = buttons.length;
                    if (buttonsSize === 0) return;

                    buttons.css('width', (100/buttonsSize) + '%');
                },
                build: function()
                {
                    this.modal.buildOverlay();

                    this.$modalBox = $('<div id="redactor-modal-box" />').hide();
                    this.$modal = $('<div id="redactor-modal" />');
                    this.$modalHeader = $('<header />');
                    this.$modalClose = $('<span id="redactor-modal-close" />').html('&times;');
                    this.$modalBody = $('<div id="redactor-modal-body" />');
                    this.$modalFooter = $('<footer />');

                    this.$modal.append(this.$modalHeader);
                    this.$modal.append(this.$modalClose);
                    this.$modal.append(this.$modalBody);
                    this.$modal.append(this.$modalFooter);
                    this.$modalBox.append(this.$modal);
                    this.$modalBox.appendTo(document.body);
                },
                buildOverlay: function()
                {
                    this.$modalOverlay = $('<div id="redactor-modal-overlay">').hide();
                    $('body').prepend(this.$modalOverlay);
                },
                enableEvents: function()
                {
                    this.$modalClose.on('click.redactor-modal', $.proxy(this.modal.close, this));
                    $(document).on('keyup.redactor-modal', $.proxy(this.modal.closeHandler, this));
                    this.$editor.on('keyup.redactor-modal', $.proxy(this.modal.closeHandler, this));
                    this.$modalBox.on('click.redactor-modal', $.proxy(this.modal.close, this));
                },
                disableEvents: function()
                {
                    this.$modalClose.off('click.redactor-modal');
                    $(document).off('keyup.redactor-modal');
                    this.$editor.off('keyup.redactor-modal');
                    this.$modalBox.off('click.redactor-modal');
                    $(window).off('resize.redactor-modal');
                },
                closeHandler: function(e)
                {
                    if (e.which != this.keyCode.ESC) return;

                    this.modal.close(false);
                },
                close: function(e)
                {
                    if (e)
                    {
                        if (!$(e.target).hasClass('redactor-modal-close-btn') && e.target != this.$modalClose[0] && e.target != this.$modalBox[0])
                        {
                            return;
                        }

                        e.preventDefault();
                    }

                    if (!this.$modalBox) return;

                    this.modal.disableEvents();

                    this.$modalOverlay.remove();

                    this.$modalBox.fadeOut('fast', $.proxy(function()
                    {
                        this.$modalBox.remove();

                        setTimeout($.proxy(this.utils.restoreScroll, this), 0);

                        if (e !== undefined) this.selection.restore();

                        $(document.body).css('overflow', this.modal.bodyOveflow);
                        this.core.setCallback('modalClosed', this.modal.templateName);

                    }, this));

                }
            };
        },
        observe: function()
        {
            return {
                load: function()
                {
                    this.observe.images();
                    this.observe.links();
                },
                buttons: function(e, btnName)
                {
                    var current = this.selection.getCurrent();
                    var parent = this.selection.getParent();

                    if (e !== false)
                    {
                        this.button.setInactiveAll();
                    }
                    else
                    {
                        this.button.setInactiveAll(btnName);
                    }

                    if (e === false && btnName !== 'html')
                    {
                        if ($.inArray(btnName, this.opts.activeButtons) != -1) this.button.toggleActive(btnName);
                        return;
                    }

                    //var linkButtonName = (this.utils.isCurrentOrParent('A')) ? this.lang.get('link_edit') : this.lang.get('link_insert');
                    //$('body').find('a.redactor-dropdown-link').text(linkButtonName);

                    $.each(this.opts.activeButtonsStates, $.proxy(function(key, value)
                    {
                        var parentEl = $(parent).closest(key);
                        var currentEl = $(current).closest(key);

                        if (parentEl.length !== 0 && !this.utils.isRedactorParent(parentEl)) return;
                        if (!this.utils.isRedactorParent(currentEl)) return;
                        if (parentEl.length !== 0 || currentEl.closest(key).length !== 0)
                        {
                            this.button.setActive(value);
                        }

                    }, this));

                    var $parent = $(parent).closest(this.opts.alignmentTags.toString().toLowerCase());
                    if (this.utils.isRedactorParent(parent) && $parent.length)
                    {
                        var align = ($parent.css('text-align') === '') ? 'left' : $parent.css('text-align');
                        this.button.setActive('align' + align);
                    }
                },
                addButton: function(tag, btnName)
                {
                    this.opts.activeButtons.push(btnName);
                    this.opts.activeButtonsStates[tag] = btnName;
                },
                images: function()
                {
                    this.$editor.find('img').each($.proxy(function(i, img)
                    {
                        var $img = $(img);

                        // IE fix (when we clicked on an image and then press backspace IE does goes to image's url)
                        $img.closest('a').on('click', function(e) { e.preventDefault(); });

                        if (this.utils.browser('msie')) $img.attr('unselectable', 'on');

                        this.image.setEditable($img);

                    }, this));

                    $(document).on('click.redactor-image-delete.' + this.uuid, $.proxy(function(e)
                    {
                        this.observe.image = false;
                        if (e.target.tagName == 'IMG' && this.utils.isRedactorParent(e.target))
                        {
                            this.observe.image = (this.observe.image && this.observe.image == e.target) ? false : e.target;
                        }

                    }, this));

                },
                links: function()
                {
                    if (!this.opts.linkTooltip) return;

                    this.$editor.find('a').on('touchstart.redactor.' + this.uuid + ' click.redactor.' + this.uuid, $.proxy(this.observe.showTooltip, this));
                    this.$editor.on('touchstart.redactor.' + this.uuid + ' click.redactor.' + this.uuid, $.proxy(this.observe.closeTooltip, this));
                    $(document).on('touchstart.redactor.' + this.uuid + ' click.redactor.' + this.uuid, $.proxy(this.observe.closeTooltip, this));
                },
                getTooltipPosition: function($link)
                {
                    return $link.offset();
                },
                showTooltip: function(e)
                {
                    var $link = $(e.target);
                    var $parent = $link.closest('a');
                    var tag = ($link.length !== 0) ? $link[0].tagName : false;

                    if ($parent[0].tagName === 'A')
                    {
                        if (tag === 'IMG') return;
                        else if (tag !== 'A') $link = $parent;
                    }

                    if (tag !== 'A')
                    {
                        return;
                    }

                    var pos = this.observe.getTooltipPosition($link);
                    var tooltip = $('<span class="redactor-link-tooltip"></span>');

                    var href = $link.attr('href');
                    if (href === undefined)
                    {
                        href = '';
                    }

                    if (href.length > 24) href = href.substring(0, 24) + '...';

                    var aLink = $('<a href="' + $link.attr('href') + '" target="_blank" />').html(href).addClass('redactor-link-tooltip-action');
                    var aEdit = $('<a href="#" />').html(this.lang.get('edit')).on('click', $.proxy(this.link.show, this)).addClass('redactor-link-tooltip-action');
                    var aUnlink = $('<a href="#" />').html(this.lang.get('unlink')).on('click', $.proxy(this.link.unlink, this)).addClass('redactor-link-tooltip-action');

                    tooltip.append(aLink).append(' | ').append(aEdit).append(' | ').append(aUnlink);
                    tooltip.css({
                        top: (pos.top + parseInt($link.css('line-height'), 10)) + 'px',
                        left: pos.left + 'px'
                    });

                    $('.redactor-link-tooltip').remove();
                    $('body').append(tooltip);
                },
                closeTooltip: function(e)
                {
                    e = e.originalEvent || e;

                    var target = e.target;
                    var $parent = $(target).closest('a');
                    if ($parent.length !== 0 && $parent[0].tagName === 'A' && target.tagName !== 'A')
                    {
                        return;
                    }
                    else if ((target.tagName === 'A' && this.utils.isRedactorParent(target)) || $(target).hasClass('redactor-link-tooltip-action'))
                    {
                        return;
                    }

                    $('.redactor-link-tooltip').remove();
                }

            };
        },
        paragraphize: function()
        {
            return {
                load: function(html)
                {
                    if (this.opts.linebreaks) return html;
                    if (html === '' || html === '<p></p>') return this.opts.emptyHtml;

                    this.paragraphize.blocks = ['table', 'div', 'pre', 'form', 'ul', 'ol', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'dl', 'blockquote', 'figcaption',
                    'address', 'section', 'header', 'footer', 'aside', 'article', 'object', 'style', 'script', 'iframe', 'select', 'input', 'textarea',
                    'button', 'option', 'map', 'area', 'math', 'hr', 'fieldset', 'legend', 'hgroup', 'nav', 'figure', 'details', 'menu', 'summary', 'p'];

                    html = html + "\n";

                    this.paragraphize.safes = [];
                    this.paragraphize.z = 0;

                    html = html.replace(/(<br\s?\/?>){1,}\n?<\/blockquote>/gi, '</blockquote>');

                    html = this.paragraphize.getSafes(html);
                    html = this.paragraphize.getSafesComments(html);
                    html = this.paragraphize.replaceBreaksToNewLines(html);
                    html = this.paragraphize.replaceBreaksToParagraphs(html);
                    html = this.paragraphize.clear(html);
                    html = this.paragraphize.restoreSafes(html);

                    html = html.replace(new RegExp('<br\\s?/?>\n?<(' + this.paragraphize.blocks.join('|') + ')(.*?[^>])>', 'gi'), '<p><br /></p>\n<$1$2>');

                    return $.trim(html);
                },
                getSafes: function(html)
                {
                    var $div = $('<div />').append(html);

                    // remove paragraphs in blockquotes
                    $div.find('blockquote p').replaceWith(function()
                    {
                        return $(this).append('<br />').contents();
                    });

                    html = $div.html();

                    $div.find(this.paragraphize.blocks.join(', ')).each($.proxy(function(i,s)
                    {
                        this.paragraphize.z++;
                        this.paragraphize.safes[this.paragraphize.z] = s.outerHTML;
                        html = html.replace(s.outerHTML, '\n{replace' + this.paragraphize.z + '}');

                    }, this));

                    return html;
                },
                getSafesComments: function(html)
                {
                    var commentsMatches = html.match(/<!--([\w\W]*?)-->/gi);

                    if (!commentsMatches) return html;

                    $.each(commentsMatches, $.proxy(function(i,s)
                    {
                        this.paragraphize.z++;
                        this.paragraphize.safes[this.paragraphize.z] = s;
                        html = html.replace(s, '\n{replace' + this.paragraphize.z + '}');
                    }, this));

                    return html;
                },
                restoreSafes: function(html)
                {
                    $.each(this.paragraphize.safes, function(i,s)
                    {
                        s = (typeof s !== 'undefined') ? s.replace(/\$/g, '&#36;') : s;
                        html = html.replace('{replace' + i + '}', s);

                    });

                    return html;
                },
                replaceBreaksToParagraphs: function(html)
                {
                    var htmls = html.split(new RegExp('\n', 'g'), -1);

                    html = '';
                    if (htmls)
                    {
                        var len = htmls.length;
                        for (var i = 0; i < len; i++)
                        {
                            if (!htmls.hasOwnProperty(i)) return;

                            if (htmls[i].search('{replace') == -1)
                            {
                                htmls[i] = htmls[i].replace(/<p>\n\t?<\/p>/gi, '');
                                htmls[i] = htmls[i].replace(/<p><\/p>/gi, '');

                                if (htmls[i] !== '')
                                {
                                    html += '<p>' +  htmls[i].replace(/^\n+|\n+$/g, "") + "</p>";
                                }
                            }
                            else html += htmls[i];
                        }
                    }

                    return html;
                },
                replaceBreaksToNewLines: function(html)
                {
                    html = html.replace(/<br \/>\s*<br \/>/gi, "\n\n");
                    html = html.replace(/<br\s?\/?>\n?<br\s?\/?>/gi, "\n<br /><br />");

                    html = html.replace(new RegExp("\r\n", 'g'), "\n");
                    html = html.replace(new RegExp("\r", 'g'), "\n");
                    html = html.replace(new RegExp("/\n\n+/"), 'g', "\n\n");

                    return html;
                },
                clear: function(html)
                {
                    html = html.replace(new RegExp('</blockquote></p>', 'gi'), '</blockquote>');
                    html = html.replace(new RegExp('<p></blockquote>', 'gi'), '</blockquote>');
                    html = html.replace(new RegExp('<p><blockquote>', 'gi'), '<blockquote>');
                    html = html.replace(new RegExp('<blockquote></p>', 'gi'), '<blockquote>');

                    html = html.replace(new RegExp('<p><p ', 'gi'), '<p ');
                    html = html.replace(new RegExp('<p><p>', 'gi'), '<p>');
                    html = html.replace(new RegExp('</p></p>', 'gi'), '</p>');
                    html = html.replace(new RegExp('<p>\\s?</p>', 'gi'), '');
                    html = html.replace(new RegExp("\n</p>", 'gi'), '</p>');
                    html = html.replace(new RegExp('<p>\t?\t?\n?<p>', 'gi'), '<p>');
                    html = html.replace(new RegExp('<p>\t*</p>', 'gi'), '');

                    return html;
                }
            };
        },
        paste: function()
        {
            return {
                init: function(e)
                {
                    if (!this.opts.cleanOnPaste)
                    {
                        setTimeout($.proxy(this.code.sync, this), 1);
                        return;
                    }

                    this.rtePaste = true;

                    this.buffer.set();
                    this.selection.save();
                    this.utils.saveScroll();

                    this.paste.createPasteBox();

                    $(window).on('scroll.redactor-freeze', $.proxy(function()
                    {
                        $(window).scrollTop(this.saveBodyScroll);

                    }, this));

                    setTimeout($.proxy(function()
                    {
                        var html = this.$pasteBox.html();

                        this.$pasteBox.remove();

                        this.selection.restore();
                        this.utils.restoreScroll();

                        this.paste.insert(html);

                        $(window).off('scroll.redactor-freeze');

                    }, this), 1);

                },
                createPasteBox: function()
                {
                    this.$pasteBox = $('<div>').html('').attr('contenteditable', 'true').css({ position: 'fixed', width: 0, top: 0, left: '-9999px' });

                    if (this.utils.browser('msie'))
                    {
                        this.$box.append(this.$pasteBox);
                    }
                    else
                    {
                        $('body').append(this.$pasteBox);
                    }

                    this.$pasteBox.focus();
                },
                insert: function(html)
                {
                    html = this.core.setCallback('pasteBefore', html);

                    // clean
                    html = (this.utils.isSelectAll()) ? this.clean.onPaste(html, false) : this.clean.onPaste(html);

                    html = this.core.setCallback('paste', html);

                    if (this.utils.isSelectAll())
                    {
                        this.insert.set(html, false);
                    }
                    else
                    {
                        this.insert.html(html, false);
                    }

                    this.utils.disableSelectAll();
                    this.rtePaste = false;

                    setTimeout($.proxy(this.clean.clearUnverified, this), 10);

                    // clean empty spans
                    setTimeout($.proxy(function()
                    {
                        var spans = this.$editor.find('span');
                        $.each(spans, function(i,s)
                        {
                            var html = s.innerHTML.replace(/[\u200B-\u200D\uFEFF]/, '');
                            if (html === '' && s.attributes.length === 0) $(s).remove();

                        });

                    }, this), 10);
                }
            };
        },
        placeholder: function()
        {
            return {
                enable: function()
                {
                    if (!this.placeholder.is()) return;

                    this.$editor.attr('placeholder', this.$element.attr('placeholder'));

                    this.placeholder.toggle();
                    this.$editor.on('keyup.redactor-placeholder', $.proxy(this.placeholder.toggle, this));

                },
                toggle: function()
                {
                    var func = 'removeClass';
                    if (this.utils.isEmpty(this.$editor.html(), false)) func = 'addClass';
                    this.$editor[func]('redactor-placeholder');
                },
                remove: function()
                {
                    this.$editor.removeClass('redactor-placeholder');
                },
                is: function()
                {
                    if (this.opts.placeholder)
                    {
                        return this.$element.attr('placeholder', this.opts.placeholder);
                    }
                    else
                    {
                        return !(typeof this.$element.attr('placeholder') == 'undefined' || this.$element.attr('placeholder') === '');
                    }
                }
            };
        },
        progress: function()
        {
            return {
                show: function()
                {
                    $(document.body).append($('<div id="redactor-progress"><span></span></div>'));
                    $('#redactor-progress').fadeIn();
                },
                hide: function()
                {
                    $('#redactor-progress').fadeOut(1500, function()
                    {
                        $(this).remove();
                    });
                }

            };
        },
        selection: function()
        {
            return {
                get: function()
                {
                    this.sel = document.getSelection();

                    if (document.getSelection && this.sel.getRangeAt && this.sel.rangeCount)
                    {
                        this.range = this.sel.getRangeAt(0);
                    }
                    else
                    {
                        this.range = document.createRange();
                    }
                },
                addRange: function()
                {
                    try {
                        this.sel.removeAllRanges();
                    } catch (e) {}

                    this.sel.addRange(this.range);
                },
                getCurrent: function()
                {
                    var el = false;
                    this.selection.get();

                    if (this.sel && this.sel.rangeCount > 0)
                    {
                        el = this.sel.getRangeAt(0).startContainer;
                    }

                    return this.utils.isRedactorParent(el);
                },
                getParent: function(elem)
                {
                    elem = elem || this.selection.getCurrent();
                    if (elem)
                    {
                        return this.utils.isRedactorParent($(elem).parent()[0]);
                    }

                    return false;
                },
                getBlock: function(node)
                {
                    node = node || this.selection.getCurrent();

                    while (node)
                    {
                        if (this.utils.isBlockTag(node.tagName))
                        {
                            return ($(node).hasClass('redactor-editor')) ? false : node;
                        }

                        node = node.parentNode;
                    }

                    return false;
                },
                getInlines: function(nodes, tags)
                {
                    this.selection.get();

                    if (this.range && this.range.collapsed)
                    {
                        return false;
                    }

                    var inlines = [];
                    nodes = (typeof nodes == 'undefined' || nodes === false) ? this.selection.getNodes() : nodes;
                    var inlineTags = this.opts.inlineTags;
                    inlineTags.push('span');

                    if (typeof tags !== 'undefined')
                    {
                        for (var i = 0; i < tags.length; i++)
                        {
                            inlineTags.push(tags[i]);
                        }
                    }

                    $.each(nodes, $.proxy(function(i,node)
                    {
                        if ($.inArray(node.tagName.toLowerCase(), inlineTags) != -1)
                        {
                            inlines.push(node);
                        }

                    }, this));

                    return (inlines.length === 0) ? false : inlines;
                },
                getInlinesTags: function(tags)
                {
                    this.selection.get();

                    if (this.range && this.range.collapsed)
                    {
                        return false;
                    }

                    var inlines = [];
                    var nodes =  this.selection.getNodes();
                    $.each(nodes, $.proxy(function(i,node)
                    {
                        if ($.inArray(node.tagName.toLowerCase(), tags) != -1)
                        {
                            inlines.push(node);
                        }

                    }, this));

                    return (inlines.length === 0) ? false : inlines;
                },
                getBlocks: function(nodes)
                {
                    this.selection.get();

                    if (this.range && this.range.collapsed)
                    {
                        return [this.selection.getBlock()];
                    }

                    var blocks = [];
                    nodes = (typeof nodes == 'undefined') ? this.selection.getNodes() : nodes;
                    $.each(nodes, $.proxy(function(i,node)
                    {
                        if (this.utils.isBlock(node))
                        {
                            this.selection.lastBlock = node;
                            blocks.push(node);
                        }

                    }, this));

                    return (blocks.length === 0) ? [this.selection.getBlock()] : blocks;
                },
                getLastBlock: function()
                {
                    return this.selection.lastBlock;
                },
                getNodes: function()
                {
                    this.selection.get();

                    var startNode = this.selection.getNodesMarker(1);
                    var endNode = this.selection.getNodesMarker(2);
                    var range = this.range.cloneRange();

                    if (this.range.collapsed === false)
                    {
                        var startContainer = range.startContainer;
                        var startOffset = range.startOffset;

                        // end marker
                        this.selection.setNodesMarker(range, endNode, false);

                        // start marker
                        range.setStart(startContainer, startOffset);
                        this.selection.setNodesMarker(range, startNode, true);
                    }
                    else
                    {
                        this.selection.setNodesMarker(range, startNode, true);
                        endNode = startNode;
                    }

                    var nodes = [];
                    var counter = 0;

                    var self = this;
                    this.$editor.find('*').each(function()
                    {
                        if (this == startNode)
                        {
                            var parent = $(this).parent();
                            if (parent.length !== 0 && parent[0].tagName != 'BODY' && self.utils.isRedactorParent(parent[0]))
                            {
                                nodes.push(parent[0]);
                            }

                            nodes.push(this);
                            counter = 1;
                        }
                        else
                        {
                            if (counter > 0)
                            {
                                nodes.push(this);
                                counter = counter + 1;
                            }
                        }

                        if (this == endNode)
                        {
                            return false;
                        }

                    });

                    var finalNodes = [];
                    var len = nodes.length;
                    for (var i = 0; i < len; i++)
                    {
                        if (nodes[i].id != 'nodes-marker-1' && nodes[i].id != 'nodes-marker-2')
                        {
                            finalNodes.push(nodes[i]);
                        }
                    }

                    this.selection.removeNodesMarkers();

                    return finalNodes;

                },
                getNodesMarker: function(num)
                {
                    return $('<span id="nodes-marker-' + num + '" class="redactor-nodes-marker" data-verified="redactor">' + this.opts.invisibleSpace + '</span>')[0];
                },
                setNodesMarker: function(range, node, type)
                {
                    try {
                        range.collapse(type);
                        range.insertNode(node);
                    }
                    catch (e) {}
                },
                removeNodesMarkers: function()
                {
                    $(document).find('span.redactor-nodes-marker').remove();
                    this.$editor.find('span.redactor-nodes-marker').remove();
                },
                fromPoint: function(start, end)
                {
                    this.caret.setOffset(start, end);
                },
                wrap: function(tag)
                {
                    this.selection.get();

                    if (this.range.collapsed) return false;

                    var wrapper = document.createElement(tag);
                    wrapper.appendChild(this.range.extractContents());
                    this.range.insertNode(wrapper);

                    return wrapper;
                },
                selectElement: function(node)
                {
                    this.caret.set(node, 0, node, 1);
                },
                selectAll: function()
                {
                    this.selection.get();
                    this.range.selectNodeContents(this.$editor[0]);
                    this.selection.addRange();
                },
                remove: function()
                {
                    this.selection.get();
                    this.sel.removeAllRanges();
                },
                save: function()
                {
                    this.selection.createMarkers();
                },
                createMarkers: function()
                {
                    this.selection.get();

                    var node1 = this.selection.getMarker(1);

                    this.selection.setMarker(this.range, node1, true);

                    if (this.range.collapsed === false)
                    {
                        var node2 = this.selection.getMarker(2);
                        this.selection.setMarker(this.range, node2, false);
                    }

                    this.savedSel = this.$editor.html();
                },
                getMarker: function(num)
                {
                    if (typeof num == 'undefined') num = 1;

                    return $('<span id="selection-marker-' + num + '" class="redactor-selection-marker"  data-verified="redactor">' + this.opts.invisibleSpace + '</span>')[0];
                },
                getMarkerAsHtml: function(num)
                {
                    return this.utils.getOuterHtml(this.selection.getMarker(num));
                },
                setMarker: function(range, node, type)
                {
                    range = range.cloneRange();

                    try {
                        range.collapse(type);
                        range.insertNode(node);
                    }
                    catch (e)
                    {
                        this.focus.setStart();
                    }
                },
                restore: function()
                {
                    var node1 = this.$editor.find('span#selection-marker-1');
                    var node2 = this.$editor.find('span#selection-marker-2');

                    if (node1.length !== 0 && node2.length !== 0)
                    {
                        this.caret.set(node1, 0, node2, 0);
                    }
                    else if (node1.length !== 0)
                    {
                        this.caret.set(node1, 0, node1, 0);
                    }
                    else
                    {
                        this.$editor.focus();
                    }

                    this.selection.removeMarkers();
                    this.savedSel = false;

                },
                removeMarkers: function()
                {
                    this.$editor.find('span.redactor-selection-marker').each(function(i,s)
                    {
                        var text = $(s).text().replace(/[\u200B-\u200D\uFEFF]/g, '');
                        if (text === '') $(s).remove();
                        else $(s).replaceWith(function() { return $(this).contents(); });
                    });
                },
                getText: function()
                {
                    this.selection.get();

                    return this.sel.toString();
                },
                getHtml: function()
                {
                    var html = '';

                    this.selection.get();
                    if (this.sel.rangeCount)
                    {
                        var container = document.createElement('div');
                        var len = this.sel.rangeCount;
                        for (var i = 0; i < len; ++i)
                        {
                            container.appendChild(this.sel.getRangeAt(i).cloneContents());
                        }

                        html = container.innerHTML;
                    }

                    return this.clean.onSync(html);
                },
                replaceWithHtml: function(html)
                {
                    html = this.selection.getMarkerAsHtml(1) + html + this.selection.getMarkerAsHtml(2);

                    this.selection.get();

                    if (window.getSelection && window.getSelection().getRangeAt)
                    {
                        this.range.deleteContents();
                        var div = document.createElement("div");
                        div.innerHTML = html;

                        var frag = document.createDocumentFragment(), child;
                        while ((child = div.firstChild))
                        {
                            frag.appendChild(child);
                        }

                        this.range.insertNode(frag);
                    }
                    else if (document.selection && document.selection.createRange)
                    {
                        this.range.pasteHTML(html);
                    }

                    this.selection.restore();
                    this.code.sync();
                }
            };
        },
        shortcuts: function()
        {
            return {
                init: function(e, key)
                {
                    // disable browser's hot keys for bold and italic
                    if (!this.opts.shortcuts)
                    {
                        if ((e.ctrlKey || e.metaKey) && (key === 66 || key === 73)) e.preventDefault();
                        return false;
                    }

                    $.each(this.opts.shortcuts, $.proxy(function(str, command)
                    {
                        var keys = str.split(',');
                        var len = keys.length;
                        for (var i = 0; i < len; i++)
                        {
                            if (typeof keys[i] === 'string')
                            {
                                this.shortcuts.handler(e, $.trim(keys[i]), $.proxy(function()
                                {
                                    var func;
                                    if (command.func.search(/\./) != '-1')
                                    {
                                        func = command.func.split('.');
                                        if (typeof this[func[0]] != 'undefined')
                                        {
                                            this[func[0]][func[1]].apply(this, command.params);
                                        }
                                    }
                                    else
                                    {
                                        this[command.func].apply(this, command.params);
                                    }

                                }, this));
                            }

                        }

                    }, this));
                },
                handler: function(e, keys, origHandler)
                {
                    // based on https://github.com/jeresig/jquery.hotkeys
                    var hotkeysSpecialKeys =
                    {
                        8: "backspace", 9: "tab", 10: "return", 13: "return", 16: "shift", 17: "ctrl", 18: "alt", 19: "pause",
                        20: "capslock", 27: "esc", 32: "space", 33: "pageup", 34: "pagedown", 35: "end", 36: "home",
                        37: "left", 38: "up", 39: "right", 40: "down", 45: "insert", 46: "del", 59: ";", 61: "=",
                        96: "0", 97: "1", 98: "2", 99: "3", 100: "4", 101: "5", 102: "6", 103: "7",
                        104: "8", 105: "9", 106: "*", 107: "+", 109: "-", 110: ".", 111 : "/",
                        112: "f1", 113: "f2", 114: "f3", 115: "f4", 116: "f5", 117: "f6", 118: "f7", 119: "f8",
                        120: "f9", 121: "f10", 122: "f11", 123: "f12", 144: "numlock", 145: "scroll", 173: "-", 186: ";", 187: "=",
                        188: ",", 189: "-", 190: ".", 191: "/", 192: "`", 219: "[", 220: "\\", 221: "]", 222: "'"
                    };


                    var hotkeysShiftNums =
                    {
                        "`": "~", "1": "!", "2": "@", "3": "#", "4": "$", "5": "%", "6": "^", "7": "&",
                        "8": "*", "9": "(", "0": ")", "-": "_", "=": "+", ";": ": ", "'": "\"", ",": "<",
                        ".": ">",  "/": "?",  "\\": "|"
                    };

                    keys = keys.toLowerCase().split(" ");
                    var special = hotkeysSpecialKeys[e.keyCode],
                        character = String.fromCharCode( e.which ).toLowerCase(),
                        modif = "", possible = {};

                    $.each([ "alt", "ctrl", "meta", "shift"], function(index, specialKey)
                    {
                        if (e[specialKey + 'Key'] && special !== specialKey)
                        {
                            modif += specialKey + '+';
                        }
                    });


                    if (special) possible[modif + special] = true;
                    if (character)
                    {
                        possible[modif + character] = true;
                        possible[modif + hotkeysShiftNums[character]] = true;

                        // "$" can be triggered as "Shift+4" or "Shift+$" or just "$"
                        if (modif === "shift+")
                        {
                            possible[hotkeysShiftNums[character]] = true;
                        }
                    }

                    for (var i = 0, len = keys.length; i < len; i++)
                    {
                        if (possible[keys[i]])
                        {
                            e.preventDefault();
                            return origHandler.apply(this, arguments);
                        }
                    }
                }
            };
        },
        tabifier: function()
        {
            return {
                get: function(code)
                {
                    if (!this.opts.tabifier) return code;

                    // clean setup
                    var ownLine = ['area', 'body', 'head', 'hr', 'i?frame', 'link', 'meta', 'noscript', 'style', 'script', 'table', 'tbody', 'thead', 'tfoot'];
                    var contOwnLine = ['li', 'dt', 'dt', 'h[1-6]', 'option', 'script'];
                    var newLevel = ['p', 'blockquote', 'div', 'dl', 'fieldset', 'form', 'frameset', 'map', 'ol', 'pre', 'select', 'td', 'th', 'tr', 'ul'];

                    this.tabifier.lineBefore = new RegExp('^<(/?' + ownLine.join('|/?' ) + '|' + contOwnLine.join('|') + ')[ >]');
                    this.tabifier.lineAfter = new RegExp('^<(br|/?' + ownLine.join('|/?' ) + '|/' + contOwnLine.join('|/') + ')[ >]');
                    this.tabifier.newLevel = new RegExp('^</?(' + newLevel.join('|' ) + ')[ >]');

                    var i = 0,
                    codeLength = code.length,
                    point = 0,
                    start = null,
                    end = null,
                    tag = '',
                    out = '',
                    cont = '';

                    this.tabifier.cleanlevel = 0;

                    for (; i < codeLength; i++)
                    {
                        point = i;

                        // if no more tags, copy and exit
                        if (-1 == code.substr(i).indexOf( '<' ))
                        {
                            out += code.substr(i);

                            return this.tabifier.finish(out);
                        }

                        // copy verbatim until a tag
                        while (point < codeLength && code.charAt(point) != '<')
                        {
                            point++;
                        }

                        if (i != point)
                        {
                            cont = code.substr(i, point - i);
                            if (!cont.match(/^\s{2,}$/g))
                            {
                                if ('\n' == out.charAt(out.length - 1)) out += this.tabifier.getTabs();
                                else if ('\n' == cont.charAt(0))
                                {
                                    out += '\n' + this.tabifier.getTabs();
                                    cont = cont.replace(/^\s+/, '');
                                }

                                out += cont;
                            }

                            if (cont.match(/\n/)) out += '\n' + this.tabifier.getTabs();
                        }

                        start = point;

                        // find the end of the tag
                        while (point < codeLength && '>' != code.charAt(point))
                        {
                            point++;
                        }

                        tag = code.substr(start, point - start);
                        i = point;

                        var t;

                        if ('!--' == tag.substr(1, 3))
                        {
                            if (!tag.match(/--$/))
                            {
                                while ('-->' != code.substr(point, 3))
                                {
                                    point++;
                                }
                                point += 2;
                                tag = code.substr(start, point - start);
                                i = point;
                            }

                            if ('\n' != out.charAt(out.length - 1)) out += '\n';

                            out += this.tabifier.getTabs();
                            out += tag + '>\n';
                        }
                        else if ('!' == tag[1])
                        {
                            out = this.tabifier.placeTag(tag + '>', out);
                        }
                        else if ('?' == tag[1])
                        {
                            out += tag + '>\n';
                        }
                        else if (t = tag.match(/^<(script|style|pre)/i))
                        {
                            t[1] = t[1].toLowerCase();
                            tag = this.tabifier.cleanTag(tag);
                            out = this.tabifier.placeTag(tag, out);
                            end = String(code.substr(i + 1)).toLowerCase().indexOf('</' + t[1]);

                            if (end)
                            {
                                cont = code.substr(i + 1, end);
                                i += end;
                                out += cont;
                            }
                        }
                        else
                        {
                            tag = this.tabifier.cleanTag(tag);
                            out = this.tabifier.placeTag(tag, out);
                        }
                    }

                    return this.tabifier.finish(out);
                },
                getTabs: function()
                {
                    var s = '';
                    for ( var j = 0; j < this.tabifier.cleanlevel; j++ )
                    {
                        s += '\t';
                    }

                    return s;
                },
                finish: function(code)
                {
                    code = code.replace(/\n\s*\n/g, '\n');
                    code = code.replace(/^[\s\n]*/, '');
                    code = code.replace(/[\s\n]*$/, '');
                    code = code.replace(/<script(.*?)>\n<\/script>/gi, '<script$1></script>');

                    this.tabifier.cleanlevel = 0;

                    return code;
                },
                cleanTag: function (tag)
                {
                    var tagout = '';
                    tag = tag.replace(/\n/g, ' ');
                    tag = tag.replace(/\s{2,}/g, ' ');
                    tag = tag.replace(/^\s+|\s+$/g, ' ');

                    var suffix = '';
                    if (tag.match(/\/$/))
                    {
                        suffix = '/';
                        tag = tag.replace(/\/+$/, '');
                    }

                    var m;
                    while (m = /\s*([^= ]+)(?:=((['"']).*?\3|[^ ]+))?/.exec(tag))
                    {
                        if (m[2]) tagout += m[1].toLowerCase() + '=' + m[2];
                        else if (m[1]) tagout += m[1].toLowerCase();

                        tagout += ' ';
                        tag = tag.substr(m[0].length);
                    }

                    return tagout.replace(/\s*$/, '') + suffix + '>';
                },
                placeTag: function (tag, out)
                {
                    var nl = tag.match(this.tabifier.newLevel);

                    if (tag.match(this.tabifier.lineBefore) || nl)
                    {
                        out = out.replace(/\s*$/, '');
                        out += '\n';
                    }

                    if (nl && '/' == tag.charAt(1)) this.tabifier.cleanlevel--;
                    if ('\n' == out.charAt(out.length - 1)) out += this.tabifier.getTabs();
                    if (nl && '/' != tag.charAt(1)) this.tabifier.cleanlevel++;

                    out += tag;

                    if (tag.match(this.tabifier.lineAfter) || tag.match(this.tabifier.newLevel))
                    {
                        out = out.replace(/ *$/, '');
                        //out += '\n';
                    }

                    return out;
                }
            };
        },
        tidy: function()
        {
            return {
                setupAllowed: function()
                {
                    if (this.opts.allowedTags) this.opts.deniedTags = false;
                    if (this.opts.allowedAttr) this.opts.removeAttr = false;

                    if (this.opts.linebreaks) return;

                    var tags = ['p', 'section'];
                    if (this.opts.allowedTags) this.tidy.addToAllowed(tags);
                    if (this.opts.deniedTags) this.tidy.removeFromDenied(tags);

                },
                addToAllowed: function(tags)
                {
                    var len = tags.length;
                    for (var i = 0; i < len; i++)
                    {
                        if ($.inArray(tags[i], this.opts.allowedTags) == -1)
                        {
                            this.opts.allowedTags.push(tags[i]);
                        }
                    }
                },
                removeFromDenied: function(tags)
                {
                    var len = tags.length;
                    for (var i = 0; i < len; i++)
                    {
                        var pos = $.inArray(tags[i], this.opts.deniedTags);
                        if (pos != -1)
                        {
                            this.opts.deniedTags.splice(pos, 1);
                        }
                    }
                },
                load: function(html, options)
                {
                    this.tidy.settings = {
                        deniedTags: this.opts.deniedTags,
                        allowedTags: this.opts.allowedTags,
                        removeComments: this.opts.removeComments,
                        replaceTags: this.opts.replaceTags,
                        replaceStyles: this.opts.replaceStyles,
                        removeDataAttr: this.opts.removeDataAttr,
                        removeAttr: this.opts.removeAttr,
                        allowedAttr: this.opts.allowedAttr,
                        removeWithoutAttr: this.opts.removeWithoutAttr,
                        removeEmpty: this.opts.removeEmpty
                    };

                    $.extend(this.tidy.settings, options);

                    html = this.tidy.removeComments(html);

                    // create container
                    this.tidy.$div = $('<div />').append(html);

                    // clean
                    this.tidy.replaceTags();
                    this.tidy.replaceStyles();
                    this.tidy.removeTags();

                    this.tidy.removeAttr();
                    this.tidy.removeEmpty();
                    this.tidy.removeParagraphsInLists();
                    this.tidy.removeDataAttr();
                    this.tidy.removeWithoutAttr();

                    html = this.tidy.$div.html();
                    this.tidy.$div.remove();

                    return html;
                },
                removeComments: function(html)
                {
                    if (!this.tidy.settings.removeComments) return html;

                    return html.replace(/<!--[\s\S]*?-->/gi, '');
                },
                replaceTags: function(html)
                {
                    if (!this.tidy.settings.replaceTags) return html;

                    var len = this.tidy.settings.replaceTags.length;
                    var replacement = [], rTags = [];
                    for (var i = 0; i < len; i++)
                    {
                        rTags.push(this.tidy.settings.replaceTags[i][1]);
                        replacement.push(this.tidy.settings.replaceTags[i][0]);
                    }

                    this.tidy.$div.find(replacement.join(',')).each($.proxy(function(n,s)
                    {
                        var tag = rTags[n];
                        $(s).replaceWith(function()
                        {
                            var replaced = $('<' + tag + ' />').append($(this).contents());

                            for (var i = 0; i < this.attributes.length; i++)
                            {
                                replaced.attr(this.attributes[i].name, this.attributes[i].value);
                            }

                            return replaced;
                        });

                    }, this));

                    return html;
                },
                replaceStyles: function()
                {
                    if (!this.tidy.settings.replaceStyles) return;

                    var len = this.tidy.settings.replaceStyles.length;
                    this.tidy.$div.find('span').each($.proxy(function(n,s)
                    {
                        var $el = $(s);
                        var style = $el.attr('style');
                        for (var i = 0; i < len; i++)
                        {
                            if (style && style.match(new RegExp('^' + this.tidy.settings.replaceStyles[i][0], 'i')))
                            {
                                var tagName = this.tidy.settings.replaceStyles[i][1];
                                $el.replaceWith(function()
                                {
                                    var tag = document.createElement(tagName);
                                    return $(tag).append($(this).contents());
                                });
                            }
                        }

                    }, this));

                },
                removeTags: function()
                {
                    if (!this.tidy.settings.deniedTags && this.tidy.settings.allowedTags)
                    {
                        this.tidy.$div.find('*').not(this.tidy.settings.allowedTags.join(',')).each(function(i, s)
                        {
                            if (s.innerHTML === '') $(s).remove();
                            else $(s).contents().unwrap();
                        });
                    }

                    if (this.tidy.settings.deniedTags)
                    {
                        this.tidy.$div.find(this.tidy.settings.deniedTags.join(',')).each(function(i, s)
                        {
                            if (s.innerHTML === '') $(s).remove();
                            else $(s).contents().unwrap();
                        });
                    }
                },
                removeAttr: function()
                {
                    var len;
                    if (!this.tidy.settings.removeAttr && this.tidy.settings.allowedAttr)
                    {

                        var allowedAttrTags = [], allowedAttrData = [];
                        len = this.tidy.settings.allowedAttr.length;
                        for (var i = 0; i < len; i++)
                        {
                            allowedAttrTags.push(this.tidy.settings.allowedAttr[i][0]);
                            allowedAttrData.push(this.tidy.settings.allowedAttr[i][1]);
                        }


                        this.tidy.$div.find('*').each($.proxy(function(n,s)
                        {
                            var $el = $(s);
                            var pos = $.inArray($el[0].tagName.toLowerCase(), allowedAttrTags);
                            var attributesRemove = this.tidy.removeAttrGetRemoves(pos, allowedAttrData, $el);

                            if (attributesRemove)
                            {
                                $.each(attributesRemove, function(z,f) {
                                    $el.removeAttr(f);
                                });
                            }
                        }, this));
                    }

                    if (this.tidy.settings.removeAttr)
                    {
                        len = this.tidy.settings.removeAttr.length;
                        for (var i = 0; i < len; i++)
                        {
                            var attrs = this.tidy.settings.removeAttr[i][1];
                            if ($.isArray(attrs)) attrs = attrs.join(' ');

                            this.tidy.$div.find(this.tidy.settings.removeAttr[i][0]).removeAttr(attrs);
                        }
                    }

                },
                removeAttrGetRemoves: function(pos, allowed, $el)
                {
                    var attributesRemove = [];

                    // remove all attrs
                    if (pos == -1)
                    {
                        $.each($el[0].attributes, function(i, item)
                        {
                            attributesRemove.push(item.name);
                        });

                    }
                    // allow all attrs
                    else if (allowed[pos] == '*')
                    {
                        attributesRemove = [];
                    }
                    // allow specific attrs
                    else
                    {
                        $.each($el[0].attributes, function(i, item)
                        {
                            if ($.isArray(allowed[pos]))
                            {
                                if ($.inArray(item.name, allowed[pos]) == -1)
                                {
                                    attributesRemove.push(item.name);
                                }
                            }
                            else if (allowed[pos] != item.name)
                            {
                                attributesRemove.push(item.name);
                            }

                        });
                    }

                    return attributesRemove;
                },
                removeAttrs: function (el, regex)
                {
                    regex = new RegExp(regex, "g");
                    return el.each(function()
                    {
                        var self = $(this);
                        var len = this.attributes.length - 1;
                        for (var i = len; i >= 0; i--)
                        {
                            var item = this.attributes[i];
                            if (item && item.specified && item.name.search(regex)>=0)
                            {
                                self.removeAttr(item.name);
                            }
                        }
                    });
                },
                removeEmpty: function()
                {
                    if (!this.tidy.settings.removeEmpty) return;

                    this.tidy.$div.find(this.tidy.settings.removeEmpty.join(',')).each(function()
                    {
                        var $el = $(this);
                        var text = $el.text();
                        text = text.replace(/[\u200B-\u200D\uFEFF]/g, '');
                        text = text.replace(/&nbsp;/gi, '');
                        text = text.replace(/\s/g, '');

                        if (text === '' && $el.children().length === 0)
                        {
                            $el.remove();
                        }
                    });
                },
                removeParagraphsInLists: function()
                {
                    this.tidy.$div.find('li p').contents().unwrap();
                },
                removeDataAttr: function()
                {
                    if (!this.tidy.settings.removeDataAttr) return;

                    var tags = this.tidy.settings.removeDataAttr;
                    if ($.isArray(this.tidy.settings.removeDataAttr)) tags = this.tidy.settings.removeDataAttr.join(',');

                    this.tidy.removeAttrs(this.tidy.$div.find(tags), '^(data-)');

                },
                removeWithoutAttr: function()
                {
                    if (!this.tidy.settings.removeWithoutAttr) return;

                    this.tidy.$div.find(this.tidy.settings.removeWithoutAttr.join(',')).each(function()
                    {
                        if (this.attributes.length === 0)
                        {
                            $(this).contents().unwrap();
                        }
                    });
                }
            };
        },
        toolbar: function()
        {
            return {
                init: function()
                {
                    return {
                        html:
                        {
                            title: this.lang.get('html'),
                            func: 'code.toggle'
                        },
                        formatting:
                        {
                            title: this.lang.get('formatting'),
                            dropdown:
                            {
                                p:
                                {
                                    title: this.lang.get('paragraph'),
                                    func: 'block.format'
                                },
                                blockquote:
                                {
                                    title: this.lang.get('quote'),
                                    func: 'block.format'
                                },
                                pre:
                                {
                                    title: this.lang.get('code'),
                                    func: 'block.format'
                                },
                                h1:
                                {
                                    title: this.lang.get('header1'),
                                    func: 'block.format'
                                },
                                h2:
                                {
                                    title: this.lang.get('header2'),
                                    func: 'block.format'
                                },
                                h3:
                                {
                                    title: this.lang.get('header3'),
                                    func: 'block.format'
                                },
                                h4:
                                {
                                    title: this.lang.get('header4'),
                                    func: 'block.format'
                                },
                                h5:
                                {
                                    title: this.lang.get('header5'),
                                    func: 'block.format'
                                },
                                sup:
                                {
                                    title: 'Superscript',
                                    func: 'inline.format'
                                },
                                sub:
                                {
                                    title: 'Subscript',
                                    func: 'inline.format'
                                },
                                small:
                                {
                                    title: 'Small text',
                                    func: 'inline.format'
                                }
                            }
                        },
                        bold:
                        {
                            title: this.lang.get('bold'),
                            func: 'inline.format'
                        },
                        italic:
                        {
                            title: this.lang.get('italic'),
                            func: 'inline.format'
                        },
                        deleted:
                        {
                            title: this.lang.get('deleted'),
                            func: 'inline.format'
                        },
                        underline:
                        {
                            title: this.lang.get('underline'),
                            func: 'inline.format'
                        },
                        unorderedlist:
                        {
                            title: '&bull; ' + this.lang.get('unorderedlist'),
                            func: 'list.toggle'
                        },
                        orderedlist:
                        {
                            title: '1. ' + this.lang.get('orderedlist'),
                            func: 'list.toggle'
                        },
                        outdent:
                        {
                            title: '< ' + this.lang.get('outdent'),
                            func: 'indent.decrease'
                        },
                        indent:
                        {
                            title: '> ' + this.lang.get('indent'),
                            func: 'indent.increase'
                        },
                        image:
                        {
                            title: this.lang.get('image'),
                            func: 'image.show'
                        },
                        file:
                        {
                            title: this.lang.get('file'),
                            func: 'file.show'
                        },
                        link:
                        {
                            title: this.lang.get('link'),
                            dropdown:
                            {
                                link:
                                {
                                    title: this.lang.get('link_insert'),
                                    func: 'link.show'
                                },
                                unlink:
                                {
                                    title: this.lang.get('unlink'),
                                    func: 'link.unlink'
                                }
                            }
                        },
                        alignment:
                        {
                            title: this.lang.get('alignment'),
                            dropdown:
                            {
                                left:
                                {
                                    title: this.lang.get('align_left'),
                                    func: 'alignment.left'
                                },
                                center:
                                {
                                    title: this.lang.get('align_center'),
                                    func: 'alignment.center'
                                },
                                right:
                                {
                                    title: this.lang.get('align_right'),
                                    func: 'alignment.right'
                                },
                                justify:
                                {
                                    title: this.lang.get('align_justify'),
                                    func: 'alignment.justify'
                                }
                            }
                        },
                        horizontalrule:
                        {
                            title: this.lang.get('horizontalrule'),
                            func: 'line.insert'
                        }
                    };
                },
                build: function()
                {
                    this.toolbar.hideButtons();
                    this.toolbar.hideButtonsOnMobile();
                    this.toolbar.isButtonSourceNeeded();

                    if (this.opts.buttons.length === 0) return;

                    this.$toolbar = this.toolbar.createContainer();

                    this.toolbar.setOverflow();
                    this.toolbar.append();
                    this.toolbar.setFormattingTags();
                    this.toolbar.loadButtons();
                    this.toolbar.setFixed();

                    // buttons response
                    if (this.opts.activeButtons)
                    {
                        this.$editor.on('mouseup.redactor keyup.redactor focus.redactor', $.proxy(this.observe.buttons, this));
                    }

                },
                createContainer: function()
                {
                    return $('<ul>').addClass('redactor-toolbar').attr('id', 'redactor-toolbar-' + this.uuid);
                },
                setFormattingTags: function()
                {
                    $.each(this.opts.toolbar.formatting.dropdown, $.proxy(function (i, s)
                    {
                        if ($.inArray(i, this.opts.formatting) == -1) delete this.opts.toolbar.formatting.dropdown[i];
                    }, this));

                },
                loadButtons: function()
                {
                    $.each(this.opts.buttons, $.proxy(function(i, btnName)
                    {
                        if (!this.opts.toolbar[btnName]) return;

                        if (btnName === 'file')
                        {
                             if (this.opts.fileUpload === false) return;
                             else if (!this.opts.fileUpload && this.opts.s3 === false) return;
                        }

                        if (btnName === 'image')
                        {
                             if (this.opts.imageUpload === false) return;
                             else if (!this.opts.imageUpload && this.opts.s3 === false) return;
                        }

                        var btnObject = this.opts.toolbar[btnName];
                        this.$toolbar.append($('<li>').append(this.button.build(btnName, btnObject)));

                    }, this));
                },
                append: function()
                {
                    if (this.opts.toolbarExternal)
                    {
                        this.$toolbar.addClass('redactor-toolbar-external');
                        $(this.opts.toolbarExternal).html(this.$toolbar);
                    }
                    else
                    {
                        this.$box.prepend(this.$toolbar);
                    }
                },
                setFixed: function()
                {
                    if (!this.utils.isDesktop()) return;
                    if (this.opts.toolbarExternal) return;
                    if (!this.opts.toolbarFixed) return;

                    this.toolbar.observeScroll();
                    $(this.opts.toolbarFixedTarget).on('scroll.redactor.' + this.uuid, $.proxy(this.toolbar.observeScroll, this));

                },
                setOverflow: function()
                {
                    if (this.utils.isMobile() && this.opts.toolbarOverflow)
                    {
                        this.$toolbar.addClass('redactor-toolbar-overflow');
                    }
                },
                isButtonSourceNeeded: function()
                {
                    if (this.opts.source) return;

                    var index = this.opts.buttons.indexOf('html');
                    if (index !== -1)
                    {
                        this.opts.buttons.splice(index, 1);
                    }
                },
                hideButtons: function()
                {
                    if (this.opts.buttonsHide.length === 0) return;

                    $.each(this.opts.buttonsHide, $.proxy(function(i, s)
                    {
                        var index = this.opts.buttons.indexOf(s);
                        this.opts.buttons.splice(index, 1);

                    }, this));
                },
                hideButtonsOnMobile: function()
                {
                    if (!this.utils.isMobile() || this.opts.buttonsHideOnMobile.length === 0) return;

                    $.each(this.opts.buttonsHideOnMobile, $.proxy(function(i, s)
                    {
                        var index = this.opts.buttons.indexOf(s);
                        this.opts.buttons.splice(index, 1);

                    }, this));
                },
                observeScroll: function()
                {
                    var scrollTop = $(this.opts.toolbarFixedTarget).scrollTop();
                    var boxTop = 1;

                    if (this.opts.toolbarFixedTarget === document)
                    {
                        boxTop = this.$box.offset().top;
                    }

                    if (scrollTop > boxTop)
                    {
                        this.toolbar.observeScrollEnable(scrollTop, boxTop);
                    }
                    else
                    {
                        this.toolbar.observeScrollDisable();
                    }
                },
                observeScrollEnable: function(scrollTop, boxTop)
                {
                    var top = this.opts.toolbarFixedTopOffset + scrollTop - boxTop + 50;
                    var left = 0;
                    var end = boxTop + this.$box.height() - 32;
                    var width = this.$box.innerWidth();

                    this.$toolbar.addClass('toolbar-fixed-box');
                    this.$toolbar.css({
                        position: 'absolute',
                        width: width,
                        top: top + 'px',
                        left: left
                    });

                    this.toolbar.setDropdownsFixed();
                    this.$toolbar.css('visibility', (scrollTop < end) ? 'visible' : 'hidden');
                },
                observeScrollDisable: function()
                {
                    this.$toolbar.css({
                        position: 'relative',
                        width: 'auto',
                        top: 0,
                        left: 0,
                        visibility: 'visible'
                    });

                    this.toolbar.unsetDropdownsFixed();
                    this.$toolbar.removeClass('toolbar-fixed-box');


                },
                setDropdownsFixed: function()
                {
                    var top = this.$toolbar.innerHeight() + this.opts.toolbarFixedTopOffset;
                    var position = 'fixed';
                    if (this.opts.toolbarFixedTarget !== document)
                    {
                        top = (this.$toolbar.innerHeight() + this.$toolbar.offset().top) + this.opts.toolbarFixedTopOffset;
                        position = 'absolute';
                    }

                    $('.redactor-dropdown-' + this.uuid).each(function()
                    {
                        $(this).css({ position: position, top: top + 'px' });
                    });
                },
                unsetDropdownsFixed: function()
                {
                    var top = (this.$toolbar.innerHeight() + this.$toolbar.offset().top);
                    $('.redactor-dropdown-' + this.uuid).each(function()
                    {
                        $(this).css({ position: 'absolute', top: top + 'px' });
                    });
                }
            };
        },
        upload: function()
        {
            return {
                init: function(id, url, callback)
                {
                    this.upload.direct = false;
                    this.upload.callback = callback;
                    this.upload.url = url;
                    this.upload.$el = $(id);
                    this.upload.$droparea = $('<div id="redactor-droparea" />');

                    this.upload.$placeholdler = $('<div id="redactor-droparea-placeholder" />').text(this.lang.get('upload_label'));
                    this.upload.$input = $('<input type="file" name="file" />');

                    this.upload.$placeholdler.append(this.upload.$input);
                    this.upload.$droparea.append(this.upload.$placeholdler);
                    this.upload.$el.append(this.upload.$droparea);

                    this.upload.$droparea.off('redactor.upload');
                    this.upload.$input.off('redactor.upload');

                    this.upload.$droparea.on('dragover.redactor.upload', $.proxy(this.upload.onDrag, this));
                    this.upload.$droparea.on('dragleave.redactor.upload', $.proxy(this.upload.onDragLeave, this));

                    // change
                    this.upload.$input.on('change.redactor.upload', $.proxy(function(e)
                    {
                        e = e.originalEvent || e;
                        this.upload.traverseFile(this.upload.$input[0].files[0], e);
                    }, this));

                    // drop
                    this.upload.$droparea.on('drop.redactor.upload', $.proxy(function(e)
                    {
                        e.preventDefault();

                        this.upload.$droparea.removeClass('drag-hover').addClass('drag-drop');
                        this.upload.onDrop(e);

                    }, this));
                },
                directUpload: function(file, e)
                {
                    this.upload.direct = true;
                    this.upload.traverseFile(file, e);
                },
                onDrop: function(e)
                {
                    e = e.originalEvent || e;
                    var files = e.dataTransfer.files;

                    this.upload.traverseFile(files[0], e);
                },
                traverseFile: function(file, e)
                {
                    if (this.opts.s3)
                    {
                        this.upload.setConfig(file);
                        this.upload.s3uploadFile(file);
                        return;
                    }

                    var formData = !!window.FormData ? new FormData() : null;
                    if (window.FormData)
                    {
                        this.upload.setConfig(file);

                        var name = (this.upload.type == 'image') ? this.opts.imageUploadParam : this.opts.fileUploadParam;
                        formData.append(name, file);
                    }

                    this.progress.show();
                    this.core.setCallback('uploadStart', e, formData);
                    this.upload.sendData(formData, e);
                },
                setConfig: function(file)
                {
                    this.upload.getType(file);

                    if (this.upload.direct)
                    {
                        this.upload.url = (this.upload.type == 'image') ? this.opts.imageUpload : this.opts.fileUpload;
                        this.upload.callback = (this.upload.type == 'image') ? this.image.insert : this.file.insert;
                    }
                },
                getType: function(file)
                {
                    this.upload.type = 'image';
                    if (this.opts.imageTypes.indexOf(file.type) == -1)
                    {
                        this.upload.type = 'file';
                    }
                },
                getHiddenFields: function(obj, fd)
                {
                    if (obj === false || typeof obj !== 'object') return fd;

                    $.each(obj, $.proxy(function(k, v)
                    {
                        if (v !== null && v.toString().indexOf('#') === 0) v = $(v).val();
                        fd.append(k, v);

                    }, this));

                    return fd;

                },
                sendData: function(formData, e)
                {
                    // append hidden fields
                    if (this.upload.type == 'image')
                    {
                        formData = this.upload.getHiddenFields(this.opts.uploadImageFields, formData);
                        formData = this.upload.getHiddenFields(this.upload.imageFields, formData);
                    }
                    else
                    {
                        formData = this.upload.getHiddenFields(this.opts.uploadFileFields, formData);
                        formData = this.upload.getHiddenFields(this.upload.fileFields, formData);
                    }

                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', this.upload.url);

                    // complete
                    xhr.onreadystatechange = $.proxy(function()
                    {
                        if (xhr.readyState == 4)
                        {
                            var data = xhr.responseText;

                            data = data.replace(/^\[/, '');
                            data = data.replace(/\]$/, '');

                            var json;
                            try
                            {
                                json = (typeof data === 'string' ? $.parseJSON(data) : data);
                            }
                            catch(err)
                            {
                                json = {
                                    error: true
                                };
                            }


                            this.progress.hide();

                            if (!this.upload.direct)
                            {
                                this.upload.$droparea.removeClass('drag-drop');
                            }

                            this.upload.callback(json, this.upload.direct, e);
                        }
                    }, this);


                    /*
                    xhr.upload.onprogress = $.proxy(function(e)
                    {
                        if (e.lengthComputable)
                        {
                            var complete = (e.loaded / e.total * 100 | 0);
                            //progress.value = progress.innerHTML = complete;
                        }

                    }, this);
                    */


                    xhr.send(formData);
                },
                onDrag: function(e)
                {
                    e.preventDefault();
                    this.upload.$droparea.addClass('drag-hover');
                },
                onDragLeave: function(e)
                {
                    e.preventDefault();
                    this.upload.$droparea.removeClass('drag-hover');
                },
                clearImageFields: function()
                {
                    this.upload.imageFields = {};
                },
                addImageFields: function(name, value)
                {
                    this.upload.imageFields[name] = value;
                },
                removeImageFields: function(name)
                {
                    delete this.upload.imageFields[name];
                },
                clearFileFields: function()
                {
                    this.upload.fileFields = {};
                },
                addFileFields: function(name, value)
                {
                    this.upload.fileFields[name] = value;
                },
                removeFileFields: function(name)
                {
                    delete this.upload.fileFields[name];
                },


                // S3
                s3uploadFile: function(file)
                {
                    this.upload.s3executeOnSignedUrl(file, $.proxy(function(signedURL)
                    {
                        this.upload.s3uploadToS3(file, signedURL);
                    }, this));
                },
                s3executeOnSignedUrl: function(file, callback)
                {
                    var xhr = new XMLHttpRequest();

                    var mark = '?';
                    if (this.opts.s3.search(/\?/) != '-1') mark = '&';

                    xhr.open('GET', this.opts.s3 + mark + 'name=' + file.name + '&type=' + file.type, true);

                    // Hack to pass bytes through unprocessed.
                    if (xhr.overrideMimeType) xhr.overrideMimeType('text/plain; charset=x-user-defined');

                    var that = this;
                    xhr.onreadystatechange = function(e)
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            that.progress.show();
                            callback(decodeURIComponent(this.responseText));
                        }
                        else if (this.readyState == 4 && this.status != 200)
                        {
                            //setProgress(0, 'Could not contact signing script. Status = ' + this.status);
                        }
                    };

                    xhr.send();
                },
                s3createCORSRequest: function(method, url)
                {
                    var xhr = new XMLHttpRequest();
                    if ("withCredentials" in xhr)
                    {
                        xhr.open(method, url, true);
                    }
                    else if (typeof XDomainRequest != "undefined")
                    {
                        xhr = new XDomainRequest();
                        xhr.open(method, url);
                    }
                    else
                    {
                        xhr = null;
                    }

                    return xhr;
                },
                s3uploadToS3: function(file, url)
                {
                    var xhr = this.upload.s3createCORSRequest('PUT', url);
                    if (!xhr)
                    {
                        //setProgress(0, 'CORS not supported');
                    }
                    else
                    {
                        xhr.onload = $.proxy(function()
                        {
                            if (xhr.status == 200)
                            {
                                //setProgress(100, 'Upload completed.');

                                this.progress.hide();

                                var s3file = url.split('?');

                                if (!s3file[0])
                                {
                                     // url parsing is fail
                                     return false;
                                }


                                if (!this.upload.direct)
                                {
                                    this.upload.$droparea.removeClass('drag-drop');
                                }

                                var json = { filelink: s3file[0] };
                                if (this.upload.type == 'file')
                                {
                                    var arr = s3file[0].split('/');
                                    json.filename = arr[arr.length-1];
                                }

                                this.upload.callback(json, this.upload.direct, false);


                            }
                            else
                            {
                                //setProgress(0, 'Upload error: ' + xhr.status);
                            }
                        }, this);

                        xhr.onerror = function()
                        {
                            //setProgress(0, 'XHR error.');
                        };

                        xhr.upload.onprogress = function(e)
                        {
                            /*
                            if (e.lengthComputable)
                            {
                                var percentLoaded = Math.round((e.loaded / e.total) * 100);
                                setProgress(percentLoaded, percentLoaded == 100 ? 'Finalizing.' : 'Uploading.');
                            }
                            */
                        };

                        xhr.setRequestHeader('Content-Type', file.type);
                        xhr.setRequestHeader('x-amz-acl', 'public-read');

                        xhr.send(file);
                    }
                }
            };
        },
        utils: function()
        {
            return {
                isMobile: function()
                {
                    return /(iPhone|iPod|BlackBerry|Android)/.test(navigator.userAgent);
                },
                isDesktop: function()
                {
                    return !/(iPhone|iPod|iPad|BlackBerry|Android)/.test(navigator.userAgent);
                },
                isString: function(obj)
                {
                    return Object.prototype.toString.call(obj) == '[object String]';
                },
                isEmpty: function(html, removeEmptyTags)
                {
                    html = html.replace(/[\u200B-\u200D\uFEFF]/g, '');
                    html = html.replace(/&nbsp;/gi, '');
                    html = html.replace(/<\/?br\s?\/?>/g, '');
                    html = html.replace(/\s/g, '');
                    html = html.replace(/^<p>[^\W\w\D\d]*?<\/p>$/i, '');
                    html = html.replace(/<iframe(.*?[^>])>$/i, 'iframe');
                    html = html.replace(/<source(.*?[^>])>$/i, 'source');

                    // remove empty tags
                    if (removeEmptyTags !== false)
                    {
                        html = html.replace(/<[^\/>][^>]*><\/[^>]+>/gi, '');
                        html = html.replace(/<[^\/>][^>]*><\/[^>]+>/gi, '');
                    }

                    html = $.trim(html);

                    return html === '';
                },
                normalize: function(str)
                {
                    if (typeof(str) === 'undefined') return 0;
                    return parseInt(str.replace('px',''), 10);
                },
                hexToRgb: function(hex)
                {
                    if (typeof hex == 'undefined') return;
                    if (hex.search(/^#/) == -1) return hex;

                    var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
                    hex = hex.replace(shorthandRegex, function(m, r, g, b)
                    {
                        return r + r + g + g + b + b;
                    });

                    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
                    return 'rgb(' + parseInt(result[1], 16) + ', ' + parseInt(result[2], 16) + ', ' + parseInt(result[3], 16) + ')';
                },
                getOuterHtml: function(el)
                {
                    return $('<div>').append($(el).eq(0).clone()).html();
                },
                getAlignmentElement: function(el)
                {
                    if ($.inArray(el.tagName, this.opts.alignmentTags) !== -1)
                    {
                        return $(el);
                    }
                    else
                    {
                        return $(el).closest(this.opts.alignmentTags.toString().toLowerCase(), this.$editor[0]);
                    }
                },
                removeEmptyAttr: function(el, attr)
                {
                    var $el = $(el);
                    if (typeof $el.attr(attr) == 'undefined')
                    {
                        return true;
                    }

                    if ($el.attr(attr) === '')
                    {
                        $el.removeAttr(attr);
                        return true;
                    }

                    return false;
                },
                removeEmpty: function(i, s)
                {
                    var $s = $(s);

                    $s.find('.redactor-invisible-space').removeAttr('style').removeAttr('class');

                    if ($s.find('hr, br, img, iframe, source').length !== 0) return;
                    var text = $.trim($s.text());
                    if (this.utils.isEmpty(text, false))
                    {
                        $s.remove();
                    }
                },

                // save and restore scroll
                saveScroll: function()
                {
                    this.saveEditorScroll = this.$editor.scrollTop();
                    this.saveBodyScroll = $(window).scrollTop();

                    if (this.opts.scrollTarget) this.saveTargetScroll = $(this.opts.scrollTarget).scrollTop();
                },
                restoreScroll: function()
                {
                    if (typeof this.saveScroll === 'undefined' && typeof this.saveBodyScroll === 'undefined') return;

                    $(window).scrollTop(this.saveBodyScroll);
                    this.$editor.scrollTop(this.saveEditorScroll);

                    if (this.opts.scrollTarget) $(this.opts.scrollTarget).scrollTop(this.saveTargetScroll);
                },

                // get invisible space element
                createSpaceElement: function()
                {
                    var space = document.createElement('span');
                    space.className = 'redactor-invisible-space';
                    space.innerHTML = this.opts.invisibleSpace;

                    return space;
                },

                // replace
                removeInlineTags: function(node)
                {
                    var tags = this.opts.inlineTags;
                    tags.push('span');

                    if (node.tagName == 'PRE') tags.push('a');

                    $(node).find(tags.join(',')).not('span.redactor-selection-marker').contents().unwrap();
                },
                replaceWithContents: function(node, removeInlineTags)
                {
                    var self = this;
                    $(node).replaceWith(function()
                    {
                        if (removeInlineTags === true) self.utils.removeInlineTags(this);

                        return $(this).contents();
                    });

                    return $(node);
                },
                replaceToTag: function(node, tag, removeInlineTags)
                {
                    var replacement;
                    var self = this;
                    $(node).replaceWith(function()
                    {
                        replacement = $('<' + tag + ' />').append($(this).contents());

                        for (var i = 0; i < this.attributes.length; i++)
                        {
                            replacement.attr(this.attributes[i].name, this.attributes[i].value);
                        }

                        if (removeInlineTags === true) self.utils.removeInlineTags(replacement);

                        return replacement;
                    });

                    return replacement;
                },

                // start and end of element
                isStartOfElement: function()
                {
                    var block = this.selection.getBlock();
                    if (!block) return false;

                    var offset = this.caret.getOffsetOfElement(block);

                    return (offset === 0) ? true : false;
                },
                isEndOfElement: function(element)
                {
                    if (typeof element == 'undefined')
                    {
                        var element = this.selection.getBlock();
                        if (!element) return false;
                    }

                    var offset = this.caret.getOffsetOfElement(element);
                    var text = $.trim($(element).text()).replace(/\n\r\n/g, '');

                    return (offset == text.length) ? true : false;
                },
                isEndOfEditor: function()
                {
                    var block = this.$editor[0];

                    var offset = this.caret.getOffsetOfElement(block);
                    var text = $.trim($(block).html().replace(/(<([^>]+)>)/gi,''));

                    return (offset == text.length) ? true : false;
                },

                // test blocks
                isBlock: function(block)
                {
                    block = block[0] || block;

                    return block && this.utils.isBlockTag(block.tagName);
                },
                isBlockTag: function(tag)
                {
                    if (typeof tag == 'undefined') return false;

                    return this.reIsBlock.test(tag);
                },

                // tag detection
                isTag: function(current, tag)
                {
                    var element = $(current).closest(tag);
                    if (element.length == 1)
                    {
                        return element[0];
                    }

                    return false;
                },

                // select all
                isSelectAll: function()
                {
                    return this.selectAll;
                },
                enableSelectAll: function()
                {
                    this.selectAll = true;
                },
                disableSelectAll: function()
                {
                    this.selectAll = false;
                },

                // parents detection
                isRedactorParent: function(el)
                {
                    if (!el)
                    {
                        return false;
                    }

                    if ($(el).parents('.redactor-editor').length === 0 || $(el).hasClass('redactor-editor'))
                    {
                        return false;
                    }

                    return el;
                },
                isCurrentOrParentHeader: function()
                {
                    return this.utils.isCurrentOrParent(['H1', 'H2', 'H3', 'H4', 'H5', 'H6']);
                },
                isCurrentOrParent: function(tagName)
                {
                    var parent = this.selection.getParent();
                    var current = this.selection.getCurrent();

                    if ($.isArray(tagName))
                    {
                        var matched = 0;
                        $.each(tagName, $.proxy(function(i, s)
                        {
                            if (this.utils.isCurrentOrParentOne(current, parent, s))
                            {
                                matched++;
                            }
                        }, this));

                        return (matched === 0) ? false : true;
                    }
                    else
                    {
                        return this.utils.isCurrentOrParentOne(current, parent, tagName);
                    }
                },
                isCurrentOrParentOne: function(current, parent, tagName)
                {
                    tagName = tagName.toUpperCase();

                    return parent && parent.tagName === tagName ? parent : current && current.tagName === tagName ? current : false;
                },


                // browsers detection
                isOldIe: function()
                {
                    return (this.utils.browser('msie') && parseInt(this.utils.browser('version'), 10) < 9) ? true : false;
                },
                isLessIe10: function()
                {
                    return (this.utils.browser('msie') && parseInt(this.utils.browser('version'), 10) < 10) ? true : false;
                },
                isIe11: function()
                {
                    return !!navigator.userAgent.match(/Trident\/7\./);
                },
                browser: function(browser)
                {
                    var ua = navigator.userAgent.toLowerCase();
                    var match = /(opr)[\/]([\w.]+)/.exec( ua ) ||
                    /(chrome)[ \/]([\w.]+)/.exec( ua ) ||
                    /(webkit)[ \/]([\w.]+).*(safari)[ \/]([\w.]+)/.exec(ua) ||
                    /(webkit)[ \/]([\w.]+)/.exec( ua ) ||
                    /(opera)(?:.*version|)[ \/]([\w.]+)/.exec( ua ) ||
                    /(msie) ([\w.]+)/.exec( ua ) ||
                    ua.indexOf("trident") >= 0 && /(rv)(?::| )([\w.]+)/.exec( ua ) ||
                    ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec( ua ) ||
                    [];

                    if (browser == 'safari') return (typeof match[3] != 'undefined') ? match[3] == 'safari' : false;
                    if (browser == 'version') return match[2];
                    if (browser == 'webkit') return (match[1] == 'chrome' || match[1] == 'opr' || match[1] == 'webkit');
                    if (match[1] == 'rv') return browser == 'msie';
                    if (match[1] == 'opr') return browser == 'webkit';

                    return browser == match[1];
                }
            };
        }
    };

    $(window).on('load.tools.redactor', function()
    {
        $('[data-tools="redactor"]').redactor();
    });

    // constructor
    Redactor.prototype.init.prototype = Redactor.prototype;

    // LINKIFY
    $.Redactor.fn.formatLinkify = function(protocol, convertLinks, convertUrlLinks, convertImageLinks, convertVideoLinks, linkSize)
    {
        var urlCheck = '((?:http[s]?:\\/\\/(?:www\\.)?|www\\.){1}(?:[0-9A-Za-z\\-%_]+\\.)+[a-zA-Z]{2,}(?::[0-9]+)?(?:(?:/[0-9A-Za-z\\-#\\.%\+_]*)+)?(?:\\?(?:[0-9A-Za-z\\-\\.%_]+(?:=[0-9A-Za-z\\-\\.%_\\+]*)?)?(?:&(?:[0-9A-Za-z\\-\\.%_]+(?:=[0-9A-Za-z\\-\\.%_\\+]*)?)?)*)?(?:#[0-9A-Za-z\\-\\.%_\\+=\\?&;]*)?)';
        var regex = new RegExp(urlCheck, 'gi');
        var rProtocol = /(https?|ftp):\/\//i;
        var urlImage = new RegExp('(?:([^:/?#]+):)?(?:\/\/([^/?#]*))?([^?#]*\\.(?:jpg|gif|png))(?:\\?([^#]*))?(?:#(.*))?', 'gi');

        var childNodes = (this.$editor ? this.$editor[0] : this).childNodes, i = childNodes.length;
        while (i--)
        {
            var n = childNodes[i];

            if (n.nodeType === 3 && n.parentNode !== 'PRE')
            {
                var html = n.nodeValue;

                // youtube & vimeo
                if (convertVideoLinks && html)
                {
                    var iframeStart = '<iframe width="500" height="281" src="',
                        iframeEnd = '" frameborder="0" allowfullscreen></iframe>';

                    if (html.match(reUrlYoutube))
                    {
                        html = html.replace(reUrlYoutube, iframeStart + '//www.youtube.com/embed/$1' + iframeEnd);
                        $(n).after(html).remove();
                    }
                    else if (html.match(reUrlVimeo))
                    {
                        html = html.replace(reUrlVimeo, iframeStart + '//player.vimeo.com/video/$2' + iframeEnd);
                        $(n).after(html).remove();
                    }
                }

                // image
                if (convertImageLinks && html && html.match(urlImage))
                {
                    var matches = html.match(urlImage);
                    html = html.replace(urlImage, '<img src="' + matches + '" />');

                    $(n).after(html).remove();
                    return;
                }

                // link
                if (html.search(/\$/g) != -1) html = html.replace(/\$/g, '&#36;');

                var matches = html.match(regex);
                if (convertUrlLinks && html && matches)
                {
                    var len = matches.length;
                    for (var z = 0; z < len; z++)
                    {
                        // remove dot in the end
                        if (matches[z].match(/\.$/) !== null) matches[z] = matches[z].replace(/\.$/, '');

                        var href = matches[z];
                        var text = href;

                        var space = '';
                        if (href.match(/\s$/) !== null) space = ' ';

                        var addProtocol = protocol + '://';
                        if (href.match(rProtocol) !== null) addProtocol = '';

                        if (text.length > linkSize) text = text.substring(0, linkSize) + '...';
                        text = text.replace(/&#36;/g, '$').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');

                        // buffer
                        var buffer = [];
                        var links = html.match('<a(.*?)</a>');
                        if (links !== null)
                        {
                            var len = links.length;
                            for (i = 0; i < len; i++)
                            {
                                buffer[i] = links[i];
                                html = html.replace(links[i], '{abuffer' + i + '}');
                            }
                        }

                        html = html.replace(href, '<a href=\"' + addProtocol + $.trim(href) + '\">' + $.trim(text) + '</a>' + space);

                        // rebuffer
                        $.each(buffer, function(i,s)
                        {
                            html = html.replace('{abuffer' + i + '}', s);
                        });
                    }

                    $(n).after(html).remove();
                }
            }
            else if (n.nodeType === 1 && !/^(pre|a|button|textarea)$/i.test(n.tagName))
            {
                $.Redactor.fn.formatLinkify.call(n, protocol, convertLinks, convertUrlLinks, convertImageLinks, convertVideoLinks, linkSize);
            }
        }
    };

})(jQuery);
if (!RedactorPlugins) var RedactorPlugins = {};

RedactorPlugins.filemanager = function()
{
    return {
        getTemplate: function()
        {
            return String()
            + '<section id="redactor-modal-filemanager">'
            + '<div class="input-group">'
            + '<input id="filemanager-filter" type="textbox" placeholder="Search" class="form-control">'
            + '<span class="input-group-btn">'
            + '<span class="btn btn-default"><span class="fa fa-search"></span></span>'
            + '</span>'
            + '</div>'
            + '<div id="filemanager-container" class="raw-block-400 quarx-row raw-margin-top-24" style="overflow: scroll;"></div>'
            + '</section>';
        },
        init: function()
        {
            var button = this.button.add('filemanager', 'Insert File');

            this.button.setAwesome('filemanager', 'fa-archive');
            this.button.addCallback(button, this.filemanager.show);
        },
        show: function()
        {
            this.modal.addTemplate('filemanager', this.filemanager.getTemplate());

            this.modal.load('filemanager', 'File Insert', 600);

            this.modal.show();

            this.filemanager.load();
        },
        load: function()
        {
            $.ajax({
                dataType: "json",
                cache: false,
                headers: {
                    Quarx: _apiKey,
                    Authorization: 'Bearer '+_apiToken
                },
                url: this.opts.fileManagerJson,
                error: function(data){
                    console.log(data)
                },
                success: $.proxy(function(data)
                {
                    $.each((data.data), $.proxy(function(key, val)
                    {
                        var file = $('<div class="list-row raw-left raw100"><div class="raw100 raw-left"><p><span class="fa fa-download"></span> <a class="file-link" href="#" data-url="'+ _url+'/public-download/'+val.file_identifier +'">' + val.file_name + '</a></p></div>');
                        $('#filemanager-container').append(file);
                        $(file).click($.proxy(this.filemanager.insert, this));
                    }, this));

                    $("#filemanager-filter").bind("keyup", function(){
                        $("#filemanager-container").find(".file-link").each(function(){
                            if ($(this).html().indexOf($("#filemanager-filter").val()) < 0) {
                                $(this).parent().parent().parent().hide();
                            } else {
                                $(this).parent().parent().parent().show();
                            }
                        });
                    })

                }, this)
            });
        },
        insert: function(e)
        {
            e.preventDefault();
            this.insert.html('<a href="' + $(e.target).attr('data-url') + '">'+ $(e.target).html() +'</a>', false);
            this.modal.close();
        }
    };
};
if (!RedactorPlugins) var RedactorPlugins = {};

RedactorPlugins.fontcolor = function()
{
	return {
		init: function()
		{
			var colors = [
				'#ffffff', '#000000', '#eeece1', '#1f497d', '#4f81bd', '#c0504d', '#9bbb59', '#8064a2', '#4bacc6', '#f79646', '#ffff00',
				'#f2f2f2', '#7f7f7f', '#ddd9c3', '#c6d9f0', '#dbe5f1', '#f2dcdb', '#ebf1dd', '#e5e0ec', '#dbeef3', '#fdeada', '#fff2ca',
				'#d8d8d8', '#595959', '#c4bd97', '#8db3e2', '#b8cce4', '#e5b9b7', '#d7e3bc', '#ccc1d9', '#b7dde8', '#fbd5b5', '#ffe694',
				'#bfbfbf', '#3f3f3f', '#938953', '#548dd4', '#95b3d7', '#d99694', '#c3d69b', '#b2a2c7', '#b7dde8', '#fac08f', '#f2c314',
				'#a5a5a5', '#262626', '#494429', '#17365d', '#366092', '#953734', '#76923c', '#5f497a', '#92cddc', '#e36c09', '#c09100',
				'#7f7f7f', '#0c0c0c', '#1d1b10', '#0f243e', '#244061', '#632423', '#4f6128', '#3f3151', '#31859b',  '#974806', '#7f6000'
			];

			var buttons = ['fontcolor', 'backcolor'];

			for (var i = 0; i < 2; i++)
			{
				var name = buttons[i];

				var button = this.button.add(name, this.lang.get(name));
				var $dropdown = this.button.addDropdown(button);

				$dropdown.width(242);
				this.fontcolor.buildPicker($dropdown, name, colors);

			}
		},
		buildPicker: function($dropdown, name, colors)
		{
			var rule = (name == 'backcolor') ? 'background-color' : 'color';

			var len = colors.length;
			var self = this;
			var func = function(e)
			{
				e.preventDefault();
				self.fontcolor.set($(this).data('rule'), $(this).attr('rel'));
			};

			for (var z = 0; z < len; z++)
			{
				var color = colors[z];

				var $swatch = $('<a rel="' + color + '" data-rule="' + rule +'" href="#" style="float: left; font-size: 0; border: 2px solid #fff; padding: 0; margin: 0; width: 22px; height: 22px;"></a>');
				$swatch.css('background-color', color);
				$swatch.on('click', func);

				$dropdown.append($swatch);
			}

			var $elNone = $('<a href="#" style="display: block; clear: both; padding: 5px; font-size: 12px; line-height: 1;"></a>').html(this.lang.get('none'));
			$elNone.on('click', $.proxy(function(e)
			{
				e.preventDefault();
				this.fontcolor.remove(rule);

			}, this));

			$dropdown.append($elNone);
		},
		set: function(rule, type)
		{
			this.inline.format('span', 'style', rule + ': ' + type + ';');
		},
		remove: function(rule)
		{
			this.inline.removeStyleRule(rule);
		}
	};
};
if (!RedactorPlugins) var RedactorPlugins = {};

RedactorPlugins.fontfamily = function()
{
	return {
		init: function ()
		{
			var fonts = [ 'Arial', 'Helvetica', 'Georgia', 'Times New Roman', 'Monospace' ];
			var that = this;
			var dropdown = {};

			$.each(fonts, function(i, s)
			{
				dropdown['s' + i] = { title: s, func: function() { that.fontfamily.set(s); }};
			});

			dropdown.remove = { title: 'Remove Font Family', func: that.fontfamily.reset };

			var button = this.button.add('fontfamily', 'Change Font Family');
			this.button.addDropdown(button, dropdown);

		},
		set: function (value)
		{
			this.inline.format('span', 'style', 'font-family:' + value + ';');
		},
		reset: function()
		{
			this.inline.removeStyleRule('font-family');
		}
	};
};
if (!RedactorPlugins) var RedactorPlugins = {};

RedactorPlugins.fontsize = function()
{
	return {
		init: function()
		{
			var fonts = [10, 11, 12, 14, 16, 18, 20, 24, 28, 30];
			var that = this;
			var dropdown = {};

			$.each(fonts, function(i, s)
			{
				dropdown['s' + i] = { title: s + 'px', func: function() { that.fontsize.set(s); } };
			});

			dropdown.remove = { title: 'Remove Font Size', func: that.fontsize.reset };

			var button = this.button.add('fontsize', 'Change Font Size');
			this.button.addDropdown(button, dropdown);
		},
		set: function(size)
		{
			this.inline.format('span', 'style', 'font-size: ' + size + 'px;');
		},
		reset: function()
		{
			this.inline.removeStyleRule('font-size');
		}
	};
};
if (!RedactorPlugins) var RedactorPlugins = {};

RedactorPlugins.imagemanager = function()
{
    return {
        init: function()
        {
            if (!this.opts.imageManagerJson) return;

            this.modal.addCallback('image', this.imagemanager.load);
        },
        load: function()
        {
            var $modal = this.modal.getModal();

            this.modal.createTabber($modal);

            $('#redactor-modal-image-droparea').hide()

            var $box = $('<div id="redactor-image-manager-box" style="overflow: auto; height: 300px;" class="redactor-tab redactor-tab2">').hide();
            $modal.append($box);

            $("#redactor-image-manager-box, #imagemanager-filter").show();

            $.ajax({
                dataType: "json",
                cache: false,
                headers: {
                    Quarx: _apiKey,
                    Authorization: 'Bearer '+_apiToken
                },
                url: this.opts.imageManagerJson,
                success: $.proxy(function(data)
                {
                    $.each(data.data, $.proxy(function(key, val)
                    {
                        // title
                        var thumbtitle = '';
                        if (typeof val.title_tag != 'undefined') thumbtitle = val.title_tag;

                        var img = $('<div class="raw25 pull-left thumbnail-box"><img class="img-responsive" data-img-name="'+ val.url +'" src="' + val.url + '" rel="' + val.url + '" title="' + thumbtitle + '" style="cursor: pointer;" /></div>');
                        $('#redactor-image-manager-box').append(img);
                        $(img).click($.proxy(this.imagemanager.insert, this));

                    }, this));

                    $("#imagemanager-filter").bind("keyup", function(){
                        $("#redactor-image-manager-box").find("img").each(function(){
                            if ($(this).attr("data-img-name").indexOf($("#imagemanager-filter").val()) < 0) {
                                $(this).hide();
                            } else {
                                $(this).show();
                            }
                        });
                    })

                }, this)
            });
        },
        insert: function(e)
        {
            console.log(e.target)
            this.image.insert('<img src="' + $(e.target).attr('rel') + '" alt="' + $(e.target).attr('title') + '" title="' + $(e.target).attr('title') + '">');
        }
    };
};
if (!RedactorPlugins) var RedactorPlugins = {};

RedactorPlugins.stockimagemanager = function()
{
    return {
        getTemplate: function()
        {
            return String()
            + '<section id="redactor-modal-stockimagemanager">'
            + '<div class="input-group stockimagemanager-search-box">'
            + '<input id="stockimagemanager-filter" type="textbox" placeholder="Search" class="form-control">'
            + '<span class="input-group-btn">'
            + '<button class="btn btn-default" type="button" id="stockimagemanager-search"><span class="fa fa-search"></span></button>'
            + '</span>'
            + '</div>'
            + '<div id="stockimagemanager-container" class="raw-block-300 quarx-row raw-margin-top-24 raw-margin-bottom-24" style="overflow: scroll;"></div>'
            + '<div id="stockimagemanager-links" class="raw-block-20 quarx-row"><button id="stockImgPrevBtn" class="btn btn-default pull-left">Prev</button><button id="stockImgNextBtn" class="pull-right btn btn-default">Next</button></div>'
            + '<div><a href="https://pixabay.com/"><img class="raw100 raw-margin-top-24" src="https://pixabay.com/static/img/public/leaderboard_a.png" alt="Pixabay"> </a></div>'
            + '</section>';
        },
        init: function()
        {
            var button = this.button.add('stockimagemanager', 'Insert Stock Image');
            this.button.setAwesome('stockimagemanager', 'fa-camera-retro');
            this.button.addCallback(button, this.stockimagemanager.show);
        },
        show: function()
        {
            this.modal.addTemplate('stockimagemanager', this.stockimagemanager.getTemplate());

            this.modal.load('stockimagemanager', 'Insert Stock Images', 600);

            this.modal.show();

            this.stockimagemanager.load();
        },
        search: function(_term, _page) {
            if (typeof _page == 'undefined') {
                _page = 1;
            };
            if (typeof _term != 'undefined' && _term != 'null' && _term != null) {
                _searchTerm = "&q=" + encodeURIComponent(_term);
            } else {
                _searchTerm = '';
            }
            $('#stockimagemanager-container').html('loading...');
            $.ajax({
                dataType: "json",
                cache: false,
                url: this.opts.stockImageManagerJson + "?key=" + _pixabayKey + _searchTerm + "&order=popular&page=" + _page,
                error: function(data){
                    console.log(data)
                },
                success: $.proxy(function(data)
                {
                    if (Math.floor(data.totalHits / 20) == _page) {
                        $("#stockImgNextBtn").hide();
                    } else  {
                        $("#stockImgNextBtn").show();
                    }

                    if (_page == 1) {
                        $("#stockImgPrevBtn").hide();
                    } else  {
                        $("#stockImgPrevBtn").show();
                    }

                    $("#stockImgNextBtn").attr('data-page', parseInt(_page) + 1);
                    $("#stockImgPrevBtn").attr('data-page', parseInt(_page) - 1);

                    $('#stockimagemanager-container').html("");
                    $.each((data.hits), $.proxy(function(key, val)
                    {
                        var img = $('<div class="raw25 pull-left thumbnail-box"><img class="img-responsive" data-img-name="'+ val.previewURL +'" data-url="' + val.webformatURL + '" src="' + val.previewURL + '" rel="' + val.previewURL + '" style="cursor: pointer;" /></div>');
                        $('#stockimagemanager-container').append(img);
                        $(img).click($.proxy(this.stockimagemanager.insert, this));
                    }, this));

                }, this)
            });
        },
        load: function()
        {
            if (_pixabayKey == '') {
                $("#stockImgPrevBtn, #stockImgNextBtn, .stockimagemanager-search-box").hide();
                $('#stockimagemanager-container').html('<p class="text-center">In order to have an easy supply of stock images visit <a target="_blank" href="https://pixabay.com/api/docs/">Pixabay</a> to get an API key for your application.</p><p class="text-center">Then add the following to your .env file:<br> PIXABAY=yourApiKey</p>');
            } else {
                var _module = this.stockimagemanager;
                _module.search('null');
                $("#stockimagemanager-search").bind("click", function(){
                    var _val = $("#stockimagemanager-filter").val();
                    if (_val == '') {
                        _val = 'null';
                    };
                    _module.search(_val);
                });
                $("#stockImgPrevBtn, #stockImgNextBtn").bind("click", function() {
                    var _val = $("#stockimagemanager-filter").val();
                    if (_val == '') {
                        _val = 'null';
                    };
                    _module.search(_val, $(this).attr('data-page'));
                });
            }
        },
        insert: function(e)
        {
            var _imageURL = '';
            var _this = this;
            $.ajax({
                type: 'POST',
                dataType: "json",
                cache: false,
                headers: {
                    ApiKey: 'tOJRcQXeCesSMprwbtU5'
                },
                data: {
                    _token: _token,
                    location: $(e.target).attr('data-url')
                },
                url: _url + '/quarx/api/images/store',
                error: function(data){
                    console.log(data)
                },
                success: $.proxy(function(data) {
                    e.preventDefault();
                    _this.insert.html('<img src="' + data.data.location + '" />', false);
                    _this.modal.close();
                }, this)
            });
        }
    };
};
if ( ! RedactorPlugins) var RedactorPlugins = {};

RedactorPlugins.specialchar = function()
{
    return {
        init: function()
        {
            var dropdown = {};

            /*
            |--------------------------------------------------------------------------
            | Punctuation
            |--------------------------------------------------------------------------
            */

            dropdown.ndash  = { title: '&ndash;', func: this.specialchar.callbackFunc };
            dropdown.mdash  = { title: '&mdash;', func: this.specialchar.callbackFunc };
            dropdown.iexcl  = { title: '&iexcl;', func: this.specialchar.callbackFunc };
            dropdown.iquest = { title: '&iquest;', func: this.specialchar.callbackFunc };
            dropdown.laquo  = { title: '&laquo;', func: this.specialchar.callbackFunc };
            dropdown.raquo  = { title: '&raquo;', func: this.specialchar.callbackFunc };

            /*
            |--------------------------------------------------------------------------
            | Symbols
            |--------------------------------------------------------------------------
            */

            dropdown.cent   = { title: '&cent;', func: this.specialchar.callbackFunc };
            dropdown.copy   = { title: '&copy;', func: this.specialchar.callbackFunc };
            dropdown.divide = { title: '&divide;', func: this.specialchar.callbackFunc };
            dropdown.gt     = { title: '&gt;', func: this.specialchar.callbackFunc };
            dropdown.lt     = { title: '&lt;', func: this.specialchar.callbackFunc };
            dropdown.micro  = { title: '&micro;', func: this.specialchar.callbackFunc };
            dropdown.middot = { title: '&middot;', func: this.specialchar.callbackFunc };
            dropdown.para   = { title: '&para;', func: this.specialchar.callbackFunc };
            dropdown.plusmn = { title: '&plusmn;', func: this.specialchar.callbackFunc };
            dropdown.euro   = { title: '&euro;', func: this.specialchar.callbackFunc };
            dropdown.pound  = { title: '&pound;', func: this.specialchar.callbackFunc };
            dropdown.reg    = { title: '&reg;', func: this.specialchar.callbackFunc };
            dropdown.sect   = { title: '&sect;', func: this.specialchar.callbackFunc };
            dropdown.trade  = { title: '&trade;', func: this.specialchar.callbackFunc };
            dropdown.yen    = { title: '&yen;', func: this.specialchar.callbackFunc };
            dropdown.deg    = { title: '&deg;', func: this.specialchar.callbackFunc };

            /*
            |--------------------------------------------------------------------------
            | Diacritics
            |--------------------------------------------------------------------------
            */

            dropdown.aacute  = { title: '&aacute;', func: this.specialchar.callbackFunc };
            dropdown.Aacute  = { title: '&Aacute;', func: this.specialchar.callbackFunc };
            dropdown.agrave  = { title: '&agrave;', func: this.specialchar.callbackFunc };
            dropdown.acirc   = { title: '&acirc;', func: this.specialchar.callbackFunc };
            dropdown.aring   = { title: '&aring;', func: this.specialchar.callbackFunc };
            dropdown.atilde  = { title: '&atilde;', func: this.specialchar.callbackFunc };
            dropdown.auml    = { title: '&auml;', func: this.specialchar.callbackFunc };
            dropdown.aelig   = { title: '&aelig;', func: this.specialchar.callbackFunc };
            dropdown.ccedil  = { title: '&ccedil;', func: this.specialchar.callbackFunc };
            dropdown.eacute  = { title: '&eacute;', func: this.specialchar.callbackFunc };
            dropdown.egrave  = { title: '&egrave;', func: this.specialchar.callbackFunc };
            dropdown.ecirc   = { title: '&ecirc;', func: this.specialchar.callbackFunc };
            dropdown.euml    = { title: '&euml;', func: this.specialchar.callbackFunc };
            dropdown.iacute  = { title: '&iacute;', func: this.specialchar.callbackFunc };
            dropdown.igrave  = { title: '&igrave;', func: this.specialchar.callbackFunc };
            dropdown.icirc   = { title: '&icirc;', func: this.specialchar.callbackFunc };
            dropdown.iuml    = { title: '&iuml;', func: this.specialchar.callbackFunc };
            dropdown.ntilde  = { title: '&ntilde;', func: this.specialchar.callbackFunc };
            dropdown.oacute  = { title: '&oacute;', func: this.specialchar.callbackFunc };
            dropdown.ograve  = { title: '&ograve;', func: this.specialchar.callbackFunc };
            dropdown.ocirc   = { title: '&ocirc;', func: this.specialchar.callbackFunc };
            dropdown.oslash  = { title: '&oslash;', func: this.specialchar.callbackFunc };
            dropdown.otilde  = { title: '&otilde;', func: this.specialchar.callbackFunc };
            dropdown.ouml    = { title: '&ouml;', func: this.specialchar.callbackFunc };
            dropdown.uacute  = { title: '&uacute;', func: this.specialchar.callbackFunc };
            dropdown.ugrave  = { title: '&ugrave;', func: this.specialchar.callbackFunc };
            dropdown.ucirc   = { title: '&ucirc;', func: this.specialchar.callbackFunc };
            dropdown.uuml    = { title: '&uuml;', func: this.specialchar.callbackFunc };

            var button = this.button.add('specialchar', 'Special Characters');

            this.button.setAwesome('specialchar', 'fa-keyboard-o');
            this.button.addDropdown(button, dropdown);
        },
        callbackFunc: function(buttonName)
        {
            this.insert.html('&'+buttonName+';', false);
            this.modal.close();
        }
    };
};
if (!RedactorPlugins) var RedactorPlugins = {};

RedactorPlugins.table = function()
{
	return {
		getTemplate: function()
		{
			return String()
			+ '<section id="redactor-modal-table-insert">'
				+ '<label>' + this.lang.get('rows') + '</label>'
				+ '<input type="text" size="5" value="2" id="redactor-table-rows" />'
				+ '<label>' + this.lang.get('columns') + '</label>'
				+ '<input type="text" size="5" value="3" id="redactor-table-columns" />'
			+ '</section>';
		},
		init: function()
		{

			var dropdown = {};

			dropdown.insert_table = { title: this.lang.get('insert_table'), func: this.table.show };
			dropdown.insert_row_above = { title: this.lang.get('insert_row_above'), func: this.table.addRowAbove };
			dropdown.insert_row_below = { title: this.lang.get('insert_row_below'), func: this.table.addRowBelow };
			dropdown.insert_column_left = { title: this.lang.get('insert_column_left'), func: this.table.addColumnLeft };
			dropdown.insert_column_right = { title: this.lang.get('insert_column_right'), func: this.table.addColumnRight };
			dropdown.add_head = { title: this.lang.get('add_head'), func: this.table.addHead };
			dropdown.delete_head = { title: this.lang.get('delete_head'), func: this.table.deleteHead };
			dropdown.delete_column = { title: this.lang.get('delete_column'), func: this.table.deleteColumn };
			dropdown.delete_row = { title: this.lang.get('delete_row'), func: this.table.deleteRow };
			dropdown.delete_table = { title: this.lang.get('delete_table'), func: this.table.deleteTable };

			this.observe.addButton('td', 'table');
			this.observe.addButton('th', 'table');

			var button = this.button.addBefore('link', 'table', this.lang.get('table'));
			this.button.addDropdown(button, dropdown);
		},
		show: function()
		{
			this.modal.addTemplate('table', this.table.getTemplate());

			this.modal.load('table', this.lang.get('insert_table'), 300);
			this.modal.createCancelButton();

			var button = this.modal.createActionButton(this.lang.get('insert'));
			button.on('click', this.table.insert);

			this.selection.save();
			this.modal.show();

			$('#redactor-table-rows').focus();

		},
		insert: function()
		{

			var rows = $('#redactor-table-rows').val(),
				columns = $('#redactor-table-columns').val(),
				$tableBox = $('<div>'),
				tableId = Math.floor(Math.random() * 99999),
				$table = $('<table id="table' + tableId + '"><tbody></tbody></table>'),
				i, $row, z, $column;

			for (i = 0; i < rows; i++)
			{
				$row = $('<tr>');

				for (z = 0; z < columns; z++)
				{
					$column = $('<td>' + this.opts.invisibleSpace + '</td>');

					// set the focus to the first td
					if (i === 0 && z === 0)
					{
						$column.append(this.selection.getMarker());
					}

					$($row).append($column);
				}

				$table.append($row);
			}

			$tableBox.append($table);
			var html = $tableBox.html();


			this.modal.close();
			this.selection.restore();

			if (this.table.getTable()) return;

			this.buffer.set();

			var current = this.selection.getBlock() || this.selection.getCurrent();
			if (current && current.tagName != 'BODY')
			{
				if (current.tagName == 'LI') current = $(current).closest('ul, ol');
				$(current).after(html);
			}
			else
			{
				this.insert.html(html);
			}

			this.selection.restore();

			var table = this.$editor.find('#table' + tableId);

			if (!this.opts.linebreaks && (this.utils.browser('mozilla') || this.utils.browser('msie')))
			{
				var $next = table.next();
				if ($next.length === 0)
				{
					 table.after(this.opts.emptyHtml);
				}
			}

			this.observe.buttons();

			table.find('span.redactor-selection-marker').remove();
			table.removeAttr('id');

			this.code.sync();
			this.core.setCallback('insertedTable', table);
		},
		getTable: function()
		{
			var $table = $(this.selection.getParent()).closest('table');

			if (!this.utils.isRedactorParent($table)) return false;
			if ($table.size() === 0) return false;

			return $table;
		},
		restoreAfterDelete: function($table)
		{
			this.selection.restore();
			$table.find('span.redactor-selection-marker').remove();
			this.code.sync();
		},
		deleteTable: function()
		{
			var $table = this.table.getTable();
			if (!$table) return;

			this.buffer.set();


			var $next = $table.next();
			if (!this.opts.linebreaks && $next.length !== 0)
			{
				this.caret.setStart($next);
			}
			else
			{
				this.caret.setAfter($table);
			}


			$table.remove();

			this.code.sync();
		},
		deleteRow: function()
		{
			var $table = this.table.getTable();
			if (!$table) return;

			var $current = $(this.selection.getCurrent());

			this.buffer.set();

			var $current_tr = $current.closest('tr');
			var $focus_tr = $current_tr.prev().length ? $current_tr.prev() : $current_tr.next();
			if ($focus_tr.length)
			{
				var $focus_td = $focus_tr.children('td, th').first();
				if ($focus_td.length) $focus_td.prepend(this.selection.getMarker());
			}

			$current_tr.remove();
			this.table.restoreAfterDelete($table);
		},
		deleteColumn: function()
		{
			var $table = this.table.getTable();
			if (!$table) return;

			this.buffer.set();

			var $current = $(this.selection.getCurrent());
			var $current_td = $current.closest('td, th');
			var index = $current_td[0].cellIndex;

			$table.find('tr').each($.proxy(function(i, elem)
			{
				var $elem = $(elem);
				var focusIndex = index - 1 < 0 ? index + 1 : index - 1;
				if (i === 0) $elem.find('td, th').eq(focusIndex).prepend(this.selection.getMarker());

				$elem.find('td, th').eq(index).remove();

			}, this));

			this.table.restoreAfterDelete($table);
		},
		addHead: function()
		{
			var $table = this.table.getTable();
			if (!$table) return;

			this.buffer.set();

			if ($table.find('thead').size() !== 0)
			{
				this.table.deleteHead();
				return;
			}

			var tr = $table.find('tr').first().clone();
			tr.find('td').html(this.opts.invisibleSpace);
			$thead = $('<thead></thead>').append(tr);
			$table.prepend($thead);

			this.code.sync();

		},
		deleteHead: function()
		{
			var $table = this.table.getTable();
			if (!$table) return;

			var $thead = $table.find('thead');
			if ($thead.size() === 0) return;

			this.buffer.set();

			$thead.remove();
			this.code.sync();
		},
		addRowAbove: function()
		{
			this.table.addRow('before');
		},
		addRowBelow: function()
		{
			this.table.addRow('after');
		},
		addColumnLeft: function()
		{
			this.table.addColumn('before');
		},
		addColumnRight: function()
		{
			this.table.addColumn('after');
		},
		addRow: function(type)
		{
			var $table = this.table.getTable();
			if (!$table) return;

			this.buffer.set();

			var $current = $(this.selection.getCurrent());
			var $current_tr = $current.closest('tr');
			var new_tr = $current_tr.clone();

			new_tr.find('th').replaceWith(function()
			{
				var $td = $('<td>');
				$td[0].attributes = this.attributes;

				return $td.append($(this).contents());
			});

			new_tr.find('td').html(this.opts.invisibleSpace);

			if (type == 'after')
			{
				$current_tr.after(new_tr);
			}
			else
			{
				$current_tr.before(new_tr);
			}

			this.code.sync();
		},
		addColumn: function (type)
		{
			var $table = this.table.getTable();
			if (!$table) return;

			var index = 0;
			var current = $(this.selection.getCurrent());

			this.buffer.set();

			var $current_tr = current.closest('tr');
			var $current_td = current.closest('td, th');

			$current_tr.find('td, th').each($.proxy(function(i, elem)
			{
				if ($(elem)[0] === $current_td[0]) index = i;

			}, this));

			$table.find('tr').each($.proxy(function(i, elem)
			{
				var $current = $(elem).find('td, th').eq(index);

				var td = $current.clone();
				td.html(this.opts.invisibleSpace);

				if (type == 'after')
				{
					$current.after(td);
				}
				else
				{
					$current.before(td);
				}

			}, this));

			this.code.sync();
		}
	};
};
if (!RedactorPlugins) var RedactorPlugins = {};

RedactorPlugins.video = function()
{
	return {
		reUrlYoutube: /https?:\/\/(?:[0-9A-Z-]+\.)?(?:youtu\.be\/|youtube\.com\S*[^\w\-\s])([\w\-]{11})(?=[^\w\-]|$)(?![?=&+%\w.-]*(?:['"][^<>]*>|<\/a>))[?=&+%\w.-]*/ig,
		reUrlVimeo: /https?:\/\/(www\.)?vimeo.com\/(\d+)($|\/)/,
		getTemplate: function()
		{
			return String()
			+ '<section id="redactor-modal-video-insert">'
				+ '<label>' + this.lang.get('video_html_code') + '</label>'
				+ '<textarea id="redactor-insert-video-area" style="height: 160px;"></textarea>'
			+ '</section>';
		},
		init: function()
		{
			var button = this.button.addAfter('image', 'video', this.lang.get('video'));
			this.button.addCallback(button, this.video.show);
		},
		show: function()
		{
			this.modal.addTemplate('video', this.video.getTemplate());

			this.modal.load('video', this.lang.get('video'), 700);
			this.modal.createCancelButton();

			var button = this.modal.createActionButton(this.lang.get('insert'));
			button.on('click', this.video.insert);

			this.selection.save();
			this.modal.show();

			$('#redactor-insert-video-area').focus();

		},
		insert: function()
		{
			var data = $('#redactor-insert-video-area').val();
			data = this.clean.stripTags(data);

			// parse if it is link on youtube & vimeo
			var iframeStart = '<iframe style="width: 500px; height: 281px;" src="',
				iframeEnd = '" frameborder="0" allowfullscreen></iframe>';

			if (data.match(this.video.reUrlYoutube))
			{
				data = data.replace(this.video.reUrlYoutube, iframeStart + '//www.youtube.com/embed/$1' + iframeEnd);
			}
			else if (data.match(this.video.reUrlVimeo))
			{
				data = data.replace(this.video.reUrlVimeo, iframeStart + '//player.vimeo.com/video/$2' + iframeEnd);
			}

			this.selection.restore();
			this.modal.close();

			var current = this.selection.getBlock() || this.selection.getCurrent();

			if (current) $(current).after(data);
			else
			{
				this.insert.html(data);
			}

			this.code.sync();
		}

	};
};
//# sourceMappingURL=all.js.map
