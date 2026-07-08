/**
 * Template Name: Paces - Admin & Dashboard Template
 * By (Author): Coderthemes
 * Module/App (File Name): Apps Kanban
 * Version: 1.5.0
 */
document.addEventListener("DOMContentLoaded", () => {
    const sortableElements = document.querySelectorAll('[data-plugins="sortable"]')
    if (sortableElements.length === 0) {
        console.error('Apps Kanban: Elements with data-plugins="sortable" not found.')
        return
    }
    sortableElements.forEach((el) => {
        new Sortable(el, {
            animation: 150,
            group: "shared",
            ghostClass: "sortable-item-ghost",
            forceFallback: true,
            emptyInsertThreshold: 100,
            chosenClass: "sortable-item-active",
        })
    })
})
