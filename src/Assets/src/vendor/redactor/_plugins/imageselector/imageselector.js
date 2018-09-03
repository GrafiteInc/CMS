(function($R)
{
    $R.add('plugin', 'imageselector', {
        init: function(app)
        {
            // define app
            this.app = app;
            this.opts = app.opts;

            // define some services, for example
            this.caret = app.caret;
            this.selection = app.selection;
            this.toolbar = app.toolbar;
            this.insertion = app.insertion;
        },
        start: function () {
            var buttonData = {
                title: 'Insert Image',
                api: 'plugin.imageselector.open'
            };
            var button = this.toolbar.addButton('imageselector', buttonData);
            button.setIcon('<i class="fa fa-image"></i>');
        },
        modals: {
            'imageselector': '<section id="redactor-modal-imageselector">'
            + '<div class="input-group">'
            + '<input id="imageselector-filter" type="textbox" placeholder="Search" class="form-control">'
            + '<span class="input-group-btn">'
            + '<span class="btn btn-default"><span class="fa fa-search"></span></span>'
            + '</span>'
            + '</div>'
            + '<div id="imageselector-container" class="raw-block-400 cms-row raw-margin-top-24" style="overflow: scroll;">Loading your image collection...</div>'
            + '</section>'
        },
        open: function () {
            var options = {
                title: 'Image Selector',
                width: '600px',
                name: 'imageselector'
            };

            this.app.api('module.modal.build', options);
        },
        onmodal: {
            imageselector: {
                opened: function($modal, $form)
                {
                    this.load();
                },
            },
        },
        load: function()
        {
            $.ajax({
                dataType: "json",
                cache: false,
                headers: {
                    Cms: _apiKey,
                    Authorization: 'Bearer '+_apiToken
                },
                url: this.opts.imageManagerJson,
                error: function(data){
                    console.log(data)
                },
                success: $.proxy(function(data)
                {
                    $('#imageselector-container').html('');

                    if (data.data.length > 0) {
                        $.each((data.data), $.proxy(function(key, val)
                        {
                            var thumbtitle = '';

                            if (typeof val.title_tag != 'undefined' && val.title_tag != null) {
                                thumbtitle = val.title_tag;
                            }

                            var img = $('<div class="raw25 float-left thumbnail-box"><div class="img cms-thumbnail-img" style="background-image: url(\'' + val.js_url + '\')" data-img-name="'+ val.js_url +'" src="' + val.js_url + '" rel="' + val.js_url + '" title="' + thumbtitle + '"></div></div>');
                            $('#imageselector-container').append(img);
                            $(img).click($.proxy(this.insert, this));
                        }, this));
                    } else {
                        $('#imageselector-container').append('You have not yet uploaded any images, visit the images tab to add some.');
                    }

                    $("#imageselector-filter").bind("keyup", function(){
                        $(".cms-thumbnail-img").each(function(){
                            console.log($(this).attr('title'))
                            if ($(this).attr('title').indexOf($("#imageselector-filter").val()) < 0) {
                                $(this).parent().hide();
                            } else {
                                $(this).parent().show();
                            }
                        });
                    })

                }, this)
            });
        },
        insert: function(e)
        {
            e.preventDefault();
            this.insertion.insertHtml('<img src="' + $(e.target).attr('rel') + '" alt="' + $(e.target).attr('title') + '" title="' + $(e.target).attr('title') + '">');
            this.app.api('module.modal.close');
        },
    });
})(Redactor);
