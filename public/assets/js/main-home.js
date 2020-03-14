$("#todos").addClass("text-todo");

$(".out-side--perfil--three-icon")
  .find("#user-todo")
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
$(".out-side--perfil--three-icon #user-todo").on("click", function(event) {});

//SUBMIT ATTENDED
$(".out-side--perfil--three-icon #user-attended").on("click", function(event) {
  const row = this.parentElement.parentElement;

  $.post(
    "setAttended",
    {
      attended: row.id
    },
    function(data) {
      console.log("Data: " + data);
    }
  );

  $(`#${row.id}`).hide("slow");
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
