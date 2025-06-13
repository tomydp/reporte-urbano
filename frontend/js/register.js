document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('registerForm');
  const messageBox = document.getElementById('message');

  form.addEventListener('submit', function (e) {
    e.preventDefault(); // Evita el envío por defecto

    const name = form.name.value.trim();
    const email = form.email.value.trim();
    const password = form.password.value;
    const confirmPassword = form.confirm_password.value;

    // Limpiar mensaje anterior
    messageBox.textContent = '';
    messageBox.style.color = '#ffeaa7'; // color neutro para mensajes

    // Validaciones
    if (!name || !email || !password || !confirmPassword) {
      messageBox.textContent = 'Por favor completa todos los campos.';
      return;
    }

    if (password.length < 6) {
      messageBox.textContent = 'La contraseña debe tener al menos 6 caracteres.';
      return;
    }

    if (password !== confirmPassword) {
      messageBox.textContent = 'Las contraseñas no coinciden.';
      return;
    }

    // Si pasó todas las validaciones
    messageBox.style.color = 'lightgreen';
    messageBox.textContent = '¡Formulario válido! (listo para enviar cuando tengas la API)';
    form.reset();
  });

  // Mostrar/ocultar contraseñas
  document.getElementById('show_password').addEventListener('change', function () {
    const passwordField = document.getElementById('password');
    const confirmField = document.getElementById('confirm_password');
    const type = this.checked ? 'text' : 'password';

    passwordField.type = type;
    confirmField.type = type;
  });
});
