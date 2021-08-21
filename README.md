# Crud_Api_Produtos
 
 # Inicie O Servidor, Configure Seu Banco No .env E Faça As Migrations

    php artisan migrate
    php artisan serve

# Para Se Registrar

    Método POST E Url : http://127.0.0.1:8000/api/register

    Campos: name, email, password, password_confirmation

# Para Fazer O Login

    Método POST E Url : http://127.0.0.1:8000/api/login

    Campos: email, password

# Para Criar Um Produto

    Método POST E Url : http://127.0.0.1:8000/api/product

    Campos: name_product, description, price (Coloque "." Caso Seja Um Valor De 4 Números)

# Para Visualizar Um Produto

    Método GET E Url : http://127.0.0.1:8000/api/(Número De Um ID Existente)

# Para Atualizar Seu Produto

    Método PUT E Url : http://127.0.0.1:8000/api/update/(ID Do Seu Produto)

    Campos: name_product, description, price (Coloque "." Caso Seja Um Valor De 4 Números)

# Para Excluir Seu Produto

    Método DELETE E Url : http://127.0.0.1:8000/api/(ID Do Seu Produto)

#  Lembre - Se De Está Autorizado Para Fazer Mudanças No Seu Produto

    Pegue O Token Que é Gerado Após Você Fazer O Login