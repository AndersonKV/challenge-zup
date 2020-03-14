$(".screen-back").on("click", function(e) {
  window.location.href = `/home`;
});

$(".screen-name").mouseenter(function() {
  $(".title").text("Hi, My name is");
  $(".sub-title").text(name);
});
$(".screen-email").mouseenter(function() {
  $(".title").text("My email adress is");
  $(".sub-title").text(email);
});
$(".screen-calendar").mouseenter(function() {
  $(".title").text("My birthday is");
  $(".sub-title").text(birthday);
});
$(".screen-city").mouseenter(function() {
  $(".title").text("My address is");
  $(".sub-title").text(address);
});
$(".screen-phone").mouseenter(function() {
  $(".title").text("Hi phone number is");
  $(".sub-title").text(phone_number);
});
$(".screen-key").mouseenter(function() {
  $(".title").text("My password is");
  $(".sub-title").text(password);
});
