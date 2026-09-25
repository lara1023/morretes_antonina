<?php
declare(strict_types=1);
require_once __DIR__ . '/conexao.php';

$stmt = $pdo->query("SELECT * FROM patrimonios ORDER BY FIELD(cidade, 'Antonina', 'Morretes'), id");
$patrimonios = $stmt->fetchAll();

function e(?string $valor): string {
    return htmlspecialchars($valor ?? '', ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Patrimônio Vivo: mapeamento interativo da arquitetura histórica de Antonina e Morretes.">
    <title>Patrimônio Vivo | Antonina e Morretes</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['DM Sans', 'sans-serif'],
                        display: ['Playfair Display', 'serif']
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-stone-50 text-stone-900 font-sans">
<header class="fixed top-0 left-0 right-0 z-40 border-b border-white/10 bg-stone-950/90 text-white backdrop-blur">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4">
        <a href="#" class="flex items-center gap-3">
            <span class="grid h-10 w-10 place-items-center rounded-full bg-amber-500 text-stone-950">
                <i class="bi bi-buildings text-xl"></i>
            </span>
            <div>
                <p class="font-display text-lg leading-none">Patrimônio Vivo</p>
                <p class="text-[10px] uppercase tracking-[0.25em] text-stone-400">Antonina + Morretes</p>
            </div>
        </a>

        <nav class="hidden items-center gap-7 text-sm md:flex">
            <a href="#patrimonios" class="transition hover:text-amber-400">Patrimônios</a>
            <a href="#projeto" class="transition hover:text-amber-400">Projeto</a>
            <a href="#fontes" class="transition hover:text-amber-400">Fontes</a>
        </nav>

        <button id="menuBtn" class="grid h-10 w-10 place-items-center rounded-lg border border-white/15 md:hidden" aria-label="Abrir menu">
            <i class="bi bi-list text-xl"></i>
        </button>
    </div>

    <div id="mobileMenu" class="hidden border-t border-white/10 bg-stone-950 px-5 py-4 md:hidden">
        <div class="flex flex-col gap-4 text-sm">
            <a href="#patrimonios">Patrimônios</a>
            <a href="#projeto">Projeto</a>
            <a href="#fontes">Fontes</a>
        </div>
    </div>
</header>

<main>
    <section class="relative flex min-h-[720px] items-end overflow-hidden bg-stone-900 pt-20">
        <img src="./img/hero.jpg" alt="Paisagem histórica de Antonina ou Morretes" class="absolute inset-0 h-full w-full object-cover opacity-55">
        <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-stone-950/45 to-transparent"></div>

        <div class="relative mx-auto w-full max-w-7xl px-5 pb-20 pt-28">
            <div class="max-w-3xl">
                <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.2em] text-white backdrop-blur">
                    <i class="bi bi-geo-alt"></i>
                    Litoral do Paraná
                </span>

                <h1 class="font-display text-5xl leading-[1.02] text-white sm:text-6xl lg:text-8xl">
                    Patrimônio<br>
                    <span class="text-amber-400">Vivo</span>
                </h1>

                <p class="mt-7 max-w-2xl text-lg leading-8 text-stone-200">
                    Um mapeamento digital da arquitetura histórica de Antonina e Morretes,
                    aproximando documentos, lugares e memória por meio de imagens e informação.
                </p>

                <div class="mt-9 flex flex-wrap gap-3">
                    <a href="#patrimonios" class="rounded-full bg-amber-500 px-6 py-3 font-semibold text-stone-950 transition hover:bg-amber-400">
                        Explorar patrimônios
                    </a>
                    <a href="#projeto" class="rounded-full border border-white/25 bg-white/10 px-6 py-3 font-semibold text-white backdrop-blur transition hover:bg-white/15">
                        Sobre o projeto
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="border-b border-stone-200 bg-white">
        <div class="mx-auto grid max-w-7xl gap-0 md:grid-cols-3">
            <div class="border-b border-stone-200 p-7 md:border-b-0 md:border-r">
                <p class="text-3xl font-bold text-stone-950">06</p>
                <p class="mt-1 text-sm text-stone-500">patrimônios selecionados</p>
            </div>
            <div class="border-b border-stone-200 p-7 md:border-b-0 md:border-r">
                <p class="text-3xl font-bold text-stone-950">02</p>
                <p class="mt-1 text-sm text-stone-500">cidades do litoral paranaense</p>
            </div>
            <div class="p-7">
                <p class="text-3xl font-bold text-stone-950">01</p>
                <p class="mt-1 text-sm text-stone-500">experiência digital de pesquisa</p>
            </div>
        </div>
    </section>

    <section id="patrimonios" class="mx-auto max-w-7xl px-5 py-24">
        <div class="max-w-2xl">
            <p class="text-xs font-bold uppercase tracking-[0.25em] text-amber-700">Exploração</p>
            <h2 class="mt-3 font-display text-4xl text-stone-950 sm:text-5xl">Conheça os patrimônios</h2>
            <p class="mt-5 leading-7 text-stone-600">
                Selecione um patrimônio para conhecer seus dados históricos e visualizar a mudança entre registros.
            </p>
        </div>

        <div class="mt-10 flex flex-wrap gap-2">
            <button class="filter-btn rounded-full bg-stone-950 px-5 py-2.5 text-sm font-semibold text-white" data-filter="todos">Todos</button>
            <button class="filter-btn rounded-full border border-stone-300 bg-white px-5 py-2.5 text-sm font-semibold text-stone-700" data-filter="Antonina">Antonina</button>
            <button class="filter-btn rounded-full border border-stone-300 bg-white px-5 py-2.5 text-sm font-semibold text-stone-700" data-filter="Morretes">Morretes</button>
        </div>

        <div id="cards" class="mt-10 grid gap-7 md:grid-cols-2 lg:grid-cols-3">
            <?php foreach ($patrimonios as $p): ?>
                <article class="patrimonio-card group overflow-hidden rounded-3xl border border-stone-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl"
                         data-cidade="<?= e($p['cidade']) ?>">
                    <div class="relative aspect-[4/3] overflow-hidden bg-stone-200">
                        <?php if (!empty($p['imagem_atual'])): ?>
                            <img src="<?= e($p['imagem_atual']) ?>" alt="<?= e($p['nome']) ?>" class="h-full w-full object-cover transition duration-700 group-hover:scale-105" loading="lazy">
                        <?php else: ?>
                            <div class="grid h-full place-items-center text-stone-400">
                                <i class="bi bi-image text-5xl"></i>
                            </div>
                        <?php endif; ?>
                        <span class="absolute left-4 top-4 rounded-full bg-stone-950/80 px-3 py-1.5 text-xs font-semibold text-white backdrop-blur">
                            <?= e($p['cidade']) ?>
                        </span>
                    </div>

                    <div class="p-6">
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-amber-700"><?= e($p['inscricao'] ?: 'Patrimônio histórico') ?></p>
                        <h3 class="mt-2 font-display text-2xl leading-tight text-stone-950"><?= e($p['nome']) ?></h3>
                        <p class="mt-3 line-clamp-3 text-sm leading-6 text-stone-600"><?= e($p['descricao']) ?></p>

                        <button class="open-modal mt-6 inline-flex items-center gap-2 font-semibold text-stone-950 transition hover:text-amber-700"
                                data-id="<?= (int)$p['id'] ?>">
                            Ver patrimônio
                            <i class="bi bi-arrow-up-right"></i>
                        </button>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section id="projeto" class="bg-stone-950 px-5 py-24 text-white">
        <div class="mx-auto grid max-w-7xl gap-14 lg:grid-cols-[1fr_1.1fr] lg:items-center">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.25em] text-amber-400">Sobre a proposta</p>
                <h2 class="mt-4 font-display text-4xl sm:text-5xl">Preservar também é contar.</h2>
            </div>

            <div class="space-y-6 text-lg leading-8 text-stone-300">
                <p>
                    O projeto organiza informações de bens culturais de Antonina e Morretes
                    em uma experiência web simples, visual e educativa.
                </p>
                <p>
                    A principal interação é a <strong class="text-white">mudança de imagens</strong>:
                    o visitante pode comparar registros e compreender visualmente a permanência,
                    transformação e contexto dos lugares.
                </p>
                <div class="grid gap-4 sm:grid-cols-3">
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
                        <i class="bi bi-images text-2xl text-amber-400"></i>
                        <p class="mt-3 text-sm font-semibold text-white">Imagens</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
                        <i class="bi bi-database text-2xl text-amber-400"></i>
                        <p class="mt-3 text-sm font-semibold text-white">Dados</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
                        <i class="bi bi-code-slash text-2xl text-amber-400"></i>
                        <p class="mt-3 text-sm font-semibold text-white">Web</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="fontes" class="mx-auto max-w-7xl px-5 py-24">
        <div class="max-w-3xl">
            <p class="text-xs font-bold uppercase tracking-[0.25em] text-amber-700">Pesquisa</p>
            <h2 class="mt-3 font-display text-4xl text-stone-950">Fontes e responsabilidade</h2>
            <p class="mt-5 leading-7 text-stone-600">
                Os dados históricos usados no projeto foram organizados a partir de páginas oficiais
                do Patrimônio Cultural do Paraná, IPHAN e Prefeitura de Antonina.
                As imagens devem respeitar a licença indicada em cada fonte.
            </p>
        </div>

        <div class="mt-10 grid gap-5 md:grid-cols-3">
            <a href="https://www.patrimoniocultural.pr.gov.br/" target="_blank" rel="noopener"
               class="rounded-3xl border border-stone-200 bg-white p-6 transition hover:border-amber-400 hover:shadow-lg">
                <i class="bi bi-bank text-2xl text-amber-700"></i>
                <h3 class="mt-4 font-semibold">Patrimônio Cultural do Paraná</h3>
                <p class="mt-2 text-sm leading-6 text-stone-500">Bens tombados e documentação patrimonial.</p>
            </a>

            <a href="https://www.gov.br/iphan/pt-br/superintendencias/parana" target="_blank" rel="noopener"
               class="rounded-3xl border border-stone-200 bg-white p-6 transition hover:border-amber-400 hover:shadow-lg">
                <i class="bi bi-building text-2xl text-amber-700"></i>
                <h3 class="mt-4 font-semibold">IPHAN Paraná</h3>
                <p class="mt-2 text-sm leading-6 text-stone-500">Informações sobre patrimônio cultural federal.</p>
            </a>

            <a href="https://commons.wikimedia.org/" target="_blank" rel="noopener"
               class="rounded-3xl border border-stone-200 bg-white p-6 transition hover:border-amber-400 hover:shadow-lg">
                <i class="bi bi-camera text-2xl text-amber-700"></i>
                <h3 class="mt-4 font-semibold">Wikimedia Commons</h3>
                <p class="mt-2 text-sm leading-6 text-stone-500">Banco de imagens com licenças indicadas em cada arquivo.</p>
            </a>
        </div>
    </section>
