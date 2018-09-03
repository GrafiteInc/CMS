(function($R)
{
    $R.add('plugin', 'stockimagemanager', {
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
                title: 'Insert Stock Image',
                api: 'plugin.stockimagemanager.open'
            };
            var button = this.toolbar.addButton('stockimagemanager', buttonData);
            button.setIcon('<i class="fa fa-camera-retro"></i>');
        },
        modals: {
            'stockimagemanager': '<section id="redactor-modal-stockimagemanager">'
                + '<div class="input-group stockimagemanager-search-box">'
                + '<input id="stockimagemanager-filter" type="textbox" placeholder="Search" class="form-control">'
                + '<span class="input-group-btn">'
                + '<button class="btn btn-default" type="button" id="stockimagemanager-search"><span class="fa fa-search"></span></button>'
                + '</span>'
                + '</div>'
                + '<div id="stockimagemanager-container" class="raw-block-300 cms-row raw-margin-top-24 raw-margin-bottom-24" style="overflow: scroll;"></div>'
                + '<div id="stockimagemanager-links" class="raw-block-20 cms-row"><button id="stockImgPrevBtn" class="btn btn-default float-left">Prev</button><button id="stockImgNextBtn" class="pull-right btn btn-default">Next</button></div>'
                + '<div><a href="https://pixabay.com/"><img class="raw100 raw-margin-top-24" src="https://pixabay.com/static/img/public/leaderboard_a.png" alt="Pixabay"> </a></div>'
                + '</section>'
        },
        open: function () {
            var options = {
                title: 'Stock Image Manager',
                width: '600px',
                name: 'stockimagemanager'
            };

            this.app.api('module.modal.build', options);
        },
        onmodal: {
            stockimagemanager: {
                opened: function($modal, $form)
                {
                    // this.modal.load('stockimagemanager', 'Insert Stock Images', 600);

                    // this.modal.show();

                    this.load();
                },
            },
        },
        load: function()
        {
            if (_pixabayKey == '') {
                $("#stockImgPrevBtn, #stockImgNextBtn, .stockimagemanager-search-box").hide();
                $('#stockimagemanager-container').html('<p class="text-center">In order to have an easy supply of stock images visit <a target="_blank" href="https://pixabay.com/api/docs/">Pixabay</a> to get an API key for your application.</p><p class="text-center">Then add the following to your .env file:<br> PIXABAY=yourApiKey</p>');
            } else {
                var _module = this;
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
                        var img = $('<div class="raw25 float-left thumbnail-box"><img class="img-responsive" data-img-name="'+ val.previewURL +'" data-url="' + val.webformatURL + '" src="' + val.previewURL + '" rel="' + val.previewURL + '" style="cursor: pointer;" /></div>');
                        $('#stockimagemanager-container').append(img);
                        $(img).click($.proxy(this.insert, this));
                    }, this));

                }, this)
            });
        },
        insert: function(e)
        {
            var _imageURL = '';
            var _this = this;
            $.ajax({
                type: 'POST',
                dataType: "json",
                cache: false,
                data: {
                    _token: _token,
                    location: $(e.target).attr('data-url')
                },
                url: _url + '/cms/api/images/store',
                error: function(data){
                    console.log(data)
                },
                success: $.proxy(function(data) {
                    e.preventDefault();
                    _this.insertion.insertHtml('<img src="' + data.data.js_url + '" />');
                    _this.app.api('module.modal.close');
                }, this)
            });
        },
    });
})(Redactor);


