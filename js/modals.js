$(document).ready(function () {
  const notificationBar = $("#notificationBar");
  notificationBar.show();

  setTimeout(function () {
    notificationBar.hide();
  }, 3000);
});