</main>

<footer class="border-t border-stone-200 bg-white px-5 py-8">
    <div class="mx-auto flex max-w-7xl flex-col gap-3 text-sm text-stone-500 sm:flex-row sm:items-center sm:justify-between">
        <p>Patrimônio Vivo — projeto educacional</p>
        <p>Antonina e Morretes · Paraná</p>
    </div>
</footer>

<!-- MODAL -->
<div id="modal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-stone-950/80 p-4 backdrop-blur-sm">
    <div class="mx-auto my-6 max-w-6xl overflow-hidden rounded-3xl bg-white shadow-2xl">
        <div class="flex items-center justify-between border-b border-stone-200 px-5 py-4 sm:px-7">
            <div>
                <p id="modalCidade" class="text-xs font-bold uppercase tracking-[0.2em] text-amber-700"></p>
                <h2 id="modalTitulo" class="font-display text-2xl text-stone-950 sm:text-3xl"></h2>
            </div>
            <button id="closeModal" class="grid h-11 w-11 place-items-center rounded-full bg-stone-100 text-stone-700 transition hover:bg-stone-200" aria-label="Fechar">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <div class="grid lg:grid-cols-[1.25fr_0.75fr]">
            <div class="bg-stone-950 p-4 sm:p-7">
                <div id="comparison" class="relative aspect-[16/10] overflow-hidden rounded-2xl bg-stone-800">
                    <div id="comparisonEmpty" class="absolute inset-0 z-20 hidden items-center justify-center p-8 text-center text-stone-300">
                        <div>
                            <i class="bi bi-images text-5xl"></i>
                            <p class="mt-4 font-semibold">Imagem histórica ainda não cadastrada</p>
                            <p class="mt-2 text-sm leading-6 text-stone-400">
                                Use a fonte indicada na ficha para adicionar o registro histórico à pasta do projeto.
                            </p>
                        </div>
                    </div>

                    <img id="modalAtual" src="" alt="" class="absolute inset-0 h-full w-full object-cover">
                    <div id="historicaLayer" class="absolute inset-y-0 left-0 overflow-hidden" style="width:50%">
                        <img id="modalHistorica" src="" alt="" class="absolute left-0 top-0 h-full w-full max-w-none object-cover">
                    </div>

                    <div id="sliderLine" class="pointer-events-none absolute inset-y-0 z-10 w-0.5 bg-white shadow-lg" style="left:50%">
                        <span class="absolute left-1/2 top-1/2 grid h-11 w-11 -translate-x-1/2 -translate-y-1/2 place-items-center rounded-full border-2 border-white bg-amber-500 text-stone-950 shadow-xl">
                            <i class="bi bi-arrows-expand-vertical"></i>
                        </span>
                    </div>

                    <div class="pointer-events-none absolute left-4 top-4 z-10 rounded-full bg-stone-950/75 px-3 py-1.5 text-xs font-bold text-white">HISTÓRICA</div>
                    <div class="pointer-events-none absolute right-4 top-4 z-10 rounded-full bg-stone-950/75 px-3 py-1.5 text-xs font-bold text-white">ATUAL</div>

                    <input id="compareRange" type="range" min="0" max="100" value="50"
                           class="absolute inset-0 z-30 h-full w-full cursor-ew-resize opacity-0" aria-label="Comparar imagem histórica e atual">
                </div>

                <div class="mt-4 flex items-center justify-between text-xs text-stone-400">
                    <span>Arraste para comparar</span>
                    <span id="imageStatus">Comparação</span>
                </div>
            </div>

            <div class="p-5 sm:p-7">
                <div class="space-y-6">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.18em] text-stone-400">Tombamento</p>
                        <p id="modalTombamento" class="mt-1 font-semibold text-stone-900"></p>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.18em] text-stone-400">Localização</p>
                        <p id="modalLocalizacao" class="mt-1 text-sm leading-6 text-stone-600"></p>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.18em] text-stone-400">Sobre</p>
                        <p id="modalDescricao" class="mt-2 text-sm leading-7 text-stone-600"></p>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.18em] text-stone-400">Características</p>
                        <p id="modalCaracteristicas" class="mt-2 text-sm leading-7 text-stone-600"></p>
                    </div>

                    <div class="rounded-2xl bg-stone-50 p-5">
                        <p class="text-xs font-bold uppercase tracking-[0.18em] text-stone-400">Fonte</p>
                        <a id="modalFonte" href="#" target="_blank" rel="noopener" class="mt-2 inline-flex items-center gap-2 text-sm font-semibold text-amber-700 hover:text-amber-800">
                            Abrir fonte oficial <i class="bi bi-box-arrow-up-right"></i>
                        </a>
                    </div>

                    <div id="historicalSourceBox" class="rounded-2xl border border-amber-200 bg-amber-50 p-5">
                        <p class="text-xs font-bold uppercase tracking-[0.18em] text-amber-800">Registro histórico</p>
                        <p class="mt-2 text-sm leading-6 text-amber-900">
                            A ficha possui uma fonte para o registro histórico, mas a imagem histórica não está sendo copiada automaticamente para o projeto.
                        </p>
                        <a id="modalFonteHistorica" href="#" target="_blank" rel="noopener" class="mt-3 inline-flex items-center gap-2 text-sm font-bold text-amber-800 hover:text-amber-900">
                            Consultar registro <i class="bi bi-arrow-up-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
window.PATRIMONIOS = <?= json_encode($patrimonios, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;
</script>
<script src="./script.js"></script>
</body>
</html>
