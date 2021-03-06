// Defining constants
const openModalButtons = document.querySelectorAll('[data-modal-target]')
const closeModalButtons = document.querySelectorAll('[data-close-button]')
const overlay = document.getElementById('overlay')

openModalButtons.forEach(button => {
    button.addEventListener('click', () => {
        const modal = document.querySelector(button.dataset.modalTarget)
        openModal(modal)
    })
})
//Adds listerners for overlay and closes modal
overlay.addEventListener('click', () => {
    const modals = document.querySelectorAll('.modal.active')
    modals.forEach(modal => {
        closeModal(modal)
    })
})

//Adds listerners for Button and closes modal
closeModalButtons.forEach(button => {
    button.addEventListener('click', () => {
        const modal = button.closest('.active')
        closeModal(modal)
    })
})

//Opens the Modal
function openModal(modal) {
    if (modal == null) return
    modal.classList.add('active')
    overlay.classList.add('active')
}

//Closes the Modal
function closeModal(modal) {
    if (modal == null) return
    modal.classList.remove('active')
    overlay.classList.remove('active')
}

// Adds event listner to checkbox and disable button until checked
document.getElementById("ethics").addEventListener("click", function () {


    if (document.getElementById("ethics").checked) {
        document.getElementById("continue").disabled = false;
    } else {
        document.getElementById("continue").disabled = true;
    }
})
// Redirect
document.getElementById("continue").addEventListener("click", function () {
    document.location.href = "../formAnswering/submitAnswers.php";
});
