$(function () {
    $('a').delegate('click', '.delete', function () {
        if (!confirm('Czy na pewno chcesz usunąć ten element?')) {
            return false;
        }
    });

    var switchActiveMenu = function(){
        var activeLink = $(".nav.navbar-nav > li > a[href*='" + location.pathname + "']");

        if(activeLink.length > 0){
            $('li.active.open.selected').removeClass('active open selected');
            activeLink.parent().addClass('active open selected');
        }
    }

    switchActiveMenu();
});
