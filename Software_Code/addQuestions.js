var questionNumber = 1;
var addCols = function(num, type) {
    if (type == "text") {
        var myCol = $('<div class="card" id = ' + questionNumber +' "><div class="card-body"><input type = "text" id =' + questionNumber +
            ' placeholder="Enter question here:" class="card-title question-title"/><p class="card-text"><em>Answer here</em></p><div class="d-grid gap-2 d-md-flex justify-content-md-end"><a href="#"  class="btn btn-primary fas fa-check"></a><a href="#" class="btn btn-primary btn-danger fas fa-trash"></a></div><div class="form-check"><input type="checkbox" class="form-check-input" id="required"><label class="form-check-label" for="required">Required</label></div>    </div>   </div>'
        );
    } else if (type == "radio") {

        var myCol = $('<div class="card id = ' + questionNumber +' "><div class="card-body">  <input type = "text" id = "myText" placeholder="Enter question here:" class="card-title question-title"/>    <div id="contentPanel' + questionNumber +'">  </div><a href="#"  id = ' + questionNumber +' onclick="addExtraRadio(this.id)" class="btn btn-primary btn-success fas fa-plus"></a><div class="d-grid gap-2 d-md-flex justify-content-md-end">  <a href="#" class="btn btn-primary fas fa-check"></a>  <a href="#" onclick="deleteCard()" class="btn btn-primary btn-danger fas fa-trash"></a>  </div>  <div class="form-check">  <input type="checkbox" class="form-check-input" id="required">    <label class="form-check-label" for="required">Required</label></div></div></div>');
    }
    myCol.appendTo('#questionPanel');
    questionNumber++;
};

function addExtraRadio(id) {

    alert(id)
    var numberOfOptions = 1;
    var div = $('<div class="cardParent"></div>');
    var myCol = $('<p class="card-text"><input type = "text" id =' + numberOfOptions + ' placeholder="Enter option here..." class="card-title option"/></p>\n');
    var deleteButton = $('<a href="#" class="btn btn-primary btn-secondary fas fa-times btn-delete close" style="margin-left: 20px;"></a>');
    deleteButton.appendTo(myCol);
    myCol.appendTo(div);
    div.appendTo('#contentPanel' +id);
    numberOfOptions++;
}
function deleteCard(){
    alert("deleteCard");
    var $target = $(this).parents('.card');
    $target.hide('slow', function(){ $target.remove(); });
}
$("#btnText").click(function() {

    addCols('1', 'text');
});

$("#btnRadio").click(function() {

    addCols('1', 'radio');
});


