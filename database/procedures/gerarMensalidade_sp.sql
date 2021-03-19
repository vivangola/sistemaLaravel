$$
CREATE PROCEDURE `gerarMensalidade_sp`(IN codConta int)
BEGIN

    insert into mensalidades (periodo, conta_id, plano_id, valor, formas_pagamento_id, created_at, updated_at)
    select (select concat(nome,'/',year(now())) from meses where id = month(now())), a.id, b.id, b.mensalidade, 1, now(), now() 
	from contas a inner join planos b on a.plano_id = b.id 
	where a.id = codConta and not exists(select id from mensalidades where conta_id = a.id and (year(created_at) = year(now()) and month(created_at) = month(now())) limit 1);
    
END;$$