"use strict";
$.fn.readmore = function( options ) {
        
		var settings = $.extend
        (
            {
                printText: "In",
                div: this,
                hideText: "<< Đóng",
                readText: "Chi tiết >>",
                isTextShown: false,
                effect: true,
                effectOption: "fast",
                buttonClasses: "btn-primary opacity-rollover",
                dataid: "read-more-action",
                multiple: false
            },
            options
        );
    
        var bIsTextShown = settings.isTextShown;
		
        if(settings.multiple === true)
        {
            $(settings.div).each(function(){
                var isTextShown = settings.isTextShown;   
                if(bIsTextShown === false){
                    showReadMore(this, settings);
                }
                else{
                    hideReadMore(this, settings)
                }
                bindShowText(this, settings, isTextShown);
            });
        }
        else
        {
            if(bIsTextShown === false){
                showReadMore(settings.div, settings);
            }
            else{
                hideReadMore(settings.div, settings)
            }
            bindShowText(settings.div, settings, settings.isTextShown);
        }
    
        //Functions
        function showReadMore(el, settings)
        {
            $(el).hide();
			$(el).parent().append(
                "<div class='text-center'><button data-id='"+settings.dataid+"' class='" + settings.buttonClasses +"'>"+ settings.readText + "</button> <button class='" + settings.buttonClasses +"' onclick=\"window.print()\">"+ settings.printText + " </button></div>"
            );	
        }

        function hideReadMore(el, settings)
        {
            $(el).parent().append(
                "<div class='text-center'><button data-id='" + settings.dataid + "' class='" + settings.buttonClasses + "'>" + settings.hideText + "</button> <button class='" + settings.buttonClasses +"'onclick=\"window.print()\">"+ settings.printText + "</button></div>"
            );	
        }

        function bindShowText(el, oSettings, bIsTextShown)
        {
            $(el).parent().find("[data-id='"+oSettings.dataid+"']").bind("click.readmore", function () 
            {
                if(bIsTextShown === false)
                {
                    $(el).parent().find("[data-id='"+oSettings.dataid+"']").text(oSettings.hideText);

                    if(oSettings.effect === true){
                        $(el).fadeIn(oSettings.effectOption);
                    }
                    else{
                        $(el).show();
                    }

                    bIsTextShown = true;		
                }
                else
                {
                    $(el).parent().find("[data-id='"+oSettings.dataid+"']").text(oSettings.readText);

                    if(oSettings.effect === true){
                        $(el).hide();
                    }else{
                        $(el).fadeOut(oSettings.effectOption);
                    }

                    bIsTextShown = false;
                }
            });
        };		
};