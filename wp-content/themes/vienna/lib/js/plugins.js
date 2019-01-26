/**
 * Owl carousel
 * @version 2.0.0
 * @author Bartosz Wojciechowski
 * @license The MIT License (MIT)
 * @todo Lazy Load Icon
 * @todo prevent animationend bubling
 * @todo itemsScaleUp
 * @todo Test Zepto
 * @todo stagePadding calculate wrong active classes
 */
;(function($, window, document, undefined) {

    var item, dom, width, num, pos, drag, speed, state, e;

    /**
     * Template for the data of each item respectively its DOM element.
     * @private
     */
    item = {
        index: false,
        indexAbs: false,
        posLeft: false,
        clone: false,
        active: false,
        loaded: false,
        lazyLoad: false,
        current: false,
        width: false,
        center: false,
        page: false,
        hasVideo: false,
        playVideo: false
    };

    /**
     * Template for the references to DOM elements, those with `$` sign are `jQuery` objects.
     * @private
     */
    dom = {
        el: null, // main element
        $el: null, // jQuery main element
        stage: null, // stage
        $stage: null, // jQuery stage
        oStage: null, // outer stage
        $oStage: null, // $ outer stage
        $items: null, // all items, clones and originals included
        $oItems: null, // original items
        $cItems: null, // cloned items only
        $content: null
    };

    /**
     * Template for the widths of some elements.
     * @private
     */
    width = {
        el: 0,
        stage: 0,
        item: 0,
        prevWindow: 0,
        cloneLast: 0
    };

    /**
     * Template for counting to some properties.
     * @private
     */
    num = {
        items: 0,
        oItems: 0,
        cItems: 0,
        active: 0,
        merged: []
    };

    /**
     * Template for status information about drag and touch events.
     * @private
     */
    drag = {
        start: 0,
        startX: 0,
        startY: 0,
        current: 0,
        currentX: 0,
        currentY: 0,
        offsetX: 0,
        offsetY: 0,
        distance: null,
        startTime: 0,
        endTime: 0,
        updatedX: 0,
        targetEl: null
    };

    /**
     * Template for some status informations.
     * @private
     */
    state = {
        isTouch: false,
        isScrolling: false,
        isSwiping: false,
        direction: false,
        inMotion: false
    };

    /**
     * Event functions references.
     * @private
     */
    e = {
        _onDragStart: null,
        _onDragMove: null,
        _onDragEnd: null,
        _transitionEnd: null,
        _resizer: null,
        _responsiveCall: null,
        _goToLoop: null,
        _checkVisibile: null
    };

    /**
     * Creates a carousel.
     * @class The Owl Carousel.
     * @public
     * @param {HTMLElement|jQuery} element - The element to create the carousel for.
     * @param {Object} [options] - The options
     */
    function Owl(element, options) {

        // add basic Owl information to dom element
        element.owlCarousel = {
            'name': 'Owl Carousel',
            'author': 'Bartosz Wojciechowski',
            'version': '2.0.0-beta.2.1'
        };

        /**
         * Current settings for the carousel.
         * @protected
         */
        this.settings = null;

        /**
         *
         * @protected
         * @todo Must be dosumented.
         */
        this.options = $.extend({}, Owl.Defaults, options);

        /**
         * Template for the data of each item.
         * @protected
         */
        this.itemData = $.extend({}, item);

        /**
         * Contains references to DOM elements, those with `$` sign are `jQuery` objects.
         * @protected
         */
        this.dom = $.extend({}, dom);

        /**
         * Caches the widths of some elements.
         * @protected
         */
        this.width = $.extend({}, width);

        /**
         * Caches some count informations.
         * @protected
         */
        this.num = $.extend({}, num);

        /**
         * Caches informations about drag and touch events.
         */
        this.drag = $.extend({}, drag);

        /**
         * Caches some status informations.
         * @protected
         */
        this.state = $.extend({}, state);

        /**
         * @protected
         * @todo Must be documented
         */
        this.e = $.extend({}, e);

        /**
         * References to the running plugins of this carousel.
         * @protected
         */
        this.plugins = {};

        /**
         * Currently suppressed events to prevent them from beeing retriggered.
         * @protected
         */
        this._supress = {};

        /**
         * The absolute current position.
         * @protected
         */
        this._current = null;

        /**
         * The animation speed in milliseconds.
         * @protected
         */
        this._speed = null;

        /**
         * The coordinates of all items in pixel.
         */
        this._coordinates = null;

        this.dom.el = element;
        this.dom.$el = $(element);

        for (var plugin in Owl.Plugins) {
            this.plugins[plugin[0].toLowerCase() + plugin.slice(1)]
                = new Owl.Plugins[plugin](this);
        }

        this.init();
    }

    /**
     * Default options for the carousel.
     * @public
     */
    Owl.Defaults = {
        items: 3,
        loop: false,
        center: false,

        mouseDrag: true,
        touchDrag: true,
        pullDrag: true,
        freeDrag: false,

        margin: 0,
        stagePadding: 0,

        merge: false,
        mergeFit: true,
        autoWidth: false,

        startPosition: 0,

        smartSpeed: 250,
        fluidSpeed: false,
        dragEndSpeed: false,

        responsive: {},
        responsiveRefreshRate: 200,
        responsiveBaseElement: window,
        responsiveClass: false,

        fallbackEasing: 'swing',

        info: false,

        nestedItemSelector: false,
        itemElement: 'div',
        stageElement: 'div',

        // Classes and Names
        themeClass: 'owl-theme',
        baseClass: 'owl-carousel',
        itemClass: 'owl-item',
        centerClass: 'center',
        activeClass: 'active'
    };

    /**
     * Contains all registered plugins.
     * @public
     */
    Owl.Plugins = {};

    /**
     * Initializes the carousel.
     * @protected
     */
    Owl.prototype.init = function() {

        // Update options.items on given size
        this.setResponsiveOptions();

        this.trigger('initialize');

        // Add base class
        if (!this.dom.$el.hasClass(this.settings.baseClass)) {
            this.dom.$el.addClass(this.settings.baseClass);
        }

        // Add theme class
        if (!this.dom.$el.hasClass(this.settings.themeClass)) {
            this.dom.$el.addClass(this.settings.themeClass);
        }

        // Add theme class
        if (this.settings.rtl) {
            this.dom.$el.addClass('owl-rtl');
        }

        // Check support
        this.browserSupport();

        if (this.settings.autoWidth && this.state.imagesLoaded !== true) {
            var imgs, nestedSelector, width;
            imgs = this.dom.$el.find('img');
            nestedSelector = this.settings.nestedItemSelector ? '.' + this.settings.nestedItemSelector : undefined;
            width = this.dom.$el.children(nestedSelector).width();

            if (imgs.length && width <= 0) {
                this.preloadAutoWidthImages(imgs);
                return false;
            }
        }

        // Get and store window width
        // iOS safari likes to trigger unnecessary resize event
        this.width.prevWindow = this.viewport();

        // create stage object
        this.createStage();

        // Append local content
        this.fetchContent();

        // attach generic events
        this.eventsCall();

        // attach generic events
        this.internalEvents();

        this.dom.$el.addClass('owl-loading');
        this.refresh(true);
        this.dom.$el.removeClass('owl-loading').addClass('owl-loaded');

        this.trigger('initialized');

        // attach custom control events
        this.addTriggerableEvents();
    };

    /**
     * Sets responsive options.
     * @protected
     */
    Owl.prototype.setResponsiveOptions = function() {
        if (!this.options.responsive) {
            this.settings = $.extend({}, this.options);
        } else {
            var viewport = this.viewport(),
                overwrites = this.options.responsive,
                match = -1;

            $.each(overwrites, function(breakpoint) {
                if (breakpoint <= viewport && breakpoint > match) {
                    match = Number(breakpoint);
                }
            });

            this.settings = $.extend({}, this.options, overwrites[match]);
            delete this.settings.responsive;

            // Responsive Class
            if (this.settings.responsiveClass) {
                this.dom.$el.attr('class', function(i, c) {
                    return c.replace(/\b owl-responsive-\S+/g, '');
                }).addClass('owl-responsive-' + match);
            }
        }
    };

    /**
     * Updates option logic if necessery.
     * @protected
     */
    Owl.prototype.optionsLogic = function() {
        // Toggle Center class
        this.dom.$el.toggleClass('owl-center', this.settings.center);

        // if items number is less than in body
        if (this.settings.loop && this.num.oItems < this.settings.items) {
            this.settings.loop = false;
        }

        if (this.settings.autoWidth) {
            this.settings.stagePadding = false;
            this.settings.merge = false;
        }
    };

    /**
     * Creates stage and outer-stage elements.
     * @protected
     */
    Owl.prototype.createStage = function() {
        var oStage = document.createElement('div'),
            stage = document.createElement(this.settings.stageElement);

        oStage.className = 'owl-stage-outer';
        stage.className = 'owl-stage';

        oStage.appendChild(stage);
        this.dom.el.appendChild(oStage);

        this.dom.oStage = oStage;
        this.dom.$oStage = $(oStage);
        this.dom.stage = stage;
        this.dom.$stage = $(stage);

        oStage = null;
        stage = null;
    };

    /**
     * Creates an item container.
     * @protected
     * @returns {jQuery} - The item container.
     */
    Owl.prototype.createItemContainer = function() {
        var item = document.createElement(this.settings.itemElement);
        item.className = this.settings.itemClass;
        return $(item);
    };

    /**
     * Fetches the content.
     * @protected
     */
    Owl.prototype.fetchContent = function(extContent) {
        if (extContent) {
            this.dom.$content = (extContent instanceof jQuery) ? extContent : $(extContent);
        } else if (this.settings.nestedItemSelector) {
            this.dom.$content = this.dom.$el.find('.' + this.settings.nestedItemSelector).not('.owl-stage-outer');
        } else {
            this.dom.$content = this.dom.$el.children().not('.owl-stage-outer');
        }
        // content length
        this.num.oItems = this.dom.$content.length;

        // init Structure
        if (this.num.oItems !== 0) {
            this.initStructure();
        }
    };

    /**
     * Initializes the content struture.
     * @protected
     */
    Owl.prototype.initStructure = function() {
        this.createNormalStructure();
    };

    /**
     * Creates small/mid weight content structure.
     * @protected
     * @todo This results in a poor performance,
     * but this is due to the approach of completely
     * rebuild the existing DOM tree from scratch,
     * rather to use them. The effort to implement
     * this with a good performance, while maintaining
     * the original approach is disproportionate.
     */
    Owl.prototype.createNormalStructure = function() {
        var i, $item;
        for (i = 0; i < this.num.oItems; i++) {
            $item = this.createItemContainer();
            this.initializeItemContainer($item, this.dom.$content[i]);
            this.dom.$stage.append($item);
        }
        this.dom.$content = null;
    };

    /**
     * Creates custom content structure.
     * @protected
     */
    Owl.prototype.createCustomStructure = function(howManyItems) {
        var i, $item;
        for (i = 0; i < howManyItems; i++) {
            $item = this.createItemContainer();
            this.createItemContainerData($item);
            this.dom.$stage.append($item);
        }
    };

    /**
     * Initializes item container with provided content.
     * @protected
     * @param {jQuery} item - The item that has to be filled.
     * @param {HTMLElement|jQuery|string} content - The content that fills the item.
     */
    Owl.prototype.initializeItemContainer = function(item, content) {
        this.trigger('change', { property: { name: 'item', value: item } });

        this.createItemContainerData(item);
        item.append(content);

        this.trigger('changed', { property: { name: 'item', value: item } });
    };

    /**
     * Creates item container data.
     * @protected
     * @param {jQuery} item - The item for which the data are to be set.
     * @param {jQuery} [source] - The item whose data are to be copied.
     */
    Owl.prototype.createItemContainerData = function(item, source) {
        var data = $.extend({}, this.itemData);

        if (source) {
            $.extend(data, source.data('owl-item'));
        }

        item.data('owl-item', data);
    };

    /**
     * Clones an item container.
     * @protected
     * @param {jQuery} item - The item to clone.
     * @returns {jQuery} - The cloned item.
     */
    Owl.prototype.cloneItemContainer = function(item) {
        var $clone = item.clone(true, true).addClass('cloned');
        // somehow data references the same object
        this.createItemContainerData($clone, $clone);
        $clone.data('owl-item').clone = true;
        return $clone;
    };

    /**
     * Updates original items index data.
     * @protected
     */
    Owl.prototype.updateLocalContent = function() {

        var k, item;

        this.dom.$oItems = this.dom.$stage.find('.' + this.settings.itemClass).filter(function() {
            return $(this).data('owl-item').clone === false;
        });

        this.num.oItems = this.dom.$oItems.length;
        // update index on original items

        for (k = 0; k < this.num.oItems; k++) {
            item = this.dom.$oItems.eq(k);
            item.data('owl-item').index = k;
        }
    };

    /**
     * Creates clones for infinity loop.
     * @protected
     */
    Owl.prototype.loopClone = function() {
        if (!this.settings.loop || this.num.oItems < this.settings.items) {
            return false;
        }

        var append, prepend, i,
            items = this.settings.items,
            last = this.num.oItems - 1;

        // if neighbour margin then add one more duplicat
        if (this.settings.stagePadding && this.settings.items === 1) {
            items += 1;
        }
        this.num.cItems = items * 2;

        for (i = 0; i < items; i++) {
            append = this.cloneItemContainer(this.dom.$oItems.eq(i));
            prepend = this.cloneItemContainer(this.dom.$oItems.eq(last - i));

            this.dom.$stage.append(append);
            this.dom.$stage.prepend(prepend);
        }

        this.dom.$cItems = this.dom.$stage.find('.' + this.settings.itemClass).filter(function() {
            return $(this).data('owl-item').clone === true;
        });
    };

    /**
     * Update cloned elements.
     * @protected
     */
    Owl.prototype.reClone = function() {
        // remove cloned items
        if (this.dom.$cItems !== null) { // && (this.num.oItems !== 0 &&
            // this.num.oItems <=
            // this.settings.items)){
            this.dom.$cItems.remove();
            this.dom.$cItems = null;
            this.num.cItems = 0;
        }

        if (!this.settings.loop) {
            return;
        }
        // generete new elements
        this.loopClone();
    };

    /**
     * Updates all items index data.
     * @protected
     */
    Owl.prototype.calculate = function() {

        var i, j, elMinusMargin, dist, allItems, iWidth,  mergeNumber,  posLeft = 0, fullWidth = 0;

        // element width minus neighbour
        this.width.el = this.dom.$el.width() - (this.settings.stagePadding * 2);

        // to check
        this.width.view = this.dom.$el.width();

        // calculate width minus addition margins
        elMinusMargin = this.width.el - (this.settings.margin * (this.settings.items === 1 ? 0 : this.settings.items - 1));

        // calculate element width and item width
        this.width.el = this.width.el + this.settings.margin ;
        this.width.item = ((elMinusMargin / this.settings.items) + this.settings.margin + 1).toFixed(3);

        this.dom.$items = this.dom.$stage.find('.owl-item');
        this.num.items = this.dom.$items.length;

        // change to autoWidths
        if (this.settings.autoWidth) {
            this.dom.$items.css('width', '');
        }

        // Set grid array
        this._coordinates = [];
        this.num.merged = [];

        // item distances
        if (this.settings.rtl) {
            dist = this.settings.center ? -((this.width.el) / 2) : 0;
        } else {
            dist = this.settings.center ? (this.width.el) / 2 : 0;
        }

        this.width.mergeStage = 0;

        // Calculate items positions
        for (i = 0; i < this.num.items; i++) {

            // check merged items

            if (this.settings.merge) {
                mergeNumber = this.dom.$items.eq(i).find('[data-merge]').attr('data-merge') || 1;
                if (this.settings.mergeFit && mergeNumber > this.settings.items) {
                    mergeNumber = this.settings.items;
                }
                this.num.merged.push(parseInt(mergeNumber));
                this.width.mergeStage += this.width.item * this.num.merged[i];
            } else {
                this.num.merged.push(1);
            }

            iWidth = this.width.item * this.num.merged[i];

            // autoWidth item size
            if (this.settings.autoWidth) {
                iWidth = this.dom.$items.eq(i).width() + this.settings.margin;
                if (this.settings.rtl) {
                    this.dom.$items[i].style.marginLeft = this.settings.margin + 'px';
                } else {
                    this.dom.$items[i].style.marginRight = this.settings.margin + 'px';
                }

            }
            // push item position into array
            this._coordinates.push(dist);

            // update item data
            this.dom.$items.eq(i).data('owl-item').posLeft = posLeft;
            this.dom.$items.eq(i).data('owl-item').width = iWidth;

            // dist starts from middle of stage if center
            // posLeft always starts from 0
            if (this.settings.rtl) {
                dist += iWidth;
                posLeft += iWidth;
            } else {
                dist -= iWidth;
                posLeft -= iWidth;
            }

            fullWidth -= Math.abs(iWidth);

            // update position if center
            if (this.settings.center) {
                this._coordinates[i] = !this.settings.rtl ? this._coordinates[i] - (iWidth / 2) : this._coordinates[i]
                    + (iWidth / 2);
            }
        }

        if (this.settings.autoWidth) {
            this.width.stage = this.settings.center ? Math.abs(fullWidth) : Math.abs(dist);
        } else {
            this.width.stage = Math.abs(fullWidth);
        }

        // update indexAbs on all items
        allItems = this.num.oItems + this.num.cItems;

        for (j = 0; j < allItems; j++) {
            this.dom.$items.eq(j).data('owl-item').indexAbs = j;
        }

        // Recalculate grid
        this.setSizes();
    };

    /**
     * Set sizes on elements from `collectData`.
     * @protected
     * @todo CRAZY FIX!!! Doublecheck this!
     */
    Owl.prototype.setSizes = function() {

        // show neighbours
        if (this.settings.stagePadding !== false) {
            this.dom.oStage.style.paddingLeft = this.settings.stagePadding + 'px';
            this.dom.oStage.style.paddingRight = this.settings.stagePadding + 'px';
        }

        // if(this.width.stagePrev > this.width.stage){
        if (this.settings.rtl) {
            window.setTimeout($.proxy(function() {
                this.dom.stage.style.width = this.width.stage + 'px';
            }, this), 0);
        } else {
            this.dom.stage.style.width = this.width.stage + 'px';
        }

        for (var i = 0; i < this.num.items; i++) {

            // Set items width
            if (!this.settings.autoWidth) {
                this.dom.$items[i].style.width = this.width.item - (this.settings.margin) + 'px';
            }
            // add margin
            if (this.settings.rtl) {
                this.dom.$items[i].style.marginLeft = this.settings.margin + 'px';
            } else {
                this.dom.$items[i].style.marginRight = this.settings.margin + 'px';
            }

            if (this.num.merged[i] !== 1 && !this.settings.autoWidth) {
                this.dom.$items[i].style.width = (this.width.item * this.num.merged[i]) - (this.settings.margin) + 'px';
            }
        }

        // save prev stage size
        this.width.stagePrev = this.width.stage;
    };

    /**
     * Updates all data by calling `refresh`.
     * @protected
     */
    Owl.prototype.responsive = function() {

        if (!this.num.oItems) {
            return false;
        }
        // If El width hasnt change then stop responsive
        var elChanged = this.isElWidthChanged();
        if (!elChanged) {
            return false;
        }

        if (this.trigger('resize').isDefaultPrevented()) {
            return false;
        }

        this.state.responsive = true;
        this.refresh();
        this.state.responsive = false;

        this.trigger('resized');
    };

    /**
     * Refreshes the carousel primarily for adaptive purposes.
     * @public
     */
    Owl.prototype.refresh = function() {
        var current = this.dom.$oItems && this.dom.$oItems.eq(this.normalize(this.current(), true));

        this.trigger('refresh');

        // Update Options for given width
        this.setResponsiveOptions();

        // update info about local content
        this.updateLocalContent();

        // udpate options
        this.optionsLogic();

        // if no items then stop
        if (this.num.oItems === 0) {
            return false;
        }

        // Hide and Show methods helps here to set a proper widths.
        // This prevents Scrollbar to be calculated in stage width
        this.dom.$stage.addClass('owl-refresh');

        // Remove clones and generate new ones
        this.reClone();

        // calculate
        this.calculate();

        // aaaand show.
        this.dom.$stage.removeClass('owl-refresh');

        if (!current) {
            this.dom.oStage.scrollLeft = 0;
            this.reset(this.dom.$oItems.eq(0).data('owl-item').indexAbs);
        } else {
            this.reset(current.data('owl-item').indexAbs); // fix that
        }

        this.state.orientation = window.orientation;

        this.watchVisibility();

        this.trigger('refreshed');
    };

    /**
     * Updates information about current state of items (visibile, hidden, active, etc.).
     * @protected
     */
    Owl.prototype.updateActiveItems = function() {
        this.trigger('change', { property: { name: 'items', value: this.dom.$items } });

        var i, j, item, ipos, iwidth, outsideView;

        // clear states
        for (i = 0; i < this.num.items; i++) {
            this.dom.$items.eq(i).data('owl-item').active = false;
            this.dom.$items.eq(i).data('owl-item').current = false;
            this.dom.$items.eq(i).removeClass(this.settings.activeClass).removeClass(this.settings.centerClass);
        }

        this.num.active = 0;
        padding = this.settings.stagePadding * 2;
        stageX = this.coordinates(this.current()) + padding;
        view = this.settings.rtl ? this.width.view : -this.width.view;

        for (j = 0; j < this.num.items; j++) {

            item = this.dom.$items.eq(j);
            ipos = item.data('owl-item').posLeft;
            iwidth = item.data('owl-item').width;
            outsideView = this.settings.rtl ? ipos - iwidth - padding : ipos - iwidth + padding;

            if ((this.op(ipos, '<=', stageX) && (this.op(ipos, '>', stageX + view)))
                || (this.op(outsideView, '<', stageX) && this.op(outsideView, '>', stageX + view))) {

                this.num.active++;

                item.data('owl-item').active = true;
                item.data('owl-item').current = true;
                item.addClass(this.settings.activeClass);

                if (!this.settings.lazyLoad) {
                    item.data('owl-item').loaded = true;
                }
                if (this.settings.loop) {
                    this.updateClonedItemsState(item.data('owl-item').index);
                }
            }
        }

        if (this.settings.center) {
            this.dom.$items.eq(this.current()).addClass(this.settings.centerClass).data('owl-item').center = true;
        }
        this.trigger('changed', { property: { name: 'items', value: this.dom.$items } });
    };

    /**
     * Sets current state on sibilings items for center.
     * @protected
     */
    Owl.prototype.updateClonedItemsState = function(activeIndex) {

        // find cloned center
        var center, $el, i;
        if (this.settings.center) {
            center = this.dom.$items.eq(this.current()).data('owl-item').index;
        }

        for (i = 0; i < this.num.items; i++) {
            $el = this.dom.$items.eq(i);
            if ($el.data('owl-item').index === activeIndex) {
                $el.data('owl-item').current = true;
                if ($el.data('owl-item').index === center) {
                    $el.addClass(this.settings.centerClass);
                }
            }
        }
    };

    /**
     * Save internal event references and add event based functions.
     * @protected
     */
    Owl.prototype.eventsCall = function() {
        // Save events references
        this.e._onDragStart = $.proxy(function(e) {
            this.onDragStart(e);
        }, this);
        this.e._onDragMove = $.proxy(function(e) {
            this.onDragMove(e);
        }, this);
        this.e._onDragEnd = $.proxy(function(e) {
            this.onDragEnd(e);
        }, this);
        this.e._transitionEnd = $.proxy(function(e) {
            this.transitionEnd(e);
        }, this);
        this.e._resizer = $.proxy(function() {
            this.responsiveTimer();
        }, this);
        this.e._responsiveCall = $.proxy(function() {
            this.responsive();
        }, this);
        this.e._preventClick = $.proxy(function(e) {
            this.preventClick(e);
        }, this);
    };

    /**
     * Checks window `resize` event.
     * @protected
     */
    Owl.prototype.responsiveTimer = function() {
        if (this.viewport() === this.width.prevWindow) {
            return false;
        }
        window.clearTimeout(this.resizeTimer);

        this.resizeTimer = window.setTimeout(this.e._responsiveCall, this.settings.responsiveRefreshRate);
        this.width.prevWindow = this.viewport();
    };

    /**
     * Checks for touch/mouse drag options and add necessery event handlers.
     * @protected
     */
    Owl.prototype.internalEvents = function() {
        var isTouch = isTouchSupport(),
            isTouchIE = isTouchSupportIE();

        if (isTouch && !isTouchIE) {
            this.dragType = [ 'touchstart', 'touchmove', 'touchend', 'touchcancel' ];
        } else if (isTouch && isTouchIE) {
            this.dragType = [ 'MSPointerDown', 'MSPointerMove', 'MSPointerUp', 'MSPointerCancel' ];
        } else {
            this.dragType = [ 'mousedown', 'mousemove', 'mouseup' ];
        }

        if ((isTouch || isTouchIE) && this.settings.touchDrag) {
            // touch cancel event
            this.on(document, this.dragType[3], this.e._onDragEnd);

        } else {
            // firefox startdrag fix - addeventlistener doesnt work here :/
            this.dom.$stage.on('dragstart', function() {
                return false;
            });

            if (this.settings.mouseDrag) {
                // disable text select
                this.dom.stage.onselectstart = function() {
                    return false;
                };
            } else {
                // enable text select
                this.dom.$el.addClass('owl-text-select-on');
            }
        }

        // Catch transitionEnd event
        if (this.transitionEndVendor) {
            this.on(this.dom.stage, this.transitionEndVendor, this.e._transitionEnd, false);
        }

        // Responsive
        if (this.settings.responsive !== false) {
            this.on(window, 'resize', this.e._resizer, false);
        }

        this.dragEvents();
    };

    /**
     * Triggers event handlers for drag events.
     * @protected
     */
    Owl.prototype.dragEvents = function() {

        if (this.settings.touchDrag && (this.dragType[0] === 'touchstart' || this.dragType[0] === 'MSPointerDown')) {
            this.on(this.dom.stage, this.dragType[0], this.e._onDragStart, false);
        } else if (this.settings.mouseDrag && this.dragType[0] === 'mousedown') {
            this.on(this.dom.stage, this.dragType[0], this.e._onDragStart, false);
        } else {
            this.off(this.dom.stage, this.dragType[0], this.e._onDragStart);
        }
    };

    /**
     * Handles touchstart/mousedown event.
     * @protected
     * @param {Event} event - The event arguments.
     */
    Owl.prototype.onDragStart = function(event) {
        var ev, isTouchEvent, pageX, pageY, animatedPos;

        ev = event.originalEvent || event || window.event;

        // prevent right click
        if (ev.which === 3) {
            return false;
        }

        if (this.dragType[0] === 'mousedown') {
            this.dom.$stage.addClass('owl-grab');
        }

        this.trigger('drag');
        this.drag.startTime = new Date().getTime();
        this.speed(0);
        this.state.isTouch = true;
        this.state.isScrolling = false;
        this.state.isSwiping = false;
        this.drag.distance = 0;

        // if is 'touchstart'
        isTouchEvent = ev.type === 'touchstart';
        pageX = isTouchEvent ? event.targetTouches[0].pageX : (ev.pageX || ev.clientX);
        pageY = isTouchEvent ? event.targetTouches[0].pageY : (ev.pageY || ev.clientY);

        // get stage position left
        this.drag.offsetX = this.dom.$stage.position().left - this.settings.stagePadding;
        this.drag.offsetY = this.dom.$stage.position().top;

        if (this.settings.rtl) {
            this.drag.offsetX = this.dom.$stage.position().left + this.width.stage - this.width.el
                + this.settings.margin;
        }

        // catch position // ie to fix
        if (this.state.inMotion && this.support3d) {
            animatedPos = this.getTransformProperty();
            this.drag.offsetX = animatedPos;
            this.animate(animatedPos);
            this.state.inMotion = true;
        } else if (this.state.inMotion && !this.support3d) {
            this.state.inMotion = false;
            return false;
        }

        this.drag.startX = pageX - this.drag.offsetX;
        this.drag.startY = pageY - this.drag.offsetY;

        this.drag.start = pageX - this.drag.startX;
        this.drag.targetEl = ev.target || ev.srcElement;
        this.drag.updatedX = this.drag.start;

        // to do/check
        // prevent links and images dragging;
        if (this.drag.targetEl.tagName === "IMG" || this.drag.targetEl.tagName === "A") {
            this.drag.targetEl.draggable = false;
        }

        this.on(document, this.dragType[1], this.e._onDragMove, false);
        this.on(document, this.dragType[2], this.e._onDragEnd, false);
    };

    /**
     * Handles the touchmove/mousemove events.
     * @todo Simplify
     * @protected
     * @param {Event} event - The event arguments.
     */
    Owl.prototype.onDragMove = function(event) {
        var ev, isTouchEvent, pageX, pageY, minValue, maxValue, pull;

        if (!this.state.isTouch) {
            return;
        }

        if (this.state.isScrolling) {
            return;
        }

        ev = event.originalEvent || event || window.event;

        // if is 'touchstart'
        isTouchEvent = ev.type == 'touchmove';
        pageX = isTouchEvent ? ev.targetTouches[0].pageX : (ev.pageX || ev.clientX);
        pageY = isTouchEvent ? ev.targetTouches[0].pageY : (ev.pageY || ev.clientY);

        // Drag Direction
        this.drag.currentX = pageX - this.drag.startX;
        this.drag.currentY = pageY - this.drag.startY;
        this.drag.distance = this.drag.currentX - this.drag.offsetX;

        // Check move direction
        if (this.drag.distance < 0) {
            this.state.direction = this.settings.rtl ? 'right' : 'left';
        } else if (this.drag.distance > 0) {
            this.state.direction = this.settings.rtl ? 'left' : 'right';
        }
        // Loop
        if (this.settings.loop) {
            if (this.op(this.drag.currentX, '>', this.coordinates(this.minimum())) && this.state.direction === 'right') {
                this.drag.currentX -= (this.settings.center && this.coordinates(0)) - this.coordinates(this.num.oItems);
            } else if (this.op(this.drag.currentX, '<', this.coordinates(this.maximum())) && this.state.direction === 'left') {
                this.drag.currentX += (this.settings.center && this.coordinates(0)) - this.coordinates(this.num.oItems);
            }
        } else {
            // pull
            minValue = this.settings.rtl ? this.coordinates(this.maximum()) : this.coordinates(this.minimum());
            maxValue = this.settings.rtl ? this.coordinates(this.minimum()) : this.coordinates(this.maximum());
            pull = this.settings.pullDrag ? this.drag.distance / 5 : 0;
            this.drag.currentX = Math.max(Math.min(this.drag.currentX, minValue + pull), maxValue + pull);
        }

        // Lock browser if swiping horizontal

        if ((this.drag.distance > 8 || this.drag.distance < -8)) {
            if (ev.preventDefault !== undefined) {
                ev.preventDefault();
            } else {
                ev.returnValue = false;
            }
            this.state.isSwiping = true;
        }

        this.drag.updatedX = this.drag.currentX;

        // Lock Owl if scrolling
        if ((this.drag.currentY > 16 || this.drag.currentY < -16) && this.state.isSwiping === false) {
            this.state.isScrolling = true;
            this.drag.updatedX = this.drag.start;
        }

        this.animate(this.drag.updatedX);
    };

    /**
     * Handles the touchend/mouseup events.
     * @protected
     */
    Owl.prototype.onDragEnd = function() {
        var compareTimes, distanceAbs, closest;

        if (!this.state.isTouch) {
            return;
        }
        if (this.dragType[0] === 'mousedown') {
            this.dom.$stage.removeClass('owl-grab');
        }

        this.trigger('dragged');

        // prevent links and images dragging;
        this.drag.targetEl.removeAttribute("draggable");

        // remove drag event listeners

        this.state.isTouch = false;
        this.state.isScrolling = false;
        this.state.isSwiping = false;

        // to check
        if (this.drag.distance === 0 && this.state.inMotion !== true) {
            this.state.inMotion = false;
            return false;
        }

        // prevent clicks while scrolling

        this.drag.endTime = new Date().getTime();
        compareTimes = this.drag.endTime - this.drag.startTime;
        distanceAbs = Math.abs(this.drag.distance);

        // to test
        if (distanceAbs > 3 || compareTimes > 300) {
            this.removeClick(this.drag.targetEl);
        }

        closest = this.closest(this.drag.updatedX);

        this.speed(this.settings.dragEndSpeed || this.settings.smartSpeed);
        this.current(closest);

        // if pullDrag is off then fire transitionEnd event manually when stick
        // to border
        if (!this.settings.pullDrag && this.drag.updatedX === this.coordinates(closest)) {
            this.transitionEnd();
        }

        this.drag.distance = 0;

        this.off(document, this.dragType[1], this.e._onDragMove);
        this.off(document, this.dragType[2], this.e._onDragEnd);
    };

    /**
     * Attaches `preventClick` to disable link while swipping.
     * @protected
     * @param {HTMLElement} [target] - The target of the `click` event.
     */
    Owl.prototype.removeClick = function(target) {
        this.drag.targetEl = target;
        $(target).on('click.preventClick', this.e._preventClick);
        // to make sure click is removed:
        window.setTimeout(function() {
            $(target).off('click.preventClick');
        }, 300);
    };

    /**
     * Suppresses click event.
     * @protected
     * @param {Event} ev - The event arguments.
     */
    Owl.prototype.preventClick = function(ev) {
        if (ev.preventDefault) {
            ev.preventDefault();
        } else {
            ev.returnValue = false;
        }
        if (ev.stopPropagation) {
            ev.stopPropagation();
        }
        $(ev.target).off('click.preventClick');
    };

    /**
     * Catches stage position while animate (only CSS3).
     * @protected
     * @returns
     */
    Owl.prototype.getTransformProperty = function() {
        var transform, matrix3d;

        transform = window.getComputedStyle(this.dom.stage, null).getPropertyValue(this.vendorName + 'transform');
        // var transform = this.dom.$stage.css(this.vendorName + 'transform')
        transform = transform.replace(/matrix(3d)?\(|\)/g, '').split(',');
        matrix3d = transform.length === 16;

        return matrix3d !== true ? transform[4] : transform[12];
    };

    /**
     * Gets absolute position of the closest item for a coordinate.
     * @protected
     * @param {Number} coordinate - The coordinate in pixel.
     * @return {Number} - The absolute position of the closest item.
     */
    Owl.prototype.closest = function(coordinate) {
        var position = 0, pull = 30;

        if (!this.settings.freeDrag) {
            // check closest item
            $.each(this.coordinates(), $.proxy(function(index, value) {
                if (coordinate > value - pull && coordinate < value + pull) {
                    position = index;
                } else if (this.op(coordinate, '<', value)
                    && this.op(coordinate, '>', this.coordinates(index + 1) || value - this.width.el)) {
                    position = this.state.direction === 'left' ? index + 1 : index;
                }
            }, this));
        }

        if (!this.settings.loop) {
            // non loop boundries
            if (this.op(coordinate, '>', this.coordinates(this.minimum()))) {
                position = coordinate = this.minimum();
            } else if (this.op(coordinate, '<', this.coordinates(this.maximum()))) {
                position = coordinate = this.maximum();
            }
        }

        return position;
    };

    /**
     * Animates the stage.
     * @public
     * @param {Number} coordinate - The coordinate in pixels.
     */
    Owl.prototype.animate = function(coordinate) {
        this.trigger('translate');
        this.state.inMotion = this.speed() > 0;

        if (this.support3d) {
            this.dom.$stage.css({
                transform: 'translate3d(' + coordinate + 'px' + ',0px, 0px)',
                transition: (this.speed() / 1000) + 's'
            });
        } else if (this.state.isTouch) {
            this.dom.$stage.css({
                left: coordinate + 'px'
            });
        } else {
            this.dom.$stage.animate({
                left: coordinate
            }, this.speed() / 1000, this.settings.fallbackEasing, $.proxy(function() {
                if (this.state.inMotion) {
                    this.transitionEnd();
                }
            }, this));
        }
    };

    /**
     * Sets the absolute position of the current item.
     * @public
     * @param {Number} [position] - The new absolute position or nothing to leave it unchanged.
     * @returns {Number} - The absolute position of the current item.
     */
    Owl.prototype.current = function(position) {
        if (position === undefined) {
            return this._current;
        }

        if (this.num.oItems === 0) {
            return undefined;
        }

        position = this.normalize(position);

        if (this._current === position) {
            this.animate(this.coordinates(this._current));
        } else {
            var event = this.trigger('change', { property: { name: 'position', value: position } });

            if (event.data !== undefined) {
                position = this.normalize(event.data);
            }

            this._current = position;

            this.animate(this.coordinates(this._current));

            this.updateActiveItems();

            this.trigger('changed', { property: { name: 'position', value: this._current } });
        }

        return this._current;
    };

    /**
     * Resets the absolute position of the current item.
     * @public
     * @param {Number} position - The absolute position of the new item.
     */
    Owl.prototype.reset = function(position) {
        this.suppress([ 'change', 'changed' ]);
        this.speed(0);
        this.current(position);
        this.release([ 'change', 'changed' ]);
    };

    /**
     * Normalizes an absolute position for an item.
     * @public
     * @param {Number} position - The absolute position to normalize.
     * @param {Boolean} [relative=false] - Whether to return a relative position or not.
     * @return {Number} - The normalized position.
     */
    Owl.prototype.normalize = function(position, relative) {
        if (position === undefined || !this.dom.$items) {
            return undefined;
        }

        if (this.settings.loop) {
            var n = this.dom.$items.length;
            position = ((position % n) + n) % n;
        } else {
            position = Math.max(this.minimum(), Math.min(this.maximum(), position));
        }

        return relative ? this.dom.$items.eq(position).data('owl-item').index : position;
    };

    /**
     * Gets the absolute maximum position for an item.
     * @public
     * @returns {Number}
     */
    Owl.prototype.maximum = function() {
        var maximum, width,
            settings = this.settings;

        if (!settings.loop && settings.center) {
            maximum = this.num.oItems - 1;
        } else if (!settings.loop && !settings.center) {
            maximum = this.num.oItems - settings.items;
        } else if (settings.loop || settings.center) {
            maximum = this.num.oItems + settings.items;
        } else if (settings.autoWidth || settings.merge) {
            revert = settings.rtl ? 1 : -1;
            width = this.dom.$stage.width() - this.$el.width();
            $.each(this.coordinates(), function(index, coordinate) {
                if (coordinate * revert >= width) {
                    return false;
                }
                maximum = index + 1;
            });
        } else {
            throw 'Can not detect maximum absolute position.'
        }

        return maximum;
    };

    /**
     * Gets the absolute minimum position for an item.
     * @public
     * @returns {Number}
     */
    Owl.prototype.minimum = function() {
        return this.dom.$oItems.eq(0).data('owl-item').indexAbs;
    };

    /**
     * Sets the current animation speed.
     * @public
     * @param {Number} [speed] - The animation speed in millisecondsor nothing to leave it unchanged.
     * @returns {Number} - The current animation speed in milliseconds.
     */
    Owl.prototype.speed = function(speed) {
        if (speed !== undefined) {
            this._speed = speed;
        }

        return this._speed;
    };

    /**
     * Gets the coordinate for an item.
     * @public
     * @param {Number} [position] - The absolute position of the item.
     * @returns {Number|Array.<Number>} - The coordinate of the item in pixel or all coordinates.
     */
    Owl.prototype.coordinates = function(position) {
        return position !== undefined ? this._coordinates[position] : this._coordinates;
    };

    /**
     * Calculates the speed for a translation.
     * @protected
     * @param {Number} from - The absolute position of the start item.
     * @param {Number} to - The absolute position of the target item.
     * @param {Number} [factor=undefined] - The time factor in milliseconds.
     * @returns {Number} - The time in milliseconds for the translation.
     */
    Owl.prototype.duration = function(from, to, factor) {
        return Math.min(Math.max(Math.abs(to - from), 1), 6) * Math.abs((factor || this.settings.smartSpeed));
    };

    /**
     * Slides to the specified item.
     * @public
     * @param {Number} position - The position of the item.
     * @param {Number} [speed] - The time in milliseconds for the transition.
     */
    Owl.prototype.to = function(position, speed) {
        if (this.settings.loop) {
            var distance = position - this.normalize(this.current(), true),
                revert = this.current(),
                before = this.current(),
                after = this.current() + distance,
                direction = before - after < 0 ? true : false;

            if (after < this.settings.items && direction === false) {
                revert = this.num.items - (this.settings.items - before) - this.settings.items;
                this.reset(revert);
            } else if (after >= this.num.items - this.settings.items && direction === true) {
                revert = before - this.num.oItems;
                this.reset(revert);
            }
            window.clearTimeout(this.e._goToLoop);
            this.e._goToLoop = window.setTimeout($.proxy(function() {
                this.speed(this.duration(this.current(), revert + distance, speed));
                this.current(revert + distance);
            }, this), 30);
        } else {
            this.speed(this.duration(this.current(), position, speed));
            this.current(position);
        }
    };

    /**
     * Slides to the next item.
     * @public
     * @param {Number} [speed] - The time in milliseconds for the transition.
     */
    Owl.prototype.next = function(speed) {
        speed = speed || false;
        this.to(this.normalize(this.current(), true) + 1, speed);
    };

    /**
     * Slides to the previous item.
     * @public
     * @param {Number} [speed] - The time in milliseconds for the transition.
     */
    Owl.prototype.prev = function(speed) {
        speed = speed || false;
        this.to(this.normalize(this.current(), true) - 1, speed);
    };

    /**
     * Handles the end of an animation.
     * @protected
     * @param {Event} event - The event arguments.
     */
    Owl.prototype.transitionEnd = function(event) {

        // if css2 animation then event object is undefined
        if (event !== undefined) {
            event.stopPropagation();

            // Catch only owl-stage transitionEnd event
            var eventTarget = event.target || event.srcElement || event.originalTarget;
            if (eventTarget !== this.dom.stage) {
                return false;
            }
        }

        this.state.inMotion = false;
        this.trigger('translated');
    };

    /**
     * Checks if element width has changed
     * @protected
     * @returns {Booelan}
     */
    Owl.prototype.isElWidthChanged = function() {
        var newElWidth = this.dom.$el.width() - this.settings.stagePadding, // to
        // check
        prevElWidth = this.width.el + this.settings.margin;
        return newElWidth !== prevElWidth;
    };

    /**
     * Gets viewport width.
     * @protected
     * @return {Number} - The width in pixel.
     */
    Owl.prototype.viewport = function() {
        var width;
        if (this.options.responsiveBaseElement !== window) {
            width = $(this.options.responsiveBaseElement).width();
        } else if (window.innerWidth) {
            width = window.innerWidth;
        } else if (document.documentElement && document.documentElement.clientWidth) {
            width = document.documentElement.clientWidth;
        } else {
            throw 'Can not detect viewport width.';
        }
        return width;
    };

    /**
     * Replaces the current content.
     * @public
     * @param {HTMLElement|jQuery|String} content - The new content.
     */
    Owl.prototype.insertContent = function(content) {
        this.dom.$stage.empty();
        this.fetchContent(content);
        this.refresh();
    };

    /**
     * Adds an item.
     * @public
     * @param {HTMLElement|jQuery|String} content - The item content to add.
     * @param {Number} [position=0] - The position at which to insert the item.
     */
    Owl.prototype.addItem = function(content, position) {
        var $item = this.createItemContainer();

        position = position || 0;
        // wrap content
        this.initializeItemContainer($item, content);
        // if carousel is empty then append item
        if (this.dom.$oItems.length === 0) {
            this.dom.$stage.append($item);
        } else {
            // append item
            if (pos !== -1) {
                this.dom.$oItems.eq(position).before($item);
            } else {
                this.dom.$oItems.eq(position).after($item);
            }
        }
        // update and calculate carousel
        this.refresh();
    };

    /**
     * Removes an item.
     * @public
     * @param {Number} pos - The position of the item.
     */
    Owl.prototype.removeItem = function(pos) {
        this.dom.$oItems.eq(pos).remove();
        this.refresh();
    };

    /**
     * Adds triggerable events.
     * @protected
     */
    Owl.prototype.addTriggerableEvents = function() {
        var handler = $.proxy(function(callback, event) {
            return $.proxy(function(e) {
                if (e.relatedTarget !== this) {
                    this.suppress([ event ]);
                    callback.apply(this, [].slice.call(arguments, 1));
                    this.release([ event ]);
                }
            }, this);
        }, this);

        $.each({
            'next': this.next,
            'prev': this.prev,
            'to': this.to,
            'destroy': this.destroy,
            'refresh': this.refresh,
            'replace': this.insertContent,
            'add': this.addItem,
            'remove': this.removeItem
        }, $.proxy(function(event, callback) {
            this.dom.$el.on(event + '.owl.carousel', handler(callback, event + '.owl.carousel'));
        }, this));

    };

    /**
     * Watches the visibility of the carousel element.
     * @protected
     */
    Owl.prototype.watchVisibility = function() {

        // test on zepto
        if (!isElVisible(this.dom.el)) {
            this.dom.$el.addClass('owl-hidden');
            window.clearInterval(this.e._checkVisibile);
            this.e._checkVisibile = window.setInterval($.proxy(checkVisible, this), 500);
        }

        function isElVisible(el) {
            return el.offsetWidth > 0 && el.offsetHeight > 0;
        }

        function checkVisible() {
            if (isElVisible(this.dom.el)) {
                this.dom.$el.removeClass('owl-hidden');
                this.refresh();
                window.clearInterval(this.e._checkVisibile);
            }
        }
    };

    /**
     * Preloads images with auto width.
     * @protected
     * @todo Still to test
     */
    Owl.prototype.preloadAutoWidthImages = function(imgs) {
        var loaded, that, $el, img;

        loaded = 0;
        that = this;
        imgs.each(function(i, el) {
            $el = $(el);
            img = new Image();

            img.onload = function() {
                loaded++;
                $el.attr('src', img.src);
                $el.css('opacity', 1);
                if (loaded >= imgs.length) {
                    that.state.imagesLoaded = true;
                    that.init();
                }
            };

            img.src = $el.attr('src') || $el.attr('data-src') || $el.attr('data-src-retina');
        });
    };

    /**
     * Destroys the carousel.
     * @public
     */
    Owl.prototype.destroy = function() {

        if (this.dom.$el.hasClass(this.settings.themeClass)) {
            this.dom.$el.removeClass(this.settings.themeClass);
        }

        if (this.settings.responsive !== false) {
            this.off(window, 'resize', this.e._resizer);
        }

        if (this.transitionEndVendor) {
            this.off(this.dom.stage, this.transitionEndVendor, this.e._transitionEnd);
        }

        for ( var i in this.plugins) {
            this.plugins[i].destroy();
        }

        if (this.settings.mouseDrag || this.settings.touchDrag) {
            this.off(this.dom.stage, this.dragType[0], this.e._onDragStart);
            if (this.settings.mouseDrag) {
                this.off(document, this.dragType[3], this.e._onDragStart);
            }
            if (this.settings.mouseDrag) {
                this.dom.$stage.off('dragstart', function() {
                    return false;
                });
                this.dom.stage.onselectstart = function() {
                };
            }
        }

        // Remove event handlers in the ".owl.carousel" namespace
        this.dom.$el.off('.owl');

        if (this.dom.$cItems !== null) {
            this.dom.$cItems.remove();
        }
        this.e = null;
        this.dom.$el.data('owlCarousel', null);
        delete this.dom.el.owlCarousel;

        this.dom.$stage.unwrap();
        this.dom.$items.unwrap();
        this.dom.$items.contents().unwrap();
        this.dom = null;
    };

    /**
     * Operators to calculate right-to-left and left-to-right.
     * @protected
     * @param {Number} [a] - The left side operand.
     * @param {String} [o] - The operator.
     * @param {Number} [b] - The right side operand.
     */
    Owl.prototype.op = function(a, o, b) {
        var rtl = this.settings.rtl;
        switch (o) {
        case '<':
            return rtl ? a > b : a < b;
        case '>':
            return rtl ? a < b : a > b;
        case '>=':
            return rtl ? a <= b : a >= b;
        case '<=':
            return rtl ? a >= b : a <= b;
        default:
            break;
        }
    };

    /**
     * Attaches to an internal event.
     * @protected
     * @param {HTMLElement} element - The event source.
     * @param {String} event - The event name.
     * @param {Function} listener - The event handler to attach.
     * @param {Boolean} capture - Wether the event should be handled at the capturing phase or not.
     */
    Owl.prototype.on = function(element, event, listener, capture) {
        if (element.addEventListener) {
            element.addEventListener(event, listener, capture);
        } else if (element.attachEvent) {
            element.attachEvent('on' + event, listener);
        }
    };

    /**
     * Detaches from an internal event.
     * @protected
     * @param {HTMLElement} element - The event source.
     * @param {String} event - The event name.
     * @param {Function} listener - The attached event handler to detach.
     * @param {Boolean} capture - Wether the attached event handler was registered as a capturing listener or not.
     */
    Owl.prototype.off = function(element, event, listener, capture) {
        if (element.removeEventListener) {
            element.removeEventListener(event, listener, capture);
        } else if (element.detachEvent) {
            element.detachEvent('on' + event, listener);
        }
    };

    /**
     * Triggers an public event.
     * @protected
     * @param {String} name - The event name.
     * @param {*} [data=null] - The event data.
     * @param {String} [namespace=.owl.carousel] - The event namespace.
     * @returns {Event} - The event arguments.
     */
    Owl.prototype.trigger = function(name, data, namespace) {
        var status = {
            item: { count: this.num.oItems, index: this.current() }
        }, handler = $.camelCase(
            $.grep([ 'on', name, namespace ], function(v) { return v })
                .join('-').toLowerCase()
        ), event = $.Event(
            [ name, 'owl', namespace || 'carousel' ].join('.').toLowerCase(),
            $.extend({ relatedTarget: this }, status, data)
        );

        if (!this._supress[event.type]) {
            $.each(this.plugins, function(name, plugin) {
                if (plugin.onTrigger) {
                    plugin.onTrigger(event);
                }
            });

            this.dom.$el.trigger(event);

            if (typeof this.settings[handler] === 'function') {
                this.settings[handler].apply(this, event);
            }
        }

        return event;
    };

    /**
     * Suppresses events.
     * @protected
     * @param {Array.<String>} events - The events to suppress.
     */
    Owl.prototype.suppress = function(events) {
        $.each(events, $.proxy(function(index, event) {
            this._supress[event] = true;
        }, this));
    }

    /**
     * Releases suppressed events.
     * @protected
     * @param {Array.<String>} events - The events to release.
     */
    Owl.prototype.release = function(events) {
        $.each(events, $.proxy(function(index, event) {
            delete this._supress[event];
        }, this));
    }

    /**
     * Checks the availability of some browser features.
     * @protected
     */
    Owl.prototype.browserSupport = function() {
        this.support3d = isPerspective();

        if (this.support3d) {
            this.transformVendor = isTransform();

            // take transitionend event name by detecting transition
            var endVendors = [ 'transitionend', 'webkitTransitionEnd', 'transitionend', 'oTransitionEnd' ];
            this.transitionEndVendor = endVendors[isTransition()];

            // take vendor name from transform name
            this.vendorName = this.transformVendor.replace(/Transform/i, '');
            this.vendorName = this.vendorName !== '' ? '-' + this.vendorName.toLowerCase() + '-' : '';
        }

        this.state.orientation = window.orientation;
    };

    /**
     * Checks for CSS support.
     * @private
     * @param {Array} array - The CSS properties to check for.
     * @returns {Array} - Contains the supported CSS property name and its index or `false`.
     */
    function isStyleSupported(array) {
        var p, s, fake = document.createElement('div'), list = array;
        for (p in list) {
            s = list[p];
            if (typeof fake.style[s] !== 'undefined') {
                fake = null;
                return [ s, p ];
            }
        }
        return [ false ];
    }

    /**
     * Checks for CSS transition support.
     * @private
     * @todo Realy bad design
     * @returns {Number}
     */
    function isTransition() {
        return isStyleSupported([ 'transition', 'WebkitTransition', 'MozTransition', 'OTransition' ])[1];
    }

    /**
     * Checks for CSS transform support.
     * @private
     * @returns {String} The supported property name or false.
     */
    function isTransform() {
        return isStyleSupported([ 'transform', 'WebkitTransform', 'MozTransform', 'OTransform', 'msTransform' ])[0];
    }

    /**
     * Checks for CSS perspective support.
     * @private
     * @returns {String} The supported property name or false.
     */
    function isPerspective() {
        return isStyleSupported([ 'perspective', 'webkitPerspective', 'MozPerspective', 'OPerspective', 'MsPerspective' ])[0];
    }

    /**
     * Checks wether touch is supported or not.
     * @private
     * @returns {Boolean}
     */
    function isTouchSupport() {
        return 'ontouchstart' in window || !!(navigator.msMaxTouchPoints);
    }

    /**
     * Checks wether touch is supported or not for IE.
     * @private
     * @returns {Boolean}
     */
    function isTouchSupportIE() {
        return window.navigator.msPointerEnabled;
    }

    /**
     * The jQuery Plugin for the Owl Carousel
     * @public
     */
    $.fn.owlCarousel = function(options) {
        return this.each(function() {
            if (!$(this).data('owlCarousel')) {
                $(this).data('owlCarousel', new Owl(this, options));
            }
        });
    };

    /**
     * The constructor for the jQuery Plugin
     * @public
     */
    $.fn.owlCarousel.Constructor = Owl;

})(window.Zepto || window.jQuery, window, document);

