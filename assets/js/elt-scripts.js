/**
 * Copyright (c) 2007-2012 Ariel Flesler - aflesler(at)gmail(dot)com | http://flesler.blogspot.com
 * Dual licensed under MIT and GPL.
 * @author Ariel Flesler
 * @version 1.4.3.1
 */
;(function($){var h=$.scrollTo=function(a,b,c){$(window).scrollTo(a,b,c)};h.defaults={axis:'xy',duration:parseFloat($.fn.jquery)>=1.3?0:1,limit:true};h.window=function(a){return $(window)._scrollable()};$.fn._scrollable=function(){return this.map(function(){var a=this,isWin=!a.nodeName||$.inArray(a.nodeName.toLowerCase(),['iframe','#document','html','body'])!=-1;if(!isWin)return a;var b=(a.contentWindow||a).document||a.ownerDocument||a;return/webkit/i.test(navigator.userAgent)||b.compatMode=='BackCompat'?b.body:b.documentElement})};$.fn.scrollTo=function(e,f,g){if(typeof f=='object'){g=f;f=0}if(typeof g=='function')g={onAfter:g};if(e=='max')e=9e9;g=$.extend({},h.defaults,g);f=f||g.duration;g.queue=g.queue&&g.axis.length>1;if(g.queue)f/=2;g.offset=both(g.offset);g.over=both(g.over);return this._scrollable().each(function(){if(e==null)return;var d=this,$elem=$(d),targ=e,toff,attr={},win=$elem.is('html,body');switch(typeof targ){case'number':case'string':if(/^([+-]=)?\d+(\.\d+)?(px|%)?$/.test(targ)){targ=both(targ);break}targ=$(targ,this);if(!targ.length)return;case'object':if(targ.is||targ.style)toff=(targ=$(targ)).offset()}$.each(g.axis.split(''),function(i,a){var b=a=='x'?'Left':'Top',pos=b.toLowerCase(),key='scroll'+b,old=d[key],max=h.max(d,a);if(toff){attr[key]=toff[pos]+(win?0:old-$elem.offset()[pos]);if(g.margin){attr[key]-=parseInt(targ.css('margin'+b))||0;attr[key]-=parseInt(targ.css('border'+b+'Width'))||0}attr[key]+=g.offset[pos]||0;if(g.over[pos])attr[key]+=targ[a=='x'?'width':'height']()*g.over[pos]}else{var c=targ[pos];attr[key]=c.slice&&c.slice(-1)=='%'?parseFloat(c)/100*max:c}if(g.limit&&/^\d+$/.test(attr[key]))attr[key]=attr[key]<=0?0:Math.min(attr[key],max);if(!i&&g.queue){if(old!=attr[key])animate(g.onAfterFirst);delete attr[key]}});animate(g.onAfter);function animate(a){$elem.animate(attr,f,g.easing,a&&function(){a.call(this,e,g)})}}).end()};h.max=function(a,b){var c=b=='x'?'Width':'Height',scroll='scroll'+c;if(!$(a).is('html,body'))return a[scroll]-$(a)[c.toLowerCase()]();var d='client'+c,html=a.ownerDocument.documentElement,body=a.ownerDocument.body;return Math.max(html[scroll],body[scroll])-Math.min(html[d],body[d])};function both(a){return typeof a=='object'?a:{top:a,left:a}}})(jQuery);


jQuery(document).ready(function($) {
    "use strict";

    $("#elt__tabs a").click(function (event) {

        if ($(window).height() <= 767) {
            $.scrollTo('.product_content', 1000);
        }
        event.preventDefault();
        var my_id = jQuery(this).attr("id");
        $("#elt__tabs a").removeClass("active");
        $(this).addClass("active");

        if(display_category_url_based == 'enable'){

            var cat_param = "?cat_id="+my_id;
            window.history.replaceState(null, null, cat_param);

        }

        $("#elt__tabs_container .each_cat").fadeOut(0);
        $("#elt__tabs_container .each_cat").removeClass("active");

        $("#product-" + my_id).fadeIn();
        $("#product-" + my_id).addClass("active");

        if( qc_scroll_category_clickable == 'enable' ){
            var currentDom = $(this);
            var content_warppers = currentDom.closest('.elt__container');
            var scroll_each_wrap = content_warppers.find('.product_content');

            $('html,body').animate( { scrollTop: $(scroll_each_wrap).offset().top - 100 }, 300 );

        }


    });

    $( window ).on( "load", function() {

        $.urlParam = function(name){
            var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
            console.log(name);
            if(results){
                return results[1] || 0;
            }
        }

        var cat_check_param = $.urlParam('cat_id');

        if(display_category_url_based == 'enable' && $.urlParam('cat_id')){

            var cat_param = "?cat_id="+cat_check_param;
            window.history.replaceState(null, null, cat_param);

            $("#elt__tabs a").removeClass("active");
            $("#elt__tabs a#" + cat_check_param).addClass("active");

            $("#elt__tabs_container .each_cat").fadeOut(0);
            $("#elt__tabs_container .each_cat").removeClass("active");

            $("#product-" + cat_check_param).fadeIn();
            $("#product-" + cat_check_param).addClass("active");

            return false;
        }
        


    });




});
