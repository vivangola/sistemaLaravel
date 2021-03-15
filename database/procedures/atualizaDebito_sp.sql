DELIMITER $$
CREATE PROCEDURE `atualizaDebito_sp`(IN cod_conta INTEGER)
BEGIN

	/*
		Situação:
		0 - inativo
		1 - ativo
		2 - em debio
	*/
	
	-- mensalidades sem pagamento
	create temporary table B as (
		select distinct c.id as conta 
		from contas c 
			left join mensalidades a on a.conta_id = c.id 
		where a.data_pagamento is null
	);
	
	-- em debito
	update contas 
		set tipo_status_id = 2, updated_at = now() 
	where id in (select conta from B) and (id = cod_conta or cod_conta = -1);
    
	-- ativa
	update contas 
		set tipo_status_id = 1, updated_at = now()
	where id not in (select conta from B) and (id = cod_conta or cod_conta = -1);
		
	create temporary table A as (
		select c.id as conta 
		from contas c 
			left join mensalidades a on a.conta_id = c.id 
		where a.data_pagamento is null
	);
	
	-- inativa 
	update contas 
		set tipo_status_id = 0, updated_at = now()
	where id in (select conta from A group by conta having count(conta) > 3) and (id = cod_conta or cod_conta = -1);
	
	drop table A;
    drop table B;
	
END;$$