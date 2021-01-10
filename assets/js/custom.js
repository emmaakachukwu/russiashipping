document.addEventListener("DOMContentLoaded", function() {
    let searchBtn = document.querySelector('#search-btn')
    let searchForm = document.querySelector('#search-form')
    let searchInput = document.querySelector('#search-input')
    let searchError = document.querySelector('#search-error')
    searchBtn.addEventListener('click', function() {
        if ( searchInput.value.trim() != '' )
            searchForm.submit()
        else
            searchError.innerText = 'Tracking ID input is empty'
    })
})