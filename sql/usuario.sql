CREATE TABLE viagens (
    id_viagem INT AUTO_INCREMENT PRIMARY KEY,
    -- Identificador único da viagem
    id_motorista INT NOT NULL,
    -- Identificador do motorista (referenciado a outra tabela)
    origemLat DECIMAL(10, 8) NOT NULL,
    -- Latitude da origem
    origemLng DECIMAL(11, 8) NOT NULL,
    -- Longitude da origem
    destLat DECIMAL(10, 8) NOT NULL,
    -- Latitude do destino
    destLng DECIMAL(11, 8) NOT NULL,
    -- Longitude do destino
    distancia VARCHAR(50) NOT NULL,
    -- Distância total da viagem
    duracao VARCHAR(50) NOT NULL,
    -- Duração total da viagem
    data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    -- Data e hora da viagem
    val_combustivel DECIMAL(10, 2) NULL,
    -- Valor do combustível (opcional, começa vazio)
    CONSTRAINT fk_motorista FOREIGN KEY (id_motorista) REFERENCES motoristas(id_motorista)
);