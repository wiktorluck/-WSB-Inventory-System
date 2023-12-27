var modal3 = document.getElementById("myModal");
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("closeP")[0];

btn.onclick = function () {
  modal3.style.display = "block";
};
span.onclick = function () {
  modal3.style.display = "none";
};

window.onclick = function (event) {
  if (event.target == modal3) {
    modal3.style.display = "none";
  }
};

$(document).ready(function () {
  $(".edit-inventory").click(function (e) {
    e.preventDefault();
    var id = $(this).data("id");

    $.ajax({
      url: "editinventoryModal.php",
      method: "POST",
      data: { id: id },
      success: function (response) {
        $("#myModal .modal-contentP p").html(response);
        $("#myModal").show();
      },
      error: function (xhr, status, error) {
        console.error(status + ": " + error);
      },
    });
  });
});

$(document).ready(function () {
  $("#updateInventoryForm").submit(function (e) {
    e.preventDefault();
    var formData = $(this).serialize();

    $.ajax({
      url: "editinventory.php",
      method: "POST",
      data: formData,
      success: function (response) {
        location.reload();
      },
      error: function (xhr, status, error) {
        console.error(status + ": " + error);
      },
    });
  });
});

// CLOSE MODAL
$(document).ready(function () {
  $(".closeP").click(function () {
    var modal3 = document.getElementById("myModal");
    modal3.style.display = "none";
  });
});
