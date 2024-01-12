//Other Notifications
$(document).ready(function () {
  const notificationBar = $("#notificationBar");
  notificationBar.show();

  setTimeout(function () {
    notificationBar.hide();
  }, 3000);
});

//Reset Password JS
$(document).ready(function () {
  const notificationBar = $("#notificationBar2");
  notificationBar.show();
});

$(document).ready(function () {
  $(".closeP").click(function () {
    var modal = document.getElementById("notificationBar2");
    modal.style.display = "none";
  });
});


      