/**
 * LazyLoad Plugin
 * @version 2.0.0
 * @author Bartosz Wojciechowski
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {

    /**
     * Creates the lazy load plugin.
     * @class The Lazy Load Plugin
     * @param {Owl} scope - The Owl Carousel
     */
    LazyLoad = function(scope) {
        this.owl = scope;
        this.owl.options = $.extend({}, LazyLoad.Defaults, this.owl.options);

        this.handlers = {
            'changed.owl.carousel': $.proxy(function(e) {
                if (e.property.name == 'items' && e.property.value && !e.property.value.is(':empty')) {
                    this.check();
                }
            }, this)
        };

        this.owl.dom.$el.on(this.handlers);
    };

    /**
     * Default options.
     * @public
     */
    LazyLoad.Defaults = {
        lazyLoad: false
    };

    /**
     * Checks all items and if necessary, calls `preload`.
     * @protected
     */
    LazyLoad.prototype.check = function() {
        var attr = window.devicePixelRatio > 1 ? 'data-src-retina' : 'data-src',
            src, img, i, $item;

        for (i = 0; i < this.owl.num.items; i++) {
            $item = this.owl.dom.$items.eq(i);

            if ($item.data('owl-item').current === true && $item.data('owl-item').loaded === false) {
                img = $item.find('.owl-lazy');
                src = img.attr(attr);
                src = src || img.attr('data-src');
                if (src) {
                    img.css('opacity', '0');
                    this.preload(img, $item);
                }
            }
        }
    };

    /**
     * Preloads the images of an item.
     * @protected
     * @param {jQuery} images - The images to load.
     * @param {jQuery} $item - The item for which the images are loaded.
     */
    LazyLoad.prototype.preload = function(images, $item) {
        var $el, img, srcType;

        images.each($.proxy(function(i, el) {

            this.owl.trigger('load', null, 'lazy');

            $el = $(el);
            img = new Image();
            srcType = window.devicePixelRatio > 1 ? $el.attr('data-src-retina') : $el.attr('data-src');
            srcType = srcType || $el.attr('data-src');

            img.onload = $.proxy(function() {
                $item.data('owl-item').loaded = true;
                if ($el.is('img')) {
                    $el.attr('src', img.src);
                } else {
                    $el.css('background-image', 'url(' + img.src + ')');
                }

                $el.css('opacity', 1);
                this.owl.trigger('loaded', null, 'lazy');
            }, this);
            img.src = srcType;
        }, this));
    };

    /**
     * Destroys the plugin.
     * @public
     */
    LazyLoad.prototype.destroy = function() {
        var handler, property;

        for (handler in this.handlers) {
            this.owl.dom.$el.off(handler, this.handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    };

    $.fn.owlCarousel.Constructor.Plugins.lazyLoad = LazyLoad;

})(window.Zepto || window.jQuery, window, document);

/**
 * AutoHeight Plugin
 * @version 2.0.0
 * @author Bartosz Wojciechowski
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {

    /**
     * Creates the auto height plugin.
     * @class The Auto Height Plugin
     * @param {Owl} scope - The Owl Carousel
     */
    AutoHeight = function(scope) {
        this.owl = scope;
        this.owl.options = $.extend({}, AutoHeight.Defaults, this.owl.options);

        this.handlers = {
            'changed.owl.carousel': $.proxy(function(e) {
                if (e.property.name == 'position' && this.owl.settings.autoHeight){
                    this.setHeight();
                }
            }, this)
        };

        this.owl.dom.$el.on(this.handlers);
    };

    /**
     * Default options.
     * @public
     */
    AutoHeight.Defaults = {
        autoHeight: false,
        autoHeightClass: 'owl-height'
    };

    /**
     *
     * @param {Boolean} callback - Whether
     * @returns {Boolean}
     */
    AutoHeight.prototype.setHeight = function() {
        var loaded = this.owl.dom.$items.eq(this.owl.current()),
            stage = this.owl.dom.$oStage,
            iterations = 0,
            isLoaded;

        if (!this.owl.dom.$oStage.hasClass(this.owl.settings.autoHeightClass)) {
            this.owl.dom.$oStage.addClass(this.owl.settings.autoHeightClass);
        }

        isLoaded = window.setInterval(function() {
            iterations += 1;
            if (loaded.data('owl-item').loaded) {
                stage.height(loaded.height() + 'px');
                clearInterval(isLoaded);
            } else if (iterations === 500) {
                clearInterval(isLoaded);
            }
        }, 100);

    };

    AutoHeight.prototype.destroy = function() {
        var handler, property;

        for (handler in this.handlers) {
            this.owl.dom.$el.off(handler, this.handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    };

    $.fn.owlCarousel.Constructor.Plugins.autoHeight = AutoHeight;

})(window.Zepto || window.jQuery, window, document);

