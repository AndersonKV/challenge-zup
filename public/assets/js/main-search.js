$(".fa-search").addClass("lupa");
//ao clicar no usuario envia para rota screen
$(".out-side--perfil").click(function(e) {
  const row = this.parentElement;
  window.location.href = `/screen?=${row.id}`;
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

$(".fa-user-circle").click(function() {
  window.location.href = ` /sair `;
});
