/**
 * Created by gallatib on 02.02.2017.
 */


var $grid = $('.grid').imagesLoaded( function() {
    $grid.masonry({
    });
});

$('.grid').masonry({
    itemSelector: '.grid-item',
    columnWidth: '.grid-sizer',
    percentPosition: true,
    layoutMode: 'packery'
});

