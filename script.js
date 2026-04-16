// ─────────────────────────────────────────────
//  BRASILEIRÃO 2026 — script.js
// ─────────────────────────────────────────────

document.addEventListener('DOMContentLoaded', () => {

    // ── Navbar scroll ──────────────────────────
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        navbar.classList.toggle('scrolled', window.scrollY > 60);
    });

    // ── Mobile nav toggle ──────────────────────
    const navToggle = document.getElementById('navToggle');
    const navLinks  = document.querySelector('.nav-links');
    navToggle?.addEventListener('click', () => {
        navLinks.classList.toggle('open');
    });
    // Fechar ao clicar em link
    navLinks?.querySelectorAll('a').forEach(a => {
        a.addEventListener('click', () => navLinks.classList.remove('open'));
    });

    // ── Tabs calendário ────────────────────────
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const tabId = btn.dataset.tab;

            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));

            btn.classList.add('active');
            document.getElementById(tabId)?.classList.add('active');
        });
    });

    // ── Modal Cadastro ─────────────────────────
    const overlay       = document.getElementById('modalOverlay');
    const btnAbrir      = document.getElementById('btnAbrirModal');
    const btnFechar     = document.getElementById('btnFecharModal');
    const btnCancelar   = document.getElementById('btnCancelar');

    function abrirModal() {
        overlay.classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function fecharModal() {
        overlay.classList.remove('open');
        document.body.style.overflow = '';
    }

    btnAbrir?.addEventListener('click', abrirModal);
    btnFechar?.addEventListener('click', fecharModal);
    btnCancelar?.addEventListener('click', fecharModal);
    overlay?.addEventListener('click', e => { if (e.target === overlay) fecharModal(); });

    // ── Fechar modal com ESC ───────────────────
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            fecharModal();
            fecharDelete();
        }
    });

    // ── Validação do formulário ────────────────
    const formCadastro = document.getElementById('formCadastro');
    formCadastro?.addEventListener('submit', e => {
        const nome     = formCadastro.nome.value.trim();
        const sigla    = formCadastro.sigla.value.trim();
        const cidade   = formCadastro.cidade.value.trim();
        const estado   = formCadastro.estado.value;
        const fundacao = parseInt(formCadastro.fundacao.value);
        const grupo    = formCadastro.grupo.value;

        const erros = [];

        if (!nome || nome.length < 2)
            erros.push('Informe o nome do time (mín. 2 caracteres).');
        if (!sigla || !/^[A-Za-z]{2,4}$/.test(sigla))
            erros.push('A sigla deve ter 2 a 4 letras.');
        if (!cidade)
            erros.push('Informe a cidade.');
        if (!estado)
            erros.push('Selecione o estado.');
        if (!fundacao || fundacao < 1850 || fundacao > new Date().getFullYear())
            erros.push('Informe um ano de fundação válido.');
        if (!grupo)
            erros.push('Selecione o grupo.');

        if (erros.length > 0) {
            e.preventDefault();
            showToast('⚠️ ' + erros[0], 'error');
        }
    });

    // ── Sigla uppercase automático ─────────────
    document.getElementById('sigla')?.addEventListener('input', function() {
        this.value = this.value.toUpperCase();
    });

    // ── Auto-fechar alertas ────────────────────
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-8px)';
            alert.style.transition = 'all .4s';
            setTimeout(() => alert.remove(), 400);
        }, 4500);
    });

    // ── Scroll reveal ──────────────────────────
    const revealEls = document.querySelectorAll(
        '.player-card, .jogo-card, .escudo-card, .cadastro-card'
    );
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    revealEls.forEach((el, i) => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(24px)';
        el.style.transition = `opacity .45s ease ${i * 0.05}s, transform .45s ease ${i * 0.05}s`;
        observer.observe(el);
    });

    // ── Toast notification ─────────────────────
    function showToast(msg, tipo = 'success') {
        const toast = document.createElement('div');
        toast.textContent = msg;
        Object.assign(toast.style, {
            position: 'fixed', bottom: '1.5rem', right: '1.5rem',
            background: tipo === 'success' ? 'var(--verde)' : '#e8001c',
            color: tipo === 'success' ? '#000' : '#fff',
            fontFamily: 'var(--font-cond)', fontWeight: '700',
            fontSize: '.95rem', letterSpacing: '.5px',
            padding: '.8rem 1.4rem', borderRadius: '8px',
            boxShadow: '0 8px 24px rgba(0,0,0,.4)',
            zIndex: '9999', opacity: '0',
            transform: 'translateY(12px)',
            transition: 'all .3s ease'
        });
        document.body.appendChild(toast);
        requestAnimationFrame(() => {
            toast.style.opacity = '1';
            toast.style.transform = 'translateY(0)';
        });
        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateY(12px)';
            setTimeout(() => toast.remove(), 350);
        }, 3500);
    }

    // Expor para uso global (botões inline)
    window.showToast = showToast;
});

// ── Confirmar delete (chamado pelo PHP) ────────
function confirmarDelete(id, nome) {
    document.getElementById('deleteId').value   = id;
    document.getElementById('deleteNome').textContent = nome;
    document.getElementById('deleteOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function fecharDelete() {
    document.getElementById('deleteOverlay').classList.remove('open');
    document.body.style.overflow = '';
}