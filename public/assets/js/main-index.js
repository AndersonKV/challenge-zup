//esconde o form-login e mostra o form-register
$(".btn-register").click(function() {
  $(".form-login .email").val("");
  $(".form-login .password").val("");

  $(".form-login").addClass("none");
  $(".form-register").removeClass("none");
  //console.log($(this).hasClass("none"))
});
//esconde o form-register e form-login
$(".btn-back").click(function() {
  $(".form-login .email").val("");
  $(".form-login .password").val("");

  $(".form-login").removeClass("none");
  $(".form-register").addClass("none");
});

//data completa
const date = new Date();
//mes
const month = date.getMonth();
//ano
const dateFullYear = date.getFullYear();

//pega todos os dias do mes
function daysInMonth(month, year) {
  return new Date(year, month, 0).getDate();
}

//dias
const days = daysInMonth(month, dateFullYear);

function setDayInMonth(setDays) {
  const countDay = [];
  //conta os dias do mes e repassa para countDay
  for (i = 1; i <= setDays; ++i) {
    countDay.push(i);
  }

  const templateStringDay = countDay
    .map((day, index) => {
      return `<option value="${day}">${day}</option>`;
    })
    .join("");

  //seta id e name do select
  const select = document.createElement("select");
  select.id = "day";
  select.name = "day";
  select.innerHTML = templateStringDay;

  const verifyDayExist = document.querySelector("#day");
  //faz a verificação se select ja existe, se sim remove e adiciona novo
  if (verifyDayExist != null) {
    verifyDayExist.remove();
  }

  document
    .querySelector(".form-calendar")
    .insertBefore(
      select,
      document.querySelector(".form-calendar").childNodes[0]
    );
}

function GetMonth(props) {
  const model = `
             <option value="0 January" name="January">January</option>
             <option value="1 February" name="February">February</option>
             <option value="2 March">March</option>
             <option value="3 April">April</option>
             <option value="4 May">May</option>
             <option value="5 June">June</option>
             <option value="6 July">July</option>
             <option value="7 August">August</option>
             <option value="8 September">September</option>
             <option value="9 October">October</option>
             <option value="10 November">November</option>
             <option value="11 December">December</option>
             `;

  const select = document.createElement("select");
  //  select.id = 'month';
  select.name = "month";
  select.innerHTML = model;
  document.querySelector(".form-calendar").appendChild(select);

  select.addEventListener("change", function(event) {
    const mes = this.value.split(" ");
    //divide e o primeiro indice é o numero do mes
    setDayInMonth(daysInMonth(mes[0], dateFullYear));
  });
}

function GetYear(props) {
  let countYear = [];
  let i;

  for (i = 1900; i <= dateFullYear; i++) {
    countYear.push(i);
  }

  const templateStringYear = countYear
    .map((year, index) => {
      return `<option value="${year}">${year}</option>`;
    })
    .join("");

  const select = document.createElement("select");
  select.id = "year";
  select.name = "year";
  select.innerHTML = templateStringYear;
  document.querySelector(".form-calendar").appendChild(select);
}

//seta os dias no form
setDayInMonth(daysInMonth(0, dateFullYear));
//seta os meses
GetMonth();
//seta os anos
GetYear();

$("#phone_number").on("keyup", function(e) {
  const number = document.querySelector("#phone_number");
  const numberFormated = number.value.replace(
    /(\d{3})(\d{4})(\d{4})/,
    "($1)-$2-$3"
  );
  $("input#phone_number").val(`${numberFormated}`);
  console.log(number.value.length);
});
