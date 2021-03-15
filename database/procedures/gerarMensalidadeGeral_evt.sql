DELIMITER $$
CREATE EVENT gerarMensalidadeGerar_evt
ON SCHEDULE EVERY 1 MONTH
STARTS '2021-01-01 00:00:00'
DO 
BEGIN
 call gerarMensalidadeGeral_sp();
END;$$
