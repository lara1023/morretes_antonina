const constructions = [

    {
        id: "casa-antonina",

        city: "ANTONINA",

        title: "Casa da Cultura de Antonina",

        short: "Casa da Cultura de Antonina",

        location: "Centro Histórico de Antonina",

        image: "./img/casa-cultura-antonina.jpg",

        description:
            "Espaço apresentado no projeto como uma das construções históricas de Antonina. Nesta página podem ser reunidas fotografias atuais, referências históricas, características arquitetônicas e materiais de pesquisa sobre o edifício.",

        future:
            "Digitalização fotográfica, modelo 3D e realidade aumentada poderiam ajudar a documentar a construção e tornar seu patrimônio mais acessível ao público."
    },


    {
        id: "igreja-antonina",

        city: "ANTONINA",

        title: "Igreja Matriz de Antonina",

        short: "Igreja Matriz de Antonina",

        location: "Centro Histórico de Antonina",

        image: "./img/igreja-antonina.jpg",

        description:
            "Uma das construções selecionadas para representar o patrimônio arquitetônico de Antonina. O conteúdo pode apresentar sua história, período, características arquitetônicas e transformações ao longo do tempo.",

        future:
            "Um modelo 3D associado a informações históricas poderia permitir uma visita digital e apoiar ações de documentação e preservação."
    },


    {
        id: "porto-antonina",

        city: "ANTONINA",

        title: "Porto de Antonina",

        short: "Porto de Antonina",

        location: "Antonina — litoral do Paraná",

        image: "./img/porto-antonina.jpg",

        description:
            "Ponto histórico incluído no roteiro digital de Antonina. A página pode reunir imagens, contexto histórico, elementos arquitetônicos e informações sobre sua relação com a cidade.",

        future:
            "Mapas interativos e registros digitais podem ajudar a apresentar a evolução do espaço e facilitar o acesso às informações sobre o patrimônio."
    },


    {
        id: "casarao-morretes",

        city: "MORRETES",

        title: "Casarão do Porto de Morretes",

        short: "Casarão do Porto de Morretes",

        location: "Centro Histórico de Morretes",

        image: "./img/casarao-morretes.jpg",

        description:
            "Construção selecionada para a experiência digital de Morretes. A proposta é apresentar fotos atuais, história, características arquitetônicas e uma reconstrução digital baseada em referências históricas.",

        future:
            "Fotogrametria, digitalização 3D e realidade aumentada poderiam criar uma documentação digital do casarão."
    },


    {
        id: "estacao-morretes",

        city: "MORRETES",

        title: "Estação Ferroviária de Morretes",

        short: "Estação Ferroviária de Morretes",

        location: "Morretes — Paraná",

        image: "./img/estacao-morretes.jpg",

        description:
            "Ponto histórico selecionado para o roteiro de Morretes. O conteúdo da página deve contextualizar a construção, registrar suas características e apresentar sua relação com a história local.",

        future:
            "Modelos 3D e experiências de realidade aumentada podem permitir que visitantes conheçam detalhes da estação de forma interativa."
    },


    {
        id: "igreja-morretes",

        city: "MORRETES",

        title: "Igreja Matriz de Morretes",

        short: "Igreja Matriz de Morretes",

        location: "Centro Histórico de Morretes",

        image: "./img/igreja-morretes.jpg",

        description:
            "Construção histórica incluída no projeto para representar o patrimônio arquitetônico de Morretes. A página pode receber fotografias, informações históricas e uma reconstrução digital.",

        future:
            "A combinação de documentação fotográfica, inteligência artificial, mapas e realidade aumentada pode ampliar as formas de conhecer e preservar o patrimônio."
    }

];



/* =====================================================
   CRIAR CARD
===================================================== */

