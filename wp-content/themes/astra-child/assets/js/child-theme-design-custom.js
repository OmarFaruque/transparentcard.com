
// jQuery(document).ready(function(){
    // setTimeout(() => {
    jQuery('.template-tags-wrap .main-items .items').html('');
    var content = jQuery('#additionalTemplateMarkup').html();
    jQuery('#additionalTemplateMarkup').html('');
    jQuery('.template-tags-wrap .main-items .items').replaceWith(content);
    jQuery(document.body).find('.nbd-items-dropdown.template-tags-wrap .items .item').addClass('coolcard-item').removeClass('item');

    
    var typoContent = jQuery('#additionalTypograpyCotnent').html();
    jQuery('#additionalTypograpyCotnent').html('');
    jQuery('.nbd-sidebar #tab-typography .tab-main .typography-head').replaceWith(typoContent);

    //Change process text 
    jQuery(document.body).find('.nbd-main-bar ul.menu-right .menu-item.item-process span').text(window.NBDESIGNCONFIG.nbd_process_text);

    // Change designer logo url to home 
    jQuery(document.body).find('#design-container .nbd-main-bar a').attr('href', window.NBDESIGNCONFIG.home_url);
    



    // }, 1000);
// });


var tamplagteTagsWrap = jQuery(document.body).find('.nbd-items-dropdown.template-tags-wrap');
    var self = this;
    
    // var $items = $(this).find('.items');
    var $item = $(this).find('.coolcard-item');
    
    var $galleryItem = $(this).find('.nbdesigner-gallery');
    var $infoSupport = $(this).find('.info-support');
    var $tabScroll = $(this).closest('.tab-scroll');
    // var $contentItem = $(this).find('.result-loaded .content-item');
    var $itemInRow = 3;
    var noItem = $item.length;
    // var noItemRow = parseInt(noItem / opts.itemInRow);
    // var itemHeight = $item.outerHeight() + opts.itemDistance;
    var $loadingGif = $(this).find('.loading-photo');
    var isMasonry = false;
    // ========================= Main================================================

    jQuery(document.body).on('click', '.items .coolcard-item', function () {
       
        var self = jQuery(this);
        var $mainItems = jQuery(this).closest('.main-items');
        var indexItem = $(this).index();
        var indexItemRow = parseInt(indexItem / $itemInRow) + 1;
        var widthItem = $(this).outerWidth();
        var itemName = $(this).find('.item-name').text();
        var dataType = $(this).attr('data-type');
        var dataApi = jQuery(this).attr('data-api');
        var $resultLoaded = jQuery(this).closest('.main-items').next('.result-loaded');
        var $contentItem = jQuery(this).closest('.main-items').next('.result-loaded').find('.content-item');
        var $items = jQuery(this).closest('.items');
        var itemDistance = 10;
        var $thisHeight = self.height() + (itemDistance * 2);


        if (dataType == 'webcam'){
            var $popupWebcam = $('.nbd-popup.popup-webcam');
            $popupWebcam.addClass('nb-show');
            return false;
        }

        $infoSupport.find('span').text(itemName);
        // Set height for categories
        // $mainItems.css({
        //     'height': indexItemRow * (itemHeight - 15) + 'px'
        // });


        
        if (dataApi == 'false') {
            $resultLoaded.show().addClass('overflow-visible');
            $contentItem.filter(function (index) {
                return $(this).attr('data-type') === dataType;
            }).show().find('input[type="text"]').first().focus();
            $galleryItem.hide();

            if (!$mainItems.hasClass('active-expanded')){
                $(this).siblings().css({
                    'opacity': '0.5'
                });
                $mainItems.addClass('active-expanded');
                $resultLoaded.addClass('loaded');
                
                var nextAllItem = $items.find('.coolcard-item:nth-child(' + indexItemRow * $itemInRow + ')').nextAll(':lt(3)');
                
                var opsetTop = indexItemRow * $thisHeight;

                // calculate top height; 
                setTimeout(function(){
                    var childItemHeight = $resultLoaded.find('.content-item[data-type="'+dataType+'"]').height();
                    childItemHeight = childItemHeight + (itemDistance * 4);
                    jQuery(nextAllItem).addClass('cool-child-wrap-margin').animate({
                        'marginTop': childItemHeight
                    });
                }, 500);
                $resultLoaded.css({top: opsetTop});
                $mainItems.find('.pointer').css({
                    'left': ((widthItem) * (indexItem % $itemInRow + 1) - widthItem / 2)  + 'px', 
                    'top': opsetTop - ((itemDistance * 2) - 1)
                });
            }else {
                
                $(this).css({
                    'opacity': '1'
                });
                $(this).siblings().css({
                    'opacity': '1'
                });
                $items.find('.coolcard-item.cool-child-wrap-margin').removeClass('cool-child-wrap-margin').animate({'marginTop': 0});
                $resultLoaded.find('.content-item[data-type="'+dataType+'"]').hide();
                $mainItems.removeClass('active-expanded');
                // sefl.initPositionItem($items, $item, opts.itemInRow, opts.itemDistance);
                $resultLoaded.hide();
                $contentItem.hide();
                $resultLoaded.removeClass('loaded');
            }
            $infoSupport.find('.close-result-loaded').on('click', function () {
                $mainItems.removeClass('active-expanded');
                // sefl.initPositionItem($items, $item, opts.itemInRow, opts.itemDistance);
//                        $resultLoaded.find('.nbdesigner-gallery').empty();
                $resultLoaded.hide();
                $contentItem.hide();
                $item.show().css({'opacity' : '1'});
                $resultLoaded.removeClass('loaded');
                $tabScroll.scrollTop(0);
                $infoSupport.removeClass('slideInDown animated show');
            });
        }else {
            $resultLoaded.removeClass('overflow-visible');
            if (!$mainItems.hasClass('active-expanded')) {
                $(this).siblings().css({
                    'opacity': '0.5'
                });

                $resultLoaded.show();
                $galleryItem.show();
                $mainItems.addClass('active-expanded');
                $resultLoaded.addClass('loaded');
            }else {
                $(this).css({
                    'opacity': '1'
                });
                $(this).siblings().css({
                    'opacity': '1'
                });
                $mainItems.removeClass('active-expanded');
                // sefl.initPositionItem($items, $item, opts.itemInRow, opts.itemDistance);
//                        $resultLoaded.find('.nbdesigner-gallery').empty();
                $resultLoaded.hide();
                $resultLoaded.removeClass('loaded');
                $galleryItem.hide();
                $contentItem.hide();

            }

            // Event click in close result
            $infoSupport.find('.close-result-loaded').on('click', function () {
                $mainItems.removeClass('active-expanded');
                // sefl.initPositionItem($items, $item, opts.itemInRow, opts.itemDistance);
//                        $resultLoaded.find('.nbdesigner-gallery').empty();
                $resultLoaded.hide();
                $item.show().css({'opacity' : '1'});
                $resultLoaded.removeClass('loaded');
                $tabScroll.scrollTop(0);
                $infoSupport.removeClass('slideInDown animated show');
            });

            return false;
        }

    });



    jQuery(document.body).on('click', '.nbd-items-dropdown.template-tags-wrap h2.accordion-header button.accordion-button', function(){
        var item = jQuery(this);
        setTimeout(function(){
            var itemPosition = jQuery(item).position().top;
            jQuery('.tab-main').animate({
                scrollTop: itemPosition
            }, 500); // 500 denotes the duration of the scroll animation in milliseconds
        }, 1000);

    });

    jQuery(document.body).on('shown.bs.collapse', '#design-container .accordion', function () {
        // calculateSubTagsMargin(this);
    });
    jQuery(document.body).on('hidden.bs.collapse', '#design-container .accordion', function () {
        // calculateSubTagsMargin(this);
    });

    var calculateSubTagsMargin = function(self){
        var itemDistance = 10;
        var $resultLoaded = jQuery(self).closest('.result-loaded');
        var nextAllItem = $resultLoaded.prev('.main-items').find('.cool-child-wrap-margin');
        var childItemHeight = jQuery(self).closest('.content-item').height();
        childItemHeight = childItemHeight + (itemDistance * 4);
        jQuery(nextAllItem).animate({
            'marginTop': childItemHeight
        });
    }


    //Move coolcards additional taxonomy inside popup 
    jQuery(document).ready(function(){
        let coolcards_tax_div = jQuery(document.body).find('#coolcaardsTags');
        let targetElement = jQuery(document.body).find('span.template-tags-reload').closest('.template-tags');
        coolcards_tax_div.insertAfter(targetElement);

            setTimeout(() => {
                var appElement = document.querySelector('body[ng-app="nbd-app"]');
                var $scope = angular.element(appElement).scope();
                
                $scope.coolcardCheckSizeAvailability = function(chiledTemplates){
                    if(typeof window.parent.nbOption == 'undefined') return true;
                    let returnV = true;
                    if(typeof window.parent.nbOption.odOption.size != 'undefined' && typeof window.parent.nbOption.odOption.size.product_width != 'undefined'){
                        const selectedSize = `${window.parent.nbOption.odOption.size.product_width}x${window.parent.nbOption.odOption.size.product_height}`;
                        const matchArr = typeof chiledTemplates.paper_size != 'undefined' ? chiledTemplates.paper_size.filter(str => str.includes(selectedSize)) : [];
                        if(matchArr.length <= 0)
                            returnV = false;
                    }
                    return returnV;
                }

                $scope.coolcardCheckhaveitebysize = function($templates){
                    
                    if(typeof window.parent.nbOption == 'undefined') return true;
                    let temReturn = true; 
                    if(typeof window.parent.nbOption.odOption.size != 'undefined' && typeof window.parent.nbOption.odOption.size.product_width != 'undefined'){
                        temReturn = false;
                        const selectedSize = `${window.parent.nbOption.odOption.size.product_width}x${window.parent.nbOption.odOption.size.product_height}`;
                        $templates.forEach((k, v) => {
                            const matchArr = typeof k.paper_size != 'undefined' ? k.paper_size.filter(str => str.includes(selectedSize)) : [];
                            if(matchArr.length > 0)
                                temReturn = true;
                        });
                    }
                    return temReturn;
                }

                
                // console.log('coolcardParseTags: ', coolcardParentTags)
                // Add additional glassi effect $scope.addImageFromUrl(src, true);
                // var url = 'https://transparentcard.com/wp-content/themes/astra-child/assets/img/tut-tut-tut.png';
                // $scope.addImageFromUrl(url, true);
                
              }, 1000);
            
    });


    // tag filters by product size by option
    var tagFilter = function(product_size, tags, orientation_p = 'horizontal'){

        var newTags = tags;
        var orientation = orientation_p; 
        
        if(product_size){
            var productOptionSize = product_size.real_width + 'x' + product_size.real_height + '-mm';
            var verticalSizes = ['51x89-mm', '55x85-mm', '40x85-mm'];
            if(verticalSizes.indexOf(productOptionSize) > -1 ){
                orientation = 'vertical';
                productOptionSize = product_size.real_height + 'x' + product_size.real_width + '-mm';
            }
        }else{
            productOptionSize = window.NBDESIGNCONFIG.paper_size;
        }
            for(var i = newTags.length - 1; i >= 0; i-- ){
                for(var s = newTags[i].templates.length - 1; s >= 0; s-- ){
                    var psize = newTags[i].templates[s].paper_sizes; 

                    if(typeof psize != 'undefined' && psize.indexOf(productOptionSize) < 0){     
                        newTags[i].templates.splice(s, 1);
                    }

                    if(typeof newTags[i].templates[s] != 'undefined' 
                        && typeof newTags[i].templates[s].paper_orientation != 'undefined' 
                        && newTags[i].templates[s].paper_orientation.indexOf(orientation) < 0 )
                        { 
                            newTags[i].templates.splice(s, 1);
                        }
                }
            }
        return newTags;
    }



    //Reload page if close nbdesign 
    jQuery(document.body).on('click', '.nbd-modern-layout .nbdesigner_pp_close', function() {
        location.reload();
    });


    
    jQuery(document.body).on('click', 'div.footer a.nbd-button.nbo-apply',function(){
        transparentBgSettings();
    });


