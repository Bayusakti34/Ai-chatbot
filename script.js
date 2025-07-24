document.getElementById("chat-form").addEventListener("submit", function(e) {
  e.preventDefault();
  let input = document.getElementById("user-input");
  let message = input.value;
  appendMessage("user", message);
  input.value = "";

  fetch("chat.php", {
    method: "POST",
    headers: {'Content-Type': 'application/json'},
    body: JSON.stringify({ prompt: message })
  })
  .then(res => res.json())
  .then(data => {
    appendMessage("ai", data.response);
  });
});

function appendMessage(role, text) {
  let box = document.getElementById("chat-box");
  let div = document.createElement("div");
  div.className = "message " + role;
  div.textContent = text;
  box.appendChild(div);
  box.scrollTop = box.scrollHeight;
}
