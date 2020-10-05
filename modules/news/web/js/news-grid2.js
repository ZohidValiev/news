/**
 * Created by Zohid on 30.09.2020.
 */

(function($) {

    var container = {
        init: function($container) {
            this._$container = $container;
        },
        canLoad: function() {
            var containerOffsetTop = this._$container.offset().top;
            var containerHeight = this._$container.height();
            var $window = $(window);

            return (containerOffsetTop + containerHeight - $window.scrollTop()) <= $window.height();
        }
    };

    var grid = {
        init: function($container) {
            this._$container = $container;
            this._$grid      = $container.find('#news-grid');
            this._$gridBody  = this._$grid.find('tbody');
            this._links      = $container.data('links');
            this._rubricId   = $container.data('rubricId');
        },
        _isFinished: function() {
            return this._links.next == null;
        },
        _load: function(rubricId, url) {
            url = url || ('/news/default/news/' + rubricId);

            return $.ajax({
                url: url,
                method: 'get',
                dataType: 'json'
            });
        },
        load: function(callbacks) {
            if (this._isFinished() || this._isLoading) {
                return;
            }

            callbacks = callbacks || {};

            var self = this;

            if (callbacks.beforeSend) {
                callbacks.beforeSend();
            }

            xhr = this._load(this._rubricId, this._links.next);

            xhr.done(function(response) {
                self._links = response._links;
                var content = response.content;

                self._addGridRows(content);

                if (callbacks.success) {
                    callbacks.success(self._isFinished());
                }
            }).fail(function() {
                if (callbacks.error) {
                    callbacks.error();
                }
            }).always(function() {
                if (callbacks.complete) {
                    callbacks.complete();
                }
            });
        },
        _addGridRows: function (html) {
            this._$gridBody.append(html);
        }
    };

    var loader = {
        _$container: null,
        _$loader: null,
        init: function($container) {
            this._$container = $container.find('#loader-container');
            this._$loader    = this._$container.find('#loader');
        },
        toggleLoadingState: function() {
            this._$container.toggleClass('grid-loader--loading')
        },
        remove: function() {
            this._$container.remove();
        }
    };

    $(function() {
        var $container = $('#grid-container');

        container.init($container);
        grid.init($container);
        loader.init($container);

        var timeout = null;
        $(window).on('scroll.grid', function(e) {
            if (timeout == null && container.canLoad()) {
                timeout = setTimeout(function(){
                    load();
                }, 500);
            }
        });

        function load() {
            grid.load({
                beforeSend: function() {
                    loader.toggleLoadingState();
                },
                success: function(isFinished) {
                    if (isFinished) {
                        loader.remove();
                        $(window).off('scroll.grid');
                    } else {
                        loader.toggleLoadingState();
                    }
                },
                complete: function() {
                    timeout = null;
                }
            });
        }
    });

}(jQuery));