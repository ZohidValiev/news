/**
 * Created by Zohid on 30.09.2020.
 */

(function($) {

    function createIndexGenerator() {
        var ix = 0;
        return function() {
            return ++ix;
        };
    }

    var grid = {
        _$grid: null,
        _$gridBody: null,
        _template: null,
        _links: null,
        _isLoading: false,
        init: function($container, indexGenerator) {
            this._$container = $container;
            this._$grid      = $container.find('#news-grid');
            this._$gridBody  = this._$grid.find('tbody');
            this._template   = $('#template').html();
            this._genIx      = indexGenerator;
        },
        canLoad: function() {
            var containerOffsetTop = this._$container.offset().top;
            var containerHeight = this._$container.height();
            var $window = $(window);

            return (containerOffsetTop + containerHeight - $window.scrollTop()) <= $window.height();
        },
        _isFinished: function() {
            return this._links != null && this._links.next == null;
        },
        _load: function(rubricId, url) {
            url = url ? (url + '&') : '/news/rubric/' + rubricId + '/news-grid?';
            url += 'expand=content';

            return $.ajax({
                url: url,
                method: 'get',
                dataType: 'json'
            });
        },
        load: function(rubricId, callbacks) {
            if (this._isFinished() || this._isLoading) {
                return;
            }

            this._isLoading = true;

            callbacks = callbacks || {};

            var self = this;

            if (callbacks.beforeSend) {
                callbacks.beforeSend();
            }

            xhr = this._load(rubricId, this._links && this._links.next && this._links.next.href);

            xhr.done(function(response) {
                self._links = response._links;
                var items = response.items;

                self._addGridRows(items);

                if (callbacks.success) {
                    callbacks.success(self._isFinished());
                }
            }).fail(function() {
                if (callbacks.error) {
                    callbacks.error();
                }
            }).always(function() {
                self._isLoading = false;

                if (callbacks.complete) {
                    callbacks.complete();
                }
            });
        },
        _buildTempl: function(news) {
            var self = this;
            var $frame = $('<div/>');

            news.forEach(function(_news) {
                $frame.append(self._buildRowTempl(_news));
            });

            return $frame.html();
        },
        _buildRowTempl: function (news) {
            var $template = $(this._template);

            var $ix       = $('#_ix', $template);
            var $title    = $('#_title', $template);
            var $content  = $('#_content', $template);

            $ix.removeAttr('id').html(this._genIx());
            $title.removeAttr('id').html(news.title);
            $content.removeAttr('id').html(news.content.content);

            return $template;
        },
        _addGridRows: function (news) {
            this._$gridBody.append(this._buildTempl(news));
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

        grid.init($container, createIndexGenerator());
        loader.init($container);

        var timeout = null;
        $(window).on('scroll.grid', function(e) {
            if (timeout == null && grid.canLoad()) {
                timeout = setTimeout(function(){
                    load();
                }, 500);
            }
        });

        function load() {
            grid.load(1, {
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

        load();
    });

}(jQuery));