var modal1 = document.getElementById("myModal1");
var btn = document.getElementById("myBtn1");
var span = document.getElementsByClassName("closeD")[0];


  btn.onclick = function() {
    modal1.style.display = "block";
  }
  span.onclick = function() {
    modal1.style.display = "none";
  }

  window.onclick = function(event) {
    if (event.target == modal1) {
      modal1.style.display = "none";
    }
  }

  $(document).ready(function() {
      $('.delete-user').click(function(e) {
          e.preventDefault();
          var id = $(this).data('id');

          $.ajax({
              url: 'deleteuserModal.php',
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
    $('#deleteUserForm').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: 'deleteuser.php',
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
      var modal1 = document.getElementById("myModal1");
      modal1.style.display = "none";
  });
});

$(document).ready(function() {
  $('.closeD1').click(function() {
      var modal1 = document.getElementById("myModal1");
      modal1.style.display = "none";
  });
});
