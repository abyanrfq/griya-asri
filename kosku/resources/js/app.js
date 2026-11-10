import './bootstrap';

const root = document.documentElement;
function currentTheme() {
  try {
    const s = localStorage.getItem('theme');
    if (s === 'dark' || s === 'light') return s;
  } catch {}
  return root.classList.contains('dark') ? 'dark' : 'light';
}
function setTheme(t) {
  root.classList.toggle('dark', t === 'dark');
  try { localStorage.setItem('theme', t); } catch {}
}
function toggleTheme() {
  const next = currentTheme() === 'dark' ? 'light' : 'dark';
  setTheme(next);
}

document.addEventListener('DOMContentLoaded', () => {
  // Listener dihapus agar tidak bentrok dengan delegasi
});

// Delegasi untuk keandalan jika DOM berubah
document.addEventListener('click', (e) => {
  const t = e.target && e.target.closest && e.target.closest('#theme-toggle');
  if (!t) return;
  e.preventDefault();
  toggleTheme();
});

document.addEventListener('keydown', (e) => {
  const active = document.activeElement;
  if (!active) return;
  const isToggle = active.id === 'theme-toggle' || (active.closest && active.closest('#theme-toggle'));
  if (!isToggle) return;
  if (e.key === 'Enter' || e.key === ' ') {
    e.preventDefault();
    toggleTheme();
  }
});
