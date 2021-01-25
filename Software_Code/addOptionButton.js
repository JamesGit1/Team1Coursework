button = document.getElementById("addOption");
// 3. Add event handler
button.addEventListener ("click", function() {
    document.write("<p className='card-text'><input type='text' id='option' placeholder='Enter option here...' " +
        "className='card-title option'/></p>");
});