/**
 * Video Plugin
 * @version 2.0.0
 * @author Bartosz Wojciechowski
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {

    /**
     * Creates the video plugin.
     * @class The Video Plugin
     * @param {Owl} scope - The Owl Carousel
     */
    Video = function(scope) {
        this.owl = scope;
        this.owl.options = $.extend({}, Video.Defaults, this.owl.options);

        this.handlers = {
            'resize.owl.carousel': $.proxy(function(e) {
                if (this.owl.settings.video && !this.isInFullScreen()) {
                    e.preventDefault();
                }
            }, this),
            'refresh.owl.carousel changed.owl.carousel': $.proxy(function(e) {
                if (this.owl.state.videoPlay) {
                    this.stopVideo();
                }
            }, this),
            'refresh.owl.carousel refreshed.owl.carousel': $.proxy(function(e) {
                if (!this.owl.settings.video) {
                    return false;
                }
                this.refreshing = e.type == 'refresh';
            }, this),
            'changed.owl.carousel': $.proxy(function(e) {
                if (this.refreshing && e.property.name == 'items' && e.property.value && !e.property.value.is(':empty')) {
                    this.checkVideoLinks();
                }
            }, this)
        };

        this.owl.dom.$el.on(this.handlers);

        this.owl.dom.$el.on('click.owl.video', '.owl-video-play-icon', $.proxy(function(e) {
            this.playVideo(e);
        }, this));
    };

    /**
     * Default options.
     * @public
     */
    Video.Defaults = {
        video: false,
        videoHeight: false,
        videoWidth: false
    };

    /**
     * Checks if for any videos links exists.
     * @protected
     */
    Video.prototype.checkVideoLinks = function() {
        var videoEl, item, i;

        for (i = 0; i < this.owl.num.items; i++) {

            item = this.owl.dom.$items.eq(i);
            if (item.data('owl-item').hasVideo) {
                continue;
            }

            videoEl = item.find('.owl-video');
            if (videoEl.length) {
                this.owl.state.hasVideos = true;
                this.owl.dom.$items.eq(i).data('owl-item').hasVideo = true;
                videoEl.css('display', 'none');
                this.getVideoInfo(videoEl, item);
            }
        }
    };

    /**
     * Gets the video ID and the type (YouTube/Vimeo only).
     * @protected
     * @param {jQuery} videoEl - The element containing the video data.
     * @param {jQuery} item - The item containing the video.
     */
    Video.prototype.getVideoInfo = function(videoEl, item) {

        var info, type, id, dimensions,
            vimeoId = videoEl.data('vimeo-id'),
            youTubeId = videoEl.data('youtube-id'),
            width = videoEl.data('width') || this.owl.settings.videoWidth,
            height = videoEl.data('height') || this.owl.settings.videoHeight,
            url = videoEl.attr('href');

        if (vimeoId) {
            type = 'vimeo';
            id = vimeoId;
        } else if (youTubeId) {
            type = 'youtube';
            id = youTubeId;
        } else if (url) {
            id = url.match(/(http:|https:|)\/\/(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/);

            if (id[3].indexOf('youtu') > -1) {
                type = 'youtube';
            } else if (id[3].indexOf('vimeo') > -1) {
                type = 'vimeo';
            }
            id = id[6];
        } else {
            throw new Error('Missing video link.');
        }

        item.data('owl-item').videoType = type;
        item.data('owl-item').videoId = id;
        item.data('owl-item').videoWidth = width;
        item.data('owl-item').videoHeight = height;

        info = {
            type: type,
            id: id
        };

        // Check dimensions
        dimensions = width && height ? 'style="width:' + width + 'px;height:' + height + 'px;"' : '';

        // wrap video content into owl-video-wrapper div
        videoEl.wrap('<div class="owl-video-wrapper"' + dimensions + '></div>');

        this.createVideoTn(videoEl, info);
    };

    /**
     * Creates video thumbnail.
     * @protected
     * @param {jQuery} videoEl - The element containing the video data.
     * @param {Object} info - The video info object.
     * @see `getVideoInfo`
     */
    Video.prototype.createVideoTn = function(videoEl, info) {

        var tnLink, icon, path,
            customTn = videoEl.find('img'),
            srcType = 'src',
            lazyClass = '',
            that = this.owl;

        if (this.owl.settings.lazyLoad) {
            srcType = 'data-src';
            lazyClass = 'owl-lazy';
        }

        // Custom thumbnail

        if (customTn.length) {
            addThumbnail(customTn.attr(srcType));
            customTn.remove();
            return false;
        }

        function addThumbnail(tnPath) {
            icon = '<div class="owl-video-play-icon"></div>';

            if (that.settings.lazyLoad) {
                tnLink = '<div class="owl-video-tn ' + lazyClass + '" ' + srcType + '="' + tnPath + '"></div>';
            } else {
                tnLink = '<div class="owl-video-tn" style="opacity:1;background-image:url(' + tnPath + ')"></div>';
            }
            videoEl.after(tnLink);
            videoEl.after(icon);
        }

        if (info.type === 'youtube') {
            path = "http://img.youtube.com/vi/" + info.id + "/hqdefault.jpg";
            addThumbnail(path);
        } else if (info.type === 'vimeo') {
            $.ajax({
                type: 'GET',
                url: 'http://vimeo.com/api/v2/video/' + info.id + '.json',
                jsonp: 'callback',
                dataType: 'jsonp',
                success: function(data) {
                    path = data[0].thumbnail_large;
                    addThumbnail(path);
                    if (that.settings.loop) {
                        that.updateActiveItems();
                    }
                }
            });
        }
    };

    /**
     * Stops the current video.
     * @public
     */
    Video.prototype.stopVideo = function() {
        this.owl.trigger('stop', null, 'video');
        var item = this.owl.dom.$items.eq(this.owl.state.videoPlayIndex);
        item.find('.owl-video-frame').remove();
        item.removeClass('owl-video-playing');
        this.owl.state.videoPlay = false;
    };

    /**
     * Starts the current video.
     * @public
     * @param {Event} ev - The event arguments.
     */
    Video.prototype.playVideo = function(ev) {
        this.owl.trigger('play', null, 'video');

        if (this.owl.state.videoPlay) {
            this.stopVideo();
        }
        var videoLink, videoWrap, videoType,
            target = $(ev.target || ev.srcElement),
            item = target.closest('.' + this.owl.settings.itemClass);

        videoType = item.data('owl-item').videoType, id = item.data('owl-item').videoId, width = item
            .data('owl-item').videoWidth
            || Math.floor(item.data('owl-item').width - this.owl.settings.margin), height = item.data('owl-item').videoHeight
            || this.owl.dom.$stage.height();

        if (videoType === 'youtube') {
            videoLink = "<iframe width=\"" + width + "\" height=\"" + height + "\" src=\"http://www.youtube.com/embed/"
                + id + "?autoplay=1&v=" + id + "\" frameborder=\"0\" allowfullscreen></iframe>";
        } else if (videoType === 'vimeo') {
            videoLink = '<iframe src="http://player.vimeo.com/video/' + id + '?autoplay=1" width="' + width
                + '" height="' + height
                + '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
        }

        item.addClass('owl-video-playing');
        this.owl.state.videoPlay = true;
        this.owl.state.videoPlayIndex = item.data('owl-item').indexAbs;

        videoWrap = $('<div style="height:' + height + 'px; width:' + width + 'px" class="owl-video-frame">'
            + videoLink + '</div>');
        target.after(videoWrap);
    };

    /**
     * Checks whether an video is currently in full screen mode or not.
     * @protected
     * @returns {Boolean}
     */
    Video.prototype.isInFullScreen = function() {

        // if Vimeo Fullscreen mode
        var fullscreenElement = document.fullscreenElement || document.mozFullScreenElement
            || document.webkitFullscreenElement;
        if (fullscreenElement) {
            if ($(fullscreenElement.parentNode).hasClass('owl-video-frame')) {
                this.owl.speed(0);
                this.owl.state.isFullScreen = true;
            }
        }

        if (fullscreenElement && this.owl.state.isFullScreen && this.owl.state.videoPlay) {
            return false;
        }

        // Comming back from fullscreen
        if (this.owl.state.isFullScreen) {
            this.owl.state.isFullScreen = false;
            return false;
        }

        // check full screen mode and window orientation
        if (this.owl.state.videoPlay) {
            if (this.owl.state.orientation !== window.orientation) {
                this.owl.state.orientation = window.orientation;
                return false;
            }
        }
        return true;
    };

    /**
     * Destroys the plugin.
     */
    Video.prototype.destroy = function() {
        var handler, property;

        this.owl.dom.$el.off('click.owl.video');

        for (handler in this.handlers) {
            this.owl.dom.$el.off(handler, this.handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    };

    $.fn.owlCarousel.Constructor.Plugins.video = Video;

})(window.Zepto || window.jQuery, window, document);

/**
 * Animate Plugin
 * @version 2.0.0
 * @author Bartosz Wojciechowski
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {

    /**
     * Creates the animate plugin.
     * @class The Navigation Plugin
     * @param {Owl} scope - The Owl Carousel
     */
    Animate = function(scope) {
        this.core = scope;
        this.core.options = $.extend({}, Animate.Defaults, this.core.options);
        this.swapping = true;
        this.previous = undefined;
        this.next = undefined;

        this.handlers = {
            'change.owl.carousel': $.proxy(function(e) {
                if (e.property.name == 'position') {
                    this.previous = this.core.current();
                    this.next = e.property.value;
                }
            }, this),
            'drag.owl.carousel dragged.owl.carousel translated.owl.carousel': $.proxy(function(e) {
                this.swapping = e.type == 'translated';
            }, this),
            'translate.owl.carousel': $.proxy(function(e) {
                if (this.swapping && (this.core.options.animateOut || this.core.options.animateIn)) {
                    this.swap();
                }
            }, this)
        };

        this.core.dom.$el.on(this.handlers);
    };

    /**
     * Default options.
     * @public
     */
    Animate.Defaults = {
        animateOut: false,
        animateIn: false
    };

    /**
     * Toggles the animation classes whenever an translations starts.
     * @protected
     * @returns {Boolean|undefined}
     */
    Animate.prototype.swap = function() {

        if (this.core.settings.items !== 1 || !this.core.support3d) {
            return;
        }

        this.core.speed(0);

        var left,
            clear = $.proxy(this.clear, this),
            previous = this.core.dom.$items.eq(this.previous),
            next = this.core.dom.$items.eq(this.next),
            incoming = this.core.settings.animateIn,
            outgoing = this.core.settings.animateOut;

        if (this.core.current() === this.previous) {
            return;
        }

        if (outgoing) {
            left = this.core.coordinates(this.previous) - this.core.coordinates(this.next);
            previous.css( { 'left': left + 'px' } )
                .addClass('animated owl-animated-out')
                .addClass(outgoing)
                .one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', clear);
        }

        if (incoming) {
            next.addClass('animated owl-animated-in')
                .addClass(incoming)
                .one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', clear);
        }
    };

    Animate.prototype.clear = function(e) {
        $(e.target).css( { 'left': '' } )
            .removeClass('animated owl-animated-out owl-animated-in')
            .removeClass(this.core.settings.animateIn)
            .removeClass(this.core.settings.animateOut);
        this.core.transitionEnd();
    }

    /**
     * Destroys the plugin.
     * @public
     */
    Animate.prototype.destroy = function() {
        var handler, property;

        for (handler in this.handlers) {
            this.core.dom.$el.off(handler, this.handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    };

    $.fn.owlCarousel.Constructor.Plugins.Animate = Animate;

})(window.Zepto || window.jQuery, window, document);

/**
 * Autoplay Plugin
 * @version 2.0.0
 * @author Bartosz Wojciechowski
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {

    /**
     * Creates the autoplay plugin.
     * @class The Autoplay Plugin
     * @param {Owl} scope - The Owl Carousel
     */
    Autoplay = function(scope) {
        this.core = scope;
        this.core.options = $.extend({}, Autoplay.Defaults, this.core.options);

        this.handlers = {
            'translated.owl.carousel refreshed.owl.carousel': $.proxy(function() {
                this.autoplay();
            }, this),
            'play.owl.autoplay': $.proxy(function(e, t, s) {
                this.play(t, s);
            }, this),
            'stop.owl.autoplay': $.proxy(function() {
                this.stop();
            }, this),
            'mouseover.owl.autoplay': $.proxy(function() {
                if (this.core.settings.autoplayHoverPause) {
                    this.pause();
                }
            }, this),
            'mouseleave.owl.autoplay': $.proxy(function() {
                if (this.core.settings.autoplayHoverPause) {
                    this.autoplay();
                }
            }, this)
        };

        this.core.dom.$el.on(this.handlers);
    };

    /**
     * Default options.
     * @public
     */
    Autoplay.Defaults = {
        autoplay: false,
        autoplayTimeout: 5000,
        autoplayHoverPause: false,
        autoplaySpeed: false
    };

    /**
     * @protected
     * @todo Must be documented.
     */
    Autoplay.prototype.autoplay = function() {
        if (this.core.settings.autoplay && !this.core.state.videoPlay) {
            window.clearInterval(this.interval);

            this.interval = window.setInterval($.proxy(function() {
                this.play();
            }, this), this.core.settings.autoplayTimeout);
        } else {
            window.clearInterval(this.interval);
        }
    };

    /**
     * Starts the autoplay.
     * @public
     * @param {Number} [timeout] - ...
     * @param {Number} [speed] - ...
     * @returns {Boolean|undefined} - ...
     * @todo Must be documented.
     */
    Autoplay.prototype.play = function(timeout, speed) {
        // if tab is inactive - doesnt work in <IE10
        if (document.hidden === true) {
            return;
        }

        if (this.core.state.isTouch || this.core.state.isScrolling
            || this.core.state.isSwiping || this.core.state.inMotion) {
            return;
        }

        if (this.core.settings.autoplay === false) {
            window.clearInterval(this.interval);
            return;
        }

        this.core.next(this.core.settings.autoplaySpeed);
    };

    /**
     * Stops the autoplay.
     * @public
     */
    Autoplay.prototype.stop = function() {
        window.clearInterval(this.interval);
    };

    /**
     * Pauses the autoplay.
     * @public
     */
    Autoplay.prototype.pause = function() {
        window.clearInterval(this.interval);
    };

    /**
     * Destroys the plugin.
     */
    Autoplay.prototype.destroy = function() {
        var handler, property;

        window.clearInterval(this.interval);

        for (handler in this.handlers) {
            this.core.dom.$el.off(handler, this.handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    };

    $.fn.owlCarousel.Constructor.Plugins.autoplay = Autoplay;

})(window.Zepto || window.jQuery, window, document);

/**
 * Navigation Plugin
 * @version 2.0.0
 * @author Artus Kolanowski
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {
    'use strict';

    /**
     * Creates the navigation plugin.
     * @class The Navigation Plugin
     * @param {Owl} carousel - The Owl Carousel.
     */
    var Navigation = function(carousel) {
        /**
         * Reference to the core.
         * @type {Owl}
         */
        this.core = carousel;

        /**
         * Indicates whether the plugin is initialized or not.
         * @type {Boolean}
         */
        this.initialized = false;

        /**
         * The current paging indexes.
         * @type {Array}
         */
        this.pages = [];

        /**
         * All DOM elements of the user interface.
         * @type {Object}
         */
        this.controls = {};

        /**
         * Markup for an indicator.
         * @type {String}
         */
        this.template = null;

        /**
         * The carousel element.
         * @type {jQuery}
         */
        this.$element = this.core.dom.$el;

        /**
         * Overridden methods of the carousel.
         * @type {Object}
         */
        this.overrides = {
            next: this.core.next,
            prev: this.core.prev,
            to: this.core.to
        };

        /**
         * All event handlers.
         * @type {Object}
         */
        this.handlers = {
            'changed.owl.carousel': $.proxy(function(e) {
                if (e.property.name == 'items') {
                    if (!this.initialized) {
                        this.initialize();
                        this.initialized = true;
                    }
                    this.update();
                    this.draw();
                }
                if (this.filling) {
                    e.property.value.data('owl-item').dot = $(':first-child', e.property.value)
                        .find('[data-dot]').andSelf().data('dot');
                }
            }, this),
            'change.owl.carousel': $.proxy(function(e) {
                if (e.property.name == 'position' && !this.core.state.revert
                    && !this.core.settings.loop && this.core.settings.navRewind) {
                    var current = this.core.current(),
                        maximum = this.core.maximum(),
                        minimum = this.core.minimum();
                    e.data = e.property.value > maximum
                        ? current >= maximum ? minimum : maximum
                        : e.property.value < minimum ? maximum : e.property.value;
                }
                this.filling = this.core.settings.dotsData && e.property.name == 'item'
                    && e.property.value && e.property.value.is(':empty');
            }, this),
            'refreshed.owl.carousel': $.proxy(function() {
                if (this.initialized) {
                    this.update();
                    this.draw();
                }
            }, this)
        };

        // set default options
        this.core.options = $.extend({}, Navigation.Defaults, this.core.options);

        // register event handlers
        this.$element.on(this.handlers);
    }

    /**
     * Default options.
     * @public
     * @todo Rename `slideBy` to `navBy`
     */
    Navigation.Defaults = {
        nav: false,
        navRewind: true,
        navText: [ 'prev', 'next' ],
        navSpeed: false,
        navElement: 'div',
        navContainer: false,
        navContainerClass: 'owl-nav',
        navClass: [ 'owl-prev', 'owl-next' ],
        slideBy: 1,
        dotClass: 'owl-dot',
        dotsClass: 'owl-dots',
        dots: true,
        dotsEach: false,
        dotData: false,
        dotsSpeed: false,
        dotsContainer: false,
        controlsClass: 'owl-controls'
    }

    /**
     * Initializes the layout of the plugin and extends the carousel.
     * @protected
     */
    Navigation.prototype.initialize = function() {
        var $container, override,
            options = this.core.settings;

        // create the indicator template
        if (!options.dotsData) {
            this.template = $('<div>')
                .addClass(options.dotClass)
                .append($('<span>'))
                .prop('outerHTML');
        }

        // create controls container if needed
        if (!options.navContainer || !options.dotsContainer) {
            this.controls.$container = $('<div>')
                .addClass(options.controlsClass)
                .appendTo(this.$element);
        }

        // create DOM structure for absolute navigation
        this.controls.$indicators = options.dotsContainer ? $(options.dotsContainer)
            : $('<div>').hide().addClass(options.dotsClass).appendTo(this.controls.$container);

        this.controls.$indicators.on(this.core.dragType[2], 'div', $.proxy(function(e) {
            var index = $(e.target).parent().is(this.controls.$indicators)
                ? $(e.target).index() : $(e.target).parent().index();

            e.preventDefault();

            this.to(index, options.dotsSpeed);
        }, this));

        // create DOM structure for relative navigation
        $container = options.navContainer ? $(options.navContainer)
            : $('<div>').addClass(options.navContainerClass).prependTo(this.controls.$container);

        this.controls.$next = $('<' + options.navElement + '>');
        this.controls.$previous = this.controls.$next.clone();

        this.controls.$previous
            .addClass(options.navClass[0])
            .html(options.navText[0])
            .hide()
            .prependTo($container)
            .on(this.core.dragType[2], $.proxy(function(e) {
                this.prev();
            }, this));
        this.controls.$next
            .addClass(options.navClass[1])
            .html(options.navText[1])
            .hide()
            .appendTo($container)
            .on(this.core.dragType[2], $.proxy(function(e) {
                this.next();
            }, this));

        // override public methods of the carousel
        for (override in this.overrides) {
            this.core[override] = $.proxy(this[override], this);
        }
    }

    /**
     * Destroys the plugin.
     * @protected
     */
    Navigation.prototype.destroy = function() {
        var handler, control, property, override;

        for (handler in this.handlers) {
            this.$element.off(handler, this.handlers[handler]);
        }
        for (control in this.controls) {
            this.controls[control].remove();
        }
        for (override in this.overides) {
            this.core[override] = this.overrides[override];
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    }

    /**
     * Updates the internal state.
     * @protected
     */
    Navigation.prototype.update = function() {
        var i, j, k,
            options = this.core.settings,
            lower = this.core.num.cItems / 2,
            upper = this.core.num.items - lower,
            size = options.center || options.autoWidth || options.dotData
                ? 1 : options.dotsEach || options.items;

        if (options.slideBy !== 'page') {
            options.slideBy = Math.min(options.slideBy, options.items);
        }

        if (options.dots) {
            this.pages = [];

            for (i = lower, j = 0, k = 0; i < upper; i++) {
                if (j >= size || j === 0) {
                    this.pages.push({
                        start: i - lower,
                        end: i - lower + size - 1
                    });
                    j = 0, ++k;
                }
                j += this.core.num.merged[i];
            }
        }
    }

    /**
     * Draws the user interface.
     * @protected
     */
    Navigation.prototype.draw = function() {
        var difference, i, html = '',
            options = this.core.settings,
            $items = this.core.dom.$oItems,
            index = this.core.normalize(this.core.current(), true);

        if (options.nav && !options.loop && !options.navRewind) {
            this.controls.$previous.toggleClass('disabled', index <= 0);
            this.controls.$next.toggleClass('disabled', index >= this.core.maximum());
        }

        this.controls.$previous.toggle(options.nav);
        this.controls.$next.toggle(options.nav);

        if (options.dots) {
            difference = this.pages.length - this.controls.$indicators.children().length;

            if (difference > 0) {
                for (i = 0; i < Math.abs(difference); i++) {
                    html += options.dotData ? $items.eq(i).data('owl-item').dot : this.template;
                }
                this.controls.$indicators.append(html);
            } else if (difference < 0) {
                this.controls.$indicators.children().slice(difference).remove();
            }

            this.controls.$indicators.find('.active').removeClass('active');
            this.controls.$indicators.children().eq($.inArray(this.current(), this.pages)).addClass('active');
        }

        this.controls.$indicators.toggle(options.dots);
    }

    /**
     * Extends event data.
     * @protected
     * @param {Event} event - The event object which gets thrown.
     */
    Navigation.prototype.onTrigger = function(event) {
        var options = this.core.settings;

        event.page = {
            index: $.inArray(this.current(), this.pages),
            count: this.pages.length,
            size: options.center || options.autoWidth || options.dotData
                ? 1 : options.dotsEach || options.items
        };
    }

    /**
     * Gets the current page position of the carousel.
     * @protected
     * @returns {Number}
     */
    Navigation.prototype.current = function() {
        var index = this.core.normalize(this.core.current(), true);
        return $.grep(this.pages, function(o) {
            return o.start <= index && o.end >= index;
        }).pop();
    }

    /**
     * Gets the current succesor/predecessor position.
     * @protected
     * @returns {Number}
     */
    Navigation.prototype.getPosition = function(successor) {
        var position, length,
            options = this.core.settings;

        if (options.slideBy == 'page') {
            position = $.inArray(this.current(), this.pages);
            length = this.pages.length;
            successor ? ++position : --position;
            position = this.pages[((position % length) + length) % length].start;
        } else {
            position = this.core.normalize(this.core.current(), true);
            length = this.core.num.oItems;
            successor ? position += options.slideBy : position -= options.slideBy;
        }
        return position;
    }

    /**
     * Slides to the next item or page.
     * @public
     * @param {Number} [speed=false] - The time in milliseconds for the transition.
     */
    Navigation.prototype.next = function(speed) {
        $.proxy(this.overrides.to, this.core)(this.getPosition(true), speed);
    }

    /**
     * Slides to the previous item or page.
     * @public
     * @param {Number} [speed=false] - The time in milliseconds for the transition.
     */
    Navigation.prototype.prev = function(speed) {
        $.proxy(this.overrides.to, this.core)(this.getPosition(false), speed);
    }

    /**
     * Slides to the specified item or page.
     * @public
     * @param {Number} position - The position of the item or page.
     * @param {Number} [speed] - The time in milliseconds for the transition.
     * @param {Boolean} [standard=false] - Whether to use the standard behaviour or not.
     */
    Navigation.prototype.to = function(position, speed, standard) {
        var length;

        if (!standard) {
            length = this.pages.length;
            $.proxy(this.overrides.to, this.core)(this.pages[((position % length) + length) % length].start, speed);
        } else {
            $.proxy(this.overrides.to, this.core)(position, speed);
        }
    }

    $.fn.owlCarousel.Constructor.Plugins.Navigation = Navigation;

})(window.Zepto || window.jQuery, window, document);

/**
 * Hash Plugin
 * @version 2.0.0
 * @author Artus Kolanowski
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {
    'use strict';

    /**
     * Creates the hash plugin.
     * @class The Hash Plugin
     * @param {Owl} carousel - The Owl Carousel
     */
    var Hash = function(carousel) {
        /**
         * Reference to the core.
         * @type {Owl}
         */
        this.core = carousel;

        /**
         * Hash table for the hashes.
         * @type {Object}
         */
        this.hashes = {};

        /**
         * The carousel element.
         * @type {jQuery}
         */
        this.$element = this.core.dom.$el;

        /**
         * All event handlers.
         * @type {Object}
         */
        this.handlers = {
            'initialized.owl.carousel': $.proxy(function() {
                if (window.location.hash.substring(1)) {
                    $(window).trigger('hashchange.owl.navigation');
                }
            }, this),
            'changed.owl.carousel': $.proxy(function(e) {
                if (this.filling) {
                    e.property.value.data('owl-item').hash
                        = $(':first-child', e.property.value).find('[data-hash]').andSelf().data('hash');
                    this.hashes[e.property.value.data('owl-item').hash] = e.property.value;
                }
            }, this),
            'change.owl.carousel': $.proxy(function(e) {
                if (e.property.name == 'position' && this.core.current() === undefined
                    && this.core.settings.startPosition == 'URLHash') {
                    e.data = this.hashes[window.location.hash.substring(1)];
                }
                this.filling = e.property.name == 'item' && e.property.value && e.property.value.is(':empty');
            }, this),
        };

        // set default options
        this.core.options = $.extend({}, Hash.Defaults, this.core.options);

        // register the event handlers
        this.$element.on(this.handlers);

        // register event listener for hash navigation
        $(window).on('hashchange.owl.navigation', $.proxy(function() {
            var hash = window.location.hash.substring(1),
                items = this.core.dom.$oItems,
                position = this.hashes[hash] && items.index(this.hashes[hash]) || 0;

            if (!hash) {
                return false;
            }

            this.core.dom.oStage.scrollLeft = 0;
            this.core.to(position, false, true);
        }, this));
    }

    /**
     * Default options.
     * @public
     */
    Hash.Defaults = {
        URLhashListener: false
    }

    /**
     * Destroys the plugin.
     * @public
     */
    Hash.prototype.destroy = function() {
        var handler, property;

        $(window).off('hashchange.owl.navigation');

        for (handler in this.handlers) {
            this.owl.dom.$el.off(handler, this.handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    }

    $.fn.owlCarousel.Constructor.Plugins.Hash = Hash;

})(window.Zepto || window.jQuery, window, document);


/*!
jQuery Waypoints - v2.0.5
Copyright (c) 2011-2014 Caleb Troughton
Licensed under the MIT license.
https://github.com/imakewebthings/jquery-waypoints/blob/master/licenses.txt
*/
(function(){var t=[].indexOf||function(t){for(var e=0,n=this.length;e<n;e++){if(e in this&&this[e]===t)return e}return-1},e=[].slice;(function(t,e){if(typeof define==="function"&&define.amd){return define("waypoints",["jquery"],function(n){return e(n,t)})}else{return e(t.jQuery,t)}})(window,function(n,r){var i,o,l,s,f,u,c,a,h,d,p,y,v,w,g,m;i=n(r);a=t.call(r,"ontouchstart")>=0;s={horizontal:{},vertical:{}};f=1;c={};u="waypoints-context-id";p="resize.waypoints";y="scroll.waypoints";v=1;w="waypoints-waypoint-ids";g="waypoint";m="waypoints";o=function(){function t(t){var e=this;this.$element=t;this.element=t[0];this.didResize=false;this.didScroll=false;this.id="context"+f++;this.oldScroll={x:t.scrollLeft(),y:t.scrollTop()};this.waypoints={horizontal:{},vertical:{}};this.element[u]=this.id;c[this.id]=this;t.bind(y,function(){var t;if(!(e.didScroll||a)){e.didScroll=true;t=function(){e.doScroll();return e.didScroll=false};return r.setTimeout(t,n[m].settings.scrollThrottle)}});t.bind(p,function(){var t;if(!e.didResize){e.didResize=true;t=function(){n[m]("refresh");return e.didResize=false};return r.setTimeout(t,n[m].settings.resizeThrottle)}})}t.prototype.doScroll=function(){var t,e=this;t={horizontal:{newScroll:this.$element.scrollLeft(),oldScroll:this.oldScroll.x,forward:"right",backward:"left"},vertical:{newScroll:this.$element.scrollTop(),oldScroll:this.oldScroll.y,forward:"down",backward:"up"}};if(a&&(!t.vertical.oldScroll||!t.vertical.newScroll)){n[m]("refresh")}n.each(t,function(t,r){var i,o,l;l=[];o=r.newScroll>r.oldScroll;i=o?r.forward:r.backward;n.each(e.waypoints[t],function(t,e){var n,i;if(r.oldScroll<(n=e.offset)&&n<=r.newScroll){return l.push(e)}else if(r.newScroll<(i=e.offset)&&i<=r.oldScroll){return l.push(e)}});l.sort(function(t,e){return t.offset-e.offset});if(!o){l.reverse()}return n.each(l,function(t,e){if(e.options.continuous||t===l.length-1){return e.trigger([i])}})});return this.oldScroll={x:t.horizontal.newScroll,y:t.vertical.newScroll}};t.prototype.refresh=function(){var t,e,r,i=this;r=n.isWindow(this.element);e=this.$element.offset();this.doScroll();t={horizontal:{contextOffset:r?0:e.left,contextScroll:r?0:this.oldScroll.x,contextDimension:this.$element.width(),oldScroll:this.oldScroll.x,forward:"right",backward:"left",offsetProp:"left"},vertical:{contextOffset:r?0:e.top,contextScroll:r?0:this.oldScroll.y,contextDimension:r?n[m]("viewportHeight"):this.$element.height(),oldScroll:this.oldScroll.y,forward:"down",backward:"up",offsetProp:"top"}};return n.each(t,function(t,e){return n.each(i.waypoints[t],function(t,r){var i,o,l,s,f;i=r.options.offset;l=r.offset;o=n.isWindow(r.element)?0:r.$element.offset()[e.offsetProp];if(n.isFunction(i)){i=i.apply(r.element)}else if(typeof i==="string"){i=parseFloat(i);if(r.options.offset.indexOf("%")>-1){i=Math.ceil(e.contextDimension*i/100)}}r.offset=o-e.contextOffset+e.contextScroll-i;if(r.options.onlyOnScroll&&l!=null||!r.enabled){return}if(l!==null&&l<(s=e.oldScroll)&&s<=r.offset){return r.trigger([e.backward])}else if(l!==null&&l>(f=e.oldScroll)&&f>=r.offset){return r.trigger([e.forward])}else if(l===null&&e.oldScroll>=r.offset){return r.trigger([e.forward])}})})};t.prototype.checkEmpty=function(){if(n.isEmptyObject(this.waypoints.horizontal)&&n.isEmptyObject(this.waypoints.vertical)){this.$element.unbind([p,y].join(" "));return delete c[this.id]}};return t}();l=function(){function t(t,e,r){var i,o;if(r.offset==="bottom-in-view"){r.offset=function(){var t;t=n[m]("viewportHeight");if(!n.isWindow(e.element)){t=e.$element.height()}return t-n(this).outerHeight()}}this.$element=t;this.element=t[0];this.axis=r.horizontal?"horizontal":"vertical";this.callback=r.handler;this.context=e;this.enabled=r.enabled;this.id="waypoints"+v++;this.offset=null;this.options=r;e.waypoints[this.axis][this.id]=this;s[this.axis][this.id]=this;i=(o=this.element[w])!=null?o:[];i.push(this.id);this.element[w]=i}t.prototype.trigger=function(t){if(!this.enabled){return}if(this.callback!=null){this.callback.apply(this.element,t)}if(this.options.triggerOnce){return this.destroy()}};t.prototype.disable=function(){return this.enabled=false};t.prototype.enable=function(){this.context.refresh();return this.enabled=true};t.prototype.destroy=function(){delete s[this.axis][this.id];delete this.context.waypoints[this.axis][this.id];return this.context.checkEmpty()};t.getWaypointsByElement=function(t){var e,r;r=t[w];if(!r){return[]}e=n.extend({},s.horizontal,s.vertical);return n.map(r,function(t){return e[t]})};return t}();d={init:function(t,e){var r;e=n.extend({},n.fn[g].defaults,e);if((r=e.handler)==null){e.handler=t}this.each(function(){var t,r,i,s;t=n(this);i=(s=e.context)!=null?s:n.fn[g].defaults.context;if(!n.isWindow(i)){i=t.closest(i)}i=n(i);r=c[i[0][u]];if(!r){r=new o(i)}return new l(t,r,e)});n[m]("refresh");return this},disable:function(){return d._invoke.call(this,"disable")},enable:function(){return d._invoke.call(this,"enable")},destroy:function(){return d._invoke.call(this,"destroy")},prev:function(t,e){return d._traverse.call(this,t,e,function(t,e,n){if(e>0){return t.push(n[e-1])}})},next:function(t,e){return d._traverse.call(this,t,e,function(t,e,n){if(e<n.length-1){return t.push(n[e+1])}})},_traverse:function(t,e,i){var o,l;if(t==null){t="vertical"}if(e==null){e=r}l=h.aggregate(e);o=[];this.each(function(){var e;e=n.inArray(this,l[t]);return i(o,e,l[t])});return this.pushStack(o)},_invoke:function(t){this.each(function(){var e;e=l.getWaypointsByElement(this);return n.each(e,function(e,n){n[t]();return true})});return this}};n.fn[g]=function(){var t,r;r=arguments[0],t=2<=arguments.length?e.call(arguments,1):[];if(d[r]){return d[r].apply(this,t)}else if(n.isFunction(r)){return d.init.apply(this,arguments)}else if(n.isPlainObject(r)){return d.init.apply(this,[null,r])}else if(!r){return n.error("jQuery Waypoints needs a callback function or handler option.")}else{return n.error("The "+r+" method does not exist in jQuery Waypoints.")}};n.fn[g].defaults={context:r,continuous:true,enabled:true,horizontal:false,offset:0,triggerOnce:false};h={refresh:function(){return n.each(c,function(t,e){return e.refresh()})},viewportHeight:function(){var t;return(t=r.innerHeight)!=null?t:i.height()},aggregate:function(t){var e,r,i;e=s;if(t){e=(i=c[n(t)[0][u]])!=null?i.waypoints:void 0}if(!e){return[]}r={horizontal:[],vertical:[]};n.each(r,function(t,i){n.each(e[t],function(t,e){return i.push(e)});i.sort(function(t,e){return t.offset-e.offset});r[t]=n.map(i,function(t){return t.element});return r[t]=n.unique(r[t])});return r},above:function(t){if(t==null){t=r}return h._filter(t,"vertical",function(t,e){return e.offset<=t.oldScroll.y})},below:function(t){if(t==null){t=r}return h._filter(t,"vertical",function(t,e){return e.offset>t.oldScroll.y})},left:function(t){if(t==null){t=r}return h._filter(t,"horizontal",function(t,e){return e.offset<=t.oldScroll.x})},right:function(t){if(t==null){t=r}return h._filter(t,"horizontal",function(t,e){return e.offset>t.oldScroll.x})},enable:function(){return h._invoke("enable")},disable:function(){return h._invoke("disable")},destroy:function(){return h._invoke("destroy")},extendFn:function(t,e){return d[t]=e},_invoke:function(t){var e;e=n.extend({},s.vertical,s.horizontal);return n.each(e,function(e,n){n[t]();return true})},_filter:function(t,e,r){var i,o;i=c[n(t)[0][u]];if(!i){return[]}o=[];n.each(i.waypoints[e],function(t,e){if(r(i,e)){return o.push(e)}});o.sort(function(t,e){return t.offset-e.offset});return n.map(o,function(t){return t.element})}};n[m]=function(){var t,n;n=arguments[0],t=2<=arguments.length?e.call(arguments,1):[];if(h[n]){return h[n].apply(null,t)}else{return h.aggregate.call(null,n)}};n[m].settings={resizeThrottle:100,scrollThrottle:30};return i.on("load.waypoints",function(){return n[m]("refresh")})})}).call(this);

/*
 * jQuery Function Toggle Pluing
 * Copyright 2011, Felix Kling
 * Dual licensed under the MIT or GPL Version 2 licenses.
 */

(function($) {
    $.fn.funcToggle = function(type, data) {
        var dname = "jqp_eventtoggle_" + type + (new Date()).getTime(),            
            funcs = Array.prototype.slice.call(arguments, 2),
            numFuncs = funcs.length,
            empty = function() {},
            false_handler = function() {return false;};

        if(typeof type === "object") {
            for( var key in type) {
                $.fn.funcToggle.apply(this, [key].concat(type[key]));
            }
            return this;
        }
        if($.isFunction(data) || data === false) {
            funcs = [data].concat(funcs);
            numFuncs += 1;
            data = undefined;
        }
        
        funcs = $.map(funcs, function(func) {
            if(func === false) {
                return false_handler;
            }
            if(!$.isFunction(func)) {
                return empty;
            }
            return func;
        });

        this.data(dname, 0);
        this.bind(type, data, function(event) {
            var data = $(this).data(),
                index = data[dname];
            funcs[index].call(this, event);
            data[dname] = (index + 1) % numFuncs;
        });
        return this;
    };
}(jQuery));


/*!
 * jQuery Cookie Plugin v1.4.1
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2013 Klaus Hartl
 * Released under the MIT license
 */
