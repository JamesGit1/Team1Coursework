// numbers the questions
var questionNumber = 1;
// keeps track of the number of questions
var numberOfQuestions = 0;

//Adds the card depending on Condition
var addCols = function(num, type) {
  if (type == "text") {
    // Text Card
    var myCol = $('<div class="card" id = question' + questionNumber + '><div class="card-body"><input type = "text" id ' +
        '=' + questionNumber +
      ' placeholder="Enter question here:" class="card-title question-title"/><p class="card-text"><em>Answer here</em> </p>' +
        '<div class="d-grid gap-2 d-md-flex justify-content-md-end"><a href="#"  class="btn btn-primary fas ' +
        'fa-check"></a><a href="#" id = ' + questionNumber + ' onclick="deleteCard(this.id)" class="btn btn-primary ' +
        'btn-danger fas fa-trash"></a></a></div><div class="form-check">' +
        '<input type="checkbox" class="form-check-input" id="required"><label class="form-check-label" for="required">Required</label></div> </div> </div>'
    );
  } else if (type == "radio") {
    //Radio Card
    var myCol = $('<div class="card" id = question' + questionNumber + ' "><div class="card-body">  ' +
        '<input type = "text" id = "myText" placeholder="Enter question here:" class="card-title question-title"/>    ' +
        '<div id="contentPanel' + questionNumber + '">  </div><a href="#"  id = ' +
        questionNumber + ' onclick="addExtraRadio(this.id)" class="btn btn-primary btn-success fas fa-plus"></a>' +
        '<div class="d-grid gap-2 d-md-flex justify-content-md-end">  <a href="#" class="btn btn-primary fas fa-check"></a>' +
        '  <a href="#" id = ' + questionNumber + ' onclick="deleteCard(this.id)" class="btn btn-primary btn-danger fas fa-trash"></a>  ' +
        '</div>  <div class="form-check">  <input type="checkbox" class="form-check-input" id="required">    ' +
        '<label class="form-check-label" for="required">Required</label></div></div></div>');
  }
  /*
  var url = window.location.href;
  url.indexOf('?');
  */

  //Appends to questionPanel
  myCol.appendTo('#questionPanel');
  questionNumber++;
  numberOfQuestions++;
};
var numberOfOptions = 1;

//Adds an extra radio button
function addExtraRadio(id) {

  var div = $('<div class="cardParent" id = option' + numberOfOptions + ' ></div>');
  var myCol = $('<p class="card-text"><input type = "text" id =' + numberOfOptions + ' placeholder="Enter option here..." class="card-title option"/></p>\n');
  var deleteButton = $('<a href="#" id = ' + numberOfOptions + ' onclick="deleteRadio(this.id)" class="btn btn-primary btn-secondary fas fa-times onclick="" btn-delete close" style="margin-left: 20px;"></a>');
  deleteButton.appendTo(myCol);
  myCol.appendTo(div);
  div.appendTo('#contentPanel' + id);
  numberOfOptions++;
}
// Deletes the card
function deleteCard(deleteCardId) {
  document.getElementById('question' + deleteCardId).remove();
  numberOfQuestions--;
};

// Deletes the radio button
function deleteRadio(deleteNumberofOption) {
  document.getElementById('option' + deleteNumberofOption).remove();
};

//Runs when text button has been pressed
$("#btnText").click(function() {
  document.getElementById('newQuestion').style.visibility = 'hidden';
  addCols('1', 'text');
  
});

//Runs when Radio button has been pressed
$("#btnRadio").click(function() {
  addCols('1', 'radio');
  document.getElementById('newQuestion').style.visibility = 'hidden';
});
