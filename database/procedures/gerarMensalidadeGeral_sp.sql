DELIMITER $$
CREATE PROCEDURE `gerarMensalidadeGeral_sp`()
BEGIN

	create temporary table A as (
		select id 
		from contas 
		where tipo_status_id <> 0
	);
    
    insert into mensalidades (periodo, conta_id, plano_id, valor, formas_pagamento_id)
    select (select concat(nome,'/',year(now())) from meses where id = month(now())), a.id, b.id, b.mensalidade,1 
	from contas a inner join planos b on a.plano_id = b.id where a.id in (select id from A);
    
    drop table A;
		
END;$$


