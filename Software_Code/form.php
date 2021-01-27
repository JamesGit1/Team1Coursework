<div class="card" id = "jess do this">
    <div class="card-body">
        <form action="" name="textQuestion" method="POST"> 
            <input type = "text" id = "myText" placeholder="Enter question here:" class="card-title question-title"/>
            <p class="card-text"><em>Answer here</em></p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <!-- The links to the php forms should be entered here -->
                <button value="submit" name="submit" onclick="tickButton()">Submit</button>
                <a href="#" class="btn btn-primary btn-danger fas fa-trash"></a>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="required">
                <label class="form-check-label" for="required">Required</label>
            </div>
        </form>
    </div>
</div>
<?php
    if(isses)
?>