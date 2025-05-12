use emergia;

-- Período: (id, dias, nome) => (1, 1, 'Dia'), (2, 30, 'Mês'), (3, 365, 'Ano');
-- Unidade: (id, nome) => (1, 'm'), (2, 'm2'), (3, 'm3'), (4, 'ton'), (5, 'kWh'), (6, 'litro'), (7, 'dólar');

insert into componente (titulo, transformidade, unidadeId, periodoId) values
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
  /*
  select c.id, c.nome recurso, concat(u.nome, '/', p.nome) as 'unidade sej',u.nome unidade, p.dias from componente as c
  inner join unidade as u on u.id = c.unidadeId
  inner join periodo as p on p.id = c.periodoId
  order by c.id;
  */



insert into sistema (titulo) values
('Fundição'),
('Fábrica de roupas'),
('Tratamento de água'),
('Construção');



-- Fundição
insert into sistema_componente (sistemaId, componenteId) values
(1, 1), (1, 2), (1, 3);
-- Fábrica de roupas
insert into sistema_componente (sistemaId, componenteId) values
(2, 5), (2, 16), (2, 12);
-- Tratamento de água
insert into sistema_componente (sistemaId, componenteId) values
(3, 13), (3, 8), (3, 16);
-- Construção
insert into sistema_componente (sistemaId, componenteId) values
(4, 4), (4, 2), (4, 16);
