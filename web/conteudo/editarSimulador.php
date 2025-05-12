<link rel="stylesheet" href="../css/editarSimulador.css">

<script>
    
</script>

<p class="destaque">Nome do simulador:</p>
<input type="text" id="titulo">
<button class="hidden btn-acao" id="btn-salvar" style="margin-top: 15px;" onclick="salvarNome()">Salvar nome</button>

<script>
    sistemaId = new URLSearchParams(location.search).get("sistemaId");

    fetch(`api/getSimuladorTitulo.php?id=${sistemaId}`)
        .then(res => res.text())
        .then(data => {
            document.getElementById("titulo").value = data;
        });


document.getElementById("titulo").addEventListener("input", showBtn);

function showBtn(e){
    document.getElementById("btn-salvar").classList.toggle("hidden", false);
}

function salvarNome(){
    document.getElementById("btn-salvar").classList.toggle("hidden", true);
    let novoNome = document.getElementById("titulo").value;
    fetch(`api/setSimuladorTitulo.php?id=${sistemaId}&titulo=${novoNome}`);


}

</script>


<div id="wrapper"></div>
<script type="module">
    import {
        Grid,
        html
    } from "https://unpkg.com/gridjs?module";

    const ptBR = {
        search: {
            placeholder: "Pesquisa 🔎️"
        },
        sort: {
            sortAsc: "Coluna em ordem crescente",
            sortDesc: "Coluna em ordem decrescente",
        },
        pagination: {
            previous: "Anterior",
            next: "Próxima",
            navigate: (page, pages) => `Página ${page} de ${pages}`,
            page: (page) => `Página ${page}`,
            showing: "Mostrando",
            of: "de",
            to: "até",
            results: "resultados",
        },
        loading: "Carregando...",
        noRecordsFound: "Nenhum componente nessa simulação",
        error: "Ocorreu um erro ao buscar os dados",
    };

    const params = new URLSearchParams(window.location.search);
    const sistemaId = params.get("sistemaId");

    if (!sistemaId) {
        document
            .getElementById("wrapper")
            .innerHTML = "<p>Parâmetro <strong>sistemaId</strong> não fornecido.</p>";
    } else {
        new Grid({
            columns: [{
                    name: "ID Componente",
                    width: "170px"
                },
                {
                    name: "Título",
                    width: "auto"
                },
                {
                    name: "Ação",
                    width: "100px",
                    formatter: (_, row) =>
                        html(`
                <a href="api/removerSistemaComponente.php?sid=${sistemaId}&cid=${row.cells[0].data}">
                  <span class="material-symbols-outlined">close</span>
                </a>
              `),
                },
            ],
            search: true,
            language: ptBR,
            server: {
                url: `api/listSistemaComponente.php?sistemaId=${encodeURIComponent(
            sistemaId
          )}`,
                then: (data) =>
                    data.map((c) => [c.componenteId, c.titulo]),
            },
        }).render(document.getElementById("wrapper"));
    }
</script>



<div class="seletor-componente-container">
    <p>Selecione o componente para ser adicionado</p>
    <div>
        <select id="componente"></select>
        <a href="#" class="btn-confirmar" id="link-adicionar">Adicionar</a>
    </div>
    <a href="/simulacoes.php" class="btn-acao">Voltar</a>
</div>


<script>
    sistemaId = new URLSearchParams(location.search).get("sistemaId");
    const select = document.getElementById("componente");
    const link = document.getElementById("link-adicionar");

    fetch("/api/listComponente.php")
        .then(res => res.json())
        .then(data => {
            data.forEach(c => {
                const opt = document.createElement("option");
                opt.value = c.id;
                opt.textContent = c.titulo;
                select.appendChild(opt);
            });
            updateHref();
        });


    function updateHref() {
        const cid = select.value;
        link.href = `api/criarSistemaComponente.php?sid=${sistemaId}&cid=${cid}`;
    }

    select.addEventListener("change", updateHref);
</script>
