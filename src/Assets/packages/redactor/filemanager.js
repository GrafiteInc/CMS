if (!RedactorPlugins) var RedactorPlugins = {};

RedactorPlugins.filemanager = function()
{
    return {
        getTemplate: function()
        {
            return String()
            + '<section id="redactor-modal-filemanager">'
            + '<input class="raw-padding-12 raw100" id="filemanager-filter" placeholder="filer" />'
            + '<div id="filemanager-container" class="raw-block-400 quarx-row" style="overflow: scroll;"></div>'
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
                        var file = $('<div class="list-row raw-left raw100"><div class="raw70 raw-left"><p><span class="fa fa-download raw-margin-right-12"></span><a class="file-link" href="#" data-url="'+ _url+'/public-download/'+val.file_identifier +'">' + val.file_name + '</a></p></div><div class="raw30 raw-left"><p class="raw-right raw-padding-right-12">'+val.file_date+'</p></div></div>');
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