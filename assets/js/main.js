document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("burger").addEventListener("click", function () {
    document.querySelector("nav").classList.toggle("open");
  });
});

const burgerMenu = document.querySelector(".nav__burger-btn");
const body = document.querySelector("body");

// обрабатываем клик по бургер меню
burgerMenu.addEventListener("click", () => {
  // добавляем класс menu-opened, чтобы меню было видимо
  body.classList.toggle("menu-opened");

  // убираем скролл вниз, чтобы пользователь не мог двигать страницу
  body.classList.toggle("menu-closed");
});

// получаем все кнопки и все дивы
const buttons = document.querySelectorAll(".button");
const divs = document.querySelectorAll(".div");

// скрываем все дивы

$(document).ready(function () {
  // console.log(divs[0].id);

  divs.forEach((div) => {
    div.style.display = "none";
  });

  // console.log(firstItemID.target);
  let firstItemID = divs[0].dataset;
  let blocks = document.querySelectorAll('[data-id="' + firstItemID.id + '"]');
  // console.log(blocks);
  blocks.forEach((item) => {
    item.style.display = "block";
  });
});

// добавляем обработчики клика на кнопки
buttons.forEach((button) => {
  button.addEventListener("click", () => {
    // отображаем только тот див, который привязан к нажатой кнопке
    const div = document.querySelectorAll(button.dataset.target);
    console.log(div);
    divs.forEach((item) => {
      item.style.display = "none";
    });
    div.forEach((item) => {
      item.style.display = "block";
    });
  });
});
