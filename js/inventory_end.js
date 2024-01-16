var modal1 = document.getElementById("myModal3");
var btn1 = document.getElementById("myBtn3");
var span1 = document.getElementsByClassName("closeD")[0];

btn1.onclick = function () {
  modal1.style.display = "block";
};
span1.onclick = function () {
  modal1.style.display = "none";
};

window.onclick = function (event) {
  if (event.target == modal1) {
    modal1.style.display = "none";
  }
};


//Checked unchecked positions

var modal4 = document.getElementById("myModal4");
var btn4 = document.getElementById("myBtn4");
var span4 = document.getElementsByClassName("clodeD")[0];

$(document).ready(function() {
   $('#sumujBtn').on('click', function(e) {
      e.preventDefault();

      $.ajax({
         url: 'checkUncheckedPositions.php',
         type: 'GET',
         success: function(response) {
            if (response === 'true') {
                  window.location.href = 'summaryinventory.php';
            } else {
               $('#endInventoryForm').submit();
            }
         },
         error: function() {
           console.error('AJAX Error:', status, error);
         }
      });
   });
});
