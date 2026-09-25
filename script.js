const dados = Array.isArray(window.PATRIMONIOS) ? window.PATRIMONIOS : [];

const modal = document.getElementById('modal');
const closeModal = document.getElementById('closeModal');
const compareRange = document.getElementById('compareRange');
const historicaLayer = document.getElementById('historicaLayer');
const sliderLine = document.getElementById('sliderLine');
const modalHistorica = document.getElementById('modalHistorica');
const modalAtual = document.getElementById('modalAtual');
const comparisonEmpty = document.getElementById('comparisonEmpty');
const imageStatus = document.getElementById('imageStatus');

function atualizarComparacao(valor) {
    const v = Number(valor);
    historicaLayer.style.width = `${v}%`;
    sliderLine.style.left = `${v}%`;
}

compareRange?.addEventListener('input', (event) => atualizarComparacao(event.target.value));

function abrirModal(id) {
    const item = dados.find(p => Number(p.id) === Number(id));
    if (!item) return;

    document.getElementById('modalCidade').textContent = item.cidade || '';
    document.getElementById('modalTitulo').textContent = item.nome || '';
    document.getElementById('modalTombamento').textContent = item.data_tombamento || 'Não informado';
    document.getElementById('modalLocalizacao').textContent = item.localizacao || 'Não informado';
    document.getElementById('modalDescricao').textContent = item.descricao || '';
    document.getElementById('modalCaracteristicas').textContent = item.caracteristicas || '';

    const fonte = document.getElementById('modalFonte');
    fonte.href = item.fonte_url || '#';
    fonte.textContent = item.fonte_nome || 'Fonte oficial';

    const fonteHistorica = document.getElementById('modalFonteHistorica');
    fonteHistorica.href = item.fonte_imagem_historica || item.fonte_url || '#';

    modalAtual.src = item.imagem_atual || '';
    modalAtual.alt = `${item.nome} — imagem atual`;

    if (item.imagem_historica) {
        modalHistorica.src = item.imagem_historica;
        modalHistorica.alt = `${item.nome} — imagem histórica`;
        historicaLayer.classList.remove('hidden');
        comparisonEmpty.classList.add('hidden');
        imageStatus.textContent = 'Comparação disponível';
    } else {
        modalHistorica.removeAttribute('src');
        historicaLayer.classList.add('hidden');
        comparisonEmpty.classList.remove('hidden');
        comparisonEmpty.classList.add('flex');
        imageStatus.textContent = 'Imagem histórica pendente';
    }

    compareRange.value = 50;
    atualizarComparacao(50);

    modal.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

function fecharModal() {
    modal.classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

document.querySelectorAll('.open-modal').forEach(btn => {
    btn.addEventListener('click', () => abrirModal(btn.dataset.id));
});

closeModal?.addEventListener('click', fecharModal);

modal?.addEventListener('click', (event) => {
    if (event.target === modal) fecharModal();
});

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') fecharModal();
});

document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const filtro = btn.dataset.filter;

        document.querySelectorAll('.filter-btn').forEach(b => {
            b.classList.remove('bg-stone-950', 'text-white');
            b.classList.add('border', 'border-stone-300', 'bg-white', 'text-stone-700');
        });

        btn.classList.remove('border', 'border-stone-300', 'bg-white', 'text-stone-700');
        btn.classList.add('bg-stone-950', 'text-white');

        document.querySelectorAll('.patrimonio-card').forEach(card => {
            const mostrar = filtro === 'todos' || card.dataset.cidade === filtro;
            card.classList.toggle('hidden', !mostrar);
        });
    });
});

const menuBtn = document.getElementById('menuBtn');
const mobileMenu = document.getElementById('mobileMenu');

menuBtn?.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
});

mobileMenu?.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => mobileMenu.classList.add('hidden'));
});