(function (factory) {
	if (typeof define === 'function' && define.amd) {
		// AMD
		define(['jquery'], factory);
	} else if (typeof exports === 'object') {
		// CommonJS
		factory(require('jquery'));
	} else {
		// Browser globals
		factory(jQuery);
	}
}(function ($) {

	var pluses = /\+/g;

	function encode(s) {
		return config.raw ? s : encodeURIComponent(s);
	}

	function decode(s) {
		return config.raw ? s : decodeURIComponent(s);
	}

	function stringifyCookieValue(value) {
		return encode(config.json ? JSON.stringify(value) : String(value));
	}

	function parseCookieValue(s) {
		if (s.indexOf('"') === 0) {
			// This is a quoted cookie as according to RFC2068, unescape...
			s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
		}

		try {
			// Replace server-side written pluses with spaces.
			// If we can't decode the cookie, ignore it, it's unusable.
			// If we can't parse the cookie, ignore it, it's unusable.
			s = decodeURIComponent(s.replace(pluses, ' '));
			return config.json ? JSON.parse(s) : s;
		} catch(e) {}
	}

	function read(s, converter) {
		var value = config.raw ? s : parseCookieValue(s);
		return $.isFunction(converter) ? converter(value) : value;
	}

	var config = $.cookie = function (key, value, options) {

		// Write

		if (value !== undefined && !$.isFunction(value)) {
			options = $.extend({}, config.defaults, options);

			if (typeof options.expires === 'number') {
				var days = options.expires, t = options.expires = new Date();
				t.setTime(+t + days * 864e+5);
			}

			return (document.cookie = [
				encode(key), '=', stringifyCookieValue(value),
				options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
				options.path    ? '; path=' + options.path : '',
				options.domain  ? '; domain=' + options.domain : '',
				options.secure  ? '; secure' : ''
			].join(''));
		}

		// Read

		var result = key ? undefined : {};

		// To prevent the for loop in the first place assign an empty array
		// in case there are no cookies at all. Also prevents odd result when
		// calling $.cookie().
		var cookies = document.cookie ? document.cookie.split('; ') : [];

		for (var i = 0, l = cookies.length; i < l; i++) {
			var parts = cookies[i].split('=');
			var name = decode(parts.shift());
			var cookie = parts.join('=');

			if (key && key === name) {
				// If second argument (value) is a function it's a converter...
				result = read(cookie, value);
				break;
			}

			// Prevent storing a cookie that we couldn't decode.
			if (!key && (cookie = read(cookie)) !== undefined) {
				result[name] = cookie;
			}
		}

		return result;
	};

	config.defaults = {};

	$.removeCookie = function (key, options) {
		if ($.cookie(key) === undefined) {
			return false;
		}

		// Must not alter options, thus extending a fresh object...
		$.cookie(key, '', $.extend({}, options, { expires: -1 }));
		return !$.cookie(key);
	};

}));

/* Tooltipster v3.2.1 */;(function(e,t,n){function s(t,n){this.bodyOverflowX;this.callbacks={hide:[],show:[]};this.checkInterval=null;this.Content;this.$el=e(t);this.$elProxy;this.elProxyPosition;this.enabled=true;this.options=e.extend({},i,n);this.mouseIsOverProxy=false;this.namespace="tooltipster-"+Math.round(Math.random()*1e5);this.Status="hidden";this.timerHide=null;this.timerShow=null;this.$tooltip;this.options.iconTheme=this.options.iconTheme.replace(".","");this.options.theme=this.options.theme.replace(".","");this._init()}function o(t,n){var r=true;e.each(t,function(e,i){if(typeof n[e]==="undefined"||t[e]!==n[e]){r=false;return false}});return r}function f(){return!a&&u}function l(){var e=n.body||n.documentElement,t=e.style,r="transition";if(typeof t[r]=="string"){return true}v=["Moz","Webkit","Khtml","O","ms"],r=r.charAt(0).toUpperCase()+r.substr(1);for(var i=0;i<v.length;i++){if(typeof t[v[i]+r]=="string"){return true}}return false}var r="tooltipster",i={animation:"fade",arrow:true,arrowColor:"",autoClose:true,content:null,contentAsHTML:false,contentCloning:true,delay:200,fixedWidth:0,maxWidth:0,functionInit:function(e,t){},functionBefore:function(e,t){t()},functionReady:function(e,t){},functionAfter:function(e){},icon:"(?)",iconCloning:true,iconDesktop:false,iconTouch:false,iconTheme:"tooltipster-icon",interactive:false,interactiveTolerance:350,multiple:false,offsetX:0,offsetY:0,onlyOne:false,position:"top",positionTracker:false,speed:350,timer:0,theme:"tooltipster-default",touchDevices:true,trigger:"hover",updateAnimation:true};s.prototype={_init:function(){var t=this;if(n.querySelector){if(t.options.content!==null){t._content_set(t.options.content)}else{var r=t.$el.attr("title");if(typeof r==="undefined")r=null;t._content_set(r)}var i=t.options.functionInit.call(t.$el,t.$el,t.Content);if(typeof i!=="undefined")t._content_set(i);t.$el.removeAttr("title").addClass("tooltipstered");if(!u&&t.options.iconDesktop||u&&t.options.iconTouch){if(typeof t.options.icon==="string"){t.$elProxy=e('<span class="'+t.options.iconTheme+'"></span>');t.$elProxy.text(t.options.icon)}else{if(t.options.iconCloning)t.$elProxy=t.options.icon.clone(true);else t.$elProxy=t.options.icon}t.$elProxy.insertAfter(t.$el)}else{t.$elProxy=t.$el}if(t.options.trigger=="hover"){t.$elProxy.on("mouseenter."+t.namespace,function(){if(!f()||t.options.touchDevices){t.mouseIsOverProxy=true;t._show()}}).on("mouseleave."+t.namespace,function(){if(!f()||t.options.touchDevices){t.mouseIsOverProxy=false}});if(u&&t.options.touchDevices){t.$elProxy.on("touchstart."+t.namespace,function(){t._showNow()})}}else if(t.options.trigger=="click"){t.$elProxy.on("click."+t.namespace,function(){if(!f()||t.options.touchDevices){t._show()}})}}},_show:function(){var e=this;if(e.Status!="shown"&&e.Status!="appearing"){if(e.options.delay){e.timerShow=setTimeout(function(){if(e.options.trigger=="click"||e.options.trigger=="hover"&&e.mouseIsOverProxy){e._showNow()}},e.options.delay)}else e._showNow()}},_showNow:function(n){var r=this;r.options.functionBefore.call(r.$el,r.$el,function(){if(r.enabled&&r.Content!==null){if(n)r.callbacks.show.push(n);r.callbacks.hide=[];clearTimeout(r.timerShow);r.timerShow=null;clearTimeout(r.timerHide);r.timerHide=null;if(r.options.onlyOne){e(".tooltipstered").not(r.$el).each(function(t,n){var r=e(n),i=r.data("tooltipster-ns");e.each(i,function(e,t){var n=r.data(t),i=n.status(),s=n.option("autoClose");if(i!=="hidden"&&i!=="disappearing"&&s){n.hide()}})})}var i=function(){r.Status="shown";e.each(r.callbacks.show,function(e,t){t.call(r.$el)});r.callbacks.show=[]};if(r.Status!=="hidden"){var s=0;if(r.Status==="disappearing"){r.Status="appearing";if(l()){r.$tooltip.clearQueue().removeClass("tooltipster-dying").addClass("tooltipster-"+r.options.animation+"-show");if(r.options.speed>0)r.$tooltip.delay(r.options.speed);r.$tooltip.queue(i)}else{r.$tooltip.stop().fadeIn(i)}}else if(r.Status==="shown"){i()}}else{r.Status="appearing";var s=r.options.speed;r.bodyOverflowX=e("body").css("overflow-x");e("body").css("overflow-x","hidden");var o="tooltipster-"+r.options.animation,a="-webkit-transition-duration: "+r.options.speed+"ms; -webkit-animation-duration: "+r.options.speed+"ms; -moz-transition-duration: "+r.options.speed+"ms; -moz-animation-duration: "+r.options.speed+"ms; -o-transition-duration: "+r.options.speed+"ms; -o-animation-duration: "+r.options.speed+"ms; -ms-transition-duration: "+r.options.speed+"ms; -ms-animation-duration: "+r.options.speed+"ms; transition-duration: "+r.options.speed+"ms; animation-duration: "+r.options.speed+"ms;",f=r.options.fixedWidth>0?"width:"+Math.round(r.options.fixedWidth)+"px;":"",c=r.options.maxWidth>0?"max-width:"+Math.round(r.options.maxWidth)+"px;":"",h=r.options.interactive?"pointer-events: auto;":"";r.$tooltip=e('<div class="tooltipster-base '+r.options.theme+'" style="'+f+" "+c+" "+h+" "+a+'"><div class="tooltipster-content"></div></div>');if(l())r.$tooltip.addClass(o);r._content_insert();r.$tooltip.appendTo("body");r.reposition();r.options.functionReady.call(r.$el,r.$el,r.$tooltip);if(l()){r.$tooltip.addClass(o+"-show");if(r.options.speed>0)r.$tooltip.delay(r.options.speed);r.$tooltip.queue(i)}else{r.$tooltip.css("display","none").fadeIn(r.options.speed,i)}r._interval_set();e(t).on("scroll."+r.namespace+" resize."+r.namespace,function(){r.reposition()});if(r.options.autoClose){e("body").off("."+r.namespace);if(r.options.trigger=="hover"){if(u){setTimeout(function(){e("body").on("touchstart."+r.namespace,function(){r.hide()})},0)}if(r.options.interactive){if(u){r.$tooltip.on("touchstart."+r.namespace,function(e){e.stopPropagation()})}var p=null;r.$elProxy.add(r.$tooltip).on("mouseleave."+r.namespace+"-autoClose",function(){clearTimeout(p);p=setTimeout(function(){r.hide()},r.options.interactiveTolerance)}).on("mouseenter."+r.namespace+"-autoClose",function(){clearTimeout(p)})}else{r.$elProxy.on("mouseleave."+r.namespace+"-autoClose",function(){r.hide()})}}else if(r.options.trigger=="click"){setTimeout(function(){e("body").on("click."+r.namespace+" touchstart."+r.namespace,function(){r.hide()})},0);if(r.options.interactive){r.$tooltip.on("click."+r.namespace+" touchstart."+r.namespace,function(e){e.stopPropagation()})}}}}if(r.options.timer>0){r.timerHide=setTimeout(function(){r.timerHide=null;r.hide()},r.options.timer+s)}}})},_interval_set:function(){var t=this;t.checkInterval=setInterval(function(){if(e("body").find(t.$el).length===0||e("body").find(t.$elProxy).length===0||t.Status=="hidden"||e("body").find(t.$tooltip).length===0){if(t.Status=="shown"||t.Status=="appearing")t.hide();t._interval_cancel()}else{if(t.options.positionTracker){var n=t._repositionInfo(t.$elProxy),r=false;if(o(n.dimension,t.elProxyPosition.dimension)){if(t.$elProxy.css("position")==="fixed"){if(o(n.position,t.elProxyPosition.position))r=true}else{if(o(n.offset,t.elProxyPosition.offset))r=true}}if(!r){t.reposition()}}}},200)},_interval_cancel:function(){clearInterval(this.checkInterval);this.checkInterval=null},_content_set:function(e){if(typeof e==="object"&&e!==null&&this.options.contentCloning){e=e.clone(true)}this.Content=e},_content_insert:function(){var e=this,t=this.$tooltip.find(".tooltipster-content");if(typeof e.Content==="string"&&!e.options.contentAsHTML){t.text(e.Content)}else{t.empty().append(e.Content)}},_update:function(e){var t=this;t._content_set(e);if(t.Content!==null){if(t.Status!=="hidden"){t._content_insert();t.reposition();if(t.options.updateAnimation){if(l()){t.$tooltip.css({width:"","-webkit-transition":"all "+t.options.speed+"ms, width 0ms, height 0ms, left 0ms, top 0ms","-moz-transition":"all "+t.options.speed+"ms, width 0ms, height 0ms, left 0ms, top 0ms","-o-transition":"all "+t.options.speed+"ms, width 0ms, height 0ms, left 0ms, top 0ms","-ms-transition":"all "+t.options.speed+"ms, width 0ms, height 0ms, left 0ms, top 0ms",transition:"all "+t.options.speed+"ms, width 0ms, height 0ms, left 0ms, top 0ms"}).addClass("tooltipster-content-changing");setTimeout(function(){if(t.Status!="hidden"){t.$tooltip.removeClass("tooltipster-content-changing");setTimeout(function(){if(t.Status!=="hidden"){t.$tooltip.css({"-webkit-transition":t.options.speed+"ms","-moz-transition":t.options.speed+"ms","-o-transition":t.options.speed+"ms","-ms-transition":t.options.speed+"ms",transition:t.options.speed+"ms"})}},t.options.speed)}},t.options.speed)}else{t.$tooltip.fadeTo(t.options.speed,.5,function(){if(t.Status!="hidden"){t.$tooltip.fadeTo(t.options.speed,1)}})}}}}else{t.hide()}},_repositionInfo:function(e){return{dimension:{height:e.outerHeight(false),width:e.outerWidth(false)},offset:e.offset(),position:{left:parseInt(e.css("left")),top:parseInt(e.css("top"))}}},hide:function(n){var r=this;if(n)r.callbacks.hide.push(n);r.callbacks.show=[];clearTimeout(r.timerShow);r.timerShow=null;clearTimeout(r.timerHide);r.timerHide=null;var i=function(){e.each(r.callbacks.hide,function(e,t){t.call(r.$el)});r.callbacks.hide=[]};if(r.Status=="shown"||r.Status=="appearing"){r.Status="disappearing";var s=function(){r.Status="hidden";if(typeof r.Content=="object"&&r.Content!==null){r.Content.detach()}r.$tooltip.remove();r.$tooltip=null;e(t).off("."+r.namespace);e("body").off("."+r.namespace).css("overflow-x",r.bodyOverflowX);e("body").off("."+r.namespace);r.$elProxy.off("."+r.namespace+"-autoClose");r.options.functionAfter.call(r.$el,r.$el);i()};if(l()){r.$tooltip.clearQueue().removeClass("tooltipster-"+r.options.animation+"-show").addClass("tooltipster-dying");if(r.options.speed>0)r.$tooltip.delay(r.options.speed);r.$tooltip.queue(s)}else{r.$tooltip.stop().fadeOut(r.options.speed,s)}}else if(r.Status=="hidden"){i()}return r},show:function(e){this._showNow(e);return this},update:function(e){return this.content(e)},content:function(e){if(typeof e==="undefined"){return this.Content}else{this._update(e);return this}},reposition:function(){var n=this;if(e("body").find(n.$tooltip).length!==0){n.$tooltip.css("width","");n.elProxyPosition=n._repositionInfo(n.$elProxy);var r=null,i=e(t).width(),s=n.elProxyPosition,o=n.$tooltip.outerWidth(false),u=n.$tooltip.innerWidth()+1,a=n.$tooltip.outerHeight(false);if(n.$elProxy.is("area")){var f=n.$elProxy.attr("shape"),l=n.$elProxy.parent().attr("name"),c=e('img[usemap="#'+l+'"]'),h=c.offset().left,p=c.offset().top,d=n.$elProxy.attr("coords")!==undefined?n.$elProxy.attr("coords").split(","):undefined;if(f=="circle"){var v=parseInt(d[0]),m=parseInt(d[1]),g=parseInt(d[2]);s.dimension.height=g*2;s.dimension.width=g*2;s.offset.top=p+m-g;s.offset.left=h+v-g}else if(f=="rect"){var v=parseInt(d[0]),m=parseInt(d[1]),y=parseInt(d[2]),b=parseInt(d[3]);s.dimension.height=b-m;s.dimension.width=y-v;s.offset.top=p+m;s.offset.left=h+v}else if(f=="poly"){var w=[],E=[],S=0,x=0,T=0,N=0,C="even";for(var k=0;k<d.length;k++){var L=parseInt(d[k]);if(C=="even"){if(L>T){T=L;if(k===0){S=T}}if(L<S){S=L}C="odd"}else{if(L>N){N=L;if(k==1){x=N}}if(L<x){x=L}C="even"}}s.dimension.height=N-x;s.dimension.width=T-S;s.offset.top=p+x;s.offset.left=h+S}else{s.dimension.height=c.outerHeight(false);s.dimension.width=c.outerWidth(false);s.offset.top=p;s.offset.left=h}}if(n.options.fixedWidth===0){n.$tooltip.css({width:Math.round(u)+"px","padding-left":"0px","padding-right":"0px"})}var A=0,O=0,M=0,_=parseInt(n.options.offsetY),D=parseInt(n.options.offsetX),P=n.options.position;function H(){var n=e(t).scrollLeft();if(A-n<0){r=A-n;A=n}if(A+o-n>i){r=A-(i+n-o);A=i+n-o}}function B(n,r){if(s.offset.top-e(t).scrollTop()-a-_-12<0&&r.indexOf("top")>-1){P=n}if(s.offset.top+s.dimension.height+a+12+_>e(t).scrollTop()+e(t).height()&&r.indexOf("bottom")>-1){P=n;M=s.offset.top-a-_-12}}if(P=="top"){var j=s.offset.left+o-(s.offset.left+s.dimension.width);A=s.offset.left+D-j/2;M=s.offset.top-a-_-12;H();B("bottom","top")}if(P=="top-left"){A=s.offset.left+D;M=s.offset.top-a-_-12;H();B("bottom-left","top-left")}if(P=="top-right"){A=s.offset.left+s.dimension.width+D-o;M=s.offset.top-a-_-12;H();B("bottom-right","top-right")}if(P=="bottom"){var j=s.offset.left+o-(s.offset.left+s.dimension.width);A=s.offset.left-j/2+D;M=s.offset.top+s.dimension.height+_+12;H();B("top","bottom")}if(P=="bottom-left"){A=s.offset.left+D;M=s.offset.top+s.dimension.height+_+12;H();B("top-left","bottom-left")}if(P=="bottom-right"){A=s.offset.left+s.dimension.width+D-o;M=s.offset.top+s.dimension.height+_+12;H();B("top-right","bottom-right")}if(P=="left"){A=s.offset.left-D-o-12;O=s.offset.left+D+s.dimension.width+12;var F=s.offset.top+a-(s.offset.top+s.dimension.height);M=s.offset.top-F/2-_;if(A<0&&O+o>i){var I=parseFloat(n.$tooltip.css("border-width"))*2,q=o+A-I;n.$tooltip.css("width",q+"px");a=n.$tooltip.outerHeight(false);A=s.offset.left-D-q-12-I;F=s.offset.top+a-(s.offset.top+s.dimension.height);M=s.offset.top-F/2-_}else if(A<0){A=s.offset.left+D+s.dimension.width+12;r="left"}}if(P=="right"){A=s.offset.left+D+s.dimension.width+12;O=s.offset.left-D-o-12;var F=s.offset.top+a-(s.offset.top+s.dimension.height);M=s.offset.top-F/2-_;if(A+o>i&&O<0){var I=parseFloat(n.$tooltip.css("border-width"))*2,q=i-A-I;n.$tooltip.css("width",q+"px");a=n.$tooltip.outerHeight(false);F=s.offset.top+a-(s.offset.top+s.dimension.height);M=s.offset.top-F/2-_}else if(A+o>i){A=s.offset.left-D-o-12;r="right"}}if(n.options.arrow){var R="tooltipster-arrow-"+P;if(n.options.arrowColor.length<1){var U=n.$tooltip.css("background-color")}else{var U=n.options.arrowColor}if(!r){r=""}else if(r=="left"){R="tooltipster-arrow-right";r=""}else if(r=="right"){R="tooltipster-arrow-left";r=""}else{r="left:"+Math.round(r)+"px;"}if(P=="top"||P=="top-left"||P=="top-right"){var z=parseFloat(n.$tooltip.css("border-bottom-width")),W=n.$tooltip.css("border-bottom-color")}else if(P=="bottom"||P=="bottom-left"||P=="bottom-right"){var z=parseFloat(n.$tooltip.css("border-top-width")),W=n.$tooltip.css("border-top-color")}else if(P=="left"){var z=parseFloat(n.$tooltip.css("border-right-width")),W=n.$tooltip.css("border-right-color")}else if(P=="right"){var z=parseFloat(n.$tooltip.css("border-left-width")),W=n.$tooltip.css("border-left-color")}else{var z=parseFloat(n.$tooltip.css("border-bottom-width")),W=n.$tooltip.css("border-bottom-color")}if(z>1){z++}var X="";if(z!==0){var V="",J="border-color: "+W+";";if(R.indexOf("bottom")!==-1){V="margin-top: -"+Math.round(z)+"px;"}else if(R.indexOf("top")!==-1){V="margin-bottom: -"+Math.round(z)+"px;"}else if(R.indexOf("left")!==-1){V="margin-right: -"+Math.round(z)+"px;"}else if(R.indexOf("right")!==-1){V="margin-left: -"+Math.round(z)+"px;"}X='<span class="tooltipster-arrow-border" style="'+V+" "+J+';"></span>'}n.$tooltip.find(".tooltipster-arrow").remove();var K='<div class="'+R+' tooltipster-arrow" style="'+r+'">'+X+'<span style="border-color:'+U+';"></span></div>';n.$tooltip.append(K)}n.$tooltip.css({top:Math.round(M)+"px",left:Math.round(A)+"px"})}return n},enable:function(){this.enabled=true;return this},disable:function(){this.hide();this.enabled=false;return this},destroy:function(){var t=this;t.hide();if(t.$el[0]!==t.$elProxy[0])t.$elProxy.remove();t.$el.removeData(t.namespace).off("."+t.namespace);var n=t.$el.data("tooltipster-ns");if(n.length===1){var r=typeof t.Content==="string"?t.Content:e("<div></div>").append(t.Content).html();t.$el.removeClass("tooltipstered").attr("title",r).removeData(t.namespace).removeData("tooltipster-ns").off("."+t.namespace)}else{n=e.grep(n,function(e,n){return e!==t.namespace});t.$el.data("tooltipster-ns",n)}return t},elementIcon:function(){return this.$el[0]!==this.$elProxy[0]?this.$elProxy[0]:undefined},elementTooltip:function(){return this.$tooltip?this.$tooltip[0]:undefined},option:function(e){return this.options[e]},status:function(e){return this.Status}};e.fn[r]=function(){var t=arguments;if(this.length===0){if(typeof t[0]==="string"){var n=true;switch(t[0]){case"setDefaults":e.extend(i,t[1]);break;default:n=false;break}if(n)return true;else return this}else{return this}}else{if(typeof t[0]==="string"){var r="#*$~&";this.each(function(){var n=e(this).data("tooltipster-ns"),i=n?e(this).data(n[0]):null;if(i){if(typeof i[t[0]]==="function"){var s=i[t[0]](t[1])}else{throw new Error('Unknown method .tooltipster("'+t[0]+'")')}if(s!==i){r=s;return false}}else{throw new Error("You called Tooltipster's \""+t[0]+'" method on an uninitialized element')}});return r!=="#*$~&"?r:this}else{var o=[],u=t[0]&&typeof t[0].multiple!=="undefined",a=u&&t[0].multiple||!u&&i.multiple;this.each(function(){var n=false,r=e(this).data("tooltipster-ns"),i=null;if(!r){n=true}else{if(a)n=true;else console.log('Tooltipster: one or more tooltips are already attached to this element: ignoring. Use the "multiple" option to attach more tooltips.')}if(n){i=new s(this,t[0]);if(!r)r=[];r.push(i.namespace);e(this).data("tooltipster-ns",r);e(this).data(i.namespace,i)}o.push(i)});if(a)return o;else return this}}};var u=!!("ontouchstart"in t);var a=false;e("body").one("mousemove",function(){a=true})})(jQuery,window,document);




/*!
 * Masonry PACKAGED v3.1.5
 * Cascading grid layout library
 * http://masonry.desandro.com
 * MIT License
 * by David DeSandro
 */

