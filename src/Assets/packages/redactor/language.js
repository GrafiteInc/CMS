if (!RedactorPlugins) var RedactorPlugins = {};

RedactorPlugins.language = function()
{
    return {
        init: function()
        {
            var dropdown = {};

            dropdown.english = { title: 'English', func: this.language.callbackFunc };
            dropdown.french = { title: 'French', func: this.language.callbackFunc };
            dropdown.german = { title: 'German', func: this.language.callbackFunc };
            dropdown.spanish = { title: 'Spanish', func: this.language.callbackFunc };
            dropdown.russian = { title: 'Russian', func: this.language.callbackFunc };
            dropdown.arabic = { title: 'Arabic', func: this.language.callbackFunc };
            dropdown.hindustani = { title: 'Hindustani', func: this.language.callbackFunc };
            dropdown.chinese = { title: 'Chinese', func: this.language.callbackFunc };

            var button = this.button.add('language', 'Language');

            this.button.setAwesome('language', 'fa-language');
            this.button.addDropdown(button, dropdown);
        },
        callbackFunc: function(buttonName)
        {
        	this.$element.attr("data-language", buttonName);
        	this.$element.parent().siblings(".page-lang").html("<p>Language: "+this.language.ucFirst(buttonName)+"</p>");
        },
        ucFirst: function (string)
		{
		    return string.charAt(0).toUpperCase() + string.slice(1);
		}
    };
};