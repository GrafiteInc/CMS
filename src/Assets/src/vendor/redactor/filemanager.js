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
            + '<div id="filemanager-container" class="raw-block-400 cms-row raw-margin-top-24" style="overflow: scroll;">Loading your file collection...</div>'
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
                    Cms: _apiKey,
                    Authorization: 'Bearer '+_apiToken
                },
                url: this.opts.fileManagerJson,
                error: function(data){
                    console.log(data)
                },
                success: $.proxy(function(data)
                {
                    $('#filemanager-container').html('');

                    if (data.data.length > 0) {
                        $.each((data.data), $.proxy(function(key, val)
                        {
                            var file = $('<div class="list-row raw-left raw100"><div class="raw100 raw-left"><p><span class="fa fa-download"></span> <a class="file-link" href="#" data-url="/public-download/'+val.file_identifier +'">' + val.file_name + '</a></p></div>');
                            $('#filemanager-container').append(file);
                            $(file).click($.proxy(this.filemanager.insert, this));
                        }, this));
                    } else {
                        $('#filemanager-container').append('You have not yet uploaded any files, visit the files tab to add some.');
                    }

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