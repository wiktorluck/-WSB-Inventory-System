var modal2 = document.getElementById("myModal2");
var btn2 = document.getElementById("myBtn2");
var span2 = document.getElementsByClassName("closeA")[0];

btn2.onclick = function () {
  modal2.style.display = "block";
};
span2.onclick = function () {
  modal2.style.display = "none";
};

window2.onclick = function (event) {
  if (event.target == modal2) {
    modal2.style.display = "none";
  }
};
