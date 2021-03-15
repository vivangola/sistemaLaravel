DELIMITER $$
CREATE PROCEDURE `gerarMensalidadeGeral_sp`()
BEGIN

	create temporary table A as (
		select id 
		from contas 
		where tipo_status_id <> 0
	);
	
	create temporary table B as (
		select conta_id 
		from mensalidades 
		where concat(month(created_at),year(created_at)) = concat(month(now()),year(now()))
	);
    
    insert into mensalidades (periodo, conta_id, plano_id, valor, formas_pagamento_id, created_at, updated_at)
    select (select concat(nome,'/',year(now())) from meses where id = month(now())), a.id, b.id, b.mensalidade, 1, now(), now() 
	from contas a 
		inner join planos b on a.plano_id = b.id 
	where a.id in (select id from A) and a.id not in (select conta_id from B);
    
    drop table A;
	drop table B;
		
END;$$



