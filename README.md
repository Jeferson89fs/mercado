# mercado
sistema de vendas para mercado |  Desafio


pg_dump -d mercado -n vendas -Fc -h 127.0.0.1  -U postgres  >  C:\banco_dados_plain.sql
pg_restore -d postgres -h 127.0.0.1 -U postgres C:\banco_dados.sql

Banco de dados padrão: postgres
Para que o sistema funcione, precisa realizar as seguintes configurações:

1 - Adicionar as extencoes no php.ini

[pdo_pgsql]
extension=php_pdo_pgsql.dll

[pgsql]
extension=php_pgsql.dll

habilitar extencoes

extension=pdo_pgsql
extension=pgsql

2 - Alterar a configuração do banco de dados no arquivo "config\config.lib.php" 


