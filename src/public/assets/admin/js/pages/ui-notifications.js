/**
 * Template Name: Paces - Admin & Dashboard Template
 * By (Author): Coderthemes
 * Module/App (File Name): UI Notifications
 * Version: 1.5.0
 */

const toastTrigger = document.querySelector("#liveToastBtn")
const toastLiveExample = document.querySelector("#liveToast")

if (!toastTrigger || !toastLiveExample) {
    console.error("UI Notifications: Elements not found.")
}

const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
toastTrigger.addEventListener("click", () => {
    toastBootstrap.show()
})
