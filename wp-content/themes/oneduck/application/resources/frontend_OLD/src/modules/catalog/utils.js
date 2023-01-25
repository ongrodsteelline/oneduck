function showLoader() {
    document.querySelector('.js-wrapper').classList.add('loaded_hiding')
}

function hideLoader() {
    document.querySelector('.js-wrapper').classList.remove('loaded_hiding')
}

export {
    showLoader,
    hideLoader
}