function criarCard(item) {

    return `

        <article
            data-id="${item.id}"
            class="construction-card cursor-pointer overflow-hidden rounded-lg
            bg-[#352018] text-white shadow-md
            transition duration-300
            hover:-translate-y-1 hover:shadow-xl"
        >

            <div class="h-44 overflow-hidden">

                <img
                    src="${item.image}"
                    alt="${item.title}"
                    class="h-full w-full object-cover transition duration-500
                    hover:scale-105"
                >

            </div>


            <div class="p-4">

                <small class="text-[10px] text-[#d5b8a8]">
                    ⌖ ${item.city}
                </small>


                <h3 class="my-2 min-h-10 font-serif text-lg leading-tight">

                    ${item.short}

                </h3>


                <div
                    class="grid h-8 w-8 place-items-center
                    rounded-full bg-[#d56642]"
                >

                    →

                </div>

            </div>

        </article>

    `;
}



/* =====================================================
   INSERIR CARDS
===================================================== */

const cards = document.querySelector("#cards");

const antoninaCards =
    document.querySelector("#antoninaCards");

const morretesCards =
    document.querySelector("#morretesCards");


cards.innerHTML =
    constructions.map(criarCard).join("");


antoninaCards.innerHTML =
    constructions
        .filter(item => item.city === "ANTONINA")
        .map(criarCard)
        .join("");


morretesCards.innerHTML =
    constructions
        .filter(item => item.city === "MORRETES")
        .map(criarCard)
        .join("");



/* =====================================================
   ELEMENTOS DO MODAL
===================================================== */

const modal =
    document.querySelector("#modal");

const modalImage =
    document.querySelector("#modalImage");

const modalCity =
    document.querySelector("#modalCity");

const modalTitle =
    document.querySelector("#modalTitle");

const modalLocation =
    document.querySelector("#modalLocation");

const modalDescription =
    document.querySelector("#modalDescription");

const modalFuture =
    document.querySelector("#modalFuture");



/* =====================================================
   ABRIR MODAL
===================================================== */

function abrirModal(id) {

    const item =
        constructions.find(
            construction => construction.id === id
        );


    if (!item) {
        return;
    }


    modalImage.style.backgroundImage =
        `url('${item.image}')`;


    modalCity.textContent =
        item.city;


    modalTitle.textContent =
        item.title;


    modalLocation.textContent =
        "📍 " + item.location;


    modalDescription.textContent =
        item.description;


    modalFuture.textContent =
        item.future;


    modal.classList.remove("hidden");

    modal.classList.add("flex");

    document.body.classList.add("overflow-hidden");

}



/* =====================================================
   FECHAR MODAL
===================================================== */

function fecharModal() {

    modal.classList.add("hidden");

    modal.classList.remove("flex");

    document.body.classList.remove("overflow-hidden");

}



/* =====================================================
   CLIQUE NOS CARDS
===================================================== */

document.addEventListener("click", function (event) {

    const card =
        event.target.closest(".construction-card");


    if (card) {

        const id =
            card.dataset.id;

        abrirModal(id);

    }


    if (
        event.target === modal ||
        event.target.id === "closeModal"
    ) {

        fecharModal();

    }

});



/* =====================================================
   ESC FECHA MODAL
===================================================== */

document.addEventListener("keydown", function (event) {

    if (event.key === "Escape") {

        fecharModal();

    }

});



/* =====================================================
   SLIDER
   ATUALMENTE X RECONSTRUÇÃO
===================================================== */

const compareRange =
    document.querySelector("#compareRange");

const compareOld =
    document.querySelector("#compareOld");


compareRange.addEventListener("input", function () {

    const valor =
        this.value;


    compareOld.style.clipPath =
        `inset(0 ${100 - valor}% 0 0)`;

});



/* =====================================================
   MENU MOBILE
===================================================== */

const menuToggle =
    document.querySelector("#menuToggle");

const menu =
    document.querySelector("#menu");


menuToggle.addEventListener("click", function () {

    menu.classList.toggle("hidden");

});


/* Fecha o menu ao clicar em algum item */

document.querySelectorAll("#menu a").forEach(function (link) {

    link.addEventListener("click", function () {

        menu.classList.add("hidden");

    });

});