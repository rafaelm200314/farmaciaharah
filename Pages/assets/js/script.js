function sortTable(column, sort_asc) {
  [...table_rows]
    .sort((a, b) => {
      let first_row = a.querySelectorAll("td")[column].textContent.trim();
      let second_row = b.querySelectorAll("td")[column].textContent.trim();

      // Convert dates to sortable format (YYYY-MM-DD)
      let first_date = convertToDate(first_row);
      let second_date = convertToDate(second_row);

      // Compare dates
      if (sort_asc) {
        return first_date.getTime() - second_date.getTime();
      } else {
        return second_date.getTime() - first_date.getTime();
      }
    })
    .forEach((sorted_row) =>
      document.querySelector("tbody").appendChild(sorted_row)
    );
}

// Function to convert date string to Date object
function convertToDate(dateString) {
  let parts = dateString.split("-");
  let year = parseInt(parts[2], 10);
  let month = parseInt(parts[0], 10) - 1; // Months are zero-based
  let day = parseInt(parts[1], 10);
  return new Date(year, month, day);
}

const search = document.querySelector(".input-group input"),
  table_rows = document.querySelectorAll("tbody tr"),
  table_headings = document.querySelectorAll("thead th");

// 1. Searching for specific data of HTML table
search.addEventListener("input", searchTable);

function searchTable() {
  table_rows.forEach((row, i) => {
    let table_data = row.textContent.toLowerCase(),
      search_data = search.value.toLowerCase();

    // Toggle hide class based on search match
    row.classList.toggle("hide", table_data.indexOf(search_data) < 0);
    // Set delay for animation effect
    row.style.setProperty("--delay", i / 25 + "s");
  });

  // Alternating row background colors for visible rows
  document.querySelectorAll("tbody tr:not(.hide)").forEach((visible_row, i) => {
    visible_row.style.backgroundColor =
      i % 2 == 0 ? "transparent" : "#0000000b";
  });
}

// 2. Sorting | Ordering data of HTML table

table_headings.forEach((head, i) => {
  let sort_asc = true;
  head.onclick = () => {
    // Reset active class for all headings
    table_headings.forEach((head) => head.classList.remove("active"));
    head.classList.add("active");

    // Reset active class for all cells
    document
      .querySelectorAll("td")
      .forEach((td) => td.classList.remove("active"));
    // Add active class to cells in the clicked column
    table_rows.forEach((row) => {
      row.querySelectorAll("td")[i].classList.add("active");
    });

    // Toggle asc class based on sorting direction
    head.classList.toggle("asc", sort_asc);
    // Update sorting direction
    sort_asc = head.classList.contains("asc") ? false : true;

    // Sort the table based on the clicked column
    sortTable(i, sort_asc);
  };
});