!function(a){function b(){}function c(a){function c(b){b.prototype.option||(b.prototype.option=function(b){a.isPlainObject(b)&&(this.options=a.extend(!0,this.options,b))})}function e(b,c){a.fn[b]=function(e){if("string"==typeof e){for(var g=d.call(arguments,1),h=0,i=this.length;i>h;h++){var j=this[h],k=a.data(j,b);if(k)if(a.isFunction(k[e])&&"_"!==e.charAt(0)){var l=k[e].apply(k,g);if(void 0!==l)return l}else f("no such method '"+e+"' for "+b+" instance");else f("cannot call methods on "+b+" prior to initialization; attempted to call '"+e+"'")}return this}return this.each(function(){var d=a.data(this,b);d?(d.option(e),d._init()):(d=new c(this,e),a.data(this,b,d))})}}if(a){var f="undefined"==typeof console?b:function(a){console.error(a)};return a.bridget=function(a,b){c(b),e(a,b)},a.bridget}}var d=Array.prototype.slice;"function"==typeof define&&define.amd?define("jquery-bridget/jquery.bridget",["jquery"],c):c(a.jQuery)}(window),function(a){function b(b){var c=a.event;return c.target=c.target||c.srcElement||b,c}var c=document.documentElement,d=function(){};c.addEventListener?d=function(a,b,c){a.addEventListener(b,c,!1)}:c.attachEvent&&(d=function(a,c,d){a[c+d]=d.handleEvent?function(){var c=b(a);d.handleEvent.call(d,c)}:function(){var c=b(a);d.call(a,c)},a.attachEvent("on"+c,a[c+d])});var e=function(){};c.removeEventListener?e=function(a,b,c){a.removeEventListener(b,c,!1)}:c.detachEvent&&(e=function(a,b,c){a.detachEvent("on"+b,a[b+c]);try{delete a[b+c]}catch(d){a[b+c]=void 0}});var f={bind:d,unbind:e};"function"==typeof define&&define.amd?define("eventie/eventie",f):"object"==typeof exports?module.exports=f:a.eventie=f}(this),function(a){function b(a){"function"==typeof a&&(b.isReady?a():f.push(a))}function c(a){var c="readystatechange"===a.type&&"complete"!==e.readyState;if(!b.isReady&&!c){b.isReady=!0;for(var d=0,g=f.length;g>d;d++){var h=f[d];h()}}}function d(d){return d.bind(e,"DOMContentLoaded",c),d.bind(e,"readystatechange",c),d.bind(a,"load",c),b}var e=a.document,f=[];b.isReady=!1,"function"==typeof define&&define.amd?(b.isReady="function"==typeof requirejs,define("doc-ready/doc-ready",["eventie/eventie"],d)):a.docReady=d(a.eventie)}(this),function(){function a(){}function b(a,b){for(var c=a.length;c--;)if(a[c].listener===b)return c;return-1}function c(a){return function(){return this[a].apply(this,arguments)}}var d=a.prototype,e=this,f=e.EventEmitter;d.getListeners=function(a){var b,c,d=this._getEvents();if(a instanceof RegExp){b={};for(c in d)d.hasOwnProperty(c)&&a.test(c)&&(b[c]=d[c])}else b=d[a]||(d[a]=[]);return b},d.flattenListeners=function(a){var b,c=[];for(b=0;b<a.length;b+=1)c.push(a[b].listener);return c},d.getListenersAsObject=function(a){var b,c=this.getListeners(a);return c instanceof Array&&(b={},b[a]=c),b||c},d.addListener=function(a,c){var d,e=this.getListenersAsObject(a),f="object"==typeof c;for(d in e)e.hasOwnProperty(d)&&-1===b(e[d],c)&&e[d].push(f?c:{listener:c,once:!1});return this},d.on=c("addListener"),d.addOnceListener=function(a,b){return this.addListener(a,{listener:b,once:!0})},d.once=c("addOnceListener"),d.defineEvent=function(a){return this.getListeners(a),this},d.defineEvents=function(a){for(var b=0;b<a.length;b+=1)this.defineEvent(a[b]);return this},d.removeListener=function(a,c){var d,e,f=this.getListenersAsObject(a);for(e in f)f.hasOwnProperty(e)&&(d=b(f[e],c),-1!==d&&f[e].splice(d,1));return this},d.off=c("removeListener"),d.addListeners=function(a,b){return this.manipulateListeners(!1,a,b)},d.removeListeners=function(a,b){return this.manipulateListeners(!0,a,b)},d.manipulateListeners=function(a,b,c){var d,e,f=a?this.removeListener:this.addListener,g=a?this.removeListeners:this.addListeners;if("object"!=typeof b||b instanceof RegExp)for(d=c.length;d--;)f.call(this,b,c[d]);else for(d in b)b.hasOwnProperty(d)&&(e=b[d])&&("function"==typeof e?f.call(this,d,e):g.call(this,d,e));return this},d.removeEvent=function(a){var b,c=typeof a,d=this._getEvents();if("string"===c)delete d[a];else if(a instanceof RegExp)for(b in d)d.hasOwnProperty(b)&&a.test(b)&&delete d[b];else delete this._events;return this},d.removeAllListeners=c("removeEvent"),d.emitEvent=function(a,b){var c,d,e,f,g=this.getListenersAsObject(a);for(e in g)if(g.hasOwnProperty(e))for(d=g[e].length;d--;)c=g[e][d],c.once===!0&&this.removeListener(a,c.listener),f=c.listener.apply(this,b||[]),f===this._getOnceReturnValue()&&this.removeListener(a,c.listener);return this},d.trigger=c("emitEvent"),d.emit=function(a){var b=Array.prototype.slice.call(arguments,1);return this.emitEvent(a,b)},d.setOnceReturnValue=function(a){return this._onceReturnValue=a,this},d._getOnceReturnValue=function(){return this.hasOwnProperty("_onceReturnValue")?this._onceReturnValue:!0},d._getEvents=function(){return this._events||(this._events={})},a.noConflict=function(){return e.EventEmitter=f,a},"function"==typeof define&&define.amd?define("eventEmitter/EventEmitter",[],function(){return a}):"object"==typeof module&&module.exports?module.exports=a:this.EventEmitter=a}.call(this),function(a){function b(a){if(a){if("string"==typeof d[a])return a;a=a.charAt(0).toUpperCase()+a.slice(1);for(var b,e=0,f=c.length;f>e;e++)if(b=c[e]+a,"string"==typeof d[b])return b}}var c="Webkit Moz ms Ms O".split(" "),d=document.documentElement.style;"function"==typeof define&&define.amd?define("get-style-property/get-style-property",[],function(){return b}):"object"==typeof exports?module.exports=b:a.getStyleProperty=b}(window),function(a){function b(a){var b=parseFloat(a),c=-1===a.indexOf("%")&&!isNaN(b);return c&&b}function c(){for(var a={width:0,height:0,innerWidth:0,innerHeight:0,outerWidth:0,outerHeight:0},b=0,c=g.length;c>b;b++){var d=g[b];a[d]=0}return a}function d(a){function d(a){if("string"==typeof a&&(a=document.querySelector(a)),a&&"object"==typeof a&&a.nodeType){var d=f(a);if("none"===d.display)return c();var e={};e.width=a.offsetWidth,e.height=a.offsetHeight;for(var k=e.isBorderBox=!(!j||!d[j]||"border-box"!==d[j]),l=0,m=g.length;m>l;l++){var n=g[l],o=d[n];o=h(a,o);var p=parseFloat(o);e[n]=isNaN(p)?0:p}var q=e.paddingLeft+e.paddingRight,r=e.paddingTop+e.paddingBottom,s=e.marginLeft+e.marginRight,t=e.marginTop+e.marginBottom,u=e.borderLeftWidth+e.borderRightWidth,v=e.borderTopWidth+e.borderBottomWidth,w=k&&i,x=b(d.width);x!==!1&&(e.width=x+(w?0:q+u));var y=b(d.height);return y!==!1&&(e.height=y+(w?0:r+v)),e.innerWidth=e.width-(q+u),e.innerHeight=e.height-(r+v),e.outerWidth=e.width+s,e.outerHeight=e.height+t,e}}function h(a,b){if(e||-1===b.indexOf("%"))return b;var c=a.style,d=c.left,f=a.runtimeStyle,g=f&&f.left;return g&&(f.left=a.currentStyle.left),c.left=b,b=c.pixelLeft,c.left=d,g&&(f.left=g),b}var i,j=a("boxSizing");return function(){if(j){var a=document.createElement("div");a.style.width="200px",a.style.padding="1px 2px 3px 4px",a.style.borderStyle="solid",a.style.borderWidth="1px 2px 3px 4px",a.style[j]="border-box";var c=document.body||document.documentElement;c.appendChild(a);var d=f(a);i=200===b(d.width),c.removeChild(a)}}(),d}var e=a.getComputedStyle,f=e?function(a){return e(a,null)}:function(a){return a.currentStyle},g=["paddingLeft","paddingRight","paddingTop","paddingBottom","marginLeft","marginRight","marginTop","marginBottom","borderLeftWidth","borderRightWidth","borderTopWidth","borderBottomWidth"];"function"==typeof define&&define.amd?define("get-size/get-size",["get-style-property/get-style-property"],d):"object"==typeof exports?module.exports=d(require("get-style-property")):a.getSize=d(a.getStyleProperty)}(window),function(a,b){function c(a,b){return a[h](b)}function d(a){if(!a.parentNode){var b=document.createDocumentFragment();b.appendChild(a)}}function e(a,b){d(a);for(var c=a.parentNode.querySelectorAll(b),e=0,f=c.length;f>e;e++)if(c[e]===a)return!0;return!1}function f(a,b){return d(a),c(a,b)}var g,h=function(){if(b.matchesSelector)return"matchesSelector";for(var a=["webkit","moz","ms","o"],c=0,d=a.length;d>c;c++){var e=a[c],f=e+"MatchesSelector";if(b[f])return f}}();if(h){var i=document.createElement("div"),j=c(i,"div");g=j?c:f}else g=e;"function"==typeof define&&define.amd?define("matches-selector/matches-selector",[],function(){return g}):window.matchesSelector=g}(this,Element.prototype),function(a){function b(a,b){for(var c in b)a[c]=b[c];return a}function c(a){for(var b in a)return!1;return b=null,!0}function d(a){return a.replace(/([A-Z])/g,function(a){return"-"+a.toLowerCase()})}function e(a,e,f){function h(a,b){a&&(this.element=a,this.layout=b,this.position={x:0,y:0},this._create())}var i=f("transition"),j=f("transform"),k=i&&j,l=!!f("perspective"),m={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"otransitionend",transition:"transitionend"}[i],n=["transform","transition","transitionDuration","transitionProperty"],o=function(){for(var a={},b=0,c=n.length;c>b;b++){var d=n[b],e=f(d);e&&e!==d&&(a[d]=e)}return a}();b(h.prototype,a.prototype),h.prototype._create=function(){this._transn={ingProperties:{},clean:{},onEnd:{}},this.css({position:"absolute"})},h.prototype.handleEvent=function(a){var b="on"+a.type;this[b]&&this[b](a)},h.prototype.getSize=function(){this.size=e(this.element)},h.prototype.css=function(a){var b=this.element.style;for(var c in a){var d=o[c]||c;b[d]=a[c]}},h.prototype.getPosition=function(){var a=g(this.element),b=this.layout.options,c=b.isOriginLeft,d=b.isOriginTop,e=parseInt(a[c?"left":"right"],10),f=parseInt(a[d?"top":"bottom"],10);e=isNaN(e)?0:e,f=isNaN(f)?0:f;var h=this.layout.size;e-=c?h.paddingLeft:h.paddingRight,f-=d?h.paddingTop:h.paddingBottom,this.position.x=e,this.position.y=f},h.prototype.layoutPosition=function(){var a=this.layout.size,b=this.layout.options,c={};b.isOriginLeft?(c.left=this.position.x+a.paddingLeft+"px",c.right=""):(c.right=this.position.x+a.paddingRight+"px",c.left=""),b.isOriginTop?(c.top=this.position.y+a.paddingTop+"px",c.bottom=""):(c.bottom=this.position.y+a.paddingBottom+"px",c.top=""),this.css(c),this.emitEvent("layout",[this])};var p=l?function(a,b){return"translate3d("+a+"px, "+b+"px, 0)"}:function(a,b){return"translate("+a+"px, "+b+"px)"};h.prototype._transitionTo=function(a,b){this.getPosition();var c=this.position.x,d=this.position.y,e=parseInt(a,10),f=parseInt(b,10),g=e===this.position.x&&f===this.position.y;if(this.setPosition(a,b),g&&!this.isTransitioning)return void this.layoutPosition();var h=a-c,i=b-d,j={},k=this.layout.options;h=k.isOriginLeft?h:-h,i=k.isOriginTop?i:-i,j.transform=p(h,i),this.transition({to:j,onTransitionEnd:{transform:this.layoutPosition},isCleaning:!0})},h.prototype.goTo=function(a,b){this.setPosition(a,b),this.layoutPosition()},h.prototype.moveTo=k?h.prototype._transitionTo:h.prototype.goTo,h.prototype.setPosition=function(a,b){this.position.x=parseInt(a,10),this.position.y=parseInt(b,10)},h.prototype._nonTransition=function(a){this.css(a.to),a.isCleaning&&this._removeStyles(a.to);for(var b in a.onTransitionEnd)a.onTransitionEnd[b].call(this)},h.prototype._transition=function(a){if(!parseFloat(this.layout.options.transitionDuration))return void this._nonTransition(a);var b=this._transn;for(var c in a.onTransitionEnd)b.onEnd[c]=a.onTransitionEnd[c];for(c in a.to)b.ingProperties[c]=!0,a.isCleaning&&(b.clean[c]=!0);if(a.from){this.css(a.from);var d=this.element.offsetHeight;d=null}this.enableTransition(a.to),this.css(a.to),this.isTransitioning=!0};var q=j&&d(j)+",opacity";h.prototype.enableTransition=function(){this.isTransitioning||(this.css({transitionProperty:q,transitionDuration:this.layout.options.transitionDuration}),this.element.addEventListener(m,this,!1))},h.prototype.transition=h.prototype[i?"_transition":"_nonTransition"],h.prototype.onwebkitTransitionEnd=function(a){this.ontransitionend(a)},h.prototype.onotransitionend=function(a){this.ontransitionend(a)};var r={"-webkit-transform":"transform","-moz-transform":"transform","-o-transform":"transform"};h.prototype.ontransitionend=function(a){if(a.target===this.element){var b=this._transn,d=r[a.propertyName]||a.propertyName;if(delete b.ingProperties[d],c(b.ingProperties)&&this.disableTransition(),d in b.clean&&(this.element.style[a.propertyName]="",delete b.clean[d]),d in b.onEnd){var e=b.onEnd[d];e.call(this),delete b.onEnd[d]}this.emitEvent("transitionEnd",[this])}},h.prototype.disableTransition=function(){this.removeTransitionStyles(),this.element.removeEventListener(m,this,!1),this.isTransitioning=!1},h.prototype._removeStyles=function(a){var b={};for(var c in a)b[c]="";this.css(b)};var s={transitionProperty:"",transitionDuration:""};return h.prototype.removeTransitionStyles=function(){this.css(s)},h.prototype.removeElem=function(){this.element.parentNode.removeChild(this.element),this.emitEvent("remove",[this])},h.prototype.remove=function(){if(!i||!parseFloat(this.layout.options.transitionDuration))return void this.removeElem();var a=this;this.on("transitionEnd",function(){return a.removeElem(),!0}),this.hide()},h.prototype.reveal=function(){delete this.isHidden,this.css({display:""});var a=this.layout.options;this.transition({from:a.hiddenStyle,to:a.visibleStyle,isCleaning:!0})},h.prototype.hide=function(){this.isHidden=!0,this.css({display:""});var a=this.layout.options;this.transition({from:a.visibleStyle,to:a.hiddenStyle,isCleaning:!0,onTransitionEnd:{opacity:function(){this.isHidden&&this.css({display:"none"})}}})},h.prototype.destroy=function(){this.css({position:"",left:"",right:"",top:"",bottom:"",transition:"",transform:""})},h}var f=a.getComputedStyle,g=f?function(a){return f(a,null)}:function(a){return a.currentStyle};"function"==typeof define&&define.amd?define("outlayer/item",["eventEmitter/EventEmitter","get-size/get-size","get-style-property/get-style-property"],e):(a.Outlayer={},a.Outlayer.Item=e(a.EventEmitter,a.getSize,a.getStyleProperty))}(window),function(a){function b(a,b){for(var c in b)a[c]=b[c];return a}function c(a){return"[object Array]"===l.call(a)}function d(a){var b=[];if(c(a))b=a;else if(a&&"number"==typeof a.length)for(var d=0,e=a.length;e>d;d++)b.push(a[d]);else b.push(a);return b}function e(a,b){var c=n(b,a);-1!==c&&b.splice(c,1)}function f(a){return a.replace(/(.)([A-Z])/g,function(a,b,c){return b+"-"+c}).toLowerCase()}function g(c,g,l,n,o,p){function q(a,c){if("string"==typeof a&&(a=h.querySelector(a)),!a||!m(a))return void(i&&i.error("Bad "+this.constructor.namespace+" element: "+a));this.element=a,this.options=b({},this.constructor.defaults),this.option(c);var d=++r;this.element.outlayerGUID=d,s[d]=this,this._create(),this.options.isInitLayout&&this.layout()}var r=0,s={};return q.namespace="outlayer",q.Item=p,q.defaults={containerStyle:{position:"relative"},isInitLayout:!0,isOriginLeft:!0,isOriginTop:!0,isResizeBound:!0,isResizingContainer:!0,transitionDuration:"0.4s",hiddenStyle:{opacity:0,transform:"scale(0.001)"},visibleStyle:{opacity:1,transform:"scale(1)"}},b(q.prototype,l.prototype),q.prototype.option=function(a){b(this.options,a)},q.prototype._create=function(){this.reloadItems(),this.stamps=[],this.stamp(this.options.stamp),b(this.element.style,this.options.containerStyle),this.options.isResizeBound&&this.bindResize()},q.prototype.reloadItems=function(){this.items=this._itemize(this.element.children)},q.prototype._itemize=function(a){for(var b=this._filterFindItemElements(a),c=this.constructor.Item,d=[],e=0,f=b.length;f>e;e++){var g=b[e],h=new c(g,this);d.push(h)}return d},q.prototype._filterFindItemElements=function(a){a=d(a);for(var b=this.options.itemSelector,c=[],e=0,f=a.length;f>e;e++){var g=a[e];if(m(g))if(b){o(g,b)&&c.push(g);for(var h=g.querySelectorAll(b),i=0,j=h.length;j>i;i++)c.push(h[i])}else c.push(g)}return c},q.prototype.getItemElements=function(){for(var a=[],b=0,c=this.items.length;c>b;b++)a.push(this.items[b].element);return a},q.prototype.layout=function(){this._resetLayout(),this._manageStamps();var a=void 0!==this.options.isLayoutInstant?this.options.isLayoutInstant:!this._isLayoutInited;this.layoutItems(this.items,a),this._isLayoutInited=!0},q.prototype._init=q.prototype.layout,q.prototype._resetLayout=function(){this.getSize()},q.prototype.getSize=function(){this.size=n(this.element)},q.prototype._getMeasurement=function(a,b){var c,d=this.options[a];d?("string"==typeof d?c=this.element.querySelector(d):m(d)&&(c=d),this[a]=c?n(c)[b]:d):this[a]=0},q.prototype.layoutItems=function(a,b){a=this._getItemsForLayout(a),this._layoutItems(a,b),this._postLayout()},q.prototype._getItemsForLayout=function(a){for(var b=[],c=0,d=a.length;d>c;c++){var e=a[c];e.isIgnored||b.push(e)}return b},q.prototype._layoutItems=function(a,b){function c(){d.emitEvent("layoutComplete",[d,a])}var d=this;if(!a||!a.length)return void c();this._itemsOn(a,"layout",c);for(var e=[],f=0,g=a.length;g>f;f++){var h=a[f],i=this._getItemLayoutPosition(h);i.item=h,i.isInstant=b||h.isLayoutInstant,e.push(i)}this._processLayoutQueue(e)},q.prototype._getItemLayoutPosition=function(){return{x:0,y:0}},q.prototype._processLayoutQueue=function(a){for(var b=0,c=a.length;c>b;b++){var d=a[b];this._positionItem(d.item,d.x,d.y,d.isInstant)}},q.prototype._positionItem=function(a,b,c,d){d?a.goTo(b,c):a.moveTo(b,c)},q.prototype._postLayout=function(){this.resizeContainer()},q.prototype.resizeContainer=function(){if(this.options.isResizingContainer){var a=this._getContainerSize();a&&(this._setContainerMeasure(a.width,!0),this._setContainerMeasure(a.height,!1))}},q.prototype._getContainerSize=k,q.prototype._setContainerMeasure=function(a,b){if(void 0!==a){var c=this.size;c.isBorderBox&&(a+=b?c.paddingLeft+c.paddingRight+c.borderLeftWidth+c.borderRightWidth:c.paddingBottom+c.paddingTop+c.borderTopWidth+c.borderBottomWidth),a=Math.max(a,0),this.element.style[b?"width":"height"]=a+"px"}},q.prototype._itemsOn=function(a,b,c){function d(){return e++,e===f&&c.call(g),!0}for(var e=0,f=a.length,g=this,h=0,i=a.length;i>h;h++){var j=a[h];j.on(b,d)}},q.prototype.ignore=function(a){var b=this.getItem(a);b&&(b.isIgnored=!0)},q.prototype.unignore=function(a){var b=this.getItem(a);b&&delete b.isIgnored},q.prototype.stamp=function(a){if(a=this._find(a)){this.stamps=this.stamps.concat(a);for(var b=0,c=a.length;c>b;b++){var d=a[b];this.ignore(d)}}},q.prototype.unstamp=function(a){if(a=this._find(a))for(var b=0,c=a.length;c>b;b++){var d=a[b];e(d,this.stamps),this.unignore(d)}},q.prototype._find=function(a){return a?("string"==typeof a&&(a=this.element.querySelectorAll(a)),a=d(a)):void 0},q.prototype._manageStamps=function(){if(this.stamps&&this.stamps.length){this._getBoundingRect();for(var a=0,b=this.stamps.length;b>a;a++){var c=this.stamps[a];this._manageStamp(c)}}},q.prototype._getBoundingRect=function(){var a=this.element.getBoundingClientRect(),b=this.size;this._boundingRect={left:a.left+b.paddingLeft+b.borderLeftWidth,top:a.top+b.paddingTop+b.borderTopWidth,right:a.right-(b.paddingRight+b.borderRightWidth),bottom:a.bottom-(b.paddingBottom+b.borderBottomWidth)}},q.prototype._manageStamp=k,q.prototype._getElementOffset=function(a){var b=a.getBoundingClientRect(),c=this._boundingRect,d=n(a),e={left:b.left-c.left-d.marginLeft,top:b.top-c.top-d.marginTop,right:c.right-b.right-d.marginRight,bottom:c.bottom-b.bottom-d.marginBottom};return e},q.prototype.handleEvent=function(a){var b="on"+a.type;this[b]&&this[b](a)},q.prototype.bindResize=function(){this.isResizeBound||(c.bind(a,"resize",this),this.isResizeBound=!0)},q.prototype.unbindResize=function(){this.isResizeBound&&c.unbind(a,"resize",this),this.isResizeBound=!1},q.prototype.onresize=function(){function a(){b.resize(),delete b.resizeTimeout}this.resizeTimeout&&clearTimeout(this.resizeTimeout);var b=this;this.resizeTimeout=setTimeout(a,100)},q.prototype.resize=function(){this.isResizeBound&&this.needsResizeLayout()&&this.layout()},q.prototype.needsResizeLayout=function(){var a=n(this.element),b=this.size&&a;return b&&a.innerWidth!==this.size.innerWidth},q.prototype.addItems=function(a){var b=this._itemize(a);return b.length&&(this.items=this.items.concat(b)),b},q.prototype.appended=function(a){var b=this.addItems(a);b.length&&(this.layoutItems(b,!0),this.reveal(b))},q.prototype.prepended=function(a){var b=this._itemize(a);if(b.length){var c=this.items.slice(0);this.items=b.concat(c),this._resetLayout(),this._manageStamps(),this.layoutItems(b,!0),this.reveal(b),this.layoutItems(c)}},q.prototype.reveal=function(a){var b=a&&a.length;if(b)for(var c=0;b>c;c++){var d=a[c];d.reveal()}},q.prototype.hide=function(a){var b=a&&a.length;if(b)for(var c=0;b>c;c++){var d=a[c];d.hide()}},q.prototype.getItem=function(a){for(var b=0,c=this.items.length;c>b;b++){var d=this.items[b];if(d.element===a)return d}},q.prototype.getItems=function(a){if(a&&a.length){for(var b=[],c=0,d=a.length;d>c;c++){var e=a[c],f=this.getItem(e);f&&b.push(f)}return b}},q.prototype.remove=function(a){a=d(a);var b=this.getItems(a);if(b&&b.length){this._itemsOn(b,"remove",function(){this.emitEvent("removeComplete",[this,b])});for(var c=0,f=b.length;f>c;c++){var g=b[c];g.remove(),e(g,this.items)}}},q.prototype.destroy=function(){var a=this.element.style;a.height="",a.position="",a.width="";for(var b=0,c=this.items.length;c>b;b++){var d=this.items[b];d.destroy()}this.unbindResize(),delete this.element.outlayerGUID,j&&j.removeData(this.element,this.constructor.namespace)},q.data=function(a){var b=a&&a.outlayerGUID;return b&&s[b]},q.create=function(a,c){function d(){q.apply(this,arguments)}return Object.create?d.prototype=Object.create(q.prototype):b(d.prototype,q.prototype),d.prototype.constructor=d,d.defaults=b({},q.defaults),b(d.defaults,c),d.prototype.settings={},d.namespace=a,d.data=q.data,d.Item=function(){p.apply(this,arguments)},d.Item.prototype=new p,g(function(){for(var b=f(a),c=h.querySelectorAll(".js-"+b),e="data-"+b+"-options",g=0,k=c.length;k>g;g++){var l,m=c[g],n=m.getAttribute(e);try{l=n&&JSON.parse(n)}catch(o){i&&i.error("Error parsing "+e+" on "+m.nodeName.toLowerCase()+(m.id?"#"+m.id:"")+": "+o);continue}var p=new d(m,l);j&&j.data(m,a,p)}}),j&&j.bridget&&j.bridget(a,d),d},q.Item=p,q}var h=a.document,i=a.console,j=a.jQuery,k=function(){},l=Object.prototype.toString,m="object"==typeof HTMLElement?function(a){return a instanceof HTMLElement}:function(a){return a&&"object"==typeof a&&1===a.nodeType&&"string"==typeof a.nodeName},n=Array.prototype.indexOf?function(a,b){return a.indexOf(b)}:function(a,b){for(var c=0,d=a.length;d>c;c++)if(a[c]===b)return c;return-1};"function"==typeof define&&define.amd?define("outlayer/outlayer",["eventie/eventie","doc-ready/doc-ready","eventEmitter/EventEmitter","get-size/get-size","matches-selector/matches-selector","./item"],g):a.Outlayer=g(a.eventie,a.docReady,a.EventEmitter,a.getSize,a.matchesSelector,a.Outlayer.Item)}(window),function(a){function b(a,b){var d=a.create("masonry");return d.prototype._resetLayout=function(){this.getSize(),this._getMeasurement("columnWidth","outerWidth"),this._getMeasurement("gutter","outerWidth"),this.measureColumns();var a=this.cols;for(this.colYs=[];a--;)this.colYs.push(0);this.maxY=0},d.prototype.measureColumns=function(){if(this.getContainerWidth(),!this.columnWidth){var a=this.items[0],c=a&&a.element;this.columnWidth=c&&b(c).outerWidth||this.containerWidth}this.columnWidth+=this.gutter,this.cols=Math.floor((this.containerWidth+this.gutter)/this.columnWidth),this.cols=Math.max(this.cols,1)},d.prototype.getContainerWidth=function(){var a=this.options.isFitWidth?this.element.parentNode:this.element,c=b(a);this.containerWidth=c&&c.innerWidth},d.prototype._getItemLayoutPosition=function(a){a.getSize();var b=a.size.outerWidth%this.columnWidth,d=b&&1>b?"round":"ceil",e=Math[d](a.size.outerWidth/this.columnWidth);e=Math.min(e,this.cols);for(var f=this._getColGroup(e),g=Math.min.apply(Math,f),h=c(f,g),i={x:this.columnWidth*h,y:g},j=g+a.size.outerHeight,k=this.cols+1-f.length,l=0;k>l;l++)this.colYs[h+l]=j;return i},d.prototype._getColGroup=function(a){if(2>a)return this.colYs;for(var b=[],c=this.cols+1-a,d=0;c>d;d++){var e=this.colYs.slice(d,d+a);b[d]=Math.max.apply(Math,e)}return b},d.prototype._manageStamp=function(a){var c=b(a),d=this._getElementOffset(a),e=this.options.isOriginLeft?d.left:d.right,f=e+c.outerWidth,g=Math.floor(e/this.columnWidth);g=Math.max(0,g);var h=Math.floor(f/this.columnWidth);h-=f%this.columnWidth?0:1,h=Math.min(this.cols-1,h);for(var i=(this.options.isOriginTop?d.top:d.bottom)+c.outerHeight,j=g;h>=j;j++)this.colYs[j]=Math.max(i,this.colYs[j])},d.prototype._getContainerSize=function(){this.maxY=Math.max.apply(Math,this.colYs);var a={height:this.maxY};return this.options.isFitWidth&&(a.width=this._getContainerFitWidth()),a},d.prototype._getContainerFitWidth=function(){for(var a=0,b=this.cols;--b&&0===this.colYs[b];)a++;return(this.cols-a)*this.columnWidth-this.gutter},d.prototype.needsResizeLayout=function(){var a=this.containerWidth;return this.getContainerWidth(),a!==this.containerWidth},d}var c=Array.prototype.indexOf?function(a,b){return a.indexOf(b)}:function(a,b){for(var c=0,d=a.length;d>c;c++){var e=a[c];if(e===b)return c}return-1};"function"==typeof define&&define.amd?define(["outlayer/outlayer","get-size/get-size"],b):a.Masonry=b(a.Outlayer,a.getSize)}(window);


/*!
 * classie v1.0.1
 * class helper functions
 * from bonzo https://github.com/ded/bonzo
 * MIT license
 * 
 * classie.has( elem, 'my-class' ) -> true/false
 * classie.add( elem, 'my-new-class' )
 * classie.remove( elem, 'my-unwanted-class' )
 * classie.toggle( elem, 'my-class' )
 */

/*jshint browser: true, strict: true, undef: true, unused: true */
/*global define: false, module: false */

( function( window ) {

'use strict';

// class helper functions from bonzo https://github.com/ded/bonzo

function classReg( className ) {
  return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
}

// classList support for class management
// altho to be fair, the api sucks because it won't accept multiple classes at once
var hasClass, addClass, removeClass;

if ( 'classList' in document.documentElement ) {
  hasClass = function( elem, c ) {
    return elem.classList.contains( c );
  };
  addClass = function( elem, c ) {
    elem.classList.add( c );
  };
  removeClass = function( elem, c ) {
    elem.classList.remove( c );
  };
}
else {
  hasClass = function( elem, c ) {
    return classReg( c ).test( elem.className );
  };
  addClass = function( elem, c ) {
    if ( !hasClass( elem, c ) ) {
      elem.className = elem.className + ' ' + c;
    }
  };
  removeClass = function( elem, c ) {
    elem.className = elem.className.replace( classReg( c ), ' ' );
  };
}

function toggleClass( elem, c ) {
  var fn = hasClass( elem, c ) ? removeClass : addClass;
  fn( elem, c );
}

var classie = {
  // full names
  hasClass: hasClass,
  addClass: addClass,
  removeClass: removeClass,
  toggleClass: toggleClass,
  // short names
  has: hasClass,
  add: addClass,
  remove: removeClass,
  toggle: toggleClass
};

// transport
if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( classie );
} else if ( typeof exports === 'object' ) {
  // CommonJS
  module.exports = classie;
} else {
  // browser global
  window.classie = classie;
}

})( window );



/*
A simple jQuery function that can add listeners on attribute change.
http://meetselva.github.io/attrchange/

About License:
Copyright (C) 2013 Selvakumar Arumugam
You may use attrchange plugin under the terms of the MIT Licese.
https://github.com/meetselva/attrchange/blob/master/MIT-License.txt
*/
(function($) {
   function isDOMAttrModifiedSupported() {
		var p = document.createElement('p');
		var flag = false;
		
		if (p.addEventListener) p.addEventListener('DOMAttrModified', function() {
			flag = true
		}, false);
		else if (p.attachEvent) p.attachEvent('onDOMAttrModified', function() {
			flag = true
		});
		else return false;
		
		p.setAttribute('id', 'target');
		
		return flag;
   }
   
   function checkAttributes(chkAttr, e) {
		if (chkAttr) {
			var attributes = this.data('attr-old-value');
			
			if (e.attributeName.indexOf('style') >= 0) {
				if (!attributes['style']) attributes['style'] = {}; //initialize
				var keys = e.attributeName.split('.');
				e.attributeName = keys[0];
				e.oldValue = attributes['style'][keys[1]]; //old value
				e.newValue = keys[1] + ':' + this.prop("style")[$.camelCase(keys[1])]; //new value
				attributes['style'][keys[1]] = e.newValue;
			} else {
				e.oldValue = attributes[e.attributeName];
				e.newValue = this.attr(e.attributeName);
				attributes[e.attributeName] = e.newValue; 
			}
			
			this.data('attr-old-value', attributes); //update the old value object
		}	   
   }

   //initialize Mutation Observer
   var MutationObserver = window.MutationObserver || window.WebKitMutationObserver;

   $.fn.attrchange = function(o) {
	   
		var cfg = {
			trackValues: false,
			callback: $.noop
		};
		
		//for backward compatibility
		if (typeof o === "function" ) { 
			cfg.callback = o; 
		} else { 
			$.extend(cfg, o); 
		}

	    if (cfg.trackValues) { //get attributes old value
	    	$(this).each(function (i, el) {
	    		var attributes = {};
	    		for (var attr, i=0, attrs=el.attributes, l=attrs.length; i<l; i++){
	    		    attr = attrs.item(i);
	    		    attributes[attr.nodeName] = attr.value;
	    		}
	    		
	    		$(this).data('attr-old-value', attributes);
	    	});
	    }
	   
		if (MutationObserver) { //Modern Browsers supporting MutationObserver
			/*
			   Mutation Observer is still new and not supported by all browsers. 
			   http://lists.w3.org/Archives/Public/public-webapps/2011JulSep/1622.html
			*/
			var mOptions = {
				subtree: false,
				attributes: true,
				attributeOldValue: cfg.trackValues
			};
	
			var observer = new MutationObserver(function(mutations) {
				mutations.forEach(function(e) {
					var _this = e.target;
					
					//get new value if trackValues is true
					if (cfg.trackValues) {
						/**
						 * @KNOWN_ISSUE: The new value is buggy for STYLE attribute as we don't have 
						 * any additional information on which style is getting updated. 
						 * */
						e.newValue = $(_this).attr(e.attributeName);
					}
					
					cfg.callback.call(_this, e);
				});
			});
	
			return this.each(function() {
				observer.observe(this, mOptions);
			});
		} else if (isDOMAttrModifiedSupported()) { //Opera
			//Good old Mutation Events but the performance is no good
			//http://hacks.mozilla.org/2012/05/dom-mutationobserver-reacting-to-dom-changes-without-killing-browser-performance/
			return this.on('DOMAttrModified', function(event) {
				if (event.originalEvent) event = event.originalEvent; //jQuery normalization is not required for us 
				event.attributeName = event.attrName; //property names to be consistent with MutationObserver
				event.oldValue = event.prevValue; //property names to be consistent with MutationObserver 
				cfg.callback.call(this, event);
			});
		} else if ('onpropertychange' in document.body) { //works only in IE		
			return this.on('propertychange', function(e) {
				e.attributeName = window.event.propertyName;
				//to set the attr old value
				checkAttributes.call($(this), cfg.trackValues , e);
				cfg.callback.call(this, e);
			});
		}

		return this;
    }
})(jQuery);


/*  EachSteps  */
(function(a){window.requestAnimFrame=(function(){return window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||window.oRequestAnimationFrame||window.msRequestAnimationFrame||function(c,b){window.setTimeout(c,1000/60);};})();window.requestTimeout=function(d,c){if(!window.requestAnimationFrame&&!window.webkitRequestAnimationFrame&&!(window.mozRequestAnimationFrame&&window.mozCancelRequestAnimationFrame)&&!window.oRequestAnimationFrame&&!window.msRequestAnimationFrame){return window.setTimeout(d,c);}var f=new Date().getTime(),e=new Object();function b(){var g=new Date().getTime(),h=g-f;h>=c?d.call():e.value=requestAnimFrame(b);}e.value=requestAnimFrame(b);return e;};window.clearRequestTimeout=function(b){window.cancelAnimationFrame?window.cancelAnimationFrame(b.value):window.webkitCancelRequestAnimationFrame?window.webkitCancelRequestAnimationFrame(b.value):window.mozCancelRequestAnimationFrame?window.mozCancelRequestAnimationFrame(b.value):window.oCancelRequestAnimationFrame?window.oCancelRequestAnimationFrame(b.value):window.msCancelRequestAnimationFrame?msCancelRequestAnimationFrame(b.value):clearTimeout(b);};a.eachStep=function(e,d,f){var c="200";var b=0;if(typeof d=="function"){f=d;}else{c=d;}if(c=="slow"){c=600;}if(c=="fast"){c=200;}if(typeof f!="function"){return false;}return a.each(e,function(g,h){window.requestTimeout(function(){f(g,h,c);},c*b);b++;});};a.fn.eachStep=function(c,d){var b="200";if(typeof c=="function"){d=c;}else{b=c;}if(b=="slow"){b=600;}if(b=="fast"){b=200;}if(typeof d!="function"){return false;}return this.each(function(e,f){window.requestTimeout(function(){d(e,f,b);},b*e);});};})(jQuery);



/*! Copyright (c) 2011 Brandon Aaron (http://brandonaaron.net)
 * Licensed under the MIT License (LICENSE.txt).
 *
 * Thanks to: http://adomas.org/javascript-mouse-wheel/ for some pointers.
 * Thanks to: Mathias Bank(http://www.mathias-bank.de) for a scope bug fix.
 * Thanks to: Seamus Leahy for adding deltaX and deltaY
 *
 * Version: 3.0.6
 * 
 * Requires: 1.2.2+
 */
(function(a){function d(b){var c=b||window.event,d=[].slice.call(arguments,1),e=0,f=!0,g=0,h=0;return b=a.event.fix(c),b.type="mousewheel",c.wheelDelta&&(e=c.wheelDelta/120),c.detail&&(e=-c.detail/3),h=e,c.axis!==undefined&&c.axis===c.HORIZONTAL_AXIS&&(h=0,g=-1*e),c.wheelDeltaY!==undefined&&(h=c.wheelDeltaY/120),c.wheelDeltaX!==undefined&&(g=-1*c.wheelDeltaX/120),d.unshift(b,e,g,h),(a.event.dispatch||a.event.handle).apply(this,d)}var b=["DOMMouseScroll","mousewheel"];if(a.event.fixHooks)for(var c=b.length;c;)a.event.fixHooks[b[--c]]=a.event.mouseHooks;a.event.special.mousewheel={setup:function(){if(this.addEventListener)for(var a=b.length;a;)this.addEventListener(b[--a],d,!1);else this.onmousewheel=d},teardown:function(){if(this.removeEventListener)for(var a=b.length;a;)this.removeEventListener(b[--a],d,!1);else this.onmousewheel=null}},a.fn.extend({mousewheel:function(a){return a?this.bind("mousewheel",a):this.trigger("mousewheel")},unmousewheel:function(a){return this.unbind("mousewheel",a)}})})(jQuery)

/* Smooth scroll */
/* jquery.simplr.smoothscroll version 1.0 copyright (c) 2012 https://github.com/simov/simplr-smoothscroll licensed under MIT */
;(function(e){"use strict";e.srSmoothscroll=function(t){var n=e.extend({step:95,speed:600,ease:"swing"},t||{});var r=e(window),i=e(document),s=0,o=n.step,u=n.speed,a=r.height(),f=navigator.userAgent.indexOf("AppleWebKit")!==-1?e("body"):e("html"),l=false;e("body").mousewheel(function(e,t){l=true;if(t<0)s=s+a>=i.height()?s:s+=o;else s=s<=0?0:s-=o;f.stop().animate({scrollTop:s},u,n.ease,function(){l=false});return false});r.on("resize",function(e){a=r.height()}).on("scroll",function(e){if(!l)s=r.scrollTop()})}})(jQuery);



/* Circle Menu */

