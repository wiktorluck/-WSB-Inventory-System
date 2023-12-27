var table = document.getElementById("table_products");
var rowsPerPage = 2;

function showPage(page) {
  var startIndex = (page - 1) * rowsPerPage;
  var endIndex = startIndex + rowsPerPage;
  var rows = Array.from(table.getElementsByTagName("tbody")[0].rows);

  rows.forEach(function (row, index) {
    row.style.display = index >= startIndex && index < endIndex ? "" : "none";
  });
}

function setupPagination() {
  var totalRows = table.getElementsByTagName("tbody")[0].rows.length;
  var totalPages = Math.ceil(totalRows / rowsPerPage);
  var paginationContainer = document.getElementById("pagination-container");

  for (var i = 1; i <= totalPages; i++) {
    var li = document.createElement("li");
    li.textContent = i;
    li.addEventListener("click", function () {
      showPage(parseInt(this.textContent));
    });
    paginationContainer.appendChild(li);
  }
}
showPage(1);
setupPagination();
