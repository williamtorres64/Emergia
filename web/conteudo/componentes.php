<p style="max-width: 920px; font-size: 20px;">ⓘ Aqui você pode criar, ler, editar, e excluir os componentes disponíveis para a criação dos simulações</p>

<div id="wrapper" style="max-width: 1000px;"></div>

<script type="module">
    import {
        Grid,
        html
    } from "https://unpkg.com/gridjs?module";

    let ptBR = {
        search: {
            placeholder: "Pesquisa 🔎️"
        },
        sort: {
            sortAsc: "Coluna em ordem crescente",
            sortDesc: "Coluna em ordem decrescente"
        },
        pagination: {
            previous: "Anterior",
            next: "Próxima",
            navigate: function(e, r) {
                return "Página " + e + " de " + r
            },
            page: function(e) {
                return "Página " + e
            },
            showing: "Mostrando",
            of: "de",
            to: "até",
            results: "resultados"
        },
        loading: "Carregando...",
        noRecordsFound: "Nenhum registro encontrado",
        error: "Ocorreu um erro ao buscar os dados"
    }


    const grid = new Grid({
        columns: [{
                name: 'ID',
                width: '70px'
            },
            {
                name: 'Nome',
                width: '300px'
            },
            {
                name: 'Transformidade',
                width: 'auto'
            },
            {
                name: 'Unidade',
                width: 'auto'
            },
            {
                name: 'Periodo',
                width: 'auto'
            },

            {
                name: 'Ação',
                width: '110px',
                formatter: (_, row) => html(`
                    <a href='editarComponente.php?id=${row.cells[0].data}'><span class="material-symbols-outlined">settings</span></a>
                    <a href='api/removerComponente.php?id=${row.cells[0].data}'><span class="material-symbols-outlined">close</span></a>
                `)
            }
        ],
        search: true,
        language: ptBR,
        server: {
            url: 'api/listComponente.php',
            then: data => data.map(s => [s.id, s.titulo, s.transformidade, s.unidade, s.periodo])
        },

    }).render(document.getElementById("wrapper"));
</script>

<a class="btn-acao" style="margin-top: 30px;" href="../editarComponente.php">Novo Componente</a>
