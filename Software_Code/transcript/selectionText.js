function getSelectionText() {
    var text = "";

    var activeEl = document.activeElement;
    var activeElTagName = activeEl ? activeEl.tagName.toLowerCase() : null;
    if (
        (activeElTagName == "textarea") || (activeElTagName == "input" &&
            /^(?:text|search|password|tel|url)$/i.test(activeEl.type)) &&
        (typeof activeEl.selectionStart == "number")
    ) {
        text = activeEl.value.slice(activeEl.selectionStart, activeEl.selectionEnd);
    } else if (window.getSelection) {
        text = window.getSelection().toString();
    }
    return text;
}

document.onselectionchange = function () {
    var lastSelected;
    lastSelected = getSelectionText();
    if (!isEmpty(lastSelected)) {
        document.getElementById("sel").value = lastSelected;
    }

};

function auto_grow(element) {
    element.style.height = "5px";
    element.style.height = (element.scrollHeight) + "px";
}
function isEmpty(str) {
    return (!str || 0 === str.length);
} 
