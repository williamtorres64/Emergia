use emergia;

-- Período: (id, dias, nome) => (1, 1, 'Dia'), (2, 30, 'Mês'), (3, 365, 'Ano');
-- Unidade: (id, nome) => (1, 'm'), (2, 'm2'), (3, 'm3'), (4, 'ton'), (5, 'kWh'), (6, 'litro'), (7, 'dólar');

insert into componente (nome, transformidade, unidadeId, periodoId) values
  ('Alumínio', 21300000000000000, 4, 3),
  ('Aço', 7810000000000000, 4, 3),
  ('Cobre', 98000000000000000, 4, 3),
  ('Concreto', 254000, 4, 3),
  ('Energia elétrica', 3600000, 5, 2),
  ('Água', 0.5, 6, 1),
  ('Fibra de Vidro', 13200000000000000, 4, 3),
  ('Lago', 66100000000, 2, 3),
  ('Madeira de lei', 24300000000000, 3, 3),
  ('Minerais', 526000000, 4, 3),
  ('Pinho de madeira plana', 17100000000000, 3, 3),
  ('Poliester', 5510000000000000, 4, 3),
  ('Rio', 1160000000000, 2, 3),
  ('Tratamento de Água', 1800000, 3, 2),
  ('Vidro', 12900000000000000, 4, 3),
  ('Mão de obra', 4.24e+12, 7, 3);
  /*
  select c.id, c.nome recurso, concat(u.nome, '/', p.nome) as 'unidade sej',u.nome unidade, p.dias from componente as c
  inner join unidade as u on u.id = c.unidadeId
  inner join periodo as p on p.id = c.periodoId
  order by c.id;
  */



insert into sistema (titulo, descricao) values
('Fundição', 'Calcula a emergia de uma fundição que produz alumínio, aço e cobre.'),
('Fábrica de roupas','Simula a emergia envolvida no processo de fabricação de roupas.'),
('Tratamento de água','Simula a emergia envolvida no processo de tratamento de água.'),
('Construção','Calcula a emergia envolvida na construção civil.');



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
/*
select sc.id, titulo Titulo, c.nome Recurso, c.transformidade, concat(u.nome, '/', p.nome) 'unidade sej' from sistema_componente as sc
inner join sistema as s on s.id = sc.sistemaId
inner join componente as c on c.id = sc.componenteId
inner join unidade as u on u.id = c.unidadeId
inner join periodo as p on p.id = c.periodoId
where s.titulo = 'Fábrica de roupas';
*/