// numbers the questions
var questionNumber = 1;
// keeps track of the number of questions
var numberOfQuestions = 0;
var currentRadio = 0;
//Adds the card depending on Condition
var addCols = function(num, type) {
  if (type == "text") {
    // Text Card
    var myCol = $('<div class="card"  id = question' + questionNumber + '><div class="card-body"><form name="submitQuestions" method="POST"><input type = "text" id =' + questionNumber + ' name="questionText" placeholder="Enter question here:" class="card-title question-title"/><p class="card-text"><em>Answer here</em></p><div class="d-grid gap-2 d-md-flex justify-content-md-end"><button class="btn btn-primary" value="submit" name="submitQuestions" id ="submitQuestion" onclick="myFunction()">Submit</button><a href="#" id = ' + questionNumber + ' onclick="deleteCard(this.id)" class="btn btn-primary btn-danger fas fa-trash"></a></div><div class="form-check"><input name = "required" type="checkbox" class="form-check-input" id="required"><label class="form-check-label" for="required">Required</label></div></form></div></div>');
  } else if (type == "radio") {
    //Radio Card
    var myCol = $('<div class="card" id = question' + questionNumber + ' "><div class="card-body"><form name="radioQuestions" method="POST">  ' +
      '<input type = "text" name="questionText" id = "myText" placeholder="Enter question here:" class="card-title question-title"/>    ' +
      '<div id="contentPanel' + questionNumber + '">  </div><a href="#"  id = ' +
      questionNumber + ' onclick="addExtraRadio(this.id)" class="btn btn-primary btn-success fas fa-plus"></a>' +
      '<div class="d-grid gap-2 d-md-flex justify-content-md-end"><button class="btn btn-primary" value="submit" name="submitRadioQuestions" id ="submitQuestion">Submit</button>' +
      '  <a href="#" id = ' + questionNumber + ' onclick="deleteCard(this.id)" class="btn btn-primary btn-danger fas fa-trash"></a>  ' +
      '</div>  <div class="form-check"> <input type = "text" id ="idNumbers" name="idNumbers" placeholder="Enter question here:" class="card-title question-title"/> <input type="checkbox" class="form-check-input" id="required">    ' +
      '<label class="form-check-label" for="required">Required</label></div></form></div></div>');
  }

  //Appends to questionPanel
  myCol.appendTo('#questionPanel');
  questionNumber++;
  numberOfQuestions++;
};
var numberOfOptions = 1;

//Adds an extra radio button
function addExtraRadio(id) {

  var div = $('<div class="cardParent" id = option' + numberOfOptions + ' ></div>');
  var myCol = $('<p class="card-text"><input type = "text" name =' + numberOfOptions + ' placeholder="Enter option here..." class="card-title option"/></p>\n');
  var deleteButton = $('<a href="#" id = ' + numberOfOptions + ' onclick="deleteRadio(this.id)" class="btn btn-primary btn-secondary fas fa-times btn-delete close" style="margin-left: 20px;"></a>');
  deleteButton.appendTo(myCol);
  myCol.appendTo(div);
  div.appendTo('#contentPanel' + id);
  if (numberOfOptions == 1) {
    idNumbers.value += numberOfOptions;
  } else {
    idNumbers.value += "," + numberOfOptions;
  }
  numberOfOptions++;
  currentRadio++;
}
// Deletes the card
function deleteCard(deleteCardId) {
  document.getElementById('question' + deleteCardId).remove();
  document.getElementById('newQuestion').style.visibility = 'visible';
  numberOfQuestions--;
};

// Deletes the radio button
function deleteRadio(deleteNumberofOption) {

  document.getElementById('option' + deleteNumberofOption).remove();
  var allIdNumbers = document.getElementById('idNumbers').value
  var deleteLastNumber = numberOfOptions - 1


    allIdNumbers = allIdNumbers.replace(deleteNumberofOption + ",", '');
    if(deleteNumberofOption == deleteLastNumber){
    allIdNumbers = allIdNumbers.replace(","+deleteNumberofOption, '');
    }
    if(allIdNumbers.includes(",")){
      allIdNumbers = allIdNumbers.replace(deleteNumberofOption,'');
    }
  idNumbers.value = allIdNumbers;
  currentRadio--;
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

function tickButton() {
  document.getElementById("submitQuestion").addEventListener("submit", stopRefresh(event))
  document.getElementById('newQuestion').style.visibility = 'visible';
};

function stopRefresh(e) {
  $("textQuestion").on("submit", function(e) {
    e.preventDefault();
    var dataString = $(this).serialize();

    $.ajax({
      type: "POST",
      url: "submitQuestion.php",
      data: dataString,
    });
  });
  return false;
}
