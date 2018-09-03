(function($R)
{
    $R.add('plugin', 'fileselector', {
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
                title: 'Insert File',
                api: 'plugin.fileselector.open'
            };
            var button = this.toolbar.addButton('fileselector', buttonData);
            button.setIcon('<i class="fa fa-archive"></i>');
        },
        modals: {
            'fileselector': '<section id="redactor-modal-fileselector">'
                + '<div class="input-group">'
                + '<input id="fileselector-filter" type="textbox" placeholder="Search" class="form-control">'
                + '<span class="input-group-btn">'
                + '<span class="btn btn-default"><span class="fa fa-search"></span></span>'
                + '</span>'
                + '</div>'
                + '<div id="fileselector-container" class="raw-block-400 cms-row raw-margin-top-24" style="overflow: scroll;">Loading your file collection...</div>'
                + '</section>'
        },
        open: function () {
            var options = {
                title: 'File Selector',
                width: '600px',
                name: 'fileselector'
            };

            this.app.api('module.modal.build', options);
        },
        onmodal: {
            fileselector: {
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
                url: this.opts.fileManagerJson,
                error: function(data){
                    console.log(data)
                },
                success: $.proxy(function(data)
                {
                    $('#fileselector-container').html('');

                    if (data.data.length > 0) {
                        $.each((data.data), $.proxy(function(key, val)
                        {
                            var file = $('<div class="list-row raw-left raw100"><div class="raw100 raw-left"><p><span class="fa fa-download"></span> <a class="file-link" href="#" data-url="/public-download/'+val.file_identifier +'">' + val.file_name + '</a></p></div>');
                            $('#fileselector-container').append(file);
                            $(file).click($.proxy(this.insert, this));
                        }, this));
                    } else {
                        $('#fileselector-container').append('You have not yet uploaded any files, visit the files tab to add some.');
                    }

                    $("#fileselector-filter").bind("keyup", function(){
                        $("#fileselector-container").find(".file-link").each(function(){
                            if ($(this).html().indexOf($("#fileselector-filter").val()) < 0) {
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
            this.insertion.insertHtml('<a href="' + $(e.target).attr('data-url') + '">'+ $(e.target).html() +'</a>', false);
            this.app.api('module.modal.close');
        },
    });
})(Redactor);