jQuery(document).ready(function(){

//     jQuery(document.body).find('ul.nbd-main-menu.menu-center').prepend(`<li class="menu-item undo-redo in" id="transparentcardUndo" ng-class="stages[currentStage].states.isUndoable ? 'in' : 'nbd-disabled'">
//     <i class="icon-nbd-baseline-undo"></i>
//     <span class="nbd-font-size-12">Rückgängig</span>
// </li>`);
        
    
    var $scope = angular.element(document.getElementById("designer-controller")).scope();

    setTimeout(function(){

        $scope.regenerateTransparentBg = function(){
            if(typeof $scope.lastPrintingOptions.size != 'undefined'){
                var  real_height = $scope.lastPrintingOptions.orientation == 0 ? $scope.lastPrintingOptions.size.real_width : $scope.lastPrintingOptions.size.real_height, 
                real_width = $scope.lastPrintingOptions.orientation == 0 ? $scope.lastPrintingOptions.size.real_height : $scope.lastPrintingOptions.size.real_width,
                frame_img = real_width + 'x'+real_height+'-mm';
            }

            if(typeof $scope.lastPrintingOptions.size == 'undefined' && typeof $scope.settings.product_data.product != 'undefined'){
                var  real_height = $scope.settings.product_data.product[$scope.currentStage].real_height, 
                real_width = $scope.settings.product_data.product[$scope.currentStage].real_width,
                frame_img = real_width + 'x'+real_height+'-mm';
            }

            $scope.addBackgrounds(`${window.NBDESIGNCONFIG.child_assets_url}/transparent_glass_${frame_img}.png`,true,true);
        }


        $scope.renderStage = function( stage_id ){
            $scope.regenerateTransparentBg();
            stage_id = angular.isDefined( stage_id ) ? stage_id :  $scope.currentStage;
            if (typeof $scope.stages[stage_id]['canvas'].calcOffset === 'function') {
                $scope.stages[stage_id]['canvas'].calcOffset();
            }
            
            //$scope.stages[stage_id]['canvas'].requestRenderAll();
            $scope.stages[stage_id]['canvas'].renderAll();
        };

        $scope.undo = function(){
            var _stage = $scope.stages[$scope.currentStage],
            _canvas = _stage['canvas']; 
            
            if( _stage.undos.length > 1 ){
                var last = _stage.undos.pop(),
                    nexttoLast = _stage.undos[ _stage.undos.length - 1 ];
                $scope._loadStageFromJson($scope.currentStage, nexttoLast);
                $scope.setHistory($scope.currentStage, false, last, true);
                $scope.deactiveAllLayer();
                

                if( $scope.resource.shareDesign ){
                    if( NBDESIGNCONFIG['ui_mode'] == 1 ) {
                        nbd_window.jQuery(nbd_window.document).triggerHandler( 'nbd_pass_design_json', {stage_id: $scope.currentStage, design: nexttoLast, config: { width: _canvas.width, height: _canvas.height, zoom: _stage.states.scaleRange[_stage.states.currentScaleIndex].ratio }, fonts: _stage.states.usedFonts } );
                    }else{
                        jQuery( document ).triggerHandler( 'nbd_pass_design_json', {stage_id: $scope.currentStage, design: nexttoLast, config: { width: _canvas.width, height: _canvas.height, zoom: _stage.states.scaleRange[_stage.states.currentScaleIndex].ratio }, fonts: _stage.states.usedFonts } );
                    }
                }
            }
            $scope.regenerateTransparentBg();
            $scope.renderStage();
            $scope.updateApp();
        };


        $scope.redo = function(){
            var _stage = this.stages[this.currentStage],
                _canvas = _stage['canvas'];
            if( _stage.redos.length > 0 ){
                var last = _stage.redos.pop();
                $scope._loadStageFromJson($scope.currentStage, last);
                $scope.setHistory($scope.currentStage, last, false, true);
                $scope.deactiveAllLayer();
                $scope.regenerateTransparentBg();
                this.renderStage();
            };
            $scope.updateApp();
        }; 


        $scope.clearStage = function(){
            if( !$scope.canDeleteLayer() ) return;
            var stage = $scope.stages[$scope.currentStage],
            _canvas = stage['canvas'];
            _canvas.clear();
            jQuery('.clear-stage-alert .close-popup').triggerHandler('click');
            if( stage.config.bgType == 'color' ){}
            if( stage.config.area_design_type == "2" ){
                $scope.contextAddLayers = 'template';
                var width = _canvas.width,
                height = _canvas.height,
                path = new fabric.Path("M0 0 H"+width+" V"+height+" H0z M "+width/2+" 0 A "+width/2+" "+height/2+", 0, 1, 0, "+width/2+" "+height+" A "+width/2+" "+height/2+", 0, 1, 0, "+width/2+" 0z");
                path.set({strokeWidth: 0, isAlwaysOnTop: true, fill: '#ffffff', selectable: false, evented: false});
                _canvas.add(path);
            }
            $scope.updateLayersList();
            _canvas.requestRenderAll();
            $scope.setHistory($scope.currentStage, true);
            $scope.stageDesignChanged();
            $scope.regenerateTransparentBg();
        };



        $scope.startTourGuide = function(){
            if( $scope.settings.is_mobile ){
                return;
            }
            if( $scope.tourGuide.currentStep == -1 ){
                var steps = [];
                jQuery.each(jQuery('[data-tour]'), function(){
                    var el = jQuery(this),
                    dataTour = el.attr('data-tour'),
                    priority = el.attr('data-tour-priority');

                    if(dataTour != 'backgrounds'){
                        steps.push({
                            priority: priority,
                            template: 'tour_guide.' + dataTour,
                            element: el
                        });
                    }
                });
                
                $scope.tourGuide.steps = _.sortBy(steps, [function(s) { return s.priority; }]);
            };
            $scope.tourGuideShowing = true;
            localStorage.setItem('showTourGuide', 1);
            $scope.tourGuide.currentStep = -1;
            setTimeout(function(){
                $scope.nextTour();
            },  500);
        };
        

    }, 3000);

    setTimeout(function(){
        transparentBgSettings();
     },5000);
});

