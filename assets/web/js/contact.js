// script.js
const form = document.querySelector('form');
form.addEventListener('submit', handleSubmit);

function handleSubmit(event) {
  event.preventDefault(); // Evita o envio padrão do formulário

  // Obtenha os valores dos campos do formulário
  const name = document.getElementById('name').value;
  const email = document.getElementById('email').value;
  const message = document.getElementById('message').value;

  // Faça algo com os valores (por exemplo, enviar para o backend)
  console.log('Nome:', name);
  console.log('E-mail:', email);
  console.log('Mensagem:', message);

  // Limpe o formulário
  form.reset();
}