(function( $ ) {

  $.fn.PieMenu = function(options) {
	var angle,
		delay_time,
		ele_angle=[],
		x_pos=[],
		y_pos=[];
	
    var settings = $.extend( {
      'starting_angel'   : '0',
      'angel_difference' : '90',
	  'radius':'200',
	  'menu_element' : this.children('.menu_option').children(),
	  'menu_button' : this.children('.menu_button'),
    }, options);
	
	
	angle = parseInt(settings.angel_difference)/(settings.menu_element.length-1);
	delay_time = 1/(settings.menu_element.length-1);

	function setPosition(val){
		$(settings.menu_element).each(function(i,ele){
			$(ele).css({
			'left' : (val==0)?0:y_pos[i],
			'top' : (val==0)?0:-x_pos[i],
			});
		});
	}
	
	$(settings.menu_button).unbind('click', clickHandler);	//remove event if exist
	
	var clickHandler = function() {
		if($(this).parent().hasClass('active')){
			setPosition(0);
			$(this).parent().removeClass('active');
			$(this).parent().addClass('inactive');

		}else{
			setPosition(1);
			$(this).parent().addClass('active');
			$(this).parent().removeClass('inactive');
		}	
		$(this).toggleClass("btn-rotate");
	};

	$(settings.menu_button).bind('click', clickHandler);

	return settings.menu_element.each(function(i,ele){
		ele_angle[i] = (parseInt(settings.starting_angel) + angle*(i))*Math.PI/180;
		 x_pos[i] = (settings.radius * Math.sin(ele_angle[i]));
         y_pos[i] = (settings.radius * Math.cos(ele_angle[i]));
		
      })
	  
  };
})( jQuery );


/*
 * Justified Gallery - v3.1.0
 * http://miromannino.com/projects/justified-gallery/
 * Copyright (c) 2014 Miro Mannino
 * Licensed under the MIT license.
 */
(function($) {

	/* Events
		jg.complete : called when all the gallery has been created
		jg.resize : called when the gallery has been resized
	*/

	$.fn.justifiedGallery = function (arg) {

		// Default options
		var defaults = {
			sizeRangeSuffixes : {
				'lt100': '_t', 
				'lt240': '_m', 
				'lt320': '_n', 
				'lt500': '', 
				'lt640': '_z', 
				'lt1024': '_b'
			},
			rowHeight : 120,
			maxRowHeight : 0, //negative value = no limits, 0 = 1.5 * rowHeight
			margins : 1,
			lastRow : 'nojustify', // or can be 'justify' or 'hide'
			fixedHeight : false,
			captions : true,
			rel : null, //rewrite the rel of each analyzed links
			target : null, //rewrite the target of all links
			extension : /\.[^.]+$/,
			refreshTime : 250,
			randomize : false
		};

		function getSuffix(width, height, context) {
			var longestSide;
			longestSide = (width > height) ? width : height;
			if (longestSide <= 100) {
				return context.settings.sizeRangeSuffixes.lt100;
			} else if (longestSide <= 240) {
				return context.settings.sizeRangeSuffixes.lt240;
			} else if (longestSide <= 320) {
				return context.settings.sizeRangeSuffixes.lt320;
			} else if (longestSide <= 500) {
				return context.settings.sizeRangeSuffixes.lt500;
			} else if (longestSide <= 640) {
				return context.settings.sizeRangeSuffixes.lt640;
			} else {
				return context.settings.sizeRangeSuffixes.lt1024;
			}
		}

		function onEntryMouseEnterForCaption (sender) {
			$(sender.currentTarget).find('.caption').stop().fadeTo(500, 0.7);
		}

		function onEntryMouseLeaveForCaption (sender) {
			$(sender.currentTarget).find('.caption').stop().fadeTo(500, 0.0);
		}

		function displayEntry($entry, x, y, imgWidth, imgHeight, rowHeight, context) {
			var $image = $entry.find('img');

			$image.css('width', imgWidth);
			$image.css('height', imgHeight);
			$image.css('margin-left', - imgWidth / 2);
			$image.css('margin-top', - imgHeight / 2);
			$entry.width(imgWidth);
			$entry.height(rowHeight);
			$entry.css('top', y);
			$entry.css('left', x);

			//DEBUG// console.log('displayEntry: $image.width() = ' + $image.width() + ' $image.height() = ' + $image.height());

			// Image reloading for an high quality of thumbnails
			var imageSrc = $image.attr('src');
			var newImageSrc = imageSrc.replace(context.settings.extension, '').replace(context.usedSizeRangeRegExp, '') + 
								getSuffix(imgWidth, imgHeight, context) + 
								imageSrc.match(context.settings.extension)[0];

			$image.one('error', function () {
				//DEBUG// console.log('revert the original image');
				$image.attr('src', $image.data('jg.originalSrc')); //revert to the original thumbnail, we got it.
			});

			$entry.stop().fadeTo(300, 1, function () {
				if (imageSrc !== newImageSrc) { //load the new image after the fadeIn
					$image.attr('src', newImageSrc);
				}	
			});

			// Captions ------------------------------
			//TODO option for caption always visible
			var captionMouseEvents = $entry.data('jg.captionMouseEvents');
			if (context.settings.captions === true) {
				var $imgCaption = $entry.find('.caption');
				if ($imgCaption.length === 0) { // Create it if it doesn't exists
					var caption = $image.attr('alt');
					if (typeof caption === 'undefined') caption = $entry.attr('title');
					if (typeof caption !== 'undefined') { // Create only we found something
						$imgCaption = $('<div class="caption">' + caption + '</div>');
						$entry.append($imgCaption);
					}
				}
			
				// Create events (we check again the $imgCaption because it can be still inexistent)
				if ($imgCaption.length !== 0 && typeof captionMouseEvents === 'undefined') { 
					captionMouseEvents = {
						mouseenter: onEntryMouseEnterForCaption,
						mouseleave: onEntryMouseLeaveForCaption
					};
					$entry.on('mouseenter', captionMouseEvents.mouseenter);
					$entry.on('mouseleave', captionMouseEvents.mouseleave);
					$entry.data('jg.captionMouseEvents', captionMouseEvents);
				}
			} else {
				if (typeof captionMouseEvents !== 'undefined') {
					$entry.off('mouseenter', captionMouseEvents.mouseenter);
					$entry.off('mouseleave', captionMouseEvents.mouseleave);
					$entry.removeData('jg.captionMouseEvents');
				}
			}

		}

		function prepareBuildingRow(context, isLastRow) {
			var i, $entry, $image, stdImgW, newImgW, newImgH, justify = true;
			var minHeight = 0;
			var availableWidth = context.galleryWidth;
			var extraW = availableWidth - context.buildingRow.width - 
							((context.buildingRow.entriesBuff.length - 1) * context.settings.margins);

			//Skip the last row if we can't justify it and the lastRow == 'hide'
			if (isLastRow && context.settings.lastRow === 'hide' && (extraW / availableWidth > 0.35)) {
				for (i = 0; i < context.buildingRow.entriesBuff.length; i++) {
					$entry = context.buildingRow.entriesBuff[i];
					$entry.stop().fadeTo(0);
				}
				return -1;
			}

			// With lastRow = nojustify, justify if (extraW / availableWidth <= 0.35)
			if (isLastRow && context.settings.lastRow === 'nojustify' && (extraW / availableWidth > 0.35)) justify = false;

			//DEBUG// console.log('prepareBuildingRow: availableWidth: ' + availableWidth + ' extraW: ' + extraW);

			for (i = 0; i < context.buildingRow.entriesBuff.length; i++) {
				$image = context.buildingRow.entriesBuff[i].find('img');

				stdImgW = Math.ceil($image.data('jg.imgw') / ($image.data('jg.imgh') / context.settings.rowHeight));

				if (justify) {
					if (i < context.buildingRow.entriesBuff.length - 1) {
						// Scale proportionally of the image aspect ratio (the more is long, the more can be extended)
						newImgW = stdImgW + Math.ceil(stdImgW / context.buildingRow.width * extraW);
					} else {
						newImgW = availableWidth;
					}

					// Scale factor for the new width is (newImgW / stdImgW), hence:
					newImgH = Math.ceil(context.settings.rowHeight * (newImgW / stdImgW));

					// With fixedHeight the newImgH >= rowHeight. In some cases here this is not satisfied (due to the justification)
					if (context.settings.fixedHeight && newImgH < context.settings.rowHeight) {
						newImgW = stdImgW;
						newImgH = context.settings.rowHeight;
					}
				} else {
					newImgW = stdImgW;
					newImgH = context.settings.rowHeight;
				}

				$image.data('jg.imgw', newImgW);
				$image.data('jg.imgh', newImgH);

				//DEBUG// console.log($image.attr('alt') + ' new jq.imgw = ' + $image.data('jg.imgw') + ' new jg.imgh = ' + $image.data('jg.imgh'));
				
				availableWidth -= newImgW + ((i < context.buildingRow.entriesBuff.length - 1) ? context.settings.margins : 0);

				if (i === 0 || minHeight > newImgH) minHeight = newImgH;
			}

			//DEBUG// console.log('availableWidth: ' + availableWidth + ' extraW: ' + extraW);

			if (context.settings.fixedHeight) minHeight = context.settings.rowHeight;
			return minHeight;
		}

		function rewind(context) {
			context.lastAnalyzedIndex = -1;
			context.buildingRow.entriesBuff = [];
			context.buildingRow.width = 0;
			context.offY = 0;
			context.firstRowFlushed = false;
		}

		function flushRow(context, isLastRow) {
			var $entry, $image, minHeight, offX = 0;

			//DEBUG// console.log('flush (width: ' + context.buildingRow.width + ', galleryWidth: ' + context.galleryWidth + ', ' + 'isLastRow: ' + isLastRow + ')');

			minHeight = prepareBuildingRow(context, isLastRow);
			if (isLastRow && context.settings.lastRow === 'hide' && minHeight === -1) {
				context.buildingRow.entriesBuff = [];
				context.buildingRow.width = 0;
				return;
			}

			if (context.settings.maxRowHeight > 0 && context.settings.maxRowHeight < minHeight)
				minHeight = context.settings.maxRowHeight;
			else if (context.settings.maxRowHeight === 0 && (1.5 * context.settings.rowHeight) < minHeight)
				minHeight = 1.5 * context.settings.rowHeight;

			for (var i = 0; i < context.buildingRow.entriesBuff.length; i++) {
				$entry = context.buildingRow.entriesBuff[i];
				$image = $entry.find('img');
				displayEntry($entry, offX, context.offY, $image.data('jg.imgw'), $image.data('jg.imgh'), minHeight, context);
				offX += $image.data('jg.imgw') + context.settings.margins;
			}

			//Gallery Height
			context.$gallery.height(context.offY + minHeight +
				(context.spinner.active ? context.spinner.$el.innerHeight() : 0)
			);

			if(!isLastRow) {

				//Ready for a new row
				context.offY += minHeight + context.settings.margins;

				//DEBUG// console.log('minHeight: ' + minHeight + ' offY: ' + context.offY);

				context.buildingRow.entriesBuff = []; //clear the array creating a new one
				context.buildingRow.width = 0;
				context.firstRowFlushed = true;

				context.$gallery.trigger('jg.rowflush');
			}
		}

		function checkWidth(context) {
			context.checkWidthIntervalId = setInterval(function () {
				var galleryWidth = parseInt(context.$gallery.width(), 10);
				if (context.galleryWidth !== galleryWidth) {
					//DEBUG// console.log("resize. old: " + context.galleryWidth + " new: " + galleryWidth);
					
					context.galleryWidth = galleryWidth;
					rewind(context);

					// Restart to analyze
					startImgAnalyzer(context, true);
				}
			}, context.settings.refreshTime);
		}	

		function startLoadingSpinnerAnimation(spinnerContext) {
			clearInterval(spinnerContext.intervalId);
			spinnerContext.intervalId = setInterval(function () {
				if (spinnerContext.phase < spinnerContext.$points.length) 
					spinnerContext.$points.eq(spinnerContext.phase).fadeTo(spinnerContext.timeslot, 1);
				else
					spinnerContext.$points.eq(spinnerContext.phase - spinnerContext.$points.length).fadeTo(spinnerContext.timeslot, 0);
				spinnerContext.phase = (spinnerContext.phase + 1) % (spinnerContext.$points.length * 2);
			}, spinnerContext.timeslot);
		}

		function stopLoadingSpinnerAnimation(spinnerContext) {
			clearInterval(spinnerContext.intervalId);
			spinnerContext.intervalId = null;
		}

		function stopImgAnalyzerStarter(context) {
			context.yield.flushed = 0;
			if (context.imgAnalyzerTimeout !== null) clearTimeout(context.imgAnalyzerTimeout);
		}

		function startImgAnalyzer(context, isForResize) {
			stopImgAnalyzerStarter(context);
			context.imgAnalyzerTimeout = setTimeout(function () { analyzeImages(context, isForResize); }, 0.001);
			analyzeImages(context, isForResize);
		}

		function analyzeImages(context, isForResize) {
			
			//DEBUG// 
			/*var rnd = parseInt(Math.random() * 10000, 10);
			//DEBUG// console.log('analyzeImages ' + rnd + ' start');
			//DEBUG// console.log('images status: ');
			for (var i = 0; i < context.entries.length; i++) {
				var $entry = $(context.entries[i]);
				var $image = $entry.find('img');
				//DEBUG// console.log(i + ' (alt: ' + $image.attr('alt') + 'loaded: ' + $image.data('jg.loaded') + ')');
			}*/

			/* The first row */
			var isLastRow = context.firstRowFlushed;
			
			for (var i = context.lastAnalyzedIndex + 1; i < context.entries.length; i++) {
				var $entry = $(context.entries[i]);
				var $image = $entry.find('img');


				//DEBUG// console.log('checking: ' + i + ' (loaded: ' + $image.data('jg.loaded') + ')');

				if ($image.data('jg.loaded') === true) {
					var newImgW = Math.ceil($image.data('jg.imgw') / ($image.data('jg.imgh') / context.settings.rowHeight));

					//DEBUG// console.log('analyzed img ' + $image.attr('alt') + ', imgW: ' + $image.data('jg.imgw') + ', imgH: ' + $image.data('jg.imgh') + ', rowWidth: ' + context.buildingRow.width);

					isLastRow = context.firstRowFlushed && (i >= context.entries.length - 1);

					// NOTE: If we have fixed height we need to never have a negative extraW, else some images can be hided.
					//				This is because the images need to have a smaller height, but fixed height doesn't allow it
					if (context.buildingRow.width + (context.settings.fixedHeight ? newImgW : newImgW / 2) + 
								(context.buildingRow.entriesBuff.length - 1) * 
								context.settings.margins > context.galleryWidth) {

						flushRow(context, isLastRow);

						if(++context.yield.flushed >= context.yield.every) {
							//DEBUG// console.log("yield");
							startImgAnalyzer(context, isForResize);
							return;
						}

					}

					context.buildingRow.entriesBuff.push($entry);
					context.buildingRow.width += newImgW;
					context.lastAnalyzedIndex = i;

				} else if ($image.data('jg.loaded') !== 'error') {
					return;
				}
			}

			// Last row flush (the row is not full)
			if (context.buildingRow.entriesBuff.length > 0) flushRow(context, isLastRow);

			if (context.spinner.active) {
				context.spinner.active = false;
				context.$gallery.height(context.$gallery.height() - context.spinner.$el.innerHeight());
				context.spinner.$el.detach();
				stopLoadingSpinnerAnimation(context.spinner);
			}

			/* Stop, if there is, the timeout to start the analyzeImages.
					This is because an image can be set loaded, and the timeout can be set,
					but this image can be analyzed yet. 
			*/
			stopImgAnalyzerStarter(context);

			//On complete callback
			if (!isForResize) context.$gallery.trigger('jg.complete'); else context.$gallery.trigger('jg.resize');

			//DEBUG// console.log('analyzeImages ' + rnd +  ' end');
		}

		function checkSettings (context) {

			function checkSuffixesRange(range) {
				if (typeof context.settings.sizeRangeSuffixes[range] !== 'string')
					throw 'sizeRangeSuffixes.' + range + ' must be a string';
			}

			function checkOrConvertNumber(setting) {
				if (typeof context.settings[setting] === 'string') {
					context.settings[setting] = parseInt(context.settings[setting], 10);
					if (isNaN(context.settings[setting])) throw 'invalid number for ' + setting;
				} else if (typeof context.settings[setting] === 'number') {
					if (isNaN(context.settings[setting])) throw 'invalid number for ' + setting;
				} else {
					throw setting + ' must be a number';
				}
			}

			if (typeof context.settings.sizeRangeSuffixes !== 'object')
				throw 'sizeRangeSuffixes must be defined and must be an object';

			checkSuffixesRange('lt100');
			checkSuffixesRange('lt240');
			checkSuffixesRange('lt320');
			checkSuffixesRange('lt500');
			checkSuffixesRange('lt640');
			checkSuffixesRange('lt1024');

			checkOrConvertNumber('rowHeight');
			checkOrConvertNumber('maxRowHeight');
			checkOrConvertNumber('margins');

			if (context.settings.lastRow !== 'nojustify' &&
					context.settings.lastRow !== 'justify' &&
					context.settings.lastRow !== 'hide') {
				throw 'lastRow must be "nojustify", "justify" or "hide"';
			}

			if (typeof context.settings.fixedHeight !== 'boolean') {
				throw 'fixedHeight must be a boolean';	
			}

			if (typeof context.settings.captions !== 'boolean') {
				throw 'captions must be a boolean';	
			}

			checkOrConvertNumber('refreshTime');

			if (typeof context.settings.randomize !== 'boolean') {
				throw 'randomize must be a boolean';	
			}

		}

		return this.each(function (index, gallery) {

			var $gallery = $(gallery);
			$gallery.addClass('justified-gallery');

			var context = $gallery.data('jg.context');
			if (typeof context === 'undefined') {

				if (typeof arg !== 'undefined' && arg !== null && typeof arg !== 'object') 
					throw 'The argument must be an object';

				// Spinner init
				var $spinner = $('<div class="spinner"><span></span><span></span><span></span></div>');

				//Context init
				context = {
					settings : $.extend({}, defaults, arg),
					imgAnalyzerTimeout : null,
					entries : null,
					buildingRow : {
						entriesBuff : [],
						width : 0
					},
					lastAnalyzedIndex : -1,
					firstRowFlushed : false,
					yield : {
						every : 2, /* do a flush every context.yield.every flushes (
												* must be greater than 1, else the analyzeImages will loop */
						flushed : 0 //flushed rows without a yield
					},
					offY : 0,
					spinner : {
						active : false,
						phase : 0,
						timeslot : 150,
						$el : $spinner,
						$points : $spinner.find('span'),
						intervalId : null
					},
					checkWidthIntervalId : null,
					galleryWidth : $gallery.width(),
					$gallery : $gallery
				};

				$gallery.data('jg.context', context);

			} else if (arg === 'norewind') {
				// In this case we don't rewind, and analyze all the images
			} else {
				context.settings = $.extend({}, context.settings, arg);
				rewind(context);
			}
			
			checkSettings(context);

			context.entries = $gallery.find('a').toArray();
			if (context.entries.length === 0) return;

			// Randomize
			if (context.settings.randomize) {
				context.entries.sort(function () { return Math.random() * 2 - 1; });
				$.each(context.entries, function () {
					$(this).appendTo($gallery);
				});
			}

			context.usedSizeRangeRegExp = new RegExp("(" + 
				context.settings.sizeRangeSuffixes.lt100 + "|" + 
				context.settings.sizeRangeSuffixes.lt240 + "|" + 
				context.settings.sizeRangeSuffixes.lt320 + "|" + 
				context.settings.sizeRangeSuffixes.lt500 + "|" + 
				context.settings.sizeRangeSuffixes.lt640 + "|" + 
				context.settings.sizeRangeSuffixes.lt1024 + ")$"
			);

			if (context.settings.maxRowHeight > 0 && context.settings.maxRowHeight < context.settings.rowHeight)
				context.settings.maxRowHeight = context.settings.rowHeight;

			var imagesToLoad = false;
			$.each(context.entries, function (index, entry) {
				var $entry = $(entry);
				var $image = $entry.find('img');

				if ($image.data('jg.loaded') !== true) {
					$image.data('jg.loaded', false);

					//DEBUG// console.log('listed ' + $image.attr('alt'));

					imagesToLoad = true;

					// Spinner start
					if (context.spinner.active === false) {
						context.spinner.active = true;
						$gallery.append(context.spinner.$el);
						$gallery.height(context.offY + context.spinner.$el.innerHeight());
						startLoadingSpinnerAnimation(context.spinner);
					}

					// Link Rel global overwrite
					if (context.settings.rel !== null) $entry.attr('rel', context.settings.rel);

					// Link Target global overwrite
					if (context.settings.target !== null) $entry.attr('target', context.settings.target);

					// Image src
					var imageSrc = (typeof $image.data('safe-src') !== 'undefined') ? $image.data('safe-src') : $image.attr('src');
					$image.data('jg.originalSrc', imageSrc);
					$image.attr('src', imageSrc);

					/* Check if the image is loaded or not using another image object.
							We cannot use the 'complete' image property, because some browsers, 
							with a 404 set complete = true
					*/
					var loadImg = new Image();
					var $loadImg = $(loadImg);
					$loadImg.one('load', function imgLoaded () {
						//DEBUG// console.log('img load (alt: ' + $image.attr('alt') + ')');
						$image.off('load error');
						$image.data('jg.imgw', loadImg.width);
						$image.data('jg.imgh', loadImg.height);
						$image.data('jg.loaded', true);
						startImgAnalyzer(context, false);
					});
					$loadImg.one('error', function imgLoadError () {
						//DEBUG// console.log('img error (alt: ' + $image.attr('alt') + ')');
						$image.off('load error');
						$image.data('jg.loaded', 'error');
						startImgAnalyzer(context, false);
					});
					loadImg.src = imageSrc;

				}

			});

			if (!imagesToLoad) startImgAnalyzer(context, false);
			checkWidth(context);
		});

	};
	
}(jQuery));


(function(d){d.fn.oembed=function(l,k,j){b=d.extend(true,d.fn.oembed.defaults,k);g();return this.each(function(){var m=d(this),n=(l!=null)?l:m.attr("href"),o;if(j){b.onEmbed=j}else{b.onEmbed=function(p){d.fn.oembed.insertCode(this,b.embedMethod,p)}}if(n!=null){o=d.fn.oembed.getOEmbedProvider(n);if(o!=null){o.params=h(b[o.name])||{};o.maxWidth=b.maxWidth;o.maxHeight=b.maxHeight;a(m,n,o)}else{b.onProviderNotFound.call(m,n)}}return m})};var b,e=[];d.fn.oembed.defaults={maxWidth:null,maxHeight:null,embedMethod:"replace",defaultOEmbedProvider:"oohembed",allowedProviders:null,disallowedProviders:null,customProviders:null,defaultProvider:null,greedy:true,onProviderNotFound:function(){},beforeEmbed:function(){},afterEmbed:function(){},onEmbed:function(){},onError:function(){},ajaxOptions:{}};function i(o,n){var k=o.apiendpoint,j="",m=o.callbackparameter||"callback",l;if(k.indexOf("?")<=0){k=k+"?"}else{k=k+"&"}if(o.maxWidth!=null&&o.params.maxwidth==null){o.params.maxwidth=o.maxWidth}if(o.maxHeight!=null&&o.params.maxheight==null){o.params.maxheight=o.maxHeight}for(l in o.params){if(l==o.callbackparameter){continue}if(o.params[l]!=null){j+="&"+escape(l)+"="+o.params[l]}}k+="format=json&url="+escape(n)+j+"&"+m+"=?";return k}function a(j,n,l){var m=i(l,n),k=d.extend({url:m,type:"get",dataType:"json",success:function(p){var o=d.extend({},p);switch(o.type){case"photo":o.code=d.fn.oembed.getPhotoCode(n,o);break;case"video":o.code=d.fn.oembed.getVideoCode(n,o);break;case"rich":o.code=d.fn.oembed.getRichCode(n,o);break;default:o.code=d.fn.oembed.getGenericCode(n,o);break}b.beforeEmbed.call(j,o);b.onEmbed.call(j,o);b.afterEmbed.call(j,o)},error:b.onError.call(j,n,l)},b.ajaxOptions||{});d.ajax(k)}function g(){e=[];var m,j=[],k,l;if(!c(b.allowedProviders)){for(k=0;k<d.fn.oembed.providers.length;k++){if(d.inArray(d.fn.oembed.providers[k].name,b.allowedProviders)>=0){e.push(d.fn.oembed.providers[k])}}b.greedy=false}else{e=d.fn.oembed.providers}if(!c(b.disallowedProviders)){for(k=0;k<e.length;k++){if(d.inArray(e[k].name,b.disallowedProviders)<0){j.push(e[k])}}e=j;b.greedy=false}if(!c(b.customProviders)){d.each(b.customProviders,function(p,o){if(o instanceof d.fn.oembed.OEmbedProvider){e.push(l)}else{l=new d.fn.oembed.OEmbedProvider();if(l.fromJSON(o)){e.push(l)}}})}m=f(b.defaultOEmbedProvider);if(b.greedy==true){e.push(m)}for(k=0;k<e.length;k++){if(e[k].apiendpoint==null){e[k].apiendpoint=m.apiendpoint}}}function f(j){var k="http://oohembed.com/oohembed/";if(j=="embed.ly"){k="http://api.embed.ly/v1/api/oembed?"}return new d.fn.oembed.OEmbedProvider(j,null,null,k,"callback")}function h(l){if(l==null){return null}var j,k={};for(j in l){if(j!=null){k[j.toLowerCase()]=l[j]}}return k}function c(j){if(typeof j=="undefined"){return true}if(j==null){return true}if(d.isArray(j)&&j.length==0){return true}return false}d.fn.oembed.insertCode=function(j,l,k){if(k==null){return}switch(l){case"auto":if(j.attr("href")!=null){d.fn.oembed.insertCode(j,"append",k)}else{d.fn.oembed.insertCode(j,"replace",k)}break;case"replace":j.replaceWith(k.code);break;case"fill":j.html(k.code);break;case"append":var m=j.next();if(m==null||!m.hasClass("oembed-container")){m=j.after('<div class="oembed-container"></div>').next(".oembed-container");if(k!=null&&k.provider_name!=null){m.toggleClass("oembed-container-"+k.provider_name)}}m.html(k.code);break}};d.fn.oembed.getPhotoCode=function(j,k){var l,m=k.title?k.title:"";m+=k.author_name?" - "+k.author_name:"";m+=k.provider_name?" - "+k.provider_name:"";l='<div><a href="'+j+"\" target='_blank'><img src=\""+k.url+'" alt="'+m+'"/></a></div>';if(k.html){l+="<div>"+k.html+"</div>"}return l};d.fn.oembed.getVideoCode=function(j,k){var l=k.html;return l};d.fn.oembed.getRichCode=function(j,k){var l=k.html;return l};d.fn.oembed.getGenericCode=function(j,k){var m=(k.title!=null)?k.title:j,l='<a href="'+j+'">'+m+"</a>";if(k.html){l+="<div>"+k.html+"</div>"}return l};d.fn.oembed.isProviderAvailable=function(j){var k=getOEmbedProvider(j);return(k!=null)};d.fn.oembed.getOEmbedProvider=function(j){for(var k=0;k<e.length;k++){if(e[k].matches(j)){return e[k]}}return null};d.fn.oembed.OEmbedProvider=function(k,p,l,m,n){this.name=k;this.type=p;this.urlschemes=j(l);this.apiendpoint=m;this.callbackparameter=n;this.maxWidth=500;this.maxHeight=400;var o,r,q;this.matches=function(s){for(o=0;o<this.urlschemes.length;o++){q=new RegExp(this.urlschemes[o],"i");if(s.match(q)!=null){return true}}return false};this.fromJSON=function(s){for(r in s){if(r!="urlschemes"){this[r]=s[r]}else{this[r]=j(s[r])}}return true};function j(s){if(c(s)){return["."]}if(d.isArray(s)){return s}return s.split(";")}};d.fn.oembed.providers=[new d.fn.oembed.OEmbedProvider("youtube","video",["youtube\\.com/watch.+v=[\\w-]+&?"]),new d.fn.oembed.OEmbedProvider("flickr","photo",["flickr\\.com/photos/[-.\\w@]+/\\d+/?"],"http://flickr.com/services/oembed","jsoncallback"),new d.fn.oembed.OEmbedProvider("viddler","video",["viddler.com"]),new d.fn.oembed.OEmbedProvider("blip","video",["blip\\.tv/.+"],"http://blip.tv/oembed/"),new d.fn.oembed.OEmbedProvider("hulu","video",["hulu\\.com/watch/.*"],"http://www.hulu.com/api/oembed.json"),new d.fn.oembed.OEmbedProvider("vimeo","video",["http://www.vimeo.com/groups/.*/videos/.*","http://www.vimeo.com/.*","http://vimeo.com/groups/.*/videos/.*","http://vimeo.com/.*"],"http://vimeo.com/api/oembed.json"),new d.fn.oembed.OEmbedProvider("dailymotion","video",["dailymotion\\.com/.+"]),new d.fn.oembed.OEmbedProvider("scribd","rich",["scribd\\.com/.+"]),new d.fn.oembed.OEmbedProvider("slideshare","rich",["slideshare.net"],"http://www.slideshare.net/api/oembed/1"),new d.fn.oembed.OEmbedProvider("photobucket","photo",["photobucket\\.com/(albums|groups)/.*"],"http://photobucket.com/oembed/")]})(jQuery);


/*
* Copyright (C) 2009 Joel Sutherland
* Licenced under the MIT license
* http://www.newmediacampaigns.com/page/jquery-flickr-plugin
*
* Available tags for templates:
* title, link, date_taken, description, published, author, author_id, tags, image*
*/
(function($){$.fn.jflickrfeed=function(settings,callback){settings=$.extend(true,{flickrbase:'http://api.flickr.com/services/feeds/',feedapi:'photos_public.gne',limit:20,qstrings:{lang:'en-us',format:'json',jsoncallback:'?'},cleanDescription:true,useTemplate:true,itemTemplate:'',itemCallback:function(){}},settings);var url=settings.flickrbase+settings.feedapi+'?';var first=true;for(var key in settings.qstrings){if(!first)
url+='&';url+=key+'='+settings.qstrings[key];first=false;}
return $(this).each(function(){var $container=$(this);var container=this;$.getJSON(url,function(data){$.each(data.items,function(i,item){if(i<settings.limit){if(settings.cleanDescription){var regex=/<p>(.*?)<\/p>/g;var input=item.description;if(regex.test(input)){item.description=input.match(regex)[2]
if(item.description!=undefined)
item.description=item.description.replace('<p>','').replace('</p>','');}}
item['image_s']=item.media.m.replace('_m','_s');item['image_t']=item.media.m.replace('_m','_t');item['image_m']=item.media.m.replace('_m','_m');item['image']=item.media.m.replace('_m','');item['image_b']=item.media.m.replace('_m','_b');delete item.media;if(settings.useTemplate){var template=settings.itemTemplate;for(var key in item){var rgx=new RegExp('{{'+key+'}}','g');template=template.replace(rgx,item[key]);}
$container.append(template)}
settings.itemCallback.call(container,item);}});if($.isFunction(callback)){callback.call(container,data);}});});}})(jQuery);


