function handleClick(sender) {
   var value = String(sender.id);
   document.getElementById("toTitle").value = value;
   // alert(value);
   $("#idButton").click();
}