//process, typos, 
/**
 * Transparent bg set automatically 
 */
var transparentBgSettings = function(){
var scope = angular.element(document.getElementById("designer-controller")).scope();
    // change undo functionality
    if(scope.stages.length > 0){

            setTimeout(function(){

                var url = new URL(window.location.href);
                var orientation = url.searchParams.get( 'orientation' );
                
                if(orientation){
                    var oldTags = scope.settings.template_tags;
                    var newTags = tagFilter(false, oldTags, orientation);
                    scope.settings.template_tags = newTags;
                }

                
                if(typeof scope.lastPrintingOptions.size != 'undefined'){
                    
                    var oldTags = scope.settings.template_tags;
                    var newTags = tagFilter(scope.lastPrintingOptions.size, oldTags);
                    scope.settings.template_tags = newTags;    
                }


                // jQuery(document.body).find('canvas#nbd-stage-0').css('border-radius', '25px');
                // if(scope.stages[0].canvas._objects.length <= 0) scope.addImageFromUrl(`${window.NBDESIGNCONFIG.child_assets_url}/transparent_glass_${frame_img}.png`, false); //
                if(typeof scope.lastPrintingOptions.size != 'undefined'){
                    var  real_height = scope.lastPrintingOptions.orientation == 0 ? scope.lastPrintingOptions.size.real_width : scope.lastPrintingOptions.size.real_height, 
                    real_width = scope.lastPrintingOptions.orientation == 0 ? scope.lastPrintingOptions.size.real_height : scope.lastPrintingOptions.size.real_width,
                    frame_img = real_width + 'x'+real_height+'-mm';
                }

                if(typeof scope.lastPrintingOptions.size == 'undefined' && typeof scope.settings.product_data.product != 'undefined'){
                    var  real_height = scope.settings.product_data.product[scope.currentStage].real_height, 
                    real_width = scope.settings.product_data.product[scope.currentStage].real_width,
                    frame_img = real_width + 'x'+real_height+'-mm';
                }
                
                var stage_orientation = real_width < real_height ? 'vertical' : 'horizontal';
                if(stage_orientation == 'vertical' && window.innerWidth < 1500){
                    scope.zoomStage(4); 
                    jQuery(document.body).find('.nbd-toolbar-zoom').hide();
                }
                
                scope.addBackgrounds(`${window.NBDESIGNCONFIG.child_assets_url}/transparent_glass_${frame_img}.png`,true,true);
                scope.renderStage();
                scope.updateApp();
                
            }, 5000);

        }
// });
}




