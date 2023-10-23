var mpd1 = document.querySelector(".mpd1");
var mpd2 = document.querySelector(".mpd2");
mpd2.onkeyup = function () {
  message_error = document.querySelector(".message_error");
  if (mpd1.value != mpd2.value) {
    message_error.innerText = "les mots de passe ne sont pas comformes";
  } else {
    message_error.innerText = "";
  }
};
