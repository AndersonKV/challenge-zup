//adiciona a cor red no aside div
$("#attended").addClass("text-green");
//adiciona a todos os perfis o blocked mouse
$(".out-side--perfil--three-icon")
  .find("#user-attended")
  .addClass("blocked-mouse");

//ao clicar no usuario envia para rota screen
$(".out-side--perfil").click(function(e) {
  const row = this.parentElement;
  window.location.href = `/screen?=${row.id}`;
});
//manda todo para lixo
$(".out-side--perfil--three-icon #user-trash").on("click", function(event) {
  const row = this.parentElement.parentElement;
  console.log(row);

  $.post(
    "setTrash",
    {
      trash: row.id
    },
    function(data) {
      console.log("Data: " + data);
    }
  );

  $(`#${row.id}`).hide("slow");
});
//envia usuario para todo
$(".out-side--perfil--three-icon #user-todo").on("click", function(event) {
  const row = this.parentElement.parentElement;

  $.post(
    "setTodo",
    {
      attended: row.id
    },
    function(data) {
      console.log("Data: " + data);
    }
  );

  $(`#${row.id}`).hide("slow");
});

//SUBMIT ATTENDED
$(".out-side--perfil--three-icon #user-attended").on("click", function() {});

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

$(".fa-user-circle").click(function() {
  window.location.href = ` /sair `;
});