// hide background menu from design window if user in frontend
jQuery(document).ready(function(){
    if(!window.NBDESIGNCONFIG.is_backend){
        jQuery(document.body).find('li#nav-background').hide();
        jQuery(document.body).find('#selectedTab').addClass('fontend');
    }
});


jQuery(window).on('load', function(){
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const transparent_source = urlParams.get('source');

    if(transparent_source == 'single-product'){
        jQuery(document.body).find('.nbd-popup.popup-nbo-options').removeClass('nb-show');
    }
})


// setTimeout( function() {
    
    
//     var nbdApp;
//     var dependModules = ["angularSpectrumColorpicker"];
//     if( !!NBDESIGNCONFIG['enable_live_chat'] && NBDESIGNCONFIG['ui_mode'] == 2 ){
//         dependModules.push( "nbdChatApp" );
//     }
//     if( NBDESIGNCONFIG['ui_mode'] != 3 ){
//         nbdApp = angular.module('nbd-app', dependModules);
//     }else{
//         nbdApp = angular.module('nbdApp', dependModules);
//     };
    

//     console.log('nbd working omar 5');
//     nbdApp.directive('nbdLayer', ['$timeout', function($timeout){
//         console.log('nbd working omar');
//         return {
//             restrict: "AE",
//             scope: {
//                 action: '&nbdLayer'
//             },
//             link: function( scope, element, attrs ) {
//                 $timeout(function() {
//                     jQuery(element).sortable({
//                         placeholder: "sortable-placeholder",
//                         containment: '#tab-layer',
//                         stop: function(event, ui) {
//                             console.log('stop event in theme');
//                             var srcIndex = jQuery(this).attr('data-prev-index'),
//                                 oldIndex = jQuery(this).attr('data-previndex'),
//                                 newIndex = ui.item.index(),
//                                 dstIndex = 0;
//                             if( oldIndex > newIndex ){
//                                 dstIndex = jQuery(ui.item).next().attr('data-index')
//                             }else {
//                                 dstIndex = jQuery(ui.item).prev().attr('data-index')
//                             };
//                             jQuery(this).removeAttr('data-previndex');
//                             jQuery(this).removeAttr('data-prev-index');
//                             scope.action({srcIndex: srcIndex, dstIndex: dstIndex});
//                         },
//                         start: function(e, ui) {
//                             console.loig('in theme drag eent')
//                             jQuery(this).attr('data-prev-index', jQuery(ui.item).attr('data-index'));
//                             jQuery(this).attr('data-previndex', ui.item.index());
//                         },
//                     });
//                 });
//             }
//         };
//     }]);



// }, 1000);