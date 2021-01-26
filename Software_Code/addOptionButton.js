var numberOfOptions = 1;
var addCols = function (num){
    for (var i=1;i<=num;i++) {
        var div = $('<div class="cardParent"></div>');
        var myCol = $('<p class="card-text"><input type = "text" id =' + numberOfOptions + ' placeholder="Enter option here..." class="card-title option"/></p>\n');
        var deleteButton = $('<a href="#" class="btn btn-primary btn-secondary fas fa-times btn-delete close" style="margin-left: 20px;"></a>');
        deleteButton.appendTo(myCol);
        myCol.appendTo(div);
        div.appendTo('#contentPanel');
        numberOfOptions++;
    }

    $('.close').on('click', function(e){
        e.stopPropagation();
        var $target = $(this).parents('.cardParent');
        $target.hide('slow', function(){ $target.remove(); });
    });
};

$("#btnGen").click(function() {
    addCols('1');
    return false;
});

$("#deleteCard").click(function() {
    var $target = $(this).parents('.card');
    $target.hide('slow', function(){ $target.remove(); });
    return false;
});
