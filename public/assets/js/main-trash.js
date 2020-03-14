//adiciona a cor red no aside div
$("#trash").addClass("text-red");
//adiciona a todos os perfis o blocked mouse
$(".out-side--perfil--three-icon")
  .find("#user-trash")
  .addClass("blocked-mouse");

$(".out-side--perfil").click(function(e) {
  const row = this.parentElement;
  window.location.href = `/screen?=${row.id}`;
});
//SUBMIT TODO
$(".out-side--perfil--three-icon #user-todo").on("click", function(event) {
  const id = this.parentElement.parentElement.id;

  console.log(id);
  $.post(
    "setTodo",
    {
      todo: id
    },
    function(data) {
      console.log("Data: " + data);
    }
  );
  const div = this.parentElement.parentElement;
  $(`#${id}`).addClass("none");
});

//SUBMIT ATTENDED
$(".out-side--perfil--three-icon #user-attended").on("click", function(event) {
  const id = this.parentElement.parentElement.id;

  $.post(
    "setAttended",
    {
      attended: id
    },
    function(data) {
      console.log("Data: " + data);
    }
  );
  const div = this.parentElement.parentElement;
  $(`#${id}`).addClass("none");
});

$(".aside-div div span").on("click", function(event) {
  switch (this.id) {
    case "todos":
      window.location.href = `/home `;
      break;
    case "attended":
      window.location.href = `/attended `;
      break;
    case "trash":
      window.location.href = `/trash `;
      break;
    default:
    // code block
  }
});
// $(".aside-div div span:nth-child(2)").on("click", function(event) {
//     console.log('2')

//     //window.location.href = ` / attended `;

// });
// $(".aside-div:nth-child(3)").on("click", function(event) {
//     window.location.href = ` / trash `;

// });

$("#search").on("keypress", function(e) {
  if (e.which == 13) {
    window.location.href = ` / search `;
    console.log($("input:text").val());
    //console.log(this + '[data-action]');
  }
});

$(".fa-user-circle").click(function() {
  console.log("oi");
  window.location.href = ` /sair `;
});
$(".out-side--perfil").click(function() {
  //window.location.href = ` / user `;
});
