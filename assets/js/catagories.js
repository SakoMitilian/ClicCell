document.addEventListener('DOMContentLoaded', function () {
    let filters = document.querySelectorAll('#portfolio-flters li');
    let items = document.querySelectorAll('.portfolio-item');
  
    filters.forEach(function (filter) {
      filter.addEventListener('click', function () {
        // Remove active class from all filters
        filters.forEach(function (filter) {
          filter.classList.remove('filter-active');
        });
  
        // Add active class to the clicked filter
        this.classList.add('filter-active');
  
        // Get the filter value
        let filterValue = this.getAttribute('data-filter');
  
        // Show/Hide items based on the filter
        items.forEach(function (item) {
          if (filterValue === '*' || item.classList.contains(filterValue.substr(1))) {
            item.style.display = 'block';
          } else {
            item.style.display = 'none';
          }
        });
      });
    });
  });