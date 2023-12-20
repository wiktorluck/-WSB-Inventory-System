var modal = document.getElementById("myModal1");
var btn = document.getElementById("myBtn1");
var span = document.getElementsByClassName("closeD")[0];


  btn.onclick = function() {
    modal.style.display = "block";
  }
  span.onclick = function() {
    modal.style.display = "none";
  }

  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }

  $(document).ready(function() {
      $('.delete-product').click(function(e) {
          e.preventDefault();
          var id = $(this).data('id');

          $.ajax({
              url: 'deleteproductModal.php',
              method: 'POST',
              data: { id: id },
              success: function(response) {
                $('#myModal1 .modal-contentD p').html(response);
                $('#myModal1').show();
              },
              error: function(xhr, status, error) {
                  console.error(status + ": " + error);
              }
          });
      });
  });

  $(document).ready(function() {
    $('#deleteForm').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: 'deleteproduct.php',
            method: 'POST',
            data: formData,
            success: function(response) {
              location.reload();
            },
            error: function(xhr, status, error) {
                console.error(status + ": " + error);
            }
        });
    });
});

// CLOSE MODAL
$(document).ready(function() {
  $('.closeD').click(function() {
      var modal = document.getElementById("myModal1");
      modal.style.display = "none";
  });
});
