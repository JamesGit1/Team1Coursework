<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<nav class="navbar navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Home</a>
  </div>
</nav>

<body>
  <div class="container">
    <div class="row">
      <form>
        <h1><u> New Form</u></h1>
        <p>Enter description of project here</p>
        <div id="questionPanel">

        </div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
          Add New Question
        </button>

      </form>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Question Type</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <a href="#" id="btnText" class="btn btn-primary">Text Based</a>
            <a href="#" id="btnRadio" class="btn btn-primary">Radio Button</a>
            <button type="button" class="btn btn-primary">Drop Down</button>
            <a href="#" id="test" class="btn btn-primary">Test Button</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <img src="logo.png" class="fix">
</body>


</html>
<script src="addOptionButton.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script>
  var questionNumber = 1;
  var addCols = function(num, type) {
    if (type == "text") {
      var myCol = $('<div class="card" id = ' + questionNumber +' "><div class="card-body"><input type = "text" id =' + questionNumber +
        ' placeholder="Enter question here:" class="card-title question-title"/><p class="card-text"><em>Answer here</em></p><div class="d-grid gap-2 d-md-flex justify-content-md-end"><a href="#"  id = "btnGen" class="btn btn-primary fas fa-check"></a><a href="#" class="btn btn-primary btn-danger fas fa-trash"></a></div><div class="form-check"><input type="checkbox" class="form-check-input" id="required"><label class="form-check-label" for="required">Required</label></div>    </div>   </div>'
      );
    } else if (type == "radio") {
      alert("Radio");
        var myCol = $('<div class="card" id = ' + questionNumber +' "><div class="card-body">  <input type = "text" id = "myText" placeholder="Enter question here:" class="card-title question-title"/>  <div id="contentPanel">  </div> <a href="#" onclick="addExtraRadio()" id = "btnGen" class="btn btn-primary btn-success fas fa-plus" id="addOption"></a>  <div class="d-grid gap-2 d-md-flex justify-content-md-end"><a href="#" class="btn btn-primary fas fa-check"></a><a href="#" class="btn btn-primary btn-danger fas fa-trash"></a>  </div><div class="form-check"><input type="checkbox" class="form-check-input" id="required"><label class="form-check-label" for="required">Required</label></div></div></div>');
    }
    myCol.appendTo('#questionPanel');
    questionNumber++;
  };

  function addExtraRadio() {
  var numberOfOptions = 1;
  var myCol = $('<p class="card-text"><input type = "text" id =' + numberOfOptions + ' placeholder="Enter option here..." class="card-title option"/></p>\n');
  var deleteButton = $('<a href="#" class="btn btn-primary btn-secondary fas fa-times" style="margin-left: 20px;"></a>');
  deleteButton.appendTo(myCol);
  myCol.appendTo('#contentPanel');
  numberOfOptions++;
}

  $("#btnText").click(function() {
    alert("test1");
    addCols('1', 'text');
  });

  $("#btnRadio").click(function() {
    alert("test2");
    addCols('1', 'radio');
  });

  $("#btnGen").click(function() {
    alert("test3");
  });


</script>
