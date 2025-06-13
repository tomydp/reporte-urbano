// js/login.js
const form = document.getElementById('loginForm');
const btn = document.getElementById('btnLogin');
const errorMsg = document.getElementById('errorMsg');

form.addEventListener('submit', async (e) => {
    e.preventDefault();
    btn.disabled = true;
    errorMsg.textContent = '';

    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;

    try {
        const res = await fetch('/api/login', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email, password })
        });
        const data = await res.json();
        if (!res.ok) throw new Error(data.message || 'Error desconocido');

        if (data.token) localStorage.setItem('authToken', data.token);
        window.location.href = data.admin ? '/admin/dashboard' : '/user/dashboard';

    } catch (err) {
        errorMsg.textContent = err.message;
    } finally {
        btn.disabled = false;
    }
});