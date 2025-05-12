<?php
include_once("conexao.php");

$conn->query("DROP DATABASE IF EXISTS emergia");
$conn->query("CREATE DATABASE IF NOT EXISTS emergia");

$conn->select_db("emergia");

$schema = <<<SQL
CREATE TABLE periodo (
  id INT NOT NULL,
  dias INT,
  nome VARCHAR(16),
  PRIMARY KEY (id)
);

INSERT INTO periodo (id, dias, nome) VALUES
  (1, 1, 'dia'),
  (2, 30, 'mês'),
  (3, 365, 'ano');

CREATE TABLE unidade (
  id INT NOT NULL,
  nome VARCHAR(16),
  PRIMARY KEY (id)
);

INSERT INTO unidade (id, nome) VALUES
  (1, 'm'),
  (2, 'm2'),
  (3, 'm3'),
  (4, 'ton'),
  (5, 'kWh'),
  (6, 'litro'),
  (7, 'dólar');

CREATE TABLE sistema (
  id INT NOT NULL AUTO_INCREMENT,
  titulo VARCHAR(128),
  PRIMARY KEY (id)
);

CREATE TABLE componente (
  id INT NOT NULL AUTO_INCREMENT,
  titulo VARCHAR(64),
  transformidade DOUBLE,
  periodoId INT,
  unidadeId INT,
  PRIMARY KEY (id),
  FOREIGN KEY (periodoId) REFERENCES periodo(id) ON DELETE CASCADE,
  FOREIGN KEY (unidadeId) REFERENCES unidade(id) ON DELETE CASCADE
);

CREATE TABLE sistema_componente (
  id INT NOT NULL AUTO_INCREMENT,
  sistemaId INT,
  componenteId INT,
  PRIMARY KEY (id),
  FOREIGN KEY (sistemaId) REFERENCES sistema(id) ON DELETE CASCADE,
  FOREIGN KEY (componenteId) REFERENCES componente(id) ON DELETE CASCADE
);

INSERT INTO componente (titulo, transformidade, unidadeId, periodoId) VALUES
  ('Alumínio', 2.13e+16, 4, 3),
  ('Aço', 7.81e+15, 4, 3),
  ('Cobre', 9.8e+16, 4, 3),
  ('Concreto', 2.54e+5, 4, 3),
  ('Energia elétrica', 3.6e+6, 5, 2),
  ('Água', 0.5, 6, 1),
  ('Fibra de Vidro', 1.32e+16, 4, 3),
  ('Lago', 6.61e+10, 2, 3),
  ('Madeira de lei', 2.43e+13, 3, 3),
  ('Minerais', 5.26e+8, 4, 3),
  ('Pinho de madeira plana', 1.71e+13, 3, 3),
  ('Poliester', 5.51e+15, 4, 3),
  ('Rio', 1.16e+12, 2, 3),
  ('Tratamento de Água', 1.8e+6, 3, 2),
  ('Vidro', 1.29e+16, 4, 3),
  ('Mão de obra', 4.24e+12, 7, 3);

insert into sistema (titulo) values
('Fundição'),
('Fábrica de roupas'),
('Tratamento de água'),
('Construção');

-- Fundição
INSERT INTO sistema_componente (sistemaId, componenteId) VALUES
  (1, 1),(1, 2),(1, 3);
-- Fábrica de roupas
INSERT INTO sistema_componente (sistemaId, componenteId) VALUES
  (2, 5),(2, 16),(2, 12);
-- Tratamento de água
INSERT INTO sistema_componente (sistemaId, componenteId) VALUES
  (3, 13),(3, 8),(3, 16);
-- Construção
INSERT INTO sistema_componente (sistemaId, componenteId) VALUES
  (4, 4),(4, 2),(4, 16);
SQL;

if ($conn->multi_query($schema)) {
    do {
        if ($res = $conn->store_result()) {
            $res->free();
        }
    } while ($conn->more_results() && $conn->next_result());
} else {
    throw new RuntimeException("Multi-query failed: " . $conn->error);
}

header("Location: ../");
exit;
?>

