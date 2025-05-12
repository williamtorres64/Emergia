<p style="max-width: 740px; font-size: 20px;">ⓘ Aqui você pode criar, ler, editar, excluir e executar as simulações disponíveis</p>

<div id="wrapper"></div>

<script type="module">
    import {
        Grid,
        html
    } from "https://unpkg.com/gridjs?module";

    let ptBR={search:{placeholder:"Pesquisa 🔎️"},sort:{sortAsc:"Coluna em ordem crescente",sortDesc:"Coluna em ordem decrescente"},pagination:{previous:"Anterior",next:"Próxima",navigate:function(e,r){return"Página "+e+" de "+r},page:function(e){return"Página "+e},showing:"Mostrando",of:"de",to:"até",results:"resultados"},loading:"Carregando...",noRecordsFound:"Nenhum registro encontrado",error:"Ocorreu um erro ao buscar os dados"}


      const grid = new Grid({
        columns: [
            {
                name:'ID', width:'70px'
            },
            {
                name: 'Nome', width:'auto'
            },
            {
                name: 'Ação',
                width:'129px',
                formatter: (_, row) => html(`
                    <a href='editarSimulador.php?sistemaId=${row.cells[0].data}'><span class="material-symbols-outlined">settings</span></a>
                    <a href='api/removerSimulador.php?id=${row.cells[0].data}'><span class="material-symbols-outlined">close</span></a>
                    <a href='simular.php?id=${row.cells[0].data}'><span class="material-symbols-outlined">play_arrow</span></a>
                `)
            }
        ],
        search: true,
        language: ptBR,
        server: {
            url: 'api/listSimulador.php',
            then: data => data.map(s => [s.id, s.titulo])
        },

    }).render(document.getElementById("wrapper"));
</script>

<a class="btn-acao" style="margin-top: 30px;" href="../api/criarSistema.php">Novo Simulador</a>
