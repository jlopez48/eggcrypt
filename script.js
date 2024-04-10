document.addEventListener("DOMContentLoaded", function() {
  var checkbox = document.getElementById("reg-log");


  checkbox.addEventListener("change", function() {
    if (checkbox.checked) {
      checkbox.checked = false;
    } else {
      checkbox.checked = true;
    }
  });
});