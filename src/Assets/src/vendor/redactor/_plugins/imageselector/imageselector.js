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

            $("#redactor-image-manager-box").html('<p class="text-center raw-margin-top-48">Loading your image collection...</p>').show();

            $.ajax({
                dataType: "json",
                cache: false,
                headers: {
                    Cms: _apiKey,
                    Authorization: 'Bearer '+_apiToken
                },
                url: this.opts.imageManagerJson,
                success: $.proxy(function(data)
                {
                    $('#redactor-image-manager-box').html('');
                    if (data.data.length > 0) {
                        $.each(data.data, $.proxy(function(key, val)
                        {
                            // title
                            var thumbtitle = '';
                            if (typeof val.title_tag != 'undefined') thumbtitle = val.title_tag;

                            var img = $('<div class="raw25 float-left thumbnail-box"><div class="img" style="background-image: url(\'' + val.js_url + '\')" data-img-name="'+ val.js_url +'" src="' + val.js_url + '" rel="' + val.js_url + '" title="' + thumbtitle + '"></div></div>');
                            $('#redactor-image-manager-box').append(img);
                            $(img).click($.proxy(this.imagemanager.insert, this));

                        }, this));
                    } else {
                        $('#redactor-image-manager-box').append('You have not yet uploaded any images, visit the images tab to add some.');
                    }

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
            this.image.insert('<img src="' + $(e.target).attr('rel') + '" alt="' + $(e.target).attr('title') + '" title="' + $(e.target).attr('title') + '">');
        }
    };
};