# API RestFull Lumen

API Rest com Lumen, a mini distribuição do laravel para api RestFull,
o intuito do desenvolvimento é se familiarizar com uma API para agilizar o processo
de desenvolvimento.

## Primeiros passos

É preciso ter instalado o composer para poder criar o projeto.

criar um projeto com Lumen
`composer create-project laravel/lumen nomeProjeto`

para facilitar e utilizado uma library para gerar facilidades
`composer require flipbox/lumen-generator`

para poder rodar a app utiliza o comando
`php -S localhost:8000 -t public`

## Segunda parte

Configurar o banco de dados para receber os dados.
é preciso alterar o arquivo .env, aqui estou usando no local.
criar a base e alterar o dados no arquivo.
```
DB_DATABASE=apiRestLumen
DB_USERNAME=root
DB_PASSWORD=senha5
```

## Terceiro passo

Vai ser criado as rotas para a API.
Rota para listagem, faz um GET para exibe todos os resultados.
 - GET/products
Rota para add um novo produto, faz um POST para inserir um novo produto.
 - POST/product/add
Rota para listar um produto específico, método GET, recebe a id do produto.
 - GET/product/{id}
Rota para update no produto, método PUT, recebe a id do produto.
 - PUT/product/{id}
Rota para deletar o produto, metodo DELETE, recebe a id do produto.
 - DELETE/product/{id}

O arquivo para ser alterado fica na pasta "routes/web.php". Por segurança foi feito
um agrupamento com prefixo da api.

As rotas apos ser criadar ficam dessa forma:
```
    $router->group(['prefix'=>'api/v1'], function() use($router){
        $router->get('/products', 'ProductController@index');
        $router->post('/product/add', 'ProductController@create');
        $router->get('/product/{id}', 'ProductController@show');
        $router->put('/product/{id}', 'ProductController@update');
        $router->delete('/product/{id}', 'ProductController@destroy');
        // $router->get('/', function () use ($router) { return $router->app->version(); });
    });
```

## Quarto passo

Após estar tudo ok com as rodas, banco vamos para criar a table no banco utilizando o generate do
Laravel. O "migration" segundo a documentação do Laravel é um controle de versão para banco de dados
que é bem útil para quem trabalha com back. Ele cria um arquivo na pasta "database/migrations", esse arquivo é um arquivo com arquitetura OO(Orientação a Objetos), onde podemos basicamente criar nossa classe que será gerada no banco.

`php artisan make:migration create_products_table`

Nesse arquivo vamos acrescentar alguns campos que iremos utilizar, name, price e description do produto.

`
    $table->string('name');
    $table->integer('price');
    $table->longText('description');
`

Após ser feito as alterações nescessárias iremos utilizar o comando do Laravel para gerar a tabela.

`php artisan migrate`

## Quinto passo

Agora vamos criar o "models" e "controllers" da nossa aplicação. Para isso vamos utilizar o generate do Laravel para nos facilitar.

`php artisan make:controller productController`
Com esse é criado nosso controller na pasta "app/Http/Controllers", que é a pasta indicada pelo Framework para ser criada. Em sequida criar o model.

`php artisan make:model product`
Com esse comando é criado o model na pasta "app"

O lumen diferentemente do Laravel não inicia automaticamente o Eloquent e Facades, então podemos alterar o arquivo de configuração do bootstrap na pasta "bootstrap". Antes de return podemos incluir as seguintes linhas.

`$app->withFacades();
$app->withEloquent();`

## Sexto passo

Baseado nas rotas que criamos preveamente, iremos alterar nosso controller para tratar nossas functions.
Primeiramente vamos utilizar o model, vamos incluir a seguinte linha: 

`use App\Product;`

após o namespace.
Dentro da class ProductController iremos incluir nossas functions.
Primeiramente a listagem. Que pega todos os produtos e lista em formato JSON.
```
    public function index(){
        $products = Product::all();
        return response()->json($products);
    }
```

Na sequencia vamos incluir a function de add novo produto.
```  
    public function create(Request $request){
        $product = new Product;
        $product->name= $request->name;
        $product->price = $request->price;
        $product->description= $request->description;
        
        $product->save();
        return response()->json('product inserido com sucesso');
    }
```

Vamos incluir a function para exibir uma produto expecífico.
```   
    public function show($id){
        $product = Product::find($id);
        return response()->json($product);
    }
```

Function de update do produto.
``` 
    public function update(Request $request, $id){ 
        $product= Product::find($id);
        
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        $product->save();
        return response()->json($product);
    }
```

E por fim mais não menos importante a function para delete.

```
    public function destroy($id){
        $product = Product::find($id);

        $product->delete();
        return response()->json('product removed successfully');
    }
```

## Ultimo passo e testar

Nesse ultima etapa iremos testar nossa API para verificar se tudo está funcionando como planejado. Testaremos inserção, edição e exclusão, para isso iremos utilizar o Postman.
Postman é uma aplicativo desenvolvido para testar API's, de forma fácil é simples. Pode ser baixada no seguinte site: https://www.getpostman.com/

vamos testar cada rota criado na nossa API.
http://localhost:8000/api/v1/products
para listagem,

http://localhost:8000/api/v1/product/add
para adicionar novo produto não esqucendo de passar os parametros.

http://localhost:8000/api/v1/product/1
para deletar o produto específico, nesse caso id 1.

## Lumen generator
https://packagist.org/packages/flipbox/lumen-generator

composer require flipbox/lumen-generator

key:generate      Set the application key

make:command      Create a new Artisan command
make:controller   Create a new controller class
make:event        Create a new event class
make:job          Create a new job class
make:listener     Create a new event listener class
make:mail         Create a new email class
make:middleware   Create a new middleware class
make:migration    Create a new migration file
make:model        Create a new Eloquent model class
make:policy       Create a new policy class
make:provider     Create a new service provider class
make:seeder       Create a new seeder class
make:test         Create a new test class

### Example
generator model
php artisan make:model nameModel