/**
 * Dribbble
 * 
 */
 (function($) {
	$.fn.ballboy = function(options) {
		
		// Sanitize options
		$.fn.ballboy.settings = $.extend({}, $.fn.ballboy.defaults, options);
		
		var settings = $.fn.ballboy.settings;
		
		// Player is required
		if(!settings.player || (typeof(settings.player) != "string" && typeof(settings.player) != "number")) {
			throw new TypeError("Required setting 'player' must be a string or a number.");
		}
		
		// Shots per page
		settings.per_page = parseInt(settings.per_page);
		if(settings.per_page > 30 || settings.per_page < 1) {
			settings.per_page = 30;
		}
		
		// Current page
		settings.page = parseInt(settings.page);
		
		// Request URL
		settings.url = "http://api.dribbble.com/players/" + settings.player + "/shots?page=" + settings.page + "&per_page=" + settings.per_page + "&callback=?";
		
		
		
		// Allow chaining
		return this.each(function() {
			
			var $container = $(this).addClass("ballboy-container");
			
			if(typeof(settings.begin) == "function") {
				settings.begin($container);
			}
			
			var request = $.ajax({
				crossDomain: true,
				url: settings.url,
				dataType: "jsonp"
			});
			
			if(typeof(settings.always) == "function") {
				request.always(settings.always);
			}
			
			if(typeof(settings.fail) == "function") {
				request.fail(settings.fail);
			}
			
			if(typeof(settings.done) == "function") {
				request.done(settings.done);
			}
			
			request.done(function(response, textStatus, jqxhr) {
				
				if(jqxhr.status != 200) {
					return false;
				}
				
				$container.attr({
					"data-page" : response.page,
					"data-pages" : response.pages
				});
				
				
				// Pagination
				
				if($container.find(".ballboy-pagination").length > 0) {
					var $pagination = $container.find(".ballboy-pagination").detach();
				}
				else {
					var $pagination = $.fn.ballboy.pagination(response.pages, response.page);
				}
				
				$container.find(".ballboy-pagination .disabled").removeClass("disabled");
				
				if(parseInt(response.page) >= parseInt(response.pages)) {
					response.page = response.pages;
					$container.find(".ballboy-pagination-next").addClass("disabled");
				}
				
				if(parseInt(response.page) <= 1) {
					response.page = 1;
					$container.find(".ballboy-pagination-previous").addClass("disabled");
				}
				
				
				
				// Shots
				
				$container.empty();
				$.each(response.shots, function(index, element) {
					$container.append(settings.format(element));
				});
				$container.append($pagination);
				
				
				
				// Pagination events
				
				if(settings.bindPaginationEvents) {
					$container.find(".ballboy-pagination-previous:not(.disabled)").one("click", function(e) {
						settings["page"] = parseInt(response.page) - 1;
						$container.ballboy(settings);
					});
					
					$container.find(".ballboy-pagination-page").one("click", function(e) {
						settings["page"] = $(this).attr("data-page");
						$container.ballboy(settings);
					});
					
					$container.find(".ballboy-pagination-next:not(.disabled)").one("click", function(e) {
						settings["page"] = parseInt(response.page) + 1;
						$container.ballboy(settings);
					});
				}
				
				if(typeof(settings.finished) == "function") {
					settings.finished(response);
				}
			});

		});

	};


	$.fn.ballboy.format = function(shot) {
		var markup = '<div class="' + $.fn.ballboy.settings.shotClass + '" data-id="' + shot.id + '">';
	
		// Shot image
		markup += '<div class="ballboy-shot-image" data-src="' + shot.image_url + '" data-teaser-src="' + shot.image_teaser_url + '">';
		markup += '<a href="' + shot.url + '"><img src="' + shot.image_teaser_url + '" /></a>';
		
		// Shot title
		markup += '<h3 class="ballboy-shot-image-description">';
		markup += '<a href="' + shot.url + '">';
		markup += shot.title;
		
		markup += '</a>';
		markup += '</h3>';
		
		markup += '</div>';
		
		// Extra stats
		markup += '<div class="ballboy-shot-extras">';
		if(parseInt(shot.rebounds_count) > 0) {
			markup += '<span class="ballboy-shot-rebound-marker"></span>';
		}
		markup += '<span class="ballboy-shot-view-count" data-view-count="' + shot.views_count + '"></span>';
		markup += '<span class="ballboy-shot-comment-count" data-comment-count="' + shot.comments_count + '"></span>';
		markup += '<span class="ballboy-shot-like-count" data-like-count="' + shot.likes_count + '"></span>';
		markup += '</div>';
		
		markup += '</div>';
		
		return $.parseHTML(markup);
	};
	
	
	$.fn.ballboy.pagination = function(pages, currentPage) {
		var markup = '<div class="ballboy-pagination" data-current-page="' + currentPage + '">';
		markup += '<a class="ballboy-pagination-previous">' + $.fn.ballboy.settings.paginationPreviousText + '</a>';
		
		var currentClass = '';
		for(var p = 1; p <= pages; p++) {
			
			if(p == currentPage) {
				currentClass = ' ballboy-pagination-current';
			}
			else {
				currentClass = '';
			}
			
			/*
            markup += '<a class="ballboy-pagination-page' + currentClass + '" data-page="' + p + '">';
            
            if($.fn.ballboy.settings.showPaginationPages) {
                markup += p;
            }
            
            markup += '</a>';
            */
		}
		
		markup += '<a class="ballboy-pagination-next">' + $.fn.ballboy.settings.paginationNextText + '</a>';
		markup += '</div>';
		
		return $.parseHTML(markup);
	};
	
	
	$.fn.ballboy.defaults = {
		format : $.fn.ballboy.format,
		page : 1,
		per_page : 15,
		shotClass : "ballboy-shot",
		bindPaginationEvents : true,
		showPaginationControls : true,
		showPaginationPages : false,
		paginationPreviousText : "Previous",
		paginationNextText : "Next"
	};
	
	
}(jQuery));


// Instafeed.js
// Generated by CoffeeScript 1.3.3
(function(){var e,t;e=function(){function e(e,t){var n,r;this.options={target:"instafeed",get:"popular",resolution:"thumbnail",sortBy:"none",links:!0,mock:!1,useHttp:!1};if(typeof e=="object")for(n in e)r=e[n],this.options[n]=r;this.context=t!=null?t:this,this.unique=this._genKey()}return e.prototype.hasNext=function(){return typeof this.context.nextUrl=="string"&&this.context.nextUrl.length>0},e.prototype.next=function(){return this.hasNext()?this.run(this.context.nextUrl):!1},e.prototype.run=function(t){var n,r,i;if(typeof this.options.clientId!="string"&&typeof this.options.accessToken!="string")throw new Error("Missing clientId or accessToken.");if(typeof this.options.accessToken!="string"&&typeof this.options.clientId!="string")throw new Error("Missing clientId or accessToken.");return this.options.before!=null&&typeof this.options.before=="function"&&this.options.before.call(this),typeof document!="undefined"&&document!==null&&(i=document.createElement("script"),i.id="instafeed-fetcher",i.src=t||this._buildUrl(),n=document.getElementsByTagName("head"),n[0].appendChild(i),r="instafeedCache"+this.unique,window[r]=new e(this.options,this),window[r].unique=this.unique),!0},e.prototype.parse=function(e){var t,n,r,i,s,o,u,a,f,l,c,h,p,d,v,m,g,y,b,w,E,S;if(typeof e!="object"){if(this.options.error!=null&&typeof this.options.error=="function")return this.options.error.call(this,"Invalid JSON data"),!1;throw new Error("Invalid JSON response")}if(e.meta.code!==200){if(this.options.error!=null&&typeof this.options.error=="function")return this.options.error.call(this,e.meta.error_message),!1;throw new Error("Error from Instagram: "+e.meta.error_message)}if(e.data.length===0){if(this.options.error!=null&&typeof this.options.error=="function")return this.options.error.call(this,"No images were returned from Instagram"),!1;throw new Error("No images were returned from Instagram")}this.options.success!=null&&typeof this.options.success=="function"&&this.options.success.call(this,e),this.context.nextUrl="",e.pagination!=null&&(this.context.nextUrl=e.pagination.next_url);if(this.options.sortBy!=="none"){this.options.sortBy==="random"?d=["","random"]:d=this.options.sortBy.split("-"),p=d[0]==="least"?!0:!1;switch(d[1]){case"random":e.data.sort(function(){return.5-Math.random()});break;case"recent":e.data=this._sortBy(e.data,"created_time",p);break;case"liked":e.data=this._sortBy(e.data,"likes.count",p);break;case"commented":e.data=this._sortBy(e.data,"comments.count",p);break;default:throw new Error("Invalid option for sortBy: '"+this.options.sortBy+"'.")}}if(typeof document!="undefined"&&document!==null&&this.options.mock===!1){a=e.data,this.options.limit!=null&&a.length>this.options.limit&&(a=a.slice(0,this.options.limit+1||9e9)),n=document.createDocumentFragment(),this.options.filter!=null&&typeof this.options.filter=="function"&&(a=this._filter(a,this.options.filter));if(this.options.template!=null&&typeof this.options.template=="string"){i="",o="",l="",v=document.createElement("div");for(m=0,b=a.length;m<b;m++)s=a[m],u=s.images[this.options.resolution].url,this.options.useHttp||(u=u.replace("http://","//")),o=this._makeTemplate(this.options.template,{model:s,id:s.id,link:s.link,image:u,caption:this._getObjectProperty(s,"caption.text"),likes:s.likes.count,comments:s.comments.count,location:this._getObjectProperty(s,"location.name")}),i+=o;v.innerHTML=i,S=[].slice.call(v.childNodes);for(g=0,w=S.length;g<w;g++)h=S[g],n.appendChild(h)}else for(y=0,E=a.length;y<E;y++)s=a[y],f=document.createElement("img"),u=s.images[this.options.resolution].url,this.options.useHttp||(u=u.replace("http://","//")),f.src=u,this.options.links===!0?(t=document.createElement("a"),t.href=s.link,t.appendChild(f),n.appendChild(t)):n.appendChild(f);document.getElementById(this.options.target).appendChild(n),r=document.getElementsByTagName("head")[0],r.removeChild(document.getElementById("instafeed-fetcher")),c="instafeedCache"+this.unique,window[c]=void 0;try{delete window[c]}catch(x){}}return this.options.after!=null&&typeof this.options.after=="function"&&this.options.after.call(this),!0},e.prototype._buildUrl=function(){var e,t,n;e="https://api.instagram.com/v1";switch(this.options.get){case"popular":t="media/popular";break;case"tagged":if(typeof this.options.tagName!="string")throw new Error("No tag name specified. Use the 'tagName' option.");t="tags/"+this.options.tagName+"/media/recent";break;case"location":if(typeof this.options.locationId!="number")throw new Error("No location specified. Use the 'locationId' option.");t="locations/"+this.options.locationId+"/media/recent";break;case"user":if(typeof this.options.userId!="number")throw new Error("No user specified. Use the 'userId' option.");if(typeof this.options.accessToken!="string")throw new Error("No access token. Use the 'accessToken' option.");t="users/"+this.options.userId+"/media/recent";break;default:throw new Error("Invalid option for get: '"+this.options.get+"'.")}return n=""+e+"/"+t,this.options.accessToken!=null?n+="?access_token="+this.options.accessToken:n+="?client_id="+this.options.clientId,this.options.limit!=null&&(n+="&count="+this.options.limit),n+="&callback=instafeedCache"+this.unique+".parse",n},e.prototype._genKey=function(){var e;return e=function(){return((1+Math.random())*65536|0).toString(16).substring(1)},""+e()+e()+e()+e()},e.prototype._makeTemplate=function(e,t){var n,r,i,s,o;r=/(?:\{{2})([\w\[\]\.]+)(?:\}{2})/,n=e;while(r.test(n))i=n.match(r)[1],s=(o=this._getObjectProperty(t,i))!=null?o:"",n=n.replace(r,""+s);return n},e.prototype._getObjectProperty=function(e,t){var n,r;t=t.replace(/\[(\w+)\]/g,".$1"),r=t.split(".");while(r.length){n=r.shift();if(!(e!=null&&n in e))return null;e=e[n]}return e},e.prototype._sortBy=function(e,t,n){var r;return r=function(e,r){var i,s;return i=this._getObjectProperty(e,t),s=this._getObjectProperty(r,t),n?i>s?1:-1:i<s?1:-1},e.sort(r.bind(this)),e},e.prototype._filter=function(e,t){var n,r,i,s,o;n=[],i=function(e){if(t(e))return n.push(e)};for(s=0,o=e.length;s<o;s++)r=e[s],i(r);return n},e}(),t=typeof exports!="undefined"&&exports!==null?exports:window,t.Instafeed=e}).call(this);


/* ------------------------------------------------------------------------
    Class: prettyPhoto
    Use: Lightbox clone for jQuery
    Author: Stephane Caron (http://www.no-margin-for-errors.com)
    Version: 3.1.6
------------------------------------------------------------------------- */
!function(e){function t(){var e=location.href;return hashtag=-1!==e.indexOf("#prettyPhoto")?decodeURI(e.substring(e.indexOf("#prettyPhoto")+1,e.length)):!1,hashtag&&(hashtag=hashtag.replace(/<|>/g,"")),hashtag}function i(){"undefined"!=typeof theRel&&(location.hash=theRel+"/"+rel_index+"/")}function p(){-1!==location.href.indexOf("#prettyPhoto")&&(location.hash="prettyPhoto")}function o(e,t){e=e.replace(/[\[]/,"\\[").replace(/[\]]/,"\\]");var i="[\\?&]"+e+"=([^&#]*)",p=new RegExp(i),o=p.exec(t);return null==o?"":o[1]}e.prettyPhoto={version:"3.1.6"},e.fn.prettyPhoto=function(a){function s(){e(".pp_loaderIcon").hide(),projectedTop=scroll_pos.scrollTop+(I/2-f.containerHeight/2),projectedTop<0&&(projectedTop=0),$ppt.fadeTo(settings.animation_speed,1),$pp_pic_holder.find(".pp_content").animate({height:f.contentHeight,width:f.contentWidth},settings.animation_speed),$pp_pic_holder.animate({top:projectedTop,left:j/2-f.containerWidth/2<0?0:j/2-f.containerWidth/2,width:f.containerWidth},settings.animation_speed,function(){$pp_pic_holder.find(".pp_hoverContainer,#fullResImage").height(f.height).width(f.width),$pp_pic_holder.find(".pp_fade").fadeIn(settings.animation_speed),isSet&&"image"==h(pp_images[set_position])?$pp_pic_holder.find(".pp_hoverContainer").show():$pp_pic_holder.find(".pp_hoverContainer").hide(),settings.allow_expand&&(f.resized?e("a.pp_expand,a.pp_contract").show():e("a.pp_expand").hide()),!settings.autoplay_slideshow||P||v||e.prettyPhoto.startSlideshow(),settings.changepicturecallback(),v=!0}),m(),a.ajaxcallback()}function n(t){$pp_pic_holder.find("#pp_full_res object,#pp_full_res embed").css("visibility","hidden"),$pp_pic_holder.find(".pp_fade").fadeOut(settings.animation_speed,function(){e(".pp_loaderIcon").show(),t()})}function r(t){t>1?e(".pp_nav").show():e(".pp_nav").hide()}function l(e,t){if(resized=!1,d(e,t),imageWidth=e,imageHeight=t,(k>j||b>I)&&doresize&&settings.allow_resize&&!$){for(resized=!0,fitting=!1;!fitting;)k>j?(imageWidth=j-200,imageHeight=t/e*imageWidth):b>I?(imageHeight=I-200,imageWidth=e/t*imageHeight):fitting=!0,b=imageHeight,k=imageWidth;(k>j||b>I)&&l(k,b),d(imageWidth,imageHeight)}return{width:Math.floor(imageWidth),height:Math.floor(imageHeight),containerHeight:Math.floor(b),containerWidth:Math.floor(k)+2*settings.horizontal_padding,contentHeight:Math.floor(y),contentWidth:Math.floor(w),resized:resized}}function d(t,i){t=parseFloat(t),i=parseFloat(i),$pp_details=$pp_pic_holder.find(".pp_details"),$pp_details.width(t),detailsHeight=parseFloat($pp_details.css("marginTop"))+parseFloat($pp_details.css("marginBottom")),$pp_details=$pp_details.clone().addClass(settings.theme).width(t).appendTo(e("body")).css({position:"absolute",top:-1e4}),detailsHeight+=$pp_details.height(),detailsHeight=detailsHeight<=34?36:detailsHeight,$pp_details.remove(),$pp_title=$pp_pic_holder.find(".ppt"),$pp_title.width(t),titleHeight=parseFloat($pp_title.css("marginTop"))+parseFloat($pp_title.css("marginBottom")),$pp_title=$pp_title.clone().appendTo(e("body")).css({position:"absolute",top:-1e4}),titleHeight+=$pp_title.height(),$pp_title.remove(),y=i+detailsHeight,w=t,b=y+titleHeight+$pp_pic_holder.find(".pp_top").height()+$pp_pic_holder.find(".pp_bottom").height(),k=t}function h(e){return e.match(/youtube\.com\/watch/i)||e.match(/youtu\.be/i)?"youtube":e.match(/vimeo\.com/i)?"vimeo":e.match(/\b.mov\b/i)?"quicktime":e.match(/\b.swf\b/i)?"flash":e.match(/\biframe=true\b/i)?"iframe":e.match(/\bajax=true\b/i)?"ajax":e.match(/\bcustom=true\b/i)?"custom":"#"==e.substr(0,1)?"inline":"image"}function c(){if(doresize&&"undefined"!=typeof $pp_pic_holder){if(scroll_pos=_(),contentHeight=$pp_pic_holder.height(),contentwidth=$pp_pic_holder.width(),projectedTop=I/2+scroll_pos.scrollTop-contentHeight/2,projectedTop<0&&(projectedTop=0),contentHeight>I)return;$pp_pic_holder.css({top:projectedTop,left:j/2+scroll_pos.scrollLeft-contentwidth/2})}}function _(){return self.pageYOffset?{scrollTop:self.pageYOffset,scrollLeft:self.pageXOffset}:document.documentElement&&document.documentElement.scrollTop?{scrollTop:document.documentElement.scrollTop,scrollLeft:document.documentElement.scrollLeft}:document.body?{scrollTop:document.body.scrollTop,scrollLeft:document.body.scrollLeft}:void 0}function g(){I=e(window).height(),j=e(window).width(),"undefined"!=typeof $pp_overlay&&$pp_overlay.height(e(document).height()).width(j)}function m(){isSet&&settings.overlay_gallery&&"image"==h(pp_images[set_position])?(itemWidth=57,navWidth="facebook"==settings.theme||"pp_default"==settings.theme?50:30,itemsPerPage=Math.floor((f.containerWidth-100-navWidth)/itemWidth),itemsPerPage=itemsPerPage<pp_images.length?itemsPerPage:pp_images.length,totalPage=Math.ceil(pp_images.length/itemsPerPage)-1,0==totalPage?(navWidth=0,$pp_gallery.find(".pp_arrow_next,.pp_arrow_previous").hide()):$pp_gallery.find(".pp_arrow_next,.pp_arrow_previous").show(),galleryWidth=itemsPerPage*itemWidth,fullGalleryWidth=pp_images.length*itemWidth,$pp_gallery.css("margin-left",-(galleryWidth/2+navWidth/2)).find("div:first").width(galleryWidth+5).find("ul").width(fullGalleryWidth).find("li.selected").removeClass("selected"),goToPage=Math.floor(set_position/itemsPerPage)<totalPage?Math.floor(set_position/itemsPerPage):totalPage,e.prettyPhoto.changeGalleryPage(goToPage),$pp_gallery_li.filter(":eq("+set_position+")").addClass("selected")):$pp_pic_holder.find(".pp_content").unbind("mouseenter mouseleave")}function u(){if(settings.social_tools&&(facebook_like_link=settings.social_tools.replace("{location_href}",encodeURIComponent(location.href))),settings.markup=settings.markup.replace("{pp_social}",""),e("body").append(settings.markup),$pp_pic_holder=e(".pp_pic_holder"),$ppt=e(".ppt"),$pp_overlay=e("div.pp_overlay"),isSet&&settings.overlay_gallery){currentGalleryPage=0,toInject="";for(var t=0;t<pp_images.length;t++)pp_images[t].match(/\b(jpg|jpeg|png|gif)\b/gi)?(classname="",img_src=pp_images[t]):(classname="default",img_src=""),toInject+="<li class='"+classname+"'><a href='#'><img src='"+img_src+"' width='50' alt='' /></a></li>";toInject=settings.gallery_markup.replace(/{gallery}/g,toInject),$pp_pic_holder.find("#pp_full_res").after(toInject),$pp_gallery=e(".pp_pic_holder .pp_gallery"),$pp_gallery_li=$pp_gallery.find("li"),$pp_gallery.find(".pp_arrow_next").click(function(){return e.prettyPhoto.changeGalleryPage("next"),e.prettyPhoto.stopSlideshow(),!1}),$pp_gallery.find(".pp_arrow_previous").click(function(){return e.prettyPhoto.changeGalleryPage("previous"),e.prettyPhoto.stopSlideshow(),!1}),$pp_pic_holder.find(".pp_content").hover(function(){$pp_pic_holder.find(".pp_gallery:not(.disabled)").fadeIn()},function(){$pp_pic_holder.find(".pp_gallery:not(.disabled)").fadeOut()}),itemWidth=57,$pp_gallery_li.each(function(t){e(this).find("a").click(function(){return e.prettyPhoto.changePage(t),e.prettyPhoto.stopSlideshow(),!1})})}settings.slideshow&&($pp_pic_holder.find(".pp_nav").prepend('<a href="#" class="pp_play">Play</a>'),$pp_pic_holder.find(".pp_nav .pp_play").click(function(){return e.prettyPhoto.startSlideshow(),!1})),$pp_pic_holder.attr("class","pp_pic_holder "+settings.theme),$pp_overlay.css({opacity:0,height:e(document).height(),width:e(window).width()}).bind("click",function(){settings.modal||e.prettyPhoto.close()}),e("a.pp_close").bind("click",function(){return e.prettyPhoto.close(),!1}),settings.allow_expand&&e("a.pp_expand").bind("click",function(){return e(this).hasClass("pp_expand")?(e(this).removeClass("pp_expand").addClass("pp_contract"),doresize=!1):(e(this).removeClass("pp_contract").addClass("pp_expand"),doresize=!0),n(function(){e.prettyPhoto.open()}),!1}),$pp_pic_holder.find(".pp_previous, .pp_nav .pp_arrow_previous").bind("click",function(){return e.prettyPhoto.changePage("previous"),e.prettyPhoto.stopSlideshow(),!1}),$pp_pic_holder.find(".pp_next, .pp_nav .pp_arrow_next").bind("click",function(){return e.prettyPhoto.changePage("next"),e.prettyPhoto.stopSlideshow(),!1}),c()}a=jQuery.extend({hook:"rel",animation_speed:"fast",ajaxcallback:function(){},slideshow:5e3,autoplay_slideshow:!1,opacity:.8,show_title:!0,allow_resize:!0,allow_expand:!0,default_width:500,default_height:344,counter_separator_label:"/",theme:"pp_default",horizontal_padding:20,hideflash:!1,wmode:"opaque",autoplay:!0,modal:!1,deeplinking:!0,overlay_gallery:!0,overlay_gallery_max:30,keyboard_shortcuts:!0,changepicturecallback:function(){},callback:function(){},ie6_fallback:!0,markup:'<div class="pp_pic_holder">                        <div class="ppt">&nbsp;</div>                       <div class="pp_top">                            <div class="pp_left"></div>                             <div class="pp_middle"></div>                           <div class="pp_right"></div>                        </div>                      <div class="pp_content_container">                          <div class="pp_left">                           <div class="pp_right">                              <div class="pp_content">                                    <div class="pp_loaderIcon"></div>                                   <div class="pp_fade">                                       <a href="#" class="pp_expand" title="Expand the image">Expand</a>                                       <div class="pp_hoverContainer">                                             <a class="pp_next" href="#">next</a>                                            <a class="pp_previous" href="#">previous</a>                                        </div>                                      <div id="pp_full_res"></div>                                        <div class="pp_details">                                            <div class="pp_nav">                                                <a href="#" class="pp_arrow_previous">Previous</a>                                              <p class="currentTextHolder">0/0</p>                                                <a href="#" class="pp_arrow_next">Next</a>                                          </div>                                          <p class="pp_description"></p>                                          <div class="pp_social">{pp_social}</div>                                            <a class="pp_close" href="#">Close</a>                                      </div>                                  </div>                              </div>                          </div>                          </div>                      </div>                      <div class="pp_bottom">                             <div class="pp_left"></div>                             <div class="pp_middle"></div>                           <div class="pp_right"></div>                        </div>                  </div>                  <div class="pp_overlay"></div>',gallery_markup:'<div class="pp_gallery">                                <a href="#" class="pp_arrow_previous">Previous</a>                              <div>                                   <ul>                                        {gallery}                                   </ul>                               </div>                              <a href="#" class="pp_arrow_next">Next</a>                          </div>',image_markup:'<img id="fullResImage" src="{path}" />',flash_markup:'<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="{width}" height="{height}"><param name="wmode" value="{wmode}" /><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="{path}" /><embed src="{path}" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="{width}" height="{height}" wmode="{wmode}"></embed></object>',quicktime_markup:'<object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab" height="{height}" width="{width}"><param name="src" value="{path}"><param name="autoplay" value="{autoplay}"><param name="type" value="video/quicktime"><embed src="{path}" height="{height}" width="{width}" autoplay="{autoplay}" type="video/quicktime" pluginspage="http://www.apple.com/quicktime/download/"></embed></object>',iframe_markup:'<iframe src ="{path}" width="{width}" height="{height}" frameborder="no"></iframe>',inline_markup:'<div class="pp_inline">{content}</div>',custom_markup:"",social_tools:'<div class="twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div><div class="facebook"><iframe src="//www.facebook.com/plugins/like.php?locale=en_US&href={location_href}&layout=button_count&show_faces=true&width=500&action=like&font&colorscheme=light&height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:500px; height:23px;" allowTransparency="true"></iframe></div>'},a);var f,v,y,w,b,k,P,x=this,$=!1,I=e(window).height(),j=e(window).width();return doresize=!0,scroll_pos=_(),e(window).unbind("resize.prettyphoto").bind("resize.prettyphoto",function(){c(),g()}),a.keyboard_shortcuts&&e(document).unbind("keydown.prettyphoto").bind("keydown.prettyphoto",function(t){if("undefined"!=typeof $pp_pic_holder&&$pp_pic_holder.is(":visible"))switch(t.keyCode){case 37:e.prettyPhoto.changePage("previous"),t.preventDefault();break;case 39:e.prettyPhoto.changePage("next"),t.preventDefault();break;case 27:settings.modal||e.prettyPhoto.close(),t.preventDefault()}}),e.prettyPhoto.initialize=function(){return settings=a,"pp_default"==settings.theme&&(settings.horizontal_padding=16),theRel=e(this).attr(settings.hook),galleryRegExp=/\[(?:.*)\]/,isSet=galleryRegExp.exec(theRel)?!0:!1,pp_images=isSet?jQuery.map(x,function(t){return-1!=e(t).attr(settings.hook).indexOf(theRel)?e(t).attr("href"):void 0}):e.makeArray(e(this).attr("href")),pp_titles=isSet?jQuery.map(x,function(t){return-1!=e(t).attr(settings.hook).indexOf(theRel)?e(t).find("img").attr("alt")?e(t).find("img").attr("alt"):"":void 0}):e.makeArray(e(this).find("img").attr("alt")),pp_descriptions=isSet?jQuery.map(x,function(t){return-1!=e(t).attr(settings.hook).indexOf(theRel)?e(t).attr("title")?e(t).attr("title"):"":void 0}):e.makeArray(e(this).attr("title")),pp_images.length>settings.overlay_gallery_max&&(settings.overlay_gallery=!1),set_position=jQuery.inArray(e(this).attr("href"),pp_images),rel_index=isSet?set_position:e("a["+settings.hook+"^='"+theRel+"']").index(e(this)),u(this),settings.allow_resize&&e(window).bind("scroll.prettyphoto",function(){c()}),e.prettyPhoto.open(),!1},e.prettyPhoto.open=function(t){return"undefined"==typeof settings&&(settings=a,pp_images=e.makeArray(arguments[0]),pp_titles=e.makeArray(arguments[1]?arguments[1]:""),pp_descriptions=e.makeArray(arguments[2]?arguments[2]:""),isSet=pp_images.length>1?!0:!1,set_position=arguments[3]?arguments[3]:0,u(t.target)),settings.hideflash&&e("object,embed,iframe[src*=youtube],iframe[src*=vimeo]").css("visibility","hidden"),r(e(pp_images).size()),e(".pp_loaderIcon").show(),settings.deeplinking&&i(),settings.social_tools&&(facebook_like_link=settings.social_tools.replace("{location_href}",encodeURIComponent(location.href)),$pp_pic_holder.find(".pp_social").html(facebook_like_link)),$ppt.is(":hidden")&&$ppt.css("opacity",0).show(),$pp_overlay.show().fadeTo(settings.animation_speed,settings.opacity),$pp_pic_holder.find(".currentTextHolder").text(set_position+1+settings.counter_separator_label+e(pp_images).size()),"undefined"!=typeof pp_descriptions[set_position]&&""!=pp_descriptions[set_position]?$pp_pic_holder.find(".pp_description").show().html(unescape(pp_descriptions[set_position])):$pp_pic_holder.find(".pp_description").hide(),movie_width=parseFloat(o("width",pp_images[set_position]))?o("width",pp_images[set_position]):settings.default_width.toString(),movie_height=parseFloat(o("height",pp_images[set_position]))?o("height",pp_images[set_position]):settings.default_height.toString(),$=!1,-1!=movie_height.indexOf("%")&&(movie_height=parseFloat(e(window).height()*parseFloat(movie_height)/100-150),$=!0),-1!=movie_width.indexOf("%")&&(movie_width=parseFloat(e(window).width()*parseFloat(movie_width)/100-150),$=!0),$pp_pic_holder.fadeIn(function(){switch($ppt.html(settings.show_title&&""!=pp_titles[set_position]&&"undefined"!=typeof pp_titles[set_position]?unescape(pp_titles[set_position]):"&nbsp;"),imgPreloader="",skipInjection=!1,h(pp_images[set_position])){case"image":imgPreloader=new Image,nextImage=new Image,isSet&&set_position<e(pp_images).size()-1&&(nextImage.src=pp_images[set_position+1]),prevImage=new Image,isSet&&pp_images[set_position-1]&&(prevImage.src=pp_images[set_position-1]),$pp_pic_holder.find("#pp_full_res")[0].innerHTML=settings.image_markup.replace(/{path}/g,pp_images[set_position]),imgPreloader.onload=function(){f=l(imgPreloader.width,imgPreloader.height),s()},imgPreloader.onerror=function(){alert("Image cannot be loaded. Make sure the path is correct and image exist."),e.prettyPhoto.close()},imgPreloader.src=pp_images[set_position];break;case"youtube":f=l(movie_width,movie_height),movie_id=o("v",pp_images[set_position]),""==movie_id&&(movie_id=pp_images[set_position].split("youtu.be/"),movie_id=movie_id[1],movie_id.indexOf("?")>0&&(movie_id=movie_id.substr(0,movie_id.indexOf("?"))),movie_id.indexOf("&")>0&&(movie_id=movie_id.substr(0,movie_id.indexOf("&")))),movie="http://www.youtube.com/embed/"+movie_id,movie+=o("rel",pp_images[set_position])?"?rel="+o("rel",pp_images[set_position]):"?rel=1",settings.autoplay&&(movie+="&autoplay=1"),toInject=settings.iframe_markup.replace(/{width}/g,f.width).replace(/{height}/g,f.height).replace(/{wmode}/g,settings.wmode).replace(/{path}/g,movie);break;case"vimeo":f=l(movie_width,movie_height),movie_id=pp_images[set_position];var t=/http(s?):\/\/(www\.)?vimeo.com\/(\d+)/,i=movie_id.match(t);movie="http://player.vimeo.com/video/"+i[3]+"?title=0&byline=0&portrait=0",settings.autoplay&&(movie+="&autoplay=1;"),vimeo_width=f.width+"/embed/?moog_width="+f.width,toInject=settings.iframe_markup.replace(/{width}/g,vimeo_width).replace(/{height}/g,f.height).replace(/{path}/g,movie);break;case"quicktime":f=l(movie_width,movie_height),f.height+=15,f.contentHeight+=15,f.containerHeight+=15,toInject=settings.quicktime_markup.replace(/{width}/g,f.width).replace(/{height}/g,f.height).replace(/{wmode}/g,settings.wmode).replace(/{path}/g,pp_images[set_position]).replace(/{autoplay}/g,settings.autoplay);break;case"flash":f=l(movie_width,movie_height),flash_vars=pp_images[set_position],flash_vars=flash_vars.substring(pp_images[set_position].indexOf("flashvars")+10,pp_images[set_position].length),filename=pp_images[set_position],filename=filename.substring(0,filename.indexOf("?")),toInject=settings.flash_markup.replace(/{width}/g,f.width).replace(/{height}/g,f.height).replace(/{wmode}/g,settings.wmode).replace(/{path}/g,filename+"?"+flash_vars);break;case"iframe":f=l(movie_width,movie_height),frame_url=pp_images[set_position],frame_url=frame_url.substr(0,frame_url.indexOf("iframe")-1),toInject=settings.iframe_markup.replace(/{width}/g,f.width).replace(/{height}/g,f.height).replace(/{path}/g,frame_url);break;case"ajax":doresize=!1,f=l(movie_width,movie_height),doresize=!0,skipInjection=!0,e.get(pp_images[set_position],function(e){toInject=settings.inline_markup.replace(/{content}/g,e),$pp_pic_holder.find("#pp_full_res")[0].innerHTML=toInject,s()});break;case"custom":f=l(movie_width,movie_height),toInject=settings.custom_markup;break;case"inline":myClone=e(pp_images[set_position]).clone().append('<br clear="all" />').css({width:settings.default_width}).wrapInner('<div id="pp_full_res"><div class="pp_inline"></div></div>').appendTo(e("body")).show(),doresize=!1,f=l(e(myClone).width(),e(myClone).height()),doresize=!0,e(myClone).remove(),toInject=settings.inline_markup.replace(/{content}/g,e(pp_images[set_position]).html())}imgPreloader||skipInjection||($pp_pic_holder.find("#pp_full_res")[0].innerHTML=toInject,s())}),!1},e.prettyPhoto.changePage=function(t){currentGalleryPage=0,"previous"==t?(set_position--,set_position<0&&(set_position=e(pp_images).size()-1)):"next"==t?(set_position++,set_position>e(pp_images).size()-1&&(set_position=0)):set_position=t,rel_index=set_position,doresize||(doresize=!0),settings.allow_expand&&e(".pp_contract").removeClass("pp_contract").addClass("pp_expand"),n(function(){e.prettyPhoto.open()})},e.prettyPhoto.changeGalleryPage=function(e){"next"==e?(currentGalleryPage++,currentGalleryPage>totalPage&&(currentGalleryPage=0)):"previous"==e?(currentGalleryPage--,currentGalleryPage<0&&(currentGalleryPage=totalPage)):currentGalleryPage=e,slide_speed="next"==e||"previous"==e?settings.animation_speed:0,slide_to=currentGalleryPage*itemsPerPage*itemWidth,$pp_gallery.find("ul").animate({left:-slide_to},slide_speed)},e.prettyPhoto.startSlideshow=function(){"undefined"==typeof P?($pp_pic_holder.find(".pp_play").unbind("click").removeClass("pp_play").addClass("pp_pause").click(function(){return e.prettyPhoto.stopSlideshow(),!1}),P=setInterval(e.prettyPhoto.startSlideshow,settings.slideshow)):e.prettyPhoto.changePage("next")},e.prettyPhoto.stopSlideshow=function(){$pp_pic_holder.find(".pp_pause").unbind("click").removeClass("pp_pause").addClass("pp_play").click(function(){return e.prettyPhoto.startSlideshow(),!1}),clearInterval(P),P=void 0},e.prettyPhoto.close=function(){$pp_overlay.is(":animated")||(e.prettyPhoto.stopSlideshow(),$pp_pic_holder.stop().find("object,embed").css("visibility","hidden"),e("div.pp_pic_holder,div.ppt,.pp_fade").fadeOut(settings.animation_speed,function(){e(this).remove()}),$pp_overlay.fadeOut(settings.animation_speed,function(){settings.hideflash&&e("object,embed,iframe[src*=youtube],iframe[src*=vimeo]").css("visibility","visible"),e(this).remove(),e(window).unbind("scroll.prettyphoto"),p(),settings.callback(),doresize=!0,v=!1,delete settings}))},!pp_alreadyInitialized&&t()&&(pp_alreadyInitialized=!0,hashIndex=t(),hashRel=hashIndex,hashIndex=hashIndex.substring(hashIndex.indexOf("/")+1,hashIndex.length-1),hashRel=hashRel.substring(0,hashRel.indexOf("/")),setTimeout(function(){e("a["+a.hook+"^='"+hashRel+"']:eq("+hashIndex+")").trigger("click")},50)),this.unbind("click.prettyphoto").bind("click.prettyphoto",e.prettyPhoto.initialize)}}(jQuery);var pp_alreadyInitialized=!1;


