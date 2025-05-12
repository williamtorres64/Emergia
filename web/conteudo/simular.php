<?php include_once("../api/conexao.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="../css/simular.css">

<h2 id="titulo">Carregando...</h2>
<div id="simulador-container"></div>

<button id="botao" onclick="calcular()">Calcular</button>

<h3 class="hidden" id="rh3">Relatório de resultados</h3>
<div id="resultados"></div>
<div id="grafico">
    <canvas id="emergiaChart"></canvas>
</div>

<script>
    let coeficientes = [];
    let nomes = [];
    let windowChart = null;

    // Gera pares de cores hex (originais + versões mais escuras)
    function randomHexColorPairs(colorAmount) {
        const bright = [];
        const dark = [];
        for (let i = 0; i < colorAmount; i++) {
            // cor aleatória
            const hex = '#' + Math.floor(Math.random() * 0xFFFFFF)
                .toString(16).padStart(6, '0');
            bright.push(hex);

            // gera versão 20% mais escura
            const r = Math.floor(parseInt(hex.substr(1, 2), 16) * 0.8);
            const g = Math.floor(parseInt(hex.substr(3, 2), 16) * 0.8);
            const b = Math.floor(parseInt(hex.substr(5, 2), 16) * 0.8);
            const darker = '#' + [r, g, b]
                .map(c => c.toString(16).padStart(2, '0'))
                .join('');
            dark.push(darker);
        }
        return [bright, dark];
    }

    function calcular() {
        document.getElementById("resultados").textContent = '';
        let emergiaTotal = 0;
        const dias = parseFloat(document.getElementById("periodo").value);
        if (isNaN(dias)) return;

        document.getElementById("rh3").classList.remove("hidden");

        const valoresEmergia = [];

        for (let i = 0; i < coeficientes.length; i++) {
            let quantidade = parseFloat(
                document.getElementsByClassName("input-group")[i]
                .childNodes[1].value
            );
            if (isNaN(quantidade)) quantidade = 0;

            const emergia = quantidade * coeficientes[i] * dias;
            emergiaTotal += emergia;
            valoresEmergia.push(emergia);

            const p = document.createElement("p");
            p.textContent = `Emergia em ${nomes[i]}: ${emergia.toFixed(2)} sej`;
            document.getElementById("resultados").appendChild(p);
        }

        const pTotal = document.createElement("p");
        pTotal.innerHTML = `<b>Emergia total: ${emergiaTotal.toFixed(2)} sej</b>`;
        document.getElementById("resultados").appendChild(pTotal);

        // gera cores dinâmicas para o gráfico
        const cores = randomHexColorPairs(valoresEmergia.length);
        updateChart(valoresEmergia, nomes, cores);
        window.scrollTo({
            top: document.body.scrollHeight,
            behavior: 'smooth'
        });
    }

    function updateChart(valores, labels, cores) {
        const [backgroundColors, hoverColors] = cores;
        const ctx = document.getElementById('emergiaChart').getContext('2d');

        if (windowChart) {
            windowChart.destroy();
        }

        windowChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Distribuição da Emergía',
                    data: valores,
                    backgroundColor: backgroundColors,
                    hoverBackgroundColor: hoverColors
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' +
                                    tooltipItem.raw.toFixed(2) + ' sej';
                            }
                        }
                    }
                }
            }
        });
    }

    // Carregamento dinâmico dos inputs
    fetch('api/getSimulador.php?id=<?php echo $_GET["id"] ?>')
        .then(response => response.json())
        .then(jsonData => {
            const header = jsonData[0];
            document.getElementById("titulo").textContent = header.titulo || "Simulador";

            const container = document.getElementById("simulador-container");

            jsonData.slice(1).forEach(item => {
                const group = document.createElement("div");
                group.className = "input-group";

                const label = document.createElement("label");
                label.setAttribute("for", item.nome);
                label.textContent = `${item.titulo} (${item.unidade}/${item.periodo})`;

                const input = document.createElement("input");
                input.type = "number";
                input.placeholder = "0.0";
                input.lang = "pt-BR";
                input.min = 1;

                group.appendChild(label);
                group.appendChild(input);
                container.appendChild(group);

                coeficientes.push(item.transformidade / item.dias);
                nomes.push(item.titulo);
            });

            // campo Período (dias)
            const periodoGroup = document.createElement("div");
            periodoGroup.className = "input-group";

            const periodoLabel = document.createElement("label");
            periodoLabel.setAttribute("for", "periodo");
            periodoLabel.textContent = "Período (dias)";

            const periodoInput = document.createElement("input");
            periodoInput.type = "number";
            periodoInput.id = "periodo";
            periodoInput.name = "periodo";
            periodoInput.placeholder = "0.0";
            periodoInput.min = 1;

            periodoGroup.appendChild(periodoLabel);
            periodoGroup.appendChild(periodoInput);
            container.appendChild(periodoGroup);
        })
        .catch(error => {
            document.getElementById("titulo").textContent = "Erro ao carregar o simulador";
            console.error("Erro ao buscar JSON:", error);
        });
</script>
