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