/**
 * @preserve FastClick: polyfill to remove click delays on browsers with touch UIs.
 *
 * @version 1.0.3
 * @codingstandard ftlabs-jsv2
 * @copyright The Financial Times Limited [All Rights Reserved]
 * @license MIT License (see LICENSE.txt)
 */

/*jslint browser:true, node:true*/
/*global define, Event, Node*/


/**
 * Instantiate fast-clicking listeners on the specified layer.
 *
 * @constructor
 * @param {Element} layer The layer to listen on
 * @param {Object} options The options to override the defaults
 */
function FastClick(layer, options) {
    'use strict';
    var oldOnClick;

    options = options || {};

    /**
     * Whether a click is currently being tracked.
     *
     * @type boolean
     */
    this.trackingClick = false;


    /**
     * Timestamp for when click tracking started.
     *
     * @type number
     */
    this.trackingClickStart = 0;


    /**
     * The element being tracked for a click.
     *
     * @type EventTarget
     */
    this.targetElement = null;


    /**
     * X-coordinate of touch start event.
     *
     * @type number
     */
    this.touchStartX = 0;


    /**
     * Y-coordinate of touch start event.
     *
     * @type number
     */
    this.touchStartY = 0;


    /**
     * ID of the last touch, retrieved from Touch.identifier.
     *
     * @type number
     */
    this.lastTouchIdentifier = 0;


    /**
     * Touchmove boundary, beyond which a click will be cancelled.
     *
     * @type number
     */
    this.touchBoundary = options.touchBoundary || 10;


    /**
     * The FastClick layer.
     *
     * @type Element
     */
    this.layer = layer;

    /**
     * The minimum time between tap(touchstart and touchend) events
     *
     * @type number
     */
    this.tapDelay = options.tapDelay || 200;

    if (FastClick.notNeeded(layer)) {
        return;
    }

    // Some old versions of Android don't have Function.prototype.bind
    function bind(method, context) {
        return function() { return method.apply(context, arguments); };
    }


    var methods = ['onMouse', 'onClick', 'onTouchStart', 'onTouchMove', 'onTouchEnd', 'onTouchCancel'];
    var context = this;
    for (var i = 0, l = methods.length; i < l; i++) {
        context[methods[i]] = bind(context[methods[i]], context);
    }

    // Set up event handlers as required
    if (deviceIsAndroid) {
        layer.addEventListener('mouseover', this.onMouse, true);
        layer.addEventListener('mousedown', this.onMouse, true);
        layer.addEventListener('mouseup', this.onMouse, true);
    }

    layer.addEventListener('click', this.onClick, true);
    layer.addEventListener('touchstart', this.onTouchStart, false);
    layer.addEventListener('touchmove', this.onTouchMove, false);
    layer.addEventListener('touchend', this.onTouchEnd, false);
    layer.addEventListener('touchcancel', this.onTouchCancel, false);

    // Hack is required for browsers that don't support Event#stopImmediatePropagation (e.g. Android 2)
    // which is how FastClick normally stops click events bubbling to callbacks registered on the FastClick
    // layer when they are cancelled.
    if (!Event.prototype.stopImmediatePropagation) {
        layer.removeEventListener = function(type, callback, capture) {
            var rmv = Node.prototype.removeEventListener;
            if (type === 'click') {
                rmv.call(layer, type, callback.hijacked || callback, capture);
            } else {
                rmv.call(layer, type, callback, capture);
            }
        };

        layer.addEventListener = function(type, callback, capture) {
            var adv = Node.prototype.addEventListener;
            if (type === 'click') {
                adv.call(layer, type, callback.hijacked || (callback.hijacked = function(event) {
                    if (!event.propagationStopped) {
                        callback(event);
                    }
                }), capture);
            } else {
                adv.call(layer, type, callback, capture);
            }
        };
    }

    // If a handler is already declared in the element's onclick attribute, it will be fired before
    // FastClick's onClick handler. Fix this by pulling out the user-defined handler function and
    // adding it as listener.
    if (typeof layer.onclick === 'function') {

        // Android browser on at least 3.2 requires a new reference to the function in layer.onclick
        // - the old one won't work if passed to addEventListener directly.
        oldOnClick = layer.onclick;
        layer.addEventListener('click', function(event) {
            oldOnClick(event);
        }, false);
        layer.onclick = null;
    }
}


/**
 * Android requires exceptions.
 *
 * @type boolean
 */
var deviceIsAndroid = navigator.userAgent.indexOf('Android') > 0;


/**
 * iOS requires exceptions.
 *
 * @type boolean
 */
var deviceIsIOS = /iP(ad|hone|od)/.test(navigator.userAgent);


/**
 * iOS 4 requires an exception for select elements.
 *
 * @type boolean
 */
var deviceIsIOS4 = deviceIsIOS && (/OS 4_\d(_\d)?/).test(navigator.userAgent);


/**
 * iOS 6.0(+?) requires the target element to be manually derived
 *
 * @type boolean
 */
var deviceIsIOSWithBadTarget = deviceIsIOS && (/OS ([6-9]|\d{2})_\d/).test(navigator.userAgent);

/**
 * BlackBerry requires exceptions.
 *
 * @type boolean
 */
var deviceIsBlackBerry10 = navigator.userAgent.indexOf('BB10') > 0;

/**
 * Determine whether a given element requires a native click.
 *
 * @param {EventTarget|Element} target Target DOM element
 * @returns {boolean} Returns true if the element needs a native click
 */
FastClick.prototype.needsClick = function(target) {
    'use strict';
    switch (target.nodeName.toLowerCase()) {

    // Don't send a synthetic click to disabled inputs (issue #62)
    case 'button':
    case 'select':
    case 'textarea':
        if (target.disabled) {
            return true;
        }

        break;
    case 'input':

        // File inputs need real clicks on iOS 6 due to a browser bug (issue #68)
        if ((deviceIsIOS && target.type === 'file') || target.disabled) {
            return true;
        }

        break;
    case 'label':
    case 'video':
        return true;
    }

    return (/\bneedsclick\b/).test(target.className);
};


/**
 * Determine whether a given element requires a call to focus to simulate click into element.
 *
 * @param {EventTarget|Element} target Target DOM element
 * @returns {boolean} Returns true if the element requires a call to focus to simulate native click.
 */
FastClick.prototype.needsFocus = function(target) {
    'use strict';
    switch (target.nodeName.toLowerCase()) {
    case 'textarea':
        return true;
    case 'select':
        return !deviceIsAndroid;
    case 'input':
        switch (target.type) {
        case 'button':
        case 'checkbox':
        case 'file':
        case 'image':
        case 'radio':
        case 'submit':
            return false;
        }

        // No point in attempting to focus disabled inputs
        return !target.disabled && !target.readOnly;
    default:
        return (/\bneedsfocus\b/).test(target.className);
    }
};


/**
 * Send a click event to the specified element.
 *
 * @param {EventTarget|Element} targetElement
 * @param {Event} event
 */
FastClick.prototype.sendClick = function(targetElement, event) {
    'use strict';
    var clickEvent, touch;

    // On some Android devices activeElement needs to be blurred otherwise the synthetic click will have no effect (#24)
    if (document.activeElement && document.activeElement !== targetElement) {
        document.activeElement.blur();
    }

    touch = event.changedTouches[0];

    // Synthesise a click event, with an extra attribute so it can be tracked
    clickEvent = document.createEvent('MouseEvents');
    clickEvent.initMouseEvent(this.determineEventType(targetElement), true, true, window, 1, touch.screenX, touch.screenY, touch.clientX, touch.clientY, false, false, false, false, 0, null);
    clickEvent.forwardedTouchEvent = true;
    targetElement.dispatchEvent(clickEvent);
};

FastClick.prototype.determineEventType = function(targetElement) {
    'use strict';

    //Issue #159: Android Chrome Select Box does not open with a synthetic click event
    if (deviceIsAndroid && targetElement.tagName.toLowerCase() === 'select') {
        return 'mousedown';
    }

    return 'click';
};


/**
 * @param {EventTarget|Element} targetElement
 */
FastClick.prototype.focus = function(targetElement) {
    'use strict';
    var length;

    // Issue #160: on iOS 7, some input elements (e.g. date datetime) throw a vague TypeError on setSelectionRange. These elements don't have an integer value for the selectionStart and selectionEnd properties, but unfortunately that can't be used for detection because accessing the properties also throws a TypeError. Just check the type instead. Filed as Apple bug #15122724.
    if (deviceIsIOS && targetElement.setSelectionRange && targetElement.type.indexOf('date') !== 0 && targetElement.type !== 'time') {
        length = targetElement.value.length;
        targetElement.setSelectionRange(length, length);
    } else {
        targetElement.focus();
    }
};


/**
 * Check whether the given target element is a child of a scrollable layer and if so, set a flag on it.
 *
 * @param {EventTarget|Element} targetElement
 */
FastClick.prototype.updateScrollParent = function(targetElement) {
    'use strict';
    var scrollParent, parentElement;

    scrollParent = targetElement.fastClickScrollParent;

    // Attempt to discover whether the target element is contained within a scrollable layer. Re-check if the
    // target element was moved to another parent.
    if (!scrollParent || !scrollParent.contains(targetElement)) {
        parentElement = targetElement;
        do {
            if (parentElement.scrollHeight > parentElement.offsetHeight) {
                scrollParent = parentElement;
                targetElement.fastClickScrollParent = parentElement;
                break;
            }

            parentElement = parentElement.parentElement;
        } while (parentElement);
    }

    // Always update the scroll top tracker if possible.
    if (scrollParent) {
        scrollParent.fastClickLastScrollTop = scrollParent.scrollTop;
    }
};


/**
 * @param {EventTarget} targetElement
 * @returns {Element|EventTarget}
 */
FastClick.prototype.getTargetElementFromEventTarget = function(eventTarget) {
    'use strict';

    // On some older browsers (notably Safari on iOS 4.1 - see issue #56) the event target may be a text node.
    if (eventTarget.nodeType === Node.TEXT_NODE) {
        return eventTarget.parentNode;
    }

    return eventTarget;
};


/**
 * On touch start, record the position and scroll offset.
 *
 * @param {Event} event
 * @returns {boolean}
 */
FastClick.prototype.onTouchStart = function(event) {
    'use strict';
    var targetElement, touch, selection;

    // Ignore multiple touches, otherwise pinch-to-zoom is prevented if both fingers are on the FastClick element (issue #111).
    if (event.targetTouches.length > 1) {
        return true;
    }

    targetElement = this.getTargetElementFromEventTarget(event.target);
    touch = event.targetTouches[0];

    if (deviceIsIOS) {

        // Only trusted events will deselect text on iOS (issue #49)
        selection = window.getSelection();
        if (selection.rangeCount && !selection.isCollapsed) {
            return true;
        }

        if (!deviceIsIOS4) {

            // Weird things happen on iOS when an alert or confirm dialog is opened from a click event callback (issue #23):
            // when the user next taps anywhere else on the page, new touchstart and touchend events are dispatched
            // with the same identifier as the touch event that previously triggered the click that triggered the alert.
            // Sadly, there is an issue on iOS 4 that causes some normal touch events to have the same identifier as an
            // immediately preceeding touch event (issue #52), so this fix is unavailable on that platform.
            // Issue 120: touch.identifier is 0 when Chrome dev tools 'Emulate touch events' is set with an iOS device UA string,
            // which causes all touch events to be ignored. As this block only applies to iOS, and iOS identifiers are always long,
            // random integers, it's safe to to continue if the identifier is 0 here.
            if (touch.identifier && touch.identifier === this.lastTouchIdentifier) {
                event.preventDefault();
                return false;
            }

            this.lastTouchIdentifier = touch.identifier;

            // If the target element is a child of a scrollable layer (using -webkit-overflow-scrolling: touch) and:
            // 1) the user does a fling scroll on the scrollable layer
            // 2) the user stops the fling scroll with another tap
            // then the event.target of the last 'touchend' event will be the element that was under the user's finger
            // when the fling scroll was started, causing FastClick to send a click event to that layer - unless a check
            // is made to ensure that a parent layer was not scrolled before sending a synthetic click (issue #42).
            this.updateScrollParent(targetElement);
        }
    }

    this.trackingClick = true;
    this.trackingClickStart = event.timeStamp;
    this.targetElement = targetElement;

    this.touchStartX = touch.pageX;
    this.touchStartY = touch.pageY;

    // Prevent phantom clicks on fast double-tap (issue #36)
    if ((event.timeStamp - this.lastClickTime) < this.tapDelay) {
        event.preventDefault();
    }

    return true;
};


/**
 * Based on a touchmove event object, check whether the touch has moved past a boundary since it started.
 *
 * @param {Event} event
 * @returns {boolean}
 */
FastClick.prototype.touchHasMoved = function(event) {
    'use strict';
    var touch = event.changedTouches[0], boundary = this.touchBoundary;

    if (Math.abs(touch.pageX - this.touchStartX) > boundary || Math.abs(touch.pageY - this.touchStartY) > boundary) {
        return true;
    }

    return false;
};


/**
 * Update the last position.
 *
 * @param {Event} event
 * @returns {boolean}
 */
FastClick.prototype.onTouchMove = function(event) {
    'use strict';
    if (!this.trackingClick) {
        return true;
    }

    // If the touch has moved, cancel the click tracking
    if (this.targetElement !== this.getTargetElementFromEventTarget(event.target) || this.touchHasMoved(event)) {
        this.trackingClick = false;
        this.targetElement = null;
    }

    return true;
};


/**
 * Attempt to find the labelled control for the given label element.
 *
 * @param {EventTarget|HTMLLabelElement} labelElement
 * @returns {Element|null}
 */
FastClick.prototype.findControl = function(labelElement) {
    'use strict';

    // Fast path for newer browsers supporting the HTML5 control attribute
    if (labelElement.control !== undefined) {
        return labelElement.control;
    }

    // All browsers under test that support touch events also support the HTML5 htmlFor attribute
    if (labelElement.htmlFor) {
        return document.getElementById(labelElement.htmlFor);
    }

    // If no for attribute exists, attempt to retrieve the first labellable descendant element
    // the list of which is defined here: http://www.w3.org/TR/html5/forms.html#category-label
    return labelElement.querySelector('button, input:not([type=hidden]), keygen, meter, output, progress, select, textarea');
};


/**
 * On touch end, determine whether to send a click event at once.
 *
 * @param {Event} event
 * @returns {boolean}
 */
FastClick.prototype.onTouchEnd = function(event) {
    'use strict';
    var forElement, trackingClickStart, targetTagName, scrollParent, touch, targetElement = this.targetElement;

    if (!this.trackingClick) {
        return true;
    }

    // Prevent phantom clicks on fast double-tap (issue #36)
    if ((event.timeStamp - this.lastClickTime) < this.tapDelay) {
        this.cancelNextClick = true;
        return true;
    }

    // Reset to prevent wrong click cancel on input (issue #156).
    this.cancelNextClick = false;

    this.lastClickTime = event.timeStamp;

    trackingClickStart = this.trackingClickStart;
    this.trackingClick = false;
    this.trackingClickStart = 0;

    // On some iOS devices, the targetElement supplied with the event is invalid if the layer
    // is performing a transition or scroll, and has to be re-detected manually. Note that
    // for this to function correctly, it must be called *after* the event target is checked!
    // See issue #57; also filed as rdar://13048589 .
    if (deviceIsIOSWithBadTarget) {
        touch = event.changedTouches[0];

        // In certain cases arguments of elementFromPoint can be negative, so prevent setting targetElement to null
        targetElement = document.elementFromPoint(touch.pageX - window.pageXOffset, touch.pageY - window.pageYOffset) || targetElement;
        targetElement.fastClickScrollParent = this.targetElement.fastClickScrollParent;
    }

    targetTagName = targetElement.tagName.toLowerCase();
    if (targetTagName === 'label') {
        forElement = this.findControl(targetElement);
        if (forElement) {
            this.focus(targetElement);
            if (deviceIsAndroid) {
                return false;
            }

            targetElement = forElement;
        }
    } else if (this.needsFocus(targetElement)) {

        // Case 1: If the touch started a while ago (best guess is 100ms based on tests for issue #36) then focus will be triggered anyway. Return early and unset the target element reference so that the subsequent click will be allowed through.
        // Case 2: Without this exception for input elements tapped when the document is contained in an iframe, then any inputted text won't be visible even though the value attribute is updated as the user types (issue #37).
        if ((event.timeStamp - trackingClickStart) > 100 || (deviceIsIOS && window.top !== window && targetTagName === 'input')) {
            this.targetElement = null;
            return false;
        }

        this.focus(targetElement);
        this.sendClick(targetElement, event);

        // Select elements need the event to go through on iOS 4, otherwise the selector menu won't open.
        // Also this breaks opening selects when VoiceOver is active on iOS6, iOS7 (and possibly others)
        if (!deviceIsIOS || targetTagName !== 'select') {
            this.targetElement = null;
            event.preventDefault();
        }

        return false;
    }

    if (deviceIsIOS && !deviceIsIOS4) {

        // Don't send a synthetic click event if the target element is contained within a parent layer that was scrolled
        // and this tap is being used to stop the scrolling (usually initiated by a fling - issue #42).
        scrollParent = targetElement.fastClickScrollParent;
        if (scrollParent && scrollParent.fastClickLastScrollTop !== scrollParent.scrollTop) {
            return true;
        }
    }

    // Prevent the actual click from going though - unless the target node is marked as requiring
    // real clicks or if it is in the whitelist in which case only non-programmatic clicks are permitted.
    if (!this.needsClick(targetElement)) {
        event.preventDefault();
        this.sendClick(targetElement, event);
    }

    return false;
};


/**
 * On touch cancel, stop tracking the click.
 *
 * @returns {void}
 */
FastClick.prototype.onTouchCancel = function() {
    'use strict';
    this.trackingClick = false;
    this.targetElement = null;
};


/**
 * Determine mouse events which should be permitted.
 *
 * @param {Event} event
 * @returns {boolean}
 */
FastClick.prototype.onMouse = function(event) {
    'use strict';

    // If a target element was never set (because a touch event was never fired) allow the event
    if (!this.targetElement) {
        return true;
    }

    if (event.forwardedTouchEvent) {
        return true;
    }

    // Programmatically generated events targeting a specific element should be permitted
    if (!event.cancelable) {
        return true;
    }

    // Derive and check the target element to see whether the mouse event needs to be permitted;
    // unless explicitly enabled, prevent non-touch click events from triggering actions,
    // to prevent ghost/doubleclicks.
    if (!this.needsClick(this.targetElement) || this.cancelNextClick) {

        // Prevent any user-added listeners declared on FastClick element from being fired.
        if (event.stopImmediatePropagation) {
            event.stopImmediatePropagation();
        } else {

            // Part of the hack for browsers that don't support Event#stopImmediatePropagation (e.g. Android 2)
            event.propagationStopped = true;
        }

        // Cancel the event
        event.stopPropagation();
        event.preventDefault();

        return false;
    }

    // If the mouse event is permitted, return true for the action to go through.
    return true;
};


/**
 * On actual clicks, determine whether this is a touch-generated click, a click action occurring
 * naturally after a delay after a touch (which needs to be cancelled to avoid duplication), or
 * an actual click which should be permitted.
 *
 * @param {Event} event
 * @returns {boolean}
 */
FastClick.prototype.onClick = function(event) {
    'use strict';
    var permitted;

    // It's possible for another FastClick-like library delivered with third-party code to fire a click event before FastClick does (issue #44). In that case, set the click-tracking flag back to false and return early. This will cause onTouchEnd to return early.
    if (this.trackingClick) {
        this.targetElement = null;
        this.trackingClick = false;
        return true;
    }

    // Very odd behaviour on iOS (issue #18): if a submit element is present inside a form and the user hits enter in the iOS simulator or clicks the Go button on the pop-up OS keyboard the a kind of 'fake' click event will be triggered with the submit-type input element as the target.
    if (event.target.type === 'submit' && event.detail === 0) {
        return true;
    }

    permitted = this.onMouse(event);

    // Only unset targetElement if the click is not permitted. This will ensure that the check for !targetElement in onMouse fails and the browser's click doesn't go through.
    if (!permitted) {
        this.targetElement = null;
    }

    // If clicks are permitted, return true for the action to go through.
    return permitted;
};


/**
 * Remove all FastClick's event listeners.
 *
 * @returns {void}
 */
FastClick.prototype.destroy = function() {
    'use strict';
    var layer = this.layer;

    if (deviceIsAndroid) {
        layer.removeEventListener('mouseover', this.onMouse, true);
        layer.removeEventListener('mousedown', this.onMouse, true);
        layer.removeEventListener('mouseup', this.onMouse, true);
    }

    layer.removeEventListener('click', this.onClick, true);
    layer.removeEventListener('touchstart', this.onTouchStart, false);
    layer.removeEventListener('touchmove', this.onTouchMove, false);
    layer.removeEventListener('touchend', this.onTouchEnd, false);
    layer.removeEventListener('touchcancel', this.onTouchCancel, false);
};


/**
 * Check whether FastClick is needed.
 *
 * @param {Element} layer The layer to listen on
 */
FastClick.notNeeded = function(layer) {
    'use strict';
    var metaViewport;
    var chromeVersion;
    var blackberryVersion;

    // Devices that don't support touch don't need FastClick
    if (typeof window.ontouchstart === 'undefined') {
        return true;
    }

    // Chrome version - zero for other browsers
    chromeVersion = +(/Chrome\/([0-9]+)/.exec(navigator.userAgent) || [,0])[1];

    if (chromeVersion) {

        if (deviceIsAndroid) {
            metaViewport = document.querySelector('meta[name=viewport]');

            if (metaViewport) {
                // Chrome on Android with user-scalable="no" doesn't need FastClick (issue #89)
                if (metaViewport.content.indexOf('user-scalable=no') !== -1) {
                    return true;
                }
                // Chrome 32 and above with width=device-width or less don't need FastClick
                if (chromeVersion > 31 && document.documentElement.scrollWidth <= window.outerWidth) {
                    return true;
                }
            }

        // Chrome desktop doesn't need FastClick (issue #15)
        } else {
            return true;
        }
    }

    if (deviceIsBlackBerry10) {
        blackberryVersion = navigator.userAgent.match(/Version\/([0-9]*)\.([0-9]*)/);

        // BlackBerry 10.3+ does not require Fastclick library.
        // https://github.com/ftlabs/fastclick/issues/251
        if (blackberryVersion[1] >= 10 && blackberryVersion[2] >= 3) {
            metaViewport = document.querySelector('meta[name=viewport]');

            if (metaViewport) {
                // user-scalable=no eliminates click delay.
                if (metaViewport.content.indexOf('user-scalable=no') !== -1) {
                    return true;
                }
                // width=device-width (or less than device-width) eliminates click delay.
                if (document.documentElement.scrollWidth <= window.outerWidth) {
                    return true;
                }
            }
        }
    }

    // IE10 with -ms-touch-action: none, which disables double-tap-to-zoom (issue #97)
    if (layer.style.msTouchAction === 'none') {
        return true;
    }

    return false;
};


/**
 * Factory method for creating a FastClick object
 *
 * @param {Element} layer The layer to listen on
 * @param {Object} options The options to override the defaults
 */
FastClick.attach = function(layer, options) {
    'use strict';
    return new FastClick(layer, options);
};


if (typeof define == 'function' && typeof define.amd == 'object' && define.amd) {

    // AMD. Register as an anonymous module.
    define(function() {
        'use strict';
        return FastClick;
    });
} else if (typeof module !== 'undefined' && module.exports) {
    module.exports = FastClick.attach;
    module.exports.FastClick = FastClick;
} else {
    window.FastClick = FastClick;
}



// Sticky Plugin v1.0.0 for jQuery
// =============
// Author: Anthony Garand
// Improvements by German M. Bravo (Kronuz) and Ruud Kamphuis (ruudk)
// Improvements by Leonardo C. Daronco (daronco)
// Created: 2/14/2011
// Date: 2/12/2012
// Website: http://labs.anthonygarand.com/sticky
// Description: Makes an element on the page stick on the screen as you scroll
//       It will only set the 'top' and 'position' of your element, you
//       might need to adjust the width in some cases.

(function($) {
  var defaults = {
      topSpacing: 0,
      bottomSpacing: 0,
      className: 'is-sticky',
      wrapperClassName: 'sticky-wrapper',
      center: false,
      getWidthFrom: '',
      responsiveWidth: false
    },
    $window = $(window),
    $document = $(document),
    sticked = [],
    windowHeight = $window.height(),
    scroller = function() {
      var scrollTop = $window.scrollTop(),
        documentHeight = $document.height(),
        dwh = documentHeight - windowHeight,
        extra = (scrollTop > dwh) ? dwh - scrollTop : 0;

      for (var i = 0; i < sticked.length; i++) {
        var s = sticked[i],
          elementTop = s.stickyWrapper.offset().top,
          etse = elementTop - s.topSpacing - extra;

        if (scrollTop <= etse) {
          if (s.currentTop !== null) {
            s.stickyElement
              .css('position', '')
              .css('top', '');
            s.stickyElement.trigger('sticky-end', [s]).parent().removeClass(s.className);
            s.currentTop = null;
          }
        }
        else {
          var newTop = documentHeight - s.stickyElement.outerHeight()
            - s.topSpacing - s.bottomSpacing - scrollTop - extra;
          if (newTop < 0) {
            newTop = newTop + s.topSpacing;
          } else {
            newTop = s.topSpacing;
          }
          if (s.currentTop != newTop) {
            s.stickyElement
              .css('position', 'fixed')
              .css('top', newTop);

            if (typeof s.getWidthFrom !== 'undefined') {
              s.stickyElement.css('width', $(s.getWidthFrom).width());
            }

            s.stickyElement.trigger('sticky-start', [s]).parent().addClass(s.className);
            s.currentTop = newTop;
          }
        }
      }
    },
    resizer = function() {
      windowHeight = $window.height();

      for (var i = 0; i < sticked.length; i++) {
        var s = sticked[i];
        if (typeof s.getWidthFrom !== 'undefined' && s.responsiveWidth === true) {
          s.stickyElement.css('width', $(s.getWidthFrom).width());
        }
      }
    },
    methods = {
      init: function(options) {
        var o = $.extend({}, defaults, options);
        return this.each(function() {
          var stickyElement = $(this);

          var stickyId = stickyElement.attr('id');
          var wrapperId = stickyId ? stickyId + '-' + defaults.wrapperClassName : defaults.wrapperClassName 
          var wrapper = $('<div></div>')
            .attr('id', stickyId + '-sticky-wrapper')
            .addClass(o.wrapperClassName);
          stickyElement.wrapAll(wrapper);

          if (o.center) {
            stickyElement.parent().css({width:stickyElement.outerWidth(),marginLeft:"auto",marginRight:"auto"});
          }

          if (stickyElement.css("float") == "right") {
            stickyElement.css({"float":"none"}).parent().css({"float":"right"});
          }

          var stickyWrapper = stickyElement.parent();
          stickyWrapper.css('height', stickyElement.outerHeight());
          sticked.push({
            topSpacing: o.topSpacing,
            bottomSpacing: o.bottomSpacing,
            stickyElement: stickyElement,
            currentTop: null,
            stickyWrapper: stickyWrapper,
            className: o.className,
            getWidthFrom: o.getWidthFrom,
            responsiveWidth: o.responsiveWidth
          });
        });
      },
      update: scroller,
      unstick: function(options) {
        return this.each(function() {
          var unstickyElement = $(this);

          var removeIdx = -1;
          for (var i = 0; i < sticked.length; i++)
          {
            if (sticked[i].stickyElement.get(0) == unstickyElement.get(0))
            {
                removeIdx = i;
            }
          }
          if(removeIdx != -1)
          {
            sticked.splice(removeIdx,1);
            unstickyElement.unwrap();
            unstickyElement.removeAttr('style');
          }
        });
      }
    };

  // should be more efficient than using $window.scroll(scroller) and $window.resize(resizer):
  if (window.addEventListener) {
    window.addEventListener('scroll', scroller, false);
    window.addEventListener('resize', resizer, false);
  } else if (window.attachEvent) {
    window.attachEvent('onscroll', scroller);
    window.attachEvent('onresize', resizer);
  }

  $.fn.sticky = function(method) {
    if (methods[method]) {
      return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
    } else if (typeof method === 'object' || !method ) {
      return methods.init.apply( this, arguments );
    } else {
      $.error('Method ' + method + ' does not exist on jQuery.sticky');
    }
  };

  $.fn.unstick = function(method) {
    if (methods[method]) {
      return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
    } else if (typeof method === 'object' || !method ) {
      return methods.unstick.apply( this, arguments );
    } else {
      $.error('Method ' + method + ' does not exist on jQuery.sticky');
    }

  };
  $(function() {
    setTimeout(scroller, 0);
  });
})(jQuery);
