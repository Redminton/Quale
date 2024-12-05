

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

                // Iterar dinamicamente por todos os preços (price1, price2, ...)
                let i = 1;
                while ($(this).attr(`price${i}`)) {
                    prices.push(`R$ ${$(this).attr(`price${i}`)}`);
                    i++;
                }

                // Gerar as colunas de preços
                const priceColumns = prices.map(price => `<td>${price}</td>`).join("");

                // Construir a linha da tabela
                const row = `
                    <tr>
                        <td>${posto}</td>
                        <td>${endereco}</td>
                        ${priceColumns}
                    </tr>
                `;
                tbody.innerHTML += row;
            });
        },
        error: function () {
            alert("Erro ao carregar os preços. Tente novamente mais tarde.");
        },
    });
}



