/**
 * Template Name: Paces - Admin & Dashboard Template
 * By (Author): Coderthemes
 * Module/App (File Name): UI Modals
 * Version: 1.5.0
 */

const exampleModal = document.getElementById("exampleModal")
const modalTitle = exampleModal?.querySelector(".modal-title")
const modalBodyInput = exampleModal?.querySelector(".modal-body input")

if (!exampleModal || !modalTitle || !modalBodyInput) {
    console.error("UI Modals: Elements not found.")
}

exampleModal.addEventListener("show.bs.modal", (event) => {
    // Button that triggered the modal
    const button = event.relatedTarget
    // Extract info from data-bs-* attributes
    const recipient = button?.getAttribute("data-bs-whatever") || ""

    // Update the modal's content.
    modalTitle.textContent = `New message to ${recipient}`
    modalBodyInput.value = recipient
})
