window.onload = function() {
    const addNewIcon = document.querySelector('.fa-add');
    const magnifyingGlassIcon = document.querySelector('.fa-magnifying-glass');
    const addNewButton = document.querySelector('.add-new-btn');
    const searchContainer = document.querySelector('.search-container');
    const searchBar = document.querySelector('#search-input');
    // Show search input and hide add new button when magnifying glass icon is clicked
    magnifyingGlassIcon.addEventListener('click', function() {
        magnifyingGlassIcon.style.display = 'none';
        addNewButton.style.display = 'none';
        addNewIcon.style.display = 'inline-block';
        searchContainer.style.display = 'flex';
     });

    // Show add new button and hide search input when add new button is clicked
    
    addNewIcon.addEventListener('click', function() {
        magnifyingGlassIcon.style.display = 'inline-block';
        addNewIcon.style.display = 'none';
        searchContainer.style.display = 'none';
        addNewButton.style.display = 'block';
    });

    searchBar.addEventListener('keyup', searchTable);

    function searchTable() {
        const input = document.querySelector('input[type="text"]');
        const filter = input.value.toUpperCase();
        const table = document.querySelector('.search-table');
        const rows = table.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
          const reservationIdCell = rows[i].querySelector('td:nth-child(1)');
          if (reservationIdCell) {
            const reservationId = reservationIdCell.textContent;
            if (reservationId.toUpperCase().indexOf(filter) > -1) {
              rows[i].style.display = '';
            } else {
              rows[i].style.display = 'none';
            }
          }
        }
    }
}
