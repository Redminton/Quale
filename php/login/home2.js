function togglePriceTable() {
    const tableContainer = document.getElementById("priceTableContainer");
    if (tableContainer.style.display === "none" || tableContainer.style.display === "") {
        populateTable();
        tableContainer.style.display = "block";
    } else {
        tableContainer.style.display = "none";
    }
}

// Preencher a tabela com dados
function populateTable() {
    const tbody = document.getElementById("priceTableBody");
    tbody.innerHTML = ""; // Limpa o conteúdo anterior

    $.ajax({
        url: "../ponto/pontos2.php", // Arquivo que retorna dados dos postos
        method: "GET",
        dataType: "xml",
        success: function (data) {
            $(data).find("marker").each(function () {
                const posto = $(this).attr("name");
                const endereco = $(this).attr("address");
                const prices = [];
                let i = 1;

                // Iterar dinamicamente por todos os preços
                while ($(this).attr(`price${i}`)) {
                    prices.push(`<option value="price${i}">Gasolina ${i} - R$ ${$(this).attr(`price${i}`)}</option>`);
                    i++;
                }

                // Criar linhas da tabela com seleção de preço
                const row = `
                    <tr>
                        <td>${posto}</td>
                        <td>${endereco}</td>
                        <td>
                            <select class="gasoline-select">
                                ${prices.join("")}
                            </select>
                        </td>
                        <td>
                            <button class="save-route" data-posto="${posto}" data-endereco="${endereco}">
                                Salvar Rota
                            </button>
                        </td>
                    </tr>
                `;
                tbody.innerHTML += row;
            });

            // Adicionar evento aos botões de salvar
            document.querySelectorAll(".save-route").forEach(button => {
                button.addEventListener("click", saveRoute);
            });
        },
        error: function () {
            alert("Erro ao carregar os preços. Tente novamente mais tarde.");
        },
    });
}

// Salvar a rota
function saveRoute(event) {
    const button = event.target;
    const posto = button.getAttribute("data-posto");
    const endereco = button.getAttribute("data-endereco");
    const select = button.closest("tr").querySelector(".gasoline-select");
    const selectedPrice = select.value; // price1, price2, etc.

    $.ajax({
        url: "../salvar_viagem.php",
        method: "POST",
        data: {
            posto,
            endereco,
            tipoPreco: selectedPrice,
        },
        success: function (response) {
            alert("Rota salva com sucesso!");
        },
        error: function () {
            alert("Erro ao salvar a rota. Tente novamente.");
        },
